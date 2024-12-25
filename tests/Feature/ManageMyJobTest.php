<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Employer;

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
}
