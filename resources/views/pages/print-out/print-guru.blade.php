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

<h2>LAPORAN DATA GURU/STAFF</h2>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">NIP</th>
                <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
                <th scope="col" class="px-6 py-3">Jabatan</th>
                <th scope="col" class="px-6 py-3">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($guru as $item)
            <tr class="odd:bg-white even:bg-gray-50 border-b">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $item->nomor_induk_pegawai }}
                </th>
                <td class="px-6 py-4">{{ $item->nama }}</td>
                <td class="px-6 py-4">{{ $item->jenis_kelamin }}</td>
                <td class="px-6 py-4">{{ $item->jabatan }}</td>
                <td class="px-6 py-4">{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
