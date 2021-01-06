<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\CreditorController;
use App\Http\Controllers\DebtorController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::resource('expense', ExpenseController::class);
Route::get('expense-user/{id}',[ExpenseController::class,'index']);

Route::resource('income' , IncomeController::class);
Route::get('income-user/{id}',[IncomeController::class,'index']);

Route::resource('creditor' , CreditorController::class);
Route::get('creditor-user/{id}',[CreditorController::class,'index']);

Route::resource('debtor' , DebtorController::class);
Route::get('debtor-user/{id}',[DebtorController::class,'index']);


Route::get('summary/{id}' , [SummaryController::class,'index'])->name('summary.index');
Route::post('summary/{id}' , [SummaryController::class,'store'])->name('summary.store');
Route::put('summary/{id}' , [SummaryController::class,'update'])->name('summary.update');
Route::delete('summary/{id}', [SummaryController::class,'destroy'])->name('summary.destroy');

// User routes

Route::resource('user',UserController::class);

Route::middleware('auth')->get('user',[UserController::class, 'index']);

Route::post('login',[UserController::class,'login']);
