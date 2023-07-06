@php
$pdfData = session('pdfData');
@endphp

<div class="bg-white shadow-md rounded-lg p-6" style="margin-top: 15px;" id="pdfDataForm">
    <h1 class="text-2xl text-center font-bold mb-3">Invoice Details</h1>
    <form method="POST" action="{{ route('invoices.store') }}" onsubmit="return validateForm()">
        <!-- <form method="POST" action="{{ route('invoices.store') }}" class="bg-slate-200 p-5 rounded-lg shadow-md relative" onsubmit="return validateForm()"> -->
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
                <div class="col-span-2">
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
                            <label class="block text-gray-700 text-sm font-bold mb-1">Item Name</label>
                            <input type="text" name="item_details[][name]" value="{{ $item['name'] }}"
                                class="mb-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-1">Unit Price</label>
                            <input type="number" name="item_details[][unit_price]" value="{{ $item['unit_price'] }}"
                                class=" mb-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-1">Quantity</label>
                            <input type="number" name="item_details[][quantity]" value="{{ $item['quantity'] }}"
                                class=" mb-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-1">Amount</label>
                            <input type="number" name="item_details[][amount]" value="{{ $item['amount'] }}"
                                class=" mb-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-6" id="add-remove-buttons">
                    <div class="grid grid-cols-2 gap-2">
                        <x-primary-button type="button" id="add-item-details-btn" class="mt-1 block w-full text-center text-sm border-gray-300 rounded-md
               flex items-center justify-center hover:text-blue-500">
                            Add Another Item
                        </x-primary-button>
                        <x-primary-button type="button" id="add-item-details-btn" class="mt-1 block w-full text-center text-sm border-gray-300 rounded-md
               flex items-center justify-center hover:text-blue-500">
                            Remove An Item
                        </x-primary-button>
                    </div>

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
    const addRemoveButtons = document.getElementById('add-remove-buttons')

    addItemDetailsBtn.addEventListener('click', function() {
        const itemDetailsRow = document.createElement('div');
        itemDetailsRow.className = 'grid grid-cols-4 gap-3 item-details-row';

        const fieldNames = ['Item Name', 'Unit Price', 'Quantity', 'Amount'];
        const inputFields = ['name', 'unit_price', 'quantity', 'amount'];

        for (let i = 0; i < fieldNames.length; i++) {
            const inputDiv = document.createElement('div');

            const label = document.createElement('label');
            label.className = 'block text-gray-700 text-sm font-bold mb-1';
            label.textContent = fieldNames[i];

            const input = document.createElement('input');
            input.type = i === 0 ? 'text' : 'number';
            input.name = `item_details[][${inputFields[i]}]`;
            input.className =
                'mb-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md';

            inputDiv.appendChild(label);
            inputDiv.appendChild(input);
            itemDetailsRow.appendChild(inputDiv);
        }

        itemDetailsContainer.appendChild(itemDetailsRow);

        const rowElements = document.querySelectorAll(".item-details-row");
        itemDetailsContainer.append(addRemoveButtons);
    });
});

function validateForm() {
    var totalAmount = parseFloat(document.getElementById('total_amount').value);
    var itemAmounts = document.getElementsByName("item_details[][amount]");
    var itemTotal = 0;

    for (let i = 0; i < itemAmounts.length; i++) {

        itemTotal += parseFloat(itemAmounts[i].value);
    }

    if (totalAmount !== itemTotal) {
        Toastify({
            text: "Total amount does not match the sum of item amounts.",
            duration: 3000,
            close: true,
            gravity: 'bottom',
            position: 'right',
            style: {
                background: 'red'
            },
            stopOnFocus: true
        }).showToast();
        return false;
    }

    return true;
}
</script>