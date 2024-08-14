@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-10 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Input TP/CP
        </h1>
        <div class="rounded-lg lg:col-span-2">
          
            <form id="filter-form" method="GET" action="{{ route('show.tpcp.byFilter') }}">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="id_kelas" class="block mb-2 text-sm font-medium text-gray-900">Pilih Kelas</label>
                        <select id="id_kelas" name="id_kelas"
                            class="w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5"
                            onchange="submitForm()">
                            <option value="">--PILIH KELAS--</option>
                            @foreach ($clases as $kls)
                                <option value="{{ $kls->id }}"
                                    {{ request()->input('id_kelas') == $kls->id ? 'selected' : '' }}>
                                    {{ $kls->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="id_semester" class="block mb-2 text-sm font-medium text-gray-900">Pilih Semester</label>
                        <select id="id_semester" name="id_semester"
                            class="w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5"
                            onchange="submitForm()">
                            <option value="">--PILIH SEMESTER--</option>
                            @foreach ($semesters as $smt)
                                <option value="{{ $smt->id }}"
                                    {{ request()->input('id_semester') == $smt->id ? 'selected' : '' }}>
                                    {{ $smt->semester }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Hidden input to pass the selected IDs -->
                <input type="hidden" name="filter_action" value="1">
            </form>
        </div>

        {{-- table --}}
        @php
            $idKelas = request()->input('id_kelas');
            $idSemester = request()->input('id_semester');
        @endphp

        @if ($idKelas && $idSemester)
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-8">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Mata Pelajaran</th>
                            <th scope="col" class="px-6 py-3  text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nomor = 1;
                        @endphp
                        @foreach ($mapel as $item)
                            <tr class="bg-white border-t">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $nomor++ }}
                                </td>
                                <td class="px-6 py-4">{{ $item->nama_pelajaran }}</td>
                                <td class="px-6 py-4 text-right">
                                    @php
                                        $capaian = $filteredCpData->firstWhere('id_mapel', $item->id);
                                    @endphp
                                    <div class="flex justify-center space-x-2">
                                        @if ($capaian)
                                            <button type="button" onclick="toggleDetails('{{ $capaian->id }}')"
                                                class="inline-block px-4 py-2 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg">
                                                View
                                            </button>
                                            <button type="button" onclick="toggleEdit('{{ $capaian->id }}')"
                                                class="inline-block px-4 py-2 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg">
                                                Edit
                                            </button>
                                         
                                        @else
                                            <a href="{{ route('index.input.tpcp', $item->id) }}"
                                                class="inline-block px-4 py-2 text-sm font-medium text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 rounded-lg">
                                                Add
                                            </a>
                                        @endif
                                    </div>
                                </td>

                            </tr>
                            <tr id="details-{{ $capaian ? $capaian->id : 'none' }}" class="hidden">
                                <td colspan="3" class="px-4 py-4">
                                    <div class="p-4 border-t border-gray-200">
                                        @if ($capaian)
                                            <p><strong>Capaian Pelajaran:</strong> {{ $capaian->CP }}</p>
                                        @else
                                            <p><strong>Capaian Pelajaran:</strong> Belum ada data</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr id="edit-{{ $capaian ? $capaian->id : 'none' }}" class="hidden">
                                <td colspan="3" class="px-4 py-4">
                                    <form method="POST" action="{{ route('update.tpcp', $capaian ? $capaian->id : $item->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-4">
                                            <label for="capaian_proses-{{ $capaian ? $capaian->id : 'none' }}" class="block text-sm font-medium text-gray-700">Capaian Pelajaran:</label>
                                            <textarea id="capaian_proses-{{ $capaian ? $capaian->id : 'none' }}" name="capaian_proses"
                                                class="w-full rounded-lg bg-white text-black py-2.5 px-3 shadow-sm sm:text-sm"
                                                required>{{ $capaian ?  $capaian->CP: '' }}</textarea>
                                        </div>
                                        <div class="mb-4">
                                            <label for="lingkup_materi-{{ $capaian ? $capaian->id : 'none' }}" class="block text-sm font-medium text-gray-700">Lingkup Materi:</label>
                                            <textarea id="lingkup_materi-{{ $capaian ? $capaian->id : 'none' }}" name="lingkup_materi"
                                                class="w-full rounded-lg bg-white text-black py-2.5 px-3 shadow-sm sm:text-sm"
                                                required>{{ $capaian ? $capaian->lingkup_materi : '' }}</textarea>
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="submit"
                                                class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">Simpan</button>
                                            <button type="button" onclick="toggleEdit('{{ $capaian ? $capaian->id : 'none' }}')"
                                                class="ml-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Batal</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            
                        @endforeach
                        <tr>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            </th>
                            <td class="px-6 py-4"></td>
                            <td class="px-6 py-4 text-right">
                                <button type="button" id="download-btn"
                                  onclick="printPage('{{ route('download.data.tpcp', ['idKelas' => $idKelas, 'idSemester' => $idSemester]) }}')"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                                Print
                            </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center text-red-700 my-8">
                Pilih filter terlebih dahulu untuk menampilkan data.
            </div>
        @endif
    </div>
@endsection

<script>
    function submitForm() {
        document.getElementById('filter-form').submit();
    }

    function toggleDetails(id) {
        if (id === 'none') {
            alert('Belum ada data untuk ditampilkan.');
            return;
        }

        const detailRow = document.getElementById(`details-${id}`);
        if (detailRow.classList.contains('hidden')) {
            detailRow.classList.remove('hidden');
        } else {
            detailRow.classList.add('hidden');
        }
    }
    function toggleEdit(id) {
    // Mencari elemen baris edit berdasarkan ID
    const editRow = document.getElementById('edit-' + id);
    
    // Jika elemen editRow ditemukan, toggle visibility-nya
    if (editRow) {
        // Mengecek apakah baris editRow saat ini tersembunyi atau tidak
        if (editRow.classList.contains('hidden')) {
            // Menampilkan baris edit
            editRow.classList.remove('hidden');
        } else {
            // Menyembunyikan baris edit
            editRow.classList.add('hidden');
        }
    }
    
    // Menyembunyikan baris detail jika ditampilkan
    const detailsRow = document.getElementById('details-' + id);
    if (detailsRow) {
        detailsRow.classList.add('hidden');
    }
}

    function printPage(url) {
            var printWindow = window.open(url, '_blank');
            printWindow.onload = function() {
                printWindow.print();
            };
        }
</script>
