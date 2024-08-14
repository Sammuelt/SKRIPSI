@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Data Raport {{ $kelas->nama_kelas }}
        </h1>
        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl">
            Wali Kelas : {{ $kelas->walikelas->nama }}
        </p>
        
        <!-- Tabel Data Siswa -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">NISN</th>
                        <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                        <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
                        <th scope="col" class="px-6 py-3">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswa as $item)
                        <tr class="odd:bg-white even:bg-gray-50 border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $item->nisn }}
                            </th>
                            <td class="px-6 py-4">{{ $item->nama_lengkap }}</td>
                            <td class="px-6 py-4">{{ $item->jenis_kelamin }}</td>
                            <td class="px-6 py-4">
                                @include('component.admin.btn-group-raport')
                            </td>
                        </tr>
                    @endforeach
                    {{-- Baris untuk tombol download, jika diperlukan
                    <tr>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        </th>
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
                    --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
