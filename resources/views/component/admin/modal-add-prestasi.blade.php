<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full bg-white rounded-lg shadow">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-lg font-semibold text-gray-900">
                Tambahkan Prestasi
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
        <form id="prestasi-form" action="{{ route('prestasi.create') }}" method="POST">
            @csrf

            <div class="grid gap-4 my-4">
                <div class="col-span-2">
                    <label for="siswa" class="block text-sm font-medium text-gray-900">Nama Siswa</label>
                    <select name="siswa" id="siswa"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        required>
                        <option value="">--Pilih Siswa--</option>
                        @foreach ($siswa as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2">
                    <label for="title" class="block my-2 text-sm font-medium text-gray-900">Peringkat Juara</label>
                    <input type="text" name="title" id="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Contoh : JUARA 1" required>
                </div>
                <div class="col-span-2">
                    <label for="nama_lomba" class="block my-2 text-sm font-medium text-gray-900">Nama Lomba</label>
                    <input type="text" name="nama_lomba" id="nama_lomba"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Contoh : OLIMPIADE MATEMATIKA NASIONAL 2024" required>
                </div>
                <div class="col-span-2">
                    <label for="date" class="block my-2 text-sm font-medium text-gray-900">Tanggal Lomba</label>
                    <input type="date" name="date" id="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        required>
                </div>
                <div class="col-span-2">
                    <label for="ket" class="block my-2 text-sm font-medium text-gray-900">Ket</label>
                    <input type="text" name="ket" id="ket"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Contoh : menjuarai olimpiade sains tingkat nasional, yang di selenggarakan di jakarta" required>
                </div>
            </div>
          
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Tambahkan
            </button>
        </form>
    </div>
</div>
