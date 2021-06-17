@extends('layouts.app')
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
                                        <th>Tanggal Permohonan</th>
                                        <th>Status Permohonan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayat as $r)
                                        <tr>
                                            <td>{{ str_replace('_', '', strtoupper($r->type)) }}</td>
                                            <td>{{ date('d M Y H:i:s', strtotime($r->created_at)) }}</td>
                                            <td>
                                                {{ $r->status }} <?= $r->status == 'Siap Diambil' || $r->status == 'Selesai' ? "<a target='__blank' href='" . url('uploads/pdf/' . $r->pdf . '.pdf') . "'> | download surat pdf</a>" : '' ?>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h6>Silahkan lengkapi form di bawah ini!</h6>
                            <small>Pembuatan Kartu Tanda Penduduk Elektronik (el-KTP)</small>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            @endif
                            <form action="{{ route('layanan_ktp_proses') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Surat Pengantar RT/RW <small style="color: red">*</small></label>
                                            <input type="file" name="surat_pengantar_rt_rw" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Surat Keterangan Domisili <small style="color: red">*</small></label>
                                            <input type="file" name="surat_keterangan_domisili" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea name="note" id="note" cols="30" rows="5" class="form-control"
                                                placeholder="Masukan note jika ada..">{{ old('note') }}</textarea>
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
        <script>
            $('#tableRiwayatPermohonan').DataTable();

        </script>
@endsection
