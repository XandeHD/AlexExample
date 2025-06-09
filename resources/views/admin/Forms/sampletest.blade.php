<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if(isset($test_sample)) {{ __('messages.admin-sample-test-form') }} @else {{ __('messages.admin-sample-test-new') }} @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    @if(isset($test_sample)) {{ __('messages.admin-sample-test-form') }} @else {{ __('messages.admin-sample-test-new') }} @endif
                   
                    <br>
                    @if(isset($test_sample)) {{ $test_sample->description }} @endif


                    <!-- resources/views/samples/form.blade.php -->

                    @php
                        if(isset($test_sample)){
                            $routeid = $test_sample->id;
                        }else{
                            $routeid = 'new';
                        }
                    @endphp

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h3>Erros:</h3>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.sample-form-save',[$routeid]) }}" class="space-y-6">
                        @csrf

                        <!-- Code -->
                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700">{{ __('messages.code') }}</label>
                            <input type="text" name="code" id="code" value="{{ old('code', $test_sample->code ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">{{ __('messages.description') }}</label>
                            <input type="text" name="description" id="description" value="{{ old('description', $test_sample->description ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>

                        <!-- Cost -->
                        <div>
                            <label for="cost" class="block text-sm font-medium text-gray-700">{{ __('messages.cost') }}</label>
                            <input type="number" name="cost" id="cost" value="{{ old('cost', $test_sample->cost ?? '') }}" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">{{ __('messages.status') }}</label>
                            <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="1" {{ old('status', $test_sample->status) == '1' ? 'selected' : '' }}>Ativo</option>
                                <option value="0" {{ old('status', $test_sample->status ?? '0') == '0' ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>

                        <!-- Description MultiLanguage -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.description-lang') }}</label>
                            <div class="flex space-x-2 mb-2">
                                @foreach(config('app.languages') as $lang)
                                    <button type="button" class="lang-tab px-3 py-1 border rounded text-sm bg-gray-100 hover:bg-gray-200" data-lang="{{ $lang }}">{{ $lang }}</button>
                                @endforeach
                            </div>

                           {{-- {{ dd($test_sample->descriptions);}} --}}

                            @foreach(config('app.languages') as $lang)
                                <div class="lang-content {{ $lang !== Session::get('locale') ? 'hidden' : '' }}" data-lang="{{ $lang }}">
                                    <textarea name="descriptions[{{ $lang }}]" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" rows="3" placeholder="{{ __('messages.description_in').strtoupper($lang) }}">
                                        {{ old("descriptions.$lang", trim($test_sample->descriptions[$lang]['description'] ?? '') ) }}
                                    </textarea>
                                </div>
                            @endforeach
                        </div>

                        <!-- Botão -->
                        <div>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">{{ __('messages.save') }}</button>
                        </div>
                    </form>

                    <!-- Script simples para trocar línguas -->
                    <script type='module'>

                        $('.lang-tab').each(function(index,element){
                            $(element).on('click', () => {
                                let lang = $(this).attr('data-lang');
                                $('.lang-content').each(function(index,el){
                                    $(el).addClass('hidden');
                                });
                                $(`.lang-content[data-lang="${lang}"]`).removeClass('hidden');
                            });
                        });

                    </script>


                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>