<?php

use App\Http\Controllers\Admin\{
    AuthAdminUserController,
    ManageAdminUserController,
};
use App\Http\Controllers\AuditLog\{
    AuditLogController,
    IpAuditLogController,
    UserAuditLogController,
};
use App\Http\Controllers\IpRecord\{
    ManageIpAddressController,
    ViewIpAddressController,
};
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::prefix('')
    ->name('auth.')
    ->group(function () {
        Route::post('/login', [AuthAdminUserController::class, 'login'])->name('login');
        Route::post('/refresh', [AuthAdminUserController::class, 'refresh'])->name('refresh');
        Route::post('/logout', [AuthAdminUserController::class, 'logout'])->name('logout')->middleware('auth:api');
    });

// Manage Admin Accounts Routes
Route::prefix('users')
    ->name('users.')
    ->middleware('auth:api')
    ->group(function () {
        Route::post('/create', [ManageAdminUserController::class, 'create'])->name('create');
    });

// Audit Log Routes
Route::prefix('audit-log')
    ->name('audit-log.')
    ->middleware('auth:api')
    ->group(function () {

        // Create Logs
        Route::post('/create', [AuditLogController::class, 'create'])->name('create');

        // View Logs based on IP Address
        Route::prefix('ip')
        ->name('ip.')
        ->group(function () {
            Route::get('/', [IpAuditLogController::class, 'list'])->name('list');
            Route::get('/view', [IpAuditLogController::class, 'view'])->name('view');
        });

        // View Logs based on User
        Route::prefix('user')
        ->name('user.')
        ->group(function () {
            Route::get('/', [UserAuditLogController::class, 'list'])->name('list');
            Route::get('/view', [UserAuditLogController::class, 'view'])->name('view');
        });

    });

// IP Record Routes
Route::prefix('ip-record')
    ->name('ip-record.')
    ->middleware('auth:api')
    ->group(function () {

        // View Ip Addresses
        Route::get('/', [ViewIpAddressController::class, 'list'])->name('list');
        Route::get('/{ipRecord}/view', [ViewIpAddressController::class, 'view'])->name('view');

        // Manage Ip Addresses
        Route::post('/create', [ManageIpAddressController::class, 'create'])->name('create');
        Route::put('/edit', [ManageIpAddressController::class, 'edit'])->name('edit');
        Route::delete('/delete', [ManageIpAddressController::class, 'delete'])->name('delete');
    });
