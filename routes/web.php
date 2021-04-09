<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;

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

Route::resource('/agenda', AgendaController::class)->names(['index' => 'agenda', 'update' => 'agenda_update']);

Route::prefix('administracao')->name('adm.')->group(function () {

    Route::get('/tipodeagendamento', function () {
        return view('pages.administracao.tipodeagendamento');
    })->name('tipodeagendamento');

    Route::get('/checklist', function () {
        return view('pages.administracao.checklistitens');
    })->name('checklist');

});
