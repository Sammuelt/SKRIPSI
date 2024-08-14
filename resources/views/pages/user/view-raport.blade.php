@extends('component.layout')

@section('content')


<form action="{{ route('update.kelas.siswa') }}" method="POST">
    @csrf
    @method('PUT')
    <!-- Masukkan input form lainnya di sini -->
    
    <input type="hidden" name="id_siswa" value="{{ $idSiswa }}">
    <button type="submit" class="px-4 py-2 bg-blue-500 w-full text-white rounded-lg hover:bg-blue-600">
        Submit Raport
    </button>

    <div class="flex flex-col items-center justify-start h-screen mt-8">
        <h1 class="mb-4 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl lg:text-4xl">
            LAPORAN HASIL BELAJAR
        </h1>
        <h3 class="mb-8 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl lg:text-4xl">
            (RAPORT)
        </h3>

        <div class="max-w-screen-xl w-full mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-20 mt-8">
            <div class="flex flex-col">
                <div class="relative overflow-x-auto bg-white dark:bg-white">
                    <table
                        class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                        <tbody>
                            <tr>
                                <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Nama Peserta Didik <span class="float-right">:</span>
                                </td>
                                <td class="px-4 py-2 text-left">
                                    {{ $dataRaports->isEmpty() ? 'Data Tidak Ditemukan' : $dataRaports->first()->siswa->nama_lengkap ?? 'Nama Tidak Ditemukan' }}
                                </td>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    NISN <span class="float-right">:</span>
                                </td>
                                <td class="px-4 py-2 text-left">
                                    {{ $dataRaports->isEmpty() ? 'Data Tidak Ditemukan' : $dataRaports->first()->siswa->nisn ?? 'Nama Tidak Ditemukan' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Sekolah <span class="float-right">:</span>
                                </td>
                                <td class="px-4 py-2 text-left">
                                    SDN 3 Sungai Tiung
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Alamat <span class="float-right">:</span>
                                </td>
                                <td class="px-4 py-2 text-left">
                                    Sungai Tiung
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex flex-col">
                <div class="relative overflow-x-auto bg-white dark:bg-white">
                    <table
                        class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                        <tbody>
                            @if ($dataRaports->count() > 0)
                                @php
                                    $dataRaport = $dataRaports->first();
                                @endphp
                                <tr>
                                    <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                        Kelas <span class="float-right">:</span>
                                    </td>
                                    <td class="px-4 py-2 text-left">
                                        {{ $dataRaports->isEmpty() ? 'Data Tidak Ditemukan' : $dataRaports->first()->kelas->nama_kelas ?? 'Nama Tidak Ditemukan' }}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Fase <span class="float-right">:</span>
                                </td>
                                <td class="px-4 py-2 text-left">

                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Semester <span class="float-right">:</span>
                                </td>
                                <td class="px-4 py-2 text-left">
                                    {{ $dataRaports->isEmpty() ? 'Data Tidak Ditemukan' : $dataRaports->first()->semester->semester ?? 'Nama Tidak Ditemukan' }}
                                </td>
                            </tr>
                            @if ($dataRaports->count() > 0)
                                <tr>
                                    <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                        Tahun Ajaran <span class="float-right">:</span>
                                    </td>
                                    <td class="px-4 py-2 text-left">
                                        {{ $dataRaports->isEmpty() ? 'Data Tidak Ditemukan' : $dataRaports->first()->tahunAjaran->tahun_ajaran ?? 'Nama Tidak Ditemukan' }}
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                        Tahun Ajaran <span class="float-right">:</span>
                                    </td>
                                    <td class="px-4 py-2 text-left">
                                        Belum Ada Data
                                    </td>
                                </tr>
                            @endif

                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <table class="w-full mt-10 mx-auto text-sm text-left text-gray-900 dark:text-black dark:bg-white border-collapse">
            <thead>
                <tr class="bg-gray-200 dark:bg-gray-200">
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Mata Pelajaran</th>
                    <th class="px-6 py-3">Nilai</th>
                    <th class="px-6 py-3">Kelebihan Kompetensi</th>
                    <th class="px-6 py-3">Kekurangan Kompetensi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $nomor = 1;
                @endphp
                @foreach ($dataRaports as $dataRaport)
                    <tr class="bg-white border-b dark:bg-white">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $nomor++ }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $dataRaport->mapel->nama_pelajaran ?? 'Mata Pelajaran Tidak Ditemukan' }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $dataRaport->nilai }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $dataRaport->kelebihan_kompetensi }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $dataRaport->kekurangan_kompetensi }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="px-3 py-5 font-medium whitespace-nowrap bg-white dark:text-black">EKSTRAKULIKULER</p>
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2 border border-gray-300" style="width: 5%;">No</th>
                    <th class="px-4 py-2 border border-gray-300" style="width: 25%;">Ekstrakulikuler</th>
                    <th class="px-4 py-2 border border-gray-300" style="width: 10%;">predikat</th>
                    <th class="px-4 py-2 border border-gray-300" style="width: 60%;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $nomor = 1;
                @endphp
                @foreach ($dataekskuls as $raport)
                    <tr>
                        <td class="px-4 py-2 border border-gray-300"> {{ $nomor++ }}</td>
                        <td class="px-4 py-2 border border-gray-300">
                            {{ $raport->ekstrakulikuler->ekstrakulikuler ?? 'Mata Pelajaran Tidak Ditemukan' }}
                        </td>
                        </td>
                        <td class="px-4 py-2 border border-gray-300"> {{ $raport->predikat }}

                        </td>
                        <td class="px-4 py-2 border border-gray-300"> {{ $raport->keterangan }}

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="max-w-screen-xl w-full mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-20 mt-8">
            <div class="flex flex-col">
                <div class="relative overflow-x-auto bg-white dark:bg-white">
                    <table
                        class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                        <tbody>
                            @foreach ($datahadir as $hadir)
                                <tr>
                                    <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                        Sakit <span class="float-right">:</span>
                                    </td>
                                    <td class="px-4 py-2 text-left">
                                        {{ $hadir->sakit ?? 'ekstrakulikuler Tidak Ditemukan' }} Hari
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                        Izin <span class="float-right">:</span>
                                    </td>
                                    <td class="px-4 py-2 text-left">
                                        {{ $hadir->izin ?? ' ekstrakulikuler Tidak Ditemukan' }} Hari
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                        Alpha <span class="float-right">:</span>
                                    </td>
                                    <td class="px-4 py-2 text-left">
                                        {{ $hadir->alpha ?? ' ekstrakulikuler Tidak Ditemukan' }} Hari
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex flex-col">
                <div class="relative overflow-x-auto bg-white dark:bg-white">
                    <table
                        class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                        <tbody>
                            @if ($idSemester == 1)
                                <tr>
                                    <td class="px-4 py-2 text-left">
                                        Berdasarkan pencapaian tujuan pembelajaran pada semester ganjil, peserta didik
                                        ditetapkan :
                                    </td>
                                </tr>

                                <tr>
                                    <td class="px-4 py-2 text-left">
                                        Naik kelas : -
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 text-left">
                                        Tinggal kelas :
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td class="px-4 py-2 text-left">
                                        Berdasarkan pencapaian tujuan pembelajaran pada semester ganjil dan genap, peserta
                                        didik ditetapkan :
                                    </td>
                                </tr>
                                <tr>

                                    <td class="px-4 py-2 text-left">
                                        Naik kelas :
                                        <div>
                                            <select id="naik" name="naik"
                                                class="w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5"
                                                onchange="handleNaikKelasChange()">
                                                <option value="">-</option>
                                                @foreach ($clases as $kls)
                                                    <option value="{{ $kls->id }}"
                                                        {{ request()->input('id_kelas') == $kls->id ? 'selected' : '' }}>
                                                        {{ $kls->nama_kelas }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>



                                </tr>
                                <tr id="tinggal-kelas-row">
                                    <td class="px-4 py-2 text-left">
                                        Tinggal kelas :
                                    </td>
                                </tr>
                            @endif




                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
        <div class="max-w-screen-xl w-full mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-20 mt-8">
            <div class="flex flex-col">
                <div class="relative overflow-x-auto bg-white dark:bg-white">
                    <table
                        class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                        <tbody>
                            <tr>
                                <td class="px-4 py-2 ">
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Orang Tua/Wali
                                </td>
                            </tr>

                            <tr>
                                <td class="px-4 py-2 ">
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 ">
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 ">
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 ">
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 ">
                                    __________________________
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex flex-col md:col-start-2 md:col-span-1 lg:col-start-3 lg:col-span-1">
                <div class="relative overflow-x-auto bg-white dark:bg-white">
                    <table
                        class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                        <tbody>
                            <tr>
                                <td class="px-10 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Kota Banjarbaru,
                                </td>
                                <td class="px-4 py-2 text-left"></td>
                            </tr>
                            <tr>
                                <td class="px-10 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Wali Kelas
                                </td>
                                <td class="px-4 py-2 text-left"></td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 ">
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 ">
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 ">
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 ">
                                    _______________________________
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 ">
                                    NIP
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <div class="relative overflow-x-auto bg-white dark:bg-white">
                    <table
                        class="w-full mx-auto text-sm text-left rtl:text-right text-gray-900 dark:text-black dark:bg-white border-collapse">
                        <tbody>
                            <tr>
                                <td class="px-10 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Mengetahui,
                                </td>
                                <td class="px-4 py-2 text-left"></td>
                            </tr>
                            <tr>
                                <td class="px-10 md:px-8 font-medium whitespace-nowrap bg-white dark:text-black">
                                    Kepala Sekolah
                                </td>
                                <td class="px-4 py-2 text-left"></td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 ">
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 ">
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 ">
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 ">
                                    _______________________________
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 ">
                                    NIP
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
<script>
    function handleNaikKelasChange() {
        const naikKelasSelect = document.getElementById('naik');
        const selectedClassIdInput = document.getElementById('selected_class_id');
        const tinggalKelasRow = document.getElementById('tinggal-kelas-row');

        if (naikKelasSelect.value === "") {
            tinggalKelasRow.innerHTML = `<td class="px-4 py-2 text-left">
                                            Tinggal kelas : Tidak naik kelas
                                         </td>`;
            selectedClassIdInput.value = ""; // Clear the hidden input if no class is selected
        } else {
            tinggalKelasRow.innerHTML = `<td class="px-4 py-2 text-left">
                                            Tinggal kelas :
                                         </td>`;
            selectedClassIdInput.value = naikKelasSelect.value; // Set the hidden input value to the selected class ID
        }
    }

    // Set initial value for the hidden input when page loads
    window.onload = function() {
        handleNaikKelasChange();
    };
</script>
