<button {{ $attributes->merge(['type' => 'submit', 'class' => 'justify-center py-3 px-6 bg-primary border border-transparent rounded-lg font-semibold text-white uppercase tracking-widest hover:bg-primary/90 focus:bg-primary/90 text-xs transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
