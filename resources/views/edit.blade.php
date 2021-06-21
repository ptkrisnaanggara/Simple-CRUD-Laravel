@extends('master')
@section('content')
<div class="card mt-5">
    <div class="card-header">
        <h5 class="card-title">Edit User {{$user->username}}</h5>
    </div>
    <div class="card-body">
        <div>
            @include('plugin.alert')
            @include('plugin.alert-error')
        </div>
        <form action="{{route('user.update', $user->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Username</label>
                <input class="form-control" name="username" value="{{$user->username}}" disabled>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" value="{{$user->email}}" name="email" required>
            </div>
            <div class="form-group">
                <label>No Telepon</label>
                <input class="form-control" name="phone" value="{{$user->phone}}" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="password" placeholder="Kosongkan jika tidak ingin ganti">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
