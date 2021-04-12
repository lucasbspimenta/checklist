<?php

namespace App\Http\Livewire\Checklist;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

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
        $this->save();
    }

    public function excluirFoto() 
    {
        if(Storage::disk('public')->exists($this->resposta->foto)) 
        {
            Storage::disk('public')->delete($this->resposta->foto);
        } 

        $this->resposta->foto = null;
        $this->resposta->save();

        $this->photo = null;
    }

    public function save()
    {
        $this->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg,gif', // 1MB Max
        ]);
        
        $extension = $this->photo->extension();
        $path = $this->photo->storeAs('checklist_fotos', Str::uuid() . '.'. $extension, 'public');
        $this->resposta->foto = $path;
        $this->resposta->save();
    }
}

