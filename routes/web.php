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
use App\Http\Controllers\Admin\KeyfiyetController;
use App\Http\Controllers\Admin\PortfolioTypeController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GalleryTypeController;
use App\Http\Controllers\Admin\CareerHeroController;
use App\Http\Controllers\Admin\AcceptanceController;
use App\Http\Controllers\Admin\VacationHeroController;
use App\Http\Controllers\Admin\VacationController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContactRequestController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\SocialshareController;
use App\Http\Controllers\Admin\BlogTypeController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\SocialfooterController;
use App\Http\Controllers\Admin\ContactfooterController;
use App\Http\Controllers\Admin\CertificateController;
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
    if (auth()->guard('admin')->check()) {
            return redirect()->route('back.pages.index');
        }
        return redirect()->route('admin.login');
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
            Route::get('leaders/{id}', [LeaderController::class, 'destroy'])->name('leaders.destroy');
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
            Route::post('service/update-image-order', [ServiceController::class, 'updateImageOrder'])->name('service.update-image-order');

            // Keyfiyet Routes
            Route::get('keyfiyet', [KeyfiyetController::class, 'index'])->name('keyfiyet.index');
            Route::get('keyfiyet/create', [KeyfiyetController::class, 'create'])->name('keyfiyet.create');
            Route::post('keyfiyet', [KeyfiyetController::class, 'store'])->name('keyfiyet.store');
            Route::get('keyfiyet/{id}/edit', [KeyfiyetController::class, 'edit'])->name('keyfiyet.edit');
            Route::put('keyfiyet/{id}', [KeyfiyetController::class, 'update'])->name('keyfiyet.update');
            Route::delete('keyfiyet/{id}', [KeyfiyetController::class, 'destroy'])->name('keyfiyet.destroy');

            // Portfolio Type Routes
            Route::get('portfolio-type', [PortfolioTypeController::class, 'index'])->name('portfolio_type.index');
            Route::get('portfolio-type/create', [PortfolioTypeController::class, 'create'])->name('portfolio_type.create');
            Route::post('portfolio-type', [PortfolioTypeController::class, 'store'])->name('portfolio_type.store');
            Route::get('portfolio-type/{id}/edit', [PortfolioTypeController::class, 'edit'])->name('portfolio_type.edit');
            Route::put('portfolio-type/{id}', [PortfolioTypeController::class, 'update'])->name('portfolio_type.update');
            Route::delete('portfolio-type/{id}', [PortfolioTypeController::class, 'destroy'])->name('portfolio_type.destroy');

            // Portfolio routes
            Route::get('portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
            Route::get('portfolio/create', [PortfolioController::class, 'create'])->name('portfolio.create');
            Route::post('portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
            Route::get('portfolio/{id}/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
            Route::put('portfolio/{id}', [PortfolioController::class, 'update'])->name('portfolio.update');
            Route::delete('portfolio/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');

            // Gallery routes
           
            Route::get('galleries', [GalleryController::class, 'index'])->name('galleries.index');
            Route::get('galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
            Route::post('galleries', [GalleryController::class, 'store'])->name('galleries.store');
            Route::get('galleries/{id}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
            Route::put('galleries/{id}', [GalleryController::class, 'update'])->name('galleries.update');
            Route::delete('galleries/{id}', [GalleryController::class, 'destroy'])->name('galleries.destroy');

            // Gallery Type routes
            Route::get('gallery-type', [GalleryTypeController::class, 'index'])->name('gallery_type.index');
            Route::get('gallery-type/create', [GalleryTypeController::class, 'create'])->name('gallery_type.create');
            Route::post('gallery-type', [GalleryTypeController::class, 'store'])->name('gallery_type.store');
            Route::get('gallery-type/{id}/edit', [GalleryTypeController::class, 'edit'])->name('gallery_type.edit');
            Route::put('gallery-type/{id}', [GalleryTypeController::class, 'update'])->name('gallery_type.update');
            Route::delete('gallery-type/{id}', [GalleryTypeController::class, 'destroy'])->name('gallery_type.destroy');

            // Career Hero routes
            Route::get('career-hero', [CareerHeroController::class, 'index'])->name('career_hero.index');
            Route::get('career-hero/create', [CareerHeroController::class, 'create'])->name('career_hero.create');
            Route::post('career-hero', [CareerHeroController::class, 'store'])->name('career_hero.store');
            Route::get('career-hero/{id}/edit', [CareerHeroController::class, 'edit'])->name('career_hero.edit');
            Route::put('career-hero/{id}', [CareerHeroController::class, 'update'])->name('career_hero.update');
            Route::delete('career-hero/{id}', [CareerHeroController::class, 'destroy'])->name('career_hero.destroy');

            // Acceptance routes
            Route::get('acceptance', [AcceptanceController::class, 'index'])->name('acceptance.index');
            Route::get('acceptance/create', [AcceptanceController::class, 'create'])->name('acceptance.create');
            Route::post('acceptance', [AcceptanceController::class, 'store'])->name('acceptance.store');
            Route::get('acceptance/{id}/edit', [AcceptanceController::class, 'edit'])->name('acceptance.edit');
            Route::put('acceptance/{id}', [AcceptanceController::class, 'update'])->name('acceptance.update');
            Route::delete('acceptance/{id}', [AcceptanceController::class, 'destroy'])->name('acceptance.destroy');

            // Vacation Hero routes
            Route::get('vacation-hero', [VacationHeroController::class, 'index'])->name('vacation_hero.index');
            Route::get('vacation-hero/create', [VacationHeroController::class, 'create'])->name('vacation_hero.create');
            Route::post('vacation-hero', [VacationHeroController::class, 'store'])->name('vacation_hero.store');
            Route::get('vacation-hero/{id}/edit', [VacationHeroController::class, 'edit'])->name('vacation_hero.edit');
            Route::put('vacation-hero/{id}', [VacationHeroController::class, 'update'])->name('vacation_hero.update');
            Route::delete('vacation-hero/{id}', [VacationHeroController::class, 'destroy'])->name('vacation_hero.destroy');

            // Vacation routes
            Route::get('vacation', [VacationController::class, 'index'])->name('vacation.index');
            Route::get('vacation/create', [VacationController::class, 'create'])->name('vacation.create');
            Route::post('vacation', [VacationController::class, 'store'])->name('vacation.store');
            Route::get('vacation/{id}/edit', [VacationController::class, 'edit'])->name('vacation.edit');
            Route::put('vacation/{id}', [VacationController::class, 'update'])->name('vacation.update');
            Route::delete('vacation/{id}', [VacationController::class, 'destroy'])->name('vacation.destroy');

            // Blog routes
            Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
            Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
            Route::post('blog', [BlogController::class, 'store'])->name('blog.store');
            Route::get('blog/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
            Route::put('blog/{id}', [BlogController::class, 'update'])->name('blog.update');
            Route::delete('blog/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');

            // Contact routes
            Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
            Route::get('contact/create', [ContactController::class, 'create'])->name('contact.create');
            Route::post('contact', [ContactController::class, 'store'])->name('contact.store');
            Route::get('contact/{id}/edit', [ContactController::class, 'edit'])->name('contact.edit');
            Route::put('contact/{id}', [ContactController::class, 'update'])->name('contact.update');
            Route::delete('contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');

            // Contact Request routes
            Route::get('contact_requests', [ContactRequestController::class, 'index'])->name('contact_requests.index');
            Route::get('contact_requests/create', [ContactRequestController::class, 'create'])->name('contact_requests.create');
            Route::post('contact_requests', [ContactRequestController::class, 'store'])->name('contact_requests.store');
            Route::get('contact_requests/{id}/edit', [ContactRequestController::class, 'edit'])->name('contact_requests.edit');
            Route::put('contact_requests/{id}', [ContactRequestController::class, 'update'])->name('contact_requests.update');
            Route::delete('contact_requests/{id}', [ContactRequestController::class, 'destroy'])->name('contact_requests.destroy');
            Route::get('contact_requests/{id}', [ContactRequestController::class, 'show'])->name('contact_requests.show');

            // Social Media routes
            Route::get('social', [SocialMediaController::class, 'index'])->name('social.index');
            Route::get('social/create', [SocialMediaController::class, 'create'])->name('social.create');
            Route::post('social', [SocialMediaController::class, 'store'])->name('social.store');
            Route::get('social/{id}/edit', [SocialMediaController::class, 'edit'])->name('social.edit');
            Route::put('social/{id}', [SocialMediaController::class, 'update'])->name('social.update');
            Route::delete('social/{id}', [SocialMediaController::class, 'destroy'])->name('social.destroy');
            Route::post('social/order', [SocialMediaController::class, 'order'])->name('social.order');
            Route::post('social/toggle-status/{id}', [SocialMediaController::class, 'toggleStatus'])->name('social.toggle-status');

            // Social Share routes
            Route::get('socialshare', [SocialshareController::class, 'index'])->name('socialshare.index');
            Route::get('socialshare/create', [SocialshareController::class, 'create'])->name('socialshare.create');
            Route::post('socialshare', [SocialshareController::class, 'store'])->name('socialshare.store');
            Route::get('socialshare/{id}/edit', [SocialshareController::class, 'edit'])->name('socialshare.edit');
            Route::put('socialshare/{id}', [SocialshareController::class, 'update'])->name('socialshare.update');
            Route::delete('socialshare/{id}', [SocialshareController::class, 'destroy'])->name('socialshare.destroy');

            // Blog Type routes
            Route::resource('blog_type', BlogTypeController::class);

            // SEO routes
            Route::get('seo', [SeoController::class, 'index'])->name('seo.index');
            Route::get('seo/create', [SeoController::class, 'create'])->name('seo.create');
            Route::post('seo', [SeoController::class, 'store'])->name('seo.store');
            Route::get('seo/{id}/edit', [SeoController::class, 'edit'])->name('seo.edit');
            Route::put('seo/{id}', [SeoController::class, 'update'])->name('seo.update');
            Route::delete('seo/{id}', [SeoController::class, 'destroy'])->name('seo.destroy');
            Route::post('seo/toggle-status/{id}', [SeoController::class, 'toggleStatus'])->name('seo.toggle-status');

            // Social Footer routes
            Route::get('socialfooter', [SocialfooterController::class, 'index'])->name('socialfooter.index');
            Route::get('socialfooter/create', [SocialfooterController::class, 'create'])->name('socialfooter.create');
            Route::post('socialfooter', [SocialfooterController::class, 'store'])->name('socialfooter.store');
            Route::get('socialfooter/{id}/edit', [SocialfooterController::class, 'edit'])->name('socialfooter.edit');
            Route::put('socialfooter/{id}', [SocialfooterController::class, 'update'])->name('socialfooter.update');
            Route::delete('socialfooter/{id}', [SocialfooterController::class, 'destroy'])->name('socialfooter.destroy');
            Route::post('socialfooter/order', [SocialfooterController::class, 'order'])->name('socialfooter.order');
            Route::post('socialfooter/toggle-status/{id}', [SocialfooterController::class, 'toggleStatus'])->name('socialfooter.toggle-status');

            // Contact Footer routes
            Route::get('contactfooter', [ContactfooterController::class, 'index'])->name('contactfooter.index');
            Route::get('contactfooter/create', [ContactfooterController::class, 'create'])->name('contactfooter.create');
            Route::post('contactfooter', [ContactfooterController::class, 'store'])->name('contactfooter.store');
            Route::get('contactfooter/{id}/edit', [ContactfooterController::class, 'edit'])->name('contactfooter.edit');
            Route::put('contactfooter/{id}', [ContactfooterController::class, 'update'])->name('contactfooter.update');
            Route::delete('contactfooter/{id}', [ContactfooterController::class, 'destroy'])->name('contactfooter.destroy');

            // Certificate routes
            Route::get('certificate', [CertificateController::class, 'index'])->name('certificate.index');
            Route::get('certificate/create', [CertificateController::class, 'create'])->name('certificate.create');
            Route::post('certificate', [CertificateController::class, 'store'])->name('certificate.store');
            Route::get('certificate/{id}/edit', [CertificateController::class, 'edit'])->name('certificate.edit');
            Route::put('certificate/{id}', [CertificateController::class, 'update'])->name('certificate.update');
            Route::delete('certificate/{id}', [CertificateController::class, 'destroy'])->name('certificate.destroy');

        });     
    });
});




