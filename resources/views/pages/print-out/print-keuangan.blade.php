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

<h2>LAPORAN DATA <br>KEUANGAN</h2>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Tanggal</th>
                <th scope="col" class="px-6 py-3">Jenis Transaksi</th>
                <th scope="col" class="px-6 py-3">Sumber</th>
                <th scope="col" class="px-6 py-3">Jumlah</th>
                <th scope="col" class="px-6 py-3">Keterangan</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($keuangan as $mutasi)
            <tr class="odd:bg-white even:bg-gray-50 border-b">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ \Carbon\Carbon::parse($mutasi->tanggal)->isoFormat('D MMMM YYYY') }}
                </th>
                <td class="px-6 py-4">{{ $mutasi->jenis_transaksi }}</td>
                <td class="px-6 py-4">{{ $mutasi->dana }}</td>
                <td class="px-6 py-4">{{ $mutasi->jumlah }}</td>
                <td class="px-6 py-4">{{ $mutasi->keterangan }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
