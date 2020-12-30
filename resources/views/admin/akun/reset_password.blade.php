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
                    <form action="{{route('teknisi.reset_password')}}" method="post" autocomplete="off">
                        @csrf

                        <input type="hidden" name="id_teknisi" value="{{$user_id}}">


                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div class="form-group center">
                            <input type="submit" name="submit" class="btn btn-success" value="Reset Password">
                        </div>

                    </form>


                </div>
            </div>

        </div>


    </div>
    <!-- DataTales Example -->



</div>

@endsection