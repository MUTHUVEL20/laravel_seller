<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\sellerController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/saveitems',[sellerController::class,'saveitem'])-> middleware('apiToken');


Route::post('/bulkmail',[sellerController::class,'sendBulkMail']);


Route::get('/month/{num}', function ($num) {

    if ($num == 1) {

        return 'JANUARY';
    }
    else if ($num == 2) {

        return 'FEBRUARY';
    }
    else if ($num == 3) {

        return 'MARCH';
    }
})-> middleware('monthMiddleware');


Route::get('user/data', function () {

    return response() -> json ([

        'username' => 'Muthu Vel',
        'Role'     => 'Developer',
        'status'   => 'success'
    ]);
})-> middleware('apiToken');