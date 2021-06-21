@extends('master')

@section('content')
<div class="card mt-5">
    <div class="card-header">
        <div class="row">
            <div class="col-md-8">
                <form>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan Username kemudian Enter">
                </form>
            </div>
            <div class="col-md-4">
                <a href="{{route('user.create')}}" class="btn btn-primary">Tambah User</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div>
            @include('plugin.alert')
            @include('plugin.alert-error')
        </div>
        <div class="table responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>No Telepon</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="{{route('user.edit', $item->id)}}">Edit</a>
                                <a class="btn btn-sm btn-danger" onclick="return confirm('Anda Yakin Hapus User ini?')" href="{{route('user.show', $item->id)}}">Hapus</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Tidak Ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        <div>
            {{$users->links()}}
        </div>
    </div>
</div>

@endsection
