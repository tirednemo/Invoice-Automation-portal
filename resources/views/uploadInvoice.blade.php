<x-app-layout>
    <?php /* 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Invoice') }}
        </h2>
    </x-slot>
    */ ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl text-center font-bold mb-3">Upload Invoice PDF</h1>
            <x-file-upload />

            @if(!session('pdfData'))
            <div id="loading" class="hidden flex items-center justify-center" style="margin-top: 100px;">
                <svg class="animate-spin h-6 w-6 mr-3 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 0012 20c4.411 0 8-3.589 8-8h-2c0 3.309-2.691 6-6 6-3.309 0-6-2.691-6-6H6c0 4.411 3.589 8 8 8z">
                    </path>
                </svg>
                <span>Loading...</span>
            </div>
            <button id="getInvoiceBtn" class="py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded-lg mt-4" onclick="getDataByRegex()">Get Invoice Data</button>
            @endif


            <!-- this form is for testing purpose -->
            @if(session('pdfData'))
            <x-pdf-data-form-test />
            @endif

            <h1 class="text-2xl text-center font-bold mb-3">Choose Parsing Algorithm</h1>
            <div class="flex justify-center">
                <x-primary-button class="w-20  mx-5">
                    REGEX
                </x-primary-button>
                <x-primary-button class="w-20 px-6 mx-5">
                    OCR
                </x-primary-button>
                <x-primary-button class="w-20 px-8 mx-5">
                    DL
                </x-primary-button>
            </div>
            <x-form />
        </div>
    </div>


    <script>
        function getDataByRegex() {
            var loadingElement = document.getElementById('loading');
            var getInvoiceBtn = document.getElementById('getInvoiceBtn');
            loadingElement.classList.remove('hidden');
            getInvoiceBtn.style.display = 'none';

            axios.get('http://localhost:3000/api/regex')
                .then(function(response) {
                    console.log(response.data);

                    axios.post('/store-data-in-session', {
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
                .catch(function(error) {
                    console.log(error);
                });
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
                background: 'black'
            },
            stopOnFocus: true
        }).showToast();
    </script>
    @endif

    @if(session('error'))
    <script>
        Toastify({
            text: "{{ session('error') }}",
            duration: 3000,
            close: true,
            gravity: 'top',
            position: 'right',
            style: {
                background: 'red'
            },
            stopOnFocus: true
        }).showToast();
    </script>
    @endif

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

</x-app-layout>