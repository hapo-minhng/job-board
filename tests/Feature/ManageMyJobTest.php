<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Employer;
use App\Models\Job;

class ManageMyJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_manage_jobs(): void
    {
        $response = $this->get(route("my-jobs.index"));

        $response->assertRedirect(route("login"));
    }

    public function test_user_cannot_manage_jobs(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route("my-jobs.index"));

        $response->assertRedirect(route('employer.create'));
    }

    public function test_employer_can_manage_jobs(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Employer::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route("my-jobs.index"));

        $response->assertStatus(200);

        $response->assertViewIs("my_job.index");
    }

    public function test_employer_can_create_a_job(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $employer = Employer::factory()->create(['user_id' => $user->id]);

        $job = [
            'title' => 'Job A',
            'description' => 'Job A desc',
            'location' => 'NY',
            'salary' => 5000,
            'category' => 'IT',
            'experience' => 'intermediate',
            'employer_id' => $employer->id,
        ];

        $response = $this->post(route('my-jobs.store'), $job);

        $response->assertRedirect(route('my-jobs.index'));
        $response->assertSessionHas('success', 'Job created successfully!');

        $this->assertDatabaseHas('offered_jobs', [
            'title' => 'Job A',
            'description' => 'Job A desc',
            'location' => 'NY',
            'salary' => 5000,
            'category' => 'IT',
            'experience' => 'intermediate',
            'employer_id' => $employer->id,
        ]);
    }

    public function test_employer_can_update_a_job()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $employer = Employer::factory()->create(['user_id' => $user->id]);

        $job = Job::factory()->create([
            'title' => 'Job A',
            'description' => 'Job A desc',
            'location' => 'NY',
            'salary' => 5000,
            'category' => 'IT',
            'experience' => 'intermediate',
            'employer_id' => $employer->id,
        ]);

        $updatedJob = [
            'title' => 'Job B',
            'description' => 'Job B desc',
            'location' => 'NY',
            'salary' => 6000,
            'category' => 'IT',
            'experience' => 'intermediate',
            'employer_id' => $employer->id,
        ];

        $response = $this->put(route('my-jobs.update', $job), $updatedJob);

        $response->assertRedirect(route('my-jobs.index'));
        $response->assertSessionHas('success', 'Job updated successfully!');

        $this->assertDatabaseHas('offered_jobs', [
            'title' => 'Job B',
            'description' => 'Job B desc',
            'location' => 'NY',
            'salary' => 6000,
            'category' => 'IT',
            'experience' => 'intermediate',
            'employer_id' => $employer->id,
        ]);

        $this->assertDatabaseMissing('offered_jobs', [
            'title' => 'Job A',
            'description' => 'Job A desc',
            'salary' => 5000,
        ]);
    }

    public function test_employer_can_delete_a_job()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $employer = Employer::factory()->create(['user_id' => $user->id]);

        $job = Job::factory()->create([
            'employer_id' => $employer->id,
        ]);

        $response = $this->delete(route('my-jobs.destroy', $job));

        $response->assertRedirect(route('my-jobs.index'));
        $response->assertSessionHas('success', 'Job removed!');

        $this->assertDatabaseHas('offered_jobs', [
            'deleted_at' => now(),
        ]);
    }
}
