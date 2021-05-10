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
            @switch(true)
                @case($conta_itens_ativos <= 0)
                    <div class="block text-sm text-caixaTangerina">
                        Não há itens de checklist ativos ou cadastrados
                    </div>
                @break

                @case($agendamentos_sem_checklist <= 0)
                    <div class="block text-sm text-caixaTangerina">
                        Não há agendamentos sem checklist cadastrado
                    </div>
                @break
            
                @default
                    <a href='{{ route('checklist.edit', 'novo') }}' id="botao_adicionar_topo" class="px-3 font-sans text-sm leading-6 text-white border border-solid border-caixaLaranja bg-caixaLaranja bg-opacity-90 h-3/4 hover:bg-opacity-100 focus:outline-none" >
                        <i class="fas fa-plus md:mr-2"></i>
                        <div class="hidden md:inline-block">Adicionar</div>
                    </a>
            @endswitch
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

        <div class="w-full h-full px-1 my-1 border">
            <table id="table_checklist" class="relative w-full whitespace-no-wrap bg-white border-collapse table-auto table-striped">
                <thead>
                    <tr>
                        <th class="px-2 py-2 mb-2 text-sm leading-4 tracking-wider text-left text-blue-500 border-b-2 border-gray-300">Data</th>
                        <th class="px-2 py-2 text-sm leading-4 tracking-wider text-left text-blue-500 border-b-2 border-gray-300">Unidade</th>
                        <th class="px-2 py-2 text-sm leading-4 tracking-wider text-left text-blue-500 border-b-2 border-gray-300">Descrição</th>
                        <th class="px-2 py-2 text-sm leading-4 tracking-wider text-left text-blue-500 border-b-2 border-gray-300">% Preenchimento</th>
                        <th class="px-2 py-2 text-sm leading-4 tracking-wider text-left text-blue-500 border-b-2 border-gray-300">% Demandas concluídas </th>
                        <th class="px-2 py-2 text-sm leading-4 tracking-wider text-left text-blue-500 border-b-2 border-gray-300">Opções</th>
                    </tr>
                </thead>
                <tbody class="mt-2 text-sm">
                    @forelse ($lista_checklists as $checklist)
                        <tr class="border-b">
                            <td class="px-2 py-2">
                                {{ $checklist->agendamento->inicioFormatado }} 
                                @if($checklist->agendamento->final && $checklist->agendamento->final != $checklist->agendamento->inicio)
                                    até {{ ($checklist->agendamento->finalFormatado) }}
                                @endif
                            </td>
                            <td class="px-2 py-2">{{ $checklist->agendamento->unidade_id }}</td>
                            <td class="px-2 py-2">{{ $checklist->agendamento->descricao }}</td>
                            <td class="px-2 py-2">{{ $checklist->percentualPreenchimento }}</td>
                            <td class="px-2 py-2">{{ $checklist->percentualDemandas }}</td>
                            <td class="w-1/5 px-2 py-2">
                                <div class="flex flex-nowrap">
                                    <a href="{{ route('checklist.edit', [$checklist->agendamento->id]) }}"
                                        class="px-3 font-sans text-sm bg-white border border-white border-solid text-caixaAzul hover:border-gray focus:outline-none" >
                                        @if ($checklist->concluido != 1)
                                            <i class="fas fa-edit"></i>
                                        @else
                                            <i class="fas fa-eye"></i>
                                        @endif
                                    </a>
                                    @if ($checklist->concluido != 1)
                                        <button 
                                            onClick="excluirChecklist({{ $checklist->id }})" 
                                            class="px-3 font-sans text-sm bg-white border border-white border-solid text-red hover:border-gray focus:outline-none" >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="6">Nenhum checklist encontrado.</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
@push('scripts')
    <script>
        function excluirChecklist(id) {

            Swal.fire({
                title: 'Você tem certeza?',
                text: "O checklist será excluído",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, tenho certeza!',
                cancelButtonText: 'Não'
            }).then((result) => {
                if (result.value) {
                    axios.post('{{ route("checklist.delete") }}', {
                        id: id,
                        _method: 'DELETE'
                    })
                    .then(function (response) {
                        document.location.reload(true);
                    })
                    .catch(function (error) {
                        toastr.error('Erro ao excluir ' + error);
                    });
                } else {
                    console.log("Canceled");
                }
            });
        }
    </script>
@endpush