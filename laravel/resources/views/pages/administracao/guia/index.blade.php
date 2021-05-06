@extends('layouts.app')
@section('title', 'Guia | Administração')
@section('content')
<nav class="container h-auto px-2 mx-auto border-b">
    <nav class="my-2 text-xs text-gray-600 font-futura" aria-label="Breadcrumb">
        <ol class="inline-flex p-0 list-none">
            <li class="flex items-center">
                <a href="#">Administração</a>
                <svg class="w-2 h-2 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
            </li>
            <li class="flex items-center">
                <a href="{{ route('guia') }}">Guia</a>
            </li>
        </ol>
    </nav>
    <div class="flex flex-row justify-between h-8 my-2">
        <div class="flex flex-shrink-0 mr-10">
            <h1 class="h-full text-lg text-caixaAzul font-futurabold">
                <span class="inline-block w-3 h-3 mr-2 bg-caixaLaranja" style="clip-path: polygon(100% 0, 0 100%, 100% 100%);"></span>
                Guia
            </h1>
        </div>
        <div class="flex items-center">
            <a href="{{ route('adm.guia.create') }}" wire:loading.attr="disabled" class="px-3 font-sans text-sm text-white border border-solid border-caixaLaranja bg-caixaLaranja bg-opacity-90 h-3/4 hover:bg-opacity-100 focus:outline-none" ><i class="fas fa-plus md:mr-2"></i><div class="hidden md:inline-block">Adicionar</div></a>
        </div>
    </div>
</nav>
<div class="container px-2 py-3 mx-auto h-4/5">
    <div class="grid grid-cols-6 gap-4">
        @forelse ($guias as $guia)
            <a href="#" class="opacity-70 hover:opacity-100">
                <div class="flex flex-col items-center justify-center w-full mx-auto my-2 h-28">
                    <div style="background-image: url({{ $guia->imagens->first()->imagem }}); border-color: {{ $guia->item->cor }}"
                        class="w-full h-64 bg-gray-300 bg-center bg-cover border rounded-sm">
                    </div>
                    <div class="w-4/5 h-24 -mt-4 overflow-hidden border border-l-8 rounded-sm bg-gray-50" style="border-color: {{ $guia->item->cor }}">
                        <div class="py-2 text-sm font-bold tracking-wide text-center" style="color: {{ $guia->item->cor }}">{{ $guia->item->nome }}</div>
                    </div>
                </div>
            </a>
        @empty
            <p>Nenhum guia cadastrado</p>
        @endforelse
        
    </div>
</div>
@endsection