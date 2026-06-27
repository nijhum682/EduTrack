<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\CourseNote;
use App\Models\CourseQuestion;
use App\Models\CourseAnswer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CourseWorkspaceTest extends TestCase
{
    use RefreshDatabase;

    protected $student;
    protected $teacher;
    protected $course;

    protected function setUp(): void
    {
        parent::setUp();

        // Create student
        $this->student = User::factory()->create([
            'role' => 'student',
        ]);

        // Create teacher
        $this->teacher = User::factory()->create([
            'role' => 'teacher',
        ]);

        // Create course
        $this->course = Course::create([
            'title' => 'Operating Systems',
            'code' => 'CSE3101',
            'credits' => 3,
            'description' => 'Operating systems course details',
            'instructor' => $this->teacher->name,
            'instructor_id' => $this->teacher->id,
        ]);
    }

    /**
     * Test student cannot view course details without enrollment.
     */
    public function test_student_cannot_view_course_details_without_enrollment()
    {
        $response = $this->actingAs($this->student)
            ->get(route('course.show', $this->course->id));

        $response->assertRedirect(route('dashboard'));
    }

    /**
     * Test enrolled student can view course details.
     */
    public function test_enrolled_student_can_view_course_details()
    {
        // Enroll student
        $this->student->courses()->attach($this->course->id);

        $response = $this->actingAs($this->student)
            ->get(route('course.show', $this->course->id));

        $response->assertStatus(200);
        $response->assertSee('Operating Systems');
        $response->assertSee('CSE3101');
    }

    /**
     * Test teacher can view their course details.
     */
    public function test_teacher_can_view_their_course_details()
    {
        $response = $this->actingAs($this->teacher)
            ->get(route('course.show', $this->course->id));

        $response->assertStatus(200);
    }

    /**
     * Test teacher can create lecture.
     */
    public function test_teacher_can_create_lecture()
    {
        $response = $this->actingAs($this->teacher)
            ->post(route('teacher.lectures.create', $this->course->id), [
                'lecture_number' => 'Lecture 01',
                'name' => 'Intro to Kernels',
                'details' => 'Detailed lecture description',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('lectures', [
            'course_id' => $this->course->id,
            'lecture_number' => 'Lecture 01',
            'name' => 'Intro to Kernels',
            'details' => 'Detailed lecture description',
        ]);
    }

    /**
     * Test enrolled student can upload note.
     */
    public function test_enrolled_student_can_upload_note()
    {
        $this->student->courses()->attach($this->course->id);

        // Mock public folder storage path
        $file = UploadedFile::fake()->create('notes.pdf', 500, 'application/pdf');

        $response = $this->actingAs($this->student)
            ->post(route('course.notes.upload', $this->course->id), [
                'title' => 'My Summary Note',
                'note_file' => $file,
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('course_notes', [
            'course_id' => $this->course->id,
            'user_id' => $this->student->id,
            'title' => 'My Summary Note',
        ]);
    }

    /**
     * Test student can ask question.
     */
    public function test_student_can_ask_question()
    {
        $this->student->courses()->attach($this->course->id);

        $response = $this->actingAs($this->student)
            ->post(route('course.questions.ask', $this->course->id), [
                'question_text' => 'What is a process control block?',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('course_questions', [
            'course_id' => $this->course->id,
            'user_id' => $this->student->id,
            'question_text' => 'What is a process control block?',
        ]);
    }

    /**
     * Test teacher can reply to question.
     */
    public function test_teacher_can_reply_to_question()
    {
        $this->student->courses()->attach($this->course->id);

        $question = CourseQuestion::create([
            'course_id' => $this->course->id,
            'user_id' => $this->student->id,
            'question_text' => 'What is a process control block?',
        ]);

        $response = $this->actingAs($this->teacher)
            ->post(route('course.questions.reply', [$this->course->id, $question->id]), [
                'answer_text' => 'PCB stores state information for a process.',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('course_answers', [
            'course_question_id' => $question->id,
            'user_id' => $this->teacher->id,
            'answer_text' => 'PCB stores state information for a process.',
        ]);
    }
}
