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

<h2>LAPORAN PENGGUNAAN <br>DANA</h2>
<div class="bg-white shadow-md rounded-lg mt-5 p-6">
    <h2 class="text-xl font-semibold mb-4">Penggunaan Dana</h2>

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Kode
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama
                    Barang</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Harga/pcs</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Qty
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Total
                    Biaya</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($penggunaan as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $item->barang->kode }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->barang->nama_barang }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp.
                        {{ number_format($item->barang->harga_satuan, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->jumlah }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp.
                        {{ number_format($item->total_biaya, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="bg-gray-50">
                <td class="px-6 py-3 text-sm font-medium text-gray-900" colspan="4">Total</td>
                <td class="px-6 py-3 text-sm font-medium text-gray-900">Rp.
                    {{ number_format($totalpembelian, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="bg-white shadow-md rounded-lg mt-5 p-6">
    <h2 class="text-xl font-semibold mb-4">Rincian</h2>
    <table class="min-w-full divide-y divide-gray-200">
        <tbody class="bg-white divide-y divide-gray-200">
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Total Pemasukan/Tahun Ajaran</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rp.
                    {{ number_format($totalpemasukan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Total Pembelian/Tahun Ajaran</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rp.
                    {{ number_format($totalpembelian, 0, ',', '.') }}</td>
            </tr>
            <tr class="bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">Hasil</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-500">Rp.
                    {{ number_format($hasil, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</div>
<br>
<br>
<div class="mt-10">
    <P>Mengetahui,</P>
    <P>Kepala Sekolah,</P>
    <br>
    <br>
    <p>____________________________</p>
    <P>NIP : </P>
</div>
@endsection
