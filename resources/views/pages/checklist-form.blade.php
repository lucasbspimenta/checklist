@extends('layouts.app')
@section('title', 'Checklist')
@section('content')
    <nav class="container h-auto px-2 mx-auto border-b">
        <nav class="my-2 text-xs text-gray-600 font-futura" aria-label="Breadcrumb">
            <ol class="inline-flex p-0 list-none">
                <li class="flex items-center">
                    <a href="{{ route('checklist.index') }}">Checklist</a>
                </li>
                <li>@if($agenda){{ $agenda->unidade_id }} - {{ $agenda->inicio }} @endif</li>
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
                <a href="{{ url()->previous() }}" class="px-3 mr-2 font-sans text-sm leading-6 text-gray-700 border border-solid border-caixaCinza bg-caixaCinza bg-opacity-90 h-3/4 hover:bg-opacity-100 focus:outline-none" >
                    <i class="fas fa-chevron-left md:mr-2"></i>
                    <div class="hidden md:inline-block">Voltar</div>
                </a>
                <button 
                    onClick="$('#form_checklist').submit()"
                    class="px-3 font-sans text-sm text-white border border-solid border-caixaLaranja bg-caixaLaranja bg-opacity-90 h-3/4 hover:bg-opacity-100 focus:outline-none" >
                    <i class="fas fa-save md:mr-2"></i>
                    <div class="hidden md:inline-block">Gravar</div>
                </button>        
            </div>
        </div>
    </nav>
    @if($agenda)
    <div class="container px-2 py-3 mx-auto h-4/5">
        <div class="flex flex-wrap h-full text-sm">
            <div class="w-3/4 h-full px-1 pr-4">
                <div class="w-full h-auto p-4 mb-3 bg-white border shadow-sm">
                    <div class="hidden w-full grid-flow-col gap-8 auto-cols-max">
                        <label class="block">
                            <span class="text-gray-400">Imóvel</span>
                            <div class="table-cell text-base leading-6 text-center text-gray-700">{{ $agenda->unidade_id ?? '' }}</div>
                        </label>
                        <label class="block">
                            <span class="text-gray-400">Tipo</span>
                            <div class="flex items-center text-base leading-6 text-center text-gray-700">
                                <div class="table-cell w-4 h-4 mr-2" style="background-color: {{ $agenda->tipo->cor }}"></div>
                                {{ $agenda->tipo->nome ?? '' }}
                            </div>
                        </label>
                        <label class="block">
                            <span class="text-gray-400">Início</span>
                            <p class="text-base leading-6 text-gray-700">{{ $agenda->inicio ?? '' }}</p>
                        </label>
                        @if($agenda->inicio != $agenda->final)
                        <label class="block">
                            <span class="text-gray-400">Final</span>
                            <p class="text-base leading-6 text-gray-700">{{ $agenda->final ?? '' }}</p>
                        </label>
                        @endif
                    </div>
                    <div class="grid w-full grid-flow-col gap-8 auto-cols-max">
                        <label class="block">
                            <span class="text-gray-400">Descrição</span>
                            <p class="text-base leading-6 text-gray-700">{{ $agenda->descricao ?? '' }}</p>
                        </label>
                    </div>
                </div>
                <x-checklist.fotos-obrigatorias :checklist="$agenda->checklist"/>
                <form 
                    id="form_checklist"
                    method="POST"
                    action="{{ route('checklist.edit', $agenda->id) }}"
                >
                    @csrf
                    <x-checklist.lista-itens-vinculados :checklist="$agenda->checklist"/>
                </form>
            </div>
            <div class="w-1/4 px-1">
                <h2 class="h-full text-base text-caixaAzul font-futurabold">
                    Demandas
                </h2>
            </div>
        </div>
    </div>
    @else
        <div class="blocker">
            <div class="w-4/6 p-6 modal" id="modal-atendimento-tipo-form" style="display: inline-block;">
                <div class="flex items-center justify-between pb-3">
                    <p class="text-lg text-caixaAzul font-futurabold">Selecione o agendamento para qual deseja preencher o checklist:</p>
                    <div class="z-50 cursor-pointer">
                        <a href="{{ url()->previous() }}">
                            <svg class="text-black fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="block mt-2 mb-2">
                    @foreach($agenda_sem_checklist as $agendamento)
                    <a href="{{ route('checklist.edit', $agendamento->id) }}">
                        <div class="w-full border-b rounded-t cursor-pointer border-gray-50 hover:bg-gray-200">
                            <div class="relative flex items-center w-full p-2 pl-2 border-l-4 border-transparent hover:border-caixaLaranja">
                                <div class="flex items-center w-full">
                                    <div class="mx-2 -mt-1 ">{{ $agendamento->unidade->nomeCompleto }} - {{ $agendamento->dataFormatada }}
                                        <div class="w-full -mt-1 text-xs font-normal text-gray-500 normal-case truncate">
                                            <div class="flex items-center text-base leading-6 text-center text-gray-700">
                                                <div class="table-cell w-4 h-4 mr-2 border" style="background-color: {{ $agendamento->tipo->cor }}"></div>
                                                {{ $agendamento->tipo->nome ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <div class="flex justify-between pt-2">
                    <a href="{{ url()->previous() }}"  class="leading-6 border-solid border border-gray-400 text-sm font-sans bg-caixaCinza bg-opacity-90 text-gray-500 px-3 py-1 hover:bg-opacity-100 focus:outline-none min-w-[75px]" >Cancelar</a>
                </div>
            </div>
        </div>
    @endif
    <div class="gmodal" id="modalAdicionarDemanda" role="dialog" aria-labelledby="Modal">
        <div class="gmodal__container has-center">
            <div class="gmodal__dialog">
                <livewire:checklist.demanda-form/>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var elementoAdicionarDemanda = document.querySelector('#modalAdicionarDemanda');
        var modalAdicionarDemanda = new Gmodal(elementoAdicionarDemanda);

        elementoAdicionarDemanda.addEventListener('gmodal:beforeclose', function(evt) {
            Livewire.emitTo('checklist.demanda-form', 'fechouModal');
        })

        @if(session()->has('mensagem_sucesso'))
            toastr.success("{!! session('mensagem_sucesso') !!}");
            {!! Session::forget('mensagem_sucesso') !!}
        @endif

        function AdicionarDemanda(item_id) 
        {
            Livewire.emitTo('checklist.demanda-form', 'abriuModal',item_id);
            modalAdicionarDemanda.open();
        }

        window.addEventListener('triggerDemandaGravadaSucesso', event => {
            modalAdicionarDemanda.close();
            toastr.success('Demanda incluída com sucesso!');
        })

        
        
    </script>   
@endpush