<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-vnn-red border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-vnn-red-dark focus:bg-vnn-red-dark active:bg-vnn-red-dark focus:outline-none focus:ring-2 focus:ring-vnn-red focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
