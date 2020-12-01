<?php

use App\Http\Controllers\User\Auth\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::post('/login', function () {
//     return response()->json(['json' => 200]);
// });

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', 'User\Auth\UserAuthController@login');

Route::get('/errorLogin', 'User\Auth\UserAuthController@errorLogin')->name('errorLogin');

Route::middleware('auth:api')->group(function () {
    //GET
    Route::get('/getSPK', 'User\SpkController@getSPK');
    Route::get('/getUpcomingSPK', 'User\SpkController@upComingSPK');
    Route::get('/getDetailSPK', 'User\SpkController@getDetailSPK');
    Route::get('/jobCount', 'User\SpkController@jobCount');
    Route::get('/jobDone', 'User\SpkController@jobDone');
    Route::get('/listJobDone', 'User\SpkController@listJobDone');

    //POST
    Route::post('post/submitSPK', 'User\SpkController@submitSPK');
});
