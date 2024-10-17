<?php

use App\Models\Task;
use Livewire\Livewire;

beforeEach(function() {
    Task::truncate();
});

it('pode criar uma nova tarefa', function() {
    Livewire::test('task')
        ->set('title', 'Nova Tarefa')
        ->call('createTask')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('tasks', [
        'title'  => 'Nova Tarefa',
        'status' => 'backlog',
    ]);
});

it('pode listar todas as tarefas', function() {
    Task::factory()->create(['title' => 'Tarefa 1']);
    Task::factory()->create(['title' => 'Tarefa 2']);

    Livewire::test('task')
        ->assertSee('Tarefa 1')
        ->assertSee('Tarefa 2');
});

it('pode alternar o status de uma tarefa', function() {
    $task = Task::factory()->create(['title' => 'Tarefa Teste', 'status' => 'backlog']);

    Livewire::test('task')
        ->call('toggleTaskStatus', $task->id)
        ->assertHasNoErrors();

    $this->assertDatabaseHas('tasks', [
        'id'     => $task->id,
        'status' => 'done',
    ]);
});

it('pode deletar uma tarefa', function() {
    $task = Task::factory()->create(['title' => 'Tarefa a Deletar']);

    Livewire::test('task')
        ->call('deleteTask', $task->id)
        ->assertHasNoErrors();

    $this->assertDatabaseMissing('tasks', [
        'id' => $task->id,
    ]);
});

it('nao pode criar uma tarefa sem título', function() {
    Livewire::test('task')
        ->set('title', '')
        ->call('createTask')
        ->assertHasErrors(['title']);

    $this->assertDatabaseMissing('tasks', [
        'status' => 'backlog',
    ]);
});
