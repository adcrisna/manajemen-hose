@extends('layouts.superadmin')
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
            <li><a href="{{ route('superadmin.index') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Data Admin</li>
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
                        <h3 class="box-title">Data Admin</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-info btn-md" data-toggle="modal"
                                data-target="#modal-form-tambah-management"><i class="fa fa-plus"> Tambah Data
                                </i></button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" id="data-management">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Foto</th>
                                    <th>Nama Admin</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Factory</th>
                                    <th style="display: none">Factory ID</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (@$admin as $key => $value)
                                    <tr>
                                        <td>{{ @$value->id }}</td>
                                        <td><img src="{{ asset('foto/' . $value->foto) }}" class="zoom" alt="foto admin">
                                        </td>
                                        <td>{{ @$value->name }}</td>
                                        <td>{{ @$value->email }}</td>
                                        <td>{{ @$value->no_hp }}</td>
                                        <td>{{ @$value->Gudang->name }}</td>
                                        <td style="display: none">{{ @$value->gudang_id }}</td>
                                        <td>
                                            <button class="btn btn-xs btn-success btn-edit-management"><i
                                                    class="fa fa-edit">
                                                    Ubah</i></button> &nbsp;
                                            <a href="{{ route('superadmin.deleteAdmin', $value->id) }}"><button
                                                    class=" btn btn-xs btn-danger"
                                                    onclick="return confirm('Apakah anda ingin menghapus data ini ?')"><i
                                                        class="fa fa-trash"> Hapus</i></button></a>
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
    <div class="modal fade" id="modal-form-tambah-management" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Form Tambah Data Admin</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('superadmin.addAdmin') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group has-feedback">
                            <label>Nama Admin:</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Admin" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="Email Admin" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Password:</label>
                            <input type="password" name="password" class="form-control" placeholder="Password Admin"
                                required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>No HP:</label>
                            <input type="number" name="no_hp" class="form-control" placeholder="No HP Admin" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Factory:</label>
                            <select name="gudang_id" class="form-control" required>
                                <option value="">Pilih</option>
                                @foreach (@$gudang as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control" placeholder="Foto" required>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-8">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-form-edit-management" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Form Ubah Data Admin</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('superadmin.updateAdmin') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group has-feedback">
                            <input type="hidden" name="id" readonly class="form-control" placeholder="ID"
                                required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Nama Admin:</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Admin" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="Email Admin"
                                required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Password Baru:</label>
                            <input type="password" name="password" class="form-control" placeholder="Password Baru">
                        </div>
                        <div class="form-group has-feedback">
                            <label>No HP:</label>
                            <input type="number" name="no_hp" class="form-control" placeholder="No HP Admin"
                                required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Factory:</label>
                            <select name="gudang_id" class="form-control" required>
                                <option value="">Pilih</option>
                                @foreach (@$gudang as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Foto Baru</label>
                            <input type="file" name="foto" class="form-control" placeholder="Foto">
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-8">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
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
            $('input[name=name]').val(row[2]);
            $('input[name=email]').val(row[3]);
            $('input[name=no_hp]').val(row[4]);
            $('select[name=gudang_id]').val(row[6]);
            $('#modal-form-edit-management').modal('show');
        });
        $('#modal-form-tambah-management').on('show.bs.modal', function() {
            $('input[name=id]').val('');
            $('input[name=name]').val('');
            $('input[name=email]').val('');
            $('input[name=no_hp]').val('');
            $('select[name=name]').val('');
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
