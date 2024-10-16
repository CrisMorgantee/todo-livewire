<?php

namespace App\Livewire;

use AllowDynamicProperties;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

#[AllowDynamicProperties] class Task extends Component
{
    public string $titulo = '';

    public function render(): View
    {
        return view('livewire.task');
    }

    #[Computed]
    public function tasks(): Collection
    {
        return \App\Models\Task::all();
    }

    public function createTask(): void
    {
        \App\Models\Task::create([
            'titulo' => $this->titulo,
            'status' => 'aberto',
        ]);

        $this->reset();
    }

    #[Computed]
    public function doneTasks(): int
    {
        return \App\Models\Task::where('status', 'concluido')->count();
    }

    public function toggleTaskStatus(int $taskId): void
    {
        $task = \App\Models\Task::find($taskId);

        if (!$task) {
            return;
        }

        // Alternar o status
        $task->status = $task->status === 'concluido' ? 'aberto' : 'concluido';
        $task->save();
    }

    public function deleteTask(int $taskId): void
    {
        $task = \App\Models\Task::find($taskId);

        $task?->delete();
    }
}
