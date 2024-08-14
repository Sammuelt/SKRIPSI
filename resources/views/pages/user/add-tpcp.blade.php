@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Tambahkan TP/CP
        </h1>
        <p class="mb-4 text-2xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4  xl">
             ( {{$mapel->nama_pelajaran}} )
        </p>
        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl">
            Silahkan isi form dibawah ini dengan baik dan benar!!
        </p>

        <form action="{{ route('store.tpcp') }}" method="POST">
            @csrf
            <input type="hidden" name="id_mapel" value="{{ $mapel->id }}">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="mb-6">
                    <label for="id_kelas" class="block mb-2 text-sm font-medium text-gray-900">Kelas</label>
                    <select id="id_kelas" name="id_kelas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="">--Pilih Kelas--</option>
                        @foreach($kelas as $kls)
                            <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-6">
                    <label for="id_semester" class="block mb-2 text-sm font-medium text-gray-900">Semester</label>
                    <select id="id_semester" name="id_semester" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="">--Pilih Semester--</option>
                        @foreach($semester as $smt)
                            <option value="{{ $smt->id }}">{{ $smt->semester }}</option>
                        @endforeach
                    </select>
                </div>
                
            </div>
          
            <div class="mb-6">
                <label for="CP" class="block mb-2 text-sm font-medium text-gray-900">Capaian Pelajaran</label>
                <input type="text" id="CP" name="CP"
                    class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500" required />
            </div>
            <div class="mb-6">
                <label for="lingkup_materi" class="block mb-2 text-sm font-medium text-gray-900">Lingkup Materi</label>
                <input type="text" id="lingkup_materi" name="lingkup_materi"
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
