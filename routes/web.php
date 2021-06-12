<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('payment',function (){
    return view('payment');
});
Route::get('id',function (){

    include_once '../vendor/autoload.php';

  \Moyasar\Moyasar::setApiKey('sk_test_51qpGdnwyWxa6dsWrXUA1fD8z89xSB3NfFUnHJVC');
 $paymentService = new \Moyasar\Providers\PaymentService();

return $payment = $paymentService->fetch('a38af26e-02bb-497a-87ce-054c359d6419');
});
