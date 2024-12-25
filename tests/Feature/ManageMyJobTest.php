<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageMyJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_manage_jobs(): void
    {
        $response = $this->get(route("my-jobs.index"));

        $response->assertRedirect(route("login"));
    }
}
