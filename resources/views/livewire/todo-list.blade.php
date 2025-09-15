<div class="w-full md:max-w-lg space-y-6 p-3 bg-white rounded shadow-md">
  <div class="text-center">
    <h1 class="font-semibold text-2xl text-secondary">{{ config('app.name') }}</h1>
    <p class="text-sm text-black/50">Simple todo app with Livewire</p>
  </div>
  <div class="space-y-4">
    <div class="grid grid-cols-12 gap-1">
      <input 
        type="text" 
        @class(['col-span-8' => $editMode, 'col-span-10' => !$editMode, 'px-2 py-1 border-b border-secondary hover:brightness-80'])
        wire:model="title"
        wire:keydown.enter="@if (!$editMode) store() @else update() @endif"
        placeholder="What to do..."
      />
      @if (!$editMode)
        <button class="col-span-2 p-2 bg-primary text-white rounded" wire:click="store()">
          <i class="bi bi-plus-lg"></i>
        </button>
      @else
        <button class="col-span-2 p-2 bg-primary text-white rounded" wire:click="update()">
          <i class="bi bi-floppy"></i>
        </button>
        <button class="col-span-2 p-2 bg-secondary text-white rounded" wire:click="cancelEdit()">
          <i class="bi bi-x-lg"></i>
        </button>
      @endif
      @error('title')
        <div class="col-span-full text-center">
          <p class="text-sm text-red-500">{{ $message }}</p>
        </div>
      @enderror
    </div>
    @if ($todos->count() > 0 || $search)
      <input type="text" class="w-full p-2 border rounded" wire:model.live="search" placeholder="Search..." />
      @if ($search)
        <p class="text-center text-sm text-black/50">
          Found {{ $todos->count() }} {{ Str::plural('result', $todos->count()) }} for "{{ $search }}"
        </p>
      @endif
      <ul class="max-h-72 overflow-auto space-y-2">
        @foreach ($todos as  $todo)
          <li wire:key="{{ $todo->id }}" @class(['flex items-center justify-between gap-2 p-3 text-white bg-secondary rounded', 'bg-secondary/50' => $todo->completed])>
            <div class="flex items-center gap-2">
              <input
                type="checkbox"
                wire:click="check({{ $todo->id }})"
                @if ($todo->completed) checked @endif
              />
              <span @class(['italic line-through' => $todo->completed])>{{ $todo->title }}</span>
            </div>
            <div class="flex items-center gap-2">
              <button wire:click="edit({{ $todo->id }})">
                <i class="bi bi-pencil"></i>
              </button>
              <button wire:click="delete({{ $todo->id }})">
                <i class="bi bi-trash"></i>
              </button>
            </div>
          </li>
        @endforeach
      </ul>
    @else 
      <div class="p-3 text-center border border-secondary rounded">
        <p class="text-sm text-secondary">You got nothing to do.</p>
      </div>
    @endif
  </div>
  <div class="text-center">
    <p class="text-sm text-black/50">
      &copy; 2025 <a href="https://github.com/Vinchands" class="underline text-primary">Kevin CS</a>
    </p>
  </div>
</div>
