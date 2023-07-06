@php
$pdfData = session('pdfData');
@endphp
<!-- <div class="max-w-3xl mx-auto mt-10 p-4 sm:p-6 lg:p-8"> -->
<div class="bg-white shadow-md rounded-lg p-6" style="margin-top: 15px;" id="pdfDataForm">
    <h1 class="text-2xl text-center font-bold mb-3">Invoice Details</h1>
    <form method="POST">

        @csrf

        <div class="mb-6">
            <h2 class="text-lg font-medium mb-2">Invoice Information</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="invoice_date" class="block text-gray-700 text-sm font-bold mb-2">Invoice Date</label>
                    <input id="invoice_date" type="date" name="invoice_date"
                        value="{{ date('Y-m-d', strtotime($pdfData['invoice_info']['date'])) }}"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="invoice_number" class="block text-gray-700 text-sm font-bold mb-2">Invoice
                        Number</label>
                    <input id="invoice_number" type="text" name="invoice_number"
                        value="{{ $pdfData['invoice_info']['number'] }}"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
        </div>


        <div class="mb-6">
            <h2 class="text-lg font-medium mb-2">Customer Information</h2>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="customer_name" class="block text-gray-700 text-sm font-bold mb-2">Customer Name</label>
                    <input id="customer_name" type="text" name="customer_name"
                        value="{{ $pdfData['customer_info']['name'] }}"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                    <input id="phone" type="text" maxlength="11" name="phone"
                        value="{{ $pdfData['customer_info']['phone'] }}"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input id="email" type="email" name="email" value="{{ $pdfData['customer_info']['email'] }}"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="billing_address" class="block text-gray-700 text-sm font-bold mb-2">Billing
                        Address</label>
                    <textarea id="billing_address" type="text" name="billing_address"
                        value="{{ $pdfData['customer_info']['billing_address'] }}"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $pdfData['customer_info']['billing_address'] }}</textarea>
                </div>

                <div>
                    <label for="shipping_address" class="block text-gray-700 text-sm font-bold mb-2">Shipping
                        Address</label>
                    <textarea id="shipping_address" type="text" name="shipping_address"
                        value="{{ $pdfData['customer_info']['shipping_address'] }}"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $pdfData['customer_info']['shipping_address'] }}</textarea>
                </div>
            </div>

        </div>



        <div class="mb-6">
            <div class="mb-8 mt-4">
                <h2 class="text-lg font-bold mb-2">Item Details</h2>
                <div id="item-details-container">
                    @foreach($pdfData['item_details'] as $index => $item)
                    <div class="grid grid-cols-4 gap-3 item-details-row">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Item Name</label>
                            <input type="text" name="item_details[{{ $index }}][name]" value="{{ $item['name'] }}"
                                class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Unit Price</label>
                            <input type="number" name="item_details[{{ $index }}][unit_price]"
                                value="{{ $item['unit_price'] }}"
                                class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                            <input type="number" name="item_details[{{ $index }}][quantity]"
                                value="{{ $item['quantity'] }}"
                                class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Amount</label>
                            <input type="number" name="item_details[{{ $index }}][amount]" value="{{ $item['amount'] }}"
                                class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    <x-primary-button type="button" id="add-item-details-btn" class="mt-1 block w-full text-center text-sm border-gray-300 rounded-md
               flex items-center justify-center hover:text-blue-500">
                        Add Another Item
                    </x-primary-button>
                </div>

            </div>
        </div>





        <div class="mb-4">
            <label for="total_amount" class="block text-gray-700 text-sm font-bold mb-2">Total Amount</label>
            <input id="total_amount" type="number" name="total_amount" value="{{ $pdfData['total_amount'] }}"
                class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <label for="note" class="block text-gray-700 text-sm font-bold mb-2">Note</label>
            <textarea id="note" name="note"
                class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $pdfData['note'] }}</textarea>
        </div>

        <div class="flow-root">
            <x-primary-button type="submit" id="save-invoice-btn" class="px-6 float-right">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const addItemDetailsBtn = document.getElementById('add-item-details-btn');
    const itemDetailsContainer = document.getElementById('item-details-container');

    addItemDetailsBtn.addEventListener('click', function() {
        const itemDetailsRow = document.createElement('div');
        itemDetailsRow.className = 'grid grid-cols-4 gap-3 item-details-row';

        const inputFields = ['Item Name', 'Unit Price', 'Quantity', 'Amount'];
        const fieldNames = ['name', 'unit_price', 'quantity', 'amount'];

        for (let i = 0; i < inputFields.length; i++) {
            const inputDiv = document.createElement('div');

            const label = document.createElement('label');
            label.className = 'block text-gray-700 text-sm font-bold mb-2';
            label.textContent = inputFields[i];

            const input = document.createElement('input');
            input.type = i === 0 ? 'text' : 'number';
            input.name = `item_details[][${fieldNames[i]}]`;
            input.className =
                'mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md';

            inputDiv.appendChild(label);
            inputDiv.appendChild(input);
            itemDetailsRow.appendChild(inputDiv);
        }

        itemDetailsContainer.appendChild(itemDetailsRow);

        const rowElements = document.querySelectorAll(".item-details-row");
        rowElements[rowElements.length - 1].appendChild(addItemDetailsBtn);
    });
});

</script>