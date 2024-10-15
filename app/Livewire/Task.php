<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Task extends Component
{
    public function render(): View
    {
        return view('livewire.task');
    }

    #[Computed]
    public function tasks(): Collection
    {
        return \App\Models\Task::all();
    }

    public function createTask(string $title, string $description): void
    {
        \App\Models\Task::create([
            'title'       => $title,
            'description' => $description,
            'status'      => 'aberto',
        ]);
    }

    #[Computed]
    public function doneTasks(): void
    {
        \App\Models\Task::where('status' , 'concluido')->count();
    }

    public function toggleTaskStatus(int $taskId): void
    {
        $task         = \App\Models\Task::find($taskId);
        $task->status = $task->status === 'aberto' ? 'concluido' : 'aberto';
        $task->save();
    }
}
