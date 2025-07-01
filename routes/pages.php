<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {

    Route::get('settings/residencia', function () {
        return Inertia::render('settings/residencia', [
            'userId' => Auth::id()
        ]);
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

    Route::get('/pedidos/realizar', function () {
        return Inertia::render('pedidos/realizar',[
            'userId' => Auth::id()
        ]);
    })->name('pedidos.realizar');

    Route::get('/pedidos', function () {
        return Inertia::render('pedidos/listar',[
            'userId' => Auth::id()
        ]);
    })->name('pedidos.listar');

    Route::get('/carrinhos', function () {
        return Inertia::render('carrinhos/listar',[
            'userId' => Auth::id()
        ]);
    })->name('pedidos.listar');

    Route::get('/pedidos-programados', function () {
        return Inertia::render('pedidos-programados/PedidoProgramado',[
            'userId' => Auth::id()
        ]);
    })->name('pedidos.listar');

    Route::get('/pedidos-programados/{id}', function ($id) {
        return Inertia::render('pedidos-programados/PedidoProgramado',[
            'userId' => Auth::id(),
            'pedidoProgramadoId' => $id,
        ]);
    })->name('pedidos.listar');

});
