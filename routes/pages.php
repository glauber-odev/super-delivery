<?php

use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {

    Route::get('settings/residencia', function () {
        return Inertia::render('settings/residencia');
    })->name('residencia');
});
