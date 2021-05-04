@extends('layouts.app')
@section('title', 'Agenda')
@section('content')
<nav class="container h-auto px-2 mx-auto border-b">
    <nav class="my-2 text-xs text-gray-600 font-futura" aria-label="Breadcrumb">
        <ol class="inline-flex p-0 list-none">
            <li class="flex items-center">
                <a href="{{ route('agenda') }}">Agenda</a>
            </li>
        </ol>
    </nav>
    <div class="flex flex-row justify-between h-8 my-2">
        <div class="flex flex-shrink-0 mr-10">
            <h1 class="h-full text-lg text-caixaAzul font-futurabold">
                <span class="inline-block w-3 h-3 mr-2 bg-caixaLaranja" style="clip-path: polygon(100% 0, 0 100%, 100% 100%);"></span>
                Agenda
            </h1>
        </div>
        <div class="flex items-center">
            <button id="botao_adicionar_topo" onClick="abrirModalAgenda(false, false);" class="px-3 font-sans text-sm text-white border border-solid border-caixaLaranja bg-caixaLaranja bg-opacity-90 h-3/4 hover:bg-opacity-100 focus:outline-none" >
                <i class="fas fa-plus md:mr-2"></i>
                <div class="hidden md:inline-block">Adicionar</div>
            </button>
        </div>
    </div>
</nav>
<div class="container px-2 py-3 mx-auto h-4/5">
    <div class="flex flex-wrap h-full -mx-1">
        <!--
        <div class="w-1/4 px-1 my-1 overflow-hidden">
         Column Content 
        </div>
        -->

        <div class="w-full h-full px-1 my-1 overflow-hidden border">
            <div id="calendar"></div>
        </div>

    </div>
</div>
<livewire:agenda.modal-livewire/>
<livewire:agenda.visualizar-livewire/>
@endsection
@push('scripts')
    <script>

    var calendar;

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ interactionPlugin, dayGridPlugin, listPlugin ],
            locale: 'pt-BR',
            initialView: 'dayGridMonth',
            selectable:true,
            height: '100%',
            select: aoSelecionarData,
            eventResize: alterarAgendamento,
            eventDrop: alterarAgendamento,
            lazyFetching: true,
            editable:true,
            eventSources: [
                @forelse ($lista_tipos_de_agendamento as $tipo)
                    {
                        url: '{{ route("agenda") }}', // use the `url` property
                        color: '{{ $tipo->cor }}',    // an option!
                        textColor: 'white',
                        startParam: 'inicio',
                        endParam: 'final',
                        extraParams: {
                            tipo_id: {{ $tipo->id }},
                            dataType:"json"
                            
                        }
                    },
                @empty

                @endforelse
                
            ],
            eventClick: function(info) {
                console.log(info.event.id);
                Livewire.emit('abrirModalVerAgenda', info.event.id);
            },
            eventDidMount: function(info) {

                if(info.event.extendedProps.descricao) {
                    var tooltip = tippy(info.el, {
                        content: '<ul><li>'+ info.event.extendedProps.descricao +'</li></ul>',
                        allowHTML: true,
                    });
                }
            },
        });

        function alterarAgendamento(info, delta) {
            const event = info.event;
            console.log(info.event.id);
            axios.post('{{ route("agenda.store") }}', {
                id: event.id,
                inicio: event.startStr,
                final: event.endStr
            })
            .then(function (response) {
                toastr.success('Reagendado com sucesso!');
                calendar.refetchEvents();
            })
            .catch(function (error) {
                toastr.error('Erro ao reagendar ' + error);
                calendar.refetchEvents();
            });
        }

        calendar.render();
    });

    function aoSelecionarData({startStr, endStr}) {
        abrirModalAgenda(startStr, endStr);
    }

    Livewire.on('triggerDeleteAgenda', (agendaId) => {

        Swal.fire({
                title: 'Você tem certeza?',
                text: "O agendamento será excluído",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, tenho certeza!',
                cancelButtonText: 'Não'
            }).then((result) => {
                if (result.value) {
                    Livewire.emit('deletarAgenda', agendaId);
                } else {
                    console.log("Canceled");
                }
            });
    })

    function abrirModalAgenda(data_inicio, data_final) {
        Livewire.emit('abrirModalAgenda',false, data_inicio, data_inicio);
    }

    window.addEventListener('triggerAgendaGravadaSucesso', (event) => {
        toastr.success('Agendamento em '+ event.detail +' gravado com sucesso!');
        console.log('Chamei o evento para atualizar a agenda', calendar.getEventSources());
        console.log(calendar.refetchEvents());

        if(calendar.getEventSources().length <= 0)
            document.location.reload(true);
    })

    window.addEventListener('triggerAgendaExcluidaSucesso', (event) => {
        toastr.success('Agendamento excluído com sucesso!');
        calendar.refetchEvents()
    })

    </script>
@endpush
