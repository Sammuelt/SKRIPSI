@extends('component.layout')

@section('content')
<form action="{{ route('show.raport.BySemesterMbkm') }}" method="GET" class="mb-8">
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
        RAPOR PROYEK PENGUATAN
    </h1>
    <h3 class="mb-8 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl lg:text-4xl">
        PROFIL PELAJAR PANCASILA
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
                                Jl. Contoh No. 123, Kota Contoh
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
                        @if($dataRaports->isNotEmpty())
                            @php
                                $dataRaport = $dataRaports->first();
                            @endphp
                            <tr>
                                <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Kelas <span class="float-right">:</span>
                                </td>
                                <td class="px-4 py-2 text-left">
                                    {{ $dataRaport->kelas->nama ?? 'Belum Ada Data' }}
                                </td>
                            </tr>
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
                                <td colspan="2" class="px-4 py-2 text-center">
                                    Belum Ada Data
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

      
    </div>
    <div class="text-left max-w-screen-xl w-full mx-auto mt-8 px-8">
        <p class="mb-4 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-2xl">
            PROYEK
        </p>
        <p class="mb-3 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-2xl">
            @foreach ($uniqueProjectTitles as $projectTitle)
            <p class="mb-3 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-2xl">
                {{ $projectTitle ?? 'Belum Ada Data' }}
            </p>
        @endforeach
        </p>
        <table class="w-full border-collapse">
            <tr>
                <td>
                    @foreach ($uniqueProjectSubTitles as $projectSubTitle)
                    <p class="mb-3 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-2xl">
                        {{ $projectSubTitle ?? 'Belum Ada Data' }}
                    </p>
                @endforeach
                </td>
            </tr>
        </table>
    </div>

    <div class="max-w-screen-xl w-full mx-auto mt-8">
        <table class="w-full border-collapse">
            <thead class="uppercase bg-blue-400">
                @foreach ($uniqueProjectTitles as $projectTitle)
                    <tr>
                        <th class="px-4 py-2 border border-gray-300" style="width: 50%;">{{ $projectTitle }}</th>
                        <th class="px-4 py-2 border border-gray-300" style="width: 10%;">Nilai</th>
                    </tr>
                @endforeach
            </thead>
            <tbody>
                @foreach ($dataRaports as $index => $Raportelemen)
                    @if ($index === 0 || $dataRaports[$index - 1]->capaian_mbkm->element !== $Raportelemen->capaian_mbkm->element)
                        <!-- Display element -->
                        <tr class="uppercase bg-grey-100">
                            <td class="px-4 py-2 border-l border-2 border-gray-300 bg-gray-300" colspan="2">
                                {{ $Raportelemen->capaian_mbkm->element ?? 'Belum Ada Data' }}
                            </td>
                        </tr>
                    @endif
    
                    <!-- Display sub-element -->
                    @foreach ($dataRaports as $subelemen)
                        @if ($subelemen->capaian_mbkm->element === $Raportelemen->capaian_mbkm->element)
                            <tr class="px-4 py-2 border border-gray-300 ">
                                <td class="px-4 py-2 border border-gray-300">{{ $subelemen->capaian_mbkm->sub_elemen ?? 'Belum Ada Data' }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $subelemen->nilai_Mbkm->nilai ?? 'Belum Ada Data' }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
