@php
$pdfData = session('pdfData');
$size = count($pdfData['item_details']);
@endphp

<div class="bg-white shadow-md rounded-lg p-6" style="margin-top: 15px;" id="pdfDataForm">
    <h1 class="text-2xl text-center font-bold mb-3">Invoice Details</h1>
    <form method="POST" action="{{ route('invoices.store') }}" onsubmit="return validateForm()">
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

                <div class="col-span-2">
                    <label for="merchant_name" class="block text-gray-700 text-sm font-bold mb-2">Merchant Name</label>
                    <input id="merchant_name" type="text" name="merchant_name"
                        value="{{ $pdfData['customer_info']['name'] }}"
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
                    <div class="grid grid-cols-5 gap-3 item-details-row">
                        <div class="col-span-1">
                            <label class="block text-gray-700 text-sm font-bold mb-1">Item Name</label>
                            <input required type="text" name="item_details[{{$index}}][name]"
                                value="{{ $item['name'] }}"
                                class="mb-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-1">
                            <label class="block text-gray-700 text-sm font-bold mb-1">Unit Price</label>
                            <input required type="number" name="item_details[{{$index}}][unit_price]"
                                value="{{ $item['unit_price'] }}"
                                class=" mb-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-1">
                            <label class="block text-gray-700 text-sm font-bold mb-1">Quantity</label>
                            <input required type="number" name="item_details[{{$index}}][quantity]"
                                value="{{ $item['quantity'] }}"
                                class=" mb-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-1">
                            <label class="block text-gray-700 text-sm font-bold mb-1">Amount</label>
                            <input required type="number" name="item_details[{{$index}}][amount]"
                                value="{{ $item['amount'] }}"
                                class=" mb-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-1">
                            <x-primary-button style="background-color: red;" type="button" class="mt-6 block w-full text-center text-sm border-gray-300 rounded-md
               flex items-center justify-center hover:text-white-500 delete-button">
                                Delete
                            </x-primary-button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <x-primary-button type="button" id="add-item-details-btn" class="mt-1 block w-full text-center text-sm border-gray-300 rounded-md
               flex items-center justify-center hover:text-blue-500">
                    Add Another Item
                </x-primary-button>
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

        <div class="mb-4">
            <label for="status" class="inline-flex items-center">
                <input type="checkbox" id="status" name="status"
                    class="form-checkbox h-4 w-4 text-blue-500 focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded">
                <span class="ml-2 text-gray-700">Mark as completed</span>
            </label>
        </div>

        <div class="flex items-center mt-4">
            <div class="flex-grow"></div>

            <div class="flex-shrink-0  float-right">
                <x-primary-button type="submit" id="save-invoice-btn" class="px-6 my-3  float-right">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
            <div class="flex-shrink-0 ml-4  float-right">
                <x-primary-button type="button" id="cancel-invoice-btn" class="px-6 my-3  float-right">
                    Cancel
                </x-primary-button>
            </div>
        </div>

    </form>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const addItemDetailsBtn = document.getElementById('add-item-details-btn');
    const itemDetailsContainer = document.getElementById('item-details-container');
    const cancelBtn = document.getElementById('cancel-invoice-btn')

    var index = "<?php echo $size; ?>";

    addItemDetailsBtn.addEventListener('click', function() {
        index++;
        const itemDetailsRow = document.createElement('div');
        itemDetailsRow.className = 'grid grid-cols-5 gap-3 item-details-row';

        const fieldNames = ['Item Name', 'Unit Price', 'Quantity', 'Amount'];
        const inputFields = ['name', 'unit_price', 'quantity', 'amount'];

        for (let i = 0; i < fieldNames.length; i++) {
            const inputDiv = document.createElement('div');

            const label = document.createElement('label');
            label.className = 'block text-gray-700 text-sm font-bold mb-1';
            label.textContent = fieldNames[i];

            const input = document.createElement('input');
            input.required = true;
            input.type = i === 0 ? 'text' : 'number';
            input.name = `item_details[${index}][${inputFields[i]}]`;
            input.className =
                'mb-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md';

            inputDiv.appendChild(label);
            inputDiv.appendChild(input);
            itemDetailsRow.appendChild(inputDiv);
        }


        const deleteButtonDiv = document.createElement('div');
        deleteButtonDiv.className = 'col-span-1';

        const deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.className =
            'mt-6 block w-full text-center py-2 text-sm font-semibold text-xs text-white uppercase tracking-widest border-gray-300 rounded-md flex items-center justify-center hover:text-white-500 delete-button';
        deleteButton.style.backgroundColor = 'red';
        deleteButton.style.color = 'white';
        deleteButton.textContent = 'DELETE';

        deleteButton.addEventListener('click', function() {
            itemDetailsContainer.removeChild(itemDetailsRow);
        });

        deleteButtonDiv.appendChild(deleteButton);
        itemDetailsRow.appendChild(deleteButtonDiv);
        itemDetailsContainer.appendChild(itemDetailsRow);

        const rowElements = document.querySelectorAll(".item-details-row");
        itemDetailsContainer.append(addItemDetailsBtn);
    });

    function handleDeleteButtonClick(event) {
        var row = event.target.closest('.item-details-row');
        row.parentNode.removeChild(row);
    }

    var deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', handleDeleteButtonClick);
    });


    cancelBtn.addEventListener('click', function(response) {

        axios.delete('/delete-data-from-session', {
                data: response.data
            })
            .then(function(response) {
                console.log(response);
                location.reload();
            })
            .catch(function(error) {
                console.log(error);
            });
    })
});

function validateForm() {
    var totalAmountInput = parseFloat(document.getElementById('total_amount').value);
    var amountInputs = document.querySelectorAll('input[name^="item_details"][name$="[amount]"]');
    var totalAmount = 0;

    amountInputs.forEach(function(input) {
        var amount = parseFloat(input.value);
        if (!isNaN(amount)) {
            totalAmount += amount;
        }
    });

    if (totalAmount !== totalAmountInput) {
        Toastify({
            text: "Total amount does not match the sum of item amounts.",
            duration: 3000,
            close: true,
            gravity: 'bottom',
            position: 'right',
            style: {
                background: 'red',
                borderRadius: '10px'
            },
            stopOnFocus: true
        }).showToast();
        return false;
    }

    return true;
}
</script>