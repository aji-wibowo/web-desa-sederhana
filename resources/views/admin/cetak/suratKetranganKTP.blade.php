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
            width: 200px;
        }

        .td3 {
            width: 20px;
        }

        .td4 {
            width: 60px;
        }

        .td5 {
            width: 10px;
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
            <p>FORM PERMOHONAN KARTU TANDA PENDUDUK (el-KTP)</p>
        </div>
    </div>
    <div class="isi">
        <table>
            <tr>
                <td class="td1">PEMERINTAH PROVINSI</td>
                <td class="td5">:</td>
                <td>{{ $provinsi }}</td>
            </tr>
            <tr>
                <td class="td1">PEMERINTAH KABUPATEN</td>
                <td class="td5">:</td>
                <td>{{ $kabupaten }}</td>
            </tr>
            <tr>
                <td class="td1">KECAMATAN</td>
                <td class="td5">:</td>
                <td>{{ $kecamatan }}</td>
            </tr>
            <tr>
                <td class="td1">KELURAHAN/DESA</td>
                <td class="td5">:</td>
                <td>{{ $desa }}</td>
            </tr>
            <tr>
                <td class="td1">PERMOHONAN KTP</td>
                <td class="td5">:</td>
                <td>{{ $baruAtauGanti }}</td>
            </tr>
            <tr>
                <td class="td1">1. Nama Lengkap</td>
                <td class="td5">:</td>
                <td>{{ $nama }}</td>
            </tr>
            <tr>
                <td class="td1">2. Nomor KK</td>
                <td class="td5">:</td>
                <td>{{ $kk }}</td>
            </tr>
            <tr>
                <td class="td1">3. NIK</td>
                <td class="td5">:</td>
                <td>{{ $nik }}</td>
            </tr>
            <tr>
                <td class="td1">4. Alamat</td>
                <td class="td5">:</td>
                <td class="td1">{{ $alamat }}</td>
                <td>RT : {{ $rt }}</td>
                <td>RW : {{ $rw }}</td>
                <td>KODE POS : {{ $kodePos }}</td>
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
