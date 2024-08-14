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
    <div style="display: flex; flex-direction: column; justify-content: center;">
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

        <div style="max-width: 1200px; width: 100%; margin: auto;">
            <table
                style="width: 100%; margin-top: 40px; font-size: 14px; text-align: left; color: #333; border-collapse: collapse;">
                <thead style="text-align: center;">
                    <tr style="background-color: #f0f0f0;">
                        <th style="padding: 12px; width: 10%;">No</th>
                        <th style="padding: 12px; width: 30%;">Mata Pelajaran</th>
                        <th style="padding: 12px; width: 10%;">Nilai</th>
                        <th style="padding: 12px; width: 50%;">Capaian Kompetensi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomor = 1;
                    @endphp
                    @foreach ($raports as $dataRaport)
                        <tr style="background-color: white; border: 1px solid #ddd;">
                            <td style="padding: 12px; text-align: center; font-weight: bold;">
                                {{ $nomor++ }}
                            </td>
                            <td style="padding: 12px; font-weight: bold;">
                                {{ $dataRaport->mapel->nama_pelajaran ?? 'Mata Pelajaran Tidak Ditemukan' }}
                            </td>
                            <td style="padding: 12px; text-align: center; font-weight: bold;">
                                {{ $dataRaport->nilai }}
                            </td>
                            <td style="padding: 12px; font-weight: bold; text-align: justify;">
                                <div style="margin-bottom: 8px; padding-left: 20px;">
                                    {{ $dataRaport->kelebihan_kompetensi }}
                                </div>
                                <hr style="border-top: 1px solid #ddd; margin: 8px 0;">
                                <div style="padding-left: 20px;">
                                    {{ $dataRaport->kekurangan_kompetensi }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p style="padding: 12px 0; font-weight: bold; background-color: white;">EKSTRAKULIKULER</p>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="padding: 8px; border: 1px solid #ddd; width: 5%;">No</th>
                        <th style="padding: 8px; border: 1px solid #ddd; width: 25%;">Ekstrakulikuler</th>
                        <th style="padding: 8px; border: 1px solid #ddd; width: 10%;">Predikat</th>
                        <th style="padding: 8px; border: 1px solid #ddd; width: 60%;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomor = 1;
                    @endphp
                    @forelse ($ekskul as $raport)
                        <tr>
                            <td style="padding: 8px; border: 1px solid #ddd;">{{ $nomor++ }}</td>
                            <td style="padding: 8px; border: 1px solid #ddd;">
                                {{ $raport->nama_ekstrakurikuler }}
                            </td>
                            <td style="padding: 8px; border: 1px solid #ddd;">
                                {{ $raport->predikat }}
                            </td>
                            <td style="padding: 8px; border: 1px solid #ddd;">
                                {{ $raport->keterangan }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding: 8px; border: 1px solid #ddd; text-align: center;">
                                Tidak Ada Data
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div style="max-width: 1200px; width: 100%; margin: 0 auto; margin-top: 2rem;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <!-- Kolom Pertama -->
                    <div style="display: flex; flex-direction: column; font-size: 0.875rem;">
                        <!-- Menggunakan grid untuk tata letak label dan nilai -->
                        <div style="display: grid; grid-template-columns: auto; gap: 8px; margin-bottom: 1rem;">
                            @forelse ($datahadir as $hadir)
                                <!-- Menyusun Sakit, Alpha, dan Izin dalam urutan yang diinginkan -->
                                <div style="display: flex; justify-content: space-between; padding: 0.5rem 1rem; font-weight: bold;">
                                    <span>Sakit</span>
                                    <span>: {{ $hadir->sakit ?? '0' }} Hari</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; padding: 0.5rem 1rem; font-weight: bold;">
                                    <span>Alpha</span>
                                    <span>: {{ $hadir->alpha ?? '0' }} Hari</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; padding: 0.5rem 1rem; font-weight: bold;">
                                    <span>Izin</span>
                                    <span>: {{ $hadir->izin ?? '0' }} Hari</span>
                                </div>
                            @empty
                                <!-- Menyusun Sakit, Alpha, dan Izin dengan data default -->
                                <div style="display: flex; justify-content: space-between; padding: 0.5rem 1rem; font-weight: bold;">
                                    <span>Sakit</span>
                                    <span>: 0 Hari</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; padding: 0.5rem 1rem; font-weight: bold;">
                                    <span>Alpha</span>
                                    <span>: 0 Hari</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; padding: 0.5rem 1rem; font-weight: bold;">
                                    <span>Izin</span>
                                    <span>: 0 Hari</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
            
                    <!-- Kolom Kedua -->
                    <div style="display: flex; flex-direction: column; font-size: 0.875rem;">
                        <!-- Menggunakan grid untuk tata letak label dan nilai -->
                        <div style="display: grid; grid-template-columns: auto; gap: 8px; margin-bottom: 1rem;">
                            @if ($semester == 1)
                                <div style="padding: 0.5rem;">
                                    Berdasarkan pencapaian tujuan pembelajaran pada semester ganjil, peserta didik ditetapkan :
                                </div>
                            @else
                                <div style="padding: 0.5rem;">
                                    Berdasarkan pencapaian tujuan pembelajaran pada semester ganjil dan genap, peserta didik ditetapkan :
                                </div>
                            @endif
            
                            <div style="padding: 0.5rem;">
                                Naik kelas : 3
                            </div>
                            <div style="padding: 0.5rem;">
                                Tinggal kelas :
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            

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
@endsection
