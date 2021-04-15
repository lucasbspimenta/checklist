<div class="fixed z-100 w-full h-full bg-gray-500 opacity-75 top-0 left-0"></div>
<div class="fixed z-101 w-full h-full top-0 left-0 overflow-y-auto">
    <div class="table w-full h-full py-6">
        <div class="table-cell text-center align-middle">
            <div class="{{ empty($tamanho) ? 'w-full' : $tamanho }} max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-lg text-left overflow-hidden shadow-xl p-6">
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-caixaAzul font-futurabold text-lg">{{ $titulo }}</p>
                        <div class="cursor-pointer z-50">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>