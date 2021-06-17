<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

//    public function login(Request $request)
//    {
//        $request->validate([
//            'email'=>['email','required'],
//            'password'=>['required'],
//        ]);
//        $credentials=$request->only(['email','password']);
//        $user=  Auth::guard('web')->attempt($credentials);
//
//        if($user):
//            $user=Auth::user();
//               $token = $user->createToken('Token'.$user->id)->accessToken;
//
//        endif;
//        return response()->json([
//            'msg'=>'unauthenticated',
//            'status'=>402
//        ]);
//    }
//    public function logout(Request $request)
//    {
//        $request->user()->tokens()->delete();
//        $this->guard()->logout();
//
//        $request->session()->invalidate();
//
//        $request->session()->regenerateToken();
//
//        if ($response = $this->loggedOut($request)) {
//            return $response;
//        }
//
//        return $request->wantsJson()
//            ? new JsonResponse([], 204)
//            : redirect('/');
//    }

}
