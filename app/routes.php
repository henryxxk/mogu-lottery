<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// =============================================
// 首页 ===================================
// =============================================
Route::get('/', function()
{
    // 由于前端采用了Angular，则不需要考虑结合Laravel Blade模板了
    // 直接包含所有前端页面的PHP页面即可
    return View::make('index'); // 位于 app/views/index.php
});

Route::get('/admin', function()
{
    return View::make('admin'); // 位于 app/views/admin.php
});

// =============================================
// API ROUTES ==================================
// =============================================
Route::group(array('prefix' => 'api'), function() {
    Route::get('lottery/all', 'LotteryController@all');
    Route::post('lottery/add', 'LotteryController@add');
    Route::get('lottery/start/{id}', 'LotteryController@start');
    Route::get('lottery/nowrunning','LotteryController@nowrunning');
    Route::get('lottery/randomemps/{id}','LotteryController@rndEmps');
    Route::post('lottery/close/{id}','LotteryController@closeRound');
    Route::post('lottery/updatewinner','LotteryController@updateWinner');

});



