<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('produto/new',[ProdutoController::class,'store']);

Route::post('produto/update',[ProdutoController::class,'update']);

Route::get('produto/movement/{sku?}',[ProdutoController::class,'stockMovement']);