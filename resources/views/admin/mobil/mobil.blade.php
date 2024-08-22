@extends('./layouts/app')
@extends('./layouts/sidebar')

@section('title')
Jaya Motor | Mobil
@endsection

@section('contentsidebar')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit');
        
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
            // Get the data from the button's data- attributes
            const kodeMobil = this.getAttribute('data-kode_mobil');
            const kbMobil = this.getAttribute('data-kb_mobil');
            const namaMobil = this.getAttribute('data-nama_mobil');
            const deskripsiMobil = this.getAttribute('data-deskripsi_mobil');
            const kodePerusahaan = this.getAttribute('data-kode_perusahaan');
            
            // Populate the modal fields
            document.getElementById('edit_kode_mobil').value = kodeMobil;
            document.getElementById('edit_kb_mobil').value = kbMobil;
            document.getElementById('edit_nama_mobil').value = namaMobil;
            document.getElementById('edit_deskripsi_mobil').value = deskripsiMobil;
            document.getElementById('edit_kode_perusahaan1').value = kodePerusahaan;
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
            // Get the kode_mobil from data attribute
            const kodeMobil = this.getAttribute('data-kode_mobil');
            
            // Update the delete form action URL with the correct kode_mobil
            const deleteForm = document.getElementById('delete-form');
            deleteForm.action = deleteForm.action.replace('PLACEHOLDER', kodeMobil);
            
            // Show the modal
            const modal = document.getElementById('popup-modal');
            modal.classList.remove('hidden');
            });
        });
    });
</script>

<div class="flex flex-col xl:flex-row xl:justify-between xl:text-left text-center align-middle my-5">
    <h1 class="text-3xl font-bold xl:mb-0 mb-5">Data Mobil</h1>
    <!-- Modal toggle -->
    <button data-modal-target="AddMobilModal" data-modal-toggle="AddMobilModal"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-5"
        type="button">
        Tambah Mobil
    </button>
</div>

<!-- Main modal -->
<div id="AddMobilModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Input Data Mobil
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="AddMobilModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="AddDataMobil" action="{{ route('mobilinsert') }}" method="POST" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="kode_mobil" class="block mb-2 text-sm font-medium text-gray-900">ID Mobil
                            <label class="text-red-800">*</label></label>
                        <input type="text" name="kode_mobil" id="kode_mobil"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" PRSH001" value="{{ $newMobilCode }}" required="" readonly>
                    </div>
                    <div class="col-span-2">
                        <label for="kb_mobil" class="block mb-2 text-sm font-medium text-gray-900">KB
                            Mobil
                        </label>
                        <input type="text" name="kb_mobil" id="kb_mobil"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" KB XXXX JW">
                    </div>
                    <div class="col-span-2">
                        <label for="nama_mobil" class="block mb-2 text-sm font-medium text-gray-900">Nama
                            Mobil
                        </label>
                        <input type="text" name="nama_mobil" id="nama_mobil"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" Toyota Fortuner">
                    </div>
                    <div class="col-span-2">
                        <label for="deskripsi_mobil" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi
                            Mobil</label>
                        <textarea name="deskripsi_mobil" id="deskripsi_mobil" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder=" Bosnya garang!" maxlength="255"></textarea>
                    </div>
                    <div class="col-span-2">
                        <label for="kode_perusahaan"
                            class="block mb-2 text-sm font-medium text-gray-900">Perusahaan</label>
                        <select name="kode_perusahaan" id="kode_perusahaan"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            <option value="" selected="">Pilih Perusahaan</option>
                            @foreach ($dataperusahaan as $itemperusahaan)
                            <option value="{{ $itemperusahaan->kode_perusahaan }}">{{ $itemperusahaan->nama_perusahaan
                                }}</option>
                            @endforeach
                        </select>
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
                    KB
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama
                </th>
                <th scope="col" class="px-6 py-3">
                    Deskripsi
                </th>
                <th scope="col" class="px-6 py-3">
                    Perusahaan
                </th>
                <th scope="col" class="px-6 py-3">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datamobil as $itemmobil)
            <tr class="bg-white border-b">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $itemmobil->kode_mobil }}
                </th>
                <td class="px-6 py-4">
                    {{ $itemmobil->kb_mobil }}
                </td>
                <td class="px-6 py-4">
                    {{ $itemmobil->nama_mobil }}
                </td>
                <td class="px-6 py-4">
                    {{ $itemmobil->deskripsi_mobil }}
                </td>
                <td class="px-6 py-4">
                    {{ $itemmobil->nama_perusahaan }}
                </td>
                <td class="px-6 py-4">
                    <!-- Modal toggle -->
                    <button data-modal-target="EditMobilModal" data-modal-toggle="EditMobilModal"
                        data-kode_mobil="{{ $itemmobil->kode_mobil }}" data-kb_mobil="{{ $itemmobil->kb_mobil }}"
                        data-nama_mobil="{{ $itemmobil->nama_mobil }}"
                        data-deskripsi_mobil="{{ $itemmobil->deskripsi_mobil }}" data-kode_perusahaan=" {{
                        $itemmobil->kode_perusahaan }}" class="edit text-green-700 hover:text-white border border-green-700 hover:bg-green-800
                        focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-1.5
                        text-center xl:mb-0 mb-2" type="button">
                        UBAH
                    </button>

                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                        data-kode_mobil="{{ $itemmobil->kode_mobil }}"
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
<div id="EditMobilModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Edit Data Mobil
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="EditMobilModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="EditDataMobil" action="{{ route('mobilupdate') }}" method="POST" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="edit_kode_mobil" class="block mb-2 text-sm font-medium text-gray-900">ID Mobil
                            <label class="text-red-800">*</label></label>
                        <input type="text" name="edit_kode_mobil" id="edit_kode_mobil"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" PRSH001" value="{{ $newMobilCode }}" required="" readonly>
                    </div>
                    <div class="col-span-2">
                        <label for="edit_kb_mobil" class="block mb-2 text-sm font-medium text-gray-900">KB
                            Mobil
                        </label>
                        <input type="text" name="edit_kb_mobil" id="edit_kb_mobil"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" KB XXXX JW">
                    </div>
                    <div class="col-span-2">
                        <label for="edit_nama_mobil" class="block mb-2 text-sm font-medium text-gray-900">Nama
                            Mobil
                        </label>
                        <input type="text" name="edit_nama_mobil" id="edit_nama_mobil"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" Toyota Fortuner">
                    </div>
                    <div class="col-span-2">
                        <label for="edit_deskripsi_mobil" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi
                            Mobil</label>
                        <textarea name="edit_deskripsi_mobil" id="edit_deskripsi_mobil" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder=" Bosnya garang!" maxlength="255"></textarea>
                    </div>
                    <div class="col-span-2">
                        <label name="edit_kode_perusahaan" for="edit_kode_perusahaan"
                            class="block mb-2 text-sm font-medium text-gray-900">Perusahaan</label>
                        <select name="edit_kode_perusahaan" id="edit_kode_perusahaan"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            <option name="edit_kode_perusahaan1" id="edit_kode_perusahaan1" value="" selected="">Pilih
                                Perusahaan</option>
                            @foreach ($dataperusahaan as $itemperusahaan)
                            <option value="{{ $itemperusahaan->kode_perusahaan }}">{{ $itemperusahaan->nama_perusahaan
                                }}</option>
                            @endforeach
                        </select>
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
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah kamu yakin untuk menghapus data ini?</h3>
                <form id="delete-form" action="{{ route('mobildelete', ['kode_mobil' => 'PLACEHOLDER']) }}"
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