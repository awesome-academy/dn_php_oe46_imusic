const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js/app.js')
    .postCss('resources/css/app.css', 'public/css', [
    ]).scripts('resources/theme_admin/js/jquery.dataTables.min.js','public/js/jquery.dataTables.min.js')
    .scripts('resources/theme_admin/js/dataTables.bootstrap4.min.js','public/js/dataTables.bootstrap4.min.js')
    .js('resources/js/showimg.js','public/js/showimg.js')
    .js('resources/theme_admin/js/jquery-3.5.1.js','public/js/jquery-3.5.1.js')
    .styles('resources/css/app.css','public/css/app.css')
    .styles('resources/web/css/style.css', 'public/css/style.css')
    .styles('resources/web/css/bootstrap.min.css','public/css/bootstrap1.css')
    .styles('resources/web/css/font-awesome.css','public/css/all.css')
    .js('resources/js/delartis.js','public/js/delartis.js')
    .js('resources/js/delCategory.js', 'public/js/delCategory.js')
    .copy('resources/image/', 'public/storage/img')
    .scripts('resources/js/ckeditor.js','public/js/ckeditor.js');

