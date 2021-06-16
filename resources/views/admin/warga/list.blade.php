@extends('layouts.appAdmin')
@section('title', $title)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Daftar Data Pengguna / Warga</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tablePengguna">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $r)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $r->name }}</td>
                                            <td>{{ date('d M Y H:i:s', strtotime($r->created_at)) }}</td>
                                            <td>
                                                <a href="#" data-id="{{ $r->id }}" data-name="{{ $r->name }}"
                                                    data-email="{{ $r->email }}" data-role="{{ $r->role }}"
                                                    data-img="{{ $r->identity_file }}" class="btn btn-sm btn-info detail"
                                                    data-toggle="modal" data-target="#modalForm">detail</a>
                                                @if ($r->isVerifiedByAdmin == 'false')
                                                    <a href="{{ route('verif_user', ['id' => $r->id]) }}"
                                                        class="btn btn-sm btn-success verif">verif</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade {{ $errors->any() ? 'show' : '' }}"
                    style="{{ $errors->any() ? 'display: block' : '' }}" id="modalForm" tabindex="-1" role="dialog"
                    aria-labelledby="modalFormLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if ($errors->any())
                                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                                @endif
                                <form id="formRw" action="{{ route('rukun_warga_tambah_proses') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" id="name" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" id="email" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <input type="text" id="role" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="identity_file">File KTP</label>
                                        <img style="display: block" id="img" src="" alt="" width="50%"
                                            class="img-responsive">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tablePengguna').DataTable()
            $(document).on('click', '.detail', function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');
                var email = $(this).attr('data-email');
                var role = $(this).attr('data-role');
                var img = $(this).attr('data-img');

                var url = "#";
                var modal = $('#modalForm');

                modal.find('.modal-title').html('Detail Pengguna / Warga');
                modal.find('#formRw').attr('action', url);
                modal.find('input[id="name"]').val(name);
                modal.find('input[id="email"]').val(email);
                modal.find('input[id="role"]').val(role);
                modal.find('#img').attr('src', "{{ url('/') }}" + "/" + img);
            })
            $(document).on('click', '.verif', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Anda yakin ingin memverifikasi user warga ini?',
                    text: "Anda tidak akan dapat mengubah status kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: `Ya`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location = $(this).attr('href');
                    }
                })
            })
        })

    </script>
@endsection
