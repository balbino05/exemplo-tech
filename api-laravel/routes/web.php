<?php

use Illuminate\Support\Facades\Route;
use Rebing\GraphQL\GraphQLController;
use Rebing\GraphQL\GraphQLServiceProvider;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/graphiql', function () {
    return view('graphiql'); // criaremos a view em seguida
});
