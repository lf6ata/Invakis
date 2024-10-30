<form action="" method="POST" class="d-inline" id="delete-form-{{ $item->id }}">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $item->id }})">Hapus</button>
</form>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
    </script>
    