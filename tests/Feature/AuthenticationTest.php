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

    public function test_unsuccessful_login()
    {
        User::factory()->create([
            'name' => 'Minh Nguyen',
            'email' => 'minh@ng.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/auth', [
            'email' => 'minh@ng.com',
            'password' => 'password123',
        ]);

        $this->assertGuest();
        $response->assertRedirect();
        $response->assertSessionHas('error', 'Wrong e-mail or password!');
    }

    public function test_invalid_login_attempt()
    {
        $response = $this->post('/auth', []);

        $response->assertSessionHasErrors(['email', 'password']);
    }
}
