<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

it('should be able create a new question bigger than 255 characters', function () {
    // Arrange -> Preparar
    $user = User::factory()->create();
    actingAs($user);

    // Act -> Ação
    $data = [
        'question' => str_repeat('*', 260) . '?'
    ];
    $request = post(route('question.store'), $data);

    // Assert -> Verificar
    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', $data);
});

it('should check if ends with a question mark ?', function () {
    // Arrange
    $user = User::factory()->create();
    actingAs($user);

    // Act
    $data = [
        'question' => str_repeat('*', 30)
    ];
    $request = post(route('question.store'), $data);

    // Assert
    $request->assertSessionHasErrors(['question' => 'Are you sure that is a question ?']);
    assertDatabaseCount('questions', 0);
});

it('should have at least 10 characters', function () {
    // Arrange
    $user = User::factory()->create();
    actingAs($user);

    // Act
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8)
    ]);

    // Assert
    $request->assertSessionHasErrors('question');
    assertDatabaseCount('questions', 0);
});
