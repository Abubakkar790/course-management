<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StreamController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

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


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Stream Management
    Route::get('/stream/index', [StreamController::class, 'index'])->name('stream.index');
    Route::get('/stream/create', [StreamController::class, 'create'])->name('stream.create');
    Route::post('/stream/store', [StreamController::class, 'store'])->name('stream.store');
    Route::get('/stream/view', [StreamController::class, 'view'])->name('stream.view');
    Route::get('/stream/show{id}', [StreamController::class, 'show'])->name('stream.show');
    Route::get('/stream/edit/{id}', [StreamController::class, 'edit'])->name('stream.edit');
    Route::put('/stream/update/{id}', [StreamController::class, 'update'])->name('stream.update');
    Route::delete('/stream/destroy{id}', [StreamController::class, 'destroy'])->name('stream.destroy');

    // Subject Management
    Route::get('/subject/index', [SubjectController::class, 'index'])->name('subject.index');
    Route::get('/subject/create', [subjectController::class, 'create'])->name('subject.create');
    Route::post('/subject/store', [subjectController::class, 'store'])->name('subject.store');
    Route::get('/subject/view', [subjectController::class, 'view'])->name('subject.view');
    Route::get('/subject/show{id}', [subjectController::class, 'show'])->name('subject.show');
    Route::get('/subject/edit/{id}', [subjectController::class, 'edit'])->name('subject.edit');
    Route::put('/subject/update/{id}', [subjectController::class, 'update'])->name('subject.update');
    Route::delete('/subject/destroy{id}', [subjectController::class, 'destroy'])->name('subject.destroy');

    Route::get('/subjects/{streamId}', [SubjectController::class, 'getSubjectsByStream'])->name('subjects.byStream');

    // Teacher Management
    Route::get('/teacher/index', [TeacherController::class, 'index'])->name('teacher.index');
    // Route::get('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
    // Route::post('/teacher/store', [TeacherController::class, 'store'])->name('teacher.store');
    Route::get('/teacher/view', [TeacherController::class, 'view'])->name('teacher.view');
    Route::get('/teacher/show{id}', [TeacherController::class, 'show'])->name('teacher.show');
    Route::get('/teacher/edit/{id}', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::put('/teacher/update/{id}', [TeacherController::class, 'update'])->name('teacher.update');
    Route::delete('/teacher/destroy{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');
});


require __DIR__.'/auth.php';
