@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Input Raport
        </h1>

        <div>
            <form id="filter-form" method="GET" action="{{ route('filter.raport') }}">
                @csrf
                <div class=" mb-2 ">
                    <div class="mb-2">
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
                    <div class=" mb-2">
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
                <div class=" mb-6 ">
                    
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

        @php
            $isFilterSelected = request()->input('id_kelas') && request()->input('id_tahun_ajar') && request()->input('id_semester');
        @endphp

        @if($isFilterSelected)
            {{-- table 1 --}}
            <div class="relative overflow-x-auto my-2 shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Nisn</th>
                            <th scope="col" class="px-6 py-3">Nama Siswa</th>
                            <th scope="col" class="px-6 py-3">kelas saat ini</th>
                            <th scope="col" class="px-6 py-3 text-center">Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $nomor = 1;
                        @endphp
                        @foreach ($siswas as $item)
                            <tr class="bg-white border dark:bg-white">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $nomor++ }}
                                </td>
                                <td class="px-6 py-4">{{ $item->nisn }}</td>
                                <td class="px-6 py-4">{{ $item->nama_lengkap }}</td>
                                <td class="px-6 py-4"> {{ $item->id_kelas_now }}</td>
                                
                                <td class="px-6 py-4 text-center">
                                    @include('component.user.btn-view-raport')

                                    <button type="button" onclick="toggleAdd('{{ $item->id }}')"
                                        class="inline-block px-4 py-2 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg">
                                        Add Kehadiran
                                    </button>
                                    @include('component.user.modal-add-kehadiran')

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="flex justify-center mt-8">
                <p class="text-xl font-semibold text-gray-700">Pilih filter terlebih dahulu untuk menampilkan data.</p>
            </div>
        @endif
    </div>
@endsection

<script>
    function submitForm() {
        document.getElementById('filter-form').submit();
    }

    function toggleAdd(id) {
     
        const idKelas = document.getElementById('id_kelas').value;
        const idTahunAjar = document.getElementById('id_tahun_ajar').value;
        const idSemester = document.getElementById('id_semester').value;

       
        document.getElementById('modal-id-kelas').value = idKelas;
        document.getElementById('modal-id-tahun-ajar').value = idTahunAjar;
        document.getElementById('modal-id-siswa').value = id;
        document.getElementById('modal-id-semester').value = idSemester;

 
        document.getElementById('crud-modal').classList.remove('hidden');
    }

 
    function closeModal() {
        document.getElementById('crud-modal').classList.add('hidden');
    }

    
    document.getElementById('close-modal').addEventListener('click', closeModal);

 
    document.getElementById('crud-modal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeModal();
        }
    });
</script>
