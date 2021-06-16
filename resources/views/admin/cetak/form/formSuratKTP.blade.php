@extends('layouts.appAdmin')
@section('title', $title)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Form Cetak, Silahkan isi form dibawah ini untuk generate surat!</h6>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                        @endif
                        <form action="{{ route('form_cetak_surat_ktp', ['id' => $id]) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kk">NO. KK</label>
                                        <input type="number" class="form-control" name="kk" value="{{ old('kk') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nik">NO. KTP</label>
                                        <input type="number" class="form-control" name="nik" value="{{ old('nik') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="rt">RT</label>
                                        <input type="number" class="form-control" name="rt" value="{{ old('rt') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="rw">RW</label>
                                        <input type="number" class="form-control" name="rw" value="{{ old('rw') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="desa">Desa</label>
                                        <input type="text" class="form-control" name="desa" value="{{ old('desa') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan</label>
                                        <input type="text" class="form-control" name="kecamatan"
                                            value="{{ old('kecamatan') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="kabupaten">Kabupaten</label>
                                        <input type="text" class="form-control" name="kabupaten"
                                            value="{{ old('kabupaten') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="provinsi">Provinsi</label>
                                        <input type="text" class="form-control" name="provinsi"
                                            value="{{ old('provinsi') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="kodePos">Kode Pos</label>
                                        <input type="number" class="form-control" name="kodePos"
                                            value="{{ old('kodePos') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="baruAtauGanti">PERMOHONAN KTP</label>
                                        <select name="baruAtauGanti" id="baruAtauGanti" class="form-control">
                                            <option value="Baru">Baru</option>
                                            <option value="Penggantian">Penggantian</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-sm btn-success">Cetak</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {})

    </script>
@endsection
