@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <div class="mx-auto max-w-screen-xl p-4 sm:px-6 lg:px-8">
            <header class="text-center">
                <h2 class="text-4xl font-extrabold text-gray-900 md:text-5xl lg:text-6xl">Data Raport {{ $idsiswa->nama_lengkap }}</h2>
            </header>
        </div>

        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl">
            Silahkan pilih Kelas, Semester, Tahun Ajaran, dan Nama siswa untuk menampilkan data....
        </p>

        <form id="filter-form" method="GET" action="{{ route('wali.raport.akademik') }}">
            @csrf
           
            <div>
                <label for="id_kelas" class="block mb-2 text-sm font-medium text-gray-900">Pilih Kelas</label>
                <select id="id_kelas" name="id_kelas"
                    class="w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5"
                    onchange="submitForm()">
                    <option value="">--PILIH KELAS--</option>
                    @foreach ($clases as $kls)
                        <option value="{{ $kls->id }}" {{ request()->input('id_kelas') == $kls->id ? 'selected' : '' }}>
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
                        <option value="{{ $TA->id }}" {{ request()->input('id_tahun_ajar') == $TA->id ? 'selected' : '' }}>
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
                        <option value="{{ $smt->id }}" {{ request()->input('id_semester') == $smt->id ? 'selected' : '' }}>
                            {{ $smt->semester }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Hidden input to pass the selected IDs -->
            <input type="hidden" name="filter_action" value="1">
        </form>

        @if(request()->input('id_kelas') && request()->input('id_tahun_ajar') && request()->input('id_semester'))
            @if($dataRaport->isNotEmpty())
                <div class="flex flex-col items-center justify-start h-screen mt-8">
                    <h1 class="mb-4 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl lg:text-4xl">
                        LAPORAN HASIL BELAJAR
                    </h1>
                    <h3 class="mb-8 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl lg:text-4xl">
                        (RAPORT)
                    </h3>
            
                    <div class="max-w-screen-xl w-full mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-20 mt-8">
                        <div class="flex flex-col">
                            <div class="relative overflow-x-auto bg-white">
                                <table class="w-full mx-auto text-sm text-left text-gray-900 border-collapse">
                                    <tbody>
                                        @php
                                            // Ambil data pertama jika dataRaport bukan array kosong
                                            $firstRaport = $dataRaport->first();
                                        @endphp
                                        <tr>
                                            <td class="px-4 md:px-8 font-medium whitespace-nowrap">Nama Peserta Didik <span class="float-right">:</span></td>
                                            <td class="px-4 py-2 text-left">{{ $firstRaport->siswa->nama_lengkap }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 md:px-8 font-medium whitespace-nowrap">NISN <span class="float-right">:</span></td>
                                            <td class="px-4 py-2 text-left">{{ $firstRaport->siswa->nisn }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 md:px-8 font-medium whitespace-nowrap">Sekolah <span class="float-right">:</span></td>
                                            <td class="px-4 py-2 text-left">SDN 3 Sungai Tiung</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 md:px-8 font-medium whitespace-nowrap">Alamat <span class="float-right">:</span></td>
                                            <td class="px-4 py-2 text-left">Sungai Tiung</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    
                        <div class="flex flex-col">
                            <div class="relative overflow-x-auto bg-white">
                                <table class="w-full mx-auto text-sm text-left text-gray-900 border-collapse">
                                    <tbody>
                                        @php
                                            // Ambil data pertama jika dataRaport bukan array kosong
                                            $firstRaport = $dataRaport->first();
                                        @endphp
                                        <tr>
                                            <td class="px-4 md:px-8 font-medium whitespace-nowrap">Kelas <span class="float-right">:</span></td>
                                            <td class="px-4 py-2 text-left">{{ $firstRaport->kelas->nama_kelas }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 md:px-8 font-medium whitespace-nowrap">Fase <span class="float-right">:</span></td>
                                            <td class="px-4 py-2 text-left">-</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 md:px-8 font-medium whitespace-nowrap">Semester <span class="float-right">:</span></td>
                                            <td class="px-4 py-2 text-left">{{ $firstRaport->semester->semester ?? 'Belum Ada Data' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 md:px-8 font-medium whitespace-nowrap">Tahun Ajaran <span class="float-right">:</span></td>
                                            <td class="px-4 py-2 text-left">{{ $firstRaport->tahunAjaran->tahun_ajaran ?? 'Belum Ada Data' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="max-w-screen-xl w-full mx-auto ">
                        <table class="w-full mt-10 mx-auto text-sm text-left text-gray-900 dark:text-black dark:bg-white border-collapse">
                            <thead class="text-center">
                                <tr class="bg-gray-200 dark:bg-gray-200">
                                    <th class="px-6 py-3">No</th>
                                    <th class="px-6 py-3">Mata Pelajaran</th>
                                    <th class="px-6 py-3">Nilai</th>
                                    <th class="px-6 py-3">Capaian Kompetensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nomor = 1;
                                @endphp
                                @foreach ($dataRaport as $dataRaport)
                                    <tr class="bg-white dark:bg-white border border-gray-300">
                                        <td class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap">
                                            {{ $nomor++ }}
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $dataRaport->mapel->nama_pelajaran ?? 'Mata Pelajaran Tidak Ditemukan' }}
                                        </td>
                                        <td class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap">
                                            {{ $dataRaport->nilai }}
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-justify break-words">
                                            <div class="mb-2">
                                              {{$dataRaport->kelebihan_kompetensi }}
                                            </div>
                                            <hr class="border-t border-gray-400 my-2">
                                            <div>
                                                {{$dataRaport->kekurangan_kompetensi}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        
            
                        <p class="px-3 py-5 font-medium whitespace-nowrap bg-white dark:text-black">EKSTRAKULIKULER</p>
                        <table class="w-full border-collapse">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 border border-gray-300" style="width: 5%;">No</th>
                                    <th class="px-4 py-2 border border-gray-300" style="width: 25%;">Ekstrakulikuler</th>
                                    <th class="px-4 py-2 border border-gray-300" style="width: 10%;">Predikat</th>
                                    <th class="px-4 py-2 border border-gray-300" style="width: 60%;">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nomor = 1;
                                @endphp
                                @forelse ($dataekskuls as $raport)
                                    <tr>
                                        <td class="px-4 py-2 border border-gray-300">{{ $nomor++ }}</td>
                                        <td class="px-4 py-2 border border-gray-300">
                                            {{ $raport->ekstrakulikuler->ekstrakulikuler ?? '0' }}</td>
                                        <td class="px-4 py-2 border border-gray-300">{{ $raport->predikat ?? '0' }}</td>
                                        <td class="px-4 py-2 border border-gray-300">{{ $raport->keterangan ?? '0' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-4 py-2 border border-gray-300">{{ $nomor++ }}</td>
                                        <td class="px-4 py-2 border border-gray-300">
                                            Belum ada data</td>
                                        <td class="px-4 py-2 border border-gray-300">
                                            Belum ada data</td>
                                        <td class="px-4 py-2 border border-gray-300">
                                            Belum ada data</td>
            
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="max-w-screen-xl w-full mx-auto">
                            <div class="max-w-screen-xl w-full mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-20 mt-8 mb-20">
                                <div class="flex flex-col">
                                    <div class="relative overflow-x-auto bg-white dark:bg-white">
                                        <table
                                            class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                                            <tbody>
                                                @forelse ($datahadir as $hadir)
                                                    <tr>
                                                        <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                                            Sakit <span class="float-right">:</span>
                                                        </td>
                                                        <td class="px-4 py-2 text-left">
                                                            {{ $hadir->sakit ?? '0' }} Hari
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                                            Izin <span class="float-right">:</span>
                                                        </td>
                                                        <td class="px-4 py-2 text-left">
                                                            {{ $hadir->izin ?? '0' }} Hari
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                                            Alpha <span class="float-right">:</span>
                                                        </td>
                                                        <td class="px-4 py-2 text-left">
                                                            {{ $hadir->alpha ?? '0' }} Hari
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                                            Sakit <span class="float-right">:</span>
                                                        </td>
                                                        <td class="px-4 py-2 text-left">
                                                            0 Hari
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                                            Izin <span class="float-right">:</span>
                                                        </td>
                                                        <td class="px-4 py-2 text-left">
                                                            0 Hari
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                                            Alpha <span class="float-right">:</span>
                                                        </td>
                                                        <td class="px-4 py-2 text-left">
                                                            0 Hari
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="relative overflow-x-auto bg-white dark:bg-white">
                                        <table
                                            class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                                            <tbody>
                                                @if ($idSemester == 1)
                                                <tr>
                                                    <td class="px-4 py-2 text-left">
                                                        Berdasarkan pencapaian tujuan pembelajaran pada semester ganjil, peserta didik ditetapkan :
                                                    </td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td class="px-4 py-2 text-left">
                                                        Berdasarkan pencapaian tujuan pembelajaran pada semester ganjil dan genap, peserta didik ditetapkan :
                                                    </td>
                                                </tr>
                                            @endif
                                            
                                                
                                                <tr>
                                                    <td class="px-4 py-2 text-left">
                                                        Naik kelas : 3 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="px-4 py-2 text-left">
                                                        Tinggal kelas :
                                                    </td>
                                                </tr>
                    
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                    </div>
                </div>
            @else
                <div class="flex flex-col items-center justify-start h-screen mt-8">
                    <p class="text-xl text-red-500">Data belum tersedia untuk filter yang dipilih.</p>
                </div>
            @endif
        @else
            <div class="flex flex-col items-center justify-start h-screen mt-8">
                <p class="text-xl text-red-500">Silahkan pilih semua filter untuk menampilkan laporan.</p>
            </div>
        @endif
    </div>

    <script>
        function submitForm() {
            document.getElementById('filter-form').submit();
        }
    </script>
@endsection
