<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Question;

class QuestionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testQuestion()
    {
        $question = Question::orderBy('id', 'DESC')->first();
        $this->assertGreaterThan(0, $question->id);
    }
}
