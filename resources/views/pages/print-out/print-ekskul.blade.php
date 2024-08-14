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

<h2>LAPORAN DATA <br>EKSTRAKULIKULER</h2>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">No</th>
                <th scope="col" class="px-6 py-3">Ekstrakulikuler</th>
   
            </tr>
        </thead>
        <tbody>
            @foreach ($ekskul as $index => $item)
            <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} border-b">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $index + 1 }}
                </td>
                <td class="px-6 py-4">{{ $item->ekstrakulikuler }}</td>
               
            </tr>
            @endforeach
            

        </tbody>
    </table>
</div>
@endsection
