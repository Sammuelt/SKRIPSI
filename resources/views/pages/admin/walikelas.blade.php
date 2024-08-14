@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center " id="print-area">

        <!-- Tampilkan pesan jika ada -->
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg relative" role="alert">
                {{ session('error') }}
                <button type="button" class="absolute top-2 right-2 text-red-500" onclick="this.parentElement.remove();">
                    &times;
                </button>
            </div>
        @endif

        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg relative" role="alert">
                {{ session('success') }}
                <button type="button" class="absolute top-2 right-2 text-green-500" onclick="this.parentElement.remove();">
                    &times;
                </button>
            </div>
        @endif

        <!-- table 1 -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Kelas</th>
                        <th scope="col" class="px-6 py-3">Wali Kelas</th>
                        <th scope="col" class="px-6 py-3 print:hidden text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Walikelas as $index => $item)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} border-b">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4">{{ $item->nama_kelas }}</td>
                            <td class="px-6 py-4">{{ $item->walikelas->nama ?? 'belum ada walikelas' }}</td>
                            <td class="px-6 py-4 print:hidden text-center">
                                <button type="button" onclick="toggleEdit('{{ $item->id }}')"
                                    class="inline-block px-4 py-2 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        </th>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4 print:hidden text-center">
                            <button type="button" id="download-btn"
                                onclick="printPage('{{ route('download.data.kelas') }}')"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                                Print
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>

    <div id="edit-modal" class="fixed inset-0 z-50 hidden bg-gray-500 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-lg font-bold mb-4">Edit Data</h2>
            <form id="edit-form" action="{{ route('update.walikelas') }}" method="POST">
                @csrf
                <input type="hidden" id="edit-id" name="id">

                <div class="grid gap-4 my-4">
                    <div>
                        <label for="walikelas" class="block text-sm font-medium text-gray-900">Pilih Walikelas</label>
                        <select name="walikelas" id="walikelas"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            required>
                            <option value="">--PILIH WALI KELAS--</option>
                            @foreach ($guru as $walikelas)
                                <option value="{{ $walikelas->id }}">{{ $walikelas->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Save</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function toggleEdit(id) {
            document.getElementById('edit-id').value = id;

            fetch(`/api/data/${id}`)
                .then(response => response.json())
                .then(data => {

                    document.getElementById('walikelas').value = data.walikelas || '';
                })
                .catch(error => console.error('Error fetching data:', error));


            document.getElementById('edit-modal').classList.remove('hidden');
        }

        function closeModal() {

            document.getElementById('edit-modal').classList.add('hidden');
        }

        function printPage(url) {
            var printWindow = window.open(url, '_blank');
            printWindow.onload = function() {
                printWindow.print();
            };
        }
    </script>
@endsection
