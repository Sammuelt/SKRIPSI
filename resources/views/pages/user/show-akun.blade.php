@extends('component.layout')

@section('content')
<div class="flex flex-col justify-center">
    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
        Profile
    </h1>
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
{{-- 
        <div class="flex flex-row justify-end py-3">
            <a class="inline-block rounded border border-blue-700 mx-2 px-8 py-3 text-sm font-medium text-blue-700 transition-colors hover:bg-blue-800 hover:text-white focus:ring-4 focus:ring-blue-300"
                href="{{ route('edit.guru', $guru->id) }}">
                Edit
            </a>

            <a class="inline-block rounded mx-2 px-6 py-3 text-sm font-medium text-white transition-colors border border-blue-700 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300"
                href="#">
                Download
            </a>
        </div> --}}
    </div>
</div>
@endsection

