@extends('layouts.app')
@section('title', 'Guia')
@section('content')
<nav class="container h-auto px-2 mx-auto border-b">
    <nav class="my-2 text-xs text-gray-600 font-futura" aria-label="Breadcrumb">
        <ol class="inline-flex p-0 list-none">
            <li class="flex items-center">
                <a href="{{ route('guia.index') }}">Guia</a>
                <svg class="w-2 h-2 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
            </li>
            <li class="flex items-center">
                <a href="{{ route('guia.show', $guia) }}">{{ $guia->item->nome }}</a>
            </li>
        </ol>
    </nav>
    <div class="flex flex-row justify-between h-8 my-2">
        <div class="flex flex-shrink-0 mr-10">
            <h1 class="h-full text-lg text-caixaAzul font-futurabold">
                <span class="inline-block w-3 h-3 mr-2 bg-caixaLaranja" style="clip-path: polygon(100% 0, 0 100%, 100% 100%);"></span>
                {{ $guia->item->nome }}
            </h1>
        </div>
        @if(!isset($modal) || !$modal) 
        <div class="flex items-center">
            <a href="{{ session('redirect_to') ?? url()->previous() }}" class="px-3 mr-2 font-sans text-sm leading-6 text-gray-700 border border-solid border-caixaCinza bg-caixaCinza bg-opacity-90 h-3/4 hover:bg-opacity-100 focus:outline-none" >
                <i class="fas fa-chevron-left md:mr-2"></i>
                <div class="hidden md:inline-block">Voltar</div>
            </a>
        </div>
        @endif
    </div>
</nav>
<div class="container px-2 py-3 mx-auto h-4/5">
    <div class="grid grid-cols-2 gap-4">
        <label class="block">
            <span class="text-gray-700"><b>Fotos</b></span>
            @forelse($guia->imagens as $key_imagem => $imagem_incluida)
                <div class="grid grid-cols-2 gap-4">
                    <div class="block" class="h-20">
                        <img class="h-20" src="{{ $imagem_incluida->imagem }}" />
                    </div>
                </div>
            @empty
                <p>Nenhuma foto incluída</p>
            @endforelse
        </label>
        <label class="block">
            <span class="text-gray-700"><b>Descrição</b></span>
            <p>{{ $guia->descricao }}</p>
            
        </label>
        <label class="block mt-4">
            <span class="text-gray-700"><b>Perguntas e Respostas incluídas</b></span>
            @forelse($guia->qas as $key_qa => $qa_incluida)
                @if($qa_incluida)
                    <div class="flex justify-between w-full mb-2 border shadown">
                        
                        <div class="block">
                            <div class="p-2">
                                <span class="mr-2"><b>P:</b></span>
                                {{ $qa_incluida['pergunta'] ?? '' }}
                                <input type="hidden" name="pergunta_{{$key_qa}}" value="{{ $qa_incluida['pergunta'] ?? '' }}" />
                                
                            </div>
                            @if($qa_incluida['resposta'])
                            <div class="p-2">
                                <span class="mr-2"><b>R:</b></span>
                                {{ $qa_incluida['resposta'] ?? '' }}
                                <input type="hidden" name="resposta_{{$key_qa}}" value="{{ $qa_incluida['resposta'] ?? '' }}" />
                            </div>
                            @endif
                        </div>
                        <div class="block">
                            <a href="#" class="text-red-500" wire:click.prevent="removePergunta({{ $key_qa }})">remover</a>
                        </div>
                        
                    </div>
                @endif
            @empty
                <p>Nenhuma pergunta incluída</p>
            @endforelse
        </label>
    </div>
</div>
@endsection
@push('scripts')
    <script>
    </script>
@endpush
