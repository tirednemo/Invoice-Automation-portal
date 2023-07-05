<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Invoice') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-file-upload />

            <button class="py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded-lg mt-4"
                onclick="getDataByRegex()">Get Invoice
                Data</button>
        </div>
    </div>


    <script>
    function getDataByRegex() {
        axios.get('/api/data')
            .then(function(response) {
                // Handle successful response
                console.log(response.data);
            })
            .catch(function(error) {
                // Handle error
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
            background: '#4BB543'
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

</x-app-layout>