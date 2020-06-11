<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//Socialite-github
Route::get('login/github', 'Auth\LoginController@github')->name('login.github');
Route::get('login/github/redirect', 'Auth\LoginController@githubRedirectHandle');
//Socialite-google
// Route::get('login/google', 'Auth\LoginController@google')->name('login.google');
// Route::get('login/google/redirect', 'Auth\LoginController@googleRedirectHandle');


Route::get('/about', 'PagesController@about');
Route::get('/','PagesController@welcome');
//users resource
Route::get('/users/dashboard', 'HomeController@index')->name('dashboard');
Route::get('users/','UserController@index')->name('users.index');
Route::get('users/search','UserController@search')->name('users.search');
Route::post('users/ban/{id}','UserController@ban')->name('users.ban');
Route::post('users/uprole/{id}','UserController@uprole')->name('users.uprole');

//Lottery upload
Route::post('lottery/uploadAction','LotteryController@uploadFile')->name('lottery.uploadAction');
Route::get('lottery/upload','LotteryController@uploadView')->name('lottery.upload.view');

//lotteries resource
Route::get('lottery/','LotteryController@index')->name('lottery.index');
Route::get('lottery/search','LotteryController@search')->name('lottery.search');
Route::get('lottery/add','LotteryController@add')->name('lottery.add');
Route::post('lottery', 'LotteryController@store');
Route::get('lottery/{id}','LotteryController@show')->name('lottery.show');
Route::get('lottery/{id}/edit','LotteryController@edit')->name('lottery.edit');
Route::put('lottery/{id}','LotteryController@update')->name('lottery.update');
Route::delete('lottery/{id}', 'LotteryController@delete')->name('lottery.delete');
//crawl
// Route::get('/test','LotteryController@test')->name('lottery.test');
Route::get('crawl','LotteryController@crawlEdit')->name('lottery.crawl');
Route::get('crawl-single-result','LotteryController@crawlAction')->name('lottery.crawlaction');
Route::get('crawltodb','LotteryController@crawltoDb')->name('lottery.crawltodb');
Route::get('crawlresult','LotteryController@crawlToDbAction')->name('lottery.crawltodbaction');

//email
Route::get('email/newsletter','EmailController@sendNewsletter')->name('email.newsletter');
Route::get('email/daily','EmailController@sendDaily')->name('email.daily');

