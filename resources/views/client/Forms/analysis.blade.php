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
                            <span class="mt-2 text-sm font-semibold text-gray-700">Novo Produto</span>
                        </div>
                    </div>
                    


                    <!-- Products -->
                    <div class="flex gap-4" x-data="modalHandler()">
                        
                        <div class="buttonsprod">
                            <!-- Botão New -->
                            <div @click="open($event)" class="cursor-pointer w-32 h-32 bg-gray-200 flex flex-col justify-center items-center rounded hover:bg-gray-300 transition" data="">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                <span class="mt-2 text-sm font-semibold text-gray-700">Novo Produto</span>
                            </div>
                        </div>
                        
                        <!-- Modal -->
                        <div class="fixed inset-0 bg-black bg-opacity-25 flex items-center justify-center z-50" x-show="show" x-transition >
                            <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-4xl"> <!-- max-w-3xl -->
                                <div class="flex justify-between">
                                    <h2 class="text-lg font-semibold mb-4" x-text="form.modalTitle"></h2>
                                    <button class="mr-2 px-4 py-2 bg-white rounded" type="button" @click="close()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                
                                <div>



                                    <div class="mb-4" x-transition>
                                        <label class="block text-sm font-medium text-gray-700">{{ __('messages.description') }}</label>
                                        <input type="text" x-model="form.modal_input_description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: Produto X">
                                    </div>


                                    <div class="mb-4" x-transition>
                                        <label class="block text-sm font-medium text-gray-700">{{ __('messages.brand') }}</label>
                                        <input type="text" x-model="form.modal_input_brand" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: Líquido">
                                    </div>

                                    <div class="mb-4" x-transition>
                                        <label class="block text-sm font-medium text-gray-700">{{ __('messages.barcode') }}</label>
                                        <input type="text" x-model="form.modal_input_barcode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: Líquido">
                                    </div>

                                    <div class="mb-4" x-transition>
                                        <label class="block text-sm font-medium text-gray-700">{{ __('messages.color') }}</label>
                                        <input type="text" x-model="form.modal_input_color" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: Líquido">
                                    </div>

                                    <div class="basis-64 mb-4" x-show="view.showWarningText" x-transition>
                                        <label class="block text-sm font-medium text-gray-700">{{ 'Por favor indique corretamente uma categoria e um tipo' }}</label>
                                    </div>

                                    <div class="flex flex-row justify-between items-center">
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.category') }}</label>
                                            <select @change="selectCategory($event)" x-model="form.modal_select_category">
                                                <option value="">None</option>
                                                @foreach ($categorys as $cat)
                                                    <option value="{{ $cat->code }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                         <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.type') }}</label>
                                            <select @change="selectType($event)" x-model="form.modal_select_type">
                                                <option value="">None</option>
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->code }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-4">
                                            <button type="button" @click="choseCombination($event)" class="mr-2 px-4 py-2 bg-green-400 rounded hover:bg-green-600">Escolher</button>
                                        </div>
                                    </div>

                                   

                                   

                                    
                                    
                                    


                                    
                                    
                                    
                                    
                                    


                                    <div class="flex flex-wrap">
                                        <div class="basis-64 mb-4" x-show="view.showModelInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.model') }}</label>
                                            <input type="text" x-model="form.modal_input_model" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: Líquido">
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showSerialInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.serial_number') }}</label>
                                            <input type="text" x-model="form.modal_input_serial" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: Líquido">
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showWidthInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.width') }}</label>
                                            <input type="number" min="0" step="0.01" x-model="form.modal_input_width" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: Líquido">
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showLenghtInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.length') }}</label>
                                            <input type="number" min="0" step="0.01" x-model="form.modal_input_length" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: Líquido">
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showVolumeInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.volume') }}</label>
                                            <input type="number" min="0" step="0.01" x-model="form.modal_input_volume" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: Líquido">
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showWeightInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.weigth') }}</label>
                                            <input type="number" min="0" step="0.01" x-model="form.modal_input_weight" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: Líquido">
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showDensityInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.density') }}</label>
                                            <input type="number" min="0" max="10" step="1" x-model="form.modal_input_density" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: Líquido">
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showMaterialInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.density') }}</label>
                                            <input type="number" min="0" max="10" step="1" x-model="form.modal_input_material" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: Líquido">
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showStorageTempInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.storagetemp') }}</label>
                                            <input type="number" min="0" max="10" step="1" x-model="form.modal_input_storagetemp" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: Líquido">
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showPhInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.ph') }}</label>
                                            <input type="number" min="0" max="10" step="1" x-model="form.modal_input_ph" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: Líquido">
                                        </div>
                                    
                                        <div class="basis-64 mb-4" x-show="view.showConcentrationInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.concentration') }}</label>
                                            <input type="number" min="0" max="10" step="1" x-model="form.modal_input_concentration" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: Líquido">
                                        </div>

                                        <div class="basis-64 mb-4" x-show="view.showConcentrationUnitInput" x-transition>
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.concentrationUnit') }}</label>
                                            <input type="number" min="0" max="10" step="1" x-model="form.modal_input_concentrationUnit" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: Líquido">
                                        </div>

                                    </div>

                                    

                                   




                                    <!-- Mais campos aqui -->
                                    <div class="flex justify-end">
                                        <button type="button" @click="close()" class="mr-2 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancelar</button>
                                        <button type="button" @click="save($event)" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Guardar</button>
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
                                    view: {
                                        showWarningText: false,
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
                                        modalTitle:'',
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
                                    open(event) {

                                        const element = event.currentTarget;
                                        
                                        var data = $(element).attr('data')
                                        
                                        if(data){
                                            console.log(data)
                                        }else{
                                            this.form.modalTitle = 'Novo Produto';
                                        }

                                        // const dataAttr = ele.getAttribute('data');
                                       
                                        // if (dataAttr) {
                                        //     console.log('Atributo data:', dataAttr);
                                        //     // Podes usar isso para carregar dados dinamicamente, por exemplo
                                        // }

                                        this.show = true;
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
                                        const key = this.select.category+'_'+this.select.type;
                                        console.log(key)

                                        switch(key) {
                                            case 'cosmetics_liquid':
                                                
                                                this.view.showLenghtInput = true;
                                                this.view.showSerialInput = true;
                                                this.view.showVolumeInput = true;
                                                this.view.showWeightInput = true;
                                                this.view.showDensityInput = true;
                                                this.view.showPhInput = true;
                                                this.view.showStorageTempInput = true;
                                                this.view.showConcentrationInput = true;
                                                this.view.showConcentrationUnitInput = true;

                                                break;

                                            default:
                                                this.hideAll();
                                                this.view.showWarningText = true;
                                                break;
                                        }
                                                //     case 'cosmetics_solid':
                                                //         console.log('Cosmetics - Solid');
                                                //         break;
                                                //     case 'cosmetics_semi_solid':
                                                //         console.log('Cosmetics - Semi-solid');
                                                //         break;
                                                //     case 'cosmetics_gas':
                                                //         console.log('Cosmetics - Gas');
                                                //         break;
                                                //     case 'cosmetics_powder':
                                                //         console.log('Cosmetics - Powder');
                                                //         break;
                                                //     case 'cosmetics_aerosol':
                                                //         console.log('Cosmetics - Aerosol');
                                                //         break;
                                                //     case 'cosmetics_capsule':
                                                //         console.log('Cosmetics - Capsule');
                                                //         break;
                                                //     case 'cosmetics_tablet':
                                                //         console.log('Cosmetics - Tablet');
                                                //         break;
                                                //     case 'cosmetics_suspension':
                                                //         console.log('Cosmetics - Suspension');
                                                //         break;
                                                //     case 'cosmetics_emulsion':
                                                //         console.log('Cosmetics - Emulsion');
                                                //         break;
                                                //     case 'cosmetics_paste':
                                                //         console.log('Cosmetics - Paste');
                                                //         break;
                                                //     case 'cosmetics_sample_kit':
                                                //         console.log('Cosmetics - Sample Kit');
                                                //         break;

                                                //     case 'pharmaceuticals_liquid':
                                                //         console.log('Pharmaceuticals - Liquid');
                                                //         break;
                                                //     case 'pharmaceuticals_tablet':
                                                //         console.log('Pharmaceuticals - Tablet');
                                                //         break;
                                                //     case 'pharmaceuticals_capsule':
                                                //         console.log('Pharmaceuticals - Capsule');
                                                //         break;
                                                //     case 'pharmaceuticals_powder':
                                                //         console.log('Pharmaceuticals - Powder');
                                                //         break;
                                                //     case 'pharmaceuticals_suspension':
                                                //         console.log('Pharmaceuticals - Suspension');
                                                //         break;
                                                //     case 'pharmaceuticals_emulsion':
                                                //         console.log('Pharmaceuticals - Emulsion');
                                                //         break;

                                                //     case 'food_liquid':
                                                //         console.log('Food - Liquid');
                                                //         break;
                                                //     case 'food_solid':
                                                //         console.log('Food - Solid');
                                                //         break;
                                                //     case 'food_powder':
                                                //         console.log('Food - Powder');
                                                //         break;

                                                //     case 'hygiene_liquid':
                                                //         console.log('Hygiene - Liquid');
                                                //         break;
                                                //     case 'hygiene_solid':
                                                //         console.log('Hygiene - Solid');
                                                //         break;
                                                //     case 'hygiene_aerosol':
                                                //         console.log('Hygiene - Aerosol');
                                                //         break;

                                                //     case 'rawmaterials_powder':
                                                //         console.log('Raw Materials - Powder');
                                                //         break;
                                                //     case 'rawmaterials_liquid':
                                                //         console.log('Raw Materials - Liquid');
                                                //         break;
                                                //     case 'rawmaterials_solid':
                                                //         console.log('Raw Materials - Solid');
                                                //         break;

                                                //     case 'environmental_liquid':
                                                //         console.log('Environmental - Liquid');
                                                //         break;
                                                //     case 'environmental_gas':
                                                //         console.log('Environmental - Gas');
                                                //         break;
                                                //     case 'environmental_solid':
                                                //         console.log('Environmental - Solid');
                                                //         break;

                                                //     case 'biotech_liquid':
                                                //         console.log('Biotech - Liquid');
                                                //         break;
                                                //     case 'biotech_semi_solid':
                                                //         console.log('Biotech - Semi-solid');
                                                //         break;
                                                //     case 'biotech_powder':
                                                //         console.log('Biotech - Powder');
                                                //         break;

                                                //     case 'chemicals_liquid':
                                                //         console.log('Chemicals - Liquid');
                                                //         break;
                                                //     case 'chemicals_powder':
                                                //         console.log('Chemicals - Powder');
                                                //         break;
                                                //     case 'chemicals_solid':
                                                //         console.log('Chemicals - Solid');
                                                //         break;

                                                //     default:
                                                //         console.log('Unknown combination');
                                                //         break;
                                                // }
                                        

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
                                    save(event){
                                        console.log('guardei');

                                        // Dá para ir buscar todos os dados da seguinte maneira
                                        console.log(JSON.stringify(this.form, null, 2));

                                        this.show = false;
                                    },
                                    close() {
                                        this.show = false;
                                    }
                                }
                            }
                        </script>

                    </div>

                   
                    

                    <!-- Script simples para trocar línguas -->
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


