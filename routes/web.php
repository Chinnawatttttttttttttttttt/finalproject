<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ElderlyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ScoreTAIController;
use App\Http\Controllers\AuthController;
use App\Models\Position;
use App\Models\Department;
use App\Models\ScoreTAI;
use GuzzleHttp\Promise\Create;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

route::get('error', function(){
    return view('error.error');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('home', [AuthController::class, 'home']);
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginUser'])->name('login.submit');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'IsAdmin', 'CheckLogin', 'NowLogin'])->group(function () {

    // User
    Route::controller(UserController::class)->group(function() {
        Route::get('add-user', 'create')->name('add-user');
        Route::get('profile', 'profile')->name('profile');
        Route::post('/create-user', 'store')->name('users.store');
        Route::get('/all-user', 'index')->name('all-user');
        Route::post('/edit-user/{id}', 'edit')->name('users.update');
        Route::delete('/delete-user/{id}', 'destroy')->name('users.delete');

    });

    // Position
    Route::controller(PositionController::class)->group(function() {
        Route::get('add-position', 'create')->name('add-position');
        Route::post('/create-position', 'store')->name('positions.store');
        Route::get('/all-position', 'index')->name('all-position');
        Route::post('/edit-position/{id}', 'edit')->name('positions.update');
        Route::delete('/delete-position/{id}', 'destroy')->name('positions.delete');
    });

    // Department
    Route::controller(DepartmentController::class)->group(function() {
        Route::get('add-department', 'create')->name('add-department');
        Route::post('/create-department', 'store')->name('departments.store');
        Route::get('/all-department', 'index')->name('all-department');
        Route::post('/edit-department/{id}', 'edit')->name('departments.update');
        Route::delete('/delete-department/{id}', 'destroy')->name('departments.delete');
    });

    // Elderly
    Route::controller(ElderlyController::class)->group(function() {
        Route::get('add-elderly', 'create');
        Route::post('/create-elderly', 'store')->name('elderlys.store');
        Route::get('all-elderly', 'index');
        Route::get('edit-elderly/{id}', 'edit');
        Route::post('/update-elderly', 'update')->name('elderlys.update');
        Route::delete('/delete-elderly/{id}', 'destroy')->name('elderlys.delete');
    });

    // ScoreTAI
    Route::controller(ScoreTAIController::class)->group(function() {
        Route::get('/score/{id}', 'create');
        Route::post('/create-score', 'store')->name('score.create');
    });

});
