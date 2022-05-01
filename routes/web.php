<?php

use Illuminate\Support\Facades\Route;
use App\EPASItem;
use App\CSSItem;

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

Route::get('/about-us', function() {
	return view('about-us');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth','is_admin']], function() {
	Route::get('/admin', 'HomeController@adminHome')->name('admin.home');
	Route::resource('admin/borrow', 'BorrowItemController');
	Route::resource('admin/css', 'CSSInventoryController');
	Route::resource('admin/epas', 'EPASInventoryController');
	Route::resource('admin/users', 'UserController');
	
	Route::get('admin/logs', 'ActivityLog@index')->name('admin.activity_logs');
	Route::get('admin/reports', 'ReportsController@index')->name('admin.reports');
	
	Route::get('admin/reports/borrowed_css', 'ReportsController@borrowed_css')->name('admin.reports.borrowed_css');
	Route::get('admin/reports/returned_css', 'ReportsController@returned_css')->name('admin.reports.returned_css');
	Route::get('admin/reports/new_css', 'ReportsController@new_css')->name('admin.reports.new_css');
	Route::get('admin/reports/good_css', 'ReportsController@good_css')->name('admin.reports.good_css');
	Route::get('admin/reports/defective_css', 'ReportsController@defective_css')->name('admin.reports.defective_css');

	Route::get('admin/reports/borrowed_epas', 'ReportsController@borrowed_epas')->name('admin.reports.borrowed_epas');
	Route::get('admin/reports/returned_epas', 'ReportsController@returned_epas')->name('admin.reports.returned_epas');
	Route::get('admin/reports/new_epas', 'ReportsController@new_epas')->name('admin.reports.new_epas');
	Route::get('admin/reports/good_epas', 'ReportsController@good_epas')->name('admin.reports.good_epas');
	Route::get('admin/reports/defective_epas', 'ReportsController@defective_epas')->name('admin.reports.defective_epas');

	Route::get('admin/reports/download_pdf/{filter}', 'ReportsController@download_pdf')->name('admin.reports.download_pdf');
});

Route::group(['middleware' => ['auth','is_user']], function() {
	Route::get('user', 'ItemUserController@dashboard')->name('user.home');
	Route::get('user/available', 'ItemUserController@index')->name('user.available');
	Route::post('user/available', 'ItemUserController@borrow_item')->name('user.borrow');
	Route::get('user/borrowed', 'ItemUserController@borrowed')->name('user.borrowed');
	Route::get('user/returned', 'ItemUserController@returned')->name('user.returned');
	Route::get('user/account', 'ItemUserController@account' )->name('user.account');
	Route::put('user/account', 'ItemUserController@update_account' )->name('user.account');
});

// Route::group(['middleware' => ['auth','is_epas']], function() {
// 	Route::get('epas_user', 'HomeController@epasUserHome')->name('epas_user.home');
// 	Route::get('epas_user/available', 'EPASUserController@index')->name('epas_user.available');
// 	Route::post('epas_user/available', 'EPASUserController@borrow_item')->name('epas_user.borrow');
// 	Route::get('epas_user/borrowed', 'EPASUserController@borrowed')->name('epas_user.borrowed');
// 	Route::get('epas_user/returned', 'EPASUserController@returned')->name('epas_user.returned');
// 	Route::get('epas_user/account', 'EPASUserController@account' )->name('epas_user.account');
// 	Route::put('epas_user/account', 'EPASUserController@update_account' )->name('epas_user.account');
// });



