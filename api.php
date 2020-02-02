<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//upload video api
// Route::middleware('auth:api')->post('/v1/admin/upload', 'Controller_admin@newUpload');
Route::post('/v1/admin/upload', 'Controller_admin@newUpload');
Route::post('/v1/admin/programme','Controller_admin@newProgramme');
Route::post('/v1/admin/getImage','Controller_admin@getImage');
Route::post('/v1/admin/getVideo','Controller_admin@getVideo');
Route::post('/v1/user/sendMail', 'Controller_user@sendMail');


