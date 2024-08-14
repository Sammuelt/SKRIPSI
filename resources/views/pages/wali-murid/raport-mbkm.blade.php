@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <div class="mx-auto max-w-screen-xl p-4 sm:px-6 lg:px-8">
            <header class="text-center">
                <h2 class="text-4xl font-extrabold text-gray-900 md:text-5xl lg:text-6xl"> PROYEK MBKM <br>{{ $idsiswa->nama_lengkap }}</h2>
            </header>
        </div>

        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl">
            Silahkan pilih Kelas, Semester, Tahun Ajaran, dan Nama siswa untuk menampilkan data....
        </p>

        <form id="filter-form" method="GET" action="{{ route('wali.raport.proyek') }}">
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
                        LAPORAN HASIL PROYEK 
                    </h1>
                    <h3 class="mb-8 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl lg:text-4xl">
                        (MBKM)
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
                                @foreach ($dataRaport as $index => $Raportelemen)
                                    @if ($index === 0 || $dataRaports[$index - 1]->capaian_mbkm->element !== $Raportelemen->capaian_mbkm->element)
                                        <!-- Display element -->
                                        <tr class="uppercase bg-grey-100">
                                            <td class="px-4 py-2 border-l border-2 border-gray-300 bg-gray-300" colspan="2">
                                                {{ $Raportelemen->capaian_mbkm->element ?? 'Belum Ada Data' }}
                                            </td>
                                        </tr>
                                    @endif
                    
                                    <!-- Display sub-element -->
                                    @foreach ($dataRaport as $subelemen)
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
                        <h1 class="mt-5  px-10 ">
                            Catatan Proses <br>
                            <span
                                class="ms-15">{{$uniqueProjectCP}}</span>
                        </h1>
                
                
                        <p class="text-center mt-10 text-gray-700 font-bold text-2xl">Keterangan Tingkat Pencapaian Siswa</p>
                        <table class="w-full mt-5 mb-20 text-sm text-left rtl:text-right text-gray-500 ">
                            <thead class="text-center text-xs text-gray-700 uppercase bg-gray-200">
                                <tr >
                                    <th scope="col" class="px-6 py-3">BB</th>
                                    <th scope="col" class="px-6 py-3">MB</th>
                                    <th scope="col" class="px-6 py-3">BSH</th>
                                    <th scope="col" class="px-6 py-3">BB</th>
                
                                </tr>
                            </thead>
                            <tbody class=" text-center text-gray-700">
                                <tr class="bg-white border dark:bg-white">
                                    <td class="px-6 py-4">Belum Berkembang</td>
                                    <td class="px-6 py-4">Mulai Berkembang</td>
                                    <td class="px-6 py-4">Berkembang sesuai harapan</td>
                                    <td class="px-6 py-4">Sangat Berkembang</td>
                                    
                                </tr>
                                <tr class="bg-white border dark:bg-white">
                                    <td class="px-6 py-4">Siswa masih membutuhkan bimbingan dalam mengembangkan kemampuan	</td>
                                    <td class="px-6 py-4">Siswa mulai mengembangkan kemampuan namun masih belum ajek	</td>
                                    <td class="px-6 py-4">Siswa telah mengembangkan kemampuan hingga berada dalam tahap ajek	</td>
                                    <td class="px-6 py-4">Siswa mengembangkan kemampuannya melampaui harapan	</td>
                                </tr>
                            </tbody>
                        </table>
                
                        <div class="max-w-screen-xl w-full mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-20 mt-8">
                            <div class="flex flex-col">
                                <div class="relative overflow-x-auto bg-white dark:bg-white">
                                    <table
                                        class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
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
                                    <table
                                        class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
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
                            <div>
                                <div class="relative overflow-x-auto bg-white dark:bg-white">
                                    <table
                                        class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
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
