@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center " id="print-area">
        <div class="mx-auto max-w-screen-xl p-4 sm:px-6 lg:px-8">
            <header class="text-center">
                <h2 class="text-4xl font-extrabold text-gray-900 md:text-5xl lg:text-6xl">Mata Pelajaran</h2>
            </header>
            
        </div>

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8 my-8 print:hidden">
            <div class="rounded-lg bg-gray-200">
                <a class="group flex items-center justify-between gap-4 rounded-lg border border-blue-700 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 px-5 py-3 transition-colors"
                    href="{{ route('create.mapel') }}">
                    <span class="font-medium text-white transition-colors group-active:text-blue-600">
                        Tambahkan Mata Pelajaran
                    </span>
                    <span
                        class="shrink-0 rounded-full border border-current bg-white p-2 text-blue-700 group-active:text-blue-600">
                        <svg class="size-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
        <!-- table 1 -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Mata Pelajaran</th>
                        <th scope="col" class="px-6 py-3 print:hidden">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mapel as $index => $item)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} border-b">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4">{{ $item->nama_pelajaran }}</td>
                            <td class="px-6 py-4 print:hidden">
                                @include('component.admin.btn-group-mapel')
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        </th>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4 print:hidden">
                            <button type="button" id="download-btn"
                                onclick="printPage('{{ route('download.data.mapel') }}')"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                                Print
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>
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
