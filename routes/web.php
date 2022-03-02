<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;

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

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

Route::get('/survey/{id?}', [UsersController::class, 'answerSurveyForm'])->where('id', '[a-zA-z0-9]+')->name('survey.index');
Route::post('/survey/{id?}', [UsersController::class, 'answerSurvey'])->where('id', '[a-zA-z0-9]+')->name('survey.answer');
Route::get('/thank-you', [UsersController::class, 'thankYou'])->name('thank-you');

Route::controller(AuthController::class)->middleware('loggedin')->group(function() {
    Route::get('login', 'loginView')->name('login.index');
    Route::post('login', 'login')->name('login.check');
    Route::get('register', 'registerView')->name('register.index');
    Route::post('register', 'register')->name('register.store');
});

Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::controller(UsersController::class)->group(function() {
        Route::get('/new-user', 'newUserForm')->name('new-user.index');
        Route::post('/new-user', 'newUser')->name('new-user.create');
        Route::get('/users-list', 'usersList')->name('users-list.showList');
        Route::get('/edit-user/{id?}', 'editUserForm')->where('id', '[0-9]+')->name('edit-user.index');
        Route::post('/edit-user/{id?}', 'editUser')->where('id', '[0-9]+')->name('edit-user.update');
        Route::get('/del-user/{id?}', 'delUser')->where('id', '[0-9]+')->name('del-user');

        Route::get('/new-survey', 'newSurveyForm')->name('new-survey.index');
        Route::post('/new-survey', 'newSurvey')->name('new-survey.create');
        Route::get('/surveys-list', 'surveysList')->name('surveys-list.showList');
        Route::get('/finilize-survey/{id?}', 'finilizeSurveyForm')->where('id', '[0-9]+')->name('finilize-survey.index');
        Route::post('/finilize-survey/{id?}', 'finilizeSurvey')->where('id', '[0-9]+')->name('finilize-survey.create');
        Route::get('/survey-detail/{id?}', 'surveyDetail')->where('id', '[0-9]+')->name('surveyDetail');
        Route::get('/del-survey/{id?}', 'delSurvey')->where('id', '[0-9]+')->name('del-survey');
        Route::get('/edit-survey/{id?}', 'editSurveyForm')->where('id', '[0-9]+')->name('edit-survey.index');
        Route::post('/edit-survey/{id?}', 'editSurvey')->where('id', '[0-9]+')->name('edit-survey.update');

        Route::get('/profile', 'profileForm')->name('profile.index');
        Route::post('/profile', 'profileUpdate')->name('profile.update');
    });
    Route::controller(PageController::class)->group(function() {
        Route::get('/', 'dashboard')->name('dashboard');
    });
});
