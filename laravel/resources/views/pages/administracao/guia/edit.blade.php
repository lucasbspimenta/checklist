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
                <a href="{{ route('adm.guia.index') }}">Guia</a>
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
            <a href="{{ url()->previous() }}" class="px-3 mr-2 font-sans text-sm leading-6 text-gray-700 border border-solid border-caixaCinza bg-caixaCinza bg-opacity-90 h-3/4 hover:bg-opacity-100 focus:outline-none" >
                <i class="fas fa-chevron-left md:mr-2"></i>
                <div class="hidden md:inline-block">Voltar</div>
            </a>
            <button type="button" onClick="$('#form_guia').submit()" class="px-3 font-sans text-sm text-white border border-solid border-caixaLaranja bg-caixaLaranja bg-opacity-90 h-3/4 hover:bg-opacity-100 focus:outline-none" ><i class="fas fa-save md:mr-2"></i><div class="hidden md:inline-block">Gravar</div></button>
        </div>
    </div>
</nav>
<div class="container flex justify-center h-auto px-2 py-3 mx-auto">
    <div class="w-full -mx-1">
        <form action="{{ route("adm.guia.update",[$guia]) }}" method="POST" enctype="multipart/form-data" id="form_guia">
            @csrf
            @method('PUT')
            @include('pages.administracao.guia.form', ['guia' => $guia])
        </form>
    </div>
</div>
@endsection
