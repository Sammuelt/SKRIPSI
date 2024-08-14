<span class="inline-flex -space-x-px overflow-hidden rounded-md border bg-white shadow-sm">
    <a href="{{ route('show.siswa', $item->id) }}" class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
        Detail
    </a >
    <a href="{{ route('edit.siswa', $item->id) }}" class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
        Edit
    </a >
    <form action="{{ route('destroy.siswa', $item->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
            Delete
        </button>
    </form>    
</span>
