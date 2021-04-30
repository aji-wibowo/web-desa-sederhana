@extends('layouts.app')
@section('title', $title)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Silahkan lengkapi form di bawah ini!</h6>
                        <small>Hubungi Kami</small>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                        @endif
                        <form action="{{ route('hubungi_kami_proses') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama <small style="color: red">*</small></label>
                                        <input type="text" name="nama" class="form-control" placeholder="Masukan nama"
                                            value="{{ old('nama') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email <small style="color: red">*</small></label>
                                        <input type="email" name="email" class="form-control" placeholder="Masukan email"
                                            value="{{ old('email') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>No. Telp <small style="color: red">*</small></label>
                                        <input type="number" name="no_telp" class="form-control"
                                            placeholder="Masukan nomor telepon" value="{{ old('no_telp') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Subject <small style="color: red">*</small></label>
                                        <input type="text" name="judul" class="form-control" placeholder="Masukan subject"
                                            value="{{ old('judul') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pesan">Pesan <small style="color: red">*</small></label>
                                        <textarea name="pesan" id="pesan" cols="30" rows="5" class="form-control"
                                            placeholder="Masukan pesan">{{ old('pesan') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="kirim" class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
