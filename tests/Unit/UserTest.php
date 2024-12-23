<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_users(): void
    {
        User::factory()->create([
            'name' => 'Minh Nguyen',
            'email' => 'minh@ng.com',
        ]);

        User::factory(100)->create();

        $user = User::all();

        $this->assertCount(101, $user);
        $this->assertEquals('Minh Nguyen', $user[0]->name);
        $this->assertEquals('minh@ng.com', $user[0]->email);
    }
}
