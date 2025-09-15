<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Todo;

class TodoList extends Component
{
    public $editMode = false;
    public $title = '';
    public $search = '';
    public $todoId;
    
    public function store()
    {
        $validated = $this->validate([
            'title' => 'required|string',
        ]);
        
        Todo::create($validated);
        
        $this->title = '';
    }
    
    public function check($id)
    {
        $todo = Todo::find($id);
        $todo->completed = !$todo->completed;
        $todo->save();
    }
    
    public function edit($id)
    {
        $todo = Todo::find($id);
        
        $this->todoId = $id;
        $this->title = $todo->title;
        $this->editMode = true;
    }
    
    public function update()
    {
        $validated = $this->validate([
            'title' => 'required|string',
        ]);
        
        $todo = Todo::find($this->todoId);
        $todo->update($validated);
        
        $this->cancelEdit();
    }
    
    public function delete($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
    }
    
    public function cancelEdit()
    {
        $this->title = '';
        $this->todoId = null;
        $this->editMode = false;
    }
    
    public function render()
    {
        $query = Todo::orderBy('completed', 'asc');
        
        if ($this->search) $query->where(
          'title', 'LIKE', '%'.$this->search.'%'
        );
        
        $todos = $query->get();
        
        return view('livewire.todo-list', compact('todos'));
    }
}
