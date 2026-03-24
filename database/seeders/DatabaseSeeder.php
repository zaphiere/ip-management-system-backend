<?php

namespace Database\Seeders;

use Database\Seeders\InitialDatabaseSeeder\{
    AuditLogSeeder,
    IpRecordSeeder,
    UserSeeder,
};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            IpRecordSeeder::class,
            // AuditLogSeeder::class,
        ]);
    }
}
