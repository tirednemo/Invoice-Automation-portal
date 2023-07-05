<x-app-layout>
    <div class="max-w-5xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('invoices.store') }}">
            @csrf
            <!-- <textarea name="message" placeholder="{{ __('What\'s on your mind?') }}" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" /> -->

            
            <div class="mb-4">
                <label for="item_name" class="block text-gray-700 text-sm font-bold mb-2">Item Name</label>
                <input id="item_name" type="text" name="item_name" class="form-input rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                <input id="quantity" type="text" name="quantity" class="form-input rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="unit_price" class="block text-gray-700 text-sm font-bold mb-2">Unit Price</label>
                <input id="unit_price" type="text" name="unit_price" class="form-input rounded-md shadow-sm">
            </div>


            <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>