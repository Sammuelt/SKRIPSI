@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Input Ekstrakulikuler
        </h1>
        <form id="filter-form" method="GET" action="{{ route('show.ekskul.byFilter') }}">
            @csrf
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="id_kelas" class="block mb-2 text-sm font-medium text-gray-900">Pilih Kelas</label>
                    <select id="id_kelas" name="id_kelas"
                        class="w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5"
                        onchange="submitForm()">
                        <option value="">--PILIH KELAS--</option>
                        @foreach ($clases as $kls)
                            <option value="{{ $kls->id }}"
                                {{ request()->input('id_kelas') == $kls->id ? 'selected' : '' }}>
                                {{ $kls->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="id_tahun_ajar" class="block mb-2 text-sm font-medium text-gray-900">Pilih Tahun
                        Ajaran</label>
                    <select id="id_tahun_ajar" name="id_tahun_ajar"
                        class="w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5"
                        onchange="submitForm()">
                        <option value="">--PILIH TAHUN AJARAN--</option>
                        @foreach ($tahunajarans as $TA)
                            <option value="{{ $TA->id }}"
                                {{ request()->input('id_tahun_ajar') == $TA->id ? 'selected' : '' }}>
                                {{ $TA->tahun_ajaran }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="id_siswa" class="block mb-2 text-sm font-medium text-gray-900">Pilih Siswa</label>
                    <select id="id_siswa" name="id_siswa"
                        class="w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5"
                        onchange="submitForm()">
                        <option value="">--PILIH NAMA SISWA--</option>
                        @foreach ($siswas as $siswa)
                            <option value="{{ $siswa->id }}"
                                {{ request()->input('id_siswa') == $siswa->id ? 'selected' : '' }}>
                                {{ $siswa->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="id_semester" class="block mb-2 text-sm font-medium text-gray-900">Pilih Semester</label>
                    <select id="id_semester" name="id_semester"
                        class="w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5"
                        onchange="submitForm()">
                        <option value="">--PILIH SEMESTER--</option>
                        @foreach ($semesters as $smt)
                            <option value="{{ $smt->id }}"
                                {{ request()->input('id_semester') == $smt->id ? 'selected' : '' }}>
                                {{ $smt->semester }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Hidden input to pass the selected IDs -->
            <input type="hidden" name="filter_action" value="1">
        </form>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <!-- Button to open modal -->
            <button id="open-modal" type="button"
                class="mt-4 mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Tambahkan Ekstrakulikuler Siswa
            </button>
            @include('component.user.modal-input-ekskul', ['ekskuls' => $ekskuls])
            @include('component.modal-warning')
            @include('component.user.modal-edit-nilai-ekskul')
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Ekstrakulikuler</th>
                        <th scope="col" class="px-6 py-3">Predikat</th>
                        <th scope="col" class="px-6 py-3">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomor = 1;
                        $idKelas = request()->input('id_kelas');
                        $idTahunAjar = request()->input('id_tahun_ajar');
                        $idSiswa = request()->input('id_siswa');
                        $idSemester = request()->input('id_semester');
                    @endphp
                    @if ($idKelas && $idTahunAjar && $idSiswa && $idSemester)
                        @forelse ($ekskul as $item)
                            <tr class="bg-white border-b dark:bg-white">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $nomor++ }}
                                </td>
                                <td class="px-6 py-4">{{ $item->ekstrakulikuler->ekstrakulikuler }}</td>
                                <td class="px-6 py-4">
                                    {{ $item->predikat }}
                                </td>
                                <td class="px-6 py-4">
                                    <!-- Edit Button -->
                                    <button type="button"
                                        class="edit-button mt-4 mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
                                        data-id="{{ $item->id }}"
                                        data-nama-ekstra="{{ $item->ekstrakulikuler->ekstrakulikuler }}"
                                        data-id_ekskul="{{ $item->id_ekstrakulikuler }}"
                                        data-predikat="{{ $item->predikat }}" data-id-kelas="{{ $idKelas }}"
                                        data-id-tahun-ajar="{{ $idTahunAjar }}" data-id-siswa="{{ $idSiswa }}"
                                        data-id-semester="{{ $idSemester }}">
                                        Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <button type="button"
                                        class="delete-button mt-4 mb-4 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5"
                                        data-id="{{ $item->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-white">
                                <td colspan="4" class="px-6 py-4 text-center text-gray-700">
                                    Belum ada Ekstrakulikuler yang di tambahkan <br>
                                    Mohon Tambahkan Ekstrakulikuler
                                </td>
                            </tr>
                        @endforelse
                    @else
                        <tr class="bg-white border-b dark:bg-white">
                            <td colspan="4" class="px-6 py-4 text-center text-red-700">
                                Pilih filter terlebih dahulu untuk menampilkan data.
                            </td>
                        </tr>
                    @endif
                   
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function submitForm() {
            document.getElementById('filter-form').submit();
        }

        document.getElementById('open-modal').addEventListener('click', function() {
            const idKelas = document.getElementById('id_kelas').value;
            const idTahunAjar = document.getElementById('id_tahun_ajar').value;
            const idSiswa = document.getElementById('id_siswa').value;
            const idSemester = document.getElementById('id_semester').value;

            if (idKelas && idTahunAjar && idSiswa && idSemester) {
                document.getElementById('modal-nama_siswa').value = document.getElementById('id_siswa').options[
                    document.getElementById('id_siswa').selectedIndex].text;
                document.getElementById('modal-kelas').value = document.getElementById('id_kelas').options[document
                    .getElementById('id_kelas').selectedIndex].text;
                document.getElementById('modal-semester').value = document.getElementById('id_semester').options[
                    document.getElementById('id_semester').selectedIndex].text;

                document.getElementById('modal').classList.remove('hidden');
            } else {
                document.getElementById('alert-modal').classList.remove('hidden');
            }
        });

        document.getElementById('close-alert-modal').addEventListener('click', function() {
            document.getElementById('alert-modal').classList.add('hidden');
        });

        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('modal').classList.add('hidden');
        });

        //EDIT -----------------------------------------------------------
        document.querySelectorAll('.edit-button').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');

                const idEkstrakulikuler = this.getAttribute('data-id_ekskul');
                const predikat = this.getAttribute('data-predikat');
                const idKelas = this.getAttribute('data-id-kelas');
                const idTahunAjar = this.getAttribute('data-id-tahun-ajar');
                const idSiswa = this.getAttribute('data-id-siswa');
                const idSemester = this.getAttribute('data-id-semester');

                document.getElementById('edit-id').value = id;

                document.getElementById('edit-id-ekstrakulikuler').value = idEkstrakulikuler;
                document.getElementById('edit-predikat').value = predikat;

                document.getElementById('edit-id-kelas').value = idKelas;
                document.getElementById('edit-id-tahun-ajar').value = idTahunAjar;
                document.getElementById('edit-id-siswa').value = idSiswa;
                document.getElementById('edit-id-semester').value = idSemester;

                document.getElementById('edit-modal').classList.remove('hidden');
                const namaEkstrakulikuler = this.getAttribute('data-nama-ekstra');
                document.getElementById('edit-nama-ekstra').textContent = namaEkstrakulikuler;
            });
        });

        document.getElementById('close-edit-modal').addEventListener('click', function() {
            document.getElementById('edit-modal').classList.add('hidden');
        });


        document.getElementById('edit-modal').addEventListener('click', function(event) {
            if (event.target === this) {
                document.getElementById('edit-modal').classList.add('hidden');
            }
        });

        //END EDIT -----------------------------------------------------------

        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');

                if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                    fetch(`/delete-nilai-ekskul-siswa/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                this.closest('tr').remove(); // Menghapus baris tabel
                                alert('Item berhasil dihapus.');
                            } else {
                                alert('Gagal menghapus item.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menghapus item.');
                        });
                }
            });
        });
    </script>
@endsection
