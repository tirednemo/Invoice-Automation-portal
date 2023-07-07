<div class="bg-white shadow-md rounded-lg p-6" style="margin-top: 15px;">
    <h1 class="text-2xl text-center font-bold mb-3">Invoice Details</h1>
    <form class="bg-slate-200 p-5 rounded-lg shadow-md relative">
        @csrf

        <div class="mb-6">
            <h2 class="text-lg font-medium mb-2">Invoice Information</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="invoice_date" class="block text-gray-700 text-sm font-bold mb-2">Invoice Date</label>
                    <input readonly id="invoice_date" type="date" name="invoice_date" value="{{ date('Y-m-d', strtotime($invoice->invoice_date)) }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="invoice_number" class="block text-gray-700 text-sm font-bold mb-2">Invoice
                        Number</label>
                    <input readonly id="invoice_number" type="text" name="invoice_number" value="{{ $invoice->invoice_no }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
        </div>


        <div class="mb-6">
            <h2 class="text-lg font-medium mb-2">Customer Information</h2>

            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label for="customer_name" class="block text-gray-700 text-sm font-bold mb-2">Customer Name</label>
                    <input readonly id="customer_name" type="text" name="customer_name" value="{{ $invoice->customer_name }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                    <input readonly id="phone" type="text" maxlength="11" name="phone" value="{{ $invoice->phone }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input readonly id="email" type="email" name="email" value="{{ $invoice->email }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="billing_address" class="block text-gray-700 text-sm font-bold mb-2">Billing
                        Address</label>
                    <textarea readonly id="billing_address" type="text" name="billing_address" value="{{ $invoice->billing_address }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $invoice->billing_address }}</textarea>
                </div>

                <div>
                    <label for="shipping_address" class="block text-gray-700 text-sm font-bold mb-2">Shipping
                        Address</label>
                    <textarea readonly id="shipping_address" type="text" name="shipping_address" value="{{ $invoice->shipping_address }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $invoice->shipping_address }}</textarea>
                </div>
            </div>

        </div>



      



        <div class="mb-4">
            <label for="total_amount" class="block text-gray-700 text-sm font-bold mb-2">Total Amount</label>
            <input readonly id="total_amount" type="number" name="total_amount" value="{{ $invoice->total }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <label for="note" class="block text-gray-700 text-sm font-bold mb-2">Note</label>
            <textarea readonly id="note" name="note" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $invoice->note }}</textarea>
        </div>

    </form>
</div>

<script>
</script>