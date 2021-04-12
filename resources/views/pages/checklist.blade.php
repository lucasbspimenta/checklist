@extends('layouts.app')
@section('title', 'Checklist')
@section('content')
<nav class="container h-auto px-2 mx-auto border-b">
    <nav class="my-2 text-xs text-gray-600 font-futura" aria-label="Breadcrumb">
        <ol class="inline-flex p-0 list-none">
            <li class="flex items-center">
                <a href="{{ route('checklist.index') }}">Checklist</a>
            </li>
        </ol>
    </nav>
    <div class="flex flex-row justify-between h-8 my-2">
        <div class="flex flex-shrink-0 mr-10">
            <h1 class="h-full text-lg text-caixaAzul font-futurabold">
                <span class="inline-block w-3 h-3 mr-2 bg-caixaLaranja" style="clip-path: polygon(100% 0, 0 100%, 100% 100%);"></span>
                Checklist
            </h1>
        </div>
        <div class="flex items-center">
            <a href='{{ route('checklist.edit', 'novo') }}' id="botao_adicionar_topo" class="px-3 font-sans text-sm leading-6 text-white border border-solid border-caixaLaranja bg-caixaLaranja bg-opacity-90 h-3/4 hover:bg-opacity-100 focus:outline-none" >
                <i class="fas fa-plus md:mr-2"></i>
                <div class="hidden md:inline-block">Adicionar</div>
            </a>
        </div>
    </div>
</nav>
<div class="container px-2 py-3 mx-auto h-4/5">
    <div class="flex flex-wrap h-full -mx-1">

        <div class="w-1/4 px-1 my-1 overflow-hidden">
        <!-- Column Content -->
        </div>

        <div class="w-3/4 h-full px-1 my-1 overflow-hidden border">
            
        </div>

    </div>
</div>
@endsection