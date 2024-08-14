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

    <h2>LAPORAN DATA <br>( {{$guru->nama}} )</h2>
   
    <div class="flow-root">
        <dl class="my-3 divide-y divide-gray-100 text-sm">
            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">NIP</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $guru->nomor_induk_pegawai }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">Email</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $guru->email }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">No. Telepon</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $guru->no_hp }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">Nama</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $guru->nama }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">Jenis Kelamin</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $guru->jenis_kelamin }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">Tempat / Tanggal Lahir</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $guru->tempat_lahir }} / {{ $guru->tanggal_lahir }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">Status / Golongan</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $guru->status }} / {{ $guru->golongan }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">Jabatan</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $guru->jabatan }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">Pendidikan Terakhir</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $guru->pendidikan }}</dd>
            </div>

            <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">Alamat</dt>
                <dd class="text-gray-700 sm:col-span-2">{{ $guru->alamat }}</dd>
            </div>
        </dl>

       
    </div>
</div>
@endsection
