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

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Guia $guia)
    {   /*
        $guia->update($request->all());

        if (count($guia->images) > 0) {
            foreach ($guia->images as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }

        $media = $guia->images->pluck('file_name')->toArray();

        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                
                $filepath = Storage::disk('temp')->path('/') . $file;
                $image = (string) Image::make($filepath)
                            ->resize(800, 600, function($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            })
                            ->encode('data-url');
    
                $image = Imagem::create();
            }
        }

        return redirect()->route('admin.guias.index');
        */
    }

    public function destroy($id)
    {
        //
    }
}
