<?php

use Illuminate\Support\Facades\Auth;
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

Route::group(
    ['middleware' => ['auth']],
    function () {
        Route::resource('/roles', 'RolesController');
        Route::resource('/users', 'UserController');

        Route::prefix('products')->group(function () {
            Route::resource('/category', 'ProductCategoryController');
            Route::resource('/subcategory', 'ProductSubcategoryController');
            Route::resource('/product', 'ProductController');
        });

        Route::resource('/sale', 'SaleController');

        Route::prefix('report')->group(function () {
            Route::get('/trending', 'ReportController@trending')->name('report.trending');
            Route::get('/analysis', 'ReportController@index')->name('report.analysis');
        });
    }
);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
