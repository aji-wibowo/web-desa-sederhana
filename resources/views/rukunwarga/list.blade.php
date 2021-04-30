@extends('layouts.app')
@section('title', $title)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Daftar Rukun Warga (RW)</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tablerw">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama RW</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $r)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $r->name }}</td>
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
        $('#tablerw').DataTable();

    </script>
@endsection
