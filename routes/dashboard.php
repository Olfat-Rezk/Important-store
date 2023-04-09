<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;

Route::group([
    'middleware'=>['auth'],
    'as'=>'dashboard.',
    'prefix'=>'dashboard'


],function(){
    Route::get('/',[DashboardController::class,'index'])
            ->middleware([ 'verified'])
            ->name('dashboard');

Route::resource('/categories', CategoriesController::class);


});

