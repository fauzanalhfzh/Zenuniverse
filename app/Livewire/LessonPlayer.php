<?php

namespace App\Livewire;

use App\Models\Lesson;
use App\Services\LessonService;
use Livewire\Attributes\Layout;
use Livewire\Component;

class LessonPlayer extends Component
{
    public Lesson $lesson;

    public bool $isQuizMode = false;

    public int $currentQuestionIndex = 0;

    public array $userAnswers = [];

    public int $score = 0;

    public bool $quizCompleted = false;

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson->load('questions');
    }

    public function startQuiz()
    {
        if ($this->lesson->questions->isEmpty()) {
            $this->completeLesson(); // Auto complete jika tidak ada soal

            return;
        }
        $this->isQuizMode = true;
    }

    public function selectAnswer($questionId, $answer)
    {
        $this->userAnswers[$questionId] = $answer;
    }

    public function submitQuiz()
    {
        $correctCount = 0;
        foreach ($this->lesson->questions as $question) {
            if (isset($this->userAnswers[$question->id]) && $this->userAnswers[$question->id] === $question->correct_answer) {
                $correctCount++;
            }
        }

        $this->score = ($correctCount / $this->lesson->questions->count()) * 100;
        $this->quizCompleted = true;

        if ($this->score >= 70) {
            $this->completeLesson();
        }
    }

    public function completeLesson()
    {
        $user = auth()->user();
        app(LessonService::class)->completeLesson($user, $this->lesson);
    }

    public function getNextLessonProperty()
    {
        return Lesson::where('course_id', $this->lesson->course_id)
            ->where('order', '>', $this->lesson->order)
            ->orderBy('order')
            ->first();
    }

    public function getPrevLessonProperty()
    {
        return Lesson::where('course_id', $this->lesson->course_id)
            ->where('order', '<', $this->lesson->order)
            ->orderBy('order', 'desc')
            ->first();
    }

    #[Layout('components.layouts.app', ['title' => 'Belajar'])]
    public function render()
    {
        return view('livewire.lesson-player');
    }
}
