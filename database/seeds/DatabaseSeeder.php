<?php

use Illuminate\Database\Seeder;
use Faker\Provider\Lorem;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Faker\Provider\zh_CN\Internet;
use Faker\Generator;

class DatabaseSeeder extends Seeder
{
    /**
     * 问题
     *
     * @var Question
     */
    protected $question = null;

    /**
     * 答案
     *
     * @var Answer[]
     */
    protected $answer = null;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(FakerSeeder::class);
        $this->fakeUser(5);
        $this->fakeQuestion();
    }

    public function fakeUser($times = 5)
    {
        for ($i = 0; $i < $times; $i ++) {
            $faker = \Faker\Factory::create();

            $user = new User();
            $user->name = $faker->userName;
            $user->email = $faker->email;
            $user->password = password_hash('123456', 1);
            $user->save();
        }
    }

    public function fakeQuestion($times = 1)
    {
        for ($i = 0; $i < $times; $i++) {
            $this->question = new Question();
            $this->question->title = Lorem::sentence(5);
            $this->question->content = Lorem::text(120);
            $this->question->user()->associate(User::inRandomOrder()->firstOrFail());
            $this->question->save();
            $this->fakeAnswer(3);
        }
    }

    public function fakeAnswer($times = 1)
    {
        for ($i = 0; $i < $times; $i++) {
            $answer = new Answer();
            $answer->question()->associate($this->question);
            $answer->user()->associate(User::inRandomOrder()->firstOrFail());
            $answer->content = Lorem::text(240);
            $answer->save();

            $this->answer[] = $answer;
        }
    }
}
