<?php

namespace App\Livewire\Missions;

use App\Models\Lesson;
use App\Services\LessonService;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.empty')]
class MissionPlayer extends Component
{
    public $mission;

    public $slides = [];

    public $step = 0;

    public $selectedAnswer = null;

    public $isChecked = false;

    public $isCorrect = false;

    public $minigameData = [];

    public $startTime = null;

    public $showCompletion = false;

    public $completionData = [];

    public $showGameOver = false;

    public int $earnedXp = 0;

    public array $wrongQueue = [];

    public bool $isRetrying = false;

    public function mount($slug)
    {
        if (auth()->check() && auth()->user()->hearts <= 0) {
            $this->redirectRoute('dashboard', navigate: true);
            return;
        }

        $this->mission = Lesson::where('slug', $slug)->with('slides')->firstOrFail();
        $this->slides = $this->mission->slides->toArray();

        if (empty($this->slides)) {
            $this->redirectRoute('dashboard', navigate: true);

            return;
        }

        $this->startTime = time();
        $this->initMinigameData();
    }


    public function checkAnswer()
    {
        if ($this->selectedAnswer === null || $this->isChecked) {
            return;
        }

        $currentSlide = $this->slides[$this->step];
        $this->isChecked = true;

        // Find if selected option is correct
        $correctOption = collect($currentSlide['options'])->firstWhere('correct', true);
        $this->isCorrect = ($this->selectedAnswer == ($correctOption['id'] ?? null));

        if (! $this->isCorrect) {
            $this->dispatch('play-sound', type: 'incorrect');
            if (! $this->isRetrying) {
                $this->wrongQueue[] = $currentSlide;
            }
            $this->handleIncorrectAnswer();
        } else {
            $this->dispatch('play-sound', type: 'correct');
            if (! $this->isRetrying) {
                $this->earnedXp += 10;
            }
            $this->dispatch('show-xp-pop');
        }
    }

    public function checkMinigame()
    {
        if ($this->isChecked) {
            return;
        }

        $currentSlide = $this->slides[$this->step];
        $this->isChecked = true;
        
        if ($currentSlide['type'] === 'code_arrange') {
            // Check if current block order matches original index
            $blocks = $this->minigameData['blocks'];
            $isOrdered = true;
            for ($i = 0; $i < count($blocks); $i++) {
                if ($blocks[$i]['id'] !== $i) {
                    $isOrdered = false;
                    break;
                }
            }
            $this->isCorrect = $isOrdered;
        } elseif ($currentSlide['type'] === 'code_fillblank') {
            // Options structure is {id, text, correct_id}.
            // So if $this->minigameData['answers'][$blankId] === $correctOptionId
            $isAllCorrect = true;
            $answers = collect($this->minigameData['answers']);
            
            // Reconstruct the intended correct array
            $blanks = collect($this->minigameData['snippet'])->where('type', 'blank');
            foreach($blanks as $blank) {
                // If the answer slot is null or does not match the block's intended ID
                if (!isset($answers[$blank['id']]) || $answers[$blank['id']] !== $blank['answer_id']) {
                    $isAllCorrect = false;
                    break;
                }
            }
            
            $this->isCorrect = $isAllCorrect;
        } elseif ($currentSlide['type'] === 'block_code') {
            // Simple validation for now: just checks if workspace matches an expected length or sequence
            // In a real app we'd parse and execute the AST or match exact IDs
            $workspace = $this->minigameData['workspaceBlocks'] ?? [];
            
            // Assume the correct answer is provided as a comma separated list of palette IDs in `correct_answer`
            $expectedIds = explode(',', $currentSlide['correct_answer'] ?? '');
            
            $isCorrect = true;
            if(count($workspace) !== count($expectedIds)) {
                $isCorrect = false;
            } else {
                foreach($workspace as $index => $block) {
                    if($block['id'] != $expectedIds[$index]) {
                        $isCorrect = false;
                        break;
                    }
                }
            }
            $this->isCorrect = $isCorrect;
        }

        if (! $this->isCorrect) {
            $this->dispatch('play-sound', type: 'incorrect');
            if (! $this->isRetrying) {
                $this->wrongQueue[] = $currentSlide;
            }
            $this->handleIncorrectAnswer();
        } else {
            $this->dispatch('play-sound', type: 'correct');
            if (! $this->isRetrying) {
                $this->earnedXp += 10;
            }
            $this->dispatch('show-xp-pop');
        }
    }

    public function resetMinigameCheck()
    {
        $this->isChecked = false;
        $this->isCorrect = false;
        // Do not reset the data so they can see their wrong attempt
    }

    private function handleIncorrectAnswer()
    {
        $user = auth()->user();
        if ($user && $user->hearts > 0) {
            if ($user->hearts >= 5 || is_null($user->last_heart_replenished_at)) {
                $user->last_heart_replenished_at = now();
            }
            
            $user->hearts--;
            $user->save();
            
            if ($user->hearts <= 0) {
                $this->dispatch('play-sound', type: 'incorrect');
                $this->showGameOver = true;
                return;
            }
        }
    }

    public function nextStep()
    {
        if ($this->step < count($this->slides) - 1) {
            // Still slides left in current pass
            $this->step++;
            $this->resetStep();
        } else {
            // Current pass finished
            if (! empty($this->wrongQueue)) {
                // Switch to retry pass
                $this->slides = array_values($this->wrongQueue);
                $this->wrongQueue = [];
                $this->isRetrying = true;
                $this->step = 0;
                $this->resetStep();
            } else {
                // All done — calculate elapsed time
                $elapsed = time() - ($this->startTime ?? time());
                $timeFormatted = sprintf('%02d:%02d', floor($elapsed / 60), $elapsed % 60);

                // Save Progress via Service
                if (auth()->check()) {
                    app(LessonService::class)->completeMission(auth()->user(), $this->mission, $this->earnedXp);
                }

                // Dispatch completion sound
                $this->dispatch('play-sound', type: 'completed');

                // Show completion screen
                $nextLesson = Lesson::where('course_id', $this->mission->course_id)
                    ->where('order', '>', $this->mission->order)
                    ->orderBy('order')
                    ->first();

                $this->completionData = [
                    'xp'        => $this->earnedXp,
                    'time'      => $timeFormatted,
                    'title'     => $this->mission->title,
                    'nextSlug'  => $nextLesson?->slug,
                    'nextTitle' => $nextLesson?->title,
                ];
                $this->showCompletion = true;
            }
        }
    }

    public function goToDashboard()
    {
        return redirect()->route('dashboard');
    }

    private function resetStep()
    {
        $this->selectedAnswer = null;
        $this->isChecked = false;
        $this->isCorrect = false;
        $this->minigameData = [];
        $this->initMinigameData();
    }

    public function updateBlockOrder($ids)
    {
        if (empty($this->minigameData['blocks'])) return;

        $currentBlocks = collect($this->minigameData['blocks']);
        $newBlocks = [];
        
        // Ensure no duplicates are processed if frontend sends corrupted arrays
        $uniqueIds = array_unique($ids);

        foreach ($uniqueIds as $id) {
            $block = $currentBlocks->firstWhere('id', $id);
            if ($block) {
                $newBlocks[] = $block;
            }
        }

        $this->minigameData['blocks'] = $newBlocks;
    }

    public function updateWorkspaceOrder($ids)
    {
        $currentSlide = $this->slides[$this->step];
        $palette = collect($currentSlide['options'] ?? []);

        $newWorkspace = [];
        foreach ($ids as $id) {
            $block = $palette->firstWhere('id', $id);
            if ($block) {
                // Each block in workspace just needs its structured data
                $newWorkspace[] = $block;
            }
        }

        $this->minigameData['workspaceBlocks'] = $newWorkspace;
    }

    public function selectFillAnswer($optionId)
    {
        // Find first empty blank
        $snippet = $this->minigameData['snippet'] ?? [];
        $answers = $this->minigameData['answers'] ?? [];
        
        foreach ($snippet as $part) {
            if ($part['type'] === 'blank') {
                $blankId = $part['id'];
                if (!isset($answers[$blankId]) || is_null($answers[$blankId])) {
                    $this->minigameData['answers'][$blankId] = $optionId;
                    break;
                }
            }
        }
    }

    public function removeFillAnswer($blankId)
    {
        if (isset($this->minigameData['answers'][$blankId])) {
            $this->minigameData['answers'][$blankId] = null;
        }
    }

    private function initMinigameData()
    {
        $currentSlide = $this->slides[$this->step] ?? null;
        if(!$currentSlide) return;

        $type = $currentSlide['type'];
        
        if ($type === 'code_arrange') {
            // Options will contain the lines of code {"id": 0, "text": "var x = 1;"}
            // Shuffle them and store in minigameData['blocks']
            $blocks = $currentSlide['options'] ?? [];
            shuffle($blocks);
            $this->minigameData['blocks'] = $blocks;
            
        } elseif ($type === 'code_fillblank') {
            // Options structure: [{"id": 1, "text": "let", "color": "blue"}]
            // Snippet structure parsed from `content` or `options`: 
            // [{"type": "text", "value": " "}, {"type": "blank", "id": 0, "answer_id": 1}]
            // For now, let's use the DB `options` as the snippet array and `correct_answer` as JSON options
            $snippet = $currentSlide['options'] ?? [];
            $options = json_decode($currentSlide['correct_answer'] ?? '[]', true) ?? [];
            
            $this->minigameData['snippet'] = $snippet;
            $this->minigameData['options'] = $options;
            
            // Map blanks to null answers
            $answers = [];
            foreach($snippet as $part) {
                if($part['type'] === 'blank') {
                    $answers[$part['id']] = null;
                }
            }
            $this->minigameData['answers'] = $answers;

        } elseif ($type === 'block_code') {
            $this->minigameData['workspaceBlocks'] = [];
            $this->minigameData['paletteBlocks'] = $currentSlide['options'] ?? [];
        }
    }

    public function render()
    {
        return view('livewire.missions.mission-player', [
            'currentSlide' => $this->slides[$this->step],
            'progress'     => (($this->step + 1) / count($this->slides)) * 100,
            'hearts'       => auth()->user() ? auth()->user()->hearts : 5,
            'earnedXp'     => $this->earnedXp,
            'isRetrying'   => $this->isRetrying,
        ]);
    }
}
