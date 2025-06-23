<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {

    Route::get('settings/residencia', function () {
        return Inertia::render('settings/residencia');
    })->name('settings.residencia');



    /** --------------------------------------
     *  Produto
     *  -------------------------------------- */
    Route::get('/produtos/busca/{search}', function () {
        return Inertia::render('produtos/busca');
    })->name('produtos.busca');

    Route::get('/produtos/manage', function () {
        return Inertia::render('produtos/manage');
    })->name('produtos.manage');

    Route::get('/produtos/categoria/{category1}', function ($categoriaParam) {
        return Inertia::render('produtos/categoria',  [
            "categoriaParam" => $categoriaParam,
        ]);
    })->name('produtos.categoria');

    Route::get('/produtos/{id}', function () {
        return Inertia::render('produtos/produto');
    })->name('produtos.produto');

});
