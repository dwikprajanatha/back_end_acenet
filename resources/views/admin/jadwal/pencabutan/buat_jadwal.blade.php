@extends('admin.template.header')


@section('title', $title)

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

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
                    <form action="{{route('pencabutan.post')}}" method="post" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <!-- harus dropdown ajax -->
                            <div class="input-group">
                                <select class="form-control select-2" id="select2-customer" name="nama_pelanggan">
                                    <option></option>
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>No. SPK</label>
                            <input type="text" name="no_spk" class="form-control" value="{{$no_spk}}" readonly>
                            <small>*auto generated by system</small>
                        </div>

                        <div class="form-group">
                            <label>No. Pelanggan</label>
                            <input type="text" name="no_pelanggan" id="no_pelanggan" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>ATTN</label>
                            <input type="text" name="attn" class="form-control" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="datepicker">Tanggal Perbaikan</label>
                            <input id="datepicker" name="tgl_pekerjaan" data-date-format="mm/dd/yyyy">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="timepicker">Jam Mulai</label>
                            <input type="text" name="jam_mulai" class="form-control time-picker">
                            <small>*24 Hour format</small>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="timepicker">Jam Selesai</label>
                            <input type="text" name="jam_selesai" class="form-control time-picker">
                            <small>*24 Hour format</small>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Jenis Perbaikan</label>
                            <select name="jenis_perbaikan" class="custom-select">
                                <option value="" hidden selected>Pilih salah satu</option>
                                <option value="1">Instalasi Baru</option>
                                <option value="2">Perbaikan Client</option>
                                <option value="3">Maintenance BTS</option>
                                <option value="4">Pencabutan Perangkat</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="ket_pekerjaan" rows="3"></textarea>
                        </div>


                        <div class="form-group">
                            <label>Nama Teknisi</label>
                            <!-- harus dropdown ajax -->
                            <div class="input-group">
                                <select class="form-control select-2" name="teknisi[]" multiple>
                                    <option></option>
                                    @foreach($teknisi as $t)
                                    <option value="{{$t->id}}">{{$t->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">BTS</label>
                            <input type="text" name="bts" id="bts" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">AP</label>
                            <input type="text" name="ap" id="ap" class="form-control" readonly>
                        </div>


                        <div class="form-group center">
                            <input type="submit" name="submit" class="btn btn-success" value="Buat SPK">
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

@push('javascript')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

<script>
    $(document).ready(function($) {
        $('.select-2').select2({
            placeholder: "Pilih salah satu"
        });

        $('#select2-customer').change(function() {
                var id_customer = this.value;

                if (id_customer != "") {
                    $.ajax({
                        type: "GET",
                        url: "{{route('getDataCustomer')}}",
                        data: {
                            id: id_customer
                        },
                        success: function(data) {
                            console.log(data);
                            $('#no_pelanggan').val(data.no_pelanggan);
                            $('#bts').val(data.bts);
                            $('#ap').val(data.ap);
                        }
                    })
                }

            }

        );
    });

    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
    });

    $('.time-picker').mask('00:00');
</script>

@endpush