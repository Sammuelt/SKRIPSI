@extends('component.print-header')

@section('content')
<style>
    @media print {
        .no-print {
            display: none;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        thead {
            display: table-header-group;
        }
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
<script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
<h2>LAPORAN PERENCANAAN DANA BOS <br> (Tahun Ajaran {{ $dana->tahunAjaran->tahun_ajaran }})</h2>
<div class="flex flex-col items-center justify-start h-screen mt-8">
    <div class="max-w-screen-xl w-full mx-auto mt-8">
        <div class="flex flex-col">
            <div class="relative overflow-x-auto bg-white dark:bg-white">
                <table class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                    <tbody>
                        <tr>
                            <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                Sekolah 
                            </td>
                            <td class="px-4 py-2 text-left">
                                SDN 3 Sungai Tiung
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                Alamat 
                            </td>
                            <td class="px-4 py-2 text-left">
                                Sungai Tiung
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="max-w-screen-xl w-full mx-auto mt-10">
            <table class="w-full mx-auto text-sm text-left text-gray-900 dark:text-black dark:bg-white border-collapse">
                <thead class="text-center">
                    <tr class="bg-gray-200 dark:bg-gray-200">
                        <th class="px-6 py-3" style="width: 10%;">No</th>
                        <th class="px-6 py-3" style="width: 30%;">Kode barang</th>
                        <th class="px-6 py-3" style="width: 30%;">Nama barang</th>
                        <th class="px-6 py-3" style="width: 15%;">QTY</th>
                        <th class="px-6 py-3" style="width: 15%;">Total Biaya</th>
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
        <div class="mt-10">
            <table class="w-full text-sm text-left text-gray-900 dark:text-black dark:bg-white border-collapse">
                <tbody>
                    <tr>
                        <td class="px-4 py-2 font-medium whitespace-nowrap">
                            Mengetahui,
                        </td>
                    
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-medium whitespace-nowrap">
                            Kepala Sekolah
                        </td>
                    </tr>
                  <tr>
                    <td class="py-10">

                    </td>
                  </tr>
                    <tr>
                        <td class="px-4 py-2 font-medium">
                            NIP :
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
</div>
@endsection
