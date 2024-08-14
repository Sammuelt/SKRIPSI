<span class="inline-flex -space-x-px overflow-hidden rounded-md border bg-white shadow-sm">

    <a href="{{ route('show.raport.siswa', [
        'id_kelas' => request()->input('id_kelas'),
        'id_tahun_ajar' => request()->input('id_tahun_ajar'),
        'id_semester' => request()->input('id_semester'),
        'id' => $item->id
    ]) }}" 
     class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
        view
    </a >

    {{-- <form action="{{ route('destroy.guru', $item->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
            Delete
        </button>
    </form> --}}
</span>
