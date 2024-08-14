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

<h2>LAPORAN DATA <br>INVENTARIS BARANG</h2>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Tanggal Pembelian</th>
                <th scope="col" class="px-6 py-3">Dana Digunakan</th>
                <th scope="col" class="px-6 py-3">Kode Barang</th>
                <th scope="col" class="px-6 py-3">Nama Barang</th>
                <th scope="col" class="px-6 py-3">Jumlah</th>
                <th scope="col" class="px-6 py-3">Kondisi</th>
                <th scope="col" class="px-6 py-3">Lokasi</th>
                <th scope="col" class="px-6 py-3">Keterangan</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($inventaris as $aset)
            <tr class="odd:bg-white even:bg-gray-50 border-b">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ \Carbon\Carbon::parse($aset->tgl_pembelian)->isoFormat('D MMMM YYYY') }}
                </th>
                <td class="px-6 py-4">{{ $aset->dana_pembelian }}</td>
                <td class="px-6 py-4">{{ $aset->barang->kode }}</td>
                <td class="px-6 py-4">{{ $aset->barang->nama_barang }}</td>
                <td class="px-6 py-4">{{ $aset->jumlah }}</td>
                <td class="px-6 py-4">{{ $aset->kondisi }}</td>
                <td class="px-6 py-4">{{ $aset->lokasi }}</td>
                <td class="px-6 py-4">{{ $aset->keterangan }}</td>
   

            </tr>
            @endforeach
           

        </tbody>
    </table>
</div>
@endsection
