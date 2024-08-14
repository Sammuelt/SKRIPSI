<div id="crud-modal" tabindex="-1" aria-hidden="true"
class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full bg-white rounded-lg shadow">
        <!-- Modal content -->
        <div class="relative bg-white p-6 rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Tambahkan Nilai "<span id="nama-pelajaran"></span>"
                </h3>
                <button type="button"
                    data-modal-toggle="crud-modal"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center modal-close">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Tutup modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('store.nilai.akademik') }}" class="p-4 md:p-5" method="POST" id="modal-form">
                @csrf
                <input type="hidden" name="id_mapel" id="modal-id-mapel" value="">
                <input type="hidden" name="id_tahun_ajar" id="modal-id-tahun-ajar" value="">
                <input type="hidden" name="id_semester" id="modal-id-semester" value="">
                <input type="hidden" name="id_siswa" id="modal-id-siswa" value="">
                <input type="hidden" name="id_kelas" id="modal-id-kelas" value="">
                <input type="hidden" name="keterangan" value="">

                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="nilai" class="block my-2 text-sm font-medium text-gray-900 ">Nilai</label>
                        <input type="text" inputmode="numeric" name="nilai" id="nilai"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Contoh '90'" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="kelebihan_kompetensi" class="block mb-2 text-sm font-medium text-gray-900 ">Capaian
                            Kompetensi</label>
                        <input type="text" name="kelebihan_kompetensi" id="kelebihan_kompetensi"
                            class="bg-gray-50 border my-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Kelebihan" required="">
                        <input type="text" name="kekurangan_kompetensi" id="kekurangan_kompetensi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Kekurangan" required="">
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
                    Tambahkan
                </button>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('crud-modal');
        const modalTitle = modal.querySelector('#nama-pelajaran');
        const modalForm = modal.querySelector('#modal-form');

        document.querySelectorAll('[data-modal-toggle="crud-modal"]').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const namaPelajaran = this.closest('tr').querySelector('td:nth-child(2)').textContent.trim();

                // Ambil data dari filter
                const idKelas = document.getElementById('id_kelas_dd').value;
                const idTahunAjar = document.getElementById('id_tahun_ajar_dd').value;
                const idSiswa = document.getElementById('id_siswa_dd').value;
                const idSemester = document.getElementById('id_semester_dd').value;

                // Isi modal
                modalTitle.textContent = namaPelajaran;
                modalForm.querySelector('#modal-id-mapel').value = id;
                modalForm.querySelector('#modal-id-tahun-ajar').value = idTahunAjar;
                modalForm.querySelector('#modal-id-semester').value = idSemester;
                modalForm.querySelector('#modal-id-siswa').value = idSiswa;
                modalForm.querySelector('#modal-id-kelas').value = idKelas;

                // Tampilkan modal
                modal.classList.remove('hidden');
            });
        });

        // Fungsi untuk menutup modal
        modal.querySelector('.modal-close').addEventListener('click', function() {
            modal.classList.add('hidden');
        });

        // Opsi tambahan: menutup modal saat mengklik di luar area modal
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
</script>
