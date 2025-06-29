<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if ($id == 'new')
                {{ __('messages.new_analysis') }}
            @else
                {{ __('Nome da Analise') }}
            @endif
        </h2>
    </x-slot>


    <script>
        window.translations = {
            product: "{{ __('messages.product') }}"
        };
    </script>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Formulario

                    <div class="hidden">
                        <div class="w-32 h-32 bg-gray-200 flex flex-col justify-center items-center rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            <span class="mt-2 text-sm font-semibold text-gray-700">{{ __('messages.new_product') }}</span>
                        </div>
                    </div>


                    <div class="hidden btncopy" >
                        <div @click="open($event)" class="relative cursor-pointer w-32 h-32 bg-gray-200 flex flex-col justify-center items-center rounded hover:bg-gray-300 transition add" data="" image="">
                            <button @click.stop="remove($event)" class="absolute top-1 right-1 p-1 rounded hover:bg-red-200 hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600 plus" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            <span class="mt-2 text-sm font-semibold text-gray-700">{{ __('messages.new_product') }}</span>
                        </div>
                    </div>
                    

                    <!-- Products -->
                    <div class="flex gap-4" x-data="modalHandler()">
                        
                        <div class="buttonsprod flex flex-wrap gap-4">
                            <!-- Botão New -->
                            <div @click="open($event)" class="relative cursor-pointer w-32 h-32 bg-gray-200 flex flex-col justify-center items-center rounded hover:bg-gray-300 transition add" data="" image="">
                                <button @click.stop="remove($event)" class="absolute top-1 right-1 p-1 rounded hover:bg-red-200 hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500 remove">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600 plus" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                <span class="mt-2 text-sm font-semibold text-gray-700">{{ __('messages.new_product') }}</span>
                            </div>

                        </div>
                        
                        <!-- Modal -->
                        <div class="fixed inset-0 bg-black bg-opacity-25 flex items-center justify-center z-50" x-show="show" x-transition >
                            <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-4xl"> <!-- max-w-3xl -->
                                <div class="flex justify-between">
                                    <h2 class="text-lg font-semibold mb-4" x-text="modal.title"></h2>
                                    <button class="mr-2 px-4 py-2 bg-white rounded" type="button" @click="close()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                
                                <div>
                                    {{-- Image --}}
                                    <div class="mb-4 w-full">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.image') }}</label>
                                        <input type="file" accept="image/*" x-ref="image.modal_input_image" @change="loadImage($event)" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 transition">
                                        <!-- Preview da imagem + botão remover -->
                                        <template x-if="image.modal_input_image">
                                            <div class="mt-4 relative">
                                                <img :src="image.preview" alt="Preview" class="max-h-48 rounded shadow border border-gray-300">
                                                <button type="button" @click="removeImage()" class="absolute top-2 right-2 bg-white rounded-full p-1 shadow hover:bg-gray-100 transition" title="{{ __('messages.remove_image') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </template>
                                    </div>

                                    {{-- description & color --}}
                                    <div class="flex gap-2">
                                        <div class="mb-4 w-[80%]" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.description') }}</label>
                                            <input type="text" x-model="form.modal_input_description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                        </div>
                                        
                                        <div class="mb-4 w-[20%]" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.color') }}</label>

                                            <input type="color" x-model="form.modal_input_color"  class="mt-1 p-1 h-10 w-14 block bg-white border border-gray-200 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700" value="#000000">
                                        </div>
                                    </div>

                                    {{-- barcode & brand --}}
                                    <div class="flex gap-2">
                                        <div class="mb-4 w-[50%]" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.barcode') }}</label>
                                            <input type="text" x-model="form.modal_input_barcode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
                                        </div>

                                        <div class="mb-4 w-[50%]" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.brand') }}</label>
                                            <input type="text" x-model="form.modal_input_brand" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
                                        </div>
                                    </div>                                    

                                    {{-- Warning Text for Category and Type --}}
                                    <div class="basis-64 mb-4" x-show="view.showWarningText" x-transition>
                                        <label class="block text-sm font-medium text-red-700">{{ __('messages.modalProductWarningText') }}</label>
                                    </div>
                                    {{-- Category & Type --}}
                                    <div class="flex gap-2">
                                        <!-- Category -->
                                        <div class="mb-4 w-[40%]" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.category') }}</label>
                                            <select @change="selectCategory($event)" x-model="form.modal_select_category"
                                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">{{ __('messages.none') }}</option>
                                                @foreach ($categorys as $cat)
                                                    <option value="{{ $cat->code }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Type -->
                                        <div class="mb-4 w-[40%]" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.type') }}</label>
                                            <select @change="selectType($event)" x-model="form.modal_select_type"
                                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">{{ __('messages.none') }}</option>
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->code }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Botão -->
                                        <div class="flex justify-end items-end h-16"> <!-- Altura para demonstrar items-center -->
                                            <button type="button" @click="choseCombination($event)"
                                                    class="px-4 py-2 bg-gray-200 text-gray-800 font-medium rounded-md hover:bg-gray-300 focus:outline-none shadow-sm transition">
                                                {{ __('messages.choose') }}
                                            </button>
                                        </div>

                                      
                                    </div>

                                    {{-- Fields Display --}}
                                    <div class="flex flex-wrap gap-2">
                                        <div class="basis-64 mb-4" x-show="view.showModelInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.model') }}</label>
                                            <input type="text" x-model="form.modal_input_model" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showSerialInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.serial_number') }}</label>
                                            <input type="text" x-model="form.modal_input_serial" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showWidthInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.width') }}</label>
                                            <input type="number" min="0" step="0.01" x-model="form.modal_input_width" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showLenghtInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.length') }}</label>
                                            <input type="number" min="0" step="0.01" x-model="form.modal_input_length" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showVolumeInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.volume') }}</label>
                                            <input type="number" min="0" step="0.01" x-model="form.modal_input_volume" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showWeightInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.weigth') }}</label>
                                            <input type="number" min="0" step="0.01" x-model="form.modal_input_weight" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showDensityInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.density') }}</label>
                                            <input type="number" min="0" max="10" step="1" x-model="form.modal_input_density" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showMaterialInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.material') }}</label>
                                            <input type="number" min="0" max="10" step="1" x-model="form.modal_input_material" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showStorageTempInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.storagetemp') }}</label>
                                            <input type="number" min="0" max="10" step="1" x-model="form.modal_input_storagetemp" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showPhInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.ph') }}</label>
                                            <input type="number" min="0" max="10" step="1" x-model="form.modal_input_ph" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
                                        </div>
                                    
                                        <div class="basis-64 mb-4" x-show="view.showConcentrationInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.concentration') }}</label>
                                            <input type="number" min="0" max="10" step="1" x-model="form.modal_input_concentration" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showConcentrationUnitInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.concentrationUnit') }}</label>
                                            <input type="number" min="0" max="10" step="1" x-model="form.modal_input_concentrationUnit" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" >
                                        </div>

                                    </div>

                                    <!-- Mais campos aqui -->
                                    <div class="flex justify-end">
                                        <button type="button" @click="close()" class="mr-2 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">{{ __('messages.cancel') }}</button>
                                        <button type="button" @click="save($event)" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">{{ __('messages.save') }}</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                         <!-- Script para Alpine Modal -->
                        <script>
                            function modalHandler() {
                                // Alpine reconhece isto dentro do x-data
                                return {
                                    show: false,
                                    modal:{
                                        title: ''
                                    },
                                    view: {
                                        showColorInput: false,
                                        showWarningText: false,
                                        showHarzedousInput: false,
                                        showModelInput: false,
                                        showSerialInput: false,
                                        showWidthInput: false,
                                        showLenghtInput: false,
                                        showVolumeInput: false,
                                        showWeightInput: false,
                                        showDensityInput: false,
                                        showMaterialInput: false,
                                        showStorageTempInput: false,
                                        showPhInput: false,
                                        showConcentrationInput: false,
                                        showConcentrationUnitInput: false,
                                    },
                                    form: {
                                        modal_input_description:'',
                                        modal_input_brand:'',
                                        modal_input_barcode:'',
                                        modal_input_color:'',
                                        modal_select_category:'',
                                        modal_select_type:'',
                                        modal_input_is_hazardous:'',
                                        modal_input_model:'',
                                        modal_input_serial:'',
                                        modal_input_width: 0,
                                        modal_input_lenght: 0,
                                        modal_input_volume: 0,
                                        modal_input_weight: 0,
                                        modal_input_density: 0,
                                        modal_input_material: '',
                                        modal_input_storagetemp: 0,
                                        modal_input_ph: 0,
                                        modal_input_concentration: 0,
                                        modal_input_concentrationUnit: '',
                                    },
                                    select:{
                                        type: '',
                                        category: ''
                                    },
                                    image:{
                                        modal_input_image: null, 
                                        preview: '',  
                                    },                                    
                                    open(event) {
                                        const element = event.currentTarget;
                                        
                                        this.clearAll();

                                        var data = $(element).attr('data')
                                        var image = $(element).attr('image')
                                        
                                        if(data){
                                            data = JSON.parse(data);
                                            this.modal.title = 'Editar Produto';

                                            Object.keys(data).forEach(key => {
                                                console.log(this.form[key],data[key])
                                                this.form[key] = data[key];
                                            });         
                                            
                                            this.select.category = data.modal_select_category;
                                            this.select.type = data.modal_select_type;

                                            this.image.modal_input_image = image;
                                            this.image.preview = image;

                                        }else{
                                            this.modal.title = 'Novo Produto';
                                        }

                                        this.show = true;
                                    },
                                    loadImage(event){
                                        const file = event.target.files[0];
                                        if (!file) return;

                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            this.image.preview = e.target.result;
                                            this.image.modal_input_image = e.target.result;
                                        };
                                        reader.readAsDataURL(file);
                                    },
                                    removeImage(){
                                        this.image.preview = '';
                                        this.image.modal_input_image = '';
                                        this.$refs.image_modal_input_image.value = '';
                                    },
                                    selectCategory(event){
                                        const element = event.currentTarget;
                                        const categorycode = $(element).val();
                                        this.hideAll();
                                        this.select.category = categorycode;
                                    },
                                    selectType(event){
                                        const element = event.currentTarget;
                                        const typecode = $(element).val();
                                        this.hideAll();
                                        this.select.type = typecode;
                                    },
                                    choseCombination(){
                                        const keyCategory = this.select.category;
                                        const ketType = this.select.type;

                                        this.hideAll();

                                        fetch('/json/product_combinations.json')
                                        .then(response => response.json())
                                        .then(combinations => {

                                            const match = combinations.find(
                                                item => item.category === keyCategory && item.type === ketType
                                            );

                                            if(!match){
                                                this.view.showWarningText = true;
                                                return;
                                            }

                                            const fields = match.fields;

                                            fields.forEach(field => {
                                                const map = {
                                                    volume: 'showVolumeInput',
                                                    weight: 'showWeightInput',
                                                    density: 'showDensityInput',
                                                    ph: 'showPhInput',
                                                    storage_temp: 'showStorageTempInput',
                                                    concentration: 'showConcentrationInput',
                                                    concentration_unit: 'showConcentrationUnitInput',
                                                    model: 'showModelInput',
                                                    serial: 'showSerialInput',
                                                    width: 'showWidthInput',
                                                    lenght: 'showLenghtInput',
                                                    material: 'showMaterialInput',
                                                    color: 'showColorInput', // se quiseres
                                                    is_hazardous: 'showHarzedousInput'
                                                };

                                                const viewKey = map[field];
                                                if (viewKey) {
                                                    this.view[viewKey] = true;
                                                }
                                            });

                                        })
                                        .catch(error => {
                                            console.error('Erro ao carregar as combinações:', error);
                                        });
                                    },
                                    clearAll(){
                                        Object.keys(this.form).forEach(key => {
                                            this.form[key] = '';
                                        });

                                        this.select.category = '';
                                        this.select.type = '';

                                        // Se tiveres campos que não estão dentro de this.form, limpa-os também aqui
                                        this.image.modal_input_image = '';
                                        this.image.preview = '';
                                        
                                        $('input[type="file"]').val(null);
                                    },
                                    hideAll(){
                                        this.view.showWarningText = false,
                                        this.view.showModelInput = false;
                                        this.view.showSerialInput = false;
                                        this.view.showWidthInput = false;
                                        this.view.showLenghtInput = false;
                                        this.view.showVolumeInput = false;
                                        this.view.showWeightInput = false;
                                        this.view.showDensityInput = false;
                                        this.view.showMaterialInput = false;
                                        this.view.showStorageTempInput = false;
                                        this.view.showPhInput = false;
                                        this.view.showConcentrationInput = false;
                                        this.view.showConcentrationUnitInput = false;
                                    },
                                    remove(){
                                        const element = event.currentTarget.closest('.add');
                                        if (element) {
                                            element.remove();
                                        }  
                                    },
                                    save(event){
                                        const ele = $('.buttonsprod [data=""][image=""]');
                                        const div = ele.parent();

                                        const elecopy = $('div.btncopy').find('div').clone();

                                        if (ele) {
                                            
                                            // Falta validar os campos que são obrigatorios de preencher.
                                            // Descrição por agora

                                            if(this.form.modal_input_description === ""){
                                                // Tem de colocar um texto a vermelho sobre o campo
                                                return;
                                            }
                                            
                                            ele.attr('data', JSON.stringify(this.form));
                                            ele.attr('image',this.image.modal_input_image);

                                            if (this.image.modal_input_image) {
                                                ele.css({
                                                    'background-image': `url(${this.image.modal_input_image})`,
                                                    'background-size': 'cover',
                                                    'background-position': 'center'
                                                });
                                            }

                                            ele.find('button').removeClass('hidden');
                                            ele.find('span').text(window.translations.product+' '+div.find('div.add').length);
                                            ele.find('span').removeClass('mt-2 font-semibold text-gray-700')
                                            ele.find('span').addClass('p-2 bg-gray-300 text-black font-bold rounded-lg border-3 border-black')
                                            ele.find('svg.plus').remove();

                                            div.append(elecopy);

                                        }

                                        this.show = false;
                                    },
                                    close() {
                                        this.show = false;
                                    }
                                }
                            }
                        </script>

                    </div>

                    <div class="mt-4 h-2 bg-gradient-to-r from-cyan-500 to-blue-500"></div>

                    <div class="flex justify-end mb-2" x-data="choseSample()">
                        <button @click="open($event)" class="flex text-sm items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                        {{ __('Escolher analise') }}
                        </button>

                         <!-- Modal Sample -->
                        <div class="fixed inset-0 bg-black bg-opacity-25 flex items-center justify-center z-50" x-show="show" x-transition>
                            <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-4xl">
                                <div class="flex justify-between">
                                    <h2 class="text-lg font-semibold mb-4"></h2>
                                    <button @click="close($event)" class="mr-2 px-4 py-2 bg-white rounded" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                
                                <div>
                                    <div class="flex flex-col gap-2">
                                        
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.samples') }}</label>
                                            <select @change="selectSample($event)" x-model="form.modal_sample"
                                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">{{ __('messages.none') }}</option>
                                                @foreach ($test_samples as $sample)
                                                    <option value="{{ $sample->code }}" extras="{{ $sample->extras }}">{{ $sample->getLocalizedDescriptionAttribute()    }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="flex flex-col gap-2 mt-2 extras" x-show="view.text_label">
                                            <label class="block text-sm font-medium text-gray-700">fieldname 1</label>
                                            <label class="block text-sm font-medium text-gray-700">fieldtype</label>
                                        </div>

                                        <div class="flex flex-col gap-2 mt-2 cost">

                                        </div>

                                    </div>

                                    <!-- Botões ações -->
                                    <div class="flex justify-end">
                                        <button type="button" @click="close()" class="mr-2 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">{{ __('messages.cancel') }}</button>
                                        <button type="button" @click="save($event)" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">{{ __('messages.save') }}</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Script Samples -->
                        <script>
                            function choseSample(){
                                return {
                                    show:false,
                                    form:{
                                        modal_sample: '',
                                    },
                                    view:{
                                        text_label:false,
                                    },
                                    open() {
                                        this.show = true;
                                    },
                                    selectSample($event){
                                        const element = event.currentTarget;
                                        var sample = $(element).val()
                                        var extrasAttr = $(element).find('option:selected').attr('extras')
                                        var cost = $(element).find('option:selected').attr('cost')
                                        // console.log(extras)
                                        if (extrasAttr) {
                                            const extras = JSON.parse(extrasAttr);

                                            const container = $('.extras'); // div onde queres colocar as labels
                                            container.empty(); // limpa as anteriores

                                            const labelCost = $('<label>')
                                                    .addClass('block text-sm font-medium text-gray-700')
                                                    .text('Cost:');
                                             const inpCost = $('<label>')
                                                    .addClass('block text-sm font-medium text-gray-700')
                                                    .text(cost+'€');
                                            container.append(inpCost);

                                            const labelExtras = $('<label>')
                                                    .addClass('block text-sm font-medium text-gray-700')
                                                    .text('Fields:');
                                            container.append(labelExtras);


                                            extras.forEach((item) => {
                                                const labelName = $('<label>')
                                                    .addClass('block text-sm font-medium text-gray-700')
                                                    .text(item.fieldname);
                                                const labelType = $('<label>')
                                                    .addClass('block text-sm font-medium text-gray-700')
                                                    .text(item.fieldtype);
                                                const divflex = $('<div>').addClass('flex flex-row gap-4')
                                                divflex.append(labelName,labelType)
                                                container.append(divflex);
                                                
                                            });

                                            this.view.text_label = true
                                        }
                                    },
                                    close() {
                                        this.show = false;
                                    }
                                }
                            } 
                        </script>
                    </div>

                    <div class="flex gap-4 mt-2" x-data="loadSamples()">
                        <div class="flex flex-wrap justify-end items-center">
                            
                            <div @click="open($event)" class="relative cursor-pointer w-32 h-32 bg-gray-200 flex flex-col justify-center items-center rounded hover:bg-gray-300 transition add" data="" image="">
                                <button @click.stop="remove($event)" class="absolute top-1 right-1 p-1 rounded hover:bg-red-200 hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500 remove">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600 plus" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                <span class="mt-2 text-sm font-semibold text-gray-700">{{ __('Analise XPTO') }}</span>
                            </div>

                        </div>

                        <div class="samples">
                            
                        </div>

                        <!-- Modal Sample -->
                        <div class="fixed inset-0 bg-black bg-opacity-25 flex items-center justify-center z-50" x-show="show" x-transition>
                            <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-4xl">
                                <div class="flex justify-between">
                                    <h2 class="text-lg font-semibold mb-4"></h2>
                                    <button class="mr-2 px-4 py-2 bg-white rounded" type="button" @click="close()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                
                                <div>
                                    <div class="flex gap-2">
                                        
                                    </div>

                                    <!-- Botões ações -->
                                    <div class="flex justify-end">
                                        <button type="button" @click="close()" class="mr-2 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">{{ __('messages.cancel') }}</button>
                                        <button type="button" @click="save($event)" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">{{ __('messages.save') }}</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Script Samples -->
                        <script>
                            function loadSamples(){
                                return {
                                    show:false,
                                    open() {
                                        this.show = true;
                                    },
                                    close() {
                                        this.show = false;
                                    }
                                }
                            } 
                        </script>
                    </div>

                   
                    

                    <!-- Script -->
                    <script type='module'>
                        
                        console.log('Teste');

                        
                        

                        // $('.lang-tab').each(function(index,element){
                        //     $(element).on('click', () => {
                        //         let lang = $(this).attr('data-lang');
                        //         $('.lang-content').each(function(index,el){
                        //             $(el).addClass('hidden');
                        //         });
                        //         $(`.lang-content[data-lang="${lang}"]`).removeClass('hidden');
                        //     });
                        // });

                        // $('#btnExtra').on('click',function(){

                        //     var extra = $('div.extrafields').find('div');
                        //     var count = extra.length;

                        //     var ele = $('#extraCopy').clone();
                        //     ele = ele[0]; // Copiar Elemento
                        //     ele.id = 'extrafieldid'+count;
                        //     $(ele).find('[code="extrafieldid"]').attr('name','extrafields['+count+'][id]');
                        //     $(ele).find('[code="extrafieldname"]').attr('name','extrafields['+count+'][name]');
                        //     $(ele).find('[code="extrafieldtype"]').attr('name','extrafields['+count+'][type]');

                        //     $('.extrafields').append(ele);
                        // });

                    </script>

                </div>
            </div>
        </div>
    </div>

    
    
    

</x-app-layout>


