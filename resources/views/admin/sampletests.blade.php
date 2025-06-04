<x-app-layout>
   

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.admin-samples-test') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="flex justify-end mb-2">
                        <a class="flex text-sm items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" href="{{ route('admin-sample-form',['new']) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                           {{ __('messages.create_new') }}
                        </a>
                    </div>

                    <livewire:sample-test-datatable />

                </div>
            </div>
        </div>
    </div>
</x-app-layout>