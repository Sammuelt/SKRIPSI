@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <div class="mx-auto max-w-screen-xl p-4 sm:px-6 lg:px-8">
            <header class="text-center">
                <h2 class="text-4xl font-extrabold text-gray-900 md:text-5xl lg:text-6xl">Standar Satuan Harga Barang Inventaris</h2>
            </header>
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-8 my-8">
                <div class="rounded-lg">
                    <a id="open-modal" class="group flex items-center justify-between gap-2 rounded-lg border border-blue-700 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 px-5 py-2 transition-colors">
                        <span class="font-medium text-white transition-colors group-active:text-blue-600">
                            Tambahkan Standar Satuan Harga
                        </span>
                        <span class="shrink-0 rounded-full border border-current bg-white p-2 text-blue-700 group-active:text-blue-600">
                            <svg class="size-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </span>
                    </a>
                </div>

                <div class="rounded-lg lg:col-span-2">
                    <div class="relative">
                        <form id="search-form" method="GET" action="{{ route('index.harga.satuan') }}">
                            <label for="Search" class="sr-only">Search</label>
                            <input type="text" id="Search" name="search" placeholder="Search for..."
                                value="{{ request()->input('search') }}"
                                class="w-full h-16 rounded-lg bg-white text-black py-4 px-2 pe-10 shadow-sm sm:text-sm"
                                autofocus />
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- table 1 -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Kode Barang</th>
                        <th scope="col" class="px-6 py-3">Nama Barang</th>
                        <th scope="col" class="px-6 py-3">Harga Satuan </th>
                        {{-- <th scope="col" class="px-6 py-3">Jumlah Barang Dibeli</th>
                        <th scope="col" class="px-6 py-3">Total Pembelian</th> --}}
              
                    </tr>
                </thead>
                <tbody>
                    @foreach ($harga as $aset)
                    <tr>
                 
                        <td class="px-6 py-4">{{ $aset->kode }}</td>
                        <td class="px-6 py-4">{{ $aset->nama_barang }}</td>
                        <td class="px-6 py-4">Rp. {{ $aset->harga_satuan }}</td>
                        {{-- <td class="px-6 py-4">{{ $aset->jumlah_beli }}</td>
                        <td class="px-6 py-4">{{ $aset->total_harga }}</td> --}}
                       
                    </tr>
                    @endforeach
                    <tr>
                      
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                        {{-- <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td> --}}
                
                        <td class="px-6 py-4">
                            <button type="button" id="download-btn" onclick="printPage('{{ route('download.data.hargasatuan') }}')"
                            class="ml-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-2 focus:outline-none">
                            Print
                        </button>
                        </td>
                    </tr>

                </tbody>
            </table>
            
        </div>
        

    <!-- Include Modal -->
    @include('component.admin.modal_add_harga')
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('crud-modal');
        const closeModalButton = document.getElementById('close-modal');
        const openModalButton = document.getElementById('open-modal');
        const form = document.getElementById('harga-form');
        
        // Function to open the modal
        if (openModalButton) {
            openModalButton.addEventListener('click', function() {
                modal.classList.remove('hidden');
            });
        }

        // Close modal functionality
        if (closeModalButton) {
            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });
        }

        // Optional: Close modal when clicking outside of it
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
    function printPage(url) {
            var printWindow = window.open(url, '_blank');
            printWindow.onload = function() {
                printWindow.print();
            };
        }
</script>

