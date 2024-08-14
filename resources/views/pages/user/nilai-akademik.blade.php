@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-10 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Input Nilai Mata Pelajaran
        </h1>
    
        <div>
            <form id="filter-form" method="GET" action="{{ route('filter.siswa') }}">
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
                        <label for="id_tahun_ajar" class="block mb-2 text-sm font-medium text-gray-900">Pilih Tahun
                            Ajaran</label>
                        <select id="id_tahun_ajar" name="id_tahun_ajar"
                            class="w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5"
                            onchange="submitForm()">
                            <option value="">--PILIH TAHUN AJARAN--</option>
                            @foreach ($tahunajarans as $TA)
                                <option value="{{ $TA->id }}"
                                    {{ request()->input('id_tahun_ajar') == $TA->id ? 'selected' : '' }}>
                                    {{ $TA->tahun_ajaran }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="id_siswa" class="block mb-2 text-sm font-medium text-gray-900">Pilih Siswa</label>
                        <select id="id_siswa" name="id_siswa"
                            class="w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5"
                            onchange="submitForm()">
                            <option value="">--PILIH NAMA SISWA--</option>
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->id }}"
                                    {{ request()->input('id_siswa') == $siswa->id ? 'selected' : '' }}>
                                    {{ $siswa->nama_lengkap }}
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

        {{-- Tampilkan tabel hanya jika filter sudah dipilih --}}
        @php
            $idKelas = request()->input('id_kelas');
            $idTahunAjar = request()->input('id_tahun_ajar');
            $idSiswa = request()->input('id_siswa');
            $idSemester = request()->input('id_semester');
        @endphp

        @if ($idKelas && $idTahunAjar && $idSiswa && $idSemester)
            <div class="relative overflow-x-auto my-2 shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Mata Pelajaran</th>
                            <th scope="col" class="px-6 py-3">Nilai</th>
                            <th scope="col" class="px-6 py-3">Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $nomor = 1;
                        @endphp
                        @foreach ($mapel as $item)
                            <tr class="bg-white border dark:bg-white">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $nomor++ }}
                                </td>
                                <td class="px-6 py-4">{{ $item->nama_pelajaran }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        // Cari nilai rapor yang sesuai dengan mata pelajaran saat ini
                                        $nilaiRapor = $nilai->firstWhere('id_mapel', $item->id);
                                    @endphp
                                    @if ($nilaiRapor)
                                        {{ $nilaiRapor->nilai }}
                                    @else
                                        Belum ada nilai
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($nilaiRapor)
                                        <button onclick="toggleDetails('{{ $item->id }}')"
                                            class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
                                            View
                                        </button>
                                        <button id="edit-modal" type="button"
                                            class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative"
                                            onclick="openEditModal(
                                                '{{ $item->id }}',
                                                '{{ $nilaiRapor->id }}',
                                                '{{ $nilaiRapor->id_siswa }}',
                                                '{{ $nilaiRapor->id_kelas }}',
                                                '{{ $nilaiRapor->id_semester }}',
                                                '{{ $nilaiRapor->id_tahun_ajar }}',
                                                '{{ $nilaiRapor->id_mapel }}',
                                                '{{ $nilaiRapor->nilai }}',
                                                '{{ $nilaiRapor->kekurangan_kompetensi }}',
                                                '{{ $nilaiRapor->kelebihan_kompetensi }}',
                                                '{{ $nilaiRapor->keterangan }}'
                                        )">
                                            Edit
                                        </button>
                                        @include('component.user.modal-edit-nilai-akademik')
                                    @else
                                        @include('component.user.btn-add-akademik')

                                </td>
                        @endif

                        </td>
                        </tr>
                        <tr id="details-{{ optional($item)->id }}" class="hidden dark:bg-gray-200">
                            <td colspan="4" class="px-4 py-4">
                                <div class="grid grid-cols-2 gap-4 border-gray-200">
                                    <div class="text-center pr-4 border-r border-gray-300">
                                        @php
                                            $cpDetail = $nilai->where('id_mapel', optional($item)->id)->first();
                                        @endphp
                                        @if ($cpDetail && $cpDetail->kelebihan_kompetensi)
                                            <p><strong>Kelebihan Kompetensi</strong></p>
                                            <p class="px-8">{{ $cpDetail->kelebihan_kompetensi }}</p>
                                        @else
                                            <p><strong>Kelebihan Kompetensi</strong></p>
                                            <p class="px-8">Belum ditambahkan</p>
                                        @endif
                                    </div>
                                    <div class="text-center pl-4">
                                        @if ($cpDetail && $cpDetail->kekurangan_kompetensi)
                                            <p><strong>Kekurangan Kompetensi</strong></p>
                                            <p class="px-8">{{ $cpDetail->kekurangan_kompetensi }}</p>
                                        @else
                                            <p><strong>Kekurangan Kompetensi</strong></p>
                                            <p>Belum ditambahkan</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
        @endforeach
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
        const detailRow = document.getElementById(`details-${id}`);
        if (detailRow.classList.contains('hidden')) {
            detailRow.classList.remove('hidden');
        } else {
            detailRow.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('crud-modal');
        const modalTitle = modal.querySelector('#nama-pelajaran');
        const modalForm = modal.querySelector('form');

        document.querySelectorAll('[data-modal-toggle="crud-modal"]').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const namaPelajaran = this.closest('tr').querySelector('td:nth-child(2)')
                    .textContent.trim();

                // Ambil data dari filter
                const idKelas = document.getElementById('id_kelas').value;
                const idTahunAjar = document.getElementById('id_tahun_ajar').value;
                const idSiswa = document.getElementById('id_siswa').value;
                const idSemester = document.getElementById('id_semester').value;

                // Isi modal
                modalTitle.textContent = namaPelajaran;
                modalForm.querySelector('input[name="id_mapel"]').value = id;
                modalForm.querySelector('#modal-id-tahun-ajar').value = idTahunAjar;
                modalForm.querySelector('#modal-id-semester').value = idSemester;
                modalForm.querySelector('#modal-id-siswa').value = idSiswa;
                modalForm.querySelector('#modal-id-kelas').value = idKelas;

                // Tampilkan modal
                modal.classList.remove('hidden');

                // Tampilkan detail untuk mata pelajaran yang dipilih
                toggleDetails(id);
            });
        });

        // Close modal functionality
        modal.querySelector('.modal-close').addEventListener('click', function() {
            modal.classList.add('hidden');
        });

        // Optional: Close modal when clicking outside of it
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });




    function openEditModal(itemId, nilaiRaporId, idSiswa, idKelas, idSemester, idTahunAjar, idMapel, nilai,
        kekuranganKompetensi, kelebihanKompetensi, keterangan) {

        document.getElementById('nilaiRaporId').value = nilaiRaporId;
        document.getElementById('idSiswa').value = idSiswa;
        document.getElementById('idKelas').value = idKelas;
        document.getElementById('idSemester').value = idSemester;
        document.getElementById('idTahunAjar').value = idTahunAjar;
        document.getElementById('idMapel').value = idMapel;
        document.getElementById('nilai').value = nilai;
        document.getElementById('kekuranganKompetensi').value = kekuranganKompetensi;
        document.getElementById('kelebihanKompetensi').value = kelebihanKompetensi;
        document.getElementById('keterangan').value = keterangan;
        // Show the modal
        document.getElementById('edit-modal').classList.add('block');
        document.getElementById('edit-modal').classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.querySelector('.modal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>
