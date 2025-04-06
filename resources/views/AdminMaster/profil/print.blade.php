<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteTitle }}</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    <link href="{{ asset('assets/css/bootstrap-creative.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('assets/css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- font awesome icon cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        @page {
            size: 210mm 330mm;
            margin: 20mm;
        }
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
        }
        table {
            width: 98%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<!-- <body onload="window.print()"> -->
<body>
    <div class="container">

        <div>
            <table>
                <tr>
                    <td width="15%">
                        <img src="{{ asset('assets/images/logo-gki.png') }}" alt="" class="w-100">
                    </td>
                    <td wdith="85%" class="text-center h1">
                        Gereja Kristen Injili di Tanah Papua <br>
                        Klasis Waibu Moi<br>
                        <span class="font-weight-bold">{{ $data->name }}</span> 
                    </td>
                </tr>
            </table>
        </div>

        <br>
        <div class="text-center">
            <h2 class="font-weight-bold text-uppercase">{{ $pageTitle }}</h2>
            Dicetak pada {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y H:i:s') }} oleh Akun {{ $data->name }}
        </div>
        <br>

        <h3>
            Informasi Umum Jemaat
        </h3>

        <table>
            <tr>
                <th width="25%">Wilayah</th>
                <td wdith="75%">{{ $wilayah }}</td>
            </tr>
            <tr>
                <th>Klasis</th>
                <td>{{ $klasis }}</td>
            </tr>
            <tr>
                <th>Nama Jemaat</th>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <th>Jumlah Keluarga</th>
                <td>{{ $totalKeluarga }} Kepala Keluarga</td>
            </tr>
            <tr>
                <th>Jumlah Anggota Keluarga</th>
                <td>{{ $totalAnggotaKeluarga }} Orang ({{ $anggotaKeluargaLakiLaki }} Laki-Laki, Perempuan: {{ $anggotaKeluargaPerempuan }} Perempuan)</td>
            </tr>
        </table>
        <br>

        <h3>
            Informasi Rincian Profil Jemaat
        </h3>

        <table>
            <tr>
                <th width="25%">Foto Gedung Gereja</th>
                <td><img src="{{ isset($data) && $data->fotoGereja ? asset('storage/' . $data->fotoGereja) : asset('assets/images/gambar-placeholder.jpg') }}" width="50%"></td>
            </tr>
            <tr>
                <th>Foto Ketua Jemaat</th>
                <td><img src="{{ isset($data) && $data->fotoPendeta ? asset('storage/' . $data->fotoPendeta) : asset('assets/images/gambar-placeholder.jpg') }}" width="50%"></td>
            </tr>
            <tr>
                <th>File Sarana-Prasarana</th>
                <td><a href="{{ asset('storage/' . $data->fileSaranaPrasarana) }}" target="_blank">Unduh File Sarana-Prasarana</a></td>
            </tr>
            <tr>
                <th>File Struktur Organisasi</th>
                <td><a href="{{ asset('storage/' . $data->fileStrukturOrganisasi) }}" target="_blank">Unduh File Struktur Organisasi</a></td>
            </tr>
        </table>
        <br>

        

        <h3>
            Informasi Media Sosial Jemaat
        </h3>
        
        <table>
            <tr>
                <th width="25%">Instagram</th>
                <td><a href="{{ $data->instagram }}" target="_blank">{{ $data->instagram }}</a></td>
            </tr>
            <tr>
                <th>Facebook</th>
                <td><a href="{{ $data->facebook }}" target="_blank">{{ $data->facebook }}</a></td>
            </tr>
            <tr>
                <th>WA Channel</th>
                <td><a href="{{ $data->wa_channel }}" target="_blank">{{ $data->wa_channel }}</a></td>
            </tr>
            <tr>
                <th>Youtube</th>
                <td><a href="{{ $data->youtube }}" target="_blank">{{ $data->youtube }}</a></td>
            </tr>
        </table>
        <br>

        

        <h3>
            Informasi Hak Akses
        </h3>
        
        <table>
            <tr>
                <th width="25%">Email</th>
                <td width="75%"><a href="mailto:{{ $data->email }}">{{ $data->email }}</a></td>
            </tr>
            <tr>
                <th>Password</th>
                <td>{{ ('*******') }}</td>
            </tr>
        </table>

        <button class="no-print my-3 btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Cetak</button>
    </div>
</body>
</html>
