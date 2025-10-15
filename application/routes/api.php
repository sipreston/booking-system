<?php

use App\Http\Controllers\API\Property\PropertyController;
use App\Http\Controllers\API\TestController;
use Illuminate\Support\Facades\Route;

Route::get('test', [TestController::class, 'test'])->name('api.test');

// Properties
Route::get('property/{property}', [PropertyController::class, 'getProperty'])->name('api.property.get');
Route::post('property/create', [PropertyController::class, 'createProperty'])->name('api.property.create');
// Amenities

// Owners

// Customers

// Financial


// Business


// Admin
