@extends('component.print-header')

@section('content')
    <style>
        @media print {
            .no-print {
                display: none;
            }

        }
    </style>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
<div class="flex flex-col justify-center">

    <h2>LAPORAN DATA <br>( {{$siswa->nama_lengkap}} )</h2>
   
    <div class="flow-root">
        <dl class="my-3 divide-y divide-gray-100 text-sm">
            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">NISN</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $siswa->nisn }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">Nama Lengkap</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $siswa->nama_lengkap }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">Jenis Kelamin</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $siswa->jenis_kelamin }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">Tempat / Tanggal Lahir</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $siswa->tempat_lahir }} / {{ $siswa->tanggal_lahir }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">Kelas Saat Ini</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $siswa->kelas->nama_kelas}}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">Alamat</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $siswa->alamat }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">Nama Orang Tua / Wali</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $siswa->nama_orang_tua }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">No. Telp Orang Tua</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $siswa->no_hp_ortu }}</dd>
            </div>
        </dl>

      
    </div>
</div>
@endsection
