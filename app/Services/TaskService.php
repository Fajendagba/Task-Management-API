<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskService
{
    public function getAllTasks(): Collection
    {
        return Task::all();
    }

    public function getTaskById(int $id): Task
    {
        return Task::findOrFail($id);
    }

    public function createTask(array $data): Task
    {
        return Task::create($data);
    }

    public function updateTask(int $id, array $data): Task
    {
        $task = $this->getTaskById($id);
        $task->update($data);
        return $task;
    }

    public function deleteTask(int $id): void
    {
        $task = $this->getTaskById($id);
        $task->delete();
    }
}
