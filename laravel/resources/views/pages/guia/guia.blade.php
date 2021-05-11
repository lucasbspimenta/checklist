@extends('layouts.app')
@section('title', 'Guia')
@section('content')
<nav class="container h-auto px-2 mx-auto border-b">
    <nav class="my-2 text-xs text-gray-600 font-futura" aria-label="Breadcrumb">
        <ol class="inline-flex p-0 list-none">
            <li class="flex items-center">
                <a href="{{ route('guia.index') }}">Guia</a>
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
    </div>
</nav>
<div class="container px-2 py-3 mx-auto h-4/5">
    <div class="grid grid-cols-6 gap-4">
        @forelse ($guias as $guia)
        <div class="block">
            
                <div class="flex flex-col items-center justify-center w-full mx-auto my-2 h-28">
                    <div style="background-image: url({{ $guia->imagens->first()->imagem }}); border-color: {{ $guia->item->cor }}"
                        class="w-full h-64 bg-gray-300 bg-center bg-cover border rounded-sm">
                    </div>
                    <div class="w-4/5 h-24 -mt-4 overflow-hidden border border-l-8 rounded-sm bg-gray-50" style="border-color: {{ $guia->item->cor }}">
                        <div class="py-2 text-sm font-bold tracking-wide text-center" style="color: {{ $guia->item->cor }}">
                            <a href="{{ route('guia.show', [$guia]) }}" class="opacity-70 hover:opacity-100">
                                {{ $guia->item->nome }}
                            </a>
                        </div>
                    </div>
                </div>
            
        </div>
        @empty
            <p>Nenhum guia cadastrado</p>
        @endforelse
    </div>
</div>
@endsection
@push('scripts')
    <script>
    </script>
@endpush
