const mix = require('laravel-mix')

mix.postCss('resources/css/frontend/about.css','public/css/frontend')
    .postCss('resources/css/frontend/article-detail.css','public/css/frontend')
    .postCss('resources/css/frontend/articles.css','public/css/frontend')
    .postCss('resources/css/frontend/awards.css','public/css/frontend')
    .postCss('resources/css/frontend/branch.css','public/css/frontend')
    .postCss('resources/css/frontend/curriculum.css','public/css/frontend')
    .postCss('resources/css/frontend/faq.css','public/css/frontend')
    .postCss('resources/css/frontend/gallery.css','public/css/frontend')
    .postCss('resources/css/frontend/home.css','public/css/frontend')
    .postCss('resources/css/frontend/master.css','public/css/frontend')
    .postCss('resources/css/frontend/testimoni.css','public/css/frontend')
    .postCss('resources/css/backend/aboutUs.css','public/css/backend')
    .postCss('resources/css/backend/dashboard.css','public/css/backend')
    .postCss('resources/css/backend/form.css','public/css/backend')
    .postCss('resources/css/backend/login.css','public/css/backend')
    .postCss('resources/css/backend/main-content.css','public/css/backend')
    .postCss('resources/css/backend/sidebar.css','public/css/backend')
    .postCss('resources/css/backend/table.css','public/css/backend')
    .js('resources/js/about.js', 'public/js')
    .js('resources/js/article-detail.js', 'public/js')
    .js('resources/js/article.js', 'public/js')
    .js('resources/js/award.js', 'public/js')
    .js('resources/js/backend.js', 'public/js')
    .js('resources/js/branch.js', 'public/js')
    .js('resources/js/changelog.js', 'public/js')
    .js('resources/js/ckeditor.js', 'public/js')
    .js('resources/js/curriculum.js', 'public/js')
    .js('resources/js/datetime.js', 'public/js')
    .js('resources/js/gallery.js', 'public/js')
    .js('resources/js/home.js', 'public/js')
    .js('resources/js/navbar.js', 'public/js')
    .js('resources/js/pagination.js', 'public/js')
    .js('resources/js/preloader.js', 'public/js')
    .js('resources/js/previewimg.js', 'public/js')
    .js('resources/js/radioArticle.js', 'public/js')
    .js('resources/js/search.js', 'public/js')
    .js('resources/js/table.js', 'public/js')
    .js('resources/js/testimoni.js', 'public/js')
    .version();

    mix.webpackConfig({
        stats: {
            children: true
        },
        
    });