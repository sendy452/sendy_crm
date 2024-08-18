<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;

Route::group([
    'middleware' => 'web'
], function ($router) {
    //Dashboard
    Route::get('/', [DashboardController::class, 'index']); 

    //Login
    Route::get('signin', [UserController::class, 'index'])->name('signin');
    Route::post('signin-auth', [UserController::class, 'signin'])->name('signin.auth'); 
    Route::get('signout', [UserController::class, 'signout'])->name('signout');
});

Route::middleware(['auth'])->group(function () {
    //Profile
    Route::get('profile', [ProfilController::class, 'index']);
    Route::put('profile-change', [ProfilController::class, 'profileChange'])->name('profile.change');
    Route::put('pass-change', [ProfilController::class, 'passChange'])->name('pass.change'); 

    //Lead Data
    Route::get('list-lead', [LeadController::class, 'index']);
    Route::post('add-lead', [LeadController::class, 'addLead'])->name('add.lead'); 
    Route::get('delete-lead/{idlead}', [LeadController::class, 'deleteLead']);
    Route::get('ubah-lead', [LeadController::class, 'ubahLead']); 
    Route::put('change-lead', [LeadController::class, 'changeLead'])->name('change.lead'); 

    //Karyawan Data
    Route::get('list-karyawan', [KaryawanController::class, 'index']);
    Route::post('add-karyawan', [KaryawanController::class, 'addKaryawan'])->name('add.karyawan'); 
    Route::get('delete-karyawan/{idkaryawan}', [KaryawanController::class, 'deleteKaryawan']);
    Route::get('approve-karyawan/{idkaryawan}', [KaryawanController::class, 'approveKaryawan']); 
    Route::get('ubah-karyawan', [KaryawanController::class, 'ubahKaryawan']); 
    Route::put('change-karyawan', [KaryawanController::class, 'changeKaryawan'])->name('change.karyawan'); 

    //Role Data
    Route::get('list-role', [RoleController::class, 'index']);
    Route::post('add-role', [RoleController::class, 'addRole'])->name('add.role'); 
    Route::get('delete-role/{idrole}', [RoleController::class, 'deleteRole']);
    Route::get('approve-role/{idrole}', [RoleController::class, 'approveRole']); 
    Route::get('ubah-role', [RoleController::class, 'ubahRole']); 
    Route::put('change-role', [RoleController::class, 'changeRole'])->name('change.role');

    //Service Data
    Route::get('list-service', [ServiceController::class, 'index']);
    Route::post('add-service', [ServiceController::class, 'addService'])->name('add.service'); 
    Route::get('delete-service/{idservice}', [ServiceController::class, 'deleteService']);
    Route::get('ubah-service', [ServiceController::class, 'ubahService']); 
    Route::put('change-service', [ServiceController::class, 'changeService'])->name('change.service');

    //Project Data
    Route::get('list-project', [ProjectController::class, 'index']);
    Route::post('add-project', [ProjectController::class, 'addProject'])->name('add.project'); 
    Route::get('delete-project/{idproject}', [ProjectController::class, 'deleteProject']);
    Route::get('approve-project/{idproject}', [ProjectController::class, 'approveProject']);
    Route::get('ubah-project', [ProjectController::class, 'ubahProject']); 
    Route::put('change-project', [ProjectController::class, 'changeProject'])->name('change.project'); 

    //Customer Data
    Route::get('list-customer', [CustomerController::class, 'index']);
    Route::get('ubah-customer', [CustomerController::class, 'ubahCustomer']); 
    Route::put('change-customer', [CustomerController::class, 'changeCustomer'])->name('change.customer'); 
});