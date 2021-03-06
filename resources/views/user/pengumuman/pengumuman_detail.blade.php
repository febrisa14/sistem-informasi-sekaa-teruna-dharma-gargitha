@extends('component/app')

@section('content')
<!-- Main Container -->
<main id="main-container">

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Detail Pengumuman
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a class="link-fx" href="{{ route('user.pengumuman.index') }}">Pengumuman</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail Pengumuman</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- jQuery Validation (.js-validation class is initialized in js/pages/be_forms_validation.min.js which was auto compiled from _js/pages/be_forms_validation.js) -->
        <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
        @foreach ($pengumumans as $pengumuman)
        <div class="block block-rounded">
            <div class="block-header border-bottom">
                <h3 class="block-title"><small>Informasi Detail</small> Pengumuman</h3>
                {{-- <a href="{{route('admin.kegiatan.cetak', ['id' => $pengumuman->kegiatan_id])}}" id="addKegiatan" class="btn btn-sm btn-alt-primary px-2 py-2">
                    <i class="fa fa-print mr-1"></i> Cetak Kegiatan
                </a> --}}
            </div>
            <div class="block-content block-content-full">
                <div class="block-content font-size-sm">
                    <table class="table table-borderless">
                        <tr>
                            <td width="140px"><b>Nama Kegiatan</b></td>
                            <td width="40px">:</td>
                            <td><span>{{$pengumuman->nama_kegiatan}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Tanggal Kegiatan</b></td>
                            <td>:</td>
                            <td><span>{{$pengumuman->tgl_kegiatan}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Jam Kegiatan</b></td>
                            <td>:</td>
                            <td><span>{{$pengumuman->jam_kegiatan}} WITA</span></td>
                        </tr>
                        <tr>
                            <td><b>Pakaian</b></td>
                            <td>:</td>
                            <td><span>{{$pengumuman->pakaian}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Lokasi Kegiatan</b></td>
                            <td>:</td>
                            <td><span>{{$pengumuman->lokasi}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Lampiran</b></td>
                            <td>:</td>
                            @if ($pengumuman->lampiran != null)
                                <td><span><a href="{{ asset('/doc/'.$pengumuman->lampiran) }}">{{$pengumuman->lampiran}}</a></span></td>
                            @else
                                <td><span style="color: rgb(179, 23, 23);">-- Kosong --</span></td>
                            @endif
                        </tr>
                    </table>
                    <table class="table table-borderless">
                        <tr class="bg-primary text-white">
                            <td><b>Pengumuman ini dibuat pada</b></td>
                            <td>:</td>
                            <td><span>{{$pengumuman->created_at}}</span></td>
                            <td><b>Pengumuman ini dibuat oleh</b></td>
                            <td>:</td>
                            <td><span>{{$pengumuman->name}}</span></td>
                        </tr>
                    </table>
                </div>
            </div><!-- End Block Content -->
        </div>
        @endforeach
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@stop
