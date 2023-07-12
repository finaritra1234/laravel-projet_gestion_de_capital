<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\SearchController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::resource('/produit', ProduitController::class);



// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function() {


    //Produit
    //Route::resource('/produit', ProduitController::class);

    //Commande
    Route::resource('/commande', CommandeController::class);
    Route::get('/listeByUser', [CommandeController::class, 'listeByUser']);
    Route::get('/listeCommande', [CommandeController::class, 'listeCommande']);
    Route::get('/comNow', [CommandeController::class, 'comNow']);
    Route::get('/count', [CommandeController::class, 'count']);
    Route::post('/com/{mot}', [CommandeController::class, 'findCom']);
    Route::put('/commandes/{id}', [CommandeController::class, 'updateCom']);
    Route::delete('/commandes/{id}', [CommandeController::class, 'delete']); 

    // User
    Route::get('/user', [AuthController::class, 'user']);
    Route::put('/user', [AuthController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/listeUser', [AuthController::class, 'listeUser']);
    Route::delete('/user/{id}', [AuthController::class, 'destroy']); 
    Route::post('/addUser', [AuthController::class, 'addUser']);

    // Post
    Route::get('/posts', [PostController::class, 'index']); // all posts
    Route::post('/posts', [PostController::class, 'store']); // create post
    Route::get('/posts/{id}', [PostController::class, 'show']); // get single post
    Route::put('/posts/{id}', [PostController::class, 'update']); // update post
    Route::delete('/posts/{id}', [PostController::class, 'destroy']); // delete post

    // Comment
    Route::get('/posts/{id}/comments', [CommentController::class, 'index']); // all comments of a post
    Route::post('/posts/{id}/comments', [CommentController::class, 'store']); // create comment on a post
    Route::put('/comments/{id}', [CommentController::class, 'update']); // update a comment
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']); // delete a comment

    // Like
    Route::post('/posts/{id}/likes', [LikeController::class, 'likeOrUnlike']); // like or dislike back a post
});

Route::get('/search_produit',[SearchController::class, 'search']);