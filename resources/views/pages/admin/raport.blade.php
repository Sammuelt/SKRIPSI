@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <div class="mx-auto max-w-screen-xl p-4 sm:px-6 lg:px-8">
            <header class="text-center">
                <h2 class="text-4xl font-extrabold text-gray-900 md:text-5xl lg:text-6xl">Data Raport</h2>
                {{-- <p class="my-4 text-lg font-normal text-gray-500 lg:text-xl">
                    Silahkan Pilih Jenis Raport
                </p> --}}
            </header>
        </div>

        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl">
            Silahkan pilih Kelas, Semester, Tahun Ajaran, dan Nama siswa untuk menampilkan data....
        </p>

        <form id="filter-form" method="GET" action="{{ route('index.raport') }}">
            @csrf
           
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
                <label for="id_tahun_ajar" class="block mb-2 text-sm font-medium text-gray-900">Pilih Tahun Ajaran</label>
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

           
  
            <!-- Hidden input to pass the selected IDs -->
            <input type="hidden" name="filter_action" value="1">
        </form>

        @if(request()->has('id_kelas') && request()->has('id_tahun_ajar') && request()->has('id_semester') )
            @if(count($siswas) > 0)
                <div class="relative overflow-x-auto my-2 shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">NISIN</th>
                                <th scope="col" class="px-6 py-3">Nama Siswa</th>
                                <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
                                <th scope="col" class="px-6 py-3">Opsi</th>
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
                                    <td class="px-6 py-4">{{ $item->siswa->nisn }}</td>
                                    <td class="px-6 py-4">{{ $item->siswa->nama_lengkap }}</td>
                                    <td class="px-6 py-4">
                                        {{ $item->siswa->jenis_kelamin }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @include('component.admin.btn-group-raport')
                                    </td>
                                </tr>  
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center mt-6 text-lg font-medium text-gray-500">
                    Data tidak ditemukan / belum ada.
                </div>
            @endif
        @else
            <div class="text-center mt-6 text-lg font-medium text-gray-500">
                Pilih filter terlebih dahulu.
            </div>
        @endif
    </div>
@endsection

<script>
    function submitForm() {
        document.getElementById('filter-form').submit();
    }
</script>
