<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-center p-4 bg-primary border border-transparent rounded-lg font-semibold text-white uppercase tracking-widest hover:bg-gray-900 focus:bg-gray-900 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
