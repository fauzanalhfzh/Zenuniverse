<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.student')]
class CourseSelection extends Component
{
    public $role = 'student'; // Default active tab

    public function setRole($role)
    {
        $this->role = $role;
    }

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
            'studentCourses' => Course::where('type', 'student')->orderBy('order')->get(),
            'teacherCourses' => Course::where('type', 'teacher')->orderBy('order')->get(),
        ]);
    }
}
