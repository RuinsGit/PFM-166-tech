<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TranslationManageController;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\Admin\HomeCardController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\LeaderController;
use App\Http\Controllers\Admin\AboutHeroController;
use App\Http\Controllers\Admin\AboutSectionController;
use App\Http\Controllers\Admin\ServiceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------SSS
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        if (auth()->guard('admin')->check()) {
            return redirect()->route('back.pages.index');
        }
        return redirect()->route('admin.login');
    });

    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login')->middleware('guest:admin');
    Route::post('login', [AdminController::class, 'login'])->name('handle-login');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('profile', function () {
            return view('back.admin.profile');
        })->name('admin.profile');

        Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::prefix('pages')->name('back.pages.')->group(function () {
            Route::get('index', [PageController::class, 'index'])->name('index');

            Route::resource('translation-manage', TranslationManageController::class);
            Route::get('translation-manage', [TranslationManageController::class, 'index'])->name('translation-manage.index');
            Route::get('translation-manage/create', [TranslationManageController::class, 'create'])->name('translation-manage.create');
            Route::post('translation-manage', [TranslationManageController::class, 'store'])->name('translation-manage.store');
            Route::get('translation-manage/{translation}/edit', [TranslationManageController::class, 'edit'])->name('translation-manage.edit');
            Route::put('translation-manage/{translation}', [TranslationManageController::class, 'update'])->name('translation-manage.update');
            Route::delete('translation-manage/{translation}', [TranslationManageController::class, 'destroy'])->name('translation-manage.destroy');

            Route::resource('logos', LogoController::class);
            Route::get('logos', [LogoController::class, 'index'])->name('logos.index');
            Route::get('logos/create', [LogoController::class, 'create'])->name('logos.create');
            Route::post('logos', [LogoController::class, 'store'])->name('logos.store');
            Route::get('logos/{id}', [LogoController::class, 'show'])->name('logos.show');
            Route::get('logos/{id}/edit', [LogoController::class, 'edit'])->name('logos.edit');
            Route::put('logos/{id}', [LogoController::class, 'update'])->name('logos.update');
            Route::delete('logos/{id}', [LogoController::class, 'destroy'])->name('logos.destroy');

            Route::resource('home-cards', HomeCardController::class);
            Route::get('home-cards', [HomeCardController::class, 'index'])->name('home-cards.index');
            Route::get('home-cards/create', [HomeCardController::class, 'create'])->name('home-cards.create');
            Route::post('home-cards', [HomeCardController::class, 'store'])->name('home-cards.store');
            Route::get('home-cards/{id}/edit', [HomeCardController::class, 'edit'])->name('home-cards.edit');
            Route::put('home-cards/{id}', [HomeCardController::class, 'update'])->name('home-cards.update');
            Route::delete('home-cards/{id}', [HomeCardController::class, 'destroy'])->name('home-cards.destroy');

            // About routes
            Route::get('about', [AboutController::class, 'index'])->name('about.index');
            Route::put('about', [AboutController::class, 'update'])->name('about.update');

            // Comment routes
            Route::resource('comments', CommentController::class);
            Route::post('comments/status/{id}', [CommentController::class, 'status'])->name('comments.status');

            // Leaders Routes
            Route::get('leaders', [LeaderController::class, 'index'])->name('leaders.index');
            Route::get('leaders/create', [LeaderController::class, 'create'])->name('leaders.create');
            Route::post('leaders', [LeaderController::class, 'store'])->name('leaders.store');
            Route::get('leaders/{id}/edit', [LeaderController::class, 'edit'])->name('leaders.edit');
            Route::put('leaders/{id}', [LeaderController::class, 'update'])->name('leaders.update');
            Route::delete('leaders/{id}', [LeaderController::class, 'destroy'])->name('leaders.destroy');
            Route::post('leaders/status/{id}', [LeaderController::class, 'status'])->name('leaders.status');

            // About Hero Routes
            Route::get('about-hero', [AboutHeroController::class, 'index'])->name('about-hero.index');
            Route::get('about-hero/create', [AboutHeroController::class, 'create'])->name('about-hero.create');
            Route::post('about-hero', [AboutHeroController::class, 'store'])->name('about-hero.store');
            Route::get('about-hero/{id}/edit', [AboutHeroController::class, 'edit'])->name('about-hero.edit');
            Route::put('about-hero/{id}', [AboutHeroController::class, 'update'])->name('about-hero.update');
            Route::delete('about-hero/{id}', [AboutHeroController::class, 'destroy'])->name('about-hero.destroy');

            // About Section Routes
            Route::get('about-section', [AboutSectionController::class, 'index'])->name('about-section.index');
            Route::get('about-section/create', [AboutSectionController::class, 'create'])->name('about-section.create');
            Route::post('about-section', [AboutSectionController::class, 'store'])->name('about-section.store');
            Route::get('about-section/{id}/edit', [AboutSectionController::class, 'edit'])->name('about-section.edit');
            Route::put('about-section/{id}', [AboutSectionController::class, 'update'])->name('about-section.update');
            Route::delete('about-section/{id}', [AboutSectionController::class, 'destroy'])->name('about-section.destroy');

            // Service Routes
            Route::get('service', [ServiceController::class, 'index'])->name('service.index');
            Route::get('service/create', [ServiceController::class, 'create'])->name('service.create');
            Route::post('service', [ServiceController::class, 'store'])->name('service.store');
            Route::get('service/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit');
            Route::put('service/{id}', [ServiceController::class, 'update'])->name('service.update');
            Route::delete('service/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');
        });     
    });
});



