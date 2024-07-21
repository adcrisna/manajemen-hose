@extends('layouts.user')
@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
    <style>
        img.zoom {
            width: 130px;
            height: 100px;
            -webkit-transition: all .2s ease-in-out;
            -moz-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            -ms-transition: all .2s ease-in-out;
        }

        .transisi {
            -webkit-transform: scale(1.8);
            -moz-transform: scale(1.8);
            -o-transform: scale(1.8);
            transform: scale(1.8);
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('user.index') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Data Hose</li>
        </ol>
        <br />
    </section>
    <section class="content">
        @if (\Session::has('msg_success'))
            <h5>
                <div class="alert alert-warning">
                    {{ \Session::get('msg_success') }}
                </div>
            </h5>
        @endif
        @if (\Session::has('msg_error'))
            <h5>
                <div class="alert alert-danger">
                    {{ \Session::get('msg_error') }}
                </div>
            </h5>
        @endif
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Data Hose</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exportModal"><i
                                    class="fa fa-download"></i>
                                Laporan</button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" id="data-management">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Nama Hose</th>
                                    <th>Mesin</th>
                                    <th>Spesifikasi</th>
                                    <th>Manufacture Date</th>
                                    <th>Stok</th>
                                    <th>Gudang</th>
                                    <th style="display: none">Machine ID</th>
                                    <th style="display: none">Gudang ID</th>
                                    <th width="200px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (@$hose as $key => $value)
                                    <tr>
                                        <td>{{ @$value->id }}</td>
                                        <td>{{ @$value->code }}</td>
                                        <td>{{ @$value->name }}</td>
                                        <td>{{ @$value->Machine->name }}</td>
                                        <td>{{ @$value->spesifikasi }}</td>
                                        <td>{{ @$value->date }}</td>
                                        <td>{{ @$value->stock }}</td>
                                        <td>{{ @$value->Gudang->name }}</td>
                                        <td style="display: none">{{ @$value->machine_id }}</td>
                                        <td style="display: none">{{ @$value->gudang_id }}</td>
                                        <td><a href="https://wa.me/6281287903034?text=Hallo, Saya mau bertanya tentang {{ $value->name }}"
                                                target="_blank"><button class="btn btn-xs btn-success"><i
                                                        class="fa fa-whatsapp"> WA</i></button></a>&nbsp;
                                            <a href="{{ route('pdfProductByID', $value->id) }}" target="_blank"><button
                                                    class=" btn btn-xs btn-warning"><i class="fa fa-download">
                                                        Download</i></button></a>&nbsp;
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Laporan Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pdfProduct') }}" method="post" target="_blank">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group has-feedback">
                            <label>Tanggal Awal</label>
                            <input type="date" name="tanggalAwal" class="form-control" required>
                            <input type="hidden" name="machineID" class="form-control" value="{{ @$machineID }}">
                        </div>
                        <div class="form-group has-feedback">
                            <label>Tanggal Akhir</label>
                            <input type="date" name="tanggalAkhir" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        var table = $('#data-management').DataTable();

        $('#data-management').on('click', '.btn-edit-management', function() {
            row = table.row($(this).closest('tr')).data();
            console.log(row);
            $('input[name=id]').val(row[0]);
            $('input[name=code]').val(row[1]);
            $('input[name=name]').val(row[2]);
            $('textarea[name=spesifikasi]').val(row[4]);
            $('input[name=date]').val(row[5]);
            $('select[name=machine_id]').val(row[9]);
            $('select[name=gudang_id]').val(row[10]);
            $('#modal-form-edit-management').modal('show');
        });
        $('#data-management').on('click', '.btn-stock-management', function() {
            row = table.row($(this).closest('tr')).data();
            console.log(row);
            $('input[name=id]').val(row[0]);
            $('input[name=code]').val(row[1]);
            $('input[name=name]').val(row[2]);
            $('#modal-form-stock-management').modal('show');
        });
        $('#modal-form-tambah-management').on('show.bs.modal', function() {
            $('input[name=id]').val('');
            $('input[name=name]').val('');
        });

        $(document).ready(function() {
            $('.zoom').hover(function() {
                $(this).addClass('transisi');
            }, function() {
                $(this).removeClass('transisi');
            });
        });
    </script>
@endsection
