@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <div class="mx-auto max-w-screen-xl p-4 sm:px-6 lg:px-8">
            <header class="text-center">
                <h2 class="text-4xl font-extrabold text-gray-900 md:text-5xl lg:text-6xl">Aset & Inventaris</h2>
            </header>
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-8 my-8">
                <div class="rounded-lg">
                    <a class="group flex items-center justify-between gap-2 rounded-lg border border-blue-700 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 px-5 py-2 transition-colors"
                        href="{{ route('create.inventaris') }}">
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

                <div class="rounded-lg">
                    <a class="group flex items-center justify-between gap-2 rounded-lg border border-blue-700 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 px-5 py-3 transition-colors"
                        href="{{ route('create.inventaris') }}">
                        <span class="font-medium text-white transition-colors group-active:text-blue-600">
                            Tambahkan Data Aset
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
                        <form id="search-form" method="GET" action="{{ route('index.guru') }}">
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
                        <th scope="col" class="px-6 py-3">Tanggal Pembelian</th>
                        <th scope="col" class="px-6 py-3">Dana Digunakan</th>
                        <th scope="col" class="px-6 py-3">Kode Barang</th>
                        <th scope="col" class="px-6 py-3">Nama Barang</th>
                        <th scope="col" class="px-6 py-3">Jumlah</th>
                        <th scope="col" class="px-6 py-3">Kondisi</th>
                        <th scope="col" class="px-6 py-3">Lokasi</th>
                        <th scope="col" class="px-6 py-3">Keterangan</th>
                        <th scope="col" class="px-6 py-3">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventaris as $aset)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($aset->tgl_pembelian)->isoFormat('D MMMM YYYY') }}
                        </th>
                        <td class="px-6 py-4">{{ $aset->dana_pembelian }}</td>
                        <td class="px-6 py-4">{{ $aset->kode_barang }}</td>
                        <td class="px-6 py-4">{{ $aset->nama_barang }}</td>
                        <td class="px-6 py-4">{{ $aset->jumlah }}</td>
                        <td class="px-6 py-4">{{ $aset->kondisi }}</td>
                        <td class="px-6 py-4">{{ $aset->lokasi }}</td>
                        <td class="px-6 py-4">{{ $aset->keterangan }}</td>
                        <td class="px-6 py-4">
                            @include('component.admin.btn-group-aset')
                        </td>

                    </tr>
                    @endforeach
                    <tr>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        </th>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4">
                            <button type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                                Download
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

@endsection
