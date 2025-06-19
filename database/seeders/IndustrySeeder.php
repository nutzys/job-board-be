<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndustrySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('industries')->insert([
            ['name' => 'Technology'],
            ['name' => 'Finance'],
            ['name' => 'Healthcare'],
            ['name' => 'Education'],
            ['name' => 'Retail'],
        ]);
    }
}
