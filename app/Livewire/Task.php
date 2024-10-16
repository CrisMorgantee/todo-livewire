<?php

namespace App\Livewire;

use App\Models\Task as TaskModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Task extends Component
{
    public string $titulo = '';

    public function render(): View
    {
        return view('livewire.task');
    }

    #[Computed]
    public function tasks(): Collection
    {
        return TaskModel::all();
    }

    public function createTask(): void
    {
        TaskModel::create([
            'titulo' => $this->titulo,
            'status' => 'aberto',
        ]);

        $this->reset();
    }

    #[Computed]
    public function doneTasks(): int
    {
        return TaskModel::where('status', 'concluido')->count();
    }

    public function toggleTaskStatus(int $taskId): void
    {
        $task = TaskModel::find($taskId);

        $task?->update([
            'status' => $task->status === 'aberto' ? 'concluido' : 'aberto',
        ]);

        $this->reset();
    }

    public function deleteTask(int $taskId): void
    {
        $task = TaskModel::find($taskId);

        $task?->delete();
    }
}
