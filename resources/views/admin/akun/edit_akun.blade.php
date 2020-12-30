@extends('admin.template.header')


@section('title', $title)


@section('body')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-8">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{$header_title}}</h6>
                </div>
                <div class="card-body">
                    <!-- Form Start Here -->
                    <form action="{{route('teknisi.update')}}" method="post" autocomplete="off">
                        @csrf

                        <input type="hidden" name="id_teknisi" value="{{$user->id}}">


                        <div class="form-group">
                            <label>Nama Teknisi</label>
                            <input type="text" name="nama" class="form-control" value="{{$user->nama}}">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="{{$user->email}}">
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="{{$user->username}}" readonly>
                        </div>


                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" value="{{$user->jabatan}}">
                        </div>


                        <div class="form-group">
                            <label>No. Telp</label>
                            <input type="text" name="no_telp" class="form-control" value="{{$user->no_telp}}">
                        </div>

                        <div class="form-group center">
                            <input type="submit" name="submit" class="btn btn-success" value="Update Akun">
                            <a href="{{ route('teknisi.password', $user->id) }}" class="btn btn-warning">Ganti Password</a>
                            <a href="{{url()->previous()}}" class="btn btn-primary">Kembali</a>
                        </div>

                    </form>


                </div>
            </div>

        </div>


    </div>
    <!-- DataTales Example -->



</div>

@endsection