<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskOperationsTest extends TestCase
{
    use RefreshDatabase; //Refresh database on each Test Run
    public function testgetAllTasks()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        Task::factory(10)->create();

        $response = $this->json('GET', 'api/tasks');

        $response->assertStatus(200);
    }
}
