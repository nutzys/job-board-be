<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SenioritySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('seniority')->insert([
            ['name' => 'Junior'],
            ['name' => 'Mid'],
            ['name' => 'Senior'],
        ]);
    }
}
