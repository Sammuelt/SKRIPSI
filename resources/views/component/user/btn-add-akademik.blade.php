<span class="inline-flex -space-x-px overflow-hidden rounded-md border bg-white shadow-sm">
    
    <button type="button" class="inline-block px-4 py-2 text-white text-sm font-medium bg-blue-500 hover:bg-blue-600  focus:relative"
        data-modal-toggle="crud-modal" data-id="{{ optional($item)->id }}">
        Add
    </button>

    @include('component.user.modal-nilai')

 
</span>
