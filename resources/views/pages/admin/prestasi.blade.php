@extends('component.layout')

@section('content')
    <!-- content -->
    <div class="flex flex-col justify-center">

        <h1
            class="mb-10 text-2xl text-center font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl">
            PRESTASI
        </h1>

        <div class="flex mb-4">
            <button id="open-modal"
                class="ml-4 bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 rounded-lg">
                Tambahkan Prestasi
            </button>
            @include('component.admin.modal-add-prestasi')

            <button type="button" id="download-btn" onclick="printPage('{{ route('download.data.prestasi') }}')"
                class="ml-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-2 focus:outline-none">
                Print
            </button>
        </div>

        @foreach ($prestasi as $item)
            <div
                class="flex mb-5 w-full h-56 items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <img class="object-cover w-full rounded-t-lg h-56 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                    src="{{ $item->image_url ?? 'https://flowbite.s3.amazonaws.com/docs/jumbotron/conference.jpg' }}"
                    alt="{{ $item->title }}">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-1 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $item->title }}
                        "{{ $item->sub }}"</h5>
                    <h5 class="mb-2 text-1xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $item->siswa->nama_lengkap ?? '' }}</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Selamat kepada Ananda
                        {{ $item->siswa->nama_lengkap ?? '' }} telah {{ $item->ket }} pada tanggal {{ $item->date }}
                    </p>
                </div>
            </div>
        @endforeach

        <!-- end content -->
    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen modal dan tombol
            const openModalButton = document.getElementById('open-modal');
            const modal = document.getElementById('crud-modal');
            const closeModalButton = document.getElementById('close-modal');

            // Tampilkan modal
            openModalButton.addEventListener('click', function() {
                modal.classList.remove('hidden');
            });

            // Tutup modal
            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            // Tutup modal jika area di luar modal diklik
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
        function printPage(url) {
            var printWindow = window.open(url, '_blank');
            printWindow.onload = function() {
                printWindow.print();
            };
        }
    </script>
