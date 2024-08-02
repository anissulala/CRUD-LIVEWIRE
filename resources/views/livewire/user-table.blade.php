<div class="p-5 mx-auto max-w-md">
    @include('my_components.alert_success')
    @include('my_components.alert_offline')

    <!-- Button trigger modal -->
    <div class="mb-3">
        <button wire:offline.attr="disabled" type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#userModal">
            Add User
        </button>
    </div>

    {{-- <!-- Wire:offline alert -->
    <div wire:offline>
        <div class="alert alert-warning d-flex align-items-center p-3 mb-3" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
                <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div>
                Maaf anda sedang offline. Periksa koneksi Anda.
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div> --}}

    <!-- Search Input -->
    <div class="mb-3">
        {{-- <input type="text" class="form-control" wire:offline.remove wire:model.live="search" placeholder="Cari User..."> --}}
        <input type="text" class="form-control" wire:model.live="search" placeholder="Cari User...">
    </div>
    @include('livewire.user-edit')

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
                        <button wire:click="delete({{ $item->id }})" class="btn badge bg-danger">Delete</button>
                        <button type="button" class="btn badge bg-secondary"
                            wire:click="download({{ $item->id }})">Download</button>
                    </td>
                </tr>
            @endforeach
        </body>
    </table>
    {{ $users->links() }}
</div>
