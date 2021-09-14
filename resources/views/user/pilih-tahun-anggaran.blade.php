<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Juara : Pengajuan Anggaran Online" />
    <meta property="og:title" content="Juara : Pengajuan Anggaran Online" />
    <meta property="og:description" content="Juara : Pengajuan Anggaran Online" />
    <meta property="og:image" content="https://dompet.dexignlab.com/xhtml/social-image.png" />
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>Juara - Pengajuan Anggaran Online</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png" />
    <link href="{{asset('/')}}css/style.css" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h3 class="text-center mb-4">Hai, {{auth()->user()->name}}</h3>
                                    <h4 class="text-center mb-4">silahkan tentukan Tahun Anggaran dahulu</h4>
                                    <form method="POST" action="{{ route('user.set.tahun.anggaran') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <!-- <label class="mb-1"><strong>Pilih Tahun Anggaran</strong></label> -->
                                            <select class="default-select form-control wide mb-3" name="tahun_anggaran"
                                                required>
                                                <option value="">Pilih Tahun Anggaran</option>
                                                @foreach ($tahunAnggaran as $tahun)
                                                <option value="{{$tahun->id}}">{{$tahun->tahun_anggaran}}</option>
                                                @endforeach
                                            </select> @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Pilih</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
    <!-- Common JS -->
    <script src="{{asset('/')}}vendor/global/global.min.js"></script>
    <!-- Custom script -->
    <script src="{{asset('/')}}vendor/dlabnav/dlabnav.min.js"></script>
    <script src="{{asset('/')}}js/custom.min.js"></script>
    <script src="{{asset('/')}}js/dlabnav-init.js"></script>

</body>

</html>