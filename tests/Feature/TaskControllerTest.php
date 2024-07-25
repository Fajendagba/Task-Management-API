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

        $response = $this->actingAs($this->user)->getJson('/api/list-tasks');

        // dd($response->json());

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_create_task()
    {
        $taskData = [
            'title' => 'Get Askadoc Offer',
            'description' => 'Get Askadoc Backend Developer Offer',
            'status' => 'pending',
            'due_date' => '2024-07-26'
        ];

        $response = $this->actingAs($this->user)->postJson('/api/create-task', $taskData);

        $taskDataWithFormattedDate = $taskData;
        $taskDataWithFormattedDate['due_date'] = '2024-07-26T00:00:00.000000Z';

        $response->assertStatus(201)
            ->assertJsonFragment($taskDataWithFormattedDate);
    }

    public function test_can_update_task()
    {
        $task = Task::factory()->create();
        $updatedData = [
            'title' => 'Got Askadoc Offer!',
            'description' => 'Got Askadoc Backend Developer Offer',
            'status' => 'completed',
            'due_date' => '2024-07-29'
        ];

        $response = $this->actingAs($this->user)->putJson("/api/update-task/{$task->id}", $updatedData);

        $updatedDataWithFormattedDate = $updatedData;
        $updatedDataWithFormattedDate['due_date'] = '2024-07-29T00:00:00.000000Z';

        $response->assertStatus(200)
            ->assertJsonFragment($updatedDataWithFormattedDate);
    }

    public function test_can_delete_task()
    {
        $task = Task::factory()->create();

        $response = $this->actingAs($this->user)->deleteJson("/api/delete-task/{$task->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id
        ]);
    }
}
