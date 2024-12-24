<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Job;
use App\Models\Employer;
use App\Models\JobApplication;
use App\Models\User;

class ManageJobApplicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_create_job_application()
    {
        $employer = Employer::factory()->create();
        $job = Job::factory()->create(['employer_id' => $employer->id]);

        $response = $this->get(route('jobs.application.create', $job->id));

        $response->assertRedirect(route('login'));

        $response = $this->post(route('jobs.application.store', $job->id), [
            'expected_salary' => 4000,
        ]);

        $response->assertRedirect(route('login'));

        $this->assertDatabaseCount('job_applications', 0);
    }

    public function test_user_can_create_job_application()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $employer = Employer::factory()->create();
        $job = Job::factory()->create(['employer_id'=> $employer->id]);

        $application = [
            'expected_salary' => 4000,
        ];

        $response = $this->post(route('jobs.application.store', $job->id), $application);

        $response->assertRedirect(route('jobs.show', $job->id));

        $this->assertDatabaseHas('job_applications', [
            'user_id' => $user->id,
            'job_id' => $job->id,
            'expected_salary' => $application['expected_salary'],
        ]);
    }
}
