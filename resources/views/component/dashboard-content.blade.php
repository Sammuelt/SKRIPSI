@foreach ($tahunAjaran as $tahun)
    @php
        // Filter kalenderSekolah berdasarkan id_tahun_ajaran
        $filteredKalender = $kalenderSekolah->where('id_tahun_ajaran', $tahun->id);
    @endphp

    @if ($filteredKalender->isNotEmpty())
        @foreach ([['smt' => 'Ganjil', 'semester' => 1], ['smt' => 'Genap', 'semester' => 2]] as $info)
            @if ($filteredKalender->where('id_semester', $info['semester'])->isNotEmpty())
                <p class="m-6 text-lg font-normal text-gray-500 lg:text-xl">
                    Aktivitas Semester {{ $info['smt'] }} {{ $tahun->tahun_ajaran }}
                </p>

                <!-- Tabel -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3">Kegiatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($filteredKalender->where('id_semester', $info['semester']) as $item)
                                <tr class="{{ $loop->odd ? 'odd:bg-white' : 'even:bg-gray-50' }} border-b">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM YYYY') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->keterangan }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            @endif
        @endforeach
    @endif
@endforeach
