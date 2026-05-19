<?php

namespace Database\Seeders\Traits;

trait CreatesQuiz
{
    private function createQuiz($lesson, $order, $question, $options)
    {
        $lesson->slides()->firstOrCreate(
            ['order' => $order],
            [
                'type' => 'quiz',
                'title' => 'Kuis',
                'content' => $question,
                'options' => $options,
            ]);
    }
}
