@php
$pdfData = session('pdfData');
@endphp


<div class="bg-white shadow-md rounded-lg p-6" style="margin-top: 15px;" id="pdfDataForm">
    <!-- Customer Info Section -->
    <div class="mb-6">
        <h2 class="text-lg font-medium mb-2">Customer Information</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="customer_info[name]" value="{{ $pdfData['customer_info']['name'] }}"
                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" id="phone" name="customer_info[phone]"
                    value="{{ $pdfData['customer_info']['phone'] }}"
                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="customer_info[email]"
                    value="{{ $pdfData['customer_info']['email'] }}"
                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label for="billing_address" class="block text-sm font-medium text-gray-700">Billing Address</label>
                <input type="text" id="billing_address" name="customer_info[billing_address]"
                    value="{{ $pdfData['customer_info']['billing_address'] }}"
                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label for="shipping_address" class="block text-sm font-medium text-gray-700">Shipping Address</label>
                <input type="text" id="shipping_address" name="customer_info[shipping_address]"
                    value="{{ $pdfData['customer_info']['shipping_address'] }}"
                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
    </div>

    <!-- Item Details Section -->
    <div class="mb-6">
        <h2 class="text-lg font-medium mb-2">Item Details</h2>
        <div class="grid grid-cols-2 gap-4">
            @foreach ($pdfData['item_details'] as $index => $item)
            <div>
                <label for="item_name_{{ $index }}" class="block text-sm font-medium text-gray-700">Item Name</label>
                <input type="text" id="item_name_{{ $index }}" name="item_details[{{ $index }}][name]"
                    value="{{ $item['name'] }}"
                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <labelfor="unit_price_{{ $index }}" class="block text-sm font-medium text-gray-700">Unit Price</label>
                    <input type="number" id="unit_price_{{ $index }}" name="item_details[{{ $index }}][unit_price]"
                        value="{{ $item['unit_price'] }}"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <!-- Add more item fields as needed -->
            @endforeach
        </div>
    </div>

    <!-- Total Amount Section -->
    <div class="mb-6">
        <label for="total_amount" class="block text-sm font-medium text-gray-700">Total Amount</label>
        <input type="number" id="total_amount" name="total_amount" value="{{ $pdfData['total_amount'] }}"
            class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
    </div>

    <!-- Note Section -->
    <div class="mb-6">
        <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
        <textarea id="note" name="note" rows="4"
            class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $pdfData['note'] }}</textarea>
    </div>

    <!-- Invoice Info Section -->
    <div class="mb-6">
        <h2 class="text-lg font-medium mb-2">Invoice Information</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="invoice_date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="text" id="invoice_date" name="invoice_info[date]"
                    value="{{ $pdfData['invoice_info']['date'] }}"
                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label for="invoice_number" class="block text-sm font-medium text-gray-700">Number</label>
                <input type="number" id="invoice_number" name="invoice_info[number]"
                    value="{{ $pdfData['invoice_info']['number'] }}"
                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">Submit</button>
</div>