<div>
    @include('my_components.alert_success')
    <!-- Button trigger modal -->
    <div class="mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
            Add User
        </button>
    </div>

    <div class="mb-3">
        <input type="text" class="form-control" wire:model.live="search" placeholder="Cari User...">
    </div>
    @include('livewire.user-edit')

    {{-- <!-- Button TAMBAH DATA -->
    <div class="mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-primary">+ Tambah Data User</a>
    </div> --}}

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Foto</th>
                <th>Action</th>
            </tr>
        </thead>

        <body>
            @foreach ($users as $index => $item)
                <tr>
                    <td>{{ $users->firstItem() + $index }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        @if ($item->foto)
                            <img src="{{ Storage::url($item->foto) }}" alt={{ $item->name }} width="50">
                        @else
                            Tidak punya Foto!
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('users.details', $item->id) }}" class="badge bg-primary">Detail</a>
                        {{-- <a href="{{ route('users.edit', $item->id) }}" class="badge bg-warning" >Edit</a> --}}

                        <button class="btn badge bg-warning" data-bs-toggle="modal" data-bs-target="#editModal"
                            wire:click="userEdit({{ $item }})">Update</button>

                        <button wire:click="delete({{ $item->id }})" wire:confirm="Apakah yakin ingin hapus?"
                            class="btn badge bg-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </body>
    </table>
    {{ $users->links() }}
</div>
