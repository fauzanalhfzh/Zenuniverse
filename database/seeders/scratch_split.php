<?php
/**
 * Script to split LessonSeeder.php into per-material seeders.
 * Run: php database/seeders/scratch_split.php
 */

$src = file_get_contents(__DIR__ . '/LessonSeeder.php');
$lines = explode("\n", $src);

// Helper: extract lines range (1-indexed inclusive)
function extractLines($lines, $start, $end) {
    return implode("\n", array_slice($lines, $start - 1, $end - $start + 1));
}

// ============================================================
// 1. WebProgrammingLessonSeeder (createLesson1..10 + createQuiz)
// Methods: createLesson1 (line 2388) .. createLesson10 (line 2744) end at 2777
// createQuiz helper at line 2779-2789
// ============================================================

$webSeeder = <<<'PHP'
<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\CreatesQuiz;

class WebProgrammingLessonSeeder extends Seeder
{
    use CreatesQuiz;

    public function run(): void
    {
        $course = Course::where('title', 'Dasar Pemrograman Web')->first();
        if (!$course) return;

        $this->createLesson1($course);
        $this->createLesson2($course);
        $this->createLesson3($course);
        $this->createLesson4($course);
        $this->createLesson5($course);
        $this->createLesson6($course);
        $this->createLesson7($course);
        $this->createLesson8($course);
        $this->createLesson9($course);
        $this->createLesson10($course);
    }

PHP;

// Extract createLesson1..10 methods (lines 2388-2777)
$webMethods = extractLines($lines, 2388, 2777);
$webSeeder .= "\n" . $webMethods . "\n}\n";

file_put_contents(__DIR__ . '/WebProgrammingLessonSeeder.php', $webSeeder);
echo "✅ WebProgrammingLessonSeeder.php created\n";

// ============================================================
// 2. MathLessonSeeder (createMathLessons)
// Method at line 2791 to ~3023
// ============================================================

$mathSeeder = <<<'PHP'
<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class MathLessonSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::where('title', 'Matematika Dasar')->first();
        if (!$course) return;

        $this->createMathLessons($course);
    }

PHP;

$mathMethods = extractLines($lines, 2791, 3023);
$mathSeeder .= "\n" . $mathMethods . "\n}\n";

file_put_contents(__DIR__ . '/MathLessonSeeder.php', $mathSeeder);
echo "✅ MathLessonSeeder.php created\n";

// ============================================================
// 3. PythonLessonSeeder (stub - methods don't exist yet)
// ============================================================

$pythonSeeder = <<<'PHP'
<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\CreatesQuiz;

class PythonLessonSeeder extends Seeder
{
    use CreatesQuiz;

    public function run(): void
    {
        $course = Course::where('title', 'Python Development')->first();
        if (!$course) return;

        // TODO: Python lesson methods to be implemented
        // $this->createPythonLesson1($course);
        // $this->createPythonLesson2($course);
        // $this->createPythonLesson3($course);
    }
}

PHP;

file_put_contents(__DIR__ . '/PythonLessonSeeder.php', $pythonSeeder);
echo "✅ PythonLessonSeeder.php created\n";

// ============================================================
// 4. LogicProgrammingLessonSeeder (MERGED Set1 + Set2)
// Set1 methods: createLogicLesson1..5 (lines 55-658), createLogicLesson6..15 (660-1932) 
// Set2 methods: createLogicLesson6..15 (1934-2386) — RENAMED
//
// New order (merged):
//   1-5: Keep Set1 lessons 1-5 as-is
//   6: Operator Aritmatika (Set2 lesson6, line 1934) → renamed createLogicLessonArithmetic
//   7: Operator Logika (Set2 lesson7, line 1999) → renamed createLogicLessonLogicOp
//   8-11: Set1 lessons 6-9 (Array, Fungsi, Argumen, Scope) with order renumbered
//   12: Nested Loop (Set2 lesson11, line 2192) → renamed createLogicLessonNestedLoop
//   13-18: Set1 lessons 10-15 (Debug, Stack, Search, Sort, Recursion, Modular) with order renumbered
// ============================================================

$logicSeeder = <<<'PHP'
<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\CreatesQuiz;

class LogicProgrammingLessonSeeder extends Seeder
{
    use CreatesQuiz;

    public function run(): void
    {
        $course = Course::where('title', 'Logika Pemrograman Dasar')->first();
        if (!$course) return;

        // Lessons 1-5: Original
        $this->createLogicLesson1($course);
        $this->createLogicLesson2($course);
        $this->createLogicLesson3($course);
        $this->createLogicLesson4($course);
        $this->createLogicLesson5($course);

        // Lessons 6-7: From Set 2 (Operator Aritmatika & Logika)
        $this->createLogicLessonArithmetic($course);
        $this->createLogicLessonLogicOp($course);

        // Lessons 8-11: From Set 1 (Array, Fungsi, Argumen, Scope) - renumbered
        $this->createLogicLessonArray($course);
        $this->createLogicLessonFunctions($course);
        $this->createLogicLessonArguments($course);
        $this->createLogicLessonScope($course);

        // Lesson 12: Nested Loop from Set 2
        $this->createLogicLessonNestedLoop($course);

        // Lessons 13-18: From Set 1 (Debug, Stack, Search, Sort, Recursion, Modular) - renumbered
        $this->createLogicLessonDebugging($course);
        $this->createLogicLessonStackQueue($course);
        $this->createLogicLessonSearching($course);
        $this->createLogicLessonSorting($course);
        $this->createLogicLessonRecursion($course);
        $this->createLogicLessonModular($course);
    }

PHP;

// --- Set1 Lessons 1-5 (lines 55-658) - keep as-is ---
$logicMethods = extractLines($lines, 55, 658);

// --- Set2 Lesson6 (Operator Aritmatika, lines 1934-1997) → rename to createLogicLessonArithmetic, order=6 ---
$set2L6 = extractLines($lines, 1934, 1997);
$set2L6 = str_replace('private function createLogicLesson6($course)', 'private function createLogicLessonArithmetic($course)', $set2L6);

// --- Set2 Lesson7 (Operator Logika, lines 1999-2050) → rename, order=7 ---
$set2L7 = extractLines($lines, 1999, 2050);
$set2L7 = str_replace('private function createLogicLesson7($course)', 'private function createLogicLessonLogicOp($course)', $set2L7);

// --- Set1 Lesson6 (Array, lines 660-784) → rename to createLogicLessonArray, change order to 8 ---
$set1L6 = extractLines($lines, 660, 784);
$set1L6 = str_replace('private function createLogicLesson6($course)', 'private function createLogicLessonArray($course)', $set1L6);
$set1L6 = str_replace("'order' => 6", "'order' => 8", $set1L6);

// --- Set1 Lesson7 (Fungsi, lines 786-912) → rename, order 9 ---
$set1L7 = extractLines($lines, 786, 912);
$set1L7 = str_replace('private function createLogicLesson7($course)', 'private function createLogicLessonFunctions($course)', $set1L7);
$set1L7 = str_replace("'order' => 7", "'order' => 9", $set1L7);

// --- Set1 Lesson8 (Argumen, lines 914-1040) → rename, order 10 ---
$set1L8 = extractLines($lines, 914, 1040);
$set1L8 = str_replace('private function createLogicLesson8($course)', 'private function createLogicLessonArguments($course)', $set1L8);
$set1L8 = str_replace("'order' => 8", "'order' => 10", $set1L8);

// --- Set1 Lesson9 (Scope, lines 1042-1167) → rename, order 11 ---
$set1L9 = extractLines($lines, 1042, 1167);
$set1L9 = str_replace('private function createLogicLesson9($course)', 'private function createLogicLessonScope($course)', $set1L9);
$set1L9 = str_replace("'order' => 9", "'order' => 11", $set1L9);

// --- Set2 Lesson11 (Nested Loop, lines 2192-2225) → rename, order 12 ---
$set2L11 = extractLines($lines, 2192, 2225);
$set2L11 = str_replace('private function createLogicLesson11($course)', 'private function createLogicLessonNestedLoop($course)', $set2L11);
$set2L11 = str_replace("'order' => 11", "'order' => 12", $set2L11);

// --- Set1 Lesson10 (Debug, lines 1169-1295) → rename, order 13 ---
$set1L10 = extractLines($lines, 1169, 1295);
$set1L10 = str_replace('private function createLogicLesson10($course)', 'private function createLogicLessonDebugging($course)', $set1L10);
$set1L10 = str_replace("'order' => 10", "'order' => 13", $set1L10);

// --- Set1 Lesson11 (Stack/Queue, lines 1296-1422) → rename, order 14 ---
$set1L11 = extractLines($lines, 1296, 1422);
$set1L11 = str_replace('private function createLogicLesson11($course)', 'private function createLogicLessonStackQueue($course)', $set1L11);
$set1L11 = str_replace("'order' => 11", "'order' => 14", $set1L11);

// --- Set1 Lesson12 (Search, lines 1424-1550) → rename, order 15 ---
$set1L12 = extractLines($lines, 1424, 1550);
$set1L12 = str_replace('private function createLogicLesson12($course)', 'private function createLogicLessonSearching($course)', $set1L12);
$set1L12 = str_replace("'order' => 12", "'order' => 15", $set1L12);

// --- Set1 Lesson13 (Sort, lines 1552-1676) → rename, order 16 ---
$set1L13 = extractLines($lines, 1552, 1676);
$set1L13 = str_replace('private function createLogicLesson13($course)', 'private function createLogicLessonSorting($course)', $set1L13);
$set1L13 = str_replace("'order' => 13", "'order' => 16", $set1L13);

// --- Set1 Lesson14 (Recursion, lines 1678-1805) → rename, order 17 ---
$set1L14 = extractLines($lines, 1678, 1805);
$set1L14 = str_replace('private function createLogicLesson14($course)', 'private function createLogicLessonRecursion($course)', $set1L14);
$set1L14 = str_replace("'order' => 14", "'order' => 17", $set1L14);

// --- Set1 Lesson15 (Modular, lines 1807-1932) → rename, order 18 ---
$set1L15 = extractLines($lines, 1807, 1932);
$set1L15 = str_replace('private function createLogicLesson15($course)', 'private function createLogicLessonModular($course)', $set1L15);
$set1L15 = str_replace("'order' => 15", "'order' => 18", $set1L15);

$logicSeeder .= "\n" . $logicMethods . "\n";
$logicSeeder .= $set2L6 . "\n\n";
$logicSeeder .= $set2L7 . "\n\n";
$logicSeeder .= $set1L6 . "\n\n";
$logicSeeder .= $set1L7 . "\n\n";
$logicSeeder .= $set1L8 . "\n\n";
$logicSeeder .= $set1L9 . "\n\n";
$logicSeeder .= $set2L11 . "\n\n";
$logicSeeder .= $set1L10 . "\n\n";
$logicSeeder .= $set1L11 . "\n\n";
$logicSeeder .= $set1L12 . "\n\n";
$logicSeeder .= $set1L13 . "\n\n";
$logicSeeder .= $set1L14 . "\n\n";
$logicSeeder .= $set1L15 . "\n";
$logicSeeder .= "}\n";

file_put_contents(__DIR__ . '/LogicProgrammingLessonSeeder.php', $logicSeeder);
echo "✅ LogicProgrammingLessonSeeder.php created\n";

// ============================================================
// 5. Rewrite LessonSeeder.php as orchestrator
// ============================================================

$orchestrator = <<<'PHP'
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            LogicProgrammingLessonSeeder::class,
            WebProgrammingLessonSeeder::class,
            MathLessonSeeder::class,
            PythonLessonSeeder::class,
        ]);
    }
}

PHP;

file_put_contents(__DIR__ . '/LessonSeeder.php', $orchestrator);
echo "✅ LessonSeeder.php rewritten as orchestrator\n";

echo "\n🎉 All done! Run: php artisan migrate:fresh --seed\n";
