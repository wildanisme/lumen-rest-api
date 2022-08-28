<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Tutorial',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Informasi',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Artikel Bebas',
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
