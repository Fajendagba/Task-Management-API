<?php

namespace Tests\Unit;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_task()
    {
        $taskData = [
            'title' => 'Get Askadoc Offer',
            'description' => 'Get Askadoc Backend Developer Offer',
            'status' => 'pending',
            'due_date' => '2024-07-26'
        ];

        $task = Task::create($taskData);

        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals($taskData['title'], $task->title);
        $this->assertEquals($taskData['description'], $task->description);
        $this->assertEquals($taskData['status'], $task->status);
        $this->assertEquals($taskData['due_date'], $task->due_date->format('Y-m-d'));
    }
}
