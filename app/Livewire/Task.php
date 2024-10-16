<?php

namespace App\Livewire;

use App\Models\Task as TaskModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Task extends Component
{
    public string $title = '';

    public function render(): View
    {
        return view('livewire.task');
    }

    #[Computed]
    public function tasks(): Collection
    {
        return TaskModel::orderBy('created_at', 'desc')->get();
    }

    public function createTask(): void
    {
        TaskModel::create([
            'title' => $this->title,
            'status' => 'backlog',
        ]);

        $this->reset();
    }

    #[Computed]
    public function doneTasks(): int
    {
        return TaskModel::where('status', 'done')->count();
    }

    public function toggleTaskStatus(int $taskId): void
    {
        $task = TaskModel::find($taskId);

        $task?->update([
            'status' => $task->status === 'backlog' ? 'done' : 'backlog',
        ]);

        $this->reset();
    }

    public function deleteTask(int $taskId): void
    {
        $task = TaskModel::find($taskId);

        $task?->delete();
    }
}
