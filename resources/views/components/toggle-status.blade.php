<div class="flex justify-center">
    <button 
        wire:click="toggleEstado({{ $row->id }})" 
        class="inline-block px-3 py-1 rounded text-white font-semibold transition 
               {{ $row->status ? 'bg-teal-500 hover:bg-teal-600' : 'bg-slate-500 hover:bg-slate-600' }}"
    type="button"
    >
        {{ $row->status ? __('messages.active') : __('messages.inactive') }}
    </button>
</div>