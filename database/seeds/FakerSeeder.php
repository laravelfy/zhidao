<?php

use Illuminate\Database\Seeder;
use App\Models\Question;
use Faker\Provider\Lorem;
use App\Models\User;

class FakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->fakeQuestion();
    }
