@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Detail Siswa ( {{$siswa->nama_lengkap ?? 'Data Tidak Tersedia'}} )
        </h1>
        
        
        <div class="flow-root">
            <dl class="my-3 divide-y divide-gray-100 text-sm">
                @if($siswa)
                    <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">NISN</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $siswa->nisn ?? 'Data Tidak Tersedia' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Nama Lengkap</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $siswa->nama_lengkap ?? 'Data Tidak Tersedia' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Jenis Kelamin</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $siswa->jenis_kelamin ?? 'Data Tidak Tersedia' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Tempat / Tanggal Lahir</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $siswa->tempat_lahir ?? 'Data Tidak Tersedia' }} / {{ $siswa->tanggal_lahir ?? 'Data Tidak Tersedia' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Kelas Saat Ini</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $siswa->kelas->nama_kelas ?? 'Data Tidak Tersedia' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Alamat</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $siswa->alamat ?? 'Data Tidak Tersedia' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Nama Orang Tua / Wali</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $siswa->nama_orang_tua ?? 'Data Tidak Tersedia' }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">No. Telp Orang Tua</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $siswa->no_hp_ortu ?? 'Data Tidak Tersedia' }}</dd>
                    </div>
                @else
                    <p>Data siswa tidak tersedia.</p>
                @endif
            </dl>
            <div class="flex flex-row justify-end py-3">
                <a class="inline-block rounded border border-blue-700 mx-2 px-8 py-3 text-sm font-medium text-blue-700 transition-colors hover:bg-blue-800 hover:text-white focus:ring-4 focus:ring-blue-300"
                    href="{{ route('edit.wali', $siswa->id ?? '#') }}">
                    Edit
                </a>
            </div>

            @if(isset($Walikelas) && $Walikelas->isNotEmpty())
                <h2 class="mb-4 text-xl font-bold">Informasi Walikelas ({{ $Walikelas->first()->nama_kelas ?? 'Data Tidak Tersedia' }})</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detail</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Walikelas</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $Walikelas->first()->walikelas->nama ?? 'Data Tidak Tersedia' }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">NIP Walikelas</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $Walikelas->first()->walikelas->nomor_induk_pegawai ?? 'Data Tidak Tersedia' }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Jenis Kelamin</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $Walikelas->first()->walikelas->jenis_kelamin ?? 'Data Tidak Tersedia' }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">No. Telp Walikelas</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $Walikelas->first()->walikelas->no_hp ?? 'Data Tidak Tersedia' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <p>Informasi walikelas tidak tersedia.</p>
            @endif

           
        </div>
    </div>
@endsection
