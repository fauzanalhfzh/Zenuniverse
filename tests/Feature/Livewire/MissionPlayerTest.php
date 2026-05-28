<?php

use App\Livewire\Missions\MissionPlayer;
use App\Models\Lesson;
use App\Models\MissionSlide;
use App\Models\User;
use App\Models\UserProgress;
use Livewire\Livewire;

test('mission loads with correct slug', function () {
    $user = User::factory()->create();
    $lesson = Lesson::factory()->create(['slug' => 'test-mission']);
    MissionSlide::factory()->create(['lesson_id' => $lesson->id, 'type' => 'intro', 'order' => 1]);

    Livewire::actingAs($user)
        ->test(MissionPlayer::class, ['slug' => 'test-mission'])
        ->assertSet('mission.id', $lesson->id)
        ->assertSet('step', 0);
});

test('invalid slug returns 404', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/missions/nonexistent-slug')->assertNotFound();
});

test('user with 0 hearts is redirected', function () {
    $user = User::factory()->create(['hearts' => 0]);
    $lesson = Lesson::factory()->create(['slug' => 'test-mission']);
    MissionSlide::factory()->create(['lesson_id' => $lesson->id, 'type' => 'intro']);

    Livewire::actingAs($user)
        ->test(MissionPlayer::class, ['slug' => 'test-mission'])
        ->assertRedirect(route('dashboard'));
});

test('mission with no slides redirects to dashboard', function () {
    $user = User::factory()->create();
    $lesson = Lesson::factory()->create(['slug' => 'empty-mission']);
    // No slides created

    Livewire::actingAs($user)
        ->test(MissionPlayer::class, ['slug' => 'empty-mission'])
        ->assertRedirect(route('dashboard'));
});

test('correct quiz answer awards XP', function () {
    $user = User::factory()->create(['hearts' => 5]);
    $lesson = Lesson::factory()->create(['slug' => 'quiz-mission']);

    MissionSlide::factory()->create([
        'lesson_id' => $lesson->id,
        'type' => 'quiz',
        'options' => [
            ['id' => 1, 'text' => 'Correct', 'correct' => true],
            ['id' => 2, 'text' => 'Wrong', 'correct' => false],
        ],
        'order' => 1,
    ]);

    Livewire::actingAs($user)
        ->test(MissionPlayer::class, ['slug' => 'quiz-mission'])
        ->set('selectedAnswer', 1)
        ->call('checkAnswer')
        ->assertSet('isCorrect', true)
        ->assertSet('earnedXp', 10);
});

test('incorrect quiz answer deducts heart', function () {
    $user = User::factory()->create(['hearts' => 5]);
    $lesson = Lesson::factory()->create(['slug' => 'quiz-mission-wrong']);

    MissionSlide::factory()->create([
        'lesson_id' => $lesson->id,
        'type' => 'quiz',
        'options' => [
            ['id' => 1, 'text' => 'Correct', 'correct' => true],
            ['id' => 2, 'text' => 'Wrong', 'correct' => false],
        ],
        'order' => 1,
    ]);

    Livewire::actingAs($user)
        ->test(MissionPlayer::class, ['slug' => 'quiz-mission-wrong'])
        ->set('selectedAnswer', 2)
        ->call('checkAnswer')
        ->assertSet('isCorrect', false);

    $user->refresh();
    expect($user->hearts)->toBe(4);
});

test('game over when hearts reach 0', function () {
    $user = User::factory()->create(['hearts' => 1]);
    $lesson = Lesson::factory()->create(['slug' => 'gameover-mission']);

    MissionSlide::factory()->create([
        'lesson_id' => $lesson->id,
        'type' => 'quiz',
        'options' => [
            ['id' => 1, 'text' => 'Correct', 'correct' => true],
            ['id' => 2, 'text' => 'Wrong', 'correct' => false],
        ],
        'order' => 1,
    ]);

    Livewire::actingAs($user)
        ->test(MissionPlayer::class, ['slug' => 'gameover-mission'])
        ->set('selectedAnswer', 2)
        ->call('checkAnswer')
        ->assertSet('showGameOver', true);

    $user->refresh();
    expect($user->hearts)->toBe(0);
});

test('nextStep advances to next slide', function () {
    $user = User::factory()->create();
    $lesson = Lesson::factory()->create(['slug' => 'multi-slide']);

    MissionSlide::factory()->create(['lesson_id' => $lesson->id, 'type' => 'intro', 'order' => 1]);
    MissionSlide::factory()->create(['lesson_id' => $lesson->id, 'type' => 'intro', 'order' => 2]);

    Livewire::actingAs($user)
        ->test(MissionPlayer::class, ['slug' => 'multi-slide'])
        ->assertSet('step', 0)
        ->call('nextStep')
        ->assertSet('step', 1);
});

test('mission completion triggers completeMission service', function () {
    $user = User::factory()->create(['total_xp' => 0, 'current_xp' => 0]);
    $lesson = Lesson::factory()->create(['slug' => 'complete-mission', 'xp_reward' => 50]);

    MissionSlide::factory()->create(['lesson_id' => $lesson->id, 'type' => 'intro', 'order' => 1]);

    Livewire::actingAs($user)
        ->test(MissionPlayer::class, ['slug' => 'complete-mission'])
        ->call('nextStep') // Only 1 slide, so this triggers completion
        ->assertSet('showCompletion', true);

    expect(UserProgress::where('user_id', $user->id)->where('lesson_id', $lesson->id)->exists())->toBeTrue();
});

test('code_arrange minigame validation works', function () {
    $user = User::factory()->create(['hearts' => 5]);
    $lesson = Lesson::factory()->create(['slug' => 'arrange-mission']);

    MissionSlide::factory()->create([
        'lesson_id' => $lesson->id,
        'type' => 'code_arrange',
        'options' => [
            ['id' => 0, 'text' => 'line 1'],
            ['id' => 1, 'text' => 'line 2'],
            ['id' => 2, 'text' => 'line 3'],
        ],
        'order' => 1,
    ]);

    // Correct order: IDs match their indices
    $component = Livewire::actingAs($user)
        ->test(MissionPlayer::class, ['slug' => 'arrange-mission']);

    // Set blocks to correct order
    $component->call('updateBlockOrder', [0, 1, 2])
        ->call('checkMinigame')
        ->assertSet('isCorrect', true);
});
