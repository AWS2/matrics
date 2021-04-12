<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\Enrolment;
use Carbon\Carbon;
use App\Http\Controllers\TermController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ImportController;

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
    $year = Carbon::now()->year;
    $nextYear = $year + 1;
    return view('pages.landing', ["year" => "$year/$nextYear"]);
});

Route::get('/sample', function () {
    return view('pages.sample');
});

Route::get('/dashboard/profile', function () {
    $user_id = auth::id();
    $enrollments = Enrolment::where('user_id', $user_id)->get();
    return view('pages.profile', ['enrollments' => $enrollments]);
});
Route::get('/dashboard', function () {
    /*$user = Auth::user();
    if ($user->enrolments()->first()->state) {
        return view('pages.dashboard');
    }else{
        return view('pages.matriculacion');
    }*/
    return view('pages.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/documents', function () {
    return view('pages.documents');
});
Route::resource('api/terms', TermController::class);
Route::resource('api/careers', CareerController::class);
Route::resource('api/logs', LogController::class);
Route::resource('api/students', StudentController::class);
Route::resource('api/import', ImportController::class);
require __DIR__ . '/auth.php';

Route::name('admin') /*admin/dashboard*/
    ->prefix('admin')
    ->middleware(['auth', 'can:accessAdmin'])
    ->group(function () {
        require __DIR__ . '/admin.php';
    });

    /*BREADCRUMB*/

// Dashboard
Breadcrumbs::for('home', static function ($trail) {
    $trail->push('Inici', route('dashboard'));
});   

// Dashboard > Profile
Breadcrumbs::for('profile', static function ($trail) {
    $trail->parent('home');
    $trail->push('Dades personals', '/dashboard/profile');
});

// Dashboard > Documents
Breadcrumbs::for('documents', static function ($trail) {
    $trail->parent('home');
    $trail->push('Documentació', '/dashboard/documents');
});
