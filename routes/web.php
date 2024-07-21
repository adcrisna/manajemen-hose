<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperAdminController;

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

Route::any('/', [LoginController::class, 'login'])->name('login');
Route::any('/proses_login', [LoginController::class, 'prosesLogin'])->name('prosesLogin');
Route::any('/logout', [LoginController::class, 'logout'])->name('logout');
Route::any('/laporan_hose', [LoginController::class, 'pdfProduct'])->name('pdfProduct');
Route::any('/laporan_hose/{id}', [LoginController::class, 'pdfProductByID'])->name('pdfProductByID');
Route::any('/laporan_history', [LoginController::class, 'pdfHistory'])->name('pdfHistory');

Route::middleware(['auth'])->group(function () {
    Route::prefix('superadmin')->middleware(['superadmin'])->group(function () {
        Route::any('/home', [SuperAdminController::class, 'index'])->name('superadmin.index');
        Route::any('/profile', [SuperAdminController::class, 'profile'])->name('superadmin.profile');
        Route::any('/update_profile', [SuperAdminController::class, 'updateProfile'])->name('superadmin.updateProfile');
        Route::any('/gudang', [SuperAdminController::class, 'gudang'])->name('superadmin.gudang');
        Route::any('/add_gudang', [SuperAdminController::class, 'addGudang'])->name('superadmin.addGudang');
        Route::any('/update_gudang', [SuperAdminController::class, 'updateGudang'])->name('superadmin.updateGudang');
        Route::any('/delete_gudang/{id}', [SuperAdminController::class, 'deleteGudang'])->name('superadmin.deleteGudang');
        Route::any('/admin', [SuperAdminController::class, 'admin'])->name('superadmin.admin');
        Route::any('/add_admin', [SuperAdminController::class, 'addAdmin'])->name('superadmin.addAdmin');
        Route::any('/update_admin', [SuperAdminController::class, 'updateAdmin'])->name('superadmin.updateAdmin');
        Route::any('/delete_admin/{id}', [SuperAdminController::class, 'deleteAdmin'])->name('superadmin.deleteAdmin');
        Route::any('/machine', [SuperAdminController::class, 'machine'])->name('superadmin.machine');
        Route::any('/add_machine', [SuperAdminController::class, 'addMachine'])->name('superadmin.addMachine');
        Route::any('/update_machine', [SuperAdminController::class, 'updateMachine'])->name('superadmin.updateMachine');
        Route::any('/delete_machine/{id}', [SuperAdminController::class, 'deleteMachine'])->name('superadmin.deleteMachine');
        Route::any('/hose', [SuperAdminController::class, 'hose'])->name('superadmin.hose');
        Route::any('/add_hose', [SuperAdminController::class, 'addHose'])->name('superadmin.addHose');
        Route::any('/update_hose', [SuperAdminController::class, 'updateHose'])->name('superadmin.updateHose');
        Route::any('/delete_hose/{id}', [SuperAdminController::class, 'deleteHose'])->name('superadmin.deleteHose');
        Route::any('/history', [SuperAdminController::class, 'history'])->name('superadmin.history');
        Route::any('/update_stock', [SuperAdminController::class, 'updateStock'])->name('superadmin.updateStock');
        Route::any('/detail_hose/{id}', [SuperAdminController::class, 'detailHose'])->name('superadmin.detailHose');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->middleware(['admin'])->group(function () {
        Route::any('/home', [AdminController::class, 'index'])->name('admin.index');
        Route::any('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::any('/update_profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
        Route::any('/user', [AdminController::class, 'user'])->name('admin.user');
        Route::any('/add_user', [AdminController::class, 'addUser'])->name('admin.addUser');
        Route::any('/update_user', [AdminController::class, 'updateUser'])->name('admin.updateUser');
        Route::any('/delete_user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
        Route::any('/hose', [AdminController::class, 'hose'])->name('admin.hose');
        Route::any('/add_hose', [AdminController::class, 'addHose'])->name('admin.addHose');
        Route::any('/update_hose', [AdminController::class, 'updateHose'])->name('admin.updateHose');
        Route::any('/delete_hose/{id}', [AdminController::class, 'deleteHose'])->name('admin.deleteHose');
        Route::any('/history', [AdminController::class, 'history'])->name('admin.history');
        Route::any('/update_stock', [AdminController::class, 'updateStock'])->name('admin.updateStock');
        Route::any('/machine', [AdminController::class, 'machine'])->name('admin.machine');
        Route::any('/add_machine', [AdminController::class, 'addMachine'])->name('admin.addMachine');
        Route::any('/update_machine', [AdminController::class, 'updateMachine'])->name('admin.updateMachine');
        Route::any('/delete_machine/{id}', [AdminController::class, 'deleteMachine'])->name('admin.deleteMachine');
        Route::any('/detail_hose/{id}', [AdminController::class, 'detailHose'])->name('admin.detailHose');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('user')->middleware(['user'])->group(function () {
        Route::any('/home', [UserController::class, 'index'])->name('user.index');
        Route::any('/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::any('/update_profile', [UserController::class, 'updateProfile'])->name('user.updateProfile');
        Route::any('/hose', [UserController::class, 'hose'])->name('user.hose');
        Route::any('/detail_hose/{id}', [UserController::class, 'detailHose'])->name('user.detailHose');
        Route::any('/machine', [UserController::class, 'machine'])->name('user.machine');
    });
});
