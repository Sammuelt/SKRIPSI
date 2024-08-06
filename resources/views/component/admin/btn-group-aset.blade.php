<span class="inline-flex -space-x-px overflow-hidden rounded-md border bg-white shadow-sm">
    <a href="{{ route('edit.inventaris', $aset->id) }}" class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
        Edit
    </a>

    <form action="{{ route('destroy.inventaris', $aset->id) }}" method="POST" class="inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative" onclick="return confirm('Are you sure you want to delete this item?');">
            Delete
        </button>
    </form>
</span>
