<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Job;
use App\Models\Employer;
use Illuminate\Http\UploadedFile;

class ManageMyJobApplicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_view_job_application()
    {
        $response = $this->get(route('my-job-applications.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_user_can_view_job_application()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $employer = Employer::factory()->create();
        $job = Job::factory()->create(['employer_id' => $employer->id]);

        $jobApplication = $job->jobApplication()->create([
            'user_id' => $user->id,
            'expected_salary' => 5000,
            'cv_path' => 'cvs/dummy_cv.pdf', 
        ]);

        $response = $this->get(route('my-job-applications.index'));

        $response->assertStatus(200);

        $response->assertViewIs('my_job_application.index');

        // Assert that the view receives the correct data
        $response->assertViewHas('applications', function ($applications) use ($jobApplication) {
            return $applications->contains($jobApplication);
        });
    }

}
