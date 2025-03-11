<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_task()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/tasks', [
            'name' => 'Test Görevi',
            'description' => 'Test açıklaması',
        ]);

        $response->assertStatus(201)
                 ->assertJson(['name' => 'Test Görevi']);
    }

    public function test_user_can_view_their_tasks()
    {
        $user = User::factory()->create();
        $task = Task::factory()->for($user)->create();

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/tasks');

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $task->name]);
    }

    // Diğer test metotları...
}
