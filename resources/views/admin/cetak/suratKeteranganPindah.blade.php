<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        body {
            border: 0px solid black;
            width: 100%;
            margin: auto;
            margin-top: 10px;
        }

        .kop-surat {
            text-align: center;
        }

        .kop-surat p {
            margin: 0;
            font-weight: bold;
        }

        th,
        td {
            vertical-align: top;
        }

        table p {
            margin: 0;
        }

        .isi {
            margin: 10px;
            margin-top: 50px;
            clear: both;
        }

        .td1 {
            width: 10px;
        }

        .td3 {
            width: 20px;
        }

        .td4 {
            width: 60px;
        }

        .heightnya {
            padding-bottom: 100px;
        }

    </style>
</head>

<body>
    <div class="kop-surat">
        <img width="70px" style="float: left;margin-left: 10px;left: 0;position: absolute;"
            src="{{ public_path('img/logo.png') }}" alt="foto">
        <div>
            <p>PEMERINTAH KABUPATEN BOGOR</p>
            <p>DINAS KEPENDUDUKAN DAN CATATAN SIPIL</p>
            <p>FORM SURAT KETERANGAN PINDAH DATANG WNI</p>
        </div>
    </div>
    <div class="isi">
        <table>
            <tr>
                <td colspan="4">DATA DAERAH ASAL</td>
            </tr>
            <tr>
                <td class="td1">1.</td>
                <td>Nomor Kartu Keluarga</td>
                <td class="td3">:</td>
                <td colspan="2">{{ $kk }}</td>
            </tr>
            <tr>
                <td class="td1">2.</td>
                <td>NIK</td>
                <td class="td3">:</td>
                <td>{{ $nik }}</td>
            </tr>
            <tr>
                <td class="td1">3.</td>
                <td>Nama</td>
                <td class="td3">:</td>
                <td>{{ $nama }}</td>
            </tr>
            <tr>
                <td class="td1">4.</td>
                <td>Alamat</td>
                <td class="td3">:</td>
                <td class="td4">{{ $asalAlamat }}</td>
                <td>RT : {{ $asalRT }}</td>
                <td>RW : {{ $asalRW }}</td>
            </tr>
            <tr>
                <td class="td1">5.</td>
                <td>Desa/Kelurahan</td>
                <td class="td3">:</td>
                <td class="td4">{{ $asalDesa }}</td>
                <td>Kab/Kota : {{ $asalKota }}</td>
            </tr>
            <tr>
                <td class="td1">6.</td>
                <td>Kecamatan</td>
                <td class="td3">:</td>
                <td class="td4">{{ $asalKecamatan }}</td>
                <td>Provinsi : {{ $asalProvinsi }}</td>
            </tr>
            <tr>
                <td class="td1">7.</td>
                <td>Kode Pos</td>
                <td class="td3">:</td>
                <td class="td4">{{ $asalKodePos }}</td>
                <td>No. Telp : {{ $asalNomorTelp }}</td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td colspan="4">DATA KEPINDAHAN</td>
            </tr>
            <tr>
                <td class="td1">8.</td>
                <td>Alamat</td>
                <td class="td3">:</td>
                <td style="width: 120px">{{ $tujuanAlamat }}</td>
                <td style="width: 200px;">RT : {{ $tujuanRT }}</td>
                <td style="width: 150px;">RW : {{ $tujuanRW }}</td>
            </tr>
            <tr>
                <td class="td1">9.</td>
                <td>Desa/Kelurahan</td>
                <td class="td3">:</td>
                <td class="td4">{{ $tujuanDesa }}</td>
                <td>Kab/Kota : {{ $tujuanKota }}</td>
            </tr>
            <tr>
                <td class="td1">10.</td>
                <td>Kecamatan</td>
                <td class="td3">:</td>
                <td class="td4">{{ $tujuanKecamatan }}</td>
                <td>Provinsi : {{ $tujuanProvinsi }}</td>
            </tr>
            <tr>
                <td class="td1">11.</td>
                <td>Kode Pos</td>
                <td class="td3">:</td>
                <td class="td4">{{ $tujuanKodePos }}</td>
                <td>No. Telp : {{ $tujuanNomorTelp }}</td>
            </tr>
            <tr>
                <td class="td1">12.</td>
                <td>Klasifikasi Pindah</td>
                <td class="td3">:</td>
                <td class="td3">O Dalam Satu Desa/Kelurahan</td>
                <td class="td3">O Antar Desa/Kelurahan</td>
                <td class="td3">O Antar Provinsi</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="td3">O Antar Kecamatan</td>
                <td class="td3">O Antar Kab/Kota</td>
            </tr>
        </table>
    </div>
    <div class="heightnya" style="clear: both"></div>
    <table style="width: 100%; text-align: center">
        <tr>
            <td style="width: 50%"></td>
            <td style="width: 50%">Situsari, {{ date('d M Y') }}</td>
        </tr>
        <tr>
            <td></td>
            <td>Mengtahui</td>
        </tr>
        <tr>
            <td></td>
            <td class="heightnya">Kepala Desa Situsari</td>
        </tr>
        <tr class="heightnya">
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Pemohon</td>
            <td>DAHLAN</td>
        </tr>
    </table>
</body>

</html>
