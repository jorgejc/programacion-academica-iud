<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AcademicSemesterController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\CurriculumSemesterController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\SemesterSubjectController;
use App\Http\Controllers\ProjectionController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Rutas de la Aplicacion
    Route::resource('dashboard/program', ProgramController::class);
    Route::resource('dashboard/teacher', TeacherController::class);
    Route::resource('dashboard/area', AreaController::class);
    Route::resource('dashboard/blocks', BlockController::class);
    Route::resource('dashboard/academic_semester', AcademicSemesterController::class);
    Route::resource('dashboard/curriculum', CurriculumController::class);
    Route::resource('dashboard/curriculum_semesters', CurriculumSemesterController::class);
    Route::resource('dashboard/subject', SubjectController::class);
    Route::resource('dashboard/semesterSubject', SemesterSubjectController::class);
    Route::resource('dashboard/projection', ProjectionController::class);
    Route::get('dashboard/load-semesters/{programId}', [ProjectionController::class, 'loadSemesters'])->name('load.semesters');
    Route::resource('dashboard/group', GroupController::class);
    Route::get('/dashboard/group', [GroupController::class, 'index'])->name('group.index');
    Route::post('dashboard/group/auto-generate', [GroupController::class, 'autoGenerate'])->name('group.autoGenerate');
    Route::get('/dashboard/group/create', [GroupController::class, 'create'])->name('group.create');
    Route::post('/dashboard/group', [GroupController::class, 'store'])->name('group.store');
    Route::resource('dashboard/schedules', ScheduleController::class);
    Route::get('dashboard/reports', [ReportController::class, 'index'])->name('reports.index');



});

require __DIR__.'/auth.php';
