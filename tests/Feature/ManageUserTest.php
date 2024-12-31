<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_manage_user_info() {
        $response = $this->get(route("user.index"));

        $response->assertRedirect(route("login"));
    }
}
