<div class="w-full h-auto p-4 bg-white border shadow-sm">
    <h2 class="h-full text-sm text-caixaAzul font-futurabold">
        Fotos Obrigatórias
    </h2>
    <div class="flex w-full mt-4">
        @forelse ($checklist->fotosObrigatorias as $resposta)
            <livewire:checklist.fotos-upload :resposta="$resposta" :checklist="$checklist" :key="$resposta->id">
        @empty
            <div class="block w-full text-center">    
                Nenhuma foto obrigatória
            </div>
        @endforelse
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        $('.image-popup-link').magnificPopup({
            type: 'image'
        });
    });
</script>
@endpush