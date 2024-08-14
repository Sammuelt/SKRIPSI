@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <div class="mx-auto max-w-screen-xl p-4 sm:px-6 lg:px-8">
            <header class="text-center">
                <h2 class="text-4xl font-extrabold text-gray-900 md:text-5xl lg:text-6xl">Perencanaan Dana Bos</h2>
            </header>
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-8 my-8">
                <div class="rounded-lg">
                    <a class="group flex items-center justify-between gap-2 rounded-lg border border-blue-700 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 px-5 py-2 transition-colors"
                        href="{{ route('create.rencana') }}">
                        <span class="font-medium text-white transition-colors group-active:text-blue-600">
                            Tambah Perencanaan Dana BOS
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

                {{-- <div class="rounded-lg lg:col-span-2">
                    <div class="relative">
                        <form id="search-form" method="GET" action="{{ route('index.guru') }}">
                            <label for="Search" class="sr-only">Search</label>
                            <input type="text" id="Search" name="search" placeholder="Search for..."
                                   value="{{ request()->input('search') }}"
                                   class="w-full h-16 rounded-lg bg-white text-black py-4 px-2 pe-10 shadow-sm sm:text-sm"
                                   autofocus />
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- table 1 -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                        <th scope="col" class="px-6 py-3">Tahun Perencanaan</th>
                        <th scope="col" class="px-6 py-3">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($history as $dana)
                        <tr class="odd:bg-white even:bg-gray-50 border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($dana->created_at)->isoFormat('D MMMM YYYY') }}
                            </th>
                            <td class="px-6 py-4">{{ $dana->tahunAjaran->tahun_ajaran }}</td>
                            <td class="px-6 py-4"> <a href="{{ route('dana.show', $dana->id) }}"
                                    class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">
                                    View
                                </a></td>
                            <td class="px-6 py-4"></td>
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        </th>
                        <td class="px-6 py-4"></td>




                    
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
  
@endsection
