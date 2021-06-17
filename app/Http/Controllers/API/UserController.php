<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'bio'=>$request->bio,
            'type'=>$request->type,
            'photo'=>$request->photo,
            'password'=>Hash::make($request->password)
        ]);

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {

     return auth('api')->user();
    }
    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();


        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|min:6'
        ]);


        $currentPhoto = $user->photo;


        if ($request->photo != $currentPhoto) {
            $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            Image::make($request->photo)->save(public_path('assets/img/profile/') . $name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/') . $currentPhoto;
            if (file_exists($userPhoto)) {
                @unlink($userPhoto);
            }

            if(!empty($request->password)){
                $request->merge(['password' => Hash::make($request['password'])]);
            }


            $user->update($request->all());
            return ['message' => "Success"];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$id,
            'password' => 'string|min:6'
        ]);
        $user=User::findOrFail($id);
        if ($user){
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'bio'=>$request->bio,
                'type'=>$request->type,
                'photo'=>$request->photo,
                'password'=>Hash::make($request->password)
            ]);
            return response()->json([
               'status'=>200,
               'msg'=>'User Updated in successfully'
            ]);
        }
        return response()->json([
            'status'=>404,
            'msg'=>'User not found'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         User::find($id)->delete();
         return ['message'=>'user deleted'];
    }
}
