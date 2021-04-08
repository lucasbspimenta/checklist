<div class="p-6 modal {{ $tamanho }}" {{ $attributes }}>
    <div class="flex justify-between items-center pb-3">
        <p class="text-caixaAzul font-futurabold text-lg">{{ $titulo }}</p>
        <div class="cursor-pointer z-50" onClick="$.modal.close();">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
        </div>
    </div>
    {{ $slot }}
</div>
