<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_login()
    {
        $user = User::factory()->create([
            'name' => 'Minh Nguyen',
            'email' => 'minh@ng.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/auth', [
            'email' => 'minh@ng.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/');
    }
}
