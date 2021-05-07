<div class="grid grid-flow-col gap-6">
    <div class="block">
        <label class="block">
            <span class="text-gray-700">Macroitem / Item</span>
            <select name="checklist_item_id" id="checklist_item_id" class="w-full">
                <option value="" >Selecione o item ou macroitem</option>
                @forelse ($itens as $item)
                    <option  
                    @if($guia && $guia->item->id == $item->id) selected="selected" @endif
                        value="{{ $item->id }}">
                        {{ $item->nome }}
                    </option>
                @empty
                    <option value="" >Nenhum item sem guia foi localizado</option>
                @endforelse
            </select>
            @error('checklist_item_id') <span class="text-red-500">{{ $message }}</span>@enderror
        </label>
        <label class="block">
            <span class="text-gray-700">Descrição</span>
            <textarea name="descricao" class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-caixaAzul text-sm" rows="2">{{ old('descricao', $guia->descricao ?? '') }}</textarea>
            @error('descricao') <span class="text-red-500">{{ $message }}</span>@enderror
        </label>
        <label class="block">
            <span class="text-gray-700">Imagens</span>
            <div id="dropzone">
                <div class="dropzone" id="uploadFile">
                    @csrf
                    <div class="dz-message">
                        Drag 'n' Drop Files<br>
                    </div>
                </div>
            </div>
        </label>
    </div>
    <div class="block">
        @if(isset($guia) && $guia->QAs)
            <livewire:guia.q-a :qas="$guia->QAsArrayForm"/> 
        @else
            <livewire:guia.q-a /> 
        @endif
    </div>
</div>

@push('scripts')
<script>
        var uploadedImagesMap = {}
        var dropzone = new Dropzone('#uploadFile', {
            url: '{{ route('drag-drop') }}',
            parallelUploads: 3,
            thumbnailHeight: 120,
            thumbnailWidth: 120,
            maxFilesize: 2,
            addRemoveLinks: true,
            acceptedFiles: ".jpeg,.jpg,.png",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            /*
            thumbnail: function (file, dataUrl) {
                if (file.previewElement) {
                    file.previewElement.classList.remove("dz-file-preview");
                    var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
                    for (var i = 0; i < images.length; i++) {
                        var thumbnailElement = images[i];
                        thumbnailElement.alt = file.name;
                        thumbnailElement.src = dataUrl;
                    }
                    setTimeout(function () {
                        file.previewElement.classList.add("dz-image-preview");
                    }, 1);
                }
            }*/
            init: function() {
                
                this.on("success", function(file, response) { 
                    //alert("Added file."); console.log(file)
                    $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
                    uploadedImagesMap[file.name] = response.name
                });

                @if(isset($guia) && $guia->imagens)
                    var files =
                    {!! json_encode($guia->imagens) !!};
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        file.previewTemplate.children[0].children[0].src = file.imagem;
                        console.log(file);
                        $('form').append('<input type="hidden" name="images[]" value="' + file.name + '">')
                    }
                @endif
            },
            removedfile: function (file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.name !== 'undefined') {
                    name = file.name
                } else {
                    name = uploadedImagesMap[file.name]
                }
                $('form').find('input[name="images[]"][value="' + name + '"]').remove()
            },
        });
</script>
    
@endpush