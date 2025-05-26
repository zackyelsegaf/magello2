/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
// import 'select2/dist/css/select2.min.css';
// import 'select2';

import 'bootstrap'; // pastikan sudah install bootstrap

import 'bootstrap-select/dist/js/bootstrap-select.min.js';
import 'bootstrap-select/dist/css/bootstrap-select.min.css';

import Alpine from 'alpinejs'
 
window.Alpine = Alpine
 
Alpine.start()

// Contoh inisialisasi otomatis
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.ts-select').forEach(function (el) {
        new TomSelect(el, {
            create: false,
            placeholder: el.getAttribute('placeholder') || 'Pilih opsi...',
        });
    });
});


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
