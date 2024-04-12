<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('user/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::resource('users', App\Http\Controllers\UserController::class);

Route::resource('vetements', App\Http\Controllers\VetementController::class);

Route::resource('commandes', App\Http\Controllers\CommandeController::class);

Route::get('commandes/livrer/{id}', [App\Http\Controllers\CommandeController::class, 'livrer'])->name('livrerCommande');
Route::get('commandes/getPDF/{id}', [App\Http\Controllers\CommandeController::class, 'getPDF'])->name('commande.getPDF');

Route::get('commande/rapport_journalier', [App\Http\Controllers\CommandeController::class, 'rapport_journalier'])->name('commande.rapport_journalier');
Route::get('commande/rapport_hebdomadaire', [App\Http\Controllers\CommandeController::class, 'rapport_hebdomadaire'])->name('commande.rapport_hebdomadaire');
Route::get('commande/rapport_periodique', [App\Http\Controllers\CommandeController::class, 'rapport_periodique'])->name('commande.rapport_periodique');
Route::post('commande/rapport_periodique', [App\Http\Controllers\CommandeController::class, 'rapportJournalierStore'])->name('commande.rapportJournalierStore');

Route::get('commande/rapport_journalierPDF/{date}', [App\Http\Controllers\CommandeController::class, 'rapport_journalierPDF'])->name('rapport_journalier.PDF');
Route::post('commande/rapport_periodiquePDF', [App\Http\Controllers\CommandeController::class, 'rapport_periodiquePDF'])->name('rapport_periodique.PDF');

Route::get('commande/express', [App\Http\Controllers\CommandeController::class, 'express'])->name('commandes.express');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
