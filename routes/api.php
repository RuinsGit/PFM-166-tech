<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CareerController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SocialshareController;
use App\Http\Controllers\Api\BlogTypeController;
use App\Http\Controllers\Api\HomeCardController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\TranslationManageController;
use App\Http\Controllers\Api\LogoApiController;
use App\Http\Controllers\Api\AboutHeroApiController;
use App\Http\Controllers\Api\AboutSectionApiController;
use App\Http\Controllers\Api\LeaderApiController;
use App\Http\Controllers\Api\KeyfiyetApiController;
use App\Http\Controllers\Api\SocialMediaApiController;
use App\Http\Controllers\Api\SocialshareApiController;
use App\Http\Controllers\Api\CareerHeroApiController;
use App\Http\Controllers\Api\AcceptanceApiController;
use App\Http\Controllers\Api\VacationApiController;
use App\Http\Controllers\Api\VacationHeroApiController;
use App\Http\Controllers\Api\ContactApiController;
use App\Http\Controllers\Api\ContactRequestApiController;
use App\Http\Controllers\Api\SocialfooterApiController;
use App\Http\Controllers\Api\ContactfooterApiController;
use App\Http\Controllers\Api\PortfolioTypeApiController;
use App\Http\Controllers\Api\GalleryTypeApiController;

// About Routes
Route::get('/about', [AboutController::class, 'index']);
Route::get('/about/{id}', [AboutController::class, 'show']);

// Blog Routes
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{id}', [BlogController::class, 'show']);

// Career Routes
Route::get('/careers', [CareerController::class, 'index']);
Route::get('/careers/{id}', [CareerController::class, 'show']);

// Contact Routes
Route::prefix('contacts')->group(function () {
    Route::get('/', [ContactApiController::class, 'index']);
    Route::get('/{id}', [ContactApiController::class, 'show']);
    Route::post('/', [ContactApiController::class, 'store']);
    Route::put('/{id}', [ContactApiController::class, 'update']);
    Route::delete('/{id}', [ContactApiController::class, 'destroy']);
});

// Gallery Routes
Route::get('/galleries', [GalleryController::class, 'index']);
Route::get('/galleries/{id}', [GalleryController::class, 'show']);

// Portfolio Routes
Route::get('/portfolios', [PortfolioController::class, 'index']);
Route::get('/portfolios/{id}', [PortfolioController::class, 'show']);

// Service Routes
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{id}', [ServiceController::class, 'show']);

// Social Share Routes
Route::get('/social-shares', [SocialshareController::class, 'index']);
Route::get('/social-shares/{id}', [SocialshareController::class, 'show']);

// Blog Type Routes
Route::get('/blog-types', [BlogTypeController::class, 'index']);
Route::get('/blog-types/{id}', [BlogTypeController::class, 'show']);

// Home Card Routes
Route::get('/home-cards', [HomeCardController::class, 'index']);
Route::get('/home-cards/{id}', [HomeCardController::class, 'show']);

// Comment Routes
Route::get('/comments', [CommentController::class, 'index']);
Route::get('/comments/{id}', [CommentController::class, 'show']);

// Translation Routes
Route::get('translations', [TranslationManageController::class, 'index']);
Route::get('translations/{id}', [TranslationManageController::class, 'show']);
Route::get('translations/key/{key}', [TranslationManageController::class, 'getByKey']);
Route::get('translations/group/{group}', [TranslationManageController::class, 'getByGroup']);

// Logo Routes
Route::get('/logos', [LogoApiController::class, 'index']);
Route::get('/logos/{id}', [LogoApiController::class, 'show']);
Route::get('/logos/key/{key}', [LogoApiController::class, 'getByKey']);
Route::get('/logos/group/{group}', [LogoApiController::class, 'getByGroup']);

// About Hero Routes
Route::get('/about-hero', [AboutHeroApiController::class, 'index']);
Route::get('/about-hero/{id}', [AboutHeroApiController::class, 'show']);
Route::get('/about-hero/key/{key}', [AboutHeroApiController::class, 'getByKey']);
Route::get('/about-hero/group/{group}', [AboutHeroApiController::class, 'getByGroup']);

// About Section Routes
Route::get('/about-sections', [AboutSectionApiController::class, 'index']);
Route::get('/about-sections/{id}', [AboutSectionApiController::class, 'show']);
Route::get('/about-sections/key/{key}', [AboutSectionApiController::class, 'getByKey']);
Route::get('/about-sections/group/{group}', [AboutSectionApiController::class, 'getByGroup']);

// Leader Routes
Route::get('/leaders', [LeaderApiController::class, 'index']);
Route::get('/leaders/{id}', [LeaderApiController::class, 'show']);
Route::get('/leaders/key/{key}', [LeaderApiController::class, 'getByKey']);
Route::get('/leaders/status/{status}', [LeaderApiController::class, 'getByStatus']);

// Keyfiyet Routes
Route::get('/keyfiyets', [KeyfiyetApiController::class, 'index']);
Route::get('/keyfiyets/{id}', [KeyfiyetApiController::class, 'show']);
Route::get('/keyfiyets/key/{key}', [KeyfiyetApiController::class, 'getByKey']);
Route::get('/keyfiyets/filial/{filial}', [KeyfiyetApiController::class, 'getByFilial']);

// Social Media Routes
Route::prefix('social-media')->group(function () {
    Route::get('/', [SocialMediaApiController::class, 'index']);
    Route::get('/{id}', [SocialMediaApiController::class, 'show']);
    Route::post('/', [SocialMediaApiController::class, 'store']);
    Route::put('/{id}', [SocialMediaApiController::class, 'update']);
    Route::delete('/{id}', [SocialMediaApiController::class, 'destroy']);
    Route::post('/{id}/toggle-status', [SocialMediaApiController::class, 'toggleStatus']);
});

// Socialshare Routes
Route::prefix('socialshares')->group(function () {
    Route::get('/', [SocialshareApiController::class, 'index']);
    Route::get('/{id}', [SocialshareApiController::class, 'show']);
    Route::post('/', [SocialshareApiController::class, 'store']);
    Route::put('/{id}', [SocialshareApiController::class, 'update']);
    Route::delete('/{id}', [SocialshareApiController::class, 'destroy']);
});

// Career Hero Routes
Route::prefix('career-heroes')->group(function () {
    Route::get('/', [CareerHeroApiController::class, 'index']);
    Route::get('/{id}', [CareerHeroApiController::class, 'show']);
    Route::get('/key/{key}', [CareerHeroApiController::class, 'getByKey']);
    Route::get('/group/{group}', [CareerHeroApiController::class, 'getByGroup']);
});

// Acceptance Routes
Route::prefix('acceptances')->group(function () {
    Route::get('/', [AcceptanceApiController::class, 'index']);
    Route::get('/{id}', [AcceptanceApiController::class, 'show']);
    Route::get('/key/{key}', [AcceptanceApiController::class, 'getByKey']);
    Route::get('/group/{group}', [AcceptanceApiController::class, 'getByGroup']);
});

// Vacation Routes
Route::prefix('vacations')->group(function () {
    Route::get('/', [VacationApiController::class, 'index']);
    Route::get('/{id}', [VacationApiController::class, 'show']);
    Route::get('/key/{key}', [VacationApiController::class, 'getByKey']);
    Route::get('/group/{group}', [VacationApiController::class, 'getByGroup']);
});

// Vacation Hero Routes
Route::prefix('vacation-heroes')->group(function () {
    Route::get('/', [VacationHeroApiController::class, 'index']);
    Route::get('/{id}', [VacationHeroApiController::class, 'show']);
    Route::post('/', [VacationHeroApiController::class, 'store']);
    Route::put('/{id}', [VacationHeroApiController::class, 'update']);
    Route::delete('/{id}', [VacationHeroApiController::class, 'destroy']);
});

// Contact Request Routes
Route::prefix('contact-requests')->group(function () {
    Route::get('/', [ContactRequestApiController::class, 'index']);
    Route::get('/{id}', [ContactRequestApiController::class, 'show']);
    Route::post('/', [ContactRequestApiController::class, 'store']);
    Route::delete('/{id}', [ContactRequestApiController::class, 'destroy']);
});

// Seo Routes
Route::prefix('seo')->group(function () {
    Route::get('/', [App\Http\Controllers\Api\SeoController::class, 'index']);
    Route::get('/{key}', [App\Http\Controllers\Api\SeoController::class, 'show']);
    Route::post('/', [App\Http\Controllers\Api\SeoController::class, 'store']);
    Route::put('/{id}', [App\Http\Controllers\Api\SeoController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\Api\SeoController::class, 'destroy']);
});

// Social Footer Routes
Route::prefix('social-footer')->group(function () {
    Route::get('/', [SocialfooterApiController::class, 'index']);
    Route::get('/{id}', [SocialfooterApiController::class, 'show']);
    Route::post('/', [SocialfooterApiController::class, 'store']);
    Route::put('/{id}', [SocialfooterApiController::class, 'update']);
    Route::delete('/{id}', [SocialfooterApiController::class, 'destroy']);
});

// Contact Footer Routes
Route::prefix('contact-footer')->group(function () {
    Route::get('/', [ContactfooterApiController::class, 'index']);
    Route::get('/{id}', [ContactfooterApiController::class, 'show']);
    Route::post('/', [ContactfooterApiController::class, 'store']);
    Route::put('/{id}', [ContactfooterApiController::class, 'update']);
    Route::delete('/{id}', [ContactfooterApiController::class, 'destroy']);
});

// Portfolio Type Routes
Route::get('/portfolio-types', [PortfolioTypeApiController::class, 'index']);
Route::get('/portfolio-types/{id}', [PortfolioTypeApiController::class, 'show']);

// Gallery Type Routes
Route::get('/gallery-types', [GalleryTypeApiController::class, 'index']);
Route::get('/gallery-types/{id}', [GalleryTypeApiController::class, 'show']);



