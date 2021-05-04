<?php

namespace App\Http\Livewire\Checklist;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Image;

use Illuminate\Support\Str;

class FotosUpload extends Component
{
    use WithFileUploads;

    public $photo;
    public $resposta;
    public $checklist;

    public function render()
    {
        return view('livewire.checklist.fotos-upload');
    }

    public function updatedPhoto($value)
    {
        $image = (string) Image::make($value->getRealPath())
                        ->resize(800, 600, function($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })
                        ->encode('data-url');

        $this->photo = $image;
        $this->save();

        $this->emit('atualizaProgressoChecklist');
    }

    public function excluirFoto() 
    {   
        /*
        if(Storage::disk('public')->exists($this->resposta->foto)) 
        {
            Storage::disk('public')->delete($this->resposta->foto);
        } 
        */

        $this->resposta->foto = null;
        $this->resposta->save();

        $this->photo = null;

        $this->emit('atualizaProgressoChecklist');
    }

    public function save()
    {
        $this->validate([
            //'photo' => 'required|image|mimes:jpg,jpeg,png,svg,gif', // 1MB Max
            'photo' => 'required|base64dimensions:min_width=100,min_height=200|base64image|base64mimes:jpg,jpeg,png'
        ]);
        
        //$extension = $this->photo->extension();
        //$path = $this->photo->storeAs('checklist_fotos', Str::uuid() . '.'. $extension, 'public');

        $this->resposta->foto = $this->photo;
        $this->resposta->save();

        $this->emit('atualizaProgressoChecklist');
    }
}

