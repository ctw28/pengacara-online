@extends('template')


@section('css')
@endsection

@section('content')

<div class="col-xl-12">
    <div class="card">
        <div class="card-header d-block d-sm-flex border-0">
            <div class="me-3">
                <h4 class="card-title mb-2">Daftar Kegiatan {{session('sesi')['tahun_anggaran_sebutan']}}</h4>
                <!-- <span class="fs-12">Lorem ipsum dolor sit amet, consectetur</span> -->
            </div>
            <div class="card-tabs mt-3 mt-sm-0">
                <a href="{{route('user.kegiatan.create')}}" class="btn btn-secondary">+ Tambah Data</a>
                <!-- <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                    </li>
                </ul> -->
            </div>
        </div>
        <div class="card-body tab-content p-0">
            <div class="tab-pane fade active show" id="monthly" role="tabpanel">
                <div id="accordion-one" class="accordion style-1">
                    @foreach ($data['dataKegiatan'] as $key=>$item)
                    <div class="accordion-item">
                        <div class="accordion-header collapsed" data-bs-toggle="collapse"
                            data-bs-target="#default_collapseOne{{$key+1}}">
                            <div class="d-flex align-items-center">
                                <!-- <div class="profile-image">
                                    <img src="images/avatar/1.jpg" alt="">
                                    <span class="bg-success">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip3)">
                                                <path
                                                    d="M10.4125 14.85C10.225 14.4625 10.3906 13.9937 10.7781 13.8062C11.8563 13.2875 12.7688 12.4812 13.4188 11.4719C14.0844 10.4375 14.4375 9.23749 14.4375 7.99999C14.4375 4.44999 11.55 1.56249 8 1.56249C4.45 1.56249 1.5625 4.44999 1.5625 7.99999C1.5625 9.23749 1.91562 10.4375 2.57812 11.475C3.225 12.4844 4.14062 13.2906 5.21875 13.8094C5.60625 13.9969 5.77187 14.4625 5.58437 14.8531C5.39687 15.2406 4.93125 15.4062 4.54062 15.2187C3.2 14.575 2.06562 13.575 1.2625 12.3187C0.4375 11.0312 -4.16897e-07 9.53749 -3.49691e-07 7.99999C-2.56258e-07 5.86249 0.83125 3.85312 2.34375 2.34374C3.85313 0.831242 5.8625 -7.37314e-06 8 -7.2797e-06C10.1375 -7.18627e-06 12.1469 0.831243 13.6563 2.34374C15.1688 3.85624 16 5.86249 16 7.99999C16 9.53749 15.5625 11.0312 14.7344 12.3187C13.9281 13.5719 12.7938 14.575 11.4563 15.2187C11.0656 15.4031 10.6 15.2406 10.4125 14.85Z"
                                                    fill="white" />
                                                <path
                                                    d="M11.0407 8.41563C11.1938 8.56876 11.2688 8.76876 11.2688 8.96876C11.2688 9.16876 11.1938 9.36876 11.0407 9.52188L9.07503 11.4875C8.78753 11.775 8.40628 11.9313 8.00315 11.9313C7.60003 11.9313 7.21565 11.7719 6.93127 11.4875L4.96565 9.52188C4.6594 9.21563 4.6594 8.72188 4.96565 8.41563C5.2719 8.10938 5.76565 8.10938 6.0719 8.41563L7.22502 9.56876L7.22502 5.12814C7.22502 4.69689 7.57503 4.34689 8.00628 4.34689C8.43753 4.34689 8.78753 4.69689 8.78753 5.12814L8.78753 9.57188L9.94065 8.41876C10.2407 8.11251 10.7344 8.11251 11.0407 8.41563Z"
                                                    fill="white" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip3">
                                                    <rect width="16" height="16" fill="white"
                                                        transform="matrix(-4.37114e-08 1 1 4.37114e-08 0 -7.62939e-06)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                </div> -->
                                <div style="margin-right:20px">
                                    <h6 class="fs-26 font-w600 mb-0"><a href="javascript:void(0)">{{$key + 1}}</a></h6>
                                </div>
                                <div class="user-info">
                                    <span class="fs-12">Tanggal Kegiatan :
                                        {{\Carbon\Carbon::parse($item->kegiatan_tanggal)->format('d M Y')}}</span>
                                    <h6 class="fs-15 font-w500 mb-0"><a
                                            href="javascript:void(0)">{{$item->kegiatan_nama}}</a></h6>
                                </div>
                                <div style="margin-left:20px">
                                    <a class="btn btn-info btn-xs" href="#">Detail</a>
                                </div>
                            </div>

                            <span class="accordion-header-indicator"></span>
                        </div>
                        <div id="default_collapseOne{{$key+1}}" class="collapse accordion_body"
                            data-bs-parent="#accordion-one">
                            <div class="payment-details accordion-body-text">
                                <div class="me-3 mb-3">
                                    <p class="fs-12 mb-2">Nomor SK</p>
                                    <span class="font-w500">{{$item->kegiatan_sk}}</span>
                                </div>
                                <div class="me-3 mb-3">
                                    <p class="fs-12 mb-2">Tangga SK</p>
                                    <span class="font-w500">{{$item->kegiatan_sk_tanggal}}</span>
                                </div>
                                <div class="me-3 mb-3">
                                    <p class="fs-12 mb-2">Sub Kegiatan</p>
                                    <span class="font-w500">{{$item->kegiatan_sub_kegiatan}}</span>
                                </div>
                                <div class="me-3 mb-3">
                                    <p class="fs-12 mb-2">Akun</p>
                                    <span class="font-w500">{{$item->kegiatan_akun}}</span>
                                </div>
                                <div class="me-3 mb-3">
                                    <p class="fs-12 mb-2">No. Bukti</p>
                                    <span class="font-w500">{{$item->kegiatan_no_bukti}}</span>
                                </div>
                                <div class="mb-3">
                                    <a class="btn btn-primary btn-sm"
                                        href="{{route('user.kegiatan.setup',$item->id)}}">Pengaturan
                                        Kegiatan</a>
                                    <a class="btn btn-info btn-sm"
                                        href="{{route('user.kegiatan.bayar',$item->id)}}">Pembayaran</a>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-warning dropdown-toggle"
                                            data-bs-toggle="dropdown">Edit/Hapus</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void()">Edit</a>
                                            <a class="dropdown-item" href="javascript:void()">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection