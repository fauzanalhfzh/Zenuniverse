<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.student')]
class CourseSelection extends Component
{
    public function selectCourse($courseId)
    {
        $user = auth()->user();
        if ($user) {
            $user->update(['active_course_id' => $courseId]);
        }

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.course-selection', [
            'studentCourses' => Course::orderBy('order')->get(),
        ]);
    }
}
