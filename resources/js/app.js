import './bootstrap';

// Ao usar Livewire não preciso de ter aqui o Alpine
// import Alpine from 'alpinejs';
// import persist from '@alpinejs/persist'
// Alpine.plugin(persist)
// window.Alpine = Alpine;
// Alpine.start();



import jQuery from 'jquery'
window.$ = jQuery;
window.jQuery = jQuery;

import '../../vendor/rappasoft/laravel-livewire-tables/resources/imports/laravel-livewire-tables-all.js';

import 'select2';
import 'select2/dist/css/select2.min.css';



// Funções para correr codigo inteiro

$('#langs').on('change', function () {
    var selectedLocale = $(this).val();
    console.log('fez')
    $.ajax({
        url: '/lang/'+selectedLocale,
        type: 'GET',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function (response,statustxt) {
            if (statustxt === 'success') {
                location.reload(); // Page reload
            }
        }
    });
});

// document.addEventListener('DOMContentLoaded', () => {
//     $('.select2').select2();
// });

// document.addEventListener("livewire:load", () => {
//     Livewire.hook('message.processed', () => {
//         $('.select2').select2();
//     });
// });

