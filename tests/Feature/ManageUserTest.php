<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ManageUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_manage_user_info() {
        $response = $this->get(route("user.edit"));

        $response->assertRedirect(route("login"));
    }
}
