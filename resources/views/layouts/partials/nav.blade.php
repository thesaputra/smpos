<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
      data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle Navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">SIMA POS</a>
  </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li><a href="{!! route('dashboard') !!}"><i class="fa fa-book"></i>Dashboard</a></li>
      <li><a href="{!! route('master.user') !!}"><i class="fa fa-book"></i>Pegawai</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Unit Kerja<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{!! route('master.office') !!}"><i class="fa fa-book"></i>Kantor Pusat</a></li>
          <li><a href="{!! route('master.region') !!}"><i class="fa fa-book"></i>Data Regional</a></li>
        </ul>
      </li>
      <li><a href="{!! route('transaction.setup') !!}"><i class="fa fa-book"></i>Master Transaksi</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Transaksi<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{!! route('transaction.new') !!}"><i class="fa fa-book"></i>Transaksi Baru</a></li>
          <li><a href="{!! route('transaction.manage.assets') !!}"><i class="fa fa-book"></i>Manage Assets</a></li>
          <li><a href="#"><i class="fa fa-book"></i>Penempatan</a></li>
          </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mutasi & Penempatan<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{!! route('mutation.index') !!}"><i class="fa fa-book"></i>Mutasi Kirim</a></li>
          <li><a href="{!! route('mutation.index_sent') !!}"><i class="fa fa-book"></i>Mutasi Terima</a></li>
          <li><a href="{!! route('placing.index') !!}"><i class="fa fa-book"></i>Penempatan</a></li>
          </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Referensi Asset<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{!! route('master.asset_type') !!}"><i class="fa fa-book"></i>Tipe Asset</a></li>
          <li><a href="{!! route('master.asset_category') !!}"><i class="fa fa-book"></i>Kategori Asset</a></li>
          </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laporan<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#"><i class="fa fa-book"></i>Laporan 75</a></li>
          <li><a href="#"><i class="fa fa-book"></i>Laporan 74</a></li>
          <li><a href="#"><i class="fa fa-book"></i>Laporan Mutasi</a></li>
          <li><a href="#"><i class="fa fa-book"></i>Laporan Penempatan</a></li>
          </ul>
      </li>
    </ul>
    <p class="navbar-text navbar-right"><a href="{!! URL::to('/auth/logout') !!}" class="navbar-link">Logout</a></p>
  </div>
</div>
</nav>
