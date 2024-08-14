@extends('component.layout')

@section('content')
<button type="button" id="download-btn" onclick="printPage('{{ route('download.data.perencanaan', ['id' => $id]) }}')"
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
    Print
</button>

    <div class="flex flex-col items-center justify-start h-screen mt-8">
        <h1 class="mb-4 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl lg:text-4xl">
            LAPORAN PERENCANAAN DANA BOS
        </h1>
        <h3 class="mb-8 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl lg:text-4xl">
            (Tahun Ajaran {{ $dana->tahunAjaran->tahun_ajaran }})
        </h3>

        <div class="max-w-screen-xl w-full mx-auto mt-8">
            <div class="flex flex-col">
                <div class="relative overflow-x-auto bg-white dark:bg-white">
                    <table
                        class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                        <tbody>
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

            <div class="max-w-screen-xl w-full mx-auto ">
                <table
                    class="w-full mt-10 mx-auto text-sm text-left text-gray-900 dark:text-black dark:bg-white border-collapse">
                    <thead class="text-center">
                        <tr class="bg-gray-200 dark:bg-gray-200">
                            <th class="px-6 py-3" style="width: 10%;">No</th>
                            <th class="px-6 py-3" style="width: 30%;">Kode barang</th>
                            <th class="px-6 py-3" style="width: 10%;">Nama barang</th>
                            <th class="px-6 py-3" style="width: 50%;">QTY</th>
                            <th class="px-6 py-3" style="width: 50%;">Total Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nomor = 1;
                        @endphp
                        @foreach ($view as $rencana)
                            <tr class="bg-white dark:bg-white border border-gray-300">
                                <td class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap">
                                    {{ $nomor++ }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $rencana->barang->kode ?? 'Kode Barang Tidak Ditemukan' }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $rencana->barang->nama_barang ?? 'Nama Barang Tidak Ditemukan' }}
                                </td>
                                <td class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap">
                                    {{ $rencana->qty ?? 'Jumlah Barang Tidak Ditemukan' }}
                                </td>
                                <td class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap">
                                    {{ $rencana->total_biaya ?? 'Total Biaya Tidak Ditemukan' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
    <script>
        function printPage(url) {
            var printWindow = window.open(url, '_blank');
            printWindow.onload = function() {
                printWindow.print();
            };
        }
    </script>
@endsection
