<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full bg-white rounded-lg shadow">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-lg font-semibold text-gray-900">
                Tambahkan Barang
            </h3>
            <button id="close-modal" type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-2 inline-flex items-center">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Tutup modal</span>
            </button>
        </div>
        <!-- Modal body -->
        <form id="harga-form" action="{{ route('create.harga.satuan') }}" method="POST">
            @csrf
            <input type="hidden" name="jumlah_beli" value="">

            <div class="grid gap-4 my-4">
                <div class="col-span-2">
                    <label for="kode_barang" class="block my-2 text-sm font-medium text-gray-900">Kode Barang</label>
                    <input type="text" name="kode_barang" id="kode_barang"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Contoh : A001" required>
                </div>
                <div class="col-span-2">
                    <label for="nama_barang" class="block my-2 text-sm font-medium text-gray-900">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Contoh : Meja" required>
                </div>
                <div class="col-span-2">
                    <label for="harga_satuan" class="block my-2 text-sm font-medium text-gray-900">Harga Satuan</label>
                    <input type="text" name="harga_satuan" id="harga_satuan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Contoh : 5000" required>
                </div>
            </div>
          
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Tambahkan
            </button>
        </form>
    </div>
</div>
