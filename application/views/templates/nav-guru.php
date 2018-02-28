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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-book"></i>&nbsp;&nbsp; Data Pengajaran Dayah <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('penilaiandayah') ?>">Penilaian</a></li>
                    </ul>
                </li>

                
                
            

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-book"></i>&nbsp;&nbsp;  Data Pengajaran Sekolah <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        
                        <li><a href="<?php echo base_url('penilaian') ?>">Penilaian</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url('dashboard/logout') ?>"><i class="fa fa-sign-out"></i>&nbsp;&nbsp; Logout</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>