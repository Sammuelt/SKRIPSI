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

<h2>LAPORAN DATA <br>PPRESTASI</h2>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Kode</th>
                    <th scope="col" class="px-6 py-3">Nama barang</th>
                    <th scope="col" class="px-6 py-3">harga/pcs</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach ($harga as $index => $aset)
                    <tr>
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $aset->kode }}</td>
                        <td class="px-6 py-4">{{ $aset->nama_barang }}</td>
                        <td class="px-6 py-4">Rp. {{ $aset->harga_satuan }}</td>
                    </tr>
                @endforeach
                

            </tbody>
        </table>
    </div>
</div>
@endsection
