@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center " id="print-area">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Detail Siswa ( {{ $siswa->nama_lengkap }} )
        </h1>
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
                    <dd class="text-gray-700 sm:col-span-2">{{ $siswa->kelas->nama_kelas }}</dd>
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

            <div class="flex flex-row justify-end py-3 print:hidden">
                <a class="inline-block rounded border border-blue-700 mx-2 px-8 py-3 text-sm font-medium text-blue-700 transition-colors hover:bg-blue-800 hover:text-white focus:ring-4 focus:ring-blue-300"
                    href="{{ route('edit.siswa', $siswa->id) }}">
                    Edit
                </a>

                <button type="button" id="download-btn"
                    onclick="printPage('{{ route('download.detail.siswa', ['id' => $siswa->id]) }}')"
                    class="inline-block rounded border border-blue-700 mx-2 px-8 py-3 text-sm font-medium text-blue-700 transition-colors hover:bg-blue-800 hover:text-white focus:ring-4 focus:ring-blue-300">
                    Print
                </button>
            </div>
        </div>
    </div>

    <script>
        function printPage(url) {
            var printWindow = window.open(url, '_blank');
            printWindow.onload = function() {
                printWindow.print();
            };
        }
    </script>
@endsection
