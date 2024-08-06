@extends('component.layout')

@section('content')

<form action="{{ route('show.raport.bysemester') }}" method="GET" class="mb-8">
    <label for="semester" class="block text-lg font-medium text-gray-700">Pilih Semester</label>
    <select id="semester" name="semester" class="form-select mt-1 block w-full">
        @foreach ($semesters as $semester)
            <option value="{{ $semester->id }}" {{ request('semester') == $semester->id ? 'selected' : '' }}>
                {{ $semester->semester }}
            </option>
        @endforeach
    </select>

    <label for="tahunajaran" class="block text-lg font-medium text-gray-700 mt-4">Pilih Tahun Ajaran</label>
    <select id="tahunajaran" name="tahunajaran" class="form-select mt-1 block w-full">
        @foreach ($tahunajarans as $tahunajaran)
            <option value="{{ $tahunajaran->id }}" {{ request('tahunajaran') == $tahunajaran->id ? 'selected' : '' }}>
                {{ $tahunajaran->tahun_ajaran }}
            </option>
        @endforeach
    </select>
    
    <input type="hidden" name="student_id" value="{{ $student->id }}">
    <button type="submit" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Tampilkan
    </button>
</form>

<div class="flex flex-col items-center justify-start h-screen mt-8">
    <h1 class="mb-4 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl lg:text-4xl">
        LAPORAN HASIL BELAJAR
    </h1>
    <h3 class="mb-8 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl lg:text-4xl">
        (RAPORT)
    </h3>

    <div class="max-w-screen-xl w-full mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-20 mt-8">
        <div class="flex flex-col">
            <div class="relative overflow-x-auto bg-white dark:bg-white">
                <table class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                    <tbody>
                        <tr>
                            <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                Nama Peserta Didik <span class="float-right">:</span>
                            </td>
                            <td class="px-4 py-2 text-left">
                                {{ $student->nama_lengkap }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                NISN <span class="float-right">:</span>
                            </td>
                            <td class="px-4 py-2 text-left">
                                {{ $student->nisn }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                Sekolah <span class="float-right">:</span>
                            </td>
                            <td class="px-4 py-2 text-left">
                                SDN 3 Sungai Tiung
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                Alamat <span class="float-right">:</span>
                            </td>
                            <td class="px-4 py-2 text-left">
                                Sungai Tiung
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="relative overflow-x-auto bg-white dark:bg-white">
                <table class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                    <tbody>
                        @if($dataRaports->count() > 0)
                            @php
                                $dataRaport = $dataRaports->first();
                            @endphp
                            <tr>
                                <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Kelas <span class="float-right">:</span>
                                </td>
                                <td class="px-4 py-2 text-left">
                                    @if($dataRaport->id_kelas == 1)
                                        1 ( Satu )
                                    @elseif($dataRaport->id_kelas == 2)
                                        2 ( Dua )
                                    @elseif($dataRaport->id_kelas == 3)
                                        3 ( Tiga )
                                    @elseif($dataRaport->id_kelas == 4)
                                        4 ( Empat )
                                    @elseif($dataRaport->id_kelas == 5)
                                        5 ( Lima )
                                    @elseif($dataRaport->id_kelas == 6)
                                        6 ( Enam )
                                    @else
                                        {{ $dataRaport->id_kelas }}
                                    @endif
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                Fase <span class="float-right">:</span>
                            </td>
                            <td class="px-4 py-2 text-left">
                               
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                Semester <span class="float-right">:</span>
                            </td>
                            <td class="px-4 py-2 text-left">
                                {{ $dataRaport->semester->semester ?? 'Belum Ada Data' }}
                            </td>
                        </tr>
                        @if($dataRaports->count() > 0)
                            <tr>
                                <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Tahun Ajaran <span class="float-right">:</span>
                                </td>
                                <td class="px-4 py-2 text-left">
                                    {{ $dataRaport->tahunAjaran->tahun_ajaran ?? 'Belum Ada Data' }}
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Tahun Ajaran <span class="float-right">:</span>
                                </td>
                                <td class="px-4 py-2 text-left">
                                    Belum Ada Data
                                </td>
                            </tr>
                        @endif
                        
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <table class="w-full mt-10 mx-auto text-sm text-left text-gray-900 dark:text-black dark:bg-white border-collapse">
        <thead>
            <tr class="bg-gray-200 dark:bg-gray-200">
                <th class="px-6 py-3">No</th>
                <th class="px-6 py-3">Mata Pelajaran</th>
                <th class="px-6 py-3">Nilai</th>
                <th class="px-6 py-3">Kelebihan Kompetensi</th>
                <th class="px-6 py-3">Kekurangan Kompetensi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $nomor = 1;
            @endphp
            @foreach($dataRaports as $dataRaport)
            <tr class="bg-white border-b dark:bg-white">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $nomor++ }}
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $dataRaport->mapel->nama_pelajaran ?? 'Mata Pelajaran Tidak Ditemukan' }}
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $dataRaport->nilai }}
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $dataRaport->kelebihan_kompetensi }}
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $dataRaport->kekurangan_kompetensi }}
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
                <th class="px-4 py-2 border border-gray-300" style="width: 10%;">predikat</th>
                <th class="px-4 py-2 border border-gray-300" style="width: 60%;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $nomor = 1;
            @endphp
            @foreach($dataekskul as $raport)
            <tr>
                <td class="px-4 py-2 border border-gray-300"> {{ $nomor++ }}</td>
                <td class="px-4 py-2 border border-gray-300">  
                    {{ $raport->ekstrakulikuler->ekstrakulikuler ?? 'Mata Pelajaran Tidak Ditemukan' }}
                </td>
                </td>
                <td class="px-4 py-2 border border-gray-300"> {{ $raport->predikat }}

                </td>
                <td class="px-4 py-2 border border-gray-300"> {{ $raport->keterangan }}

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="max-w-screen-xl w-full mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-20 mt-8">
        <div class="flex flex-col">
            <div class="relative overflow-x-auto bg-white dark:bg-white">
                <table class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                    <tbody>
                        @foreach($datahadir as $hadir)
                        <tr>
                            <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                Sakit <span class="float-right">:</span>
                            </td>
                            <td class="px-4 py-2 text-left">
                                {{ $hadir->sakit  ?? 'ekstrakulikuler Tidak Ditemukan'}} Hari
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                Izin <span class="float-right">:</span>
                            </td>
                            <td class="px-4 py-2 text-left">
                                {{ $hadir->izin  ?? ' ekstrakulikuler Tidak Ditemukan'}} Hari
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                Alpha <span class="float-right">:</span>
                            </td>
                            <td class="px-4 py-2 text-left">
                                {{ $hadir->alpha  ?? ' ekstrakulikuler Tidak Ditemukan'}} Hari
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="relative overflow-x-auto bg-white dark:bg-white">
                <table class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                    <tbody>
                        <tr>
                            <td class="px-4 py-2 text-left">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dictum metus quis orci gravida.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 text-left">
                                Naik kelas : 3 (Tiga)
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

    <div class="max-w-screen-xl w-full mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-20 mt-8">
        <div class="flex flex-col">
            <div class="relative overflow-x-auto bg-white dark:bg-white">
                <table class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                    <tbody>
                        <tr>
                            <td class="px-4 py-2 ">
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                Orang Tua/Wali
                            </td>
                        </tr>

                        <tr>
                            <td class="px-4 py-2 ">
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 ">
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 ">
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 ">
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 ">
                                __________________________
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex flex-col md:col-start-2 md:col-span-1 lg:col-start-3 lg:col-span-1">
            <div class="relative overflow-x-auto bg-white dark:bg-white">
                <table class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                    <tbody>
                        <tr>
                            <td class="px-10 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                Kota Banjarbaru,
                            </td>
                            <td class="px-4 py-2 text-left"></td>
                        </tr>
                        <tr>
                            <td class="px-10 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                Wali Kelas
                            </td>
                            <td class="px-4 py-2 text-left"></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 ">
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 ">
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 ">
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 ">
                                _______________________________
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 ">
                                NIP
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div >
            <div class="relative overflow-x-auto bg-white dark:bg-white">
                <table class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                    <tbody>
                        <tr>
                            <td class="px-10 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                               Mengetahui,
                            </td>
                            <td class="px-4 py-2 text-left"></td>
                        </tr>
                        <tr>
                            <td class="px-10 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                Kepala Sekolah
                            </td>
                            <td class="px-4 py-2 text-left"></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 ">
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 ">
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 ">
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 ">
                                _______________________________
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 ">
                                NIP
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
