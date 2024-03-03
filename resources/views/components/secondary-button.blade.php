<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center py-3 px-6 bg-white border border-gray-200 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
