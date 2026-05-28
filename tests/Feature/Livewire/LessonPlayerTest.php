<?php

use App\Livewire\LessonPlayer;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\User;
use App\Models\UserProgress;
use Livewire\Livewire;

test('authenticated user can access lesson player', function () {
    $user = User::factory()->create();
    $lesson = Lesson::factory()->create();

    $this->actingAs($user)->get("/lesson/{$lesson->id}")->assertOk();
});

test('unauthenticated user is redirected', function () {
    $lesson = Lesson::factory()->create();

    $this->get("/lesson/{$lesson->id}")->assertRedirect('/login');
});

test('lesson loads with questions', function () {
    $user = User::factory()->create();
    $lesson = Lesson::factory()->create();
    $question = Question::factory()->create(['lesson_id' => $lesson->id]);

    Livewire::actingAs($user)
        ->test(LessonPlayer::class, ['lesson' => $lesson])
        ->assertSet('lesson.id', $lesson->id);
});

test('startQuiz sets quiz mode', function () {
    $user = User::factory()->create();
    $lesson = Lesson::factory()->create();
    Question::factory()->create(['lesson_id' => $lesson->id]);

    Livewire::actingAs($user)
        ->test(LessonPlayer::class, ['lesson' => $lesson])
        ->call('startQuiz')
        ->assertSet('isQuizMode', true);
});

test('startQuiz auto-completes when no questions', function () {
    $user = User::factory()->create();
    $lesson = Lesson::factory()->create();
    // No questions created

    Livewire::actingAs($user)
        ->test(LessonPlayer::class, ['lesson' => $lesson])
        ->call('startQuiz');

    // Lesson should be completed since there are no questions
    expect(UserProgress::where('user_id', $user->id)->where('lesson_id', $lesson->id)->exists())->toBeTrue();
});

test('selectAnswer stores user answer', function () {
    $user = User::factory()->create();
    $lesson = Lesson::factory()->create();
    $question = Question::factory()->create([
        'lesson_id' => $lesson->id,
        'correct_answer' => 'A',
    ]);

    Livewire::actingAs($user)
        ->test(LessonPlayer::class, ['lesson' => $lesson])
        ->call('selectAnswer', $question->id, 'B')
        ->assertSet("userAnswers.{$question->id}", 'B');
});

test('submitQuiz with 100% score completes lesson', function () {
    $user = User::factory()->create(['total_xp' => 0]);
    $lesson = Lesson::factory()->create(['xp_reward' => 20]);
    $q1 = Question::factory()->create(['lesson_id' => $lesson->id, 'correct_answer' => 'A']);
    $q2 = Question::factory()->create(['lesson_id' => $lesson->id, 'correct_answer' => 'B']);

    Livewire::actingAs($user)
        ->test(LessonPlayer::class, ['lesson' => $lesson])
        ->call('startQuiz')
        ->call('selectAnswer', $q1->id, 'A')
        ->call('selectAnswer', $q2->id, 'B')
        ->call('submitQuiz')
        ->assertSet('quizCompleted', true)
        ->assertSet('score', 100);

    expect(UserProgress::where('user_id', $user->id)->where('lesson_id', $lesson->id)->exists())->toBeTrue();
});

test('submitQuiz with below 70% does NOT complete lesson', function () {
    $user = User::factory()->create();
    $lesson = Lesson::factory()->create();
    $q1 = Question::factory()->create(['lesson_id' => $lesson->id, 'correct_answer' => 'A']);
    $q2 = Question::factory()->create(['lesson_id' => $lesson->id, 'correct_answer' => 'B']);
    $q3 = Question::factory()->create(['lesson_id' => $lesson->id, 'correct_answer' => 'C']);

    Livewire::actingAs($user)
        ->test(LessonPlayer::class, ['lesson' => $lesson])
        ->call('startQuiz')
        ->call('selectAnswer', $q1->id, 'A')  // correct
        ->call('selectAnswer', $q2->id, 'X')  // wrong
        ->call('selectAnswer', $q3->id, 'X')  // wrong
        ->call('submitQuiz')
        ->assertSet('quizCompleted', true);

    // Score = 33%, lesson NOT completed
    expect(UserProgress::where('user_id', $user->id)->where('lesson_id', $lesson->id)->exists())->toBeFalse();
});

test('next and previous lesson properties work', function () {
    $user = User::factory()->create();
    $course = Course::factory()->create();
    $lesson1 = Lesson::factory()->create(['course_id' => $course->id, 'order' => 1]);
    $lesson2 = Lesson::factory()->create(['course_id' => $course->id, 'order' => 2]);
    $lesson3 = Lesson::factory()->create(['course_id' => $course->id, 'order' => 3]);

    $component = Livewire::actingAs($user)
        ->test(LessonPlayer::class, ['lesson' => $lesson2]);

    expect($component->get('nextLesson')->id)->toBe($lesson3->id);
    expect($component->get('prevLesson')->id)->toBe($lesson1->id);
});
