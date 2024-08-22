@extends('./layouts/app')
@extends('./layouts/sidebar')

@section('title')
Jaya Motor | Form Pembelian
@endsection

@section('contentsidebar')

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit');
    
    editButtons.forEach(button => {
    button.addEventListener('click', function () {
    // Ambil data dari atribut data- pada button
    const kodePembDetil = this.getAttribute('data-kode_pembdetil');
    const kodePembelian = this.getAttribute('data-kode_pembelian');
    const namaBarang = this.getAttribute('data-nama_barang');
    const jumlahBarang = this.getAttribute('data-jumlah_barang');
    const satuanBarang = this.getAttribute('data-satuan_barang');
    const deskripsiBarang = this.getAttribute('data-deskripsi_barang');
    const hargaSatuanBarang = this.getAttribute('data-harga_satuan_barang');
    const hargaTotalBarangSbd = this.getAttribute('data-harga_total_barang_sbd');
    const persenDiskonBarang = this.getAttribute('data-persen_diskon_barang');
    const rupiahDiskonBarang = this.getAttribute('data-rupiah_diskon_barang');
    const hargaTotalBarangStd = this.getAttribute('data-harga_total_barang_std');
    
    // Isi field modal dengan data
    document.getElementById('edit_kode_pembdetil').value = kodePembDetil;
    document.getElementById('edit_kode_pembelian').value = kodePembelian;
    document.getElementById('edit_nama_barang').value = namaBarang;
    document.getElementById('edit_jumlah_barang').value = jumlahBarang;
    document.getElementById('edit_satuan_barang').value = satuanBarang;
    document.getElementById('edit_deskripsi_barang').value = deskripsiBarang;
    document.getElementById('edit_harga_satuan_barang').value = hargaSatuanBarang;
    document.getElementById('edit_harga_total_barang_sbd').value = hargaTotalBarangSbd;
    document.getElementById('edit_persen_diskon_barang').value = persenDiskonBarang;
    document.getElementById('edit_rupiah_diskon_barang').value = rupiahDiskonBarang;
    document.getElementById('edit_harga_total_barang_std').value = hargaTotalBarangStd;
    });
    });
    });


    document.addEventListener("DOMContentLoaded", function() {
    const jumlahBarang = document.getElementById('jumlah_barang');
    const hargaSatuanBarang = document.getElementById('harga_satuan_barang');
    const hargaTotalBarangSBD = document.getElementById('harga_total_barang_sbd');
    const persenDiskonBarang = document.getElementById('persen_diskon_barang');
    const rupiahDiskonBarang = document.getElementById('rupiah_diskon_barang');
    const hargaTotalBarangSTD = document.getElementById('harga_total_barang_std');
    
    function calculateTotal() {
    let jumlah = parseFloat(jumlahBarang.value) || 0;
    let hargaSatuan = parseFloat(hargaSatuanBarang.value) || 0;
    let totalSBD = jumlah * hargaSatuan;
    
    if (jumlah === 0) {
    totalSBD = hargaSatuan;
    }
    
    hargaTotalBarangSBD.value = totalSBD.toFixed();
    
    let diskonPersen = parseFloat(persenDiskonBarang.value) || 0;
    let diskonRupiah = parseFloat(rupiahDiskonBarang.value) || 0;
    let totalSTD = totalSBD;
    
    if (diskonPersen !== 0) {
    totalSTD = totalSBD * (1 - diskonPersen / 100);
    rupiahDiskonBarang.value = (totalSBD - totalSTD).toFixed();
    } else if (diskonRupiah !== 0) {
    totalSTD = totalSBD - diskonRupiah;
    }
    
    hargaTotalBarangSTD.value = totalSTD.toFixed();
    }
    
    jumlahBarang.addEventListener('input', calculateTotal);
    hargaSatuanBarang.addEventListener('input', calculateTotal);
    persenDiskonBarang.addEventListener('input', calculateTotal);
    rupiahDiskonBarang.addEventListener('input', calculateTotal);
    });

    document.addEventListener("DOMContentLoaded", function() {
    const jumlahBarang = document.getElementById('edit_jumlah_barang');
    const hargaSatuanBarang = document.getElementById('edit_harga_satuan_barang');
    const hargaTotalBarangSBD = document.getElementById('edit_harga_total_barang_sbd');
    const persenDiskonBarang = document.getElementById('edit_persen_diskon_barang');
    const rupiahDiskonBarang = document.getElementById('edit_rupiah_diskon_barang');
    const hargaTotalBarangSTD = document.getElementById('edit_harga_total_barang_std');
    
    function calculateTotal() {
    let jumlah = parseFloat(jumlahBarang.value) || 0;
    let hargaSatuan = parseFloat(hargaSatuanBarang.value) || 0;
    let totalSBD = jumlah * hargaSatuan;
    
    if (jumlah === 0) {
    totalSBD = hargaSatuan;
    }
    
    hargaTotalBarangSBD.value = totalSBD.toFixed();
    
    let diskonPersen = parseFloat(persenDiskonBarang.value) || 0;
    let diskonRupiah = parseFloat(rupiahDiskonBarang.value) || 0;
    let totalSTD = totalSBD;
    
    if (diskonPersen !== 0) {
    totalSTD = totalSBD * (1 - diskonPersen / 100);
    rupiahDiskonBarang.value = (totalSBD - totalSTD).toFixed();
    } else if (diskonRupiah !== 0) {
    totalSTD = totalSBD - diskonRupiah;
    }
    
    hargaTotalBarangSTD.value = totalSTD.toFixed();
    }
    
    jumlahBarang.addEventListener('input', calculateTotal);
    hargaSatuanBarang.addEventListener('input', calculateTotal);
    persenDiskonBarang.addEventListener('input', calculateTotal);
    rupiahDiskonBarang.addEventListener('input', calculateTotal);
    });

    document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete');
    
    deleteButtons.forEach(button => {
    button.addEventListener('click', function () {
    // Get the kode_pembdetil from data attribute
    const kodePembDetil = this.getAttribute('data-kode_pembdetil');
    
    // Update the delete form action URL with the correct kode_pembdetil
    const deleteForm = document.getElementById('delete-form');
    deleteForm.action = deleteForm.action.replace('PLACEHOLDER', kodePembDetil);
    
    // Show the modal
    const modal = document.getElementById('popup-modal');
    modal.classList.remove('hidden');
    });
    });
    });

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
        const subtotalElement = document.getElementById('total_pembelian_sb');
        const persenDiskonElement = document.getElementById('persen_diskon_pembelian');
        const rupiahDiskonElement = document.getElementById('rupiah_diskon_pembelian');
        const persenPpnElement = document.getElementById('persen_ppn_pembelian');
        const rupiahPpnElement = document.getElementById('rupiah_ppn_pembelian');
        const persenBiayaLainElement = document.getElementById('persen_biayalain_pembelian');
        const rupiahBiayaLainElement = document.getElementById('rupiah_biayalain_pembelian');
        const pembulatanElement = document.getElementById('pembulatan_pembelian');
        const totalPembelianElement = document.getElementById('total_pembelian_st');
        const jumlahBayarElement = document.getElementById('jumlah_bayar_pembelian');
        const statusPembelianElement = document.getElementById('status_pembelian');
    
        function calculateTotals() {
            const subtotal = parseFloat(subtotalElement.value) || 0;
            const persenDiskon = parseFloat(persenDiskonElement.value) || 0;
            const rupiahDiskon = parseFloat(rupiahDiskonElement.value) || 0;
            const persenPpn = parseFloat(persenPpnElement.value) || 0;
            const rupiahPpn = parseFloat(rupiahPpnElement.value) || 0;
            const persenBiayaLain = parseFloat(persenBiayaLainElement.value) || 0;
            const rupiahBiayaLain = parseFloat(rupiahBiayaLainElement.value) || 0;
            const pembulatan = parseFloat(pembulatanElement.value) || 0;
            const jumlahBayar = parseFloat(jumlahBayarElement.value) || 0;
    
            // Calculate rupiahDiskon if persenDiskon is provided
            if (persenDiskon > 0) {
                rupiahDiskonElement.value = (subtotal * persenDiskon / 100).toFixed();
            } 

            if (persenPpn > 0) {
            rupiahPpnElement.value = ((persenPpn / 100) * (subtotal * (100 - persenDiskon) / 100)) .toFixed();
            } 

            if (persenBiayaLain > 0) {
            rupiahBiayaLainElement.value = ((persenBiayaLain / 100) * (subtotal * (100 - persenDiskon) / 100)) .toFixed();
            } 
    
            // Calculate total_pembelian_st
            const totalPembelian = subtotal 
                - (parseFloat(rupiahDiskonElement.value) || 0) 
                + (parseFloat(rupiahPpnElement.value) || 0) 
                + (parseFloat(rupiahBiayaLainElement.value) || 0) 
                + (parseFloat(pembulatanElement.value) || 0);
    
            totalPembelianElement.value = totalPembelian.toFixed();
    
            // Update status
            if (jumlahBayar === totalPembelian) {
            statusPembelianElement.value = '1'; // Set value to 1 for "LUNAS"
            statusPembelianElement.setAttribute('data-status-text', 'LUNAS'); // Set custom data attribute for display text
            } else {
            statusPembelianElement.value = '0'; // Set value to 0 for "TIDAK LUNAS"
            statusPembelianElement.setAttribute('data-status-text', 'TIDAK LUNAS'); // Set custom data attribute for display text
            }
            
            // Update display text
            const statusDisplayElement = document.getElementById('status_display'); // Assuming this is where you display the text
            statusDisplayElement.textContent = statusPembelianElement.getAttribute('data-status-text');
        }
    
        // Add event listeners to input fields
        persenDiskonElement.addEventListener('input', calculateTotals);
        rupiahDiskonElement.addEventListener('input', calculateTotals);
        persenPpnElement.addEventListener('input', calculateTotals);
        rupiahPpnElement.addEventListener('input', calculateTotals);
        persenBiayaLainElement.addEventListener('input', calculateTotals);
        rupiahBiayaLainElement.addEventListener('input', calculateTotals);
        pembulatanElement.addEventListener('input', calculateTotals);
        jumlahBayarElement.addEventListener('input', calculateTotals);
    
        // Initialize totals on page load
        calculateTotals();
    });

    document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formPembelian');
    const draftBtn = document.getElementById('draftBtn');
    const prosesBtn = document.getElementById('prosesBtn');
    
    draftBtn.addEventListener('click', function () {
    form.action = "{{ route('pembeliandraft') }}"; // Ganti dengan route untuk draft
    form.submit();
    });
    
    prosesBtn.addEventListener('click', function () {
    form.action = "{{ route('pembelianproses') }}"; // Ganti dengan route untuk proses
    form.submit();
    });
    });

    document.getElementById('barangBtn').addEventListener('click', function(event) {
    event.preventDefault(); // Mencegah form dari submit
    // Tampilkan modal atau lakukan aksi lainnya
    });
