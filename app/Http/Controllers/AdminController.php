<?php

namespace App\Http\Controllers;

use App\Models\CitizensAssociation;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PDF;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function pelayanan()
    {
        $data = Service::with('serviceAttachment')->get();

        $parseData = [
            'title' => 'Pelayanan Pembuatan Surat | Admin',
            'data' => $data
        ];

        return view('admin/pelayanan/list', $parseData);
    }

    public function pelayanan_verifikasi(Request $r, $id)
    {
        if ($id) {
            $find = Service::where('status', 'Menunggu')->find($id);

            if ($find == null) {
                return redirect('/admin/pelayanan')->with($this->messageSweetAlert('error', 'Maaf!', 'Data tidak dapat ditemukan!'));
            }

            $find->status = 'Terverifikasi';

            if ($find->save()) {
                return redirect('/admin/pelayanan')->with($this->messageSweetAlert('success', 'Berhasil!', 'Perubahan berhasil disimpan, status telah menjadi Terverifikasi'));
            } else {
                return redirect('/admin/pelayanan')->with($this->messageSweetAlert('error', 'Maaf!', 'Perubahan tidak dapat disimpan, silahkan coba beberapa saat lagi!'));
            }
        } else {
            return redirect('/admin/pelayanan')->with($this->messageSweetAlert('error', 'Maaf!', 'Kami tidak dapat memproses permintaan Anda!'));
        }
    }

    public function pelayanan_dapatdiambil(Request $r, $id)
    {
        if ($id) {
            $find = Service::where('status', 'Terverifikasi')->find($id);

            if ($find == null) {
                return redirect('/admin/pelayanan')->with($this->messageSweetAlert('error', 'Maaf!', 'Data tidak dapat ditemukan!'));
            }

            $find->status = 'Siap Diambil';

            if ($find->save()) {
                return redirect('/admin/pelayanan')->with($this->messageSweetAlert('success', 'Berhasil!', 'Perubahan berhasil disimpan, status telah menjadi Dapat diambil'));
            } else {
                return redirect('/admin/pelayanan')->with($this->messageSweetAlert('error', 'Maaf!', 'Perubahan tidak dapat disimpan, silahkan coba beberapa saat lagi!'));
            }
        } else {
            return redirect('/admin/pelayanan')->with($this->messageSweetAlert('error', 'Maaf!', 'Kami tidak dapat memproses permintaan Anda!'));
        }
    }

    public function pelayanan_sudahdiambil(Request $r, $id)
    {
        if ($id) {
            $find = Service::where('status', 'Siap Diambil')->find($id);

            if ($find == null) {
                return redirect('/admin/pelayanan')->with($this->messageSweetAlert('error', 'Maaf!', 'Data tidak dapat ditemukan!'));
            }

            $find->status = 'Selesai';

            if ($find->save()) {
                return redirect('/admin/pelayanan')->with($this->messageSweetAlert('success', 'Berhasil!', 'Perubahan berhasil disimpan, status telah menjadi Selesai'));
            } else {
                return redirect('/admin/pelayanan')->with($this->messageSweetAlert('error', 'Maaf!', 'Perubahan tidak dapat disimpan, silahkan coba beberapa saat lagi!'));
            }
        } else {
            return redirect('/admin/pelayanan')->with($this->messageSweetAlert('error', 'Maaf!', 'Kami tidak dapat memproses permintaan Anda!'));
        }
    }

    public function pelayanan_tolak(Request $r, $id)
    {
        if ($id) {
            $find = Service::where('status', 'Menunggu')->find($id);

            if ($find == null) {
                return redirect('/admin/pelayanan')->with($this->messageSweetAlert('error', 'Maaf!', 'Data tidak dapat ditemukan!'));
            }

            $find->status = 'Ditolak';

            if ($find->save()) {
                return redirect('/admin/pelayanan')->with($this->messageSweetAlert('success', 'Berhasil!', 'Perubahan berhasil disimpan, status telah menjadi Ditolak'));
            } else {
                return redirect('/admin/pelayanan')->with($this->messageSweetAlert('error', 'Maaf!', 'Perubahan tidak dapat disimpan, silahkan coba beberapa saat lagi!'));
            }
        } else {
            return redirect('/admin/pelayanan')->with($this->messageSweetAlert('error', 'Maaf!', 'Kami tidak dapat memproses permintaan Anda!'));
        }
    }

    public function list_rukun_warga()
    {
        $data = CitizensAssociation::all();

        $parseData = [
            'title' => 'Data Rukun Warga | Admin',
            'data' => $data
        ];

        return view('admin.rukunwarga.list', $parseData);
    }

    public function tambah_rukun_warga_proses(Request $r)
    {
        $r->validate([
            'rukun_warga_name' => 'required|min:3'
        ]);

        $tambah = CitizensAssociation::create([
            'name' => $r->rukun_warga_name
        ]);

        if ($tambah) {
            return redirect('/admin/rukunwarga')->with($this->messageSweetAlert('success', 'Berhasil!', 'Data rukun warga baru telah disimpan!'));
        } else {
            return redirect('/admin/rukunwarga')->with($this->messageSweetAlert('error', 'Gagal!', 'Data rukun warga baru gagal disimpan!'));
        }
    }

    public function ubah_rukun_warga_proses(Request $r, $id)
    {
        $r->validate([
            'rukun_warga_name' => 'required|min:3'
        ]);

        $find = CitizensAssociation::find($id);

        if ($find == null) {
            return redirect('/admin/rukunwarga')->with($this->messageSweetAlert('error', 'Gagal!', 'Data rukun warga tidak ditemukan!'));
        }

        $find->name = $r->rukun_warga_name;

        if ($find->save()) {
            return redirect('/admin/rukunwarga')->with($this->messageSweetAlert('success', 'Berhasil!', 'Data rukun warga baru telah disimpan!'));
        } else {
            return redirect('/admin/rukunwarga')->with($this->messageSweetAlert('error', 'Gagal!', 'Data rukun warga baru gagal disimpan!'));
        }
    }

    public function delete_rukun_warga_proses($id)
    {
        if ($id) {
            $find = CitizensAssociation::find($id);

            if ($find == null) {
                return redirect('/admin/rukunwarga')->with($this->messageSweetAlert('error', 'Gagal!', 'Data rukun warga tidak ditemukan!'));
            }

            if ($find->delete()) {
                return redirect('/admin/rukunwarga')->with($this->messageSweetAlert('success', 'Berhasil!', 'Data rukun warga telah dihapus!'));
            } else {
                return redirect('/admin/rukunwarga')->with($this->messageSweetAlert('error', 'Gagal!', 'Data rukun warga telah gagal dihapus!'));
            }
        } else {
            return redirect('/admin/rukunwarga')->with($this->messageSweetAlert('error', 'Gagal!', 'Data rukun warga tidak ditemukan!'));
        }
    }

    public function list_user()
    {
        $data = User::where('role', 'warga')->get();

        $parseData = [
            'title' => 'Data User Warga | Admin',
            'data' => $data
        ];

        return view('admin.warga.list', $parseData);
    }

    public function verif_user($id)
    {
        $data = User::find($id);

        $data->isVerifiedByAdmin = "true";

        if ($data->save()) {
            return redirect('/admin/users')->with($this->messageSweetAlert('success', 'Berhasil!', 'Data telah berhasil di verifikasi!'));
        } else {
            return redirect('/admin/users')->with($this->messageSweetAlert('error', 'Gagal!', 'Data telah gagal di verifikasi! Coba lagi nanti.'));
        }
    }

    public function my_account()
    {
        $data = User::where('id', Auth::user()->id)->first();

        $parseData = [
            'title' => 'Akun Saya',
            'data' => $data
        ];

        return view('admin.profil.index', $parseData);
    }

    public function my_account_proses(Request $r)
    {
        $r->validate([
            'name' => 'required|min:3',
        ]);

        $find = User::find(Auth::user()->id);

        if ($find == null) {
            return redirect('/admin/myaccount')->with($this->messageSweetAlert('error', 'Gagal!', 'Data user tidak ditemukan!'));
        }

        if ($r->password) {
            if (Auth::check($r->password, $find->password)) {
                if ($r->password_baru != '') {
                    $find->password = Hash::make($r->password_baru);
                } else {
                    return redirect('/admin/myaccount')->with($this->messageSweetAlert('error', 'Gagal!', 'Password baru kosong!'));
                }
            }
        }

        $find->name = $r->name;

        if ($find->save()) {
            return redirect('/admin/myaccount')->with($this->messageSweetAlert('success', 'Berhasil!', 'Data user Anda telah berhasil dirubah!'));
        } else {
            return redirect('/admin/myaccount')->with($this->messageSweetAlert('error', 'Gagal!', 'Data user Anda telah gagal dirubah!'));
        }
    }

    public function formCetakSurat($type, $id)
    {
        $parseData = [
            'title' => 'Cetak Form',
            'id' => $id
        ];
        if ($type == 'surat_pindah_datang_wni') {
            return view('admin.cetak.form.formSuratKeteranganPindah', $parseData);
        } else if ($type == 'kk') {
            return view('admin.cetak.form.formSuratKK', $parseData);
        } else if ($type == 'ktp') {
            return view('admin.cetak.form.formSuratKTP', $parseData);
        } else {
            return redirect('/')->with($this->messageSweetAlert('error', 'Forbidden!', 'Permintaan Anda tidak dapat diproses'));
        }
    }

    public function cetakSuratKeteranganPindah(Request $r, $id)
    {
        $r->validate([
            'kk' => 'required',
            'nik' => 'required',
            'nama' => 'required',
            'asalAlamat' => 'required',
            'asalDesa' => 'required',
            'asalKota' => 'required',
            'asalKecamatan' => 'required',
            'asalProvinsi' => 'required',
            'asalKodePos' => 'required',
            'asalNomorTelp' => 'required',
            'tujuanAlamat' => 'required',
            'tujuanDesa' => 'required',
            'tujuanKota' => 'required',
            'tujuanKecamatan' => 'required',
            'tujuanProvinsi' => 'required',
            'tujuanKodePos' => 'required',
            'tujuanNomorTelp' => 'required',
            'klasifikasiPindah' => 'required',
            'asalRT' => 'required',
            'asalRW' => 'required',
            'tujuanRT' => 'required',
            'tujuanRW' => 'required',
        ]);

        $data = $r->all();

        $pdf = PDF::loadView('admin.cetak.suratKeteranganPindah', $data);

        $filename = rand(1, 1000000);

        Storage::put('public/pdf/' . rand(1, 1000000) . '.pdf', $pdf->output());

        $find = Service::find($id);
        $find->pdf = $filename;
        $find->save();

        return redirect('admin/pelayanan')->with($this->messageSweetAlert('success', 'Berhasil!', 'pdf telah digenerate'));
    }

    public function cetakSuratKTP(Request $r, $id)
    {
        $r->validate([
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'nama' => 'required',
            'kk' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kodePos' => 'required',
            'baruAtauGanti' => 'required'
        ]);

        $data = $r->all();

        $pdf = PDF::loadView('admin.cetak.suratKetranganKTP', $data);

        $filename = rand(1, 1000000);

        Storage::put('public/pdf/' . rand(1, 1000000) . '.pdf', $pdf->output());

        $find = Service::find($id);
        $find->pdf = $filename;
        $find->save();

        return redirect('admin/pelayanan')->with($this->messageSweetAlert('success', 'Berhasil!', 'pdf telah digenerate'));
    }

    public function cetakSuratKK(Request $r, $id)
    {
        $r->validate([
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'nama' => 'required',
            'kk' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kodePos' => 'required',
            'baruAtauGanti' => 'required',
            'jumlahAnggotaKeluarga' => 'required',
            'pendidikanTerakhir' => 'required'
        ]);

        $data = $r->all();

        $pdf = PDF::loadView('admin.cetak.suratKetranganKK', $data);

        $filename = rand(1, 1000000);
        Storage::disk('public_uploads')->put('pdf/' . $filename . '.pdf', $pdf->output());

        $find = Service::find($id);
        $find->pdf = $filename;
        $find->save();

        return redirect('admin/pelayanan')->with($this->messageSweetAlert('success', 'Berhasil!', 'pdf telah digenerate'));
    }
}
