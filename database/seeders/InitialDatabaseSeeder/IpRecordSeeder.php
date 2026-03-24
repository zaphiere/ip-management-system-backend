<?php

namespace Database\Seeders\InitialDatabaseSeeder;

use App\Models\IpRecord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IpRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IpRecord::factory(config('const.seeder_data_count'))->create();
    }
}
