@extends('admin.template.header')

@section('title', $title)


@section('css')
<link href={{ asset("assets/vendor/datatables/dataTables.bootstrap4.min.css") }} rel="stylesheet">
@endsection


@section('body')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{$header_title}}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>No. SPK</th>
                            <th>Tanggal Out</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lists as $list)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$list->no_spk}}</td>
                            <td>{{$list->tgl_pekerjaan}}</td>
                            <td>{{$list->ket_pekerjaan}}</td>
                            <td><a href={{ route('jadwal.selesaikan', $list->id) }} button type=" button" class="btn btn-warning">Detail</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!---- Button Aksi---->
@endsection



@push('javascript')
<script src={{ asset("assets/vendor/datatables/jquery.dataTables.min.js") }}></script>
<script src={{ asset("assets/vendor/datatables/dataTables.bootstrap4.min.js") }}></script>
<script src={{ asset("assets/js/demo/datatables-demo.js") }}></script>
@endpush