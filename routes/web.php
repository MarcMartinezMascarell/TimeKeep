<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompanyController;

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

$controller_path = 'App\Http\Controllers';



// pages
Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');

// authentication
// Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
// Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');


//Accept invitation
Route::get('/accept-company-invitation', [CompanyController::class, 'acceptInvitation'])->name('accept.invitation');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    $controller_path = 'App\Http\Controllers';
    // Main Page Route
    Route::get('/', $controller_path . '\pages\HomePage@index')->name('pages-home');
    Route::get('/page-2', $controller_path . '\pages\Page2@index')->name('pages-page-2');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    //NOTIFICATIONS
      //Read all notifications
      Route::get('read-all-notifications', function () {
        auth()->user()->unreadNotifications->markAsRead();
          return response(['status' => 'success'], 200);
      })->name('notifications.read-all');
      //Read single notification
      Route::get('read-notification/{id}', function ($id) {
        auth()->user()->unreadNotifications->find($id)->markAsRead();
          return response(['status' => 'success'], 200);
      })->name('notifications.read');


    //COMPANY ADMINISTRATION
    Route::get('company/users-list', [CompanyController::class, 'usersList'])->name('users.list');
    Route::middleware(['role:company_admin'])->group(function () {
      Route::get('company/users/', [CompanyController::class, 'users'])->name('company.users');
      //Company CRUD
      Route::resource('company', CompanyController::class);
    });
    Route::post('company/send-invitation', [CompanyController::class, 'sendInvitation'])->name('send.invitation');
});
