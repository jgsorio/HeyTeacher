<?php

use App\Models\Question;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('should list all the questions', function () {
    $questions = Question::factory(2)->create([
        'question' => fake()->sentence(50)
    ]);
    $user = User::factory()->create();
    actingAs($user);

    $response = get(route('dashboard'));

    $response->assertOk();
    /**
     * @var Question $question
     */
    foreach ($questions as $question) {
        $response->assertSee($question->question);
    }
});
