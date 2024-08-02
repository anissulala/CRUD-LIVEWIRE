{{-- <div>
    <div class="mb-3">
        <input type="text" wire:model.live ="nama">
    </div>
    Namaku adalah {{ $nama }}
</div> --}}

<div>
    <button wire:click="increment">+</button>
    <h1>{{ $count }}</h1>
</div>
