<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Documents') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth">
            <div>
                <h3 class="leading-6 text-2xl mb-2">
                    List of uploaded documents
                </h3>
            </div>


        </div>

    </div>
    @push("footer_styles")
        <script type="text/javascript">
            document.addEventListener('keypress', function (e) {
                if (e.keyCode === 13 || e.which === 13) {
                    e.preventDefault();
                    return false;
                }
            });
        </script>
    @endpush
</x-app-layout>
