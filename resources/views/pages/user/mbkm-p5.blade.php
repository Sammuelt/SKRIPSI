@extends('component.layout-user')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Input Project P5
        </h1>
        <div class="rounded-lg bg-gray-200 lg:col-span-2">
            <div class="relative">
                <form id="search-form" method="GET" action="{{ route('index.guru') }}">
                    <label for="Search" class="sr-only">Search</label>
                    <input type="text" id="Search" name="search" placeholder="Search for..."
                        value="{{ request()->input('search') }}"
                        class="w-full rounded-lg bg-white text-black py-2.5 px-2 pe-10 shadow-sm sm:text-sm"
                        autofocus />
                </form>
            </div>
        </div>
    </div>

    {{-- button group --}}
    <div class="mb-6 mt-4">
        <button type="button"
            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
            Tambahkan Projek Baru
        </button>
    </div>
    {{-- <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <button type="button"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                Tambahkan Judul Projek
            </button>
        </div>
        <div>
            <button type="button"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                Tambahkan Catatan Projek
            </button>
        </div>
    </div> --}}

    {{-- table --}}
    <div class="relative overflow-x-auto my-2 shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">{judul-projek}</th>
                    <th scope="col" class="px-6 py-3">Capaian</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        Beriman, Bertakwa Kepada Tuhan Yang Maha Esa dan Berakhlak Mulia
                    </th>
                    <td class="px-6 py-4">
                        @include('component.user.btn-group-p5')
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        Berkhebinekaan Global
                    </th>
                    <td class="px-6 py-4">
                        @include('component.user.btn-group-p5')
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        Kreatif
                    </th>
                    <td class="px-6 py-4">
                        @include('component.user.btn-group-p5')
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        Kreatif
                    </th>
                    <td class="px-6 py-4">
                        @include('component.user.btn-group-p5')
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        Bergotong Royong
                    </th>
                    <td class="px-6 py-4">
                        @include('component.user.btn-group-p5')
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="px-6 py-4 bg-gray-50">
                        <p><span class="uppercase">Deskripsi Projek</span><br>
                        {desk proj}</p>
                    </th>
                    <td class="px-6 py-4 bg-gray-50">
                        <p><span class="uppercase">Catatan Projek</span><br> {desk catatan}</p>
                    </td>
                </tr>


            </tbody>
        </table>
    </div>
@endsection
