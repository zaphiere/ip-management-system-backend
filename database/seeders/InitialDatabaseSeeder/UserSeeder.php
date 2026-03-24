<?php

namespace Database\Seeders\InitialDatabaseSeeder;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{
    DB,
    Hash
};
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin User
        User::factory()->create([
            'email' => 'superadmin@test.com',
            'role' => Role::SUPER_ADMIN,
        ]);

        // Admin User
        User::factory()->create([
            'email' => 'admin@test.com',
            'role' => Role::ADMIN,
        ]);

        // Random Users
        User::factory(config('const.seeder_data_count'))->create();
    }
}
