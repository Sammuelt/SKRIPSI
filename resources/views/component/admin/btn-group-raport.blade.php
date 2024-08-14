<span class="inline-flex -space-x-px overflow-hidden rounded-md border bg-white shadow-sm">
    <a href="{{ route('show.raport.akademik', $item->id) }}" class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
        Akademik
    </a >

    <a href="{{ route('show.raport.mbkm', $item->id) }}" class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
        MBKM
    </a>
    {{-- <form action="" method="post">
        @method('destroy')
        <button type="submit" class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
            Delete
        </button>
    </form> --}}
</span>
