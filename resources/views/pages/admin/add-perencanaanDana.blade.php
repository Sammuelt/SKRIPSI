@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Tambah Perencanaan
        </h1>
        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl">
            Silahkan isi form dibawah ini dengan baik dan benar!!
        </p>

        <form action="{{ route('store.rencana') }}" method="POST">
            @csrf

            <div class="grid gap-6 mb-6 md:grid-cols-2">
            
                <div>
                    <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900">Tahun Ajaran</label>
                    <select id="tahun" name="tahun"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="" disabled selected>Pilih Kode Barang</option>
                        @foreach ($tahuns as $tahun)
                            <option value="{{ $tahun->id }}">{{ $tahun->tahun_ajaran }}</option>
                        @endforeach
                    </select>
                </div>
                
            
                <div>
                    <label for="kode_barang" class="block mb-2 text-sm font-medium text-gray-900">Kode Barang</label>
                    <select id="kode_barang" name="kode_barang"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="" disabled selected>Pilih Kode Barang</option>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->kode }} ----> {{$barang->nama_barang}}</option>
                        @endforeach
                    </select>
                </div>
                
              
                <div>
                    <label for="qty" class="block mb-2 text-sm font-medium text-gray-900">QTY</label>
                    <input type="text" id="qty" name="qty"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
                </div>
               
        <div class="flex items-start mb-6">
            <div class="flex items-center h-5">
                <input id="corrected" type="checkbox" value=""
                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300"
                    required />
            </div>
            <label for="corrected" class="ms-2 text-sm font-medium text-gray-900">Pastikan anda sudah
                memasukan data dengan benar!!</label>
        </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </div>
@endsection
