<x-app-layout>
    <style>
    .animate-spin {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
    </style>


    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-invoice.file-upload />


            @if(session('pdfFileName'))
            <div id="buttonDiv" class="bg-white shadow-md rounded-lg p-6" style="margin-top: 15px;">
                <input type="text" id="pdfFileName" hidden value="{{ session('pdfFileName') }}">
                <h1 class="text-2xl text-center font-bold mb-3">Choose Parsing Algorithm</h1>
                <div class="flex">
                    <x-primary-button id="getInvoiceBtn" class="flex-grow mx-2 flex justify-center"
                        onclick="getData('regex')">
                        REGEX
                    </x-primary-button>
                    <x-primary-button id="getInvoiceBtn1" class="flex-grow mx-2 flex justify-center"
                        onclick="getData('ocr')">
                        OCR
                    </x-primary-button>
                    <x-primary-button id="getInvoiceBtn2" class="flex-grow mx-2 flex justify-center"
                        onclick="getData('dl')">
                        DL
                    </x-primary-button>
                </div>
            </div>
            @endif

            <div id="loading" class="flex items-center justify-center"
                style="margin-top: 100px; margin-bottom: 100px; display:none">
                <svg class="animate-spin h-6 w-6 mr-3 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 0012 20c4.411 0 8-3.589 8-8h-2c0 3.309-2.691 6-6 6-3.309 0-6-2.691-6-6H6c0 4.411 3.589 8 8 8z">
                    </path>
                </svg>
                <span>Loading...</span>
            </div>



            <div id="formDetailsDiv" style="display: none;">
                <x-invoice.form-edit />
            </div>

        </div>
    </div>


    <script>
    var loadingElement = document.getElementById('loading');
    var form = document.getElementById('formDetailsDiv');

    function getData(algo) {
        var buttonDiv = document.getElementById('buttonDiv')
        let pdfFileName = document.getElementById('pdfFileName').value
        console.log(algo);
        loadingElement.style.display = 'flex';
        form.style.display = 'none';
        let api = ''

        axios.get(`/get-${algo}-api-url`)
            .then(function(response) {
                console.log(response.data.api);
                api = response.data.api
                axios.get(api, {
                        params: {
                            pdfFileName: pdfFileName
                        }
                    })
                    .then(function(response) {
                        console.log(response.data);
                        populateForm(response.data)
                        loadingElement.style.display = 'none';
                        form.style.display = 'flex';
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            })
            .catch(function(error) {
                console.log(error);
            });
    }

    const populateForm = (data) => {
        let date = document.getElementById('invoice_date')
        let dateString = data.invoice_info.date
        var dateParts = dateString.split("/");
        date.value = new Date(dateParts[2], dateParts[0] - 1, dateParts[1]);

        console.log(typeof(date), date, date
            .value); // Output: Thu Jun 10 2021 00:00:00 GMT+0000 (Coordinated Universal Time)

        let invoiceNumber = document.getElementById('invoice_number')
        invoiceNumber.value = data.invoice_info.number

        let merchantName = document.getElementById('merchant_name')
        merchantName.value = data.customer_info.name

        let customerName = document.getElementById('customer_name')
        customerName.value = data.customer_info.name

        let phone = document.getElementById('phone')
        phone.value = data.customer_info.phone

        let email = document.getElementById('email')
        email.value = data.customer_info.email

        let billingAddress = document.getElementById('billing_address')
        billingAddress.value = data.customer_info.billing_address

        let shippingAddress = document.getElementById('shipping_address')
        shippingAddress.value = data.customer_info.shipping_address

        const fieldNames = ['Item Name', 'Unit Price', 'Quantity', 'Amount'];
        const inputFields = ['name', 'unit_price', 'quantity', 'amount'];

        const itemDetailsContainer = document.getElementById('item-details-container');
        const addItemDetailsBtn = document.getElementById('add-item-details-btn');

        for (let j = 0; j < data.item_details.length; j++) {

            const itemDetailsRow = document.createElement('div');
            itemDetailsRow.className = 'grid grid-cols-5 gap-3 item-details-row';
            for (let i = 0; i < fieldNames.length; i++) {
                const inputDiv = document.createElement('div');

                const label = document.createElement('label');
                label.className = 'block text-gray-700 text-sm font-bold mb-1';
                label.textContent = fieldNames[i];

                const input = document.createElement('input');
                input.required = true;
                console.log(inputFields[i]);
                input.value = data.item_details[j][inputFields[i]]
                input.type = i === 0 ? 'text' : 'number';
                input.name = `item_details[${i}][${inputFields[i]}]`;
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
        }
        const rowElements = document.querySelectorAll(".item-details-row");
        itemDetailsContainer.append(addItemDetailsBtn);

        let totalAmount = document.getElementById('total_amount')
        totalAmount.value = data.total_amount

        let note = document.getElementById('note')
        note.value = data.note
    }
    </script>


    @if(session('success'))
    <script>
    Toastify({
        text: "{{ session('success') }}",
        duration: 3000,
        close: true,
        gravity: 'top',
        position: 'right',
        style: {
            background: 'black',
            borderRadius: '10px'
        },
        stopOnFocus: true
    }).showToast();
    </script>
    @endif

    @if(session('errors'))
    <script>
    Toastify({
        text: "{{ session('errors')->first('invoice') }}",
        duration: 3000,
        close: true,
        gravity: 'top',
        position: 'right',
        style: {
            background: 'red',
            borderRadius: '10px'
        },
        stopOnFocus: true
    }).showToast();
    </script>
    @endif
</x-app-layout>