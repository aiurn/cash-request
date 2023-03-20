<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CashRequestController;
use App\Http\Controllers\CashRequestDetailController;
use App\Http\Controllers\UserController;
use App\Models\CashRequest;
use App\Models\CashRequestDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

    //cash request detail
    // Route::get('/cash-request-detail/create', [CashRequestDetailController::class, 'index'])->name('cash-request-detail.index');
    // Route::get('/cash-request-detail', [CashRequestDetailController::class, 'index'])->name('cash-request-detail.index');
    // Route::post('/cash-request-detail/store', [CashRequestDetailController::class, 'store'])->name('cash-request-detail.store');
    // Route::get('/cash-request-detail/edit/{id}', [CashRequestDetailController::class, 'edit'])->name('cash-request-detail.edit');
    // Route::post('/cash-request-detail/update/{id}', [CashRequestDetailController::class, 'update'])->name('cash-request-detail.update');
    // Route::get('/cash-request-detail/destroy{id}', [CashRequestDetailController::class, 'destroy'])->name('cash-request-detail.destroy');

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::resource('department', DepartmentController::class);
        Route::resource('user', UserController::class);
    });
    
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
