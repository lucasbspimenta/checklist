<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Administracao\ChecklistItem;

class GuiaController extends Controller
{
    public function index()
    {
        return view('pages.administracao.guia.index');
    }

    
    public function create()
    {
        $itens = ChecklistItem::all();
        return view('pages.administracao.guia.create', compact('itens'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
