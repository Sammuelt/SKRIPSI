@extends('component.print-header')

@section('content')
    <style>
        @media print {
            .no-print {
                display: none;
            }

            /* Tambahkan gaya CSS lain jika diperlukan */
        }
    </style>
 <div class="flex flex-col items-center justify-start h-screen mt-8">
    <h2 class="mb-4 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl lg:text-4xl">
        TPCP
    </h2>
 
    <div style="display: flex; margin-top: 20px;">
        <!-- Kolom Kedua -->
        <div style="flex: 1;">
            <div style="display: grid; grid-template-columns: auto auto; gap: 8px; color: #333; font-size: 12px;">
                <div style="font-weight: bold;"> {{ $kelas->nama_kelas  ?? 'Belum Ada Data'}}</div>
             <br>
                <div style="font-weight: bold;">Semester "{{ $semester->semester ?? 'Belum Ada Data' }}"</div>
                
            </div>
        </div>
    </div>
  
    <div class="max-w-screen-xl w-full mx-auto mt-8">
        <p class="text-center mt-10 text-gray-700 font-bold text-2xl">Keterangan Tingkat Pencapaian Siswa</p>
        <table class="w-full mt-5 mb-20 text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-center text-xs text-gray-700 uppercase bg-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Mata Pelajaran</th>
                    <th scope="col" class="px-6 py-3">Capaian</th>
                    <th scope="col" class="px-6 py-3">Lingkup Materi</th>
                </tr>
            </thead>
            <tbody class="text-center text-gray-700">
                @foreach ($filteredCpData as $index => $item)
                <tr class="bg-white border dark:bg-white">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4">{{ $item->mapel->nama_pelajaran }}</td>
                    <td class="px-6 py-4">{{ $item->CP }}</td>
                    <td class="px-6 py-4">{{ $item->lingkup_materi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
