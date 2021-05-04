<form class="flex h-full ml-2" 
    method="POST"
    action="{{ route('checklist.edit', $agenda->id) }}"
>
    @csrf
    <input type="hidden" name="redirect_to" value="{{ session('redirect_to') ?? url()->previous() }}" />
    <input type="hidden" name="finalizar" value="1" />
    <span 
        @if($checklist->percentualPreenchimento < 100)
            data-tippy-content="Você deve preencher todos os itens para finalizar" 
        @endif
    tabindex="0">
        <button 
            @if($checklist->percentualPreenchimento < 100)
                disabled="disabled"
            @endif
            class="px-3 mt-1 font-sans text-sm text-white border border-solid border-caixaAzul bg-caixaAzul bg-opacity-90 h-3/4 hover:bg-opacity-100 focus:outline-none disabled:opacity-30" >
            <i class="fas fa-check-double md:mr-2"></i>
            <div class="hidden md:inline-block">Finalizar</div>
        </button>
    </span>
</form>
