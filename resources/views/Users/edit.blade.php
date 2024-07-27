@extends('layouts.master')

@push('styles')
    @livewireStyles   
@endpush

@push('scripts')
    @livewireScripts 
@endpush

@section('content')
    <div class="container">
        <div class="mb-4">
            <a href="{{ route('users.home') }}" class="btn btn-primary">Kembali</a>
        </div>
        {{-- <h1 class="mb-4">Edit Data User</h1> --}}
        <div class="row mb-4">
            <div class="col-md-6">
                {{-- disamakan dengan controller edit --}}
                @livewire('user-edit', ['user'=>$user])          
            </div>
        </div>
    </div>
@endsection