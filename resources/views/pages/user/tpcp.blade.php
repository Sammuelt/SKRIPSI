@extends('component.layout-user')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Input TP/CP
        </h1>
        <div class="rounded-lg lg:col-span-2">
            <div class="relative">
                <form id="search-form" method="GET" action="{{ route('index.guru') }}">
                    <label for="Search" class="sr-only">Search</label>
                    <input type="text" id="Search" name="search" placeholder="Search for..."
                        value="{{ request()->input('search') }}"
                        class="w-full rounded-lg text-gray-900 bg-gray-50 border border-gray-300 py-4 px-2 pe-10 shadow-sm sm:text-sm"
                        autofocus />
                </form>
            </div>
        </div>
        <div class="my-6">
            <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900">Pilih Semester</label>
            <select id="jenis_kelamin" name="jenis_kelamin"
                class="w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-left justify-between">
                <option value="">--PILIH SEMESTER--</option>
                <option value="laki-laki">Ganjil</option>
                <option value="perempuan">Genap</option>
            </select>
        </div>
        {{-- table --}}
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Mata Pelajaran</th>
                        <th scope="col" class="px-6 py-3">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mapel as $index => $item)
                    <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} border-b">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $index + 1 }}
                        </td>
                        <td class="px-6 py-4">{{ $item->nama_pelajaran }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex -space-x-px overflow-hidden rounded-md border bg-white shadow-sm">
                                <a href="" class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
                                    View
                                </a>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        </th>
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
