<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blocks')->insert([
            ['description' => '1', 'id_academic_semester' => 1],
            ['description' => '2', 'id_academic_semester' => 1],
        ]);
    }
}
