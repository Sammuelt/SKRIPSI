@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Tambahkan Data Aset
        </h1>
        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl">
            Silahkan isi form dibawah ini dengan baik dan benar!!
        </p>

        <form action="{{ route('store.inventaris') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="tgl_pembelian" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Pembelian</label>
                    <input type="date" id="tgl_pembelian" name="tgl_pembelian"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="dana_pembelian" class="block mb-2 text-sm font-medium text-gray-900">Sumber Dana</label>
                    <select id="dana_pembelian" name="dana_pembelian"
                        class="w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-left justify-between">
                        <option value="">--PILIH SUMBER DANA--</option>
                        <option value="Dana Bos">DANA BOS</option>
                        <option value="lain-lain">Lain-lain</option>
                
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
                    <label for="kondisi" class="block mb-2 text-sm font-medium text-gray-900">Kondisi</label>
                    <select id="kondisi" name="kondisi"
                        class="w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-left justify-between">
                        <option value="">--PILIH KONDISI--</option>
                        <option value="sangat_bagus">Sangat Bagus</option>
                        <option value="bagus">Bagus</option>
                        <option value="cukup bagus">Cukup Bagus</option>
                        <option value="tidak_bagus">Tidak Bagus</option>
                        <option value="rusak">Rusak</option>
                    </select>
                </div>
                <div>
                    <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900">Jumlah</label>
                    <input type="text" id="jumlah" name="jumlah"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
                </div>
                <div>
                    <label for="lokasi" class="block mb-2 text-sm font-medium text-gray-900">Penempatan</label>
                    <input type="text" id="lokasi" name="lokasi"
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
