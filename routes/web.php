<?php

use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\LocationController as AdminLocationController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemCheckController;
use App\Http\Controllers\LocationController;

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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Home route (redirect after login)
Route::get('/home', function () {
    return view('welcome');
})->name('home')->middleware('auth');
Route::middleware(['auth'])->group(function () {
    // Menampilkan daftar lokasi
    Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');

    // Menampilkan form pengecekan barang di lokasi tertentu
    Route::get('locations/{location}/item-checks/create', [ItemCheckController::class, 'create'])->name('item_checks.create');
    Route::post('locations/{location}/item-checks', [ItemCheckController::class, 'store'])->name('item_checks.store');
    Route::get('locations/{location}/item-checks/history', [ItemCheckController::class, 'history'])->name('item_checks.history');
});
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('divisions', DivisionController::class);
    Route::resource('inventory', InventoryController::class);
    Route::resource('locations', AdminLocationController::class);
    Route::get('alokasi', [AdminLocationController::class, 'indexadd'])->name('alokasi.index');
    Route::get('locations/{location}/addinventories', [AdminLocationController::class, 'addinventories'])->name('location.inventories');
    Route::post('locations/{location}/addinventories/action', [AdminLocationController::class, 'addaction'])->name('location.action.inventories');
    Route::resource('suppliers', SupplierController::class);
    Route::resource('units', UnitController::class);
    Route::resource('users', UserController::class);
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});
