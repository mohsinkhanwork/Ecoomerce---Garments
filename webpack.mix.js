const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js(
		'resources/js/app.js', 'public/js')
			.sass('resources/sass/app.scss', 'public/css');

		
//window.FilePond = require('../../../node_modules/filepond/dist/filepond.min.js');
//window.FilePondPluginImagePreview = require('../../../node_modules/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js');
//window.FilePondPluginImageExifOrientation = require('../../../node_modules/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js');
//window.FilePondPluginFileValidateSize = require('../../../node_modules/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js');