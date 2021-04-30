@extends('layouts.appAdmin')
@section('title', $title)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6 style="float: left">Daftar Data Rukun Warga (RW)</h6>
                        <a href="#" style="float: right" class="btn btn-sm btn-success tambah" data-toggle="modal"
                            data-target="#modalForm">tambah</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tableRiwayatPermohonan">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama RW</th>
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
                                                    class="btn btn-sm btn-warning edit" data-toggle="modal"
                                                    data-target="#modalForm">edit</a>
                                                <a href="{{ route('rukun_warga_admin_delete', ['id' => $r->id]) }}"
                                                    class="btn btn-sm btn-danger delete">delete</a>
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
                                        <label for="rukun_warga_name">Nama RW</label>
                                        <input type="text" id="rukun_warga_name" name="rukun_warga_name"
                                            class="form-control" placeholder="Masukan nama RW (example : Rukun Warga 1)">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary simpan">Save changes</button>
                                <button type="button" class="btn btn-secondary closeme" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tableRiwayatPermohonan').DataTable();
            $(document).on('click', '.tambah', function(e) {
                e.preventDefault();
                var url = "{{ route('rukun_warga_tambah_proses') }}";
                var modal = $('#modalForm');
                modal.find('.modal-title').html('Tambah Rukun Warga');
                modal.find('#formRw').attr('action', url);
            })
            $(document).on('click', '.edit', function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');
                var url = "{{ url('/admin/rukunwarga/ubah/proses') }}/" + id;
                var modal = $('#modalForm');
                modal.find('.modal-title').html('Tambah Rukun Warga');
                modal.find('#formRw').attr('action', url);
                modal.find('input[name="rukun_warga_name"]').val(name);
            })
            $(document).on('click', '.closeme', function() {
                $('#modalForm').hide();
            })
            $(document).on('click', '.delete', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Anda yakin ingin menghapus?',
                    text: "Anda tidak akan dapat mengembalikan data tersebut!",
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
            $(document).on('click', '.simpan', function(e) {
                e.preventDefault();
                $('#formRw').submit();
            })
        })

    </script>
@endsection
