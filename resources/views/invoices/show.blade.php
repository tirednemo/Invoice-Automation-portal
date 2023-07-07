<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- <x-invoice.pdf-view /> --}}

            <x-invoice.form-view :invoice="$invoice"  />
        </div>
    </div>
</x-app-layout>