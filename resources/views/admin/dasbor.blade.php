@extends('layouts.app')
@section('content')

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid"> 

        <x-page-title 
            :title="$pageTitle"
            :description="$pageDescription" 
        />

            <div class="row">
                
                <div class="col-12">

                    <div class="card-box">
                        <h5 class="h4">{!! $emojiUsulan !!} Usulan Barang Terbaru</h5>
                        <p>Berbagai usulan barang yang sedang dalam proses verifikasi dan menunggu konfirmasi</p>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal Usulan</th>
                                    <th>Poliklinik Pengusul</th>
                                    <th>Jumlah Obat</th>
                                    <th>Jumlah Bahan Habis Pakai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><i class="fe-calendar"></i> Senin, 7 April 2025</td>
                                    <td>Poliklinik Brimob</td>
                                    <td>123</td>
                                    <td>21</td>
                                    <td>⏳ Menunggu Konfirmasi</td>
                                    <td>
                                        <a href="#">{!! $emojiDetail !!} Lihat</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fe-calendar"></i> Senin, 7 April 2025</td>
                                    <td>Poliklinik Polda Papua</td>
                                    <td>123</td>
                                    <td>21</td>
                                    <td>🕒 Proses Verifikasi</td>
                                    <td>
                                        <a href="#">{!! $emojiDetail !!} Lihat</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <a href="#" class="btn btn-link"><i class="fe-log-in"></i> Tampilkan Semua Usulan dari Poliklinik</a>
                        <a href="#" class="btn btn-link"><i class="fe-pie-chart"></i> Laporan & Rekapan Barang Masuk</a>
                    </div>

                </div><!-- end col-->
                
            </div>
            <!-- end row-->

            <div class="row">
                
                <div class="col-lg-6">

                    <div class="card-box">
                        <h5 class="h4">{!! $emojiBarangMasuk !!} Notifikasi Barang Masuk</h5>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jumlah Obat</th>
                                    <th>Jumlah Bahan Habis Pakai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><i class="fe-calendar"></i> Senin, 7 April 2025</td>
                                    <td>123</td>
                                    <td>21</td>
                                    <td>
                                        <a href="#">{!! $emojiDetail !!} Lihat</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <a href="#" class="btn btn-link"><i class="fe-log-in"></i> Kelola Data Barang Masuk</a>
                        <a href="#" class="btn btn-link"><i class="fe-pie-chart"></i> Laporan & Rekapan Barang Masuk</a>
                    </div>
                    
                </div><!-- end col-->
                
                <div class="col-lg-6">

                    <div class="card-box">
                        <h5 class="h4">{!! $emojiBarangKeluar !!} Notifikasi Barang Keluar</h5>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Penerima</th>
                                    <th>Jumlah Obat</th>
                                    <th>Jumlah Bahan Habis Pakai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><i class="fe-calendar"></i> Senin, 7 April 2025</td>
                                    <td>Poliklinik Brimob</td>
                                    <td>123</td>
                                    <td>21</td>
                                    <td>
                                        <a href="#">{!! $emojiDetail !!} Lihat</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <a href="#" class="btn btn-link"><i class="fe-log-out"></i> Kelola Data Barang Keluar</a>
                        <a href="#" class="btn btn-link"><i class="fe-pie-chart"></i> Laporan & Rekapan Barang Keluar</a>
                    </div>
                    
                </div><!-- end col-->
                
            </div>
            <!-- end row-->
            
        </div> <!-- container -->

    </div> <!-- content -->

    <x-footer />

</div>

@stop
