<?php

use App\Http\Controllers\PizzaController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/pizzas');
Route::resource('pizzas', PizzaController::class);