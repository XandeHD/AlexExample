<div class="flex justify-center">
    <button 
        wire:click="toggleApproved({{ $row->id }})" 
        class="inline-block px-3 py-1 rounded text-white font-semibold transition 
               {{ $row->approved ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }}"
    type="button" >
        {{ (bool)$row->approved ? __('messages.approved') : __('messages.not_approved') }}
    </button>
</div>