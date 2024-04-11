<?php

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

// Route::get('/', function () {
//     return view('auth.login');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['guest']], function(){
    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('employees', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employees');
    Route::get('create-employee', [App\Http\Controllers\EmployeeController::class, 'create'])->name('create-employee');
    Route::post('store-emploee', [App\Http\Controllers\EmployeeController::class, 'store'])->name('store-employee');
    Route::get('employee-edit/{id}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee-edit');
    Route::post('employee-update', [App\Http\Controllers\EmployeeController::class, 'update'])->name('employee-update');
    Route::DELETE('employee-delete/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employee-delete');

    // project

    Route::get('project', [App\Http\Controllers\ProjectController::class, 'index'])->name('project');
    Route::get('create-project', [App\Http\Controllers\ProjectController::class, 'create'])->name('create-project');
    Route::post('store-project', [App\Http\Controllers\ProjectController::class, 'store'])->name('store-project');
    Route::get('project-edit/{id}', [App\Http\Controllers\ProjectController::class, 'edit'])->name('project-edit');
    Route::post('project-update', [App\Http\Controllers\ProjectController::class, 'update'])->name('project-update');
    Route::get('project-delete/{id}', [App\Http\Controllers\ProjectController::class, 'destroy'])->name('project-delete');

    // Module

    Route::get('module', [App\Http\Controllers\ModuleController::class, 'index'])->name('module');
    Route::get('create-module', [App\Http\Controllers\ModuleController::class, 'create'])->name('create-module');
    Route::post('store-module', [App\Http\Controllers\ModuleController::class, 'store'])->name('store-module');
    Route::get('module-edit/{id}', [App\Http\Controllers\ModuleController::class, 'edit'])->name('module-edit');
    Route::post('module-update', [App\Http\Controllers\ModuleController::class, 'update'])->name('module-update');
    Route::delete('module-delete/{id}', [App\Http\Controllers\ModuleController::class, 'destroy'])->name('module-delete');

    // Sub Module

    Route::get('sub-module', [App\Http\Controllers\SubModuleController::class, 'index'])->name('sub-module');
    Route::get('create-sub-module', [App\Http\Controllers\SubModuleController::class, 'create'])->name('create-sub-module');
    Route::post('store-sub-module', [App\Http\Controllers\SubModuleController::class, 'store'])->name('store-sub-module');
    Route::get('sub-module-edit/{id}', [App\Http\Controllers\SubModuleController::class, 'edit'])->name('sub-module-edit');
    Route::post('sub-module-update', [App\Http\Controllers\SubModuleController::class, 'update'])->name('sub-module-update');
    Route::delete('sub-module-delete/{id}', [App\Http\Controllers\SubModuleController::class, 'destroy'])->name('sub-module-delete');

    // Task

    Route::get('task', [App\Http\Controllers\TaskController::class, 'index'])->name('task');
    Route::get('create-task', [App\Http\Controllers\TaskController::class, 'create'])->name('create-task');
    Route::post('store-task', [App\Http\Controllers\TaskController::class, 'store'])->name('store-task');
    Route::get('task-edit/{id}', [App\Http\Controllers\TaskController::class, 'edit'])->name('task-edit');
    Route::post('task-update', [App\Http\Controllers\TaskController::class, 'update'])->name('task-update');
    Route::delete('task-delete/{id}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('task-delete');
    Route::get('get-module', [App\Http\Controllers\TaskController::class, 'getModule'])->name('get-module');
    Route::get('get-sub-module', [App\Http\Controllers\TaskController::class, 'getSubModule'])->name('get-sub-module');

});
