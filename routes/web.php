<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\FruitController;
use App\Http\Controllers\WeaponController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Characters
Route::get('/characters', [CharacterController::class, 'index'])->name('characters.index');
Route::get('/characters/create', [CharacterController::class, 'create'])->name('characters.create');
Route::post('/characters', [CharacterController::class, 'store'])->name('characters.store');
Route::get('/characters/{character}', [CharacterController::class, 'show'])->name('characters.show');
Route::get('/characters/{character}/edit', [CharacterController::class, 'edit'])->name('characters.edit');
Route::put('/characters/{character}', [CharacterController::class, 'update'])->name('characters.update');
Route::delete('/characters/{character}', [CharacterController::class, 'destroy'])->name('characters.destroy');

// Fruits
Route::get('/fruits', [FruitController::class, 'index'])->name('fruits.index');
Route::get('/fruits/create', [FruitController::class, 'create'])->name('fruits.create');
Route::post('/fruits', [FruitController::class, 'store'])->name('fruits.store');
Route::get('/fruits/{fruit}', [FruitController::class, 'show'])->name('fruits.show');
Route::get('/fruits/{fruit}/edit', [FruitController::class, 'edit'])->name('fruits.edit');
Route::put('/fruits/{fruit}', [FruitController::class, 'update'])->name('fruits.update');
Route::delete('/fruits/{fruit}', [FruitController::class, 'destroy'])->name('fruits.destroy');

// Weapons
Route::get('/weapons', [WeaponController::class, 'index'])->name('weapons.index');
Route::get('/weapons/create', [WeaponController::class, 'create'])->name('weapons.create');
Route::post('/weapons', [WeaponController::class, 'store'])->name('weapons.store');
Route::get('/weapons/{weapon}', [WeaponController::class, 'show'])->name('weapons.show');
Route::get('/weapons/{weapon}/edit', [WeaponController::class, 'edit'])->name('weapons.edit');
Route::put('/weapons/{weapon}', [WeaponController::class, 'update'])->name('weapons.update');
Route::delete('/weapons/{weapon}', [WeaponController::class, 'destroy'])->name('weapons.destroy');

// Locations
Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
Route::get('/locations/create', [LocationController::class, 'create'])->name('locations.create');
Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');
Route::get('/locations/{location}', [LocationController::class, 'show'])->name('locations.show');
Route::get('/locations/{location}/edit', [LocationController::class, 'edit'])->name('locations.edit');
Route::put('/locations/{location}', [LocationController::class, 'update'])->name('locations.update');
Route::delete('/locations/{location}', [LocationController::class, 'destroy'])->name('locations.destroy');

// Organizations
Route::get('/organizations', [OrganizationController::class, 'index'])->name('organizations.index');
Route::get('/organizations/create', [OrganizationController::class, 'create'])->name('organizations.create');
Route::post('/organizations', [OrganizationController::class, 'store'])->name('organizations.store');
Route::get('/organizations/{organization}', [OrganizationController::class, 'show'])->name('organizations.show');
Route::get('/organizations/{organization}/edit', [OrganizationController::class, 'edit'])->name('organizations.edit');
Route::put('/organizations/{organization}', [OrganizationController::class, 'update'])->name('organizations.update');
Route::delete('/organizations/{organization}', [OrganizationController::class, 'destroy'])->name('organizations.destroy');

// Races
Route::get('/races', [RaceController::class, 'index'])->name('races.index');
Route::get('/races/create', [RaceController::class, 'create'])->name('races.create');
Route::post('/races', [RaceController::class, 'store'])->name('races.store');
Route::get('/races/{race}', [RaceController::class, 'show'])->name('races.show');
Route::get('/races/{race}/edit', [RaceController::class, 'edit'])->name('races.edit');
Route::put('/races/{race}', [RaceController::class, 'update'])->name('races.update');
Route::delete('/races/{race}', [RaceController::class, 'destroy'])->name('races.destroy');

// Favorites
Route::middleware(['auth'])->group(function () {
    Route::post('/favorites/{type}/add', [FavoriteController::class, 'addToFavorites'])->name('favorites.add');
    Route::get('/favorites', [FavoriteController::class, 'showFavorites'])->name('favorites.index');
    Route::delete('/favorites/{type}/{id}/remove', [FavoriteController::class, 'removeFromFavorites'])->name('favorites.remove');
});

// Comments
Route::post('{type}/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// Search
Route::get('/search', [SearchController::class, 'search'])->name('search');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
