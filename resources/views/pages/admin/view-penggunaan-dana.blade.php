@extends('component.layout')

@section('content')
    <div class="mx-auto max-w-screen-xl p-4 sm:px-6 lg:px-8 bg-white shadow-md rounded-lg">
        <header class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900 md:text-4xl lg:text-5xl">Laporan Penggunaan Dana</h2>
        </header>

        <form id="filter-form" method="GET" action="{{ route('view.penggunaan.dana') }}" class="mb-8">
            @csrf
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="id_tahun_ajar" class="block mb-2 text-sm font-medium text-gray-900">Pilih Tahun
                        Ajaran</label>
                    <select id="id_tahun_ajar" name="id_tahun_ajar"
                        class="block w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 font-medium rounded-lg text-sm px-4 py-2.5"
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
            <input type="hidden" name="filter_action" value="1">
        </form>

        @if(request()->input('id_tahun_ajar'))
            @if($penggunaan->isEmpty())
                <div class="bg-white shadow-md rounded-lg mt-5 p-6">
                    <p class="text-gray-500 text-center">Belum ada data untuk tahun ajaran yang dipilih.</p>
                </div>
            @else
                <button type="button" id="download-btn"
                onclick="printPage('{{ route('download.penggunaan.dana',['id' => $idTahunAjar]) }}')"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                Print
            </button>

            <div class="bg-white shadow-md rounded-lg mt-5 p-6">
                    <h2 class="text-xl font-semibold mb-4">Penggunaan Dana</h2>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Kode
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama
                                    Barang</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Harga/pcs</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Qty
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Total
                                    Biaya</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($penggunaan as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $item->barang->kode }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->barang->nama_barang }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp.
                                        {{ number_format($item->barang->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->jumlah }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp.
                                        {{ number_format($item->total_biaya, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr class="bg-gray-50">
                                <td class="px-6 py-3 text-sm font-medium text-gray-900" colspan="4">Total</td>
                                <td class="px-6 py-3 text-sm font-medium text-gray-900">Rp.
                                    {{ number_format($totalpembelian, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="bg-white shadow-md rounded-lg mt-5 p-6">
                    <h2 class="text-xl font-semibold mb-4">Rincian</h2>
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Total Pemasukan/Tahun Ajaran</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rp.
                                    {{ number_format($totalpemasukan, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Total Pembelian/Tahun Ajaran</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rp.
                                    {{ number_format($totalpembelian, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">Hasil</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-500">Rp.
                                    {{ number_format($hasil, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        @else
            <div class="bg-white shadow-md rounded-lg mt-5 p-6">
                <p class="text-gray-500 text-center">Silakan pilih tahun ajaran terlebih dahulu untuk melihat data.</p>
            </div>
        @endif
    </div>

    <script>
        function submitForm() {
            document.getElementById('filter-form').submit();
        }

        function printPage(url) {
            var printWindow = window.open(url, '_blank');
            printWindow.onload = function() {
                printWindow.print();
            };
        }
    </script>
@endsection
