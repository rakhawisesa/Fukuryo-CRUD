<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert(array(
            array(
                'id' => Str::uuid(),
                'name' => 'Manga',
                'description' => 'Ini adalah manga',
                'status' => 'enable'
            ),
            array(
                'id' => Str::uuid(),
                'name' => 'Novel',
                'description' => 'Ini adalah novel',
                'status' => 'enable'
            ),
            array(
                'id' => Str::uuid(),
                'name' => 'Scifi',
                'description' => 'Ini adalah scifi',
                'status' => 'disable'
            )
        ));
    }
}
