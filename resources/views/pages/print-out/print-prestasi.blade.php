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
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Juara</th>
                    <th scope="col" class="px-6 py-3">Kompetisi</th>
                    <th scope="col" class="px-6 py-3">Tanggal</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach ($prestasi as $index => $item)
                    <tr>
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $item->siswa->nama_lengkap ?? '' }}</td>
                        <td class="px-6 py-4">{{ $item->title }}</td>
                        <td class="px-6 py-4">{{ $item->sub }}</td>
                        <td class="px-6 py-4">{{ $item->date }}</td>
                     
                    </tr>
                @endforeach
                

            </tbody>
        </table>
    </div>
</div>
@endsection
