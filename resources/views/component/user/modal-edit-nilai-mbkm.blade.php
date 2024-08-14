<div id="crud-edit" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full bg-white rounded-lg shadow">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-lg font-semibold text-gray-900">
                Edit Nilai Projek
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
        <form id="edit-form" action="{{ route('edit.nilai.project') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="modal-edit-id" value="">
            <input type="hidden" name="id_tahun_ajar" id="modal-edit-id-tahun-ajar" value="">
            <input type="hidden" name="id_semester" id="modal-edit-id-semester" value="">
            <input type="hidden" name="id_siswa" id="modal-edit-id-siswa" value="">
            <input type="hidden" name="id_kelas" id="modal-edit-id-kelas" value="">
            <input type="hidden" name="id_project" id="modal-edit-id-project" value="">
            <input type="hidden" name="id_capaian" id="modal-edit-capaian-id" value="">

            <!-- Dropdown for predikat -->
            <div class="grid gap-4 my-4">
                <div>
                    <label for="id_nilai" class="block text-sm font-medium text-gray-900">Predikat</label>
                    <select name="id_nilai" id="id_nilai"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        required>
                        <option value="">--PILIH PREDIKAT--</option>
                        @foreach ($predikat as $itemnilai)
                            <option value="{{ $itemnilai->id }}">{{ $itemnilai->nilai }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                tambahkan
            </button>
        </form>
    </div>
</div>

<script>
    // Fungsi untuk membuka modal dan mengisi nilai input tersembunyi
    function openEditModal(capaianId, nilaiId,Id, idSiswa, idKelas, idSemester, idTahunAjar, idProject, nilai) {
        // Mengisi nilai input tersembunyi di modal
        document.getElementById('modal-edit-capaian-id').value = capaianId;
        document.getElementById('modal-edit-id').value =nilaiId;
        document.getElementById('modal-edit-id-tahun-ajar').value = idTahunAjar;
        document.getElementById('modal-edit-id-semester').value = idSemester;
        document.getElementById('modal-edit-id-siswa').value = idSiswa;
        document.getElementById('modal-edit-id-kelas').value = idKelas;
        document.getElementById('modal-edit-id-project').value = idProject;
        
        // Mengatur nilai dropdown
        document.getElementById('id_nilai').value = nilai;

        // Menampilkan modal
        document.getElementById('crud-edit').classList.add('block');
        document.getElementById('crud-edit').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    function closeModal(modalId) {
        // Menyembunyikan modal
        document.getElementById(modalId).classList.add('hidden');
        document.getElementById(modalId).classList.remove('block');
    }

    // Menambahkan event listener untuk tombol tutup modal
    document.getElementById('close-crud-modal').addEventListener('click', function() {
        closeModal('crud-edit');
    });
</script>

