@extends('layouts.app')
@section('title', $title)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6" style="margin: auto">
                <div class="card">
                    <div class="card-header">
                        <h6>Data Akun Saya</h6>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                        @endif
                        <form action="{{ route('myaccount_user_proses') }}" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $data->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" class="form-control" value="{{ $data->email }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="password">Password <small style="color: red">isi bila ingin merubah
                                        password</small></label>
                                <input type="password" id="password" name="password" class="form-control" autocomplete="off"
                                    placeholder="Password lama Anda">
                                <input type="password" id="password_baru" name="password_baru" class="form-control mt-2"
                                    placeholder="Password baru Anda">
                            </div>
                            @if (Auth::user()->role == 'warga')
                                <div class="form-group">
                                    <label>Foto Identitas</label>
                                    <img style="display: block" src="{{ url($data->identity_file) }}"
                                        alt="{{ $data->identity_file }}" width="40%">
                                </div>
                            @endif
                            <div class="form-group text-right">
                                <input type="submit" class="btn btn-sm btn-success" value="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
