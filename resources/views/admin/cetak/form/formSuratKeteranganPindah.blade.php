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
                        <form action="{{ route('cetak_surat_keterangan_pindah', ['id' => $id]) }}" method="post">
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
                                        <label for="asalAlamat">Asal Alamat</label>
                                        <input type="text" class="form-control" name="asalAlamat"
                                            value="{{ old('asalAlamat') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="asalRT">Asal RT</label>
                                        <input type="number" class="form-control" name="asalRT"
                                            value="{{ old('asalRT') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="asalRW">Asal RW</label>
                                        <input type="number" class="form-control" name="asalRW"
                                            value="{{ old('asalRW') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="asalDesa">Asal Desa</label>
                                        <input type="text" class="form-control" name="asalDesa"
                                            value="{{ old('asalDesa') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="asalKecamatan">Asal Kecamatan</label>
                                        <input type="text" class="form-control" name="asalKecamatan"
                                            value="{{ old('asalKecamatan') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="asalKota">Asal Kota</label>
                                        <input type="text" class="form-control" name="asalKota"
                                            value="{{ old('asalKota') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="asalProvinsi">Asal Provinsi</label>
                                        <input type="text" class="form-control" name="asalProvinsi"
                                            value="{{ old('asalProvinsi') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="asalKodePos">Asal Kode Pos</label>
                                        <input type="number" class="form-control" name="asalKodePos"
                                            value="{{ old('asalKodePos') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="asalNomorTelp">Asal No. Telp</label>
                                        <input type="number" class="form-control" name="asalNomorTelp"
                                            value="{{ old('asalNomorTelp') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="tujuanAlamat">Tujuan Alamat</label>
                                        <input type="text" class="form-control" name="tujuanAlamat"
                                            value="{{ old('tujuanAlamat') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuanRT">Tujuan RT</label>
                                        <input type="number" class="form-control" name="tujuanRT"
                                            value="{{ old('tujuanRT') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuanRW">Tujuan RW</label>
                                        <input type="number" class="form-control" name="tujuanRW"
                                            value="{{ old('tujuanRW') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuanDesa">Tujuan Desa</label>
                                        <input type="text" class="form-control" name="tujuanDesa"
                                            value="{{ old('tujuanDesa') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuanKecamatan">Tujuan Kecamatan</label>
                                        <input type="text" class="form-control" name="tujuanKecamatan"
                                            value="{{ old('tujuanKecamatan') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuanKota">Tujuan Kota</label>
                                        <input type="text" class="form-control" name="tujuanKota"
                                            value="{{ old('tujuanKota') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuanProvinsi">Tujuan Provinsi</label>
                                        <input type="text" class="form-control" name="tujuanProvinsi"
                                            value="{{ old('tujuanProvinsi') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuanKodePos">Tujuan Kode Pos</label>
                                        <input type="number" class="form-control" name="tujuanKodePos"
                                            value="{{ old('tujuanKodePos') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuanNomorTelp">Tujuan No. Telp</label>
                                        <input type="number" class="form-control" name="tujuanNomorTelp"
                                            value="{{ old('tujuanNomorTelp') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="klasifikasiPindah">Klasifikasi Pindah</label>
                                        <select name="klasifikasiPindah" id="klasifikasiPindah" class="form-control">
                                            <option value="Dalam Satu Desa/Kelurahan">Dalam Satu Desa/Kelurahan</option>
                                            <option value="Antar Desa/Kelurahan">Antar Desa/Kelurahan</option>
                                            <option value="Antar Desa/Kelurahan">Antar Kecamatan</option>
                                            <option value="Antar Desa/Kelurahan">Antar Kab/Kota</option>
                                            <option value="Antar Desa/Kelurahan">Antar Provinsi</option>
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
