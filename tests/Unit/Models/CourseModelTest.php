<?php

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Level;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('course belongs to a level', function () {
    $level = Level::factory()->create();
    $course = Course::factory()->create(['level_id' => $level->id]);

    expect($course->level)->toBeInstanceOf(Level::class);
    expect($course->level->id)->toBe($level->id);
});

test('course has many lessons ordered by order', function () {
    $course = Course::factory()->create();
    $lesson3 = Lesson::factory()->create(['course_id' => $course->id, 'order' => 3]);
    $lesson1 = Lesson::factory()->create(['course_id' => $course->id, 'order' => 1]);
    $lesson2 = Lesson::factory()->create(['course_id' => $course->id, 'order' => 2]);

    $lessons = $course->lessons;

    expect($lessons)->toHaveCount(3);
    expect($lessons->first()->order)->toBe(1);
    expect($lessons->last()->order)->toBe(3);
});

test('course has correct fillable attributes', function () {
    $course = new Course();

    expect($course->getFillable())->toEqual([
        'level_id', 'title', 'type', 'description', 'icon', 'order', 'xp_reward',
    ]);
});
