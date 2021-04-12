<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ChecklistController;

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

Route::get('/', function () {
    return view('index');
})->name('index');

Route::resource('/agenda', AgendaController::class)->names(['index' => 'agenda']);

Route::get('/checklist',                                [ChecklistController::class, 'index'])->name('checklist.index');
Route::match(['get', 'post'],'/checklist/{agenda_id}',  [ChecklistController::class, 'show'])->name('checklist.edit');

Route::prefix('administracao')->name('adm.')->group(function () {

    Route::get('/tipodeagendamento', function () {
        return view('pages.administracao.tipodeagendamento');
    })->name('tipodeagendamento');

    Route::get('/checklist', function () {
        return view('pages.administracao.checklistitens');
    })->name('checklist');

});

