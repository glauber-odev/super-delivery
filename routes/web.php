<?php

use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CarrinhoProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ImagemController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoHistoricoController;
use App\Http\Controllers\PedidoProdutoController;
use App\Http\Controllers\PedidoProgramadoController;
use App\Http\Controllers\PedidoStatusController;
use App\Http\Controllers\ProdutoAvaliacaoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoImagemController;
use App\Http\Controllers\ProdutoUserController;
use App\Http\Controllers\ResidenciaController;
use App\Http\Controllers\TempoUnidadeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::prefix('/api')->group(function () {

        /** --------------------------------------
         *  Carrinho
         *  -------------------------------------- */
        Route::prefix('/carrinhos')->group(function () {

            Route::post('/', [CarrinhoController::class, 'create'])->name('api.carrinhos.create');
            Route::get('/', [CarrinhoController::class, 'fetch'])->name('api.carrinhos.fetch');
            Route::get('/{id}', [CarrinhoController::class, 'findById'])->name('api.carrinhos.find-by-id');
            Route::put('/{id}', [CarrinhoController::class, 'update'])->name('api.carrinhos.update');
            Route::patch('/{id}', [CarrinhoController::class, 'update'])->name('api.carrinhos.update');
            Route::delete('/{id}', [CarrinhoController::class, 'delete'])->name('api.carrinhos.delete');

            Route::post('/produtos/{produtoId}', [CarrinhoController::class, 'addOrEditProduto'])->name('api.add-or-edit-produto');
            Route::post('{carrinhoId}/produtos/{produtoId}', [CarrinhoController::class, 'attachOrUpdateProdutoByCarrinhoId'])->name('api.attach-or-update-produto-by-carrinho-id');

        });

        /** --------------------------------------
         *  Categoria
         *  -------------------------------------- */
        Route::prefix('/categorias')->group(function () {

            Route::post('/', [CategoriaController::class, 'create'])->name('api.categorias.create');
            Route::get('/', [CategoriaController::class, 'fetch'])->name('api.categorias.fetch');
            Route::get('/{id}', [CategoriaController::class, 'findById'])->name('api.categorias.find-by-id');
            Route::put('/{id}', [CategoriaController::class, 'update'])->name('api.categorias.update');
            Route::patch('/{id}', [CategoriaController::class, 'update'])->name('api.categorias.update');
            Route::delete('/{id}', [CategoriaController::class, 'delete'])->name('api.categorias.delete');

        });

        /** --------------------------------------
         *  Carrinho
         *  -------------------------------------- */
        Route::prefix('/estados')->group(function () {

            Route::post('/', [CarrinhoController::class, 'create'])->name('api.estados.create');
            Route::get('/', [CarrinhoController::class, 'fetch'])->name('api.estados.fetch');
            Route::get('/{id}', [CarrinhoController::class, 'findById'])->name('api.estados.find-by-id');
            Route::put('/{id}', [CarrinhoController::class, 'update'])->name('api.estados.update');
            Route::patch('/{id}', [CarrinhoController::class, 'update'])->name('api.estados.update');
            Route::delete('/{id}', [CarrinhoController::class, 'delete'])->name('api.estados.delete');

        });

        /** --------------------------------------
         *  Imagem
         *  -------------------------------------- */
        Route::prefix('/imagens')->group(function () {

            Route::post('/', [ImagemController::class, 'create'])->name('api.imagens.create');
            Route::get('/', [ImagemController::class, 'fetch'])->name('api.imagens.fetch');
            Route::get('/{id}', [ImagemController::class, 'findById'])->name('api.imagens.find-by-id');
            Route::put('/{id}', [ImagemController::class, 'update'])->name('api.imagens.update');
            Route::patch('/{id}', [ImagemController::class, 'update'])->name('api.imagens.update');
            Route::delete('/{id}', [ImagemController::class, 'delete'])->name('api.imagens.delete');

        });

        /** --------------------------------------
         *  PedidoHistorico
         *  -------------------------------------- */
        Route::prefix('/pedidos-historicos')->group(function () {

            Route::post('/', [PedidoHistoricoController::class, 'create'])->name('api.pedidos-historicos.create');
            Route::get('/', [PedidoHistoricoController::class, 'fetch'])->name('api.pedidos-historicos.fetch');
            Route::get('/{id}', [PedidoHistoricoController::class, 'findById'])->name('api.pedidos-historicos.find-by-id');
            Route::put('/{id}', [PedidoHistoricoController::class, 'update'])->name('api.pedidos-historicos.update');
            Route::patch('/{id}', [PedidoHistoricoController::class, 'update'])->name('api.pedidos-historicos.update');
            Route::delete('/{id}', [PedidoHistoricoController::class, 'delete'])->name('api.pedidos-historicos.delete');

        });

        /** --------------------------------------
         *  PedidoProduto
         *  -------------------------------------- */
        Route::prefix('/pedidos-produtos')->group(function () {

            Route::post('/', [PedidoProdutoController::class, 'create'])->name('api.pedidos-produtos.create');
            Route::get('/', [PedidoProdutoController::class, 'fetch'])->name('api.pedidos-produtos.fetch');
            Route::get('/{id}', [PedidoProdutoController::class, 'findById'])->name('api.pedidos-produtos.find-by-id');
            Route::put('/{id}', [PedidoProdutoController::class, 'update'])->name('api.pedidos-produtos.update');
            Route::patch('/{id}', [PedidoProdutoController::class, 'update'])->name('api.pedidos-produtos.update');
            Route::delete('/{id}', [PedidoProdutoController::class, 'delete'])->name('api.pedidos-produtos.delete');

        });

        /** --------------------------------------
         *  PedidoStatus
         *  -------------------------------------- */
        Route::prefix('/pedidos-status')->group(function () {

            Route::post('/', [PedidoStatusController::class, 'create'])->name('api.pedidos-status.create');
            Route::get('/', [PedidoStatusController::class, 'fetch'])->name('api.pedidos-status.fetch');
            Route::get('/{id}', [PedidoStatusController::class, 'findById'])->name('api.pedidos-status.find-by-id');
            Route::put('/{id}', [PedidoStatusController::class, 'update'])->name('api.pedidos-status.update');
            Route::patch('/{id}', [PedidoStatusController::class, 'update'])->name('api.pedidos-status.update');
            Route::delete('/{id}', [PedidoStatusController::class, 'delete'])->name('api.pedidos-status.delete');

        });

        /** --------------------------------------
         *  PedidoProgramado
         *  -------------------------------------- */
        Route::prefix('/pedidos-programados')->group(function () {

            Route::post('/', [PedidoProgramadoController::class, 'create'])->name('api.pedidos-programados.create');
            Route::get('/', [PedidoProgramadoController::class, 'fetch'])->name('api.pedidos-programados.fetch');
            Route::get('/{id}', [PedidoProgramadoController::class, 'findById'])->name('api.pedidos-programados.find-by-id');
            Route::put('/{id}', [PedidoProgramadoController::class, 'update'])->name('api.pedidos-programados.update');
            Route::patch('/{id}', [PedidoProgramadoController::class, 'update'])->name('api.pedidos-programados.update');
            Route::delete('/{id}', [PedidoProgramadoController::class, 'delete'])->name('api.pedidos-programados.delete');

        });

        /** --------------------------------------
         *  Pedido
         *  -------------------------------------- */
        Route::prefix('/pedidos')->group(function () {

            Route::post('/', [PedidoController::class, 'create'])->name('api.pedidos.create');
            Route::get('/', [PedidoController::class, 'fetch'])->name('api.pedidos.fetch');
            Route::get('/{id}', [PedidoController::class, 'findById'])->name('api.pedidos.find-by-id');
            Route::put('/{id}', [PedidoController::class, 'update'])->name('api.pedidos.update');
            Route::patch('/{id}', [PedidoController::class, 'update'])->name('api.pedidos.update');
            Route::delete('/{id}', [PedidoController::class, 'delete'])->name('api.pedidos.delete');

        });

        /** --------------------------------------
         *  Produto
         *  -------------------------------------- */
        Route::prefix('/produtos')->group(function () {

            Route::post('/', [ProdutoController::class, 'create'])->name('api.produtos.create');
            Route::get('/', [ProdutoController::class, 'fetch'])->name('api.produtos.fetch');
            Route::get('/{id}', [ProdutoController::class, 'findById'])->name('api.produtos.find-by-id');
            Route::put('/{id}', [ProdutoController::class, 'update'])->name('api.produtos.update');
            Route::patch('/{id}', [ProdutoController::class, 'update'])->name('api.produtos.update');
            Route::delete('/{id}', [ProdutoController::class, 'delete'])->name('api.produtos.delete');

            Route::get('/categoria/{categoriaId}', [ProdutoController::class, 'fetchByCategoriaId'])->name('api.produtos.fetch-by-categoria-id');

        });

        /** --------------------------------------
         *  ProdutoAvaliacao
         *  -------------------------------------- */
        Route::prefix('/produtos-avaliacoes')->group(function () {

            Route::post('/', [ProdutoAvaliacaoController::class, 'create'])->name('api.produtos-avaliacoes.create');
            Route::get('/', [ProdutoAvaliacaoController::class, 'fetch'])->name('api.produtos-avaliacoes.fetch');
            Route::get('/{id}', [ProdutoAvaliacaoController::class, 'findById'])->name('api.produtos-avaliacoes.find-by-id');
            Route::put('/{id}', [ProdutoAvaliacaoController::class, 'update'])->name('api.produtos-avaliacoes.update');
            Route::patch('/{id}', [ProdutoAvaliacaoController::class, 'update'])->name('api.produtos-avaliacoes.update');
            Route::delete('/{id}', [ProdutoAvaliacaoController::class, 'delete'])->name('api.produtos-avaliacoes.delete');

        });

        /** --------------------------------------
         *  ProdutoImagem
         *  -------------------------------------- */
        Route::prefix('/produtos-imagens')->group(function () {

            Route::post('/', [ProdutoImagemController::class, 'create'])->name('api.produtos-imagens.create');
            Route::get('/', [ProdutoImagemController::class, 'fetch'])->name('api.produtos-imagens.fetch');
            Route::get('/{id}', [ProdutoImagemController::class, 'findById'])->name('api.produtos-imagens.find-by-id');
            Route::put('/{id}', [ProdutoImagemController::class, 'update'])->name('api.produtos-imagens.update');
            Route::patch('/{id}', [ProdutoImagemController::class, 'update'])->name('api.produtos-imagens.update');
            Route::delete('/{id}', [ProdutoImagemController::class, 'delete'])->name('api.produtos-imagens.delete');

        });

        /** --------------------------------------
         *  ProdutoUser
         *  -------------------------------------- */
        Route::prefix('/produtos-users')->group(function () {

            Route::post('/', [ProdutoUserController::class, 'create'])->name('api.produtos-users.create');
            Route::get('/', [ProdutoUserController::class, 'fetch'])->name('api.produtos-users.fetch');
            Route::get('/{id}', [ProdutoUserController::class, 'findById'])->name('api.produtos-users.find-by-id');
            Route::put('/{id}', [ProdutoUserController::class, 'update'])->name('api.produtos-users.update');
            Route::patch('/{id}', [ProdutoUserController::class, 'update'])->name('api.produtos-users.update');
            Route::delete('/{id}', [ProdutoUserController::class, 'delete'])->name('api.produtos-users.delete');

        });

        /** --------------------------------------
         *  Residencia
         *  -------------------------------------- */
        Route::prefix('/residencias')->group(function () {

            Route::post('/', [ResidenciaController::class, 'create'])->name('api.residencias.create');
            Route::get('/', [ResidenciaController::class, 'fetch'])->name('api.residencias.fetch');
            Route::get('/{id}', [ResidenciaController::class, 'findById'])->name('api.residencias.find-by-id');
            Route::put('/{id}', [ResidenciaController::class, 'update'])->name('api.residencias.update');
            Route::patch('/{id}', [ResidenciaController::class, 'update'])->name('api.residencias.update');
            Route::delete('/{id}', [ResidenciaController::class, 'delete'])->name('api.residencias.delete');

        });

        /** --------------------------------------
         *  TempoUnidade
         *  -------------------------------------- */
        Route::prefix('/tempo-unidades')->group(function () {

            Route::post('/', [TempoUnidadeController::class, 'create'])->name('api.tempo-unidades.create');
            Route::get('/', [TempoUnidadeController::class, 'fetch'])->name('api.tempo-unidades.fetch');
            Route::get('/{id}', [TempoUnidadeController::class, 'findById'])->name('api.tempo-unidades.find-by-id');
            Route::put('/{id}', [TempoUnidadeController::class, 'update'])->name('api.tempo-unidades.update');
            Route::patch('/{id}', [TempoUnidadeController::class, 'update'])->name('api.tempo-unidades.update');
            Route::delete('/{id}', [TempoUnidadeController::class, 'delete'])->name('api.tempo-unidades.delete');

        });

        
        /** --------------------------------------
         *  CarrinhoProduto
         *  -------------------------------------- */
        Route::prefix('/carrinhos-produtos')->group(function () {

            Route::post('/', [CarrinhoProdutoController::class, 'create'])->name('api.carrinhos-produtos.create');
            Route::get('/', [CarrinhoProdutoController::class, 'fetch'])->name('api.carrinhos-produtos.fetch');
            Route::get('/{id}', [CarrinhoProdutoController::class, 'findById'])->name('api.carrinhos-produtos.find-by-id');
            Route::put('/{id}', [CarrinhoProdutoController::class, 'update'])->name('api.carrinhos-produtos.update');
            Route::patch('/{id}', [CarrinhoProdutoController::class, 'update'])->name('api.carrinhos-produtos.update');
            Route::delete('/{id}', [CarrinhoProdutoController::class, 'delete'])->name('api.carrinhos-produtos.delete');

        });

    });
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/pages.php';
