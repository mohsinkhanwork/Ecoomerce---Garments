
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

/*
const app = new Vue({
    el: '#app'
});
*/

//window.FilePondPluginFileEncode = require('../../node_modules/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min');
//window.FilePondPluginFileValidateSize = require('../../node_modules/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js');
//window.FilePondPluginImageExifOrientation = require('../../node_modules/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js');
//window.FilePondPluginImagePreview = require('../../node_modules/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js');
//window.FilePondPolyfill = require('../../node_modules/filepond-polyfill/dist/filepond-polyfill.min.js');
//window.FilePond = require('../../node_modules/filepond/dist/filepond.min.js');