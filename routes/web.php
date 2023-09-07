<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
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
// routes/web.php

// routes/web.php
// web.php

//Route::post('employeesdata', 'EmployeeController@store')->name('employees.store');


Route::get('/employees/data', [EmployeeController::class, 'getEmployeesData'])->name('employees.data');


Route::get('/employees/create', [EmployeeController:: class,'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class,'store'])->name('employees.store');
Route::get('/employees', [EmployeeController::class,'index'])->name('employees.index');

//Route::resource('employees', EmployeeController::class);
