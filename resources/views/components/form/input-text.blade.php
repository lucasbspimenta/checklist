<label class="block">
    <span class="text-gray-700">{{ $label }}</span>
    <input
        {{ $attributes }}
        type="text"
        class="text-sm py-1 mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-caixaAzul"
        autocomplete="off"
        >
        {{ $slot }}
</label>
