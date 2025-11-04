<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\sellerController;


// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[sellerController::class,'login'])->name('login');

Route::get('/signup',[sellerController::class,'signupView'])->name('signup');


Route::post('/signup', [sellerController::class, 'signup']);


Route::post('/loginValidation', [sellerController::class, 'loginValidation']);


Route::get('/settings',[sellerController::class,'settings'])->name('settings');


Route::get('/firms',[sellerController::class,'firms'])->name('firms');


Route::post('/savefirm',[sellerController::class,'savefirm']);


Route::get('/get-firm/{firmno}', [sellerController::class, 'getFirm'])->name('firm.get');


Route::post('/editfirm/{firmno}',[sellerController::class,'editfirm']);

Route::get('/delete-firm/{firmno}',[sellerController::class,'deletefirm']);


Route::post('/savesettings',[sellerController::class,'savesetting']);


Route::get('/forgot',[sellerController::class,'forgot']);

Route::post('/forgot-password',[sellerController::class,'forgotPassword']);


Route::get('/additems',[sellerController::class,'additems']);


Route::post('/saveitems',[sellerController::class,'saveitem']);


Route::get('/itemslist',[sellerController::class,'itemlist'])->name('items');


Route::post('/itemssearch', [sellerController::class, 'searchitems'])->name('searchitems');

// Route::get('/edititems/{itemno}', [SellerController::class, 'editItem'])->name('edititems');

Route::post('/edititems', [SellerController::class, 'editItem'])->name('edititems');


Route::get('/itemsPdf', [sellerController::class,'exportToPDF'])->name('items.pdf');


