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



