<?php

use App\Models\Course;
use App\Models\Lesson;
use App\Models\MissionSlide;
use App\Models\Question;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('lesson belongs to a course', function () {
    $course = Course::factory()->create();
    $lesson = Lesson::factory()->create(['course_id' => $course->id]);

    expect($lesson->course)->toBeInstanceOf(Course::class);
    expect($lesson->course->id)->toBe($course->id);
});

test('lesson has many questions ordered by order', function () {
    $lesson = Lesson::factory()->create();
    Question::factory()->create(['lesson_id' => $lesson->id, 'order' => 3]);
    Question::factory()->create(['lesson_id' => $lesson->id, 'order' => 1]);
    Question::factory()->create(['lesson_id' => $lesson->id, 'order' => 2]);

    $questions = $lesson->questions;

    expect($questions)->toHaveCount(3);
    expect($questions->first()->order)->toBe(1);
    expect($questions->last()->order)->toBe(3);
});

test('lesson has many mission slides ordered by order', function () {
    $lesson = Lesson::factory()->create();
    MissionSlide::factory()->create(['lesson_id' => $lesson->id, 'order' => 2]);
    MissionSlide::factory()->create(['lesson_id' => $lesson->id, 'order' => 1]);

    $slides = $lesson->slides;

    expect($slides)->toHaveCount(2);
    expect($slides->first()->order)->toBe(1);
});

test('lesson has correct fillable attributes', function () {
    $lesson = new Lesson();

    expect($lesson->getFillable())->toEqual([
        'course_id', 'title', 'slug', 'icon', 'content', 'video_url', 'order', 'xp_reward',
    ]);
});
