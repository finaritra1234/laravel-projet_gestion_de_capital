<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DepenseController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/login',  [LoginController::class, 'loginForm'])->name('login');
Route::post('/login',  [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout',  [LoginController::class, 'logout'])->name('logout');;
Route::get('/',  [AdminLoginController::class, 'loginForm'])->name('admin.login');
Route::get('/register',  [AdminLoginController::class, 'registerForm'])->name('admin.register');
Route::post('/register',  [AdminLoginController::class, 'register' ])->name('admin.register.submit');
Route::prefix('admin')->group(function() {
    Route::post('/login',  [AdminLoginController::class, 'login' ])->name('admin.login.submit');
    Route::get('/logout',  [AdminLoginController::class, 'logout' ])->name('admin.logout');
    Route::get('/',  [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/compte',  [CompteController::class, 'compte' ])->name('compte');
    Route::post('/compte',  [CompteController::class, 'addCompte' ])->name('add.compte.submit');
    Route::get('/categorie',  [CategorieController::class, 'categorie' ])->name('categorie');
    Route::post('/categorie',  [CategorieController::class, 'addCategorie' ])->name('add.categorie.submit');
    Route::get('/delete_categorie/{id}',  [CategorieController::class, 'deleteCategorie' ])->name('categorie.delete');
    Route::get('/depense',  [DepenseController::class, 'depense' ])->name('depense');
    Route::get('/depense/date',  [DepenseController::class, 'depense_date' ])->name('depense.date');
    Route::get('/depense/date_entre',  [DepenseController::class, 'depense_date_entre' ])->name('depense.date_entre');
    Route::post('/depense',  [DepenseController::class, 'addDepense' ])->name('add.depense.submit');
    Route::get('/delete_depense/{id}',  [DepenseController::class, 'deleteDepense' ])->name('depense.delete');
    Route::get('/edit_depense/{id}',  [DepenseController::class, 'editDepense' ])->name('depense.edit');
    Route::post('/edit_depense/{id}',  [DepenseController::class, 'editDepenseSubmit' ])->name('depense.edit.submit');
    Route::get('/annuler_depense/{id}',  [DepenseController::class, 'annulerDepense' ])->name('depense.annuler');
  
});
