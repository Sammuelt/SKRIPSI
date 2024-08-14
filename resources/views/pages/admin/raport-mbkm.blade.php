@extends('component.layout')

@section('content')
<button type="button" id="download-btn" onclick="printPage('{{ route('download.data.raport.mbkm', ['id' => $id]) }}')"
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
    Print
</button>

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
                                {{ $data->siswa->nama_lengkap }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                NISN <span class="float-right">:</span>
                            </td>
                            <td class="px-4 py-2 text-left">
                                {{ $data->siswa->nisn }}
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
                        
                    
                            <tr>
                                <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Kelas <span class="float-right">:</span>
                                </td>
                                <td class="px-4 py-2 text-left">
                                    {{ $data->kelas->nama_kelas ?? 'Belum Ada Data' }}
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
                                    {{ $data->semester->semester }}
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Tahun Ajaran <span class="float-right">:</span>
                                </td>
                                <td class="px-4 py-2 text-left">
                                    {{ $data->tahunAjaran->tahun_ajaran }}
                                </td>
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
                @foreach ($raports as $index => $Raportelemen)
                    @if ($index === 0 || $dataRaports[$index - 1]->capaian_mbkm->element !== $Raportelemen->capaian_mbkm->element)
                        <!-- Display element -->
                        <tr class="uppercase bg-grey-100">
                            <td class="px-4 py-2 border-l border-2 border-gray-300 bg-gray-300" colspan="2">
                                {{ $Raportelemen->capaian_mbkm->element ?? 'Belum Ada Data' }}
                            </td>
                        </tr>
                    @endif
    
                    <!-- Display sub-element -->
                    @foreach ($raports as $subelemen)
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
<script>
    function printPage(url) {
        var printWindow = window.open(url, '_blank');
        printWindow.onload = function() {
            printWindow.print();
        };
    }
</script>
@endsection
