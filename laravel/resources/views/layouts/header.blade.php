<header class="bg-white bg-opacity-90 shadow fixed min-w-full max-w-screen-md z-10 mx-auto inset-x-0 top-0">
    <nav class="container mx-auto h-12 px-6">
        <div class="flex flex-col md:flex-row md:items-start h-full">
            <div class="flex items-center min-h-full md:h-full">
                <div class="flex flex-grow items-center mr-2">
                    <a  href="#"><img class="h-6" src="{{ asset('images/marca_vilop2.png') }}"/></a>
                </div>
                <div class="flex md:hidden">
                    <button @click="isOpen = !isOpen" type="button" class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600" aria-label="toggle menu">
                        <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">
                            <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="md:flex items-center flex-grow justify-between h-full" :class="isOpen ? 'block' : 'hidden'">
                @include('layouts.menu')
                <x-header.perfil/>
            </div>
        </div>
    </nav>
</header>