<span class="inline-flex -space-x-px overflow-hidden rounded-md border bg-white shadow-sm">
    <button onclick="toggleDetails('{{ $item->id }}')"
        class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
        View
    </button>
    

    <button id="edit-modal" type="button"
    class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative"
    onclick="openEditModal(
          '{{ $item->id }}',
        '{{ $nilaiRapor->id }}',
        '{{ $nilaiRapor->id_mapel }}',
        '{{ $nilaiRapor->id_siswa }}',
        '{{ $nilaiRapor->id_kelas }}',
        '{{ $nilaiRapor->id_semester }}',
        '{{ $nilaiRapor->id_tahun_ajar }}',
        '{{ $nilaiRapor->nilai }}',
        '{{ $nilaiRapor->kekurangan_kompetensi }}',
        '{{ $nilaiRapor->kelebihan_kompetensi }}',
    )">
    Edit
</button>
@include('component.user.modal-edit-nilai-akademik')

    {{-- Tombol Delete --}}
    {{-- <form action="{{ route('destroy.guru', $item->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="inline-block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:relative">
            Delete
        </button>
    </form> --}}
</span>

<script>
       
    function openEditModal(mapelId,Id, nilaiId, idSiswa, idKelas, idSemester, idTahunAjar, idMapel, nilai) {
        // Set values to hidden input fields in the modal
        document.getElementById('mapelId').value = mapelId;
        document.getElementById('nilaiId').value = nilaiId;
        document.getElementById('id').value = Id;
        document.getElementById('id_siswa').value = idSiswa;
        document.getElementById('id_kelas').value = idKelas;
        document.getElementById('id_semester').value = idSemester;
        document.getElementById('id_tahun_ajar').value = idTahunAjar;

        document.getElementById('id_mapel').value = idMapel;
        document.getElementById('nilai').value = nilai;
        // Show the modal
        document.getElementById('edit-modal').classList.add('block');
        document.getElementById('edit-modal').classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.querySelector('.modal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    
    }
</script>
