@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="mb-4">
            <a href="{{ route('users.home') }}" class="btn btn-primary">Kembali</a>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label"><b>Name</b></label>
            {{-- disabled biar tidak bida mengganti detail nama --}}
            <input type="text" class="form-control" value="{{ $user->name }}" disabled>  
        </div>
        <div class="mb-3">
            <label for="email" class="form-label"><b>Email</b></label>
            <input type="text" class="form-control" value="{{ $user->email }}" disabled>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label"><b>Foto</b></label>
            <div>
                <img src="{{ Storage::url( $user->foto ) }}" alt="{{  $user->foto  }}" width="100">

            </div>

            
        </div>
    </div>
@endsection