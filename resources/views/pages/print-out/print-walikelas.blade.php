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

<h2>LAPORAN DATA <br>WALIKELAS</h2>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                 
                    <th scope="col" class="px-6 py-3">Kelas</th>
                    <th scope="col" class="px-6 py-3">Wali Kelas</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach ($Walikelas as $index => $item)
                    
                        <td class="px-6 py-4">{{ $item->nama_kelas }}</td>
                        <td class="px-6 py-4">{{ $item->walikelas->nama ?? 'belum ada walikelas' }}</td>
                     
                    </tr>
                @endforeach
                

            </tbody>
        </table>
    </div>
</div>
@endsection
