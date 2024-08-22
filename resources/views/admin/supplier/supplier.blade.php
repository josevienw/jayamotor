@extends('./layouts/app')
@extends('./layouts/sidebar')

@section('title')
Jaya Motor | Supplier
@endsection

@section('contentsidebar')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit');
        
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
            // Get the data from the button's data- attributes
            const kodeSupplier = this.getAttribute('data-kode_supplier');
            const namaSupplier = this.getAttribute('data-nama_supplier');
            const alamatSupplier = this.getAttribute('data-alamat_supplier');
            const kontakSupplier = this.getAttribute('data-kontak_supplier');
            
            // Populate the modal fields
            document.getElementById('edit_kode_supplier').value = kodeSupplier;
            document.getElementById('edit_nama_supplier').value = namaSupplier;
            document.getElementById('edit_alamat_supplier').value = alamatSupplier;
            document.getElementById('edit_kontak_supplier').value = kontakSupplier;
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
            // Get the kode_supplier from data attribute
            const kodeSupplier = this.getAttribute('data-kode_supplier');
            
            // Update the delete form action URL with the correct kode_supplier
            const deleteForm = document.getElementById('delete-form');
            deleteForm.action = deleteForm.action.replace('PLACEHOLDER', kodeSupplier);
            
            // Show the modal
            const modal = document.getElementById('popup-modal');
            modal.classList.remove('hidden');
            });
        });
    });
</script>

<div class="flex flex-col xl:flex-row xl:justify-between xl:text-left text-center align-middle my-5">
    <h1 class="text-3xl font-bold xl:mb-0 mb-5">Data Supplier</h1>
    <!-- Modal toggle -->
    <button data-modal-target="AddSupplierModal" data-modal-toggle="AddSupplierModal"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-5"
        type="button">
        Tambah Supplier
    </button>
</div>

<!-- Main modal -->
<div id="AddSupplierModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Input Data Supplier
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="AddSupplierModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="AddDataSupplier" action="{{ route('supplierinsert') }}" method="POST" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="kode_supplier" class="block mb-2 text-sm font-medium text-gray-900">ID Supplier
                            <label class="text-red-800">*</label></label>
                        <input type="text" name="kode_supplier" id="kode_supplier"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" SUP001" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="nama_supplier" class="block mb-2 text-sm font-medium text-gray-900">Nama Supplier
                            <label class="text-red-800">*</label></label>
                        <input type="text" name="nama_supplier" id="nama_supplier"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" Jaya Motor" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="alamat_supplier" class="block mb-2 text-sm font-medium text-gray-900">Alamat
                            Supplier</label>
                        <textarea name="alamat_supplier" id="alamat_supplier" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder=" Jalan. Ismail Marzuki" maxlength="255"></textarea>
                    </div>
                    <div class="col-span-2">
                        <label for="kontak_supplier" class="block mb-2 text-sm font-medium text-gray-900">Kontak
                            Supplier</label>
                        <input type="text" name="kontak_supplier" id="kontak_supplier"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" 081234567890">
                    </div>
                </div>
                <button type="submit"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Tambah
                </button>
            </form>
        </div>
    </div>
</div>


<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama
                </th>
                <th scope="col" class="px-6 py-3">
                    Alamat
                </th>
                <th scope="col" class="px-6 py-3">
                    Kontak
                </th>
                <th scope="col" class="px-6 py-3">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datasupplier as $itemsupplier)
            <tr class="bg-white border-b">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $itemsupplier->kode_supplier }}
                </th>
                <td class="px-6 py-4">
                    {{ $itemsupplier->nama_supplier }}
                </td>
                <td class="px-6 py-4">
                    {{ $itemsupplier->alamat_supplier }}
                </td>
                <td class="px-6 py-4">
                    {{ $itemsupplier->kontak_supplier }}
                </td>
                <td class="px-6 py-4">
                    <!-- Modal toggle -->
                    <button data-modal-target="EditSupplierModal" data-modal-toggle="EditSupplierModal"
                        data-kode_supplier="{{ $itemsupplier->kode_supplier }}"
                        data-nama_supplier="{{ $itemsupplier->nama_supplier }}"
                        data-alamat_supplier="{{ $itemsupplier->alamat_supplier }}"
                        data-kontak_supplier="{{ $itemsupplier->kontak_supplier }}"
                        class="edit text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-1.5 text-center xl:mb-0 mb-2"
                        type="button">
                        UBAH
                    </button>

                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                        data-kode_supplier="{{ $itemsupplier->kode_supplier }}"
                        class="delete text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-1.5 text-center"
                        type="button">
                        HAPUS
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Main modal -->
<div id="EditSupplierModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Edit Data Supplier
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="EditSupplierModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="EditDataSupplier" action="{{ route('supplierupdate') }}" method="POST" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="edit_kode_supplier" class="block mb-2 text-sm font-medium text-gray-900">ID Supplier
                            <label class="text-red-800">*</label></label>
                        <input type="text" name="edit_kode_supplier" id="edit_kode_supplier"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" SUP001" required="" readonly>
                    </div>
                    <div class="col-span-2">
                        <label for="edit_nama_supplier" class="block mb-2 text-sm font-medium text-gray-900">Nama
                            Supplier
                            <label class="text-red-800">*</label></label>
                        <input type="text" name="edit_nama_supplier" id="edit_nama_supplier"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" johndoe" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="edit_alamat_supplier" class="block mb-2 text-sm font-medium text-gray-900">Alamat
                            Supplier</label>
                        <textarea name="edit_alamat_supplier" id="edit_alamat_supplier" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder=" Jalan. Ismail Marzuki" maxlength="255"></textarea>
                    </div>
                    <div class="col-span-2">
                        <label for="edit_kontak_supplier" class="block mb-2 text-sm font-medium text-gray-900">Kontak
                            Supplier</label>
                        <input type="text" name="edit_kontak_supplier" id="edit_kontak_supplier"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" 081234567890">
                    </div>
                </div>
                <button type="submit"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>


<div id="popup-modal" tabindex="-1"
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
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah kamu yakin untuk menghapus data ini?</h3>
                <form id="delete-form" action="{{ route('supplierdelete', ['kode_supplier' => 'PLACEHOLDER']) }}"
                    method="POST">
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

@endsection