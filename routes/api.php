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
Route::get('/contacts', [ContactController::class, 'index']);
Route::post('/contact-requests', [ContactController::class, 'store']);

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



