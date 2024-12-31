<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ManageUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_manage_user_info() {
        $response = $this->get(route("user.index"));

        $response->assertRedirect(route("login"));
    }

    public function test_user_can_manage_user_info(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route("user.index"));

        $response->assertViewIs("user.index");
    }
}
