 <div>
    <div class="mb-3">
        <a href="{{ route('users.home') }}" class="btn btn-primary">Kembali</a>
    </div>
    <div class="card">
        <div class="card-header">Form</div>
        <div class="card-body">
            @include('my_components.alert_success')
            <form wire:submit.prevent="store">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                      </div>   
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                      </div>   
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                      </div>   
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" wire:model="foto">
                    @error('foto')
                    <div class="invalid-feedback">
                        {{ $message }}
                      </div>   
                    @enderror      
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

nama km adalah hal yg aku suka


{{-- Backup edit --}}
<div>
    <div class="card">
        <div class="card-header">Form</div>
        <div class="card-body">
            <form wire:submit.prevent="update">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                      </div>   
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                      </div>   
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" wire:model="foto">
                    @error('foto')
                    <div class="invalid-feedback">
                        {{ $message }}
                      </div>   
                    @enderror   
                    
                    @if ($foto)
                            <img src="{{ $foto->temporaryUrl() }}" alt="foto Preview" width="100">
                        @elseif ($foto_old)
                            <img src="{{ Storage::url($foto_old) }}" alt="Current foto" width="100">
                        @endif
                </div>
                <button type="submit" class="btn btn-warning">Update</button>
            </form>
        </div>
    </div>
</div>

