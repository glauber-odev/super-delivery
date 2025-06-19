<?php

use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {

    Route::get('settings/residencia', function () {
        return Inertia::render('settings/residencia');
    })->name('settings.residencia');



    /** --------------------------------------
     *  Produto
     *  -------------------------------------- */
    Route::get('/produtos', function () {
        return Inertia::render('produtos/index');
    })->name('produtos.index');
    Route::get('/produtos/create', function () {
        return Inertia::render('produtos/create');
    })->name('produtos.create');
    Route::get('/produtos/manage', function () {
        return Inertia::render('produtos/manage');
    })->name('produtos.manage');
});
