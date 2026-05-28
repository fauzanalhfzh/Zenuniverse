<?php

use App\Models\Course;
use App\Models\Lesson;
use App\Models\MissionSlide;
use App\Models\Post;
use App\Models\Question;
use App\Models\User;
use App\Models\UserProgress;

test('deleting user removes their progress records', function () {
    $user = User::factory()->create();
    $lesson = Lesson::factory()->create();
    UserProgress::factory()->create(['user_id' => $user->id, 'lesson_id' => $lesson->id]);

    expect(UserProgress::where('user_id', $user->id)->count())->toBe(1);

    $user->delete();

    expect(UserProgress::where('user_id', $user->id)->count())->toBe(0);
});

test('deleting course removes its lessons', function () {
    $course = Course::factory()->create();
    $lesson = Lesson::factory()->create(['course_id' => $course->id]);

    expect(Lesson::where('course_id', $course->id)->count())->toBe(1);

    $course->delete();

    expect(Lesson::where('course_id', $course->id)->count())->toBe(0);
});

test('deleting lesson removes its questions and slides', function () {
    $lesson = Lesson::factory()->create();
    Question::factory()->create(['lesson_id' => $lesson->id]);
    MissionSlide::factory()->create(['lesson_id' => $lesson->id]);

    $lesson->delete();

    expect(Question::where('lesson_id', $lesson->id)->count())->toBe(0);
    expect(MissionSlide::where('lesson_id', $lesson->id)->count())->toBe(0);
});

test('duplicate post slugs are rejected', function () {
    $user = User::factory()->create();
    Post::factory()->create(['author_id' => $user->id, 'slug' => 'unique-slug']);

    expect(fn () => Post::factory()->create(['author_id' => $user->id, 'slug' => 'unique-slug']))
        ->toThrow(\Illuminate\Database\QueryException::class);
});

test('duplicate user emails are rejected', function () {
    User::factory()->create(['email' => 'duplicate@test.com']);

    expect(fn () => User::factory()->create(['email' => 'duplicate@test.com']))
        ->toThrow(\Illuminate\Database\QueryException::class);
});

test('deleting user cascades to badge_user pivot', function () {
    $user = User::factory()->create();
    $badge = \App\Models\Badge::factory()->create();
    $user->badges()->attach($badge->id, ['unlocked_at' => now()]);

    expect(\DB::table('badge_user')->where('user_id', $user->id)->count())->toBe(1);

    $user->delete();

    expect(\DB::table('badge_user')->where('user_id', $user->id)->count())->toBe(0);
});