</script>

<div class="flex flex-row text-center ">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
        class="text-black size-3 my-auto mr-3">
        <path fill-rule="evenodd"
            d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z"
            clip-rule="evenodd" />
    </svg>
    <a href="{{ route('pembelian') }}" class="font-light my-auto">Kembali</a>
</div>
<div class="text-center align-middle my-5">
    <h1 class="text-3xl font-bold mb-2">Form Pembelian</h1>
</div>

<form id="formPembelian" action="{{ route('pembeliandraft') }}" method="post">
    @csrf
    <div class="grid gap-4 mb-4 grid-cols-2">
        <div class="col-span-2">
            <label for="kode_pembelian" class="block mb-2 text-sm font-medium text-gray-900">ID Pembelian
                <label class="text-red-800">*</label></label>
            <input type="text" name="kode_pembelian" id="kode_pembelian"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                placeholder=" PEMB001" value="{{ $kode_pembelian }}" required="" readonly>
        </div>
        <div class="col-span-1">
            <label for="tanggal_pembelian" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Pembelian
                <label class="text-red-800">*</label></label>
            <input type="date" name="tanggal_pembelian" id="tanggal_pembelian"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                value="{{ $dataTePembelian -> tanggal_pembelian }}" required="">
        </div>
        <div class="col-span-1">
            <label for="kode_supplier" class="block mb-2 text-sm font-medium text-gray-900">Supplier</label>
            <select name="kode_supplier" id="kode_supplier"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                <option value="{{ $dataTePembelian -> kode_supplier }}" selected="">Pilih Supplier</option>
                @foreach ($datasupplier as $itemsupplier)
                <option value="{{ $itemsupplier->kode_supplier }}">{{ $itemsupplier->nama_supplier
                    }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="flex flex-row justify-between text-left my-5">
        <div class="my-auto">
            <p class="font-bold text-xl">List Item</p>
        </div>

        <div class="my-auto">
            <button type="button" id="barangBtn" data-modal-target="AddBarangModal" data-modal-toggle="AddBarangModal"
                class="my-auto block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Tambah Barang
            </button>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama Barang
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jumlah Barang
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Satuan Barang
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Deskripsi
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Harga Satuan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Subtotal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Diskon (%)
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Diskon (Rp.)
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total Harga
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataTePembelianDt as $itemTePembelianDt)
                <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $itemTePembelianDt -> nama_barang }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $itemTePembelianDt -> jumlah_barang }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $itemTePembelianDt -> satuan_barang }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $itemTePembelianDt -> deskripsi_barang }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="currency">{{ $itemTePembelianDt -> harga_satuan_barang }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="currency">{{ $itemTePembelianDt -> harga_total_barang_sbd }}</span>
                    </td>
                    <td class="px-6 py-4">
                        {{ $itemTePembelianDt -> persen_diskon_barang }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="currency">{{ $itemTePembelianDt -> rupiah_diskon_barang }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="currency">{{ $itemTePembelianDt -> harga_total_barang_std }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <!-- Modal toggle -->
                        <button data-modal-target="EditBarangModal" data-modal-toggle="EditBarangModal"
                            data-kode_pembdetil="{{ $itemTePembelianDt ->kode_pembdetil }}" data-kode_pembelian="{{
                        $itemTePembelianDt -> kode_pembelian }}"
                            data-nama_barang="{{ $itemTePembelianDt -> nama_barang }}"
                            data-jumlah_barang="{{ $itemTePembelianDt -> jumlah_barang }}" data-satuan_barang="{{
                        $itemTePembelianDt -> satuan_barang }}" data-deskripsi_barang="{{ $itemTePembelianDt ->
                        deskripsi_barang }}" data-harga_satuan_barang="{{ $itemTePembelianDt -> harga_satuan_barang }}"
                            data-harga_total_barang_sbd="{{ $itemTePembelianDt -> harga_total_barang_sbd }}"
                            data-persen_diskon_barang="{{ $itemTePembelianDt -> persen_diskon_barang }}"
                            data-rupiah_diskon_barang="{{ $itemTePembelianDt -> rupiah_diskon_barang }}"
                            data-harga_total_barang_std="{{ $itemTePembelianDt -> harga_total_barang_std }}" class=" edit text-green-700 hover:text-white border border-green-700 hover:bg-green-800
                        focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-1.5
                        text-center xl:mb-0 mb-2" type="button">
                            UBAH
                        </button>

                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                            data-kode_pembdetil="{{ $itemTePembelianDt ->kode_pembdetil }}"
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

    <div class="xl:grid xl:grid-cols-8 xl:gap-4">
        <div class="col-span-2 px-5 border py-5 rounded-lg xl:mb-0 mb-5">
            <label class="block mb-2 text-md font-medium text-gray-900">Diskon Pembelian
            </label>
            <div class="flex flex-col">
                <div class="col-span-1 flex flex-row mb-2">
                    <label class="my-auto w-2/5" for="">%</label>
                    <input type="text" name="persen_diskon_pembelian" id="persen_diskon_pembelian"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder=" 20" value="{{ $dataTePembelian -> persen_diskon_pembelian }}">
                </div>
                <div class="flex flex-row ">
                    <label class="my-auto w-2/5" for="">Rp.</label>
                    <input type="number" name="rupiah_diskon_pembelian" id="rupiah_diskon_pembelian"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder=" 100.000" value="{{ $dataTePembelian -> rupiah_diskon_pembelian }}">
                </div>
            </div>
        </div>
        <div class="col-span-2 px-5 border py-5 rounded-lg xl:mb-0 mb-5">
            <label class="block mb-2 text-md font-medium text-gray-900">PPN Pembelian
            </label>
            <div class="flex flex-col">
                <div class="col-span-1 flex flex-row mb-2">
                    <label class="my-auto w-2/5" for="">%</label>
                    <input type="text" name="persen_ppn_pembelian" id="persen_ppn_pembelian"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder=" 20" value="{{ $dataTePembelian -> persen_ppn_pembelian }}">
                </div>
                <div class="flex flex-row ">
                    <label class="my-auto w-2/5" for="">Rp.</label>
                    <input type="number" name="rupiah_ppn_pembelian" id="rupiah_ppn_pembelian"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder=" 100.000" value="{{ $dataTePembelian -> persen_ppn_pembelian }}">
                </div>
            </div>
        </div>
        <div class="col-span-2 px-5 border py-5 rounded-lg xl:mb-0 mb-5">
            <label class="block mb-2 text-md font-medium text-gray-900">Biaya Lain
            </label>
            <div class="flex flex-col">
                <div class="col-span-1 flex flex-row mb-2">
                    <label class="my-auto w-2/5" for="">%</label>
                    <input type="text" name="persen_biayalain_pembelian" id="persen_biayalain_pembelian"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder=" 20" value="{{ $dataTePembelian -> persen_biayalain_pembelian }}">
                </div>
                <div class="flex flex-row ">
                    <label class="my-auto w-2/5" for="">Rp.</label>
                    <input type="number" name="rupiah_biayalain_pembelian" id="rupiah_biayalain_pembelian"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder=" 100.000" value="{{ $dataTePembelian -> persen_biayalain_pembelian }}">
                </div>
            </div>
        </div>
        <div class="col-span-2 px-5 border py-5 rounded-lg xl:mb-0 mb-5">
            <label class="block mb-2 text-md font-medium text-gray-900">Total Pembelian
            </label>
            <div class="flex flex-col">
                <div class="col-span-1 flex flex-row mb-2">
                    <label class="my-auto w-2/5" for="">Subtotal</label>
                    <input type="number" name="total_pembelian_sb" id="total_pembelian_sb"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder=" 100.000" value="{{ $subtotal }}" readonly>
                </div>
                <div class="col-span-1 flex flex-row mb-2">
                    <label class="my-auto w-2/5" for="">Pembulatan</label>
                    <input type="number" name="pembulatan_pembelian" id="pembulatan_pembelian"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder=" 1" value="{{ $dataTePembelian -> pembulatan_pembelian }}">
                </div>
                <div class="col-span-1 flex flex-row mb-2">
                    <label class="my-auto w-2/5 font-bold" for="">Total</label>
                    <input type="number" name="total_pembelian_st" id="total_pembelian_st"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder=" 100.000" required="" readonly>
                </div>
                <div class="flex flex-row mb-2">
                    <label class="my-auto w-2/5" for="">Bayar</label>
                    <input type="number" name="jumlah_bayar_pembelian" id="jumlah_bayar_pembelian"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder=" 100.000" required value="{{ $dataTePembelian -> jumlah_bayar_pembelian }}">
                </div>
                <div class="flex flex-row mb-10">
                    <input type="hidden" name="status_pembelian" id="status_pembelian" value="0">
                    <label class="my-auto w-2/5" for="">Status</label>
                    <span
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        id="status_display" readonly>TIDAK LUNAS</span>
                    {{-- <input type="text" name="status_display" id="status_display"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder=" LUNAS" required="" readonly> --}}
                </div>
                <div class="flex flex-row mb-10">
                    <label class="my-auto w-2/5" for="">Deskripsi</label>
                    <textarea name="deskripsi_pembelian" id="deskripsi_pembelian" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder=" Bosnya garang!"
                        maxlength="255">{{ $dataTePembelian -> deskripsi_pembelian }}</textarea>
                </div>
                <div class="flex flex-row justify-between">
                    <button type="button" id="draftBtn"
                        class="mx-2 w-2/4 block text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Draft
                    </button>
                    <button type="button" id="prosesBtn"
                        class="mx-2 w-2/4 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Proses
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Main modal -->
<div id="AddBarangModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Input Data Barang
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="AddBarangModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="AddDataBarang" action="{{ route('pembelianbrginsert') }}" method="POST" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="kode_pembelian" class="block mb-2 text-sm font-medium text-gray-900">ID Pembelian
                            <label class="text-red-800">*</label></label>
                        <input type="text" name="kode_pembelian" id="kode_pembelian"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" PRSH001" value="{{ $kode_pembelian }}" required="" readonly>
                    </div>
                    <div class="col-span-2">
                        <label for="nama_barang" class="block mb-2 text-sm font-medium text-gray-900">Nama Barang
                            <label class="text-red-800">*</label></label>
                        <input type="text" name="nama_barang" id="nama_barang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" Kampas Rem" required="" maxlength="255">
                    </div>
                    <div class="col-span-2">
                        <label for="jumlah_barang" class="block mb-2 text-sm font-medium text-gray-900">Jumlah Barang
                        </label>
                        <input type="number" name="jumlah_barang" id="jumlah_barang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" 99" min="0">
                    </div>
                    <div class="col-span-2">
                        <label for="satuan_barang" class="block mb-2 text-sm font-medium text-gray-900">Satuan Barang
                        </label>
                        <input type="text" name="satuan_barang" id="satuan_barang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" pcs">
                    </div>
                    <div class="col-span-2">
                        <label for="deskripsi_barang" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi
                            Barang</label>
                        <textarea name="deskripsi_barang" id="deskripsi_barang" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder=" Masa berlaku sekian" maxlength="255"></textarea>
                    </div>
                    <div class="col-span-2">
                        <label for="harga_satuan_barang" class="block mb-2 text-sm font-medium text-gray-900">Harga
                            Satuan
                            Barang <label class="text-red-800">*</label>
                        </label>
                        <input type="number" name="harga_satuan_barang" id="harga_satuan_barang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" 100000" min="0" required>
                    </div>
                    <div class="col-span-2">
                        <label for="harga_total_barang_sbd"
                            class="block mb-2 text-sm font-medium text-gray-900">Subtotal <label
                                class="text-red-800">*</label>
                        </label>
                        <input type="number" name="harga_total_barang_sbd" id="harga_total_barang_sbd"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" 100000" min="0" required>
                    </div>
                    <div class="col-span-2">
                        <label for="persen_diskon_barang" class="block mb-2 text-sm font-medium text-gray-900">Diskon
                            (%)
                        </label>
                        <input type="number" name="persen_diskon_barang" id="persen_diskon_barang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" 20" min="0">
                    </div>
                    <div class="col-span-2">
                        <label for="rupiah_diskon_barang" class="block mb-2 text-sm font-medium text-gray-900">Diskon
                            (Rp.)
                        </label>
                        <input type="number" name="rupiah_diskon_barang" id="rupiah_diskon_barang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" 100000" min="0">
                    </div>
                    <div class="col-span-2">
                        <label for="harga_total_barang_std" class="block mb-2 text-sm font-medium text-gray-900">Total
                            Harga Barang <label class="text-red-800">*</label>
                        </label>
                        <input type="number" name="harga_total_barang_std" id="harga_total_barang_std"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" 100000" min="0" required>
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

