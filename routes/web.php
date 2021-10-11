<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;
use Stevebauman\Location\Facades\Location;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use Illuminate\Http\Request;

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


Route::get('get-my-location', function() {
    $location = Location::get();
    return view('location', compact('location'));
});

Route::get('location',[LocationController::class, 'index']);

Route::get('remove-spec', function () {
    function clean($string) {
        $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
     
        return preg_replace('/[^0-9\.]+/', '', $string); // Removes special chars.
    }

     return isValidAmount('30,00.00');
});

Auth::routes();
Route::get('/register', function() {return redirect('/admin/login');});
Route::post('/register', function() { return redirect('/admin/login');});
Route::get('/admin/register', function() {return redirect('/admin/login');});
Route::post('/admin/register', function() { return redirect('/admin/login');});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::group(['middleware' => 'auth:admin'], function () {
    
//     // Route::view('/admin', 'adminDashboard');
//     Route::get('/admin', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('home');
// });


    // Admin authentication 
 Route::group(['namespace' => 'Admin'] , function(){
        Route::get('admin/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
        Route::post('admin/login', [loginController::class, 'login']);
        Route::get('forgot-password', [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
        Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');

        Route::post('password/reset', [ResetPasswordController::class, 'reset']);
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::get('admin/logout', [LoginController::class,'logout'])->name('logout');
   });
    
/* Administration Routes */
Route::middleware(['auth:admin'])->group(function () { // check for autherization
    Route::get('/admin', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::get('{locale}/admin', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
            ->where('locale', implode('|', Config::get('app.locales')));
////////////// Admin controls(user)
   Route::get('admin/users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->where('locale', implode('|', Config::get('app.locales')));
   Route::get('{locale}/admin/users', [App\Http\Controllers\Admin\UsersController::class, 'index']);
   Route::post('admin/users', [App\Http\Controllers\Admin\UsersController::class, 'setUser'])->where('locale', implode('|', Config::get('app.locales')));
   Route::post('{locale}/admin/users', [App\Http\Controllers\Admin\UsersController::class, 'setUser']);
   Route::get('admin/delete/user/{userId}', [App\Http\Controllers\Admin\UsersController::class, 'deleteUser'])->where('locale', implode('|', Config::get('app.locales')));
   Route::get('{locale}/admin/delete/user/{userId}', [App\Http\Controllers\Admin\UsersController::class, 'deleteUser']);
////////////// Admin controls(admin)
Route::get('admin/admins', [App\Http\Controllers\Admin\AdminsController::class, 'index'])->where('locale', implode('|', Config::get('app.locales')));
Route::get('{locale}/admin/admins', [App\Http\Controllers\Admin\AdminsController::class, 'index']);
Route::post('admin/admins', [App\Http\Controllers\Admin\AdminsController::class, 'setUser'])->where('locale', implode('|', Config::get('app.locales')));
Route::post('{locale}/admin/admins', [App\Http\Controllers\Admin\AdminsController::class, 'setUser']);
Route::get('admin/delete/admins/{userId}', [App\Http\Controllers\Admin\AdminsController::class, 'deleteUser'])->where('locale', implode('|', Config::get('app.locales')));
Route::get('{locale}/admin/delete/admins/{userId}', [App\Http\Controllers\Admin\AdminsController::class, 'deleteUser']);

///////////// Admin controls(riders)
Route::get('admin/riders', [App\Http\Controllers\Admin\RidersController::class, 'index'])->where('locale', implode('|', Config::get('app.locales')));
Route::get('{locale}/admin/riders', [App\Http\Controllers\Admin\RidersController::class, 'index']);
Route::post('admin/riders', [App\Http\Controllers\Admin\RidersController::class, 'setUser'])->where('locale', implode('|', Config::get('app.locales')));
Route::post('{locale}/admin/riders', [App\Http\Controllers\Admin\RidersController::class, 'setUser']);
Route::get('admin/delete/riders/{userId}', [App\Http\Controllers\Admin\RidersController::class, 'deleteUser'])->where('locale', implode('|', Config::get('app.locales')));
Route::get('{locale}/admin/delete/riders/{userId}', [App\Http\Controllers\Admin\RidersController::class, 'deleteUser']);



});