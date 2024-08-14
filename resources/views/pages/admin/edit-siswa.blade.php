@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Edit Data 
        </h1>
        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl">
            Silahkan isi form dibawah ini dengan baik dan benar!!
        </p>
        @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form action="{{ route('update.siswa.admin',$siswa->id) }}" @method('PUT')>
            @csrf
            <input type="hidden" name="nama_lengkap" value="{{ $siswa->nama_lengkap }}">
            <div class="mb-6">
                <label for="nisn" class="block mb-2 text-sm font-medium text-gray-900">NISN</label>
                <input type="text" name="nisn" id="nisn" value="{{ $siswa->nisn }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required />
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ $siswa->nama_lengkap }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
                </div>
                <div>
                    <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin"
                        class="w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-left justify-between">
                        <option value="">--PILIH KONDISI--</option>
                        <option value="laki-laki" {{ $siswa->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="perempuan" {{ $siswa->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        
                    </select>
                </div>
                <div>
                    <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ $siswa->tempat_lahir }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
                </div>
                <div>
                    <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir"value="{{ $siswa->tanggal_lahir }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
                </div>
                <div>
                    <label for="id_kelas_now" class="block mb-2 text-sm font-medium text-gray-900">Kelas Saat Ini</label>              
                    <select id="id_kelas_now" name="id_kelas_now"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="">--Pilih Kelas--</option>
                        @foreach($kelas as $kls)
                            <option value="{{ $kls->id }}" @if($siswa->kelas->id == $kls->id) selected @endif>{{ $kls->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                
              
                <div>
                    <label for="nama_orang_tua" class="block mb-2 text-sm font-medium text-gray-900">Nama Orang Tua</label>
                    <input type="text" id="nama_orang_tua" name="nama_orang_tua" value="{{ $siswa->nama_orang_tua }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
                </div>
                <div>
                    <label for="no_hp_ortu" class="block mb-2 text-sm font-medium text-gray-900">No Telp Orang tua</label>
                    <input type="telp" id="no_hp_ortu" name="no_hp_ortu" value="{{ $siswa->no_hp_ortu }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
                </div>
            </div>
            <div class="mb-6">
                <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                <input type="text" id="alamat" name="alamat" value="{{ $siswa->alamat }}"
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