<!-- Main modal -->
<div id="EditBarangModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Edit Data Barang
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="EditBarangModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="EditDataBarang" action="{{ route('pembelianbrgupdate') }}" method="POST" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <input type="text" id="edit_kode_pembdetil" name="edit_kode_pembdetil" class="text-gray-900"
                            hidden>
                        <label for="edit_kode_pembelian" class="block mb-2 text-sm font-medium text-gray-900">ID
                            Pembelian
                            <label class="text-red-800">*</label></label>
                        <input type="text" name="edit_kode_pembelian" id="edit_kode_pembelian"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" PRSH001" value="{{ $kode_pembelian }}" required="" readonly>
                    </div>
                    <div class="col-span-2">
                        <label for="edit_nama_barang" class="block mb-2 text-sm font-medium text-gray-900">Nama Barang
                            <label class="text-red-800">*</label></label>
                        <input type="text" name="edit_nama_barang" id="edit_nama_barang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" Kampas Rem" required="" maxlength="255">
                    </div>
                    <div class="col-span-2">
                        <label for="edit_jumlah_barang" class="block mb-2 text-sm font-medium text-gray-900">Jumlah
                            Barang
                        </label>
                        <input type="number" name="edit_jumlah_barang" id="edit_jumlah_barang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" 99" min="0">
                    </div>
                    <div class="col-span-2">
                        <label for="edit_satuan_barang" class="block mb-2 text-sm font-medium text-gray-900">Satuan
                            Barang
                        </label>
                        <input type="text" name="edit_satuan_barang" id="edit_satuan_barang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" pcs">
                    </div>
                    <div class="col-span-2">
                        <label for="edit_deskripsi_barang"
                            class="block mb-2 text-sm font-medium text-gray-900">Deskripsi
                            Barang</label>
                        <textarea name="edit_deskripsi_barang" id="edit_deskripsi_barang" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder=" Masa berlaku sekian" maxlength="255"></textarea>
                    </div>
                    <div class="col-span-2">
                        <label for="edit_harga_satuan_barang" class="block mb-2 text-sm font-medium text-gray-900">Harga
                            Satuan
                            Barang <label class="text-red-800">*</label>
                        </label>
                        <input type="number" name="edit_harga_satuan_barang" id="edit_harga_satuan_barang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" 100000" min="0" required>
                    </div>
                    <div class="col-span-2">
                        <label for="edit_harga_total_barang_sbd"
                            class="block mb-2 text-sm font-medium text-gray-900">Subtotal <label
                                class="text-red-800">*</label>
                        </label>
                        <input type="number" name="edit_harga_total_barang_sbd" id="edit_harga_total_barang_sbd"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" 100000" min="0" required>
                    </div>
                    <div class="col-span-2">
                        <label for="edit_persen_diskon_barang"
                            class="block mb-2 text-sm font-medium text-gray-900">Diskon
                            (%)
                        </label>
                        <input type="number" name="edit_persen_diskon_barang" id="edit_persen_diskon_barang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" 20" min="0">
                    </div>
                    <div class="col-span-2">
                        <label for="edit_rupiah_diskon_barang"
                            class="block mb-2 text-sm font-medium text-gray-900">Diskon
                            (Rp.)
                        </label>
                        <input type="number" name="edit_rupiah_diskon_barang" id="edit_rupiah_diskon_barang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" 100000" min="0">
                    </div>
                    <div class="col-span-2">
                        <label for="edit_harga_total_barang_std"
                            class="block mb-2 text-sm font-medium text-gray-900">Total
                            Harga Barang <label class="text-red-800">*</label>
                        </label>
                        <input type="number" name="edit_harga_total_barang_std" id="edit_harga_total_barang_std"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder=" 100000" min="0" required>
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
                <form id="delete-form" action="{{ route('pembelianbrgdelete', ['kode_pembdetil' => 'PLACEHOLDER']) }}"
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