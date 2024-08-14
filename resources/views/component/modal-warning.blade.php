<!-- component/user/modal-alert.blade.php -->
<div id="alert-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full bg-white rounded-lg shadow">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-lg font-semibold text-gray-900">Peringatan</h3>
            
               
        </div>
        <!-- Modal body -->
        <div class="p-6 text-center">
            <svg class="mx-auto mb-4 w-14 h-14 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 0h-2m2 0h2m0 0h-2m0 0h2M12 16h0m-7-7a7 7 0 1 1 14 0 7 7 0 0 1-14 0z" />
            </svg>
            <p class="text-lg font-medium text-gray-900">Silakan Pilih <br>Kelas, Siswa, Tahun, dan semester <br>terlebih dahulu sebelum menambahkan ekstrakulikuler.</p>
        </div>
        <!-- Modal footer -->
        <div class="flex items-center justify-end p-4 border-t">
            <button id="close-alert-modal" type="button" class="text-white-400 bg-transparent bg-yellow-400 hover:bg-yellow-500 hover:text-gray-900 rounded-lg text-sm p-2 inline-flex items-center">Tutup</button>
        </div>
    </div>
</div>
