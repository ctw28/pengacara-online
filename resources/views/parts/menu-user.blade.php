<li><a href="{{route('user.dashboard')}}" aria-expanded="true">
        <i class="flaticon-025-dashboard"></i>
        <span class="nav-text">Dashboard</span>
    </a>
</li>
<li><a class="has-arrow ai-icon" href="#" aria-expanded="false">
        <i class="flaticon-050-info"></i>
        <span class="nav-text">Referensi</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{route('referensi.jabatan.index')}}">Master Jabatan</a></li>
    </ul>
</li>
<li><a href="{{route('user.kegiatan.index')}}" aria-expanded="false">
        <i class="flaticon-050-info"></i>
        <span class="nav-text">Kegiatan</span>
    </a>
</li>
<li><a class="has-arrow ai-icon" href="#" aria-expanded="false">
        <i class="flaticon-050-info"></i>
        <span class="nav-text">Honor Bulanan</span>
    </a>
    <ul aria-expanded="false">
        <!-- <li><a href="index.html">Akun</a></li> -->
        <li><a href="{{route('rutin.sk.index')}}">SK</a></li>
        <!-- <li><a href="my-wallet.html">Pejabat</a></li> -->
        <li><a href="my-wallet.html">Pembayaran</a></li>
    </ul>
</li>
<li><a href="#" aria-expanded="false">
        <i class="flaticon-050-info"></i>
        <span class="nav-text">Perjalanan Dinas</span>
    </a>
</li>