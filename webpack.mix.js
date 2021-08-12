const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js/app.js')
    .postCss('resources/css/app.css', 'public/css', [
    ]).scripts('resources/theme_admin/js/jquery.dataTables.min.js','public/js/jquery.dataTables.min.js')
    .scripts('resources/theme_admin/js/dataTables.bootstrap4.min.js','public/js/dataTables.bootstrap4.min.js')
    .js('resources/js/showimg.js','public/js/showimg.js')
    .js('resources/theme_admin/js/jquery-3.5.1.js','public/js/jquery-3.5.1.js')
    .styles('resources/css/app.css','public/css/app.css')
    .styles('resources/web/css/music.css', 'public/css/music.css')
    .styles('resources/web/css/style.css','public/css/style.css')
    .styles('resources/web/css/main.css','public/css/main.css')
    .js('resources/js/delartis.js','public/js/delartis.js')
    .scripts('resources/js/ckeditor.js','public/js/ckeditor.js')
    .js('resources/js/delCategory.js', 'public/js/delCategory.js')
    .copy('resources/image/', 'public/storage/img')
    .styles('resources/web/css/playmusic.css','public/css/playmusic.css')
    .js('resources/js/admin.js','public/js/admin.js')
    .js('resources/web/js/playmusic.js', 'public/js/playmusic.js')
    .js('resources/js/showsong.js', 'public/js/showsong.js')
    .js('resources/js/hot_album_music.js','public/js/hot_album_music.js')
    .js('resources/js/profile.js', 'public/js/profile.js')
    .js('resources/js/home.js','public/js/home.js')
    .js('resources/js/topTrending.js','public/js/topTrending.js');
