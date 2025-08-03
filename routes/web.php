<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ConcessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PharmacyDrugController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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




Auth::routes();
// Define a group of routes with 'auth' middleware applied
Route::middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('index');


    Route::prefix('concession')->group(callback: function () {
        Route::resource('concessions',ConcessionController::class)->names('concessions');
    });
});
