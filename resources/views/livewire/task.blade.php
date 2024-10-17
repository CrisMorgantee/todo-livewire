<div class="container mx-auto p-4">
  <!-- resources/views/tarefas.blade.php -->
  <div class="max-w-3xl mx-auto p-4 relative" >
    <!-- Formulário para adicionar tarefas -->
    <form wire:submit="createTask()" method="POST" class="flex gap-2 mb-4 absolute -top-10 right-0 left-0" >
      @csrf
      <div class="flex flex-col w-full relative" >
        @error('title')
        <span class="text-red-500 text-sm absolute -top-6" >
            Não é possível criar uma tarefa sem título.
        </span >
        @enderror
        <input type="text" wire:model.live.debounce.300ms="title" placeholder="Adicione uma nova tarefa"
               class="placeholder-slate-400 flex-1 px-4 py-2 bg-slate-700 text-slate-50  rounded focus:outline-none focus:ring-1 focus:ring-blue-800"/>
      </div >
      <button type="submit"
              class="flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" >
        Criar
        <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg" >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4v16m8-8H4" ></path >
        </svg >
      </button >

    </form >

    <!-- Resumo -->
    <div class="flex justify-between text-slate-200 my-4" >
      <span >Tarefas criadas: <span class="bg-slate-500 rounded px-2 py-0.5" >{{count($this->tasks)}}</span ></span >
      <span >Concluídas: <span
          class="bg-slate-500 rounded px-2 py-0.5" >{{$this->doneTasks}} de {{count($this->tasks)}}</span ></span >
    </div >
    <!-- Lista de Tarefas -->
    @forelse($this->tasks as $task)
      <div wire:key="{{$task->id}}" class="flex justify-between items-center bg-slate-700 px-6 py-4 rounded mb-2" >
        <div class="flex items-center w-full" >
          <label for="task_{{$task->id}}"
                 class="flex items-center text-slate-200 w-full {{ $task->status === 'done' ? 'line-through text-slate-400' : '' }}" >
            <input id="task_{{$task->id}}" type="checkbox" wire:click="toggleTaskStatus({{$task->id}})"
                   class="w-6 h-6 mr-3 bg-slate-800 rounded-md appearance-none border-2 border-slate-600 cursor-pointer relative checked:bg-blue-600 focus:ring-2 focus:ring-blue-800 focus:outline-none before:absolute before:top-1 before:left-1 checked:before:content-[''] before:w-2 before:h-3 before:border-2 before:border-slate-100 before:border-t-0 before:border-l-0 before:opacity-0 checked:before:opacity-100 checked:before:transform checked:before:rotate-45 transition-all " {{ $task->status === 'done' ? 'checked' : '' }}/>

            <span class="block" >{{ $task->title }}</span >
          </label >
        </div >

        <button wire:click="deleteTask({{ $task->id }})"
                class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700" >
          Excluir
        </button >

      </div >
    @empty
      <div class="text-slate-300 text-center py-10" >Nenhuma tarefa encontrada.</div >
    @endforelse
  </div >

</div >
