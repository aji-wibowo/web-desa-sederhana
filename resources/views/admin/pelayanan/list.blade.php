@extends('layouts.appAdmin')
@section('title', $title)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Daftar Riwayat Permohonan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tableRiwayatPermohonan">
                                <thead>
                                    <tr>
                                        <th>Type Permohonan</th>
                                        <th>File Syarat</th>
                                        <th>Tanggal Permohonan</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $r)
                                        <tr>
                                            <td>{{ str_replace('_', '', strtoupper($r->type)) }}</td>
                                            <td>
                                                <ul>
                                                    @foreach ($r->serviceAttachment as $file)
                                                        <li>
                                                            <a target="__blank"
                                                                href="{{ url($file->file_path) }}">{{ $file->file_category }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ date('d M Y H:i:s', strtotime($r->created_at)) }}</td>
                                            <td>
                                                @if ($r->status == 'Menunggu')
                                                    <a href="{{ route('pelayanan_admin_verifikasi', ['id' => $r->id]) }}"
                                                        class="btn btn-sm btn-success verifikasi">Verifikasi</a>
                                                    <a href="{{ route('pelayanan_admin_tolak', ['id' => $r->id]) }}"
                                                        class="btn btn-sm btn-danger tolak">Tolak</a>
                                                @elseif($r->status == 'Terverifikasi')
                                                    <a href="{{ route('pelayanan_admin_dapatdiambil', ['id' => $r->id]) }}"
                                                        class="btn btn-sm btn-success diambil">Dapat diambil</a>
                                                @elseif($r->status == 'Siap Diambil')
                                                    <a href="{{ route('pelayanan_admin_sudahdiambil', ['id' => $r->id]) }}"
                                                        class="btn btn-sm btn-success sudahdiambil">Sudah diambil</a>
                                                @else
                                                    {{ $r->status }}
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
    </div>
    <script>
        $(document).ready(function() {
            $('#tableRiwayatPermohonan').DataTable();
            $(document).on('click', '.verifikasi', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Anda yakin ingin merubah status permohonan menjadi Terverifikasi?',
                    text: "Anda tidak akan dapat mengembalikan perubahan tersebut!",
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

            $(document).on('click', '.tolak', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Anda yakin ingin merubah status permohonan menjadi Ditolak?',
                    text: "Anda tidak akan dapat mengembalikan perubahan tersebut!",
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

            $(document).on('click', '.diambil', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Anda yakin ingin merubah status permohonan menjadi Dapat diambil?',
                    text: "Anda tidak akan dapat mengembalikan perubahan tersebut!",
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

            $(document).on('click', '.sudahdiambil', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Anda yakin ingin merubah status permohonan menjadi Selesai?',
                    text: "Anda tidak akan dapat mengembalikan perubahan tersebut!",
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
