@php
$pdfData = session('pdfData');
@endphp
<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6" style="margin-top: 15px;" id="pdfDataForm">
                <h1 class="text-2xl text-center font-bold mb-3">Invoice Details</h1>
                <form class="bg-slate-200 p-5 rounded-lg shadow-md relative">
                    @csrf

                    <div class="mb-6">
                        <h2 class="text-lg font-medium mb-2">Invoice Information</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="invoice_date" class="block text-gray-700 text-sm font-bold mb-2">Invoice Date</label>
                                <input readonly id="invoice_date" type="date" name="invoice_date" value="{{ date('Y-m-d', strtotime($pdfData['invoice_info']['date'])) }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div>
                                <label for="invoice_number" class="block text-gray-700 text-sm font-bold mb-2">Invoice
                                    Number</label>
                                <input readonly id="invoice_number" type="text" name="invoice_number" value="{{ $pdfData['invoice_info']['number'] }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>


                    <div class="mb-6">
                        <h2 class="text-lg font-medium mb-2">Customer Information</h2>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label for="customer_name" class="block text-gray-700 text-sm font-bold mb-2">Customer Name</label>
                                <input readonly id="customer_name" type="text" name="customer_name" value="{{ $pdfData['customer_info']['name'] }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div>
                                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                                <input readonly id="phone" type="text" maxlength="11" name="phone" value="{{ $pdfData['customer_info']['phone'] }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div>
                                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                                <input readonly id="email" type="email" name="email" value="{{ $pdfData['customer_info']['email'] }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div>
                                <label for="billing_address" class="block text-gray-700 text-sm font-bold mb-2">Billing
                                    Address</label>
                                <textarea readonly id="billing_address" type="text" name="billing_address" value="{{ $pdfData['customer_info']['billing_address'] }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $pdfData['customer_info']['billing_address'] }}</textarea>
                            </div>

                            <div>
                                <label for="shipping_address" class="block text-gray-700 text-sm font-bold mb-2">Shipping
                                    Address</label>
                                <textarea readonly id="shipping_address" type="text" name="shipping_address" value="{{ $pdfData['customer_info']['shipping_address'] }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $pdfData['customer_info']['shipping_address'] }}</textarea>
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
                                        <input readonly type="text" name="item_details[{{$index}}][name]" value="{{ $item['name'] }}" class="mb-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1">Unit Price</label>
                                        <input readonly type="number" name="item_details[{{$index}}][unit_price]" value="{{ $item['unit_price'] }}" class=" mb-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1">Quantity</label>
                                        <input readonly type="number" name="item_details[{{$index}}][quantity]" value="{{ $item['quantity'] }}" class=" mb-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-1">Amount</label>
                                        <input readonly type="number" name="item_details[{{$index}}][amount]" value="{{ $item['amount'] }}" class=" mb-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>



                    <div class="mb-4">
                        <label for="total_amount" class="block text-gray-700 text-sm font-bold mb-2">Total Amount</label>
                        <input readonly id="total_amount" type="number" name="total_amount" value="{{ $pdfData['total_amount'] }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label for="note" class="block text-gray-700 text-sm font-bold mb-2">Note</label>
                        <textarea readonly id="note" name="note" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $pdfData['note'] }}</textarea>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <script>
    </script>

</x-app-layout>