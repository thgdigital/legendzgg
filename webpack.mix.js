let mix = require('laravel-mix');

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


mix.js('resources/assets/js/app.js', 'public/admin/js')
   .sass('resources/assets/sass/app.scss', 'public/admin/css');

mix.scripts([
    'resources/assets/js/site.js',
], 'public/assets/js/site.js')


mix.scripts([
    'resources/assets/dist/js/app.js',
    'resources/assets/dist/js/demo.js',
    'resources/assets/plugins/iCheck/icheck.min.js',
    'resources/assets/plugins/sparkline/jquery.sparkline.min.js',
    'resources/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
    'resources/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
    'resources/assets/plugins/knob/jquery.knob.js',
    'resources/assets/plugins/axiosdaterangepicker/daterangepicker.js',
    'resources/assets/plugins/datepicker/bootstrap-datepicker.js',
    'resources/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
    'resources/assets/plugins/slimScroll/jquery.slimscroll.min.js',
    'resources/assets/plugins/fastclick/fastclick.js',
    'resources/assets/plugins/morris/morris.min.js',
    'resources/assets/plugins/select2/select2.min.js',


], 'public/admin/js/all.js');


mix.styles([

    'resources/assets/dist/css/skins/_all-skins.css',
    'resources/assets/dist/css/AdminLTE.css',
    'resources/assets/plugins/iCheck/square/blue.css',
    'resources/assets/plugins/morris/morris.css',
    'resources/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
    'resources/assets/plugins/datepicker/datepicker3.css',
    'resources/assets/plugins/daterangepicker/daterangepicker.css',
    'resources/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
    'resources/assets/plugins/select2/select2.min.css',



], 'public/admin/css/all.css');
