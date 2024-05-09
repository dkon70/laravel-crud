<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class SpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        DB::table('spots')->insert([
            'name' => Str::random(mt_rand(3, 15)),
            'latitude' => $faker->randomFloat(8, -90, 90),
            'longitude' => $faker->randomFloat(8, -180, 180),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
