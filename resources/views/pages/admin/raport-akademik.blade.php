@extends('component.layout')

@section('content')
    <button type="button" id="download-btn" onclick="printPage('{{ route('download.data.raport.akademik', ['id' => $id]) }}')"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
        print
    </button>
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
                    <table
                        class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
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
                                    Sungai Tiung
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex flex-col">
                <div class="relative overflow-x-auto bg-white dark:bg-white">
                    <table
                        class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                        <tbody>
                            <tr>
                                <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Kelas <span class="float-right">:</span>
                                </td>
                                <td class="px-4 py-2 text-left"> {{ $data->kelas->nama_kelas }}</td>
                            </tr>

                            <tr>
                                <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Fase <span class="float-right">:</span>
                                </td>
                                <td class="px-4 py-2 text-left">
                                    ""
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Semester <span class="float-right">:</span>
                                </td>
                                <td class="px-4 py-2 text-left">
                                    {{ $data->semester->semester ?? 'Belum Ada Data' }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Tahun Ajaran <span class="float-right">:</span>
                                </td>
                                <td class="px-4 py-2 text-left">
                                    {{ $data->tahunAjaran->tahun_ajaran ?? 'Belum Ada Data' }}
                                </td>
                            </tr>




                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        

        <div class="max-w-screen-xl w-full mx-auto ">
            <table
                class="w-full mt-10 mx-auto text-sm text-left text-gray-900 dark:text-black dark:bg-white border-collapse">
                <thead class="text-center">
                    <tr class="bg-gray-200 dark:bg-gray-200">
                        <th class="px-6 py-3" style="width: 10%;">No</th>
                        <th class="px-6 py-3" style="width: 30%;">Mata Pelajaran</th>
                        <th class="px-6 py-3" style="width: 10%;">Nilai</th>
                        <th class="px-6 py-3" style="width: 50%;">Capaian Kompetensi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomor = 1;
                    @endphp
                    @foreach ($raports as $dataRaport)
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
                            <td class="px-6 py-4 font-medium  text-gray-900 whitespace-nowrap text-justify break-words">
                                <div class="mb-2 ms-5">
                                    {{$dataRaport->kelebihan_kompetensi}}
                                 
                                </div>
                                <hr class="border-t border-gray-400 my-2">
                                <div class="ms-5">
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
                    @forelse ($ekskul as $raport)
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
                <div class="max-w-screen-xl w-full mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-20 mt-8">
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
                                    @if ($semester == 1)
                                        <tr>
                                            <td class="px-4 py-2 text-left">
                                                Berdasarkan pencapaian tujuan pembelajaran pada semester ganjil, peserta
                                                didik ditetapkan :
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="px-4 py-2 text-left">
                                                Berdasarkan pencapaian tujuan pembelajaran pada semester ganjil dan genap,
                                                peserta didik ditetapkan :
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
