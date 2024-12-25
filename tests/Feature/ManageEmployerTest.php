<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ManageEmployerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_register_as_employer(): void
    {
        $response = $this->get(route("employer.create"));

        $response->assertRedirect(route("login"));
    }

    public function test_user_can_register_as_employer(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'company_name' => 'ABC Ltd.',
        ];

        $response = $this->post(route('employer.store'), $data);

        $response->assertRedirect(route('jobs.index'));
        $response->assertSessionHas('success', 'Employer account registered successfully!');

        $this->assertDatabaseHas('employers', [
            'company_name' => 'ABC Ltd.',
        ]);
    }
}
