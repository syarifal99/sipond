@extends('layouts.app')

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                Edit Pelanggaran Detail
                </h3>
                <span class="kt-subheader__separator kt-hidden"></span>

            </div>
        </div>
    </div>
    <!-- end:: Subheader -->
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                @include('adminlte-templates::common.errors')
                <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                    <div class="kt-portlet__head kt-portlet__head--lg" style="">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Pelanggaran</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td>Nama Siswa</td>
                                <td>:</td>
                                <td>{!! $pelanggaranDetail->bio_siswa->nama_lengkap !!}</td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>:</td>
                                <td>{!! $pelanggaranDetail->keterangan !!}</td>
                            </tr>
                            <tr>
                                <td>Total Score</td>
                                <td>:</td>
                                <td><b>{{$pelanggaranDetail->skor}}</b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                    <div class="kt-portlet__head kt-portlet__head--lg" style="">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Pelanggaran Detail</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table table-striped">
                            <thead>
                                <th>Tindakan</th>
                                <th>Catatan</th>
                                <th>Tanggal Pelanggaran</th>
                                <th>Poin</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($pelanggaranDetail->pelanggaranDetail as $item)
                                    <tr>
                                        <td>{{$item->tindakan}}</td>
                                        <td>{{$item->catatan}}</td>
                                        <td>{{$item->tgl_pelanggaran}}</td>
                                        <td>{{$item->poin}}</td>
                                        <td>
                                            <a href="#!" class="btn btn-warning"><i class="la la-edit"></i></a>
                                            <a href="#!" class="btn btn-danger"><i class="la la-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
        </div>
    </div>
    <!-- end:: Content -->
</div>
@endsection
