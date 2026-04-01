<?php

use App\Http\Controllers\Admin\{
    AuthAdminUserController,
    ManageAdminUserController,
};
use App\Http\Controllers\AuditLog\{
    ViewAuditLogController,
    OptionAuditLogController,
};
use App\Http\Controllers\IpRecord\{
    ManageIpAddressController,
    ViewIpAddressController,
};
use App\Http\Middleware\SuperAdminAccessMiddleware;
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
    ->middleware('auth:api', SuperAdminAccessMiddleware::class)
    ->group(function () {
        Route::post('/create', [ManageAdminUserController::class, 'create'])->name('create');
    });

// Audit Log Routes
Route::prefix('audit-log')
    ->name('audit-log.')
    ->middleware('auth:api', SuperAdminAccessMiddleware::class)
    ->group(function () {

        Route::get('/', [ViewAuditLogController::class, 'list'])->name('list');
        Route::get('{auditLog}/view', [ViewAuditLogController::class, 'view'])->name('view');

        // Dropdown content
        Route::prefix('options')
        ->name('options.')
        ->group(function () {
            Route::get('/get-ip-address', [OptionAuditLogController::class, 'getIp'])->name('getIp');
            Route::get('/get-email', [OptionAuditLogController::class, 'getEmail'])->name('getEmail');
            Route::get('/get-session-id', [OptionAuditLogController::class, 'getSessionId'])->name('getSessionId');
            Route::get('/get-action', [OptionAuditLogController::class, 'getAction'])->name('getAction');
            Route::get('/get-entity-type', [OptionAuditLogController::class, 'getEntityType'])->name('getEntityType');
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
        Route::put('/{ipRecord}/edit', [ManageIpAddressController::class, 'edit'])
            ->middleware('can:update,ipRecord')
            ->name('edit');
        Route::delete('/{ipRecord}/delete', [ManageIpAddressController::class, 'delete'])
            ->middleware('can:delete,ipRecord')
            ->name('delete');
    });
