<?php

namespace App\Livewire;

use App\Models\Lesson;
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

        // Cek apakah sudah pernah selesai
        $existingProgress = \App\Models\UserProgress::where('user_id', $user->id)
            ->where('lesson_id', $this->lesson->id)
            ->first();

        if (! $existingProgress) {
            \App\Models\UserProgress::create([
                'user_id' => $user->id,
                'lesson_id' => $this->lesson->id,
                'status' => 'completed',
                'xp_earned' => $this->lesson->xp_reward,
                'completed_at' => now(),
            ]);

            // Add XP to user
            $user->increment('current_xp', $this->lesson->xp_reward);
            $user->increment('total_xp', $this->lesson->xp_reward);

            // Logic Level Up sederhana
            if ($user->current_xp >= 1000) { // Contoh threshold
                // $user->increment('current_level_id');
                // $user->current_xp = 0;
                // $user->save();
            }
        }
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
