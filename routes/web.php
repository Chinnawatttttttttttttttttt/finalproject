<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ElderlyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ScoreTAIController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ExportController;
use PharIo\Manifest\Author;
use PharIo\Manifest\AuthorCollection;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;



Route::get('/', function () {
    return view('welcome');
});

Route::get('error', function() {
    return view('error.error');
});

Route::get('/print-pdf-score', [PDFController::class, 'printPDF'])->name('print.pdf-score');
Route::get('/print-pdf-qr', [PDFController::class, 'printQR'])->name('print.pdf-qr');

Route::get('/export-scores', [ExportController::class, 'exportScores'])->name('export.scores');

Route::group(['middleware' => 'web'], function () {
    Route::get('home', [AuthController::class, 'home']);
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginUser'])->name('login.submit');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware(['auth', 'IsAdmin', 'CheckLogin', 'NowLogin'])->group(function () {
    // User
    Route::controller(UserController::class)->group(function() {
        Route::resource('users', UserController::class);
        Route::get('add-user', 'create')->name('add-user');
        Route::get('profile', 'profile')->name('profile');
        Route::post('/update-profile','updateProfile')->name('update-profile');
        Route::patch('/change-password','changePassword')->name('change-password');
        Route::post('create-user', 'store')->name('users.store');
        Route::get('all-user', 'index')->name('all-user');
        Route::get('edit-user/{id}', 'edit')->name('users.edit');
        Route::patch('update-user/{id}', 'update')->name('users.update');
        Route::delete('delete-user/{id}', 'destroy')->name('users.delete');
    });

    // Position
    Route::controller(PositionController::class)->group(function() {
        Route::get('add-position', 'create')->name('add-position');
        Route::post('create-position', 'store')->name('positions.store');
        Route::get('all-position', 'index')->name('all-position');
        Route::get('edit-position/{id}', 'edit')->name('edit-position');
        Route::patch('update-position/{id}', 'update')->name('positions.update');
        Route::delete('delete-position/{id}', 'destroy')->name('positions.delete');
    });

    // Department
    Route::controller(DepartmentController::class)->group(function() {
        Route::get('add-department', 'create')->name('add-department');
        Route::post('create-department', 'store')->name('departments.store');
        Route::get('all-department', 'index')->name('all-department');
        Route::get('edit-department/{id}', 'edit')->name('edit-department');
        Route::patch('update-department/{id}', 'update')->name('departments.update');
        Route::delete('delete-department/{id}', 'destroy')->name('departments.delete');
    });

    //Elderly
    Route::controller(ElderlyController::class)->group(function() {
        Route::get('add-elderly', 'create')->name('add-elderly');
        Route::post('create-elderly', 'store')->name('elderlys.store');

        Route::get('all-elderly', 'index')->name('all-elderly');
        // Route::get('edit-elderly/{id}', 'edit')->name('edit-elderly');
        // Route::patch('update-elderly/{id}', 'update')->name('elderlys.update');

        // Route สำหรับแสดงฟอร์มแก้ไข
        Route::get('/elderlys/{id}/edit','edit')->name('elderlys.edit');
        // Route สำหรับอัปเดตข้อมูล
        Route::put('/elderlys/{id}','update')->name('elderlys.update');

        Route::delete('delete-elderly/{id}', 'destroy')->name('elderlys.delete');

        Route::get('/maps','showMap')->name('map');

    });

    // ScoreTAI
    Route::controller(ScoreTAIController::class)->group(function() {
        // Route for showing the form to create a new score
        Route::get('score/{id}', 'create')->name('score.create');

        // Route for storing (creating) a new score
        Route::post('create-score', 'store')->name('score.store');

        // Route for showing all scores
        Route::get('all-score', 'showTAI')->name('all-score');

        Route::get('tai', 'show')->name('show');
    });

    Route::controller(DashboardController::class)->group(function(){
        Route::get('/dashboard','index')->name('dashboard');
        Route::post('/dashboard/save_colors', 'saveGroupColors')->name('dashboard.save_colors');
    });
});
