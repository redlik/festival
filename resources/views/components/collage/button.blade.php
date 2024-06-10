<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-olive-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-olive-700 active:bg-olive-900 focus:outline-none focus:border-olive-900 focus:ring ring-olive-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
