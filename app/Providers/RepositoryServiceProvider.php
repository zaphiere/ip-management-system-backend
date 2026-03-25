<?php

namespace App\Providers;

use App\Interfaces\{
    AuditLogInterface,
    IpRecordInterface,
    UserInterface,
};
use App\Repositories\{
    AuditLogRepository,
    IpRecordRepository,
    UserRepository,
};

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuditLogInterface::class, AuditLogRepository::class);
        $this->app->bind(IpRecordInterface::class, IpRecordRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
