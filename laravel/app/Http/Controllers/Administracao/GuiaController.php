<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuiaStoreRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\Administracao\ChecklistItem;
use App\Models\Guia;
use App\Models\Imagem;

use Image;

class GuiaController extends Controller
{
    public function index()
    {
        $guias = Guia::all();
        return view('pages.administracao.guia.index', compact('guias'));
    }

    
    public function create()
    {
        $itens = ChecklistItem::doesntHave('guia')->get();
        return view('pages.administracao.guia.create', compact('itens'));
    }

    public function store(GuiaStoreRequest $request)
    {
        DB::beginTransaction();

        try {
            $guia = Guia::create($request->validated());

            foreach ($request->input('images', []) as $file) {
                $filepath = Storage::disk('temp')->path('/') . $file;
                $image = (string) Image::make($filepath)
                            ->resize(800, 600, function($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            })
                            ->encode('data-url');

                $imagem = $guia->imagens()->create([
                    'name' => $file,
                    'imagem' => $image,
                ]);

                if($imagem)
                 unlink(Storage::disk('temp')->path('/') . $file);
            }

            $array_qas = [];
            foreach($request->input() as $key_input => $value_input) {

                if(Str::startsWith($key_input, 'pergunta_'))
                {
                    $id_pergunta = Str::replaceFirst('pergunta_', '' ,$key_input);

                    $reposta_value = '';
                    if ($request->has('resposta_' . $id_pergunta)) {
                        $reposta_value = $request->input('resposta_' . $id_pergunta);
                    }

                    $qa = $guia->QAs()->create([
                        'pergunta' => $value_input
                        , 'resposta' => $reposta_value
                    ]);
                }
            }


            DB::commit();

            return redirect()->route('adm.guia.index');

        } catch (\Throwable $th) {

            ddd($th);
            return redirect()->back()->withErrors()->withInput();

            DB::rollBack();
        }

        
    }

    public function show($id)
    {
        //
    }

    public function edit($guia)
    {
        $guia = Guia::findOrFail($guia);
        $itens = ChecklistItem::doesntHave('guia')->union($guia->item())->get();
        
        return view('pages.administracao.guia.edit', compact('itens', 'guia'));
    }

    public function update(GuiaStoreRequest $request, $guia)
    {   
        DB::beginTransaction();

        try {
            $guia = Guia::findOrFail($guia); 
            $guia->update($request->validated());

            if (count($guia->imagens) > 0) {
                foreach ($guia->imagens as $imagem) {
                    if (!in_array($imagem->name, $request->input('images', []))) {
                        $imagem->delete();
                    }
                }
            }

            $media = $guia->imagens->pluck('name')->toArray();

            foreach ($request->input('images', []) as $file) {

                if (count($media) === 0 || !in_array($file, $media)) {
                    $filepath = Storage::disk('temp')->path('/') . $file;
                    $image = (string) Image::make($filepath)
                                ->resize(800, 600, function($constraint) {
                                    $constraint->aspectRatio();
                                    $constraint->upsize();
                                })
                                ->encode('data-url');

                    $imagem = $guia->imagens()->create([
                        'name' => $file,
                        'imagem' => $image,
                    ]);

                    if($imagem)
                    unlink(Storage::disk('temp')->path('/') . $file);
                }
            }

            $guia->QAs()->delete();

            $array_qas = [];
            foreach($request->input() as $key_input => $value_input) {

                if(Str::startsWith($key_input, 'pergunta_'))
                {
                    $id_pergunta = Str::replaceFirst('pergunta_', '' ,$key_input);

                    $reposta_value = '';
                    if ($request->has('resposta_' . $id_pergunta)) {
                        $reposta_value = $request->input('resposta_' . $id_pergunta);
                    }

                    $qa = $guia->QAs()->create([
                        'pergunta' => $value_input
                        , 'resposta' => $reposta_value
                    ]);
                }
            }


            DB::commit();

            return redirect()->route('adm.guia.index');

        } catch (\Throwable $th) {

            ddd($th);
            return redirect()->back()->withErrors()->withInput();

            DB::rollBack();
        }
    }

    public function destroy($guia)
    {
        $guia = Guia::findOrFail($guia);
        $guia->delete();

        return redirect()->route('adm.guia.index');
    }
}
