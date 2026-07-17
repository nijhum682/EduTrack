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
     * Test teacher cannot ask question.
     */
    public function test_teacher_cannot_ask_question()
    {
        $response = $this->actingAs($this->teacher)
            ->post(route('course.questions.ask', $this->course->id), [
                'question_text' => 'Should I ask a question as a teacher?',
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Instructors cannot post questions.');
        $this->assertDatabaseMissing('course_questions', [
            'question_text' => 'Should I ask a question as a teacher?',
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

    /**
     * Test teacher can create a course with enrollment fee and class.
     */
    public function test_teacher_can_create_course_with_fee_and_class()
    {
        $response = $this->actingAs($this->teacher)
            ->post(route('teacher.courses.create'), [
                'title' => 'Discrete Mathematics',
                'code' => 'MATH101',
                'enrollment_fee' => 1500,
                'class' => 'Class 9',
                'description' => 'Intro to discrete structures.',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('courses', [
            'title' => 'Discrete Mathematics',
            'code' => 'MATH101',
            'enrollment_fee' => 1500,
            'class' => 'Class 9',
            'instructor_id' => $this->teacher->id,
        ]);
    }

    /**
     * Test teacher can update course details.
     */
    public function test_teacher_can_update_course_details()
    {
        $response = $this->actingAs($this->teacher)
            ->post(route('teacher.courses.update', $this->course->id), [
                'title' => 'Advanced Operating Systems',
                'code' => 'CSE3101-ADV',
                'enrollment_fee' => 2000,
                'class' => 'Class 10',
                'description' => 'Advanced OS concepts.',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('courses', [
            'id' => $this->course->id,
            'title' => 'Advanced Operating Systems',
            'code' => 'CSE3101-ADV',
            'enrollment_fee' => 2000,
            'class' => 'Class 10',
        ]);
    }

    /**
     * Test teacher can upload lecture with video.
     */
    public function test_teacher_can_upload_lecture_with_video()
    {
        \Illuminate\Support\Facades\Storage::fake('public');
        $video = \Illuminate\Http\UploadedFile::fake()->create('lecture.mp4', 5000, 'video/mp4');

        $response = $this->actingAs($this->teacher)
            ->post(route('teacher.lectures.create', $this->course->id), [
                'lecture_number' => 'Lecture 05',
                'name' => 'CPU Scheduling Algorithms',
                'details' => 'FCFS, SJF, and Round Robin.',
                'lecture_video' => $video,
            ]);

        $response->assertRedirect();
        
        $lecture = \App\Models\Lecture::where('name', 'CPU Scheduling Algorithms')->first();
        $this->assertNotNull($lecture);
        $this->assertNotNull($lecture->video_path);
        $this->assertNotNull($lecture->runtime);
        
        $this->assertTrue(file_exists(public_path($lecture->video_path)));
        @unlink(public_path($lecture->video_path));
    }

    /**
     * Test teacher can rate and comment on student shared note.
     */
    public function test_teacher_can_rate_and_comment_on_shared_note()
    {
        $student = \App\Models\User::factory()->create(['role' => 'student']);
        $note = \App\Models\CourseNote::create([
            'course_id' => $this->course->id,
            'user_id' => $student->id,
            'title' => 'Process Synchronization Cheat Sheet',
            'file_path' => 'uploads/notes/test_note.pdf',
        ]);

        $response = $this->actingAs($this->teacher)
            ->post(route('teacher.notes.evaluate', [$this->course->id, $note->id]), [
                'rating' => 5,
                'comment' => 'Excellent summary of semaphores!',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('course_notes', [
            'id' => $note->id,
            'rating' => 5,
            'comment' => 'Excellent summary of semaphores!',
        ]);
    }

    /**
     * Test student can submit assignment and teacher can grade it.
     */
    public function test_student_can_submit_assignment_and_teacher_can_grade_it()
    {
        $student = \App\Models\User::factory()->create(['role' => 'student']);
        $student->courses()->attach($this->course->id);

        $task = \App\Models\Task::create([
            'course_id' => $this->course->id,
            'title' => 'Lab 3: Processes',
            'description' => 'Write a C program to fork processes.',
            'points' => 20,
            'due_date' => now()->addDays(7),
        ]);

        $response = $this->actingAs($student)
            ->post(route('course.tasks.submit', [$this->course->id, $task->id]), [
                'response_text' => 'Here is my process fork code.',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('task_submissions', [
            'task_id' => $task->id,
            'user_id' => $student->id,
            'is_completed' => true,
        ]);

        $submission = \App\Models\TaskSubmission::where('task_id', $task->id)->where('user_id', $student->id)->first();
        
        $gradeResponse = $this->actingAs($this->teacher)
            ->post(route('teacher.submissions.evaluate', $submission->id), [
                'score' => 18,
                'feedback' => 'Good implementation, clean output.',
            ]);

        $gradeResponse->assertRedirect();
        $this->assertDatabaseHas('task_submissions', [
            'id' => $submission->id,
            'score' => 18,
            'feedback' => 'Good implementation, clean output.',
        ]);
    }

    /**
     * Test student can request a review and corresponding teacher gets a notification.
     */
    public function test_student_can_request_grade_review_and_notifies_teacher()
    {
        $student = \App\Models\User::factory()->create(['role' => 'student']);
        $student->courses()->attach($this->course->id);

        $task = \App\Models\Task::create([
            'course_id' => $this->course->id,
            'title' => 'Midterm Exam',
            'points' => 100,
            'due_date' => now()->addDays(7),
        ]);

        $submission = \App\Models\TaskSubmission::create([
            'task_id' => $task->id,
            'user_id' => $student->id,
            'is_completed' => true,
            'score' => 50,
            'feedback' => 'Need improvement.',
        ]);

        // Submit review request
        $response = $this->actingAs($student)
            ->post(route('course.submissions.review', [$this->course->id, $submission->id]), [
                'review_reason' => 'I believe I solved Q3 correctly.',
            ]);

        $response->assertRedirect();

        // Verify review fields updated in database
        $this->assertDatabaseHas('task_submissions', [
            'id' => $submission->id,
            'review_requested' => true,
            'review_reason' => 'I believe I solved Q3 correctly.',
            'review_status' => 'pending',
        ]);

        // Verify notification created for teacher
        $this->assertDatabaseHas('activities', [
            'user_id' => $this->teacher->id,
            'type' => 'grade_review_request',
        ]);
    }

    /**
     * Test student can comment on shared notes.
     */
    public function test_student_can_comment_on_shared_note()
    {
        $student = \App\Models\User::factory()->create(['role' => 'student']);
        $student->courses()->attach($this->course->id);

        $note = \App\Models\CourseNote::create([
            'course_id' => $this->course->id,
            'user_id' => $student->id,
            'title' => 'PCB Cheat Sheet',
            'file_path' => 'uploads/notes/test_note.pdf',
        ]);

        $response = $this->actingAs($student)
            ->post(route('course.notes.comment', [$this->course->id, $note->id]), [
                'comment_text' => 'Thanks for sharing this note! Very useful.',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('course_note_comments', [
            'course_note_id' => $note->id,
            'user_id' => $student->id,
            'comment_text' => 'Thanks for sharing this note! Very useful.',
        ]);
    }

    /**
     * Test student and teacher can comment and reply in virtual classroom.
     */
    public function test_classroom_comments_and_replies()
    {
        $student = \App\Models\User::factory()->create(['role' => 'student']);
        $student->courses()->attach($this->course->id);

        $class = \App\Models\ScheduledClass::create([
            'course_id' => $this->course->id,
            'title' => 'Process Management Live',
            'scheduled_at' => now(),
            'duration_minutes' => 60,
            'platform' => 'Zoom',
            'meeting_link' => 'https://zoom.us/test',
            'is_active' => true,
        ]);

        // Student posts a comment
        $response = $this->actingAs($student)
            ->post(route('classroom.comment', $class->id), [
                'comment_text' => 'Hello teacher, I have a question about slide 2.',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('scheduled_class_comments', [
            'scheduled_class_id' => $class->id,
            'user_id' => $student->id,
            'comment_text' => 'Hello teacher, I have a question about slide 2.',
            'parent_id' => null,
        ]);

        $comment = \App\Models\ScheduledClassComment::first();

        // Teacher replies to student comment
        $replyResponse = $this->actingAs($this->teacher)
            ->post(route('classroom.comment', $class->id), [
                'comment_text' => 'Sure, ask ahead!',
                'parent_id' => $comment->id,
            ]);

        $replyResponse->assertRedirect();
        $this->assertDatabaseHas('scheduled_class_comments', [
            'scheduled_class_id' => $class->id,
            'user_id' => $this->teacher->id,
            'comment_text' => 'Sure, ask ahead!',
            'parent_id' => $comment->id,
        ]);
    }

    /**
     * Test student and teacher can comment and reply under a lecture.
     */
    public function test_lecture_comments_and_replies()
    {
        $student = \App\Models\User::factory()->create(['role' => 'student']);
        $student->courses()->attach($this->course->id);

        $lecture = \App\Models\Lecture::create([
            'course_id' => $this->course->id,
            'lecture_number' => 'LECTURE 02',
            'name' => 'Advanced Database Normalization',
            'details' => 'Deep dive into 3NF and BCNF concepts.',
        ]);

        // Student comments on the lecture
        $response = $this->actingAs($student)
            ->post(route('course.lectures.comment', [$this->course->id, $lecture->id]), [
                'comment_text' => 'This is a very clear explanation of BCNF. Thank you!',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('lecture_comments', [
            'lecture_id' => $lecture->id,
            'user_id' => $student->id,
            'comment_text' => 'This is a very clear explanation of BCNF. Thank you!',
            'parent_id' => null,
        ]);

        $comment = \App\Models\LectureComment::first();

        // Teacher replies to student comment
        $replyResponse = $this->actingAs($this->teacher)
            ->post(route('course.lectures.comment', [$this->course->id, $lecture->id]), [
                'comment_text' => 'Glad it helped! Let me know if you need any extra exercises.',
                'parent_id' => $comment->id,
            ]);

        $replyResponse->assertRedirect();
        $this->assertDatabaseHas('lecture_comments', [
            'lecture_id' => $lecture->id,
            'user_id' => $this->teacher->id,
            'comment_text' => 'Glad it helped! Let me know if you need any extra exercises.',
            'parent_id' => $comment->id,
        ]);
    }

    public function test_mcq_auto_grading_and_negative_marking_and_reevaluation()
    {
        $student = \App\Models\User::factory()->create(['role' => 'student']);
        $student->courses()->attach($this->course->id);

        // 1. Create a test with 2 MCQ questions
        $task = \App\Models\Task::create([
            'course_id' => $this->course->id,
            'title' => 'Biology MCQ Exam',
            'description' => 'Answer carefully.',
            'points' => 10,
            'due_date' => now()->addDays(7),
            'is_test' => true,
            'duration_minutes' => 30,
            'mcq_negative_marking' => true,
            'mcq_negative_marking_mode' => 'per_wrong',
            'mcq_negative_marking_value' => 0.50,
            'mcq_negative_marking_threshold_count' => 1,
        ]);

        $q1 = $task->questions()->create([
            'question_text' => 'What is 1+1?',
            'type' => 'mcq',
            'points' => 5,
            'options' => ['A', 'B', 'C', 'D'],
            'correct_answer' => 'B',
        ]);

        $q2 = $task->questions()->create([
            'question_text' => 'What is 2+2?',
            'type' => 'mcq',
            'points' => 5,
            'options' => ['A', 'B', 'C', 'D'],
            'correct_answer' => 'C',
        ]);

        // 2. Student submits exam
        // Answer Q1 correctly ('B'), and Q2 incorrectly ('A')
        $response = $this->actingAs($student)
            ->post(route('student.exam.submit', $task->id), [
                'answers' => [
                    $q1->id => 'B',
                    $q2->id => 'A',
                ]
            ]);

        $response->assertRedirect();
        
        // Expected score: Q1 is correct (5 pts), Q2 is wrong (0 pts).
        // Negative marking: 1 wrong MCQ * 0.50 = 0.50 deduction.
        // Final score: max(0, 5 - 0.50) = 4.5
        $submission = \App\Models\TaskSubmission::where('task_id', $task->id)->where('user_id', $student->id)->first();
        $this->assertEquals(4.5, $submission->score);
        $this->assertEquals(5, $submission->answers['question_grades'][$q1->id]);
        $this->assertEquals(0, $submission->answers['question_grades'][$q2->id]);
        $this->assertEquals(1, $submission->answers['mcq_details']['wrong']);

        // 3. Teacher modifies the correct answer for Q2 to 'A'
        // This should trigger a re-evaluation!
        // Both answers are now correct: Q1 ('B') is correct (5 pts), Q2 ('A') is correct (5 pts).
        // Wrong count becomes 0, so deduction is 0.
        // Expected re-evaluated score: 10
        $gradeResponse = $this->actingAs($this->teacher)
            ->post(route('teacher.submissions.evaluate', $submission->id), [
                'correct_answers' => [
                    $q2->id => 'A',
                ],
                'question_scores' => [
                    $q1->id => 5,
                    $q2->id => 5,
                ],
                'feedback' => 'Nice work after re-evaluation!',
            ]);

        $gradeResponse->assertRedirect();
        
        $submission->refresh();
        $this->assertEquals(10, $submission->score);
        $this->assertEquals(5, $submission->answers['question_grades'][$q1->id]);
        $this->assertEquals(5, $submission->answers['question_grades'][$q2->id]);
        $this->assertEquals(0, $submission->answers['mcq_details']['wrong']);
        $this->assertEquals('Nice work after re-evaluation!', $submission->feedback);
    }

    /**
     * Test assignments flow including deadlines, extensions, and submission security.
     */
    public function test_assignment_deadline_enforcement_and_extension()
    {
        $student = \App\Models\User::factory()->create(['role' => 'student']);
        $student->courses()->attach($this->course->id);

        // 1. Create an assignment that is past due date (deadline over)
        $assignment = \App\Models\Task::create([
            'course_id' => $this->course->id,
            'title' => 'Biology Assignment 1',
            'points' => 50,
            'is_test' => false,
            'due_date' => now()->subDay(), // past deadline
        ]);

        // 2. Student attempts to submit after deadline
        $response = $this->actingAs($student)
            ->post(route('course.tasks.submit', [$this->course->id, $assignment->id]), [
                'response_text' => 'My late homework response',
            ]);

        // Should return redirect with error (deadline over)
        $response->assertRedirect();
        $response->assertSessionHas('error', 'The submission deadline for this assignment has passed.');

        // 3. Teacher extends the deadline
        $extendResponse = $this->actingAs($this->teacher)
            ->post(route('teacher.tasks.update', $assignment->id), [
                'due_date' => now()->addDays(2)->format('Y-m-d H:i:s'),
            ]);

        $extendResponse->assertRedirect();
        
        $assignment->refresh();
        $this->assertTrue(now()->lt($assignment->due_date));

        // 4. Student attempts to submit again (should succeed now)
        $response2 = $this->actingAs($student)
            ->post(route('course.tasks.submit', [$this->course->id, $assignment->id]), [
                'response_text' => 'My on-time homework response',
            ]);

        $response2->assertRedirect();
        $response2->assertSessionHas('success');

        $this->assertDatabaseHas('task_submissions', [
            'task_id' => $assignment->id,
            'user_id' => $student->id,
            'is_completed' => true,
        ]);
    }

    /**
     * Test enrolled student can like and delete comment on a shared note.
     */
    public function test_student_can_like_and_delete_comment_on_shared_note()
    {
        $student = \App\Models\User::factory()->create(['role' => 'student']);
        $student->courses()->attach($this->course->id);

        $note = \App\Models\CourseNote::create([
            'course_id' => $this->course->id,
            'user_id' => $student->id,
            'title' => 'Biology Formulas Sheet',
            'file_path' => 'uploads/notes/biology_formulas.pdf',
        ]);

        // 1. Like the note (regular request)
        $likeResponse = $this->actingAs($student)
            ->post(route('course.notes.like', [$this->course->id, $note->id]));

        $likeResponse->assertRedirect();
        $this->assertDatabaseHas('course_note_likes', [
            'course_note_id' => $note->id,
            'user_id' => $student->id,
        ]);

        // 2. Unlike the note (AJAX request)
        $unlikeResponse = $this->actingAs($student)
            ->post(route('course.notes.like', [$this->course->id, $note->id]), [], ['X-Requested-With' => 'XMLHttpRequest']);

        $unlikeResponse->assertJsonFragment([
            'success' => true,
            'liked' => false,
            'count' => 0,
        ]);
        $this->assertDatabaseMissing('course_note_likes', [
            'course_note_id' => $note->id,
            'user_id' => $student->id,
        ]);

        // 3. Create a note comment
        $comment = \App\Models\CourseNoteComment::create([
            'course_note_id' => $note->id,
            'user_id' => $student->id,
            'comment_text' => 'First note comment',
        ]);

        // 4. Delete the note comment
        $deleteResponse = $this->actingAs($student)
            ->post(route('course.notes.comment.delete', [$this->course->id, $note->id, $comment->id]));

        $deleteResponse->assertRedirect();
        $this->assertDatabaseMissing('course_note_comments', [
            'id' => $comment->id,
        ]);
    }

    /**
     * Test that when a teacher creates a task, enrolled students get a notification.
     */
    public function test_teacher_assigns_homework_notifies_students()
    {
        $student = \App\Models\User::factory()->create(['role' => 'student']);
        $student->courses()->attach($this->course->id);

        $response = $this->actingAs($this->teacher)
            ->post(route('teacher.tasks.create'), [
                'course_id' => $this->course->id,
                'title' => 'Biology Assignment 1',
                'description' => 'Write a short summary of photosynthesis.',
                'due_date' => now()->addDays(2)->format('Y-m-d'),
                'points' => 50,
            ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('activities', [
            'user_id' => $student->id,
            'type' => 'notification',
            'description' => "New Assignment: Biology Assignment 1 has been posted in {$this->course->title}",
        ]);
    }

    /**
     * Test that when a student submits an assignment, the teacher gets a notification.
     */
    public function test_student_submits_assignment_notifies_teacher()
    {
        $student = \App\Models\User::factory()->create(['role' => 'student']);
        $student->courses()->attach($this->course->id);

        $task = \App\Models\Task::create([
            'course_id' => $this->course->id,
            'title' => 'Chemistry Lab HW',
            'points' => 30,
            'due_date' => now()->addDays(5),
        ]);

        $response = $this->actingAs($student)
            ->post(route('course.tasks.submit', [$this->course->id, $task->id]), [
                'response_text' => 'My submission text here.',
            ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('activities', [
            'user_id' => $this->teacher->id,
            'type' => 'notification',
            'description' => "Student {$student->name} submitted assignment: Chemistry Lab HW in {$this->course->title}",
        ]);
    }
}
