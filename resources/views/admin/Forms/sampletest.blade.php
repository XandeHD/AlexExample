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

                        {{-- <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">{{ __('messages.description') }}</label>
                            <input type="text" name="description" id="description" value="{{ old('description', $test_sample->description ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div> --}}

                        <!-- Cost -->
                        <div>
                            <label for="cost" class="block text-sm font-medium text-gray-700">{{ __('messages.cost') }}</label>
                            <input type="number" name="cost" id="cost" value="{{ old('cost', $test_sample->cost ?? '') }}" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">{{ __('messages.status') }}</label>
                            <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="1" {{ old('status', $test_sample->status ?? '0') == '1' ? 'selected' : '' }}>Ativo</option>
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

                            @foreach(config('app.languages') as $lang)
                                <div class="lang-content {{ $lang !== Session::get('locale') ? 'hidden' : '' }}" data-lang="{{ $lang }}">
                                    <textarea name="descriptions[{{ $lang }}]" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" rows="3" placeholder="{{ __('messages.description_in').strtoupper($lang) }}">
                                        {{ old("descriptions.$lang", trim($test_sample->descriptions[$lang]['description'] ?? '') ) }}
                                    </textarea>
                                </div>
                            @endforeach
                        </div>


                        <div>
                            {{-- Element to Copy --}}
                            <div class="hidden">
                                <div class="flex items-center gap-2 mb-2" id="extraCopy">
                                    <input type="text" code="extrafieldid" placeholder="{{ __('id') }}" class="hidden flex-1 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
                                    <input type="text" code="extrafieldname" placeholder="{{ __('messages.label_extra_name') }}" class="flex-1 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
                                    <input type="text" code="extrafieldtype" placeholder="{{ __('messages.label_extra_type') }}" class="flex-1 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <button type="button" onclick="this.closest('div[id^=extrafieldid]').remove();" class="bg-red-500 hover:bg-red-600 text-white px-2 py-2 rounded-md"title="{{ __('messages.remove') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9l3.536-3.536a1 1 0 10-1.414-1.414L10 7.586 6.464 4.05A1 1 0 105.05 5.464L8.586 9l-3.536 3.536a1 1 0 101.414 1.414L10 10.414l3.536 3.536a1 1 0 001.414-1.414L11.414 9z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.label_extrafields') }}</label>
                                <div>
                                   <button class="text-sm bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 inline-flex items-center gap-1" id="btnExtra" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ __('messages.new') }}
                                    </button>
                                </div>
                            </div>

                            <div class="extrafields mt-3">
                                @if (old('extrafields') || isset($test_sample->extrafields))
                                    @if (old('extrafields'))
                                        @foreach (old('extrafields') as $key => $extra)
                                                <div class="flex items-center gap-2 mb-2" id="extrafieldid{{ $key }}">
                                                    <input type="text" name="extrafields[{{ $key }}][id]" value="{{ $extra['id'] }}" placeholder="{{ __('id') }}" class="hidden flex-1 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
                                                    <input type="text" name="extrafields[{{ $key }}][name]" value="{{ $extra['name'] }}" placeholder="{{ __('messages.label_extra_name') }}" class="flex-1 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
                                                    <input type="text" name="extrafields[{{ $key }}][type]" value="{{ $extra['type'] }}" placeholder="{{ __('messages.label_extra_type') }}" class="flex-1 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
                                                    <button type="button" onclick="this.closest('div[id^=extrafieldid]').remove();" class="bg-red-500 hover:bg-red-600 text-white px-2 py-2 rounded-md"title="{{ __('messages.remove') }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M10 9l3.536-3.536a1 1 0 10-1.414-1.414L10 7.586 6.464 4.05A1 1 0 105.05 5.464L8.586 9l-3.536 3.536a1 1 0 101.414 1.414L10 10.414l3.536 3.536a1 1 0 001.414-1.414L11.414 9z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </div>
                                        @endforeach
                                    @else
                                        @foreach ($test_sample->extrafields as $key => $extra)
                                            <div class="flex items-center gap-2 mb-2" id="extrafieldid{{ $key }}">
                                                <input type="text" name="extrafields[{{ $key }}][id]" value="{{ $extra->fieldid }}" placeholder="{{ __('id') }}" class="hidden flex-1 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
                                                <input type="text" name="extrafields[{{ $key }}][name]" value="{{ $extra->fieldname }}" placeholder="{{ __('messages.label_extra_name') }}" class="flex-1 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
                                                <input type="text" name="extrafields[{{ $key }}][type]" value="{{ $extra->fieldtype }}" placeholder="{{ __('messages.label_extra_type') }}" class="flex-1 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
                                                <button type="button" onclick="this.closest('div[id^=extrafieldid]').remove();" class="bg-red-500 hover:bg-red-600 text-white px-2 py-2 rounded-md"title="{{ __('messages.remove') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 9l3.536-3.536a1 1 0 10-1.414-1.414L10 7.586 6.464 4.05A1 1 0 105.05 5.464L8.586 9l-3.536 3.536a1 1 0 101.414 1.414L10 10.414l3.536 3.536a1 1 0 001.414-1.414L11.414 9z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endforeach
                                    @endif

                                    
                                @endif

                                

                               {{-- <div class="flex items-center gap-2 mb-2" id="extrafieldid[]">
                                    <input type="text" name="extrafield[][id]" placeholder="{{ __('id') }}" class="hidden flex-1 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
                                    <input type="text" name="extrafield[][name]" placeholder="{{ __('messages.label_extra_name') }}" class="flex-1 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
                                    <input type="text" name="extrafield[][type]" placeholder="{{ __('messages.label_extra_type') }}" class="flex-1 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <button type="button" onclick="this.closest('div[id^=extrafieldid]').remove();" class="bg-red-500 hover:bg-red-600 text-white px-2 py-2 rounded-md"title="{{ __('messages.remove') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9l3.536-3.536a1 1 0 10-1.414-1.414L10 7.586 6.464 4.05A1 1 0 105.05 5.464L8.586 9l-3.536 3.536a1 1 0 101.414 1.414L10 10.414l3.536 3.536a1 1 0 001.414-1.414L11.414 9z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div> --}}

                            </div>
                            
                            
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

                        $('#btnExtra').on('click',function(){

                            var extra = $('div.extrafields').find('div');
                            var count = extra.length;

                            var ele = $('#extraCopy').clone();
                            ele = ele[0]; // Copiar Elemento
                            ele.id = 'extrafieldid'+count;
                            $(ele).find('[code="extrafieldid"]').attr('name','extrafields['+count+'][id]');
                            $(ele).find('[code="extrafieldname"]').attr('name','extrafields['+count+'][name]');
                            $(ele).find('[code="extrafieldtype"]').attr('name','extrafields['+count+'][type]');

                            $('.extrafields').append(ele);
                        });

                    </script>


                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>