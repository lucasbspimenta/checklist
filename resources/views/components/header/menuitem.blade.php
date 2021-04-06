@if(!empty($slot->__toString()))
    <div @click.away="open = false" class="relative" x-data="{ open: false }">
        <button @click="open = !open" 
            class=" flex 
                    md:mx-2 my-1 md:my-0 md:h-full text-gray-700 items-center px-2 pt-1 border-l-2 md:border-l-0 md:border-b-4 
                    border-transparent font-futura text-base hover:text-caixaAzul hover:border-caixaAzul  
                    focus:border-caixaAzul focus:text-caixaAzul focus:outline-none
                    {{ (request()->segment(1) == Str::slug($nome)) ? 'border-caixaLaranja text-caixaLaranja' : '' }}
                    "
                >
            <span class="whitespace-nowrap"><i class="fas fa-{{ $icone }} mr-2"></i>{{ $nome }}</span>
            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
        <div x-show="open" x-transition:enter="transition ease-out duration-75" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute z-40 -right-2/3 w-full md:max-w-screen-sm md:w-screen mt-2 origin-top-right">
            <div class="px-2 pt-2 pb-4 bg-white border shadow-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                {{$slot}}
                </div>
            </div>
        </div>
    </div>
@else
    <a class="  flex 
                justify-content 
                items-center 
                px-2 pt-1 border-l-2 
                md:border-l-0 
                md:border-b-4 
                border-transparent 
                font-futura text-base text-gray-700 hover:text-caixaAzul hover:border-caixaAzul md:mx-2 my-1 md:my-0
                {{ request()->routeIs($nomerota) ? 'border-caixaLaranja text-caixaLaranja' : '' }}
        " href="{{ route($nomerota) }}">
        <i class="fas fa-{{ $icone }} mr-2"></i>
        {{ $nome }}
        @if($badge)
            <span class="bg-caixaLaranja p-1 rounded text-white text-xs ml-2">{{$badge}}</span>
        @endif
    </a>
@endif
