@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Tambahkan Data Mutasi keuangan
        </h1>
        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl">
            Silahkan isi form dibawah ini dengan baik dan benar!!
        </p>

        <form action="{{ route('store.keuangan') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
            </div>
            <div>
                <label for="jenis_transaksi" class="block mb-2 text-sm font-medium text-gray-900">Jenis Transaksi</label>
                <select id="jenis_transaksi" name="jenis_transaksi"
                    class="w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-left justify-between">
                    <option value="">--PILIH TRANSAKSI--</option>
                    <option value="uang_masuk">DANA MASUK</option>
                    <option value="uang_keluar">DANA KELUAR</option>
            
                </select>
            </div>
            <div>
                <label for="dana" class="block mb-2 text-sm font-medium text-gray-900">SUMBER</label>
                <select id="dana" name="dana"
                    class="w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-left justify-between">
                    <option value="">--PILIH SUMBER--</option>
                    <option value="Dana Bos">DANA BOS</option>
                    <option value="lain-lain">Lain-lain</option>
            
                </select>
            </div>
                <div>
                    <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900">Jumlah</label>
                    <input type="text" id="jumlah" name="jumlah"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
                </div>
              
                
                
            </div>
            <div class="mb-6">
                <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900">Keterangan</label>
                <input type="text" id="keterangan" name="keterangan"
                    class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500" required />
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
