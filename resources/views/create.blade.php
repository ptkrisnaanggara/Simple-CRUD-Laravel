@extends('master')
@section('content')
<div class="card mt-5">
    <div class="card-header">
        <h5 class="card-title">Silakan Lengkapi Form dibawah</h5>
    </div>
    <div class="card-body">
        <div>
            @include('plugin.alert')
            @include('plugin.alert-error')
        </div>
        <form action="{{route('user.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>No Telepon</label>
                <input class="form-control" name="phone" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">SIMPAN</button>
            </div>
        </form>
    </div>
</div>
@endsection
