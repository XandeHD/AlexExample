<?php

namespace Database\Seeders;

use App\Models\Sample;
use App\Models\SampleTests;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SampleTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        SampleTests::factory()->count(1000)->create();
    }
}
