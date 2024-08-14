@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Data Raport {{ $kelas->nama_kelas }}
        </h1>
        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl">
            Wali Kelas : {{ $kelas->walikelas->nama }}
        </p>


        <form id="filter-form" action="{{ route('filter.raport') }}" method="GET" class="mb-8 ">
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

            <input type="hidden" name="filter_action" value="1">
        </form>
        <!-- Tabel Data Siswa -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">NISN</th>
                        <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                        <th scope="col" class="px-6 py-3">keterangan</th>
                        <th scope="col" class="px-6 py-3">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswa as $item)
                        <tr class="odd:bg-white even:bg-gray-50 border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $item->nisn }}
                            </th>
                            <td class="px-6 py-4">{{ $item->nama_lengkap }}</td>
                            <td class="px-6 py-4"> 
                                @php
                                // Cari ket yang sesuai dengan nama siswa saat ini
                                $ketRapor = $keteranganraport->firstWhere('id_siswa', $item->id);
                            @endphp
                                @if ($ketRapor)
                                    {{ $ketRapor->keterangan }}
                                @else
                                    Belum ada nilai
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @include('component.user.btn-view-raport')
                            </td>
                        </tr>
                    @endforeach
                    {{-- Baris untuk tombol download, jika diperlukan
                    <tr>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        </th>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4">
                            <button type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                                Download
                            </button>
                        </td>
                    </tr>
                    --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
<script>
       function submitForm() {
        document.getElementById('filter-form').submit();
    }

</script>