@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Input Project P5
        </h1>
        <div class="rounded-lg bg-gray-200 lg:col-span-2">
            <div class="relative">
                <form id="search-form" method="GET" action="{{ route('index.p5') }}">
                    <label for="Search" class="sr-only">Search</label>
                    <input type="text" id="Search" name="search" placeholder="Search for..."
                        value="{{ request()->input('search') }}"
                        class="w-full rounded-lg bg-white text-black py-2.5 px-2 pe-10 shadow-sm sm:text-sm" autofocus />
                </form>
            </div>
        </div>
    </div>

    {{-- button group --}}
    <div class="mb-6 mt-4 relative">
         <a href="{{ route('create.p5') }}"
            class="w-full rounded-lg text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
            Tambahkan Projek Baru
         </a>
    </div>

    {{-- table --}}
    @foreach ($projects as $item)
    <div class="relative overflow-x-auto my-2 shadow-md sm:rounded-lg">
       
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Judul</th>
                        <th scope="col" class="px-6 py-3 ">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $item->judul }}
                        </td>
                        <td class="px-6 py-4 ">
                            <button onclick="toggleDetails('{{ $item->id }}')"
                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
                                View
                            </button>
                            <button onclick="toggleEdit('{{ $item->id }}')"
                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
                                Edit
                            </button>
                            <button onclick="toggleDelete('{{ $item->id }}')"
                                class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
                                Delete
                            </button>
                        </td>
                    </tr>
                    <tr id="details-{{ $item->id }}" class="hidden">
                        <td colspan="2" class="px-4 py-4">
                            <div class="p-4 border-t border-gray-200">
                                <p><strong>Deskripsi :</strong> {{ $item->description }}</p>
                            </div>
                            <div class="p-4 border-t border-gray-200">
                                <p><strong>Capaian Pelajaran :</strong> {{ $item->capaian_proses }}</p>
                            </div>
                        </td>
                    </tr>
                    <tr id="edit-{{ $item->id }}" class="hidden">
                        <td colspan="2" class="px-4 py-4">
                            <form method="POST" action="{{ route('update.project.p5', $item->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label for="description-{{ $item->id }}" class="block text-sm font-medium text-gray-700">Deskripsi:</label>
                                    <textarea id="description-{{ $item->id }}" name="description"
                                        class="w-full rounded-lg bg-white text-black py-2.5 px-3 shadow-sm sm:text-sm"
                                        required>{{ $item->description }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="capaian_proses-{{ $item->id }}" class="block text-sm font-medium text-gray-700">Capaian Pelajaran:</label>
                                    <textarea id="capaian_proses-{{ $item->id }}" name="capaian_proses"
                                        class="w-full rounded-lg bg-white text-black py-2.5 px-3 shadow-sm sm:text-sm"
                                        required>{{ $item->capaian_proses }}</textarea>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">Simpan</button>
                                    <button type="button" onclick="toggleEdit('{{ $item->id }}')"
                                        class="ml-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Batal</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    <tr id="delete-{{ $item->id }}" class="hidden">
                        <td colspan="2" class="px-4 py-4">
                            <div class="p-4 border-t border-gray-200">
                                <p>Apakah Anda yakin ingin menghapus proyek ini?</p>
                                <form action="{{ route('delete.project.p5', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Ya, Hapus</button>
                                    <button type="button" onclick="toggleDelete('{{ $item->id }}')" class="text-gray-500">Batal</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
      
    </div>
    @endforeach

    <script>
        function toggleDetails(id) {
            var detailsRow = document.getElementById('details-' + id);
            if (detailsRow.classList.contains('hidden')) {
                detailsRow.classList.remove('hidden');
            } else {
                detailsRow.classList.add('hidden');
            }
        }
        function toggleEdit(id) {
            var editRow = document.getElementById('edit-' + id);
            if (editRow.classList.contains('hidden')) {
                editRow.classList.remove('hidden');
            } else {
                editRow.classList.add('hidden');
            }
        }
        function toggleDelete(id) {
            var editRow = document.getElementById('delete-' + id);
            if (editRow.classList.contains('hidden')) {
                editRow.classList.remove('hidden');
            } else {
                editRow.classList.add('hidden');
            }
        }
    </script>
@endsection
