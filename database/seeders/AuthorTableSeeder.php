<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('authors')->insert(array(
            array(
                'id' => Str::uuid(),
                'name' => 'Angel',
                'dob' => Carbon::now()->format('Y-m-d'),
                'age' => '20',
                'address' => 'Jl. sana sini'
            ),
            array(
                'id' => Str::uuid(),
                'name' => 'Cowboy',
                'dob' => Carbon::now()->format('Y-m-d'),
                'age' => '20',
                'address' => 'Jl. sana sini'
            ),
            array(
                'id' => Str::uuid(),
                'name' => 'Demon',
                'dob' => Carbon::now()->format('Y-m-d'),
                'age' => '20',
                'address' => 'Jl. sana sini'
            )
        ));
    }
}
