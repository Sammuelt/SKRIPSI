<!-- Edit Ekstrakulikuler Modal -->
<div id="edit-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-4 rounded shadow-lg w-11/12 sm:w-1/2">
        <h2 class="text-xl font-semibold mb-4">Edit Predikat Ekstrakulikuler:  <span id="edit-nama-ekstra" class="font-bold"></span>
        </h2>
        <form id="edit-form" method="POST" action="{{ route('update.nilai.ekskul') }}">
            @csrf
            <input type="hidden" id="edit-id-ekstrakulikuler" name="id_ekstrakulikuler">
            <input type="hidden" id="edit-id-kelas" name="id_kelas">
            <input type="hidden" id="edit-id-tahun-ajar" name="id_tahun_ajar">
            <input type="hidden" id="edit-id-siswa" name="id_siswa">
            <input type="hidden" id="edit-id-semester" name="id_semester">
            <input type="hidden" name="id" id="edit-id">
            <div class="mb-4">
                <label for="edit-predikat" class="block text-sm font-medium text-gray-900">Predikat</label>
                <input type="text" id="edit-predikat" name="predikat"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
            </div>
            <div class="flex justify-end">
                <button type="button" id="close-edit-modal"
                    class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
            </div>
        </form>
    </div>
</div>
