<!-- component/user/modal-input-ekskul.blade.php -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full bg-white rounded-lg shadow">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-lg font-semibold text-gray-900">
                Tambahkan Ekstrakulikuler
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
        <form id="ekskul-form" action="{{ route('store.nilai.ekskul') }}" method="POST">
            @csrf
            <input type="hidden" name="id_tahun_ajar" id="modal-id-tahun-ajar" value="">
            <input type="hidden" name="id_semester" id="modal-id-semester" value="">
            <input type="hidden" name="id_siswa" id="modal-id-siswa" value="">
            <input type="hidden" name="id_kelas" id="modal-id-kelas" value="">
            <input type="hidden" name="keterangan" value="">

            <div class="grid gap-4 my-4">
                <div>
                    <label for="ekstrakulikuler" class="block text-sm font-medium text-gray-900">Ekstrakulikuler</label>
                    <select name="id_ekstrakulikuler" id="ekstrakulikuler"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        required>
                        <option value="">--PILIH EKSTRAKULIKULER--</option>
                        @foreach ($ekskuls as $ekskul)
                            <option value="{{ $ekskul->id }}">{{ $ekskul->ekstrakulikuler }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid gap-4 mb-4">
                <div>
                    <label for="predikat" class="block text-sm font-medium text-gray-900">Predikat</label>
                    <input type="text" name="predikat" id="predikat"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Tulis dengan Huruf 'A'" required>
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
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('crud-modal');
        const closeModalButton = document.getElementById('close-modal');
        const openModalButton = document.getElementById('open-modal');
        const form = document.getElementById('ekskul-form');
        const fields = ['ekstrakulikuler', 'predikat'];

        // Function to open the modal and set the values
        if (openModalButton) {
            openModalButton.addEventListener('click', function() {
                const idKelas = document.getElementById('id_kelas').value; // Get ID, not text
                const idTahunAjar = document.getElementById('id_tahun_ajar').value; // Get ID, not text
                const idSiswa = document.getElementById('id_siswa').value; // Get ID, not text
                const idSemester = document.getElementById('id_semester').value; // Get ID, not text

                document.getElementById('modal-id-kelas').value = idKelas;
                document.getElementById('modal-id-tahun-ajar').value = idTahunAjar;
                document.getElementById('modal-id-siswa').value = idSiswa;
                document.getElementById('modal-id-semester').value = idSemester;

                modal.classList.remove('hidden');
            });
        }

        // Close modal functionality
        if (closeModalButton) {
            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });
        }

        // Optional: Close modal when clicking outside of it
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });

        // Validate form before submission
        form.addEventListener('submit', function(event) {
            let isValid = true;
            let errorMessage = '';

            fields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (!field || field.value.trim() === '') {
                    isValid = false;
                    errorMessage += `Field ${fieldId} harus diisi.\n`;
                }
            });

            if (!isValid) {
                event.preventDefault(); // Prevent form submission
                alert(errorMessage); // Show error message
            }
        });
    });
</script>
