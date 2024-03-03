<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex justify-center items-center py-3 px-6 bg-white border border-gray-200 rounded-lg font-semibold text-xs uppercase tracking-widest hover:bg-gray-50 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
