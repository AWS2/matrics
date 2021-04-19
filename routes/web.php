<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\Enrolment;
use Carbon\Carbon;
use App\Http\Controllers\TermController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\Enrolment_ufController;
use App\Http\Controllers\EnrolmentController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\UfController;
use App\Http\Controllers\UploadController;
use App\Models\Enrolment_uf;
use App\Http\Controllers\MpsController;
use App\Http\Controllers\Profile_reqController;
use App\Http\Controllers\RequirementController;
use App\Models\Profile_req;
use App\Http\Controllers\AdminController;

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

Route::get('/uploads', function () {
    return view('pages.upload');
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
Route::get('/dashboard/requirements', function () {
    $profile_req = Profile_req::all();
    return view('pages.requirements' , ['profile_req' => $profile_req]);
});
Route::get('/dashboard/documents', function () {
    return view('pages.documents');
});
Route::resource('api/terms', TermController::class);
Route::resource('api/careers', CareerController::class);
Route::resource('api/logs', LogController::class);
Route::resource('api/students', StudentController::class);
Route::resource('api/import', ImportController::class);
Route::resource('api/ufs', UfController::class);
Route::resource('api/enrolments', EnrolmentController::class);
Route::resource('api/enrolment_ufs', Enrolment_ufController::class);
Route::resource('api/mps', MpsController::class);
Route::resource('api/profile_reqs', Profile_reqController::class);
Route::resource('api/requirements', RequirementController::class);
Route::resource('api/admins', AdminController::class);
Route::resource('api/createAdmin', RegisterAdminController::class);
Route::resource('api/uploads', UploadController::class);

require __DIR__ . '/auth.php';

Route::name('admin') /*admin/dashboard*/
    ->prefix('admin')
    ->middleware(['auth', 'can:accessAdmin'])
    ->group(function () {
        require __DIR__ . '/admin.php';
    });

Route::get('auth/redirect', 'App\Http\Controllers\SocialController@redirect');
Route::get('auth/callback', 'App\Http\Controllers\SocialController@callback');

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
    $trail->push('Documents', '/dashboard/documents');
});

