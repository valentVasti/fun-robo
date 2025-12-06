<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AwardsController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontendController;
use App\Models\Testimoni;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SetLocaleFromRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// });


Route::get('/', function(){
    return redirect()->route('frontend.home', ['locale' => app()->getLocale()]);
});

Route::get('/changeLanguage/{selectedLanguage}', [FrontendController::class, 'changeLanguage'])->name('backend.translate');

Route::group(['prefix' => '{locale}', 'middleware' => SetLocaleFromRoute::class, 'where' => ['locale' => '[a-zA-Z]{2}']], function () {
    Route::get('/home', [FrontendController::class, 'home'])->name('frontend.home');
    Route::get('/curriculum', [FrontendController::class, 'curriculum'])->name('frontend.curriculum');
    Route::get('/about', [FrontendController::class, 'about'])->name('frontend.about');

    Route::get('/article', [FrontendController::class, 'article'])->name('frontend.article');
    Route::get('/get-articles/{id}', [FrontendController::class, 'getArticles'])->name('get-articles');

    // Route::get('/article-detail', [FrontendController::class, 'articleDetail'])->name('frontend.articleDetail');
    // Route::get('/article-detail/{id}', 'FrontendController@articleDetail')->name('article.detail');
    Route::get('/article-detail/{id}', [FrontendController::class, 'articleDetail'])->name('frontend.articleDetail');

    Route::get('/awards', [FrontendController::class, 'awards'])->name('frontend.awards');
    Route::get('/branch', [FrontendController::class, 'branch'])->name('frontend.branch');
    Route::get('/gallery', [FrontendController::class, 'gallery'])->name('frontend.gallery');
    Route::get('/faq', [FrontendController::class, 'faq'])->name('frontend.faq');
    Route::get('/testimoni', [FrontendController::class, 'testimoni'])->name('frontend.testimoni');

    Route::get('/getSessionLanguage', [FrontendController::class, 'getSessionLanguage'])->name('backend.getLanguage');

});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login_auth', [LoginController::class, 'login'])->name('login.auth');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/create/store', [UserController::class, 'store'])->name('user.store');
    Route::put('user/edit/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('user/search/{value}', [UserController::class, 'search'])->name('faq.search');

    Route::get('faq', [FaqController::class, 'index'])->name('faq.index');
    Route::get('faq/create', [FaqController::class, 'create'])->name('faq.create');
    Route::get('faq/edit/{id}', [FaqController::class, 'edit'])->name('faq.edit');
    Route::post('faq/create/store', [FaqController::class, 'store'])->name('faq.store');
    Route::put('faq/edit/{id}/update', [FaqController::class, 'update'])->name('faq.update');
    Route::delete('faq/delete/{id}', [FaqController::class, 'destroy'])->name('faq.destroy');
    Route::get('faq/search/{value}', [FaqController::class, 'search'])->name('faq.search');
    Route::get('faq/translate', [FaqController::class, 'translate'])->name('faq.translate');

    Route::get('awards', [AwardsController::class, 'index'])->name('awards.index');
    Route::get('awards/create', [AwardsController::class, 'create'])->name('awards.create');
    Route::get('awards/edit/{id}', [AwardsController::class, 'edit'])->name('awards.edit');
    Route::post('awards/create/store', [AwardsController::class, 'store'])->name('awards.store');
    Route::put('awards/edit/{id}/update', [AwardsController::class, 'update'])->name('awards.update');
    Route::delete('awards/delete/{id}', [AwardsController::class, 'destroy'])->name('awards.destroy');
    Route::get('awards/search/{value}', [AwardsController::class, 'search'])->name('awards.search');

    Route::get('testimoni', [TestimoniController::class, 'index'])->name('testimoni.index');
    Route::get('testimoni/create', [TestimoniController::class, 'create'])->name('testimoni.create');
    Route::get('testimoni/edit/{id}', [TestimoniController::class, 'edit'])->name('testimoni.edit');
    Route::post('testimoni/create/store', [TestimoniController::class, 'store'])->name('testimoni.store');
    Route::put('testimoni/create/edit/{id}/update', [TestimoniController::class, 'update'])->name('testimoni.update');
    Route::delete('testimoni/delete/{id}', [TestimoniController::class, 'destroy'])->name('testimoni.destroy');
    Route::get('testimoni/search/{value}', [TestimoniController::class, 'search'])->name('testimoni.search');

    Route::get('article', [ArticleController::class, 'index'])->name('article.index');
    Route::get('article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::get('article/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');
    Route::post('article/create/store', [ArticleController::class, 'store'])->name('article.store');
    Route::put('article/create/edit/{id}/update', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('article/delete/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
    Route::get('article/search/{value}', [ArticleController::class, 'search'])->name('article.search');
    Route::get('article/updateHighlight/{id}/{value}', [ArticleController::class, 'updateHighlight'])->name('article.highlight');

    Route::get('branch', [BranchController::class, 'index'])->name('branch.index');
    Route::get('branch/create', [BranchController::class, 'create'])->name('branch.create');
    Route::get('branch/edit/{id}', [BranchController::class, 'edit'])->name('branch.edit');
    Route::post('branch/create/store', [BranchController::class, 'store'])->name('branch.store');
    Route::put('branch/create/edit/{id}/update', [BranchController::class, 'update'])->name('branch.update');
    Route::delete('branch/delete/{id}', [BranchController::class, 'destroy'])->name('branch.destroy');
    Route::get('branch/search/{value}', [BranchController::class, 'search'])->name('branch.search');

    Route::get('tag', [TagController::class, 'index'])->name('tag.index');
    Route::get('tag/create', [TagController::class, 'create'])->name('tag.create');
    Route::get('tag/edit/{id}', [TagController::class, 'edit'])->name('tag.edit');
    Route::post('tag/create/store', [TagController::class, 'store'])->name('tag.store');
    Route::put('tag/create/edit/{id}/update', [TagController::class, 'update'])->name('tag.update');
    Route::delete('tag/delete/{id}', [TagController::class, 'destroy'])->name('tag.destroy');
    Route::get('tag/getAll', [TagController::class, 'getAll'])->name('tag.getAll');
    Route::get('tag/search/{value}', [tagController::class, 'search'])->name('tag.search');

    Route::get('curriculum', [CurriculumController::class, 'index'])->name('curriculum.index');
    Route::get('curriculum/create', [CurriculumController::class, 'create'])->name('curriculum.create');
    Route::get('curriculum/edit/{id}', [CurriculumController::class, 'edit'])->name('curriculum.edit');
    Route::post('curriculum/create/store', [CurriculumController::class, 'store'])->name('curriculum.store');
    Route::put('curriculum/edit/{id}/update', [CurriculumController::class, 'update'])->name('curriculum.update');
    Route::delete('curriculum/delete/{id}', [CurriculumController::class, 'destroy'])->name('curriculum.destroy');
    Route::get('curriculum/search/{value}', [CurriculumController::class, 'search'])->name('curriculum.search');
    Route::get('curriculum/translate', [CurriculumController::class, 'translate'])->name('curriculum.translate');

    Route::get('about_us', [AboutUsController::class, 'index'])->name('about_us.index');
    Route::get('about_us/getAllData', [AboutUsController::class, 'getAllData'])->name('about_us.getAllData');
    Route::post('about_us/update', [AboutUsController::class, 'update'])->name('about_us.update');

    Route::get('benefit', [BenefitController::class, 'index'])->name('benefit.index');
    Route::post('benefit/update', [BenefitController::class, 'update'])->name('benefit.update');

    Route::get('analytics', [DashboardController::class, 'analytics'])->name('analytics.get');
    Route::get('logs', [DashboardController::class, 'getChangeLog'])->name('log.get');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout.auth');
});
