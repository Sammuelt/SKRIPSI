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
        RAPOR PROYEK PENGUATAN
    </h2>
    <h2 class="mb-8 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl lg:text-4xl">
        PROFIL PELAJAR PANCASILA
    </h2>

    <div style="display: flex; margin-top: 20px;">
        <!-- Kolom Pertama -->
        <div style="flex: 1; margin-right: 10px;">
            <div style="display: grid; grid-template-columns: auto auto; gap: 8px; font-size: 12px;">
                <div style="font-weight: bold;">Nama Peserta Didik</div>
                <div>: {{ $data->siswa->nama_lengkap }}</div>
    
                <div style="font-weight: bold;">NISN</div>
                <div>: {{ $data->siswa->nisn }}</div>
    
                <div style="font-weight: bold;">Sekolah</div>
                <div>: SDN 3 Sungai Tiung</div>
    
                <div style="font-weight: bold;">Alamat</div>
                <div>: Sungai Tiung</div>
            </div>
        </div>
    
        <!-- Kolom Kedua -->
        <div style="flex: 1;">
            <div style="display: grid; grid-template-columns: auto auto; gap: 8px; color: #333; font-size: 12px;">
                <div style="font-weight: bold;">Kelas</div>
                <div>: {{ $data->kelas->nama_kelas }}</div>
    
                <div style="font-weight: bold;">Fase</div>
                <div>: ""</div>
    
                <div style="font-weight: bold;">Semester</div>
                <div>: {{ $data->semester->semester ?? 'Belum Ada Data' }}</div>
    
                <div style="font-weight: bold;">Tahun Ajaran</div>
                <div>: {{ $data->tahunAjaran->tahun_ajaran ?? 'Belum Ada Data' }}</div>
            </div>
        </div>
    </div>
    
    
    <div class="text-left max-w-screen-xl w-full mx-auto mt-8 px-8">
        <p class="mb-4 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-2xl">
            PROYEK
        </p>
        <p class="mb-3 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-2xl">
            @foreach ($uniqueProjectTitles as $projectTitle)
            <p class="mb-3 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-2xl">
                {{ $projectTitle ?? 'Belum Ada Data' }}
            </p>
        @endforeach
        </p>
        <table class="w-full border-collapse">
            <tr>
                <td>
                    @foreach ($uniqueProjectSubTitles as $projectSubTitle)
                    <p class="mb-3 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-2xl">
                        {{ $projectSubTitle ?? 'Belum Ada Data' }}
                    </p>
                @endforeach
                </td>
            </tr>
        </table>
    </div>

    <div class="max-w-screen-xl w-full mx-auto mt-8">
        <table class="w-full border-collapse">
            <thead class="uppercase bg-blue-400">
                @foreach ($uniqueProjectTitles as $projectTitle)
                    <tr>
                        <th class="px-4 py-2 border border-gray-300" style="width: 50%;">{{ $projectTitle }}</th>
                        <th class="px-4 py-2 border border-gray-300" style="width: 10%;">Nilai</th>
                    </tr>
                @endforeach
            </thead>
            <tbody>
                @foreach ($raports as $index => $Raportelemen)
                    @if ($index === 0 || $dataRaports[$index - 1]->capaian_mbkm->element !== $Raportelemen->capaian_mbkm->element)
                        <!-- Display element -->
                        <tr class="uppercase bg-grey-100">
                            <td class="px-4 py-2 border-l border-2 border-gray-300 bg-gray-300" colspan="2">
                                {{ $Raportelemen->capaian_mbkm->element ?? 'Belum Ada Data' }}
                            </td>
                        </tr>
                    @endif
    
                    <!-- Display sub-element -->
                    @foreach ($raports as $subelemen)
                        @if ($subelemen->capaian_mbkm->element === $Raportelemen->capaian_mbkm->element)
                            <tr class="px-4 py-2 border border-gray-300 ">
                                <td class="px-4 py-2 border border-gray-300">{{ $subelemen->capaian_mbkm->sub_elemen ?? 'Belum Ada Data' }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $subelemen->nilai_Mbkm->nilai ?? 'Belum Ada Data' }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <h3 class="mt-5  px-10 ">
            Catatan Proses <br>
            <span
                class="ms-15">{{$uniqueProjectCP}}</span>
        </h3>


        <p class="text-center mt-10 text-gray-700 font-bold text-2xl">Keterangan Tingkat Pencapaian Siswa</p>
        <table class="w-full mt-5 mb-20 text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-center text-xs text-gray-700 uppercase bg-gray-200">
                <tr >
                    <th scope="col" class="px-6 py-3">BB</th>
                    <th scope="col" class="px-6 py-3">MB</th>
                    <th scope="col" class="px-6 py-3">BSH</th>
                    <th scope="col" class="px-6 py-3">BB</th>

                </tr>
            </thead>
            <tbody class=" text-center text-gray-700">
                <tr class="bg-white border dark:bg-white">
                    <td class="px-6 py-4">Belum Berkembang</td>
                    <td class="px-6 py-4">Mulai Berkembang</td>
                    <td class="px-6 py-4">Berkembang sesuai harapan</td>
                    <td class="px-6 py-4">Sangat Berkembang</td>
                    
                </tr>
                <tr class="bg-white border dark:bg-white">
                    <td class="px-6 py-4">Siswa masih membutuhkan bimbingan dalam mengembangkan kemampuan	</td>
                    <td class="px-6 py-4">Siswa mulai mengembangkan kemampuan namun masih belum ajek	</td>
                    <td class="px-6 py-4">Siswa telah mengembangkan kemampuan hingga berada dalam tahap ajek	</td>
                    <td class="px-6 py-4">Siswa mengembangkan kemampuannya melampaui harapan	</td>
                </tr>
            </tbody>
        </table>

            <div style="display: flex; justify-content: space-between; margin-top: 40px;">
                <div style="text-align: center; width: 30%;">
                    <p>Orang Tua/Wali</p>
                    <br><br><br>
                    <p>(...................................)</p>
                </div>
                <div style="text-align: center; width: 30%;">
                    <p>Wali Kelas</p>
                    <br><br><br>
                    <p>(...................................)</p>
                </div>
                <div style="text-align: center; width: 30%;">
                    <p>Kepala Sekolah</p>
                    <br><br><br>
                    <p>(...................................)</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
