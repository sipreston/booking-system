<?php

use App\Http\Controllers\API\Owner\OwnerController;
use App\Http\Controllers\API\Property\AvailabilityController;
use App\Http\Controllers\API\Property\PropertyController;
use App\Http\Controllers\API\TestController;
use Illuminate\Support\Facades\Route;

Route::get('test', [TestController::class, 'test'])->name('api.test');

// Properties
Route::get('property/{property}', [PropertyController::class, 'get'])->name('property.get');
Route::post('property/create', [PropertyController::class, 'create'])->name('property.create');
Route::post('property/{property}/update', [PropertyController::class, 'update'])->name('property.update');

Route::post('property/{property}/availability', [AvailabilityController::class, 'setForProperty'])->name('property.availability.set');
// Amenities

// Owners
Route::get('owner/{owner}', [OwnerController::class, 'get'])->name('owner.get');
Route::post('owner/create', [OwnerController::class, 'create'])->name('owner.create');
Route::post('owner/{owner}/update', [OwnerController::class, 'update'])->name('owner.update');

// Customers

// Financial


// Business


// Admin
