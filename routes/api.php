<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CreditorController;
use App\Http\Controllers\DebtorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountTypeController;
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





// User routes

Route::resource('user',UserController::class);
Route::post('login',[UserController::class,'login']);



Route::middleware('auth')->group(function () {
    Route::get('logout',[UserController::class,'logout']);
    Route::get('user',[UserController::class, 'index']);

    Route::resource('expense', ExpenseController::class);
    // Route::get('expenses/7days', [ExpenseController::class,'expenses7days']);
    // Route::get('expenses/week', [ExpenseController::class,'expensesWeek']);
    // Route::get('expenses/month', [ExpenseController::class,'expensesmonth']);

    Route::resource('account-type',AccountTypeController::class);

    Route::resource('accounts', AccountController::class);
    // Route::get('accounts/7days', [AccountController::class,'accounts7days']);
    // Route::get('accounts/week', [AccountController::class,'accountsWeek']);
    // Route::get('accounts/month', [AccountController::class,'accountsmonth']);


    Route::resource('creditor' , CreditorController::class);

    Route::resource('debtor' , DebtorController::class);


});


