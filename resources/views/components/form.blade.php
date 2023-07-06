<div class="max-w-3xl mx-auto mt-10 p-4 sm:p-6 lg:p-8">
    <h1 class="text-2xl text-center font-bold mb-3">Invoice Details</h1>
    <form method="POST" action="{{ route('invoices.store') }}" class="bg-slate-200 p-5 rounded-lg shadow-md relative">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label for="invoice_date" class="block text-gray-700 text-sm font-bold mb-2">Invoice Date</label>
                <input id="invoice_date" type="datetime-local" name="invoice_date" class="form-input rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="invoice_number" class="block text-gray-700 text-sm font-bold mb-2">Invoice Number</label>
                <input id="invoice_number" type="text" name="invoice_number" class="form-input rounded-md shadow-sm">
            </div>
        </div>

        <div class="mb-4">
            <label for="customer_name" class="block text-gray-700 text-sm font-bold mb-2">Customer Name</label>
            <input id="customer_name" type="text" name="customer_name" class="form-input rounded-md shadow-sm w-64">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                <input id="phone" type="text" maxlength="11" name="phone" class="form-input rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input id="email" type="email" name="email" class="form-input rounded-md shadow-sm w-64">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label for="billing_address" class="block text-gray-700 text-sm font-bold mb-2">Billing Address</label>
                <textarea id="billing_address" type="text" name="billing_address" class="form-input rounded-md shadow-sm w-64"></textarea>
            </div>

            <div class="mb-4">
                <label for="shipping_address" class="block text-gray-700 text-sm font-bold mb-2">Shipping Address</label>
                <textarea id="shipping_address" type="text" name="shipping_address" class="form-input rounded-md shadow-sm w-64"></textarea>
            </div>
        </div>

        <div class="mb-8 mt-4">
            <h2 class="text-lg font-bold mb-2">Item Details</h2>
            <div id="item-details-container">
                <div class="grid grid-cols-5 gap-3 item-details-row">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Item Name</label>
                        <input type="text" name="item_name[]" class="form-input rounded-md shadow-sm w-32">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Unit Price</label>
                        <input type="number" name="unit_price[]" class="form-input rounded-md shadow-sm w-32">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                        <input type="number" name="quantity[]" class="form-input rounded-md shadow-sm w-32">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Amount</label>
                        <input type="number" name="amount[]" class="form-input rounded-md shadow-sm w-32">
                    </div>
                    <div class="mt-6">
                        <x-primary-button id="add-item-details-btn" class="mt-2 px-7">+</x-primary-buttonn>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label for="total_amount" class="block text-gray-700 text-sm font-bold mb-2">Total Amount</label>
            <input id="total_amount" type="number" name="total_amount" class="form-input rounded-md shadow-sm">
        </div>

        <div class="mb-4">
            <label for="note" class="block text-gray-700 text-sm font-bold mb-2">Note</label>
            <textarea id="note" name="note" class="form-textarea rounded-md shadow-sm w-64"></textarea>
        </div>

        <div class="flow-root">
            <x-primary-button class="px-6 float-right">
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
            itemDetailsRow.className = 'grid grid-cols-5 gap-3 item-details-row';

            const inputFields = ['item_name', 'unit_price', 'quantity', 'amount'];

            inputFields.forEach(function(fieldName) {

                const input = document.createElement('input');
                input.type = 'text';
                input.name = fieldName + '[]';
                input.className = 'mt-1 form-input rounded-md shadow-sm w-32';

                itemDetailsRow.appendChild(input);
            });

            itemDetailsContainer.appendChild(itemDetailsRow);

            const rowElements = document.querySelectorAll(".item-details-row");
            rowElements[rowElements.length - 1].appendChild(addItemDetailsBtn);
        });
    });
</script>