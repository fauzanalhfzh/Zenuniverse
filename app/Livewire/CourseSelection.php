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
            'studentCourses' => Course::orderBy('order')->get(),
            // Placeholder for teacher courses
            'teacherCourses' => collect([
                [
                    'id' => 999,
                    'title' => 'Panduan Mengajar',
                    'icon' => 'cast_for_education',
                    'description' => 'Pelajari cara efektif menyampaikan materi pemrograman kepada siswa.',
                    'lessons_count' => 5,
                    'students_count' => 120,
                ],
                [
                    'id' => 998,
                    'title' => 'Manajemen Kelas',
                    'icon' => 'groups',
                    'description' => 'Strategi mengelola kelas interaktif dan menyenangkan.',
                    'lessons_count' => 3,
                    'students_count' => 85,
                ],
            ]),
        ]);
    }
}
