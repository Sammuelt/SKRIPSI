@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Tambahkan Data Guru
        </h1>
        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl">
            Silahkan isi form dibawah ini dengan baik dan benar!!
        </p>

        <form method="POST" action="{{ route('store.kalender') }}">
            @csrf

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label for="semester" class="block mb-2 text-sm font-medium text-gray-900">Semester</label>
                    <select id="semester" name="id_semester"
                        class="relative w-full bg-gray-50 border border-gray-300 text-gray-900 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                        <option class="block px-4 py-2 text-black">--PILIH SEMESTER--</option>
                        @foreach ($semester as $sem)
                            <option class="block px-4 py-2 text-black" value="{{ $sem->id }}">
                                {{ $sem->semester }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full md:w-1/2 px-3">
                    <label for="tahun_ajaran" class="block mb-2 text-sm font-medium text-gray-900">Tahun Ajaran</label>
                    <select id="tahun_ajaran" name="id_tahun_ajaran"
                        class="relative w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                        <option class="block px-4 py-2 text-black">--PILIH TAHUN AJARAN--</option>
                        @foreach ($tahunAjaran as $ta)
                            <option class="block px-4 py-2 text-black" value="{{ $ta->id }}">
                                {{ $ta->tahun_ajaran }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="my-6">
                <label for="tanggal_kegiatan" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Kegiatan</label>
                <input type="date" id="tanggal_kegiatan" name="tanggal"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required />
            </div>
            <div class="my-6">
                <label for="kegiatan" class="block mb-2 text-sm font-medium text-gray-900">Kegiatan</label>
                <input type="text" id="kegiatan" name="keterangan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Kegiatan" required />
            </div>
            <div class="flex items-start mb-6">
                <div class="flex items-center h-5">
                    <input id="corrected" type="checkbox" value=""
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300"
                        required />
                </div>
                <label for="corrected" class="ms-2 text-sm font-medium text-gray-900 ">Pastikan anda sudah
                    memasukan data dengan benar!!</label>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>

    </div>
@endsection
