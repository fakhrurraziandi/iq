<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url() ?>" style="position: relative;">
                <img class="logo" src="<?php echo base_url('assets/img/iq logo.png') ?>" style="width: 40px; display: inline; position: absolute; top: 50%; transform: translateY(-50%);"></img>
                <span style="display: inline-block; margin-left: 45px;">Insan Qurani</span>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-table"></i>&nbsp;&nbsp; Data Master <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('guru') ?>">Guru</a></li>
                        <li><a href="<?php echo base_url('siswa') ?>">Siswa</a></li>
                        <li><a href="<?php echo base_url('tahunajaran') ?>">Tahun Ajaran</a></li>
                        <li><a href="<?php echo base_url('semester') ?>">Semester</a></li>
                        <li><a href="<?php echo base_url('kelas') ?>">Kelas</a></li>
                        <li><a href="<?php echo base_url('kalenderakademik') ?>">Kalender Akademik</a></li>
                    </ul>
                </li>

                
                <li><a href="<?php echo base_url('penempatansiswa') ?>"><i class="fa fa-user"></i>&nbsp;&nbsp; Penempatan Siswa</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-book"></i>&nbsp;&nbsp; Data Pengajaran Dayah <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('mapeldayah') ?>">Mata Pelajaran</a></li>
                        <li><a href="<?php echo base_url('penilaiandayah') ?>">Penilaian</a></li>
                        <li><a href="<?php echo base_url('penilaiantahfizh') ?>">Penilaian Tahfizh</a></li>
                    </ul>
                </li>

                
                
                <li><a href="<?php echo base_url('rapordayah') ?>"><i class="fa fa-print"></i>&nbsp;&nbsp; Rapor Dayah</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-book"></i>&nbsp;&nbsp;  Data Pengajaran Sekolah <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('mapel') ?>">Mata Pelajaran</a></li>
                        <li><a href="<?php echo base_url('penilaian') ?>">Penilaian Mata Pelajaran</a></li>
                        <li><a href="<?php echo base_url('kepribadian') ?>">Penilaian Kepribadian</a></li>
                        <li><a href="<?php echo base_url('penilaianextrakurikuler') ?>">Penilaian Extrakurikuler</a></li>
                        <li><a href="<?php echo base_url('rekapabsen') ?>">Rekapitulasi Absen</a></li>
                        <li><a href="<?php echo base_url('kenaikankelas') ?>">Keputusan Kenaikan Kelas</a></li>
                    </ul>
                </li>


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i> &nbsp;&nbsp; Rapor Sekolah<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('raporuts') ?>"><i class="fa fa-print"></i> &nbsp;&nbsp; Rapor UTS</a></li>
                        <li><a href="<?php echo base_url('raporuas') ?>"><i class="fa fa-print"></i> &nbsp;&nbsp; Rapor UAS</a></li>
                    </ul>
                </li>

                

                <li><a href="<?php echo base_url('surat') ?>"><i class="fa fa-file-o"></i>&nbsp;&nbsp; Surat</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url('dashboard/logout') ?>"><i class="fa fa-sign-out"></i>&nbsp;&nbsp; Logout</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>