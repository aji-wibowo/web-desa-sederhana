<?php

namespace App\Http\Controllers;

use App\Mail\HubungiKamiMail;
use App\Models\CitizensAssociation;
use App\Models\Service;
use App\Models\ServiceAttachment;
use App\Models\User;
use App\Models\UserCitizenAssociation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Form pembuatan KTP
     */
    public function form_ktp()
    {
        $riwayatPermohonan = Service::with('serviceAttachment')->where('type', 'ktp')->where('user_id', Auth::user()->id)->get();

        $parseData = [
            'title' => 'Layanan Pembuatan KTP',
            'riwayat' => $riwayatPermohonan
        ];

        return view('layanan.ktp.form', $parseData);
    }

    /**
     * Form pembuatan KTP proses
     */
    public function form_ktp_process(Request $r)
    {
        $r->validate([
            'surat_pengantar_rt_rw' => 'required|mimes:jpg,png,jpeg|max:1024',
            'surat_keterangan_domisili' => 'required|mimes:jpg,png,jpeg|max:1024'
        ]);

        // start to handle insert file to local storage
        $destination = 'storage/uploaded/';

        $fileSupenRtRw = time() . '_' . str_replace(" ", "", $r->surat_pengantar_rt_rw->getClientOriginalName());
        $fileSupenRtRwPath = $r->surat_pengantar_rt_rw->move($destination . 'layanan/ktp', $fileSupenRtRw);

        $fileSuketDomisili = time() . '_' . str_replace(" ", "", $r->surat_keterangan_domisili->getClientOriginalName());
        $fileSuketDomisiliPath = $r->surat_keterangan_domisili->move($destination . 'layanan/ktp', $fileSuketDomisili);

        $serviceDataSaved = Service::create([
            'user_id' => Auth::user()->id,
            'note' => $r->note,
            'type' => 'ktp'
        ]);

        if ($serviceDataSaved) {
            $svcAttData = [
                [
                    'service_id' => $serviceDataSaved->id,
                    'file_category' => 'Surat Pengantar RT/RW',
                    'file_path' => $fileSupenRtRwPath
                ],
                [
                    'service_id' => $serviceDataSaved->id,
                    'file_category' => 'Surat Keterangan Domisili',
                    'file_path' => $fileSuketDomisiliPath
                ],
            ];

            ServiceAttachment::insert($svcAttData);

            return redirect('/layanan/ktp')->with($this->messageSweetAlert('success', 'Berhasil!', 'Berhasil membuat permintaan pembuatan KTP!'));
        } else {
            return redirect('/layanan/ktp')->with($this->messageSweetAlert('error', 'Gagal!', 'Gagal membuat permintaan pembuatan KTP!'));
        }
    }

    /**
     * Form pembuatan kartu keluarga
     */
    public function form_kk()
    {
        $riwayatPermohonan = Service::with('serviceAttachment')->where('type', 'kk')->where('user_id', Auth::user()->id)->get();

        $parseData = [
            'title' => 'Layanan Pembuatan KK',
            'riwayat' => $riwayatPermohonan
        ];

        return view('layanan.kk.form', $parseData);
    }

    /**
     * Form pembuatan KK proses
     */
    public function form_kk_process(Request $r)
    {
        $r->validate([
            'surat_pengantar_rt_rw' => 'required|mimes:jpg,png,jpeg|max:1024',
            'kartu_tanda_penduduk' => 'required|mimes:jpg,png,jpeg|max:1024',
            'ijasah_terakhir' => 'required|mimes:jpg,png,jpeg|max:1024',
        ]);

        // start to handle insert file to local storage
        $destination = 'storage/uploaded/';

        $fileSupenRtRw = time() . '_' . str_replace(" ", "", $r->surat_pengantar_rt_rw->getClientOriginalName());
        $fileSupenRtRwPath = $r->surat_pengantar_rt_rw->move($destination . 'layanan/kk', $fileSupenRtRw);

        $fileKtp = time() . '_' . str_replace(" ", "", $r->kartu_tanda_penduduk->getClientOriginalName());
        $fileKtpPath = $r->kartu_tanda_penduduk->move($destination . 'layanan/kk', $fileKtp);

        $fileIjasah = time() . '_' . str_replace(" ", "", $r->ijasah_terakhir->getClientOriginalName());
        $fileIjasahPath = $r->ijasah_terakhir->move($destination . 'layanan/kk', $fileIjasah);

        $serviceDataSaved = Service::create([
            'user_id' => Auth::user()->id,
            'note' => $r->note,
            'type' => 'kk'
        ]);

        if ($serviceDataSaved) {
            $svcAttData = [
                [
                    'service_id' => $serviceDataSaved->id,
                    'file_category' => 'Surat Pengantar RT/RW',
                    'file_path' => $fileSupenRtRwPath
                ],
                [
                    'service_id' => $serviceDataSaved->id,
                    'file_category' => 'Kartu Tanda Penduduk',
                    'file_path' => $fileKtpPath
                ],
                [
                    'service_id' => $serviceDataSaved->id,
                    'file_category' => 'Ijazah Terakhir',
                    'file_path' => $fileIjasahPath
                ],
            ];

            ServiceAttachment::insert($svcAttData);

            return redirect('/layanan/kk')->with($this->messageSweetAlert('success', 'Berhasil!', 'Berhasil membuat permintaan pembuatan KK!'));
        } else {
            return redirect('/layanan/kk')->with($this->messageSweetAlert('error', 'Gagal!', 'Gagal membuat permintaan pembuatan KK!'));
        }
    }

    /**
     * Form pembuatan kartu keluarga
     */
    public function form_surat_pindah()
    {
        $riwayatPermohonan = Service::with('serviceAttachment')->where('type', 'surat_pindah_datang_wni')->where('user_id', Auth::user()->id)->get();

        $parseData = [
            'title' => 'Layanan Pembuatan Suket Pindah Datang WNI',
            'riwayat' => $riwayatPermohonan
        ];

        return view('layanan.suket_pindah.form', $parseData);
    }

    /**
     * Form pembuatan KK proses
     */
    public function form_surat_pindah_process(Request $r)
    {
        $r->validate([
            'surat_pengantar_rt_rw' => 'required|mimes:jpg,png,jpeg|max:1024',
            'kartu_tanda_penduduk' => 'required|mimes:jpg,png,jpeg|max:1024',
            'kartu_keluarga' => 'required|mimes:jpg,png,jpeg|max:1024',
        ]);

        // start to handle insert file to local storage
        $destination = 'storage/uploaded/';

        $fileSupenRtRw = time() . '_' . str_replace(" ", "", $r->surat_pengantar_rt_rw->getClientOriginalName());
        $fileSupenRtRwPath = $r->surat_pengantar_rt_rw->move($destination . 'layanan/surat_pindah', $fileSupenRtRw);

        $fileKtp = time() . '_' . str_replace(" ", "", $r->kartu_tanda_penduduk->getClientOriginalName());
        $fileKtpPath = $r->kartu_tanda_penduduk->move($destination . 'layanan/surat_pindah', $fileKtp);

        $fileKartuKeluarga = time() . '_' . str_replace(" ", "", $r->kartu_keluarga->getClientOriginalName());
        $fileKartuKeluargaPath = $r->kartu_keluarga->move($destination . 'layanan/surat_pindah', $fileKartuKeluarga);

        $serviceDataSaved = Service::create([
            'user_id' => Auth::user()->id,
            'note' => $r->note,
            'type' => 'surat_pindah_datang_wni'
        ]);

        if ($serviceDataSaved) {
            $svcAttData = [
                [
                    'service_id' => $serviceDataSaved->id,
                    'file_category' => 'Surat Pengantar RT/RW',
                    'file_path' => $fileSupenRtRwPath
                ],
                [
                    'service_id' => $serviceDataSaved->id,
                    'file_category' => 'Kartu Tanda Penduduk',
                    'file_path' => $fileKtpPath
                ],
                [
                    'service_id' => $serviceDataSaved->id,
                    'file_category' => 'Ijazah Terakhir',
                    'file_path' => $fileKartuKeluargaPath
                ],
            ];

            ServiceAttachment::insert($svcAttData);

            return redirect('/layanan/pindah/datang')->with($this->messageSweetAlert('success', 'Berhasil!', 'Berhasil membuat permintaan pembuatan Surat Pindah Datang WNI!'));
        } else {
            return redirect('/layanan/pindah/datang')->with($this->messageSweetAlert('error', 'Gagal!', 'Gagal membuat permintaan pembuatan Surat Pindah Datang WNI!'));
        }
    }

    public function form_hubungi_kami()
    {
        $parseData = [
            'title' => 'Hubungi Kami'
        ];

        return view('hubungi_kami.form', $parseData);
    }

    public function form_hubungi_kami_process(Request $r)
    {
        $r->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'no_telp' => 'required|numeric',
            'judul' => 'required|min:3',
            'pesan' => 'required|min:10'
        ]);

        $data = [
            'nama' => $r->nama,
            'email' => $r->email,
            'no_telp' => $r->no_telp,
            'judul' => $r->judul,
            'pesan' => $r->pesan,
        ];
        Mail::to('jayskak24@gmail.com')->send(new HubungiKamiMail($data));
        if (count(Mail::failures()) == 0) {
            return redirect('/hubungikami')->with($this->messageSweetAlert('success', 'Berhasil!', 'Email Anda berhasil kami terima, Kami akan segera memberikan response dalam 1x24 jam!'));
        } else {
            return redirect('/hubungikami')->with($this->messageSweetAlert('error', 'Gagal!', 'Email Anda gagal kami terima, silahkan coba lagi nanti!'));
        }
    }

    public function tentang()
    {
        return view('tentang.index');
    }

    public function struktur_organisasi()
    {
        return view('tentang.strukturDesa');
    }

    public function rukun_warga_user()
    {
        $data = CitizensAssociation::with('userCitizensAssociation')->get();

        $parseData = [
            'title' => 'Daftar Rukun Warga Desa Situsari',
            'data' => $data
        ];

        return view('rukunwarga.list', $parseData);
    }

    public function myaccount_user()
    {
        $data = User::with('userCitizensAssociation')->where('id', Auth::user()->id)->first();
        $mRW = CitizensAssociation::all();

        $parseData = [
            'title' => 'Akun Saya',
            'data' => $data,
            'mRw' => $mRW
        ];

        return view('profil.index', $parseData);
    }

    public function myaccount_user_proses(Request $r)
    {
        $r->validate([
            'name' => 'required|min:3',
            'rw' => 'required'
        ]);

        $find = User::with('userCitizensAssociation')->find(Auth::user()->id);

        if ($find == null) {
            return redirect('/myaccount')->with($this->messageSweetAlert('error', 'Gagal!', 'Data user tidak ditemukan!'));
        }

        if ($r->password) {
            if (Auth::check($r->password, $find->password)) {
                if ($r->password_baru != '') {
                    $find->password = Hash::make($r->password_baru);
                } else {
                    return redirect('/myaccount')->with($this->messageSweetAlert('error', 'Gagal!', 'Password baru kosong!'));
                }
            }
        }

        $find->name = $r->name;
        if ($find->userCitizensAssociation != null) {
            $find->userCitizensAssociation->citizen_association_id = $r->rw;
        } else {
            UserCitizenAssociation::create([
                'citizen_association_id' => $r->rw,
                'user_id' => Auth::user()->id
            ]);
        }

        if ($find->save()) {
            return redirect('/myaccount')->with($this->messageSweetAlert('success', 'Berhasil!', 'Data user Anda telah berhasil dirubah!'));
        } else {
            return redirect('/myaccount')->with($this->messageSweetAlert('error', 'Gagal!', 'Data user Anda telah gagal dirubah!'));
        }
    }
}
