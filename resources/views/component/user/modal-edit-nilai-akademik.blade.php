<!-- Modal Edit -->
<div id="crud-edit" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full bg-white rounded-lg shadow">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-lg font-semibold text-gray-900">
                Edit Nilai Mapel
            </h3>
            <button id="close-crud-modal" type="button"
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
        <form id="edit-form" action="{{ route('edit.nilai.akademik') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="modal-edit-id" value="">
            <input type="hidden" name="id_tahun_ajar" id="modal-edit-id-tahun-ajar" value="">
            <input type="hidden" name="id_semester" id="modal-edit-id-semester" value="">
            <input type="hidden" name="id_siswa" id="modal-edit-id-siswa" value="">
            <input type="hidden" name="id_kelas" id="modal-edit-id-kelas" value="">
            <input type="hidden" name="id_mapel" id="modal-edit-id-mapel" value="">
            <input type="hidden" name="keterangan" id="modal-edit-keterangan" value="">

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
                    <input type="text" name="kelebihan_kompetensi" id="modal-edit-kelebihan"
                        class="bg-gray-50 border my-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Kelebihan" required="">
                    <input type="text" name="kekurangan_kompetensi" id="modal-edit-kekurangan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Kekurangan" required="">
                </div>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Update
            </button>
        </form>
    </div>
</div>
<script>
    function openEditModal(itemId, nilaiRaporId, idSiswa, idKelas, idSemester, idTahunAjar, idMapel, nilai,
        kekuranganKompetensi, kelebihanKompetensi, keterangan) {
        // Set values in modal fields
        document.getElementById('modal-edit-id').value = nilaiRaporId;
        document.getElementById('modal-edit-id-siswa').value = idSiswa;
        document.getElementById('modal-edit-id-kelas').value = idKelas;
        document.getElementById('modal-edit-id-semester').value = idSemester;
        document.getElementById('modal-edit-id-tahun-ajar').value = idTahunAjar;
        document.getElementById('modal-edit-id-mapel').value = idMapel;
        document.getElementById('nilai').value = nilai;
        document.getElementById('modal-edit-kekurangan').value = kekuranganKompetensi;
        document.getElementById('modal-edit-kelebihan').value = kelebihanKompetensi;
        document.getElementById('modal-edit-keterangan').value = keterangan;

        // Show modal
        document.getElementById('crud-edit').classList.remove('hidden');
        document.getElementById('crud-edit').classList.add('flex');
    }
</script>
