<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_get_all_tasks()
    {
        Task::factory()->count(3)->create();

        $response = $this->actingAs($this->user)->getJson('/api/tasks');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_can_create_task()
    {
        $taskData = [
            'title' => 'New Task',
            'description' => 'Task description',
            'status' => 'pending',
            'due_date' => '2024-12-31',
        ];

        $response = $this->actingAs($this->user)->postJson('/api/tasks', $taskData);

        $response->assertStatus(201)
            ->assertJsonFragment($taskData);
    }

    public function test_can_update_task()
    {
        $task = Task::factory()->create();
        $updatedData = [
            'title' => 'Updated Task Title'
        ];

        $response = $this->actingAs($this->user)->putJson("/api/tasks/{$task->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJsonFragment($updatedData);
    }

    public function test_can_delete_task()
    {
        $task = Task::factory()->create();

        $response = $this->actingAs($this->user)->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id
        ]);
    }
}
