<!-- component/user/modal-input-ekskul.blade.php -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full bg-white rounded-lg shadow">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-lg font-semibold text-gray-900">
                Tambahkan Kehadiran
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
        <form id="kehadirans-form" action="{{ route('store.kehadiran') }}" method="POST">
            @csrf
            <input type="hidden" name="id_tahun_ajar" id="modal-id-tahun-ajar" value="">
            <input type="hidden" name="id_semester" id="modal-id-semester" value="">
            <input type="hidden" name="id_siswa" id="modal-id-siswa" value="">
            <input type="hidden" name="id_kelas" id="modal-id-kelas" value="">
            
            <div>
                <div>
                    <label for="sakit" class="block text-sm  font-medium text-gray-900">Sakit</label>
                    <input type="text" inputmode="numeric" name="sakit" id="sakit"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Contoh : 4" required>
                </div>
                <div>
                    <label for="izin" class="block text-sm font-medium text-gray-900">Izin</label>
                    <input type="text" inputmode="numeric" name="izin" id="izin"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Contoh : 4" required>
                </div>
                <div>
                    <label for="alpha" class="block text-sm font-medium text-gray-900">Alpha</label>
                    <input type="text" inputmode="numeric" name="alpha" id="alpha"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Contoh : 4" required>
                </div>
            </div>
          
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Tambahkan
            </button>
        </form>
    </div>
</div>
<script>
    // Fungsi untuk menutup modal
    function closeModal() {
        document.getElementById('crud-modal').classList.add('hidden');
    }

    // Menambahkan event listener untuk tombol close di modal
    document.getElementById('close-modal').addEventListener('click', closeModal);

    // Menambahkan event listener untuk area klik di luar modal untuk menutup modal
    document.getElementById('crud-modal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeModal();
        }
    });
</script>

