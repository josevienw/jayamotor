@extends('./layouts/app')
@extends('./layouts/sidebar')

@section('title')
Jaya Motor | Form Pembelian
@endsection

@section('contentsidebar')

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Format all elements with the class 'currency'
    const currencyElements = document.querySelectorAll('.currency');
    
    currencyElements.forEach(function (element) {
    const value = parseFloat(element.textContent);
    if (!isNaN(value)) {
    element.textContent = formatCurrency(value);
    }
    });
    
    function formatCurrency(amount) {
    return 'Rp. ' + amount.toLocaleString('id-ID');
    }
    });

    document.addEventListener('DOMContentLoaded', function () {
    event.preventDefault();
    const deleteButtons = document.querySelectorAll('.tempdelete');
    
    deleteButtons.forEach(button => {
    button.addEventListener('click', function () {
    // Get the kode_pembdetil from data attribute
    const kodePembelian = this.getAttribute('data-kode_pembelian');
    
    // Update the delete form action URL with the correct kode_pembdetil
    const deleteForm = document.getElementById('delete-form');
    deleteForm.action = deleteForm.action.replace('PLACEHOLDER', kodePembelian);
    
    // Show the modal
    const modal = document.getElementById('temp-popup-modal');
    modal.classList.remove('hidden');
    });
    });
    });

    document.addEventListener('DOMContentLoaded', function () {
    event.preventDefault();
    const deleteButtons = document.querySelectorAll('.delete');
    
    deleteButtons.forEach(button => {
    button.addEventListener('click', function () {
    // Get the kode_pembdetil from data attribute
    const kodePembelian1 = this.getAttribute('data-kode_pembelian-1');
    
    // Update the delete form action URL with the correct kode_pembdetil
    const deleteForm = document.getElementById('delete-form-1');
    deleteForm.action = deleteForm.action.replace('PLACEHOLDER', kodePembelian1);
    
    // Show the modal
    const modal = document.getElementById('popup-modal');
    modal.classList.remove('hidden');
    });
    });
    });
</script>

<div class="flex flex-row justify-between text-left align-middle mt-5">
    <h1 class="text-3xl font-bold xl:mb-0 mb-5">Pembelian</h1>

    <a href="{{ route('formpembelian', ['kode_pembelian' => $newPembelianCode]) }}">
        <button
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-5"
            type="button">
            Tambah Pembelian
        </button>
    </a>
</div>

<hr class="mb-5">

<div class="xl:grid xl:grid-cols-4 xl:gap-4 mb-5">
    <div class="w-full col-span-2 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 xl:mb-0 mb-5">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900">Draft Pembelian</h5>
            {{-- <a href="#" class="text-sm font-medium text-blue-600 hover:underline">
                View all
            </a> --}}
        </div>
        <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200">
                @foreach ($TempPembelian as $itemTempPembelian)
                <li class="py-3 sm:py-4">
                    <div class="flex items-center">
                        <div class="flex-1 min-w-0">
                            <p class="text-lg font-medium text-gray-900 truncate">
                                Kode Pembelian: {{ $itemTempPembelian -> kode_pembelian }}
                            </p>
                            <p class="text-sm text-gray-900 truncate">
                                Total Pembelian: <label class="currency">{{ $itemTempPembelian -> total_pembelian_st
                                    }}</label>
                            </p>
                            <p class="text-sm text-gray-400 truncate">
                                Status Pembelian: {{ $itemTempPembelian->status_pembelian == 1 ? 'LUNAS' : 'TIDAK LUNAS'
                                }}
                            </p>
                            <p class="text-sm text-gray-400 truncate">
                                Supplier: {{ $itemTempPembelian -> kode_supplier }}
                            </p>
                        </div>
                        <div class="flex xl:flex-row flex-col items-center text-base font-semibold text-gray-900">
                            <a class="edit text-green-700 hover:text-white border border-green-700 hover:bg-green-800
                        focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-1.5
                        text-center xl:mb-0 mb-2 xl:mr-2 mr-0"
                                href="{{ route('formpembelian', ['kode_pembelian' => $itemTempPembelian -> kode_pembelian]) }}">Edit</a>
                            <a class="tempdelete text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-1.5 text-center"
                                type="button" data-modal-target="temp-popup-modal" data-modal-toggle="temp-popup-modal"
                                data-kode_pembelian="{{ $itemTempPembelian -> kode_pembelian }}">Delete</a>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>


    <div class="w-full col-span-2 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900">Pembelian</h5>
            {{-- <a href="#" class="text-sm font-medium text-blue-600 hover:underline">
                View all
            </a> --}}
        </div>
        <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200">
                @foreach ($Pembelian as $itemPembelian)
                <li class="py-3 sm:py-4">
                    <div class="flex items-center">
                        <div class="flex-1 min-w-0">
                            <p class="text-lg font-medium text-gray-900 truncate">
                                Kode Pembelian: {{ $itemPembelian -> kode_pembelian }}
                            </p>
                            <p class="text-sm text-gray-900 truncate">
                                Total Pembelian: <label class="currency">{{ $itemPembelian -> total_pembelian_st
                                    }}</label>
                            </p>
                            <p class="text-sm text-gray-400 truncate">
                                Status Pembelian: {{ $itemPembelian->status_pembelian == 1 ? 'LUNAS' : 'TIDAK LUNAS'
                                }}
                            </p>
                            <p class="text-sm text-gray-400 truncate">
                                Supplier: {{ $itemPembelian -> kode_supplier }}
                            </p>
                        </div>
                        <div class="flex xl:flex-row flex-col items-center text-base font-semibold text-gray-900">
                            <a class="edit text-green-700 hover:text-white border border-green-700 hover:bg-green-800
                        focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-1.5
                        text-center xl:mb-0 mb-2 xl:mr-2 mr-0"
                                href="{{ route('editformpembelian', ['kode_pembelian' => $itemPembelian -> kode_pembelian]) }}">Edit</a>
                            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                data-kode_pembelian-1="{{ $itemPembelian -> kode_pembelian }}"
                                class="delete text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-1.5 text-center">Delete</button>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>


    <div id="temp-popup-modal" name="temp-popup-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="temp-popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah kamu yakin untuk menghapus data ini?</h3>
                    <form id="delete-form"
                        action="{{ route('temppembeliandelete', ['kode_pembelian' => 'PLACEHOLDER']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Hapus
                        </button>
                        <button data-modal-hide="temp-popup-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                            Tidak
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="popup-modal" name="popup-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah kamu yakin untuk menghapus data ini?</h3>
                    <form id="delete-form-1"
                        action="{{ route('pembeliandelete', ['kode_pembelian' => 'PLACEHOLDER']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Hapus
                        </button>
                        <button data-modal-hide="popup-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                            Tidak
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection