<?php

use App\Models\Question;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

it('should be able to like a question', function () {
    $user = User::factory()->create();
    $question = Question::factory()->create();

    actingAs($user);

    post(route('question.like', $question));

    assertDatabaseHas('votes', [
        'user_id' => $user->id,
        'likes' => 1,
        'dislikes' => 0
    ]);
});

it('should not be able to like more than 1 time', function () {
    $user = User::factory()->create();
    $question = Question::factory()->create();

    actingAs($user);

    post(route('question.like', $question));
    post(route('question.like', $question));
    post(route('question.like', $question));

    expect(user()->votes()->where('question_id', '=', $question->id)->get())->toHaveCount(1);
});

it('should not be able to dislike more than 1 time', function () {
    $user = User::factory()->create();
    $question = Question::factory()->create();

    actingAs($user);

    post(route('question.dislike', $question));
    post(route('question.dislike', $question));
    post(route('question.dislike', $question));

    expect(user()->votes()->where('question_id', '=', $question->id)->get())->toHaveCount(1);
});
