<div class="block">
    <label class="block">
        <span class="text-gray-700"><b>Incluir Pergunta e Resposta</b></span>
        <input type="text" wire:model.defer="id" wire:loading.attr="disabled" disabled class="w-full" />
        <label class="block">
            <span class="text-gray-700">Pergunta</span>
            <input type="text" wire:model.defer="pergunta" wire:loading.attr="disabled" class="w-full" />
            @error('pergunta') <span class="text-red-500">{{ $message }}</span>@enderror
        </label>
        <label class="block">
            <span class="text-gray-700">Resposta</span>
            <input type="text" wire:model.defer="resposta" wire:loading.attr="disabled" class="w-full" />
            @error('resposta') <span class="text-red-500">{{ $message }}</span>@enderror
        </label>
        <button wire:click="adicionaPergunta" type="button" class="px-3 font-sans text-sm text-white border border-solid border-caixaAzul bg-caixaAzul bg-opacity-90 h-3/4 hover:bg-opacity-100 focus:outline-none">
            <i class="fas fa-plus md:mr-2"></i>
            <div class="hidden md:inline-block">Incluir</div>
        </button>
    </label>
    <label class="block mt-4">
        <span class="text-gray-700"><b>Perguntas e Respostas incluídas</b></span>
        @forelse($qas as $key_qa => $qa_incluida)
            @if($qa_incluida)
                <div class="border shadown w-full mb-2">
                    <div class="p-2">
                        <span class="mr-2"><b>P:</b></span>
                        {{ $qa_incluida['pergunta'] ?? '' }}
                        <input type="hidden" name="pergunta_{{$key_qa}}" value="{{ $qa_incluida['pergunta'] ?? '' }}" />
                        <button class="text-red-500 float-right" wire:click.prevent="removePergunta({{ $key_qa }})">remover</button>
                    </div>
                    @if($qa_incluida['resposta'])
                    <div class="p-2">
                        <span class="mr-2"><b>R:</b></span>
                        {{ $qa_incluida['resposta'] ?? '' }}
                        <input type="hidden" name="resposta_{{$key_qa}}" value="{{ $qa_incluida['resposta'] ?? '' }}" />
                    </div>
                    @endif
                </div>
            @endif
        @empty
            <p>Nenhuma pergunta incluída</p>
        @endforelse
    </label>
</div>
