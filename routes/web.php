<?php

use App\Models\CashRequest;
use App\Models\ChartOfAccounts;
use App\Models\CashRequestDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CashRequestController;
use App\Http\Controllers\ChartOfAccountsController;
use App\Http\Controllers\CashRequestDetailController;

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

Auth::routes([
    'register' => false,
    'password.request' => false,
    'password.email' => false,
    'password.reset' => false,
]);
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        $data['page_title'] = 'Dashboard';
        return view('home.index', $data);
    })->name('home');
    
    // Settings
    Route::get('/settings', function () {
        $data['page_title'] = 'Settings';
        return view('settings.index', $data);
    })->name('settings');

    //cash request
    Route::get('/cash-request', [CashRequestController::class, 'index'])->name('cash-request.index');
    Route::get('/cash-request/create', [CashRequestController::class, 'create'])->name('cash-request.create');
    Route::post('/cash-request/store', [CashRequestController::class, 'store'])->name('cash-request.store');
    Route::get('/cash-request/edit/{id}', [CashRequestController::class, 'edit'])->name('cash-request.edit');
    Route::patch('/cash-request/update/{id}', [CashRequestController::class, 'update'])->name('cash-request.update');
    Route::delete('/destroy/{id}', [CashRequestController::class, 'destroy'])->name('cash-request.destroy');
    Route::get('/cash-request/show/{id}', [CashRequestController::class, 'show'])->name('cash-request.show');
    Route::post('/cash-request/approve/{id}', [CashRequestController::class, 'approve'])->name('cash-request.approve');
    Route::post('/cash-request/reject/{id}', [CashRequestController::class, 'reject'])->name('cash-request.reject');

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::resource('department', DepartmentController::class);
        Route::resource('user', UserController::class);
    });

    // Chart Of Accounts
    Route::get('/chart-of-accounts', [ChartOfAccountsController::class, 'index'])->name('chart-of-accounts.index');
    Route::get('/chart-of-accounts/create', [ChartOfAccountsController::class, 'create'])->name('chart-of-accounts.create');
    Route::post('/chart-of-accounts/store', [ChartOfAccountsController::class, 'store'])->name('chart-of-accounts.store');
    Route::get('/chart-of-accounts/edit/{id}', [ChartOfAccountsController::class, 'edit'])->name('chart-of-accounts.edit');
    Route::patch('/chart-of-accounts/update/{id}', [ChartOfAccountsController::class, 'update'])->name('chart-of-accounts.update');
    Route::delete('/chart-of-accounts/destroy/{id}', [ChartOfAccountsController::class, 'destroy'])->name('chart-of-accounts.destroy');

    // Journal
    Route::get('/journal', [JournalController::class, 'index'])->name('journal.index');
    Route::get('/journal/create', [JournalController::class, 'create'])->name('journal.create');
    Route::post('/journal/cancel', [JournalController::class, 'cancel'])->name('journal.cancel');
    Route::post('/journal/simpan', [JournalController::class, 'simpan'])->name('journal.simpan');
    Route::patch('/journal/update/{id}', [JournalController::class, 'update'])->name('journal.update');  
    Route::get('/journal/edit/{id}', [JournalController::class, 'edit'])->name('journal.edit');
    Route::patch('/journal/updatemodal/{id}', [JournalController::class, 'updatemodal'])->name('journal.updatemodal');
    Route::patch('/journal/updatejournal/{id}', [JournalController::class, 'updatejournal'])->name('journal.updatejournal');
    Route::delete('/journal/destroy/{id}', [JournalController::class, 'destroy'])->name('journal.destroy');
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');