<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">Data Guru</div>
				</div>
				<div class="panel-body">
					<div id="table-toolbar">
						<a id="btn-add" href="" class="btn btn-primary btn-sm"><i class="fa fa-plus" title="Tambah Guru"></i> Tambah</a>
                        <a id="btn-print" href="<?php echo base_url('guru/cetak') ?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print" title="Cetak"></i> Cetak</a>
					</div>
					<table id="table"></table>
				</div>
			</div>
		</div>
	</div>
</div>




<div id="modal-add" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <form id="form-add" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Guru</h4>
            </div>
            <div class="modal-body">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="indentitas_personal_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#indentitas_personal" aria-expanded="false" aria-controls="indentitas_personal">
                                    Identitas Personal/PTK
                                </a>
                            </h4>
                        </div>
                        <div id="indentitas_personal" class="panel-collapse collapse" role="tabpanel" aria-labelledby="indentitas_personal_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nip_nignp">NIP / NIGNP</label>
                                            <input type="text" class="form-control" id="nip_nignp" name="nip_nignp" placeholder="NIP / NIGNP">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nuptk_pegid">NUPTK / PegId</label>
                                            <input type="text" class="form-control" id="nuptk_pegid" name="nuptk_pegid" placeholder="NUPTK / PegId" >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nik_noktp">NIK/No. KTP</label>
                                            <input type="text" class="form-control" id="nik_noktp" name="nik_noktp" placeholder="NIK/No. KTP" >
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama">Nama Lengkap Personal</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap Personal">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kode">Kode</label>
                                            <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                                <option value=""></option>
                                                <option value="l">Laki-laki</option>
                                                <option value="p">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama_ibu_kandung">Nama Ibu Kandung</label>
                                            <input type="text" class="form-control" id="nama_ibu_kandung" name="nama_ibu_kandung" placeholder="Nama Ibu Kandung">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nomor_hp">No HP</label>
                                            <input type="text" name="nomor_hp" id="nomor_hp" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="agama_ptk">Agama PTK</label>
                                            <select name="agama_ptk" id="agama_ptk" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Islam</option>
                                                <option value="2">Kristen</option>
                                                <option value="3">Katholik</option>
                                                <option value="4">Hindu</option>
                                                <option value="5">Budha</option>
                                                <option value="6">Khonghucu</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="pendidikan_terakhir_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#pendidikan_terakhir" aria-expanded="false" aria-controls="pendidikan_terakhir">
                                    Pendidikan Terakhir
                                </a>
                            </h4>
                        </div>
                        <div id="pendidikan_terakhir" class="panel-collapse collapse" role="tabpanel" aria-labelledby="pendidikan_terakhir_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pendidikan_terakhir--jenjang">Jenjang</label>
                                            <select name="pendidikan_terakhir--jenjang" id="pendidikan_terakhir--jenjang" class="form-control">
                                                <option value="0">Tidak berpendidikan formal</option>
                                                <option value="1"><= SLTP</option>
                                                <option value="2">SLTA</option>
                                                <option value="3">D1</option>
                                                <option value="4">D2</option>
                                                <option value="5">D3</option>
                                                <option value="6">D4</option>
                                                <option value="7">S1</option>
                                                <option value="8">S2</option>
                                                <option value="9">S3</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pendidikan_terakhir--kelompok_program_studi">Kelompok Program Studi</label>
                                            <select name="pendidikan_terakhir--kelompok_program_studi" id="pendidikan_terakhir--kelompok_program_studi" class="form-control">
                                                <option value=""></option>
                                                <option value="01">Rumpun Pendidikan Agama Islam (PAI)</option>
                                                <option value="02">Bahasa Indonesia</option>
                                                <option value="03">Bahasa Inggris</option>
                                                <option value="04">Bahasa Arab</option>
                                                <option value="05">Bahasa Asing Lainnya (Bahasa Jepang, Mandarin, Korea, Jerman, Belanda, Perancis, Rusia, dll)</option>
                                                <option value="06">Matematika/Statistika</option>
                                                <option value="07">IPA (Fisika, Biologi, Kimia, Metereologi, Geofisika)</option>
                                                <option value="08">Ilmu Sosial (Ekonomi, Akuntansi, Sosiologi, Antropologi, Tata Negara, Manajemen, Administrasi)</option>
                                                <option value="09">Ilmu Komputer/Informatika/Teknologi Informasi</option>
                                                <option value="10">Pendidikan Jasmani, Olahraga dan Kesehatan</option>
                                                <option value="11">Manajemen Pendidikan / Ilmu Pendidikan</option>
                                                <option value="12">Hukum/Syari'ah/Hukum Islam</option>
                                                <option value="13">PGSD/PGMI</option>
                                                <option value="14">PGTK</option>
                                                <option value="15">Psikologi</option>
                                                <option value="16">Kesenian</option>
                                                <option value="17">Pendidikan Kewarganegaraan</option>
                                                <option value="18">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="status_kepegawaian_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#status_kepegawaian" aria-expanded="false" aria-controls="status_kepegawaian">
                                    Status Kepegawaian Personal/PTK
                                </a>
                            </h4>
                        </div>
                        <div id="status_kepegawaian" class="panel-collapse collapse" role="tabpanel" aria-labelledby="status_kepegawaian_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian">Status Kepegawaian</label>
                                            <select name="status_kepegawaian" id="status_kepegawaian" class="form-control">
                                                <option value=""></option>
                                                <option value="1">PNS</option>
                                                <option value="2">Non-PNS</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--status_inpassing">Status Inpassing</label>
                                            <select name="status_kepegawaian--status_inpassing" id="status_kepegawaian--status_inpassing" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Belum Inpassing</option>
                                                <option value="1">Sudah Inpassing</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--tmt_inpassing">TMT Inpassing</label>
                                            <input type="date" class="form-control" name="status_kepegawaian--tmt_inpassing" id="status_kepegawaian--tmt_inpassing">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--golongan">Golongan</label>
                                            <select name="status_kepegawaian--golongan" id="status_kepegawaian--golongan" class="form-control">
                                                <option value=""></option>
                                                <option value="01">Golongan I</option>
                                                <option value="02">II/a</option>
                                                <option value="03">II/b</option>
                                                <option value="04">II/c</option>
                                                <option value="05">II/d</option>
                                                <option value="06">III/a</option>
                                                <option value="07">III/b</option>
                                                <option value="08">III/c</option>
                                                <option value="09">III/d</option>
                                                <option value="10">IV/a</option>
                                                <option value="11">IV/b</option>
                                                <option value="12">IV/c</option>
                                                <option value="13">IV/d</option>
                                                <option value="14">IV/e</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--tmt_sk_cpns">TMT SK CPNS</label>
                                            <input type="date" name="status_kepegawaian--tmt_sk_cpns" id="status_kepegawaian--tmt_sk_cpns" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--tmt_sk_awal">TMT SK Awal</label>
                                            <input type="date" name="status_kepegawaian--tmt_sk_awal" id="status_kepegawaian--tmt_sk_awal" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--tmt_sk_akhir">TMT SK Akhir</label>
                                            <input type="date" name="status_kepegawaian--tmt_sk_akhir" id="status_kepegawaian--tmt_sk_akhir" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--instansi_yang_mengangkat">Instansi Yang Mengangkat</label>
                                            <select name="status_kepegawaian--instansi_yang_mengangkat" id="status_kepegawaian--instansi_yang_mengangkat" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Kementerian Agama</option>
                                                <option value="2">Pemerintah Daerah</option>
                                                <option value="3">Kementerian Lainnya</option>
                                                <option value="4">Yayasan Penyelenggara</option>
                                                <option value="5">Satuan Pendidikan (RA/Madrasah)</option>
                                                <option value="6">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--status_penugasan">Status Penugasan</label>
                                            <select name="status_kepegawaian--status_penugasan" id="status_kepegawaian--status_penugasan" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Tetap</option>
                                                <option value="2">Tidak Tetap</option>
                                                <option value="3">Diperbantukan</option>
                                                <option value="4">Dipekerjakan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--gaji_pokok_perbulan">Gaji Pokok Perbulan</label>
                                            <input type="number" name="status_kepegawaian--gaji_pokok_perbulan" id="status_kepegawaian--gaji_pokok_perbulan" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--status_tempat_tugas">Status Tempat Tugas</label>
                                            <select name="status_kepegawaian--status_tempat_tugas" id="status_kepegawaian--status_tempat_tugas" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Satminkal</option>
                                                <option value="2">Bukan Satminkal</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--status_kepegawaian--jenis_satminkal">Jenis Satminkal</label>
                                            <select name="status_kepegawaian--status_kepegawaian--jenis_satminkal" id="status_kepegawaian--status_kepegawaian--jenis_satminkal" class="form-control">
                                                <option value=""></option>
                                                <option value="1">MI</option>
                                                <option value="2">MTs</option>
                                                <option value="3">MA</option>
                                                <option value="4">SD</option>
                                                <option value="5">SMP</option>
                                                <option value="6">SMA</option>
                                                <option value="7">SMK</option>
                                                <option value="8">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--npsn_satminkal">NPSN Satminkal</label>
                                            <input type="text" name="status_kepegawaian--npsn_satminkal" id="status_kepegawaian--npsn_satminkal" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--tugas_utama_di_madrasah_ini">Tugas Utama Di Madrasah Ini</label>
                                            <select name="status_kepegawaian--tugas_utama_di_madrasah_ini" id="status_kepegawaian--tugas_utama_di_madrasah_ini" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Pendidik</option>
                                                <option value="2">Tenaga Kependidikan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--status_kepegawaian--status_keaktifan_personal">Status Keaktifan Personal</label>
                                            <select name="status_kepegawaian--status_kepegawaian--status_keaktifan_personal" id="status_kepegawaian--status_kepegawaian--status_keaktifan_personal" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Aktif Bertugas</option>
                                                <option value="2">Cuti</option>
                                                <option value="3">Tugas di Instansi Lain</option>
                                                <option value="4">Tugas Belajar</option>
                                                <option value="5">Izin Belajar</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="tugas_utama_sebagai_pendidik_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#tugas_utama_sebagai_pendidik" aria-expanded="false" aria-controls="tugas_utama_sebagai_pendidik">
                                    Tugas Utama Sebagai Pendidik
                                </a>
                            </h4>
                        </div>
                        <div id="tugas_utama_sebagai_pendidik" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tugas_utama_sebagai_pendidik_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_utama_sebagai_pendidik--mapel_utama_yang_diampu">Mapel Utama Yang Di Ampu</label>
                                            <select name="tugas_utama_sebagai_pendidik--mapel_utama_yang_diampu" id="tugas_utama_sebagai_pendidik--mapel_utama_yang_diampu" class="form-control">
                                                <option value=""></option>
                                                <option value="01"> Pendidikan Agama Islam (PAI)</option>
                                                <option value="02">Al Qur'an Hadist</option>
                                                <option value="03">Aqidah Akhlak</option>
                                                <option value="04">Fiqih</option>
                                                <option value="05">Sejarah Kebudayaan Islam (SKI)</option>
                                                <option value="06">Pendidikan Kewarganegaraan (PKn)</option>
                                                <option value="07">Bahasa Indonesia</option>
                                                <option value="08">Bahasa Arab</option>
                                                <option value="09">Bahasa Inggris</option>
                                                <option value="10">Bahasa Asing Lainnya</option>
                                                <option value="11">Matematika</option>
                                                <option value="12">IPA</option>
                                                <option value="13">Fisika</option>
                                                <option value="14">Biologi</option>
                                                <option value="15">Kimia</option>
                                                <option value="16">IPS</option>
                                                <option value="17">Sejarah / Sejarah Nasional dan Umum</option>
                                                <option value="18">Geografi</option>
                                                <option value="19">Ekonomi / Akuntansi</option>
                                                <option value="20">Sosiologi Antropologi</option>
                                                <option value="21">Sosiologi</option>
                                                <option value="22">Antropologi</option>
                                                <option value="23">Tata Negara</option>
                                                <option value="24">Seni Budaya dan Keterampilan / Kerajinan Tangan dan Kesenian</option>
                                                <option value="25">Seni Budaya</option>
                                                <option value="26">Keterampilan</option>
                                                <option value="27">Pendidikan Jasmani, Olahraga dan Kesehatan</option>
                                                <option value="28">Teknologi Informasi dan Komunikasi (TIK)</option>
                                                <option value="29">Muatan Lokal Umum</option>
                                                <option value="30">Muatan Lokal Agama</option>
                                                <option value="31">Bimbingan Konseling / Bimbingan Penyuluhan</option>
                                                <option value="32">Guru Kelas</option>
                                                <option value="33">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_utama_sebagai_pendidik--total_jam_tatap_muka_per_minggu">Total Jam Tatap Muka/Minggu</label>
                                            <input type="number" name="tugas_utama_sebagai_pendidik--total_jam_tatap_muka_per_minggu" id="tugas_utama_sebagai_pendidik--total_jam_tatap_muka_per_minggu" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="tugas_utama_sebagai_tenaga_kependidikan_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#tugas_utama_sebagai_tenaga_kependidikan" aria-expanded="false" aria-controls="tugas_utama_sebagai_tenaga_kependidikan">
                                    Tugas Utama Sebagai Kependidikan
                                </a>
                            </h4>
                        </div>
                        <div id="tugas_utama_sebagai_tenaga_kependidikan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tugas_utama_sebagai_tenaga_kependidikan_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_utama_sebagai_tenaga_kependidikan">Tugas Utama Sebagai Tenaga Kependidikan</label>
                                            <select name="tugas_utama_sebagai_tenaga_kependidikan" id="tugas_utama_sebagai_tenaga_kependidikan" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Tenaga Administrasi</option>
                                                <option value="2">Tenaga Perpustakaan</option>
                                                <option value="3">Tenaga Laboratorium</option>
                                                <option value="4">Tenaga Kebersihan</option>
                                                <option value="5">Pengemudi</option>
                                                <option value="6">Penjaga Sekolah/Pesuruh</option>
                                                <option value="7">Tenaga Keamanan</option>
                                                <option value="8">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="tugas_tambahan_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#tugas_tambahan" aria-expanded="false" aria-controls="tugas_tambahan">
                                    Tugas Tambahan di Madrasah Ini  
                                </a>
                            </h4>
                        </div>
                        <div id="tugas_tambahan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tugas_tambahan_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_tambahan--jenis_tugas">Jenis Tugas</label>
                                            <select name="tugas_tambahan--jenis_tugas" id="tugas_tambahan--jenis_tugas" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Kepala Madrasah</option>
                                                <option value="2">Wakil Kepala Madrasah</option>
                                                <option value="3">Kepala Perpustakaan</option>
                                                <option value="4">Kepala Laboratorium</option>
                                                <option value="5">Ketua Jurusan/Program Keahlian</option>
                                                <option value="6">Kepala Bengkel</option>
                                                <option value="7">Pembimbing Praktek Kerja Industri</option>
                                                <option value="8">Kepala Unit Produksi</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_tambahan--ekuivalensi_jam_tatap_muka">Ekuivalensi Jam Tatap Muka</label>
                                            <input type="number" readonly="" name="tugas_tambahan--ekuivalensi_jam_tatap_muka" id="tugas_tambahan--ekuivalensi_jam_tatap_muka" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="tugas_mengajar_di_satuan_lain_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#tugas_mengajar_di_satuan_lain" aria-expanded="false" aria-controls="tugas_mengajar_di_satuan_lain">
                                    Tugas Mengajar di Satuan Pendidikan Lain (di luar Madrasah Ini)        
                                </a>
                            </h4>
                        </div>
                        <div id="tugas_mengajar_di_satuan_lain" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tugas_mengajar_di_satuan_lain_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_mengajar_di_satuan_lain--jenis_tempat_tugas_lain">Jenis Tempat Tugas Lain</label>
                                            <select name="tugas_mengajar_di_satuan_lain--jenis_tempat_tugas_lain" id="tugas_mengajar_di_satuan_lain--jenis_tempat_tugas_lain" class="form-control">
                                                <option value=""></option>
                                                <option value="1">MI</option>
                                                <option value="2">MTs</option>
                                                <option value="3">MA</option>
                                                <option value="4">SD</option>
                                                <option value="5">SMP</option>
                                                <option value="6">SMA</option>
                                                <option value="7">SMK</option>
                                                <option value="8">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_mengajar_di_satuan_lain--npsn_tempat_tugas_lain">NPSN Tempat Tugas Lain</label>
                                            <input type="text" name="tugas_mengajar_di_satuan_lain--npsn_tempat_tugas_lain" id="tugas_mengajar_di_satuan_lain--npsn_tempat_tugas_lain" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_mengajar_di_satuan_lain--mapel_yang_diampu">Mapel Yang Di Ampu</label>
                                            <input type="text" name="tugas_mengajar_di_satuan_lain--mapel_yang_diampu" id="tugas_mengajar_di_satuan_lain--mapel_yang_diampu" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_mengajar_di_satuan_lain--jam_tatap_muka_per_minggu">Jam Tatap Muka/Minggu</label>
                                            <input type="text" name="tugas_mengajar_di_satuan_lain--jam_tatap_muka_per_minggu" id="tugas_mengajar_di_satuan_lain--jam_tatap_muka_per_minggu" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="informasi_sertifikasi_pendidik_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#informasi_sertifikasi_pendidik" aria-expanded="false" aria-controls="informasi_sertifikasi_pendidik">
                                    Informasi Sertifikasi Pendidik     
                                </a>
                            </h4>
                        </div>
                        <div id="informasi_sertifikasi_pendidik" class="panel-collapse collapse" role="tabpanel" aria-labelledby="informasi_sertifikasi_pendidik_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_sertifikasi_pendidik--status_kepesertaaan">Status Kepesertaan</label>
                                            <select name="informasi_sertifikasi_pendidik--status_kepesertaaan" id="informasi_sertifikasi_pendidik--status_kepesertaaan" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Belum pernah mengikuti sertifikasi guru</option>
                                                <option value="1">Sudah pernah mengikuti sertifikasi guru</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_sertifikasi_pendidik--status_kelulusan">Status Kelulusan</label>
                                            <select name="informasi_sertifikasi_pendidik--status_kelulusan" id="informasi_sertifikasi_pendidik--status_kelulusan" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Sudah Lulus</option>
                                                <option value="2">Masih Proses</option>
                                                <option value="3">Belum Lulus</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_sertifikasi_pendidik--tahun_lulus">Tahun Lulus</label>
                                            <input type="int" max="4" name="informasi_sertifikasi_pendidik--tahun_lulus" id="informasi_sertifikasi_pendidik--tahun_lulus" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_sertifikasi_pendidik--mapel_yang_disertifikasi">Mapel Yang Di Sertifikasi</label>
                                            <select name="informasi_sertifikasi_pendidik--mapel_yang_disertifikasi" id="informasi_sertifikasi_pendidik--mapel_yang_disertifikasi" class="form-control">
                                                <option value=""></option>
                                                <option value="01">Pendidikan Agama Islam (PAI)</option>
                                                <option value="02">Al Qur'an Hadist</option>
                                                <option value="03">Aqidah Akhlak</option>
                                                <option value="04">Fiqih</option>
                                                <option value="05">Sejarah Kebudayaan Islam (SKI)</option>
                                                <option value="06">Pendidikan Kewarganegaraan (PKn)</option>
                                                <option value="07">Bahasa Indonesia</option>
                                                <option value="08">Bahasa Arab</option>
                                                <option value="09">Bahasa Inggris</option>
                                                <option value="10">Bahasa Asing Lainnya</option>
                                                <option value="11">Matematika</option>
                                                <option value="12">IPA</option>
                                                <option value="13">Fisika</option>
                                                <option value="14">Biologi</option>
                                                <option value="15">Kimia</option>
                                                <option value="16">IPS</option>
                                                <option value="17">Sejarah / Sejarah Nasional dan Umum</option>
                                                <option value="18">Geografi</option>
                                                <option value="19">Ekonomi / Akuntansi</option>
                                                <option value="20">Sosiologi Antropologi</option>
                                                <option value="21">Sosiologi</option>
                                                <option value="22">Antropologi</option>
                                                <option value="23">Tata Negara</option>
                                                <option value="24">Seni Budaya dan Keterampilan / Kerajinan Tangan dan Kesenian</option>
                                                <option value="25">Seni Budaya</option>
                                                <option value="26">Keterampilan</option>
                                                <option value="27">Pendidikan Jasmani, Olahraga dan Kesehatan</option>
                                                <option value="28">Teknologi Informasi dan Komunikasi (TIK)</option>
                                                <option value="29">Muatan Lokal Umum</option>
                                                <option value="30">Muatan Lokal Agama</option>
                                                <option value="31">Bimbingan Konseling / Bimbingan Penyuluhan</option>
                                                <option value="32">Guru Kelas</option>
                                                <option value="33">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_sertifikasi_pendidik--nrg">NRG</label>
                                            <input type="text" name="informasi_sertifikasi_pendidik--nrg" id="informasi_sertifikasi_pendidik--nrg" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_sertifikasi_pendidik--no_sk_nrg">No SK NRG</label>
                                            <input type="text" name="informasi_sertifikasi_pendidik--no_sk_nrg" id="informasi_sertifikasi_pendidik--no_sk_nrg" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_sertifikasi_pendidik--tanggal_sk_nrg">Tanggal SK NRG</label>
                                            <input type="text" name="informasi_sertifikasi_pendidik--tanggal_sk_nrg" id="informasi_sertifikasi_pendidik--tanggal_sk_nrg" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="informasi_tpg_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#informasi_tpg" aria-expanded="false" aria-controls="informasi_tpg">
                                    Informasi Tunjangan Profesi Guru (TPG)
                                </a>
                            </h4>
                        </div>
                        <div id="informasi_tpg" class="panel-collapse collapse" role="tabpanel" aria-labelledby="informasi_tpg_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_tpg--status_penerima_tpg">Status Penerima TPG</label>
                                            <select name="informasi_tpg--status_penerima_tpg" id="informasi_tpg--status_penerima_tpg" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Bukan penerima TPG</option>
                                                <option value="1">Penerima TPG</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_tpg--menerima_tpg_mulai_tahun">Menerima TPG Mulai Tahun</label>
                                            <input type="number" max="4" name="informasi_tpg--menerima_tpg_mulai_tahun" id="informasi_tpg--menerima_tpg_mulai_tahun" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_tpg--besarnya_tpg_per_bulan">Besarnya TPG Per Bulan</label>
                                            <input type="number" name="informasi_tpg--besarnya_tpg_per_bulan" id="informasi_tpg--besarnya_tpg_per_bulan" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="informasi_tfg_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#informasi_tfg" aria-expanded="false" aria-controls="informasi_tfg">
                                    Informasi Tunjangan Fungsional Guru (TFG)
                                </a>
                            </h4>
                        </div>
                        <div id="informasi_tfg" class="panel-collapse collapse" role="tabpanel" aria-labelledby="informasi_tfg_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_tfg--status_penerima_tfg">Status Penerima TFG</label>
                                            <select name="informasi_tfg--status_penerima_tfg" id="informasi_tfg--status_penerima_tfg" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Bukan penerima TFG</option>
                                                <option value="1">Penerima TFG</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_tfg--menerima_tfg_mulai_tahun">Menerima TFG Mulai Tahun</label>
                                            <input type="number" max="4" name="informasi_tfg--menerima_tfg_mulai_tahun" id="informasi_tfg--menerima_tfg_mulai_tahun" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_tfg--besarnya_tfg_per_bulan">Besarnya TFG Per Bulan</label>
                                            <input type="number" name="informasi_tfg--besarnya_tfg_per_bulan" id="informasi_tfg--besarnya_tfg_per_bulan" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="penghargaan_tertinggi_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#penghargaan_tertinggi" aria-expanded="false" aria-controls="penghargaan_tertinggi">
                                    Penghargaan Tertinggi Yang Pernah Diperoleh (Khusus Pendidik)           
                                </a>
                            </h4>
                        </div>
                        <div id="penghargaan_tertinggi" class="panel-collapse collapse" role="tabpanel" aria-labelledby="penghargaan_tertinggi_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="penghargaan_tertinggi--apakah_pernah_memperoleh_penghargaan">Apakah Pernah Memperoleh Penghargaan?</label>
                                            <select name="penghargaan_tertinggi--apakah_pernah_memperoleh_penghargaan" id="penghargaan_tertinggi--apakah_pernah_memperoleh_penghargaan" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Belum Pernah</option>
                                                <option value="1">Pernah</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="penghargaan_tertinggi--bidang_penghargaan">Bidang Penghargaan</label>
                                            <select name="penghargaan_tertinggi--bidang_penghargaan" id="penghargaan_tertinggi--bidang_penghargaan" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Information & Communication Technology (ICT)</option>
                                                <option value="2">Penelitian Tindakan Kelas (PTK)</option>
                                                <option value="3">Model Pembelajaran</option>
                                                <option value="4">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="penghargaan_tertinggi--tingkat_penghargaan">Tingkat Penghargaan</label>
                                            <select name="penghargaan_tertinggi--tingkat_penghargaan" id="penghargaan_tertinggi--tingkat_penghargaan" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Tingkat Kabupaten/Kota</option>
                                                <option value="2">Tingkat Provinsi</option>
                                                <option value="3">Tingkat Nasional</option>
                                                <option value="4">Tingkat Internasional</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="penghargaan_tertinggi--tahun_perolehan_penghargaan">Tahun Perolehan Penghargaan</label>
                                            <input type="number" max="4" name="penghargaan_tertinggi--tahun_perolehan_penghargaan" id="penghargaan_tertinggi--tahun_perolehan_penghargaan" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="pelatihan_kompetensi_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#pelatihan_kompetensi" aria-expanded="false" aria-controls="pelatihan_kompetensi">
                                    Pelatihan Peningkatan Kompetensi Yang Pernah Diikuti oleh Kepala Madrasah (Khusus untuk Kepala Madrasah)                                          
                                </a>
                            </h4>
                        </div>
                        <div id="pelatihan_kompetensi" class="panel-collapse collapse" role="tabpanel" aria-labelledby="pelatihan_kompetensi_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Kompentensi Kepribadian</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_kepribadian--keikutsertaan_pelatihan">Keikutsertaan Pelatihan</label>
                                            <select name="pelatihan_kompetensi_kepribadian--keikutsertaan_pelatihan" id="pelatihan_kompetensi_kepribadian--keikutsertaan_pelatihan" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Belum Pernah</option>
                                                <option value="1">Pernah</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_kepribadian--tahun_mengikuti">Tahun Mengikuti</label>
                                            <input type="number" max="4" name="pelatihan_kompetensi_kepribadian--tahun_mengikuti" id="pelatihan_kompetensi_kepribadian--tahun_mengikuti" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Kompentensi Manajerial</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_manajerial--keikutsertaan_pelatihan">Keikutsertaan Pelatihan</label>
                                            <select name="pelatihan_kompetensi_manajerial--keikutsertaan_pelatihan" id="pelatihan_kompetensi_manajerial--keikutsertaan_pelatihan" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Belum Pernah</option>
                                                <option value="1">Pernah</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_manajerial--tahun_mengikuti">Tahun Mengikuti</label>
                                            <input type="number" max="4" name="pelatihan_kompetensi_manajerial--tahun_mengikuti" id="pelatihan_kompetensi_manajerial--tahun_mengikuti" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Kompentensi Kewirausahaan</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_kewirausahaan--keikutsertaan_pelatihan">Keikutsertaan Pelatihan</label>
                                            <select name="pelatihan_kompetensi_kewirausahaan--keikutsertaan_pelatihan" id="pelatihan_kompetensi_kewirausahaan--keikutsertaan_pelatihan" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Belum Pernah</option>
                                                <option value="1">Pernah</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_kewirausahaan--tahun_mengikuti">Tahun Mengikuti</label>
                                            <input type="number" max="4" name="pelatihan_kompetensi_kewirausahaan--tahun_mengikuti" id="pelatihan_kompetensi_kewirausahaan--tahun_mengikuti" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Kompentensi Supervisi</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_supervisi--keikutsertaan_pelatihan">Keikutsertaan Pelatihan</label>
                                            <select name="pelatihan_kompetensi_supervisi--keikutsertaan_pelatihan" id="pelatihan_kompetensi_supervisi--keikutsertaan_pelatihan" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Belum Pernah</option>
                                                <option value="1">Pernah</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_supervisi--tahun_mengikuti">Tahun Mengikuti</label>
                                            <input type="number" max="4" name="pelatihan_kompetensi_supervisi--tahun_mengikuti" id="pelatihan_kompetensi_supervisi--tahun_mengikuti" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Kompentensi Sosial</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_sosial--keikutsertaan_pelatihan">Keikutsertaan Pelatihan</label>
                                            <select name="pelatihan_kompetensi_sosial--keikutsertaan_pelatihan" id="pelatihan_kompetensi_sosial--keikutsertaan_pelatihan" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Belum Pernah</option>
                                                <option value="1">Pernah</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_sosial--tahun_mengikuti">Tahun Mengikuti</label>
                                            <input type="number" max="4" name="pelatihan_kompetensi_sosial--tahun_mengikuti" id="pelatihan_kompetensi_sosial--tahun_mengikuti" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="alamat_tempat_tinggal_personal_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#alamat_tempat_tinggal_personal" aria-expanded="false" aria-controls="alamat_tempat_tinggal_personal">
                                    Alamat Rumah/Tempat Tinggal Personal  
                                </a>
                            </h4>
                        </div>
                        <div id="alamat_tempat_tinggal_personal" class="panel-collapse collapse" role="tabpanel" aria-labelledby="alamat_tempat_tinggal_personal_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="alamat_tempat_tinggal_personal--alamat">Alamat</label>
                                            <textarea rows="3" name="alamat_tempat_tinggal_personal--alamat" id="alamat_tempat_tinggal_personal--alamat" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="alamat_tempat_tinggal_personal--provinsi">Provinsi</label>
                                            <input type="text" name="alamat_tempat_tinggal_personal--provinsi" id="alamat_tempat_tinggal_personal--provinsi" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="alamat_tempat_tinggal_personal--kab_kota">Kab/Kota</label>
                                            <input type="text" name="alamat_tempat_tinggal_personal--kab_kota" id="alamat_tempat_tinggal_personal--kab_kota" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="alamat_tempat_tinggal_personal--kecamatan">Kecamatan</label>
                                            <input type="text" name="alamat_tempat_tinggal_personal--kecamatan" id="alamat_tempat_tinggal_personal--kecamatan" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="alamat_tempat_tinggal_personal--desa_kelurahan">Desa/Kelurahan</label>
                                            <input type="text" name="alamat_tempat_tinggal_personal--desa_kelurahan" id="alamat_tempat_tinggal_personal--desa_kelurahan" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="alamat_tempat_tinggal_personal--kode_pos">Kode Pos</label>
                                            <input type="text" name="alamat_tempat_tinggal_personal--kode_pos" id="alamat_tempat_tinggal_personal--kode_pos" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="rumah_dan_transportasi_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#rumah_dan_transportasi" aria-expanded="false" aria-controls="rumah_dan_transportasi">
                                    Jarak Rumah dan Transportasi
                                </a>
                            </h4>
                        </div>
                        <div id="rumah_dan_transportasi" class="panel-collapse collapse" role="tabpanel" aria-labelledby="rumah_dan_transportasi_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jarak_rumah_ke_madrasah_tempat_tugas">Jarak Rumah ke Madrasah Tempat Tugas</label>
                                            <select name="jarak_rumah_ke_madrasah_tempat_tugas" id="jarak_rumah_ke_madrasah_tempat_tugas" class="form-control">
                                                <option value=""></option>
                                                <option value="1">< 5 Km</option>
                                                <option value="2">5 - 10 Km</option>
                                                <option value="3">11 - 20 Km</option>
                                                <option value="4">21 - 30 Km</option>
                                                <option value="5">> 30 Km</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="transportasi_dari_rumah_ke_madrasah_tempat_tugas">Transportasi Dari Rumah ke Madrasah Tempat Tugas</label>
                                            <select name="transportasi_dari_rumah_ke_madrasah_tempat_tugas" id="transportasi_dari_rumah_ke_madrasah_tempat_tugas" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Jalan Kaki</option>
                                                <option value="2">Sepeda</option>
                                                <option value="3">Sepeda Motor</option>
                                                <option value="4">Mobil Pribadi</option>
                                                <option value="5">Kendaraan Antar Jemput Sekolah</option>
                                                <option value="6">Angkutan Umum</option>
                                                <option value="7">Perahu/Sampan</option>
                                                <option value="8">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status_tempat_tinggal">Status Tempat Tinggal</label>
                                            <select name="status_tempat_tinggal" id="status_tempat_tinggal" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Rumah Milik Sendiri</option>
                                                <option value="2">Rumah Orangtua</option>
                                                <option value="3">Rumah Saudara/Kerabat</option>
                                                <option value="4">Rumah Dinas</option>
                                                <option value="5">Sewa/Kontrak</option>
                                                <option value="6">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="riwayat_pendidikan_ptk_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#riwayat_pendidikan_ptk" aria-expanded="false" aria-controls="riwayat_pendidikan_ptk">
                                    Riwayat Pendidikan PTK (Jenjang S1/D4, S2 dan S3)
                                </a>
                            </h4>
                        </div>
                        <div id="riwayat_pendidikan_ptk" class="panel-collapse collapse" role="tabpanel" aria-labelledby="riwayat_pendidikan_ptk_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Jenjang S1/D4</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s1_d4--program_studi">Program Studi</label>
                                            <select name="riwayat_pendidikan_ptk--jenjang_s1_d4--program_studi" id="riwayat_pendidikan_ptk--jenjang_s1_d4--program_studi" class="form-control">
                                                <option value=""></option>
                                                <option value="01">Rumpun Pendidikan Agama Islam (PAI)</option>
                                                <option value="02">Bahasa Indonesia</option>
                                                <option value="03">Bahasa Inggris</option>
                                                <option value="04">Bahasa Arab</option>
                                                <option value="05">Bahasa Asing Lainnya (Bahasa Jepang, Mandarin, Korea, Jerman, Belanda, Perancis, Rusia, dll)</option>
                                                <option value="06">Matematika/Statistika</option>
                                                <option value="07">IPA (Fisika, Biologi, Kimia, Metereologi, Geofisika)</option>
                                                <option value="08">Ilmu Sosial (Ekonomi, Akuntansi, Sosiologi, Antropologi, Tata Negara, Manajemen, Administrasi)</option>
                                                <option value="09">Ilmu Komputer/Informatika/Teknologi Informasi</option>
                                                <option value="10">Pendidikan Jasmani, Olahraga dan Kesehatan</option>
                                                <option value="11">Manajemen Pendidikan / Ilmu Pendidikan</option>
                                                <option value="12">Hukum/Syari'ah/Hukum Islam</option>
                                                <option value="13">PGSD/PGMI</option>
                                                <option value="14">PGTK</option>
                                                <option value="15">Psikologi</option>
                                                <option value="16">Kesenian</option>
                                                <option value="17">Pendidikan Kewarganegaraan</option>
                                                <option value="18">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s1_d4--gelar_akademik">Gelar Akademik</label>
                                            <input type="text" name="riwayat_pendidikan_ptk--jenjang_s1_d4--gelar_akademik" id="riwayat_pendidikan_ptk--jenjang_s1_d4--gelar_akademik" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s1_d4--tahun_lulus">Tahun Lulus</label>
                                            <input type="number" name="riwayat_pendidikan_ptk--jenjang_s1_d4--tahun_lulus" id="riwayat_pendidikan_ptk--jenjang_s1_d4--tahun_lulus" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Jenjang S2</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s2--program_studi">Program Studi</label>
                                            <select name="riwayat_pendidikan_ptk--jenjang_s2--program_studi" id="riwayat_pendidikan_ptk--jenjang_s2--program_studi" class="form-control">
                                                <option value=""></option>
                                                <option value="01">Rumpun Pendidikan Agama Islam (PAI)</option>
                                                <option value="02">Bahasa Indonesia</option>
                                                <option value="03">Bahasa Inggris</option>
                                                <option value="04">Bahasa Arab</option>
                                                <option value="05">Bahasa Asing Lainnya (Bahasa Jepang, Mandarin, Korea, Jerman, Belanda, Perancis, Rusia, dll)</option>
                                                <option value="06">Matematika/Statistika</option>
                                                <option value="07">IPA (Fisika, Biologi, Kimia, Metereologi, Geofisika)</option>
                                                <option value="08">Ilmu Sosial (Ekonomi, Akuntansi, Sosiologi, Antropologi, Tata Negara, Manajemen, Administrasi)</option>
                                                <option value="09">Ilmu Komputer/Informatika/Teknologi Informasi</option>
                                                <option value="10">Pendidikan Jasmani, Olahraga dan Kesehatan</option>
                                                <option value="11">Manajemen Pendidikan / Ilmu Pendidikan</option>
                                                <option value="12">Hukum/Syari'ah/Hukum Islam</option>
                                                <option value="13">PGSD/PGMI</option>
                                                <option value="14">PGTK</option>
                                                <option value="15">Psikologi</option>
                                                <option value="16">Kesenian</option>
                                                <option value="17">Pendidikan Kewarganegaraan</option>
                                                <option value="18">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s2--gelar_akademik">Gelar Akademik</label>
                                            <input type="text" name="riwayat_pendidikan_ptk--jenjang_s2--gelar_akademik" id="riwayat_pendidikan_ptk--jenjang_s2--gelar_akademik" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s2--tahun_lulus">Tahun Lulus</label>
                                            <input type="number" name="riwayat_pendidikan_ptk--jenjang_s2--tahun_lulus" id="riwayat_pendidikan_ptk--jenjang_s2--tahun_lulus" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Jenjang S3</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s3--program_studi">Program Studi</label>
                                            <select name="riwayat_pendidikan_ptk--jenjang_s3--program_studi" id="riwayat_pendidikan_ptk--jenjang_s3--program_studi" class="form-control">
                                                <option value=""></option>
                                                <option value="01">Rumpun Pendidikan Agama Islam (PAI)</option>
                                                <option value="02">Bahasa Indonesia</option>
                                                <option value="03">Bahasa Inggris</option>
                                                <option value="04">Bahasa Arab</option>
                                                <option value="05">Bahasa Asing Lainnya (Bahasa Jepang, Mandarin, Korea, Jerman, Belanda, Perancis, Rusia, dll)</option>
                                                <option value="06">Matematika/Statistika</option>
                                                <option value="07">IPA (Fisika, Biologi, Kimia, Metereologi, Geofisika)</option>
                                                <option value="08">Ilmu Sosial (Ekonomi, Akuntansi, Sosiologi, Antropologi, Tata Negara, Manajemen, Administrasi)</option>
                                                <option value="09">Ilmu Komputer/Informatika/Teknologi Informasi</option>
                                                <option value="10">Pendidikan Jasmani, Olahraga dan Kesehatan</option>
                                                <option value="11">Manajemen Pendidikan / Ilmu Pendidikan</option>
                                                <option value="12">Hukum/Syari'ah/Hukum Islam</option>
                                                <option value="13">PGSD/PGMI</option>
                                                <option value="14">PGTK</option>
                                                <option value="15">Psikologi</option>
                                                <option value="16">Kesenian</option>
                                                <option value="17">Pendidikan Kewarganegaraan</option>
                                                <option value="18">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s3--gelar_akademik">Gelar Akademik</label>
                                            <input type="text" name="riwayat_pendidikan_ptk--jenjang_s3--gelar_akademik" id="riwayat_pendidikan_ptk--jenjang_s3--gelar_akademik" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s3--tahun_lulus">Tahun Lulus</label>
                                            <input type="number" name="riwayat_pendidikan_ptk--jenjang_s3--tahun_lulus" id="riwayat_pendidikan_ptk--jenjang_s3--tahun_lulus" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                
                            </div>

                            
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="tambahan_data_guru_tetap_non_pns_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#tambahan_data_guru_tetap_non_pns" aria-expanded="false" aria-controls="tambahan_data_guru_tetap_non_pns">
                                    Tambahan Data Guru Tetap Non-PNS 
                                    <br>(SK Pengangkatan Guru Tetap Non-PNS)
                                </a>
                            </h4>
                        </div>
                        <div id="tambahan_data_guru_tetap_non_pns" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tambahan_data_guru_tetap_non_pns_heading">
                            <div class="panel-body">
                                

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tambahan_data_guru_tetap_non_pns--nomor_sk">Nomor SK</label>
                                            <input type="text" name="tambahan_data_guru_tetap_non_pns--nomor_sk" id="tambahan_data_guru_tetap_non_pns--nomor_sk" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tambahan_data_guru_tetap_non_pns--tanggal_sk">Tanggal SK</label>
                                            <input type="date" name="tambahan_data_guru_tetap_non_pns--tanggal_sk" id="tambahan_data_guru_tetap_non_pns--tanggal_sk" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="tambahan_data_inspassing_guru_non_pns_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#tambahan_data_inspassing_guru_non_pns" aria-expanded="false" aria-controls="tambahan_data_inspassing_guru_non_pns">
                                    Tambahan Data Inpassing Guru Non-PNS    
                                </a>
                            </h4>
                        </div>
                        <div id="tambahan_data_inspassing_guru_non_pns" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tambahan_data_inspassing_guru_non_pns_heading">
                            <div class="panel-body">
                                

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tambahan_data_inpassing_guru_non_pns--nomor_sk_inpassing">Nomor SK Inpassing</label>
                                            <input type="text" name="tambahan_data_inpassing_guru_non_pns--nomor_sk_inpassing" id="tambahan_data_inpassing_guru_non_pns--nomor_sk_inpassing" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tambahan_data_inpassing_guru_non_pns--tanggal_sk_inpassing">Tanggal SK Inpassing</label>
                                            <input type="date" name="tambahan_data_inpassing_guru_non_pns--tanggal_sk_inpassing" id="tambahan_data_inpassing_guru_non_pns--tanggal_sk_inpassing" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="sertifikasi_pendidik_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#sertifikasi_pendidik" aria-expanded="false" aria-controls="sertifikasi_pendidik">
                                    Informasi Tambahan terkait Sertifikasi Pendidik                     
                                </a>
                            </h4>
                        </div>
                        <div id="sertifikasi_pendidik" class="panel-collapse collapse" role="tabpanel" aria-labelledby="sertifikasi_pendidik_heading">
                            <div class="panel-body">
                                

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sertifikasi_pendidik--nomor_peserta_sertifikasi">Nomor Peserta Sertifikasi</label>
                                            <input type="text" name="sertifikasi_pendidik--nomor_peserta_sertifikasi" id="sertifikasi_pendidik--nomor_peserta_sertifikasi" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tambahan_data_inpassing_guru_non_pns--jenis_jalur_sertifikasi">Jenis/Jalur Sertifikasi</label>
                                            <select name="tambahan_data_inpassing_guru_non_pns--jenis_jalur_sertifikasi" id="tambahan_data_inpassing_guru_non_pns--jenis_jalur_sertifikasi" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Portofolio</option>
                                                <option value="2">PLPG</option>
                                                <option value="3">PSPL</option>
                                                <option value="4">PPG Dalam Jabatan (PPGJ)<option>
                                                <option value="5">PPG Pra Jabatan</option>
                                                <option value="6">Lainnya</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sertifikasi_pendidik--tanggal_kelulusan_sertifikasi">Tanggal Kelulusan Sertifikasi</label>
                                            <input type="date" name="sertifikasi_pendidik--tanggal_kelulusan_sertifikasi" id="sertifikasi_pendidik--tanggal_kelulusan_sertifikasi" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sertifikasi_pendidik--nomor_sertifikat_pendidik">Nomor Sertifikat Pendidik</label>
                                            <input type="date" name="sertifikasi_pendidik--nomor_sertifikat_pendidik" id="sertifikasi_pendidik--nomor_sertifikat_pendidik" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sertifikasi_pendidik--tanggal_penerbitan_sertifikat">Tanggal Penerbitan Sertifikat</label>
                                            <input type="date" name="sertifikasi_pendidik--tanggal_penerbitan_sertifikat" id="sertifikasi_pendidik--tanggal_penerbitan_sertifikat" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label for="sertifikasi_pendidik--lptk_penyelenggara_sertifikasi">Tanggal Penerbitan Sertifikat</label>
                                            <input type="hidden" name="sertifikasi_pendidik--lptk_penyelenggara_sertifikasi--nama" id="sertifikasi_pendidik--lptk_penyelenggara_sertifikasi--nama" class="form-control">
                                            <select name="sertifikasi_pendidik--lptk_penyelenggara_sertifikasi--kode" id="sertifikasi_pendidik--lptk_penyelenggara_sertifikasi--kode" class="form-control">
                                                <option value=""></option>
                                                <option value="001">001 - UIN Ar-Raniry Banda Aceh </option>
                                                <option value="002">002 - UIN Sumatera Utara Medan </option>
                                                <option value="003">003 - UIN Sultan Syarif Kasim Pekanbaru </option>
                                                <option value="004">004 - UIN Raden Fatah Palembang </option>
                                                <option value="005">005 - UIN Syarif Hidayatullah Jakarta </option>
                                                <option value="006">006 - UIN Sunan Gunung Djati Bandung </option>
                                                <option value="007">007 - UIN Walisongo Semarang </option>
                                                <option value="008">008 - UIN Sunan Kalijaga Yogyakarta </option>
                                                <option value="009">009 - UIN Maulana Malik Ibrahim Malang </option>
                                                <option value="010">010 - UIN Sunan Ampel Surabaya </option>
                                                <option value="011">011 - UIN Alauddin Makassar </option>
                                                <option value="012">012 - IAIN Zawiyah Cot Kala Langsa </option>
                                                <option value="013">013 - IAIN Padangsidimpuan </option>
                                                <option value="014">014 - IAIN Imam Bonjol Padang </option>
                                                <option value="015">015 - IAIN Sjech M. Djamil Djambek Bukittinggi </option>
                                                <option value="016">016 - IAIN Sulthan Thaha Saifuddin Jambi </option>
                                                <option value="017">017 - IAIN Bengkulu </option>
                                                <option value="018">018 - IAIN Raden Intan Lampung </option>
                                                <option value="019">019 - IAIN Syekh Nurjati Cirebon </option>
                                                <option value="020">020 - IAIN Surakarta </option>
                                                <option value="021">021 - IAIN Purwokerto </option>
                                                <option value="022">022 - IAIN Salatiga </option>
                                                <option value="023">023 - IAIN Tulungagung </option>
                                                <option value="024">024 - IAIN Jember </option>
                                                <option value="025">025 - IAIN Sultan Maulana Hasanuddin Banten </option>
                                                <option value="026">026 - IAIN Mataram </option>
                                                <option value="027">027 - IAIN Pontianak </option>
                                                <option value="028">028 - IAIN Palangkaraya </option>
                                                <option value="029">029 - IAIN Antasari Banjarmasin </option>
                                                <option value="030">030 - IAIN Sultan Sulaiman Samarinda </option>
                                                <option value="031">031 - IAIN Manado </option>
                                                <option value="032">032 - IAIN Palu </option>
                                                <option value="033">033 - IAIN Palopo </option>
                                                <option value="034">034 - IAIN Sultan Qaimuddin Kendari </option>
                                                <option value="035">035 - IAIN Sultan Amai Gorontalo </option>
                                                <option value="036">036 - IAIN Ambon </option>
                                                <option value="037">037 - IAIN Ternate </option>
                                                <option value="038">038 - STAIN Malikussaleh Lhokseumawe </option>
                                                <option value="039">039 - STAIN Gajah Putih Takengon </option>
                                                <option value="040">040 - STAIN Meulaboh </option>
                                                <option value="041">041 - STAIN Batusangkar </option>
                                                <option value="042">042 - STAIN Bengkalis </option>
                                                <option value="043">043 - STAIN Kerinci </option>
                                                <option value="044">044 - STAIN Curup </option>
                                                <option value="045">045 - STAIN Syaik Abdurrahman Siddik Bangka Belitung </option>
                                                <option value="046">046 - STAIN Jurai Siwo Metro </option>
                                                <option value="047">047 - STAIN Kudus </option>
                                                <option value="048">048 - STAIN Pekalongan </option>
                                                <option value="049">049 - STAIN Kediri </option>
                                                <option value="050">050 - STAIN Pamekasan </option>
                                                <option value="051">051 - STAIN Ponorogo </option>
                                                <option value="052">052 - STAIN Watampone </option>
                                                <option value="053">053 - STAIN Parepare </option>
                                                <option value="054">054 - STAIN Al Fatah Jayapura </option>
                                                <option value="055">055 - STAIN Sorong </option>
                                                <option value="056">056 - Universitas Malikussaleh </option>
                                                <option value="057">057 - Universitas Syiah Kuala </option>
                                                <option value="058">058 - Universitas Negeri Medan </option>
                                                <option value="059">059 - Universitas Sumatera Utara </option>
                                                <option value="060">060 - Universitas Andalas </option>
                                                <option value="061">061 - Universitas Negeri Padang </option>
                                                <option value="062">062 - Universitas Riau </option>
                                                <option value="063">063 - Universitas Maritim Raja Ali Haji </option>
                                                <option value="064">064 - Universitas Jambi </option>
                                                <option value="065">065 - Universitas Bengkulu </option>
                                                <option value="066">066 - Universitas Sriwijaya </option>
                                                <option value="067">067 - Universitas Bangka Belitung </option>
                                                <option value="068">068 - Universitas Lampung </option>
                                                <option value="069">069 - Universitas Indonesia </option>
                                                <option value="070">070 - Universitas Negeri Jakarta </option>
                                                <option value="071">071 - Institut Pertanian Bogor </option>
                                                <option value="072">072 - Institut Teknologi Bandung </option>
                                                <option value="073">073 - Universitas Padjadjaran </option>
                                                <option value="074">074 - Universitas Pendidikan Indonesia </option>
                                                <option value="075">075 - Universitas Diponegoro </option>
                                                <option value="076">076 - Universitas Jenderal Soedirman </option>
                                                <option value="077">077 - Universitas Negeri Semarang </option>
                                                <option value="078">078 - Universitas Sebelas Maret </option>
                                                <option value="079">079 - Universitas Gadjah Mada </option>
                                                <option value="080">080 - Universitas Negeri Yogyakarta </option>
                                                <option value="081">081 - Institut Teknologi Sepuluh Nopember </option>
                                                <option value="082">082 - Universitas Airlangga </option>
                                                <option value="083">083 - Universitas Brawijaya </option>
                                                <option value="084">084 - Universitas Jember </option>
                                                <option value="085">085 - Universitas Negeri Malang </option>
                                                <option value="086">086 - Universitas Negeri Surabaya </option>
                                                <option value="087">087 - Universitas Trunojoyo </option>
                                                <option value="088">088 - Universitas Sultan Ageng Tirtayasa </option>
                                                <option value="089">089 - Universitas Pendidikan Ganesha </option>
                                                <option value="090">090 - Universitas Udayana </option>
                                                <option value="091">091 - Universitas Mataram </option>
                                                <option value="092">092 - Universitas Nusa Cendana </option>
                                                <option value="093">093 - Universitas Tanjungpura </option>
                                                <option value="094">094 - Universitas Palangkaraya </option>
                                                <option value="095">095 - Universitas Lambung Mangkurat </option>
                                                <option value="096">096 - Universitas Mulawarman </option>
                                                <option value="097">097 - Universitas Borneo Tarakan </option>
                                                <option value="098">098 - Universitas Negeri Manado </option>
                                                <option value="099">099 - Universitas Sam Ratulangi </option>
                                                <option value="100">100 - Universitas Tadulako </option>
                                                <option value="101">101 - Universitas Hasanuddin </option>
                                                <option value="102">102 - Universitas Negeri Makassar </option>
                                                <option value="103">103 - Universitas Haluoleo </option>
                                                <option value="104">104 - Universitas Negeri Gorontalo </option>
                                                <option value="105">105 - Universitas Pattimura </option>
                                                <option value="106">106 - Universitas Khairun </option>
                                                <option value="107">107 - Universitas Cenderawasih </option>
                                                <option value="108">108 - Universitas Musamus Merauke </option>
                                                <option value="109">109 - Universitas Papua </option>
                                                <option value="110">110 - Sekolah Tinggi Akuntansi Negara (STAN) Jakarta </option>
                                                <option value="111">111 - Institut Pemerintahan Dalam Negeri (IPDN) Jatinangor </option>
                                                <option value="112">112 - Sekolah Tinggi Perikanan (STP) Jakarta </option>
                                                <option value="113">113 - Sekolah Tinggi Penerbangan Indonesia (STPI) Curug </option>
                                                <option value="114">114 - Sekolah Tinggi Ilmu Pelayaran Jakarta </option>
                                                <option value="115">115 - Sekolah Tinggi Ilmu Statistik (STIS) Jakarta </option>
                                                <option value="116">116 - STIA Lembaga Administrasi Negara (STIA-LAN) Bandung </option>
                                                <option value="117">117 - Sekolah Tinggi Sandi Negara (STSN) Bogor </option>
                                                <option value="118">118 - Akademi Kepolisian (Akpol) Semarang </option>
                                                <option value="119">119 - Akademi Militer (TNI Angkatan Darat) Magelang </option>
                                                <option value="120">120 - Lainnya </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modal-edit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <form id="form-edit" class="modal-content">

            <input type="hidden" name="id" id="id">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Data Guru</h4>
            </div>
            <div class="modal-body">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="indentitas_personal_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#indentitas_personal" aria-expanded="false" aria-controls="indentitas_personal">
                                    Identitas Personal/PTK
                                </a>
                            </h4>
                        </div>
                        <div id="indentitas_personal" class="panel-collapse collapse" role="tabpanel" aria-labelledby="indentitas_personal_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nip_nignp">NIP / NIGNP</label>
                                            <input type="text" class="form-control" id="nip_nignp" name="nip_nignp" placeholder="NIP / NIGNP">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nuptk_pegid">NUPTK / PegId</label>
                                            <input type="text" class="form-control" id="nuptk_pegid" name="nuptk_pegid" placeholder="NUPTK / PegId" >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nik_noktp">NIK/No. KTP</label>
                                            <input type="text" class="form-control" id="nik_noktp" name="nik_noktp" placeholder="NIK/No. KTP" >
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama">Nama Lengkap Personal</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap Personal">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kode">Kode</label>
                                            <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                                <option value=""></option>
                                                <option value="l">Laki-laki</option>
                                                <option value="p">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama_ibu_kandung">Nama Ibu Kandung</label>
                                            <input type="text" class="form-control" id="nama_ibu_kandung" name="nama_ibu_kandung" placeholder="Nama Ibu Kandung">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nomor_hp">No HP</label>
                                            <input type="text" name="nomor_hp" id="nomor_hp" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="agama_ptk">Agama PTK</label>
                                            <select name="agama_ptk" id="agama_ptk" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Islam</option>
                                                <option value="2">Kristen</option>
                                                <option value="3">Katholik</option>
                                                <option value="4">Hindu</option>
                                                <option value="5">Budha</option>
                                                <option value="6">Khonghucu</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="pendidikan_terakhir_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#pendidikan_terakhir" aria-expanded="false" aria-controls="pendidikan_terakhir">
                                    Pendidikan Terakhir
                                </a>
                            </h4>
                        </div>
                        <div id="pendidikan_terakhir" class="panel-collapse collapse" role="tabpanel" aria-labelledby="pendidikan_terakhir_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pendidikan_terakhir--jenjang">Jenjang</label>
                                            <select name="pendidikan_terakhir--jenjang" id="pendidikan_terakhir--jenjang" class="form-control">
                                                <option value="0">Tidak berpendidikan formal</option>
                                                <option value="1"><= SLTP</option>
                                                <option value="2">SLTA</option>
                                                <option value="3">D1</option>
                                                <option value="4">D2</option>
                                                <option value="5">D3</option>
                                                <option value="6">D4</option>
                                                <option value="7">S1</option>
                                                <option value="8">S2</option>
                                                <option value="9">S3</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pendidikan_terakhir--kelompok_program_studi">Kelompok Program Studi</label>
                                            <select name="pendidikan_terakhir--kelompok_program_studi" id="pendidikan_terakhir--kelompok_program_studi" class="form-control">
                                                <option value=""></option>
                                                <option value="01">Rumpun Pendidikan Agama Islam (PAI)</option>
                                                <option value="02">Bahasa Indonesia</option>
                                                <option value="03">Bahasa Inggris</option>
                                                <option value="04">Bahasa Arab</option>
                                                <option value="05">Bahasa Asing Lainnya (Bahasa Jepang, Mandarin, Korea, Jerman, Belanda, Perancis, Rusia, dll)</option>
                                                <option value="06">Matematika/Statistika</option>
                                                <option value="07">IPA (Fisika, Biologi, Kimia, Metereologi, Geofisika)</option>
                                                <option value="08">Ilmu Sosial (Ekonomi, Akuntansi, Sosiologi, Antropologi, Tata Negara, Manajemen, Administrasi)</option>
                                                <option value="09">Ilmu Komputer/Informatika/Teknologi Informasi</option>
                                                <option value="10">Pendidikan Jasmani, Olahraga dan Kesehatan</option>
                                                <option value="11">Manajemen Pendidikan / Ilmu Pendidikan</option>
                                                <option value="12">Hukum/Syari'ah/Hukum Islam</option>
                                                <option value="13">PGSD/PGMI</option>
                                                <option value="14">PGTK</option>
                                                <option value="15">Psikologi</option>
                                                <option value="16">Kesenian</option>
                                                <option value="17">Pendidikan Kewarganegaraan</option>
                                                <option value="18">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="status_kepegawaian_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#status_kepegawaian" aria-expanded="false" aria-controls="status_kepegawaian">
                                    Status Kepegawaian Personal/PTK
                                </a>
                            </h4>
                        </div>
                        <div id="status_kepegawaian" class="panel-collapse collapse" role="tabpanel" aria-labelledby="status_kepegawaian_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian">Status Kepegawaian</label>
                                            <select name="status_kepegawaian" id="status_kepegawaian" class="form-control">
                                                <option value=""></option>
                                                <option value="1">PNS</option>
                                                <option value="2">Non-PNS</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--status_inpassing">Status Inpassing</label>
                                            <select name="status_kepegawaian--status_inpassing" id="status_kepegawaian--status_inpassing" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Belum Inpassing</option>
                                                <option value="1">Sudah Inpassing</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--tmt_inpassing">TMT Inpassing</label>
                                            <input type="date" class="form-control" name="status_kepegawaian--tmt_inpassing" id="status_kepegawaian--tmt_inpassing">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--golongan">Golongan</label>
                                            <select name="status_kepegawaian--golongan" id="status_kepegawaian--golongan" class="form-control">
                                                <option value=""></option>
                                                <option value="01">Golongan I</option>
                                                <option value="02">II/a</option>
                                                <option value="03">II/b</option>
                                                <option value="04">II/c</option>
                                                <option value="05">II/d</option>
                                                <option value="06">III/a</option>
                                                <option value="07">III/b</option>
                                                <option value="08">III/c</option>
                                                <option value="09">III/d</option>
                                                <option value="10">IV/a</option>
                                                <option value="11">IV/b</option>
                                                <option value="12">IV/c</option>
                                                <option value="13">IV/d</option>
                                                <option value="14">IV/e</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--tmt_sk_cpns">TMT SK CPNS</label>
                                            <input type="date" name="status_kepegawaian--tmt_sk_cpns" id="status_kepegawaian--tmt_sk_cpns" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--tmt_sk_awal">TMT SK Awal</label>
                                            <input type="date" name="status_kepegawaian--tmt_sk_awal" id="status_kepegawaian--tmt_sk_awal" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--tmt_sk_akhir">TMT SK Akhir</label>
                                            <input type="date" name="status_kepegawaian--tmt_sk_akhir" id="status_kepegawaian--tmt_sk_akhir" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--instansi_yang_mengangkat">Instansi Yang Mengangkat</label>
                                            <select name="status_kepegawaian--instansi_yang_mengangkat" id="status_kepegawaian--instansi_yang_mengangkat" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Kementerian Agama</option>
                                                <option value="2">Pemerintah Daerah</option>
                                                <option value="3">Kementerian Lainnya</option>
                                                <option value="4">Yayasan Penyelenggara</option>
                                                <option value="5">Satuan Pendidikan (RA/Madrasah)</option>
                                                <option value="6">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--status_penugasan">Status Penugasan</label>
                                            <select name="status_kepegawaian--status_penugasan" id="status_kepegawaian--status_penugasan" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Tetap</option>
                                                <option value="2">Tidak Tetap</option>
                                                <option value="3">Diperbantukan</option>
                                                <option value="4">Dipekerjakan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--gaji_pokok_perbulan">Gaji Pokok Perbulan</label>
                                            <input type="number" name="status_kepegawaian--gaji_pokok_perbulan" id="status_kepegawaian--gaji_pokok_perbulan" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--status_tempat_tugas">Status Tempat Tugas</label>
                                            <select name="status_kepegawaian--status_tempat_tugas" id="status_kepegawaian--status_tempat_tugas" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Satminkal</option>
                                                <option value="2">Bukan Satminkal</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--status_kepegawaian--jenis_satminkal">Jenis Satminkal</label>
                                            <select name="status_kepegawaian--status_kepegawaian--jenis_satminkal" id="status_kepegawaian--status_kepegawaian--jenis_satminkal" class="form-control">
                                                <option value=""></option>
                                                <option value="1">MI</option>
                                                <option value="2">MTs</option>
                                                <option value="3">MA</option>
                                                <option value="4">SD</option>
                                                <option value="5">SMP</option>
                                                <option value="6">SMA</option>
                                                <option value="7">SMK</option>
                                                <option value="8">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--npsn_satminkal">NPSN Satminkal</label>
                                            <input type="text" name="status_kepegawaian--npsn_satminkal" id="status_kepegawaian--npsn_satminkal" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--tugas_utama_di_madrasah_ini">Tugas Utama Di Madrasah Ini</label>
                                            <select name="status_kepegawaian--tugas_utama_di_madrasah_ini" id="status_kepegawaian--tugas_utama_di_madrasah_ini" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Pendidik</option>
                                                <option value="2">Tenaga Kependidikan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_kepegawaian--status_kepegawaian--status_keaktifan_personal">Status Keaktifan Personal</label>
                                            <select name="status_kepegawaian--status_kepegawaian--status_keaktifan_personal" id="status_kepegawaian--status_kepegawaian--status_keaktifan_personal" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Aktif Bertugas</option>
                                                <option value="2">Cuti</option>
                                                <option value="3">Tugas di Instansi Lain</option>
                                                <option value="4">Tugas Belajar</option>
                                                <option value="5">Izin Belajar</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="tugas_utama_sebagai_pendidik_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#tugas_utama_sebagai_pendidik" aria-expanded="false" aria-controls="tugas_utama_sebagai_pendidik">
                                    Tugas Utama Sebagai Pendidik
                                </a>
                            </h4>
                        </div>
                        <div id="tugas_utama_sebagai_pendidik" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tugas_utama_sebagai_pendidik_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_utama_sebagai_pendidik--mapel_utama_yang_diampu">Mapel Utama Yang Di Ampu</label>
                                            <select name="tugas_utama_sebagai_pendidik--mapel_utama_yang_diampu" id="tugas_utama_sebagai_pendidik--mapel_utama_yang_diampu" class="form-control">
                                                <option value=""></option>
                                                <option value="01"> Pendidikan Agama Islam (PAI)</option>
                                                <option value="02">Al Qur'an Hadist</option>
                                                <option value="03">Aqidah Akhlak</option>
                                                <option value="04">Fiqih</option>
                                                <option value="05">Sejarah Kebudayaan Islam (SKI)</option>
                                                <option value="06">Pendidikan Kewarganegaraan (PKn)</option>
                                                <option value="07">Bahasa Indonesia</option>
                                                <option value="08">Bahasa Arab</option>
                                                <option value="09">Bahasa Inggris</option>
                                                <option value="10">Bahasa Asing Lainnya</option>
                                                <option value="11">Matematika</option>
                                                <option value="12">IPA</option>
                                                <option value="13">Fisika</option>
                                                <option value="14">Biologi</option>
                                                <option value="15">Kimia</option>
                                                <option value="16">IPS</option>
                                                <option value="17">Sejarah / Sejarah Nasional dan Umum</option>
                                                <option value="18">Geografi</option>
                                                <option value="19">Ekonomi / Akuntansi</option>
                                                <option value="20">Sosiologi Antropologi</option>
                                                <option value="21">Sosiologi</option>
                                                <option value="22">Antropologi</option>
                                                <option value="23">Tata Negara</option>
                                                <option value="24">Seni Budaya dan Keterampilan / Kerajinan Tangan dan Kesenian</option>
                                                <option value="25">Seni Budaya</option>
                                                <option value="26">Keterampilan</option>
                                                <option value="27">Pendidikan Jasmani, Olahraga dan Kesehatan</option>
                                                <option value="28">Teknologi Informasi dan Komunikasi (TIK)</option>
                                                <option value="29">Muatan Lokal Umum</option>
                                                <option value="30">Muatan Lokal Agama</option>
                                                <option value="31">Bimbingan Konseling / Bimbingan Penyuluhan</option>
                                                <option value="32">Guru Kelas</option>
                                                <option value="33">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_utama_sebagai_pendidik--total_jam_tatap_muka_per_minggu">Total Jam Tatap Muka/Minggu</label>
                                            <input type="number" name="tugas_utama_sebagai_pendidik--total_jam_tatap_muka_per_minggu" id="tugas_utama_sebagai_pendidik--total_jam_tatap_muka_per_minggu" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="tugas_utama_sebagai_tenaga_kependidikan_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#tugas_utama_sebagai_tenaga_kependidikan" aria-expanded="false" aria-controls="tugas_utama_sebagai_tenaga_kependidikan">
                                    Tugas Utama Sebagai Kependidikan
                                </a>
                            </h4>
                        </div>
                        <div id="tugas_utama_sebagai_tenaga_kependidikan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tugas_utama_sebagai_tenaga_kependidikan_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_utama_sebagai_tenaga_kependidikan">Tugas Utama Sebagai Tenaga Kependidikan</label>
                                            <select name="tugas_utama_sebagai_tenaga_kependidikan" id="tugas_utama_sebagai_tenaga_kependidikan" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Tenaga Administrasi</option>
                                                <option value="2">Tenaga Perpustakaan</option>
                                                <option value="3">Tenaga Laboratorium</option>
                                                <option value="4">Tenaga Kebersihan</option>
                                                <option value="5">Pengemudi</option>
                                                <option value="6">Penjaga Sekolah/Pesuruh</option>
                                                <option value="7">Tenaga Keamanan</option>
                                                <option value="8">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="tugas_tambahan_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#tugas_tambahan" aria-expanded="false" aria-controls="tugas_tambahan">
                                    Tugas Tambahan di Madrasah Ini  
                                </a>
                            </h4>
                        </div>
                        <div id="tugas_tambahan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tugas_tambahan_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_tambahan--jenis_tugas">Jenis Tugas</label>
                                            <select name="tugas_tambahan--jenis_tugas" id="tugas_tambahan--jenis_tugas" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Kepala Madrasah</option>
                                                <option value="2">Wakil Kepala Madrasah</option>
                                                <option value="3">Kepala Perpustakaan</option>
                                                <option value="4">Kepala Laboratorium</option>
                                                <option value="5">Ketua Jurusan/Program Keahlian</option>
                                                <option value="6">Kepala Bengkel</option>
                                                <option value="7">Pembimbing Praktek Kerja Industri</option>
                                                <option value="8">Kepala Unit Produksi</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_tambahan--ekuivalensi_jam_tatap_muka">Ekuivalensi Jam Tatap Muka</label>
                                            <input type="number" readonly="" name="tugas_tambahan--ekuivalensi_jam_tatap_muka" id="tugas_tambahan--ekuivalensi_jam_tatap_muka" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="tugas_mengajar_di_satuan_lain_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#tugas_mengajar_di_satuan_lain" aria-expanded="false" aria-controls="tugas_mengajar_di_satuan_lain">
                                    Tugas Mengajar di Satuan Pendidikan Lain (di luar Madrasah Ini)        
                                </a>
                            </h4>
                        </div>
                        <div id="tugas_mengajar_di_satuan_lain" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tugas_mengajar_di_satuan_lain_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_mengajar_di_satuan_lain--jenis_tempat_tugas_lain">Jenis Tempat Tugas Lain</label>
                                            <select name="tugas_mengajar_di_satuan_lain--jenis_tempat_tugas_lain" id="tugas_mengajar_di_satuan_lain--jenis_tempat_tugas_lain" class="form-control">
                                                <option value=""></option>
                                                <option value="1">MI</option>
                                                <option value="2">MTs</option>
                                                <option value="3">MA</option>
                                                <option value="4">SD</option>
                                                <option value="5">SMP</option>
                                                <option value="6">SMA</option>
                                                <option value="7">SMK</option>
                                                <option value="8">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_mengajar_di_satuan_lain--npsn_tempat_tugas_lain">NPSN Tempat Tugas Lain</label>
                                            <input type="text" name="tugas_mengajar_di_satuan_lain--npsn_tempat_tugas_lain" id="tugas_mengajar_di_satuan_lain--npsn_tempat_tugas_lain" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_mengajar_di_satuan_lain--mapel_yang_diampu">Mapel Yang Di Ampu</label>
                                            <input type="text" name="tugas_mengajar_di_satuan_lain--mapel_yang_diampu" id="tugas_mengajar_di_satuan_lain--mapel_yang_diampu" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tugas_mengajar_di_satuan_lain--jam_tatap_muka_per_minggu">Jam Tatap Muka/Minggu</label>
                                            <input type="text" name="tugas_mengajar_di_satuan_lain--jam_tatap_muka_per_minggu" id="tugas_mengajar_di_satuan_lain--jam_tatap_muka_per_minggu" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="informasi_sertifikasi_pendidik_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#informasi_sertifikasi_pendidik" aria-expanded="false" aria-controls="informasi_sertifikasi_pendidik">
                                    Informasi Sertifikasi Pendidik     
                                </a>
                            </h4>
                        </div>
                        <div id="informasi_sertifikasi_pendidik" class="panel-collapse collapse" role="tabpanel" aria-labelledby="informasi_sertifikasi_pendidik_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_sertifikasi_pendidik--status_kepesertaaan">Status Kepesertaan</label>
                                            <select name="informasi_sertifikasi_pendidik--status_kepesertaaan" id="informasi_sertifikasi_pendidik--status_kepesertaaan" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Belum pernah mengikuti sertifikasi guru</option>
                                                <option value="1">Sudah pernah mengikuti sertifikasi guru</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_sertifikasi_pendidik--status_kelulusan">Status Kelulusan</label>
                                            <select name="informasi_sertifikasi_pendidik--status_kelulusan" id="informasi_sertifikasi_pendidik--status_kelulusan" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Sudah Lulus</option>
                                                <option value="2">Masih Proses</option>
                                                <option value="3">Belum Lulus</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_sertifikasi_pendidik--tahun_lulus">Tahun Lulus</label>
                                            <input type="int" max="4" name="informasi_sertifikasi_pendidik--tahun_lulus" id="informasi_sertifikasi_pendidik--tahun_lulus" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_sertifikasi_pendidik--mapel_yang_disertifikasi">Mapel Yang Di Sertifikasi</label>
                                            <select name="informasi_sertifikasi_pendidik--mapel_yang_disertifikasi" id="informasi_sertifikasi_pendidik--mapel_yang_disertifikasi" class="form-control">
                                                <option value=""></option>
                                                <option value="01">Pendidikan Agama Islam (PAI)</option>
                                                <option value="02">Al Qur'an Hadist</option>
                                                <option value="03">Aqidah Akhlak</option>
                                                <option value="04">Fiqih</option>
                                                <option value="05">Sejarah Kebudayaan Islam (SKI)</option>
                                                <option value="06">Pendidikan Kewarganegaraan (PKn)</option>
                                                <option value="07">Bahasa Indonesia</option>
                                                <option value="08">Bahasa Arab</option>
                                                <option value="09">Bahasa Inggris</option>
                                                <option value="10">Bahasa Asing Lainnya</option>
                                                <option value="11">Matematika</option>
                                                <option value="12">IPA</option>
                                                <option value="13">Fisika</option>
                                                <option value="14">Biologi</option>
                                                <option value="15">Kimia</option>
                                                <option value="16">IPS</option>
                                                <option value="17">Sejarah / Sejarah Nasional dan Umum</option>
                                                <option value="18">Geografi</option>
                                                <option value="19">Ekonomi / Akuntansi</option>
                                                <option value="20">Sosiologi Antropologi</option>
                                                <option value="21">Sosiologi</option>
                                                <option value="22">Antropologi</option>
                                                <option value="23">Tata Negara</option>
                                                <option value="24">Seni Budaya dan Keterampilan / Kerajinan Tangan dan Kesenian</option>
                                                <option value="25">Seni Budaya</option>
                                                <option value="26">Keterampilan</option>
                                                <option value="27">Pendidikan Jasmani, Olahraga dan Kesehatan</option>
                                                <option value="28">Teknologi Informasi dan Komunikasi (TIK)</option>
                                                <option value="29">Muatan Lokal Umum</option>
                                                <option value="30">Muatan Lokal Agama</option>
                                                <option value="31">Bimbingan Konseling / Bimbingan Penyuluhan</option>
                                                <option value="32">Guru Kelas</option>
                                                <option value="33">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_sertifikasi_pendidik--nrg">NRG</label>
                                            <input type="text" name="informasi_sertifikasi_pendidik--nrg" id="informasi_sertifikasi_pendidik--nrg" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_sertifikasi_pendidik--no_sk_nrg">No SK NRG</label>
                                            <input type="text" name="informasi_sertifikasi_pendidik--no_sk_nrg" id="informasi_sertifikasi_pendidik--no_sk_nrg" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_sertifikasi_pendidik--tanggal_sk_nrg">Tanggal SK NRG</label>
                                            <input type="text" name="informasi_sertifikasi_pendidik--tanggal_sk_nrg" id="informasi_sertifikasi_pendidik--tanggal_sk_nrg" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="informasi_tpg_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#informasi_tpg" aria-expanded="false" aria-controls="informasi_tpg">
                                    Informasi Tunjangan Profesi Guru (TPG)
                                </a>
                            </h4>
                        </div>
                        <div id="informasi_tpg" class="panel-collapse collapse" role="tabpanel" aria-labelledby="informasi_tpg_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_tpg--status_penerima_tpg">Status Penerima TPG</label>
                                            <select name="informasi_tpg--status_penerima_tpg" id="informasi_tpg--status_penerima_tpg" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Bukan penerima TPG</option>
                                                <option value="1">Penerima TPG</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_tpg--menerima_tpg_mulai_tahun">Menerima TPG Mulai Tahun</label>
                                            <input type="number" max="4" name="informasi_tpg--menerima_tpg_mulai_tahun" id="informasi_tpg--menerima_tpg_mulai_tahun" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_tpg--besarnya_tpg_per_bulan">Besarnya TPG Per Bulan</label>
                                            <input type="number" name="informasi_tpg--besarnya_tpg_per_bulan" id="informasi_tpg--besarnya_tpg_per_bulan" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="informasi_tfg_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#informasi_tfg" aria-expanded="false" aria-controls="informasi_tfg">
                                    Informasi Tunjangan Fungsional Guru (TFG)
                                </a>
                            </h4>
                        </div>
                        <div id="informasi_tfg" class="panel-collapse collapse" role="tabpanel" aria-labelledby="informasi_tfg_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_tfg--status_penerima_tfg">Status Penerima TFG</label>
                                            <select name="informasi_tfg--status_penerima_tfg" id="informasi_tfg--status_penerima_tfg" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Bukan penerima TFG</option>
                                                <option value="1">Penerima TFG</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_tfg--menerima_tfg_mulai_tahun">Menerima TFG Mulai Tahun</label>
                                            <input type="number" max="4" name="informasi_tfg--menerima_tfg_mulai_tahun" id="informasi_tfg--menerima_tfg_mulai_tahun" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="informasi_tfg--besarnya_tfg_per_bulan">Besarnya TFG Per Bulan</label>
                                            <input type="number" name="informasi_tfg--besarnya_tfg_per_bulan" id="informasi_tfg--besarnya_tfg_per_bulan" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="penghargaan_tertinggi_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#penghargaan_tertinggi" aria-expanded="false" aria-controls="penghargaan_tertinggi">
                                    Penghargaan Tertinggi Yang Pernah Diperoleh (Khusus Pendidik)           
                                </a>
                            </h4>
                        </div>
                        <div id="penghargaan_tertinggi" class="panel-collapse collapse" role="tabpanel" aria-labelledby="penghargaan_tertinggi_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="penghargaan_tertinggi--apakah_pernah_memperoleh_penghargaan">Apakah Pernah Memperoleh Penghargaan?</label>
                                            <select name="penghargaan_tertinggi--apakah_pernah_memperoleh_penghargaan" id="penghargaan_tertinggi--apakah_pernah_memperoleh_penghargaan" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Belum Pernah</option>
                                                <option value="1">Pernah</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="penghargaan_tertinggi--bidang_penghargaan">Bidang Penghargaan</label>
                                            <select name="penghargaan_tertinggi--bidang_penghargaan" id="penghargaan_tertinggi--bidang_penghargaan" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Information & Communication Technology (ICT)</option>
                                                <option value="2">Penelitian Tindakan Kelas (PTK)</option>
                                                <option value="3">Model Pembelajaran</option>
                                                <option value="4">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="penghargaan_tertinggi--tingkat_penghargaan">Tingkat Penghargaan</label>
                                            <select name="penghargaan_tertinggi--tingkat_penghargaan" id="penghargaan_tertinggi--tingkat_penghargaan" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Tingkat Kabupaten/Kota</option>
                                                <option value="2">Tingkat Provinsi</option>
                                                <option value="3">Tingkat Nasional</option>
                                                <option value="4">Tingkat Internasional</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="penghargaan_tertinggi--tahun_perolehan_penghargaan">Tahun Perolehan Penghargaan</label>
                                            <input type="number" max="4" name="penghargaan_tertinggi--tahun_perolehan_penghargaan" id="penghargaan_tertinggi--tahun_perolehan_penghargaan" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="pelatihan_kompetensi_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#pelatihan_kompetensi" aria-expanded="false" aria-controls="pelatihan_kompetensi">
                                    Pelatihan Peningkatan Kompetensi Yang Pernah Diikuti oleh Kepala Madrasah (Khusus untuk Kepala Madrasah)                                          
                                </a>
                            </h4>
                        </div>
                        <div id="pelatihan_kompetensi" class="panel-collapse collapse" role="tabpanel" aria-labelledby="pelatihan_kompetensi_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Kompentensi Kepribadian</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_kepribadian--keikutsertaan_pelatihan">Keikutsertaan Pelatihan</label>
                                            <select name="pelatihan_kompetensi_kepribadian--keikutsertaan_pelatihan" id="pelatihan_kompetensi_kepribadian--keikutsertaan_pelatihan" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Belum Pernah</option>
                                                <option value="1">Pernah</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_kepribadian--tahun_mengikuti">Tahun Mengikuti</label>
                                            <input type="number" max="4" name="pelatihan_kompetensi_kepribadian--tahun_mengikuti" id="pelatihan_kompetensi_kepribadian--tahun_mengikuti" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Kompentensi Manajerial</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_manajerial--keikutsertaan_pelatihan">Keikutsertaan Pelatihan</label>
                                            <select name="pelatihan_kompetensi_manajerial--keikutsertaan_pelatihan" id="pelatihan_kompetensi_manajerial--keikutsertaan_pelatihan" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Belum Pernah</option>
                                                <option value="1">Pernah</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_manajerial--tahun_mengikuti">Tahun Mengikuti</label>
                                            <input type="number" max="4" name="pelatihan_kompetensi_manajerial--tahun_mengikuti" id="pelatihan_kompetensi_manajerial--tahun_mengikuti" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Kompentensi Kewirausahaan</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_kewirausahaan--keikutsertaan_pelatihan">Keikutsertaan Pelatihan</label>
                                            <select name="pelatihan_kompetensi_kewirausahaan--keikutsertaan_pelatihan" id="pelatihan_kompetensi_kewirausahaan--keikutsertaan_pelatihan" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Belum Pernah</option>
                                                <option value="1">Pernah</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_kewirausahaan--tahun_mengikuti">Tahun Mengikuti</label>
                                            <input type="number" max="4" name="pelatihan_kompetensi_kewirausahaan--tahun_mengikuti" id="pelatihan_kompetensi_kewirausahaan--tahun_mengikuti" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Kompentensi Supervisi</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_supervisi--keikutsertaan_pelatihan">Keikutsertaan Pelatihan</label>
                                            <select name="pelatihan_kompetensi_supervisi--keikutsertaan_pelatihan" id="pelatihan_kompetensi_supervisi--keikutsertaan_pelatihan" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Belum Pernah</option>
                                                <option value="1">Pernah</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_supervisi--tahun_mengikuti">Tahun Mengikuti</label>
                                            <input type="number" max="4" name="pelatihan_kompetensi_supervisi--tahun_mengikuti" id="pelatihan_kompetensi_supervisi--tahun_mengikuti" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Kompentensi Sosial</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_sosial--keikutsertaan_pelatihan">Keikutsertaan Pelatihan</label>
                                            <select name="pelatihan_kompetensi_sosial--keikutsertaan_pelatihan" id="pelatihan_kompetensi_sosial--keikutsertaan_pelatihan" class="form-control">
                                                <option value=""></option>
                                                <option value="0">Belum Pernah</option>
                                                <option value="1">Pernah</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pelatihan_kompetensi_sosial--tahun_mengikuti">Tahun Mengikuti</label>
                                            <input type="number" max="4" name="pelatihan_kompetensi_sosial--tahun_mengikuti" id="pelatihan_kompetensi_sosial--tahun_mengikuti" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="alamat_tempat_tinggal_personal_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#alamat_tempat_tinggal_personal" aria-expanded="false" aria-controls="alamat_tempat_tinggal_personal">
                                    Alamat Rumah/Tempat Tinggal Personal  
                                </a>
                            </h4>
                        </div>
                        <div id="alamat_tempat_tinggal_personal" class="panel-collapse collapse" role="tabpanel" aria-labelledby="alamat_tempat_tinggal_personal_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="alamat_tempat_tinggal_personal--alamat">Alamat</label>
                                            <textarea rows="3" name="alamat_tempat_tinggal_personal--alamat" id="alamat_tempat_tinggal_personal--alamat" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="alamat_tempat_tinggal_personal--provinsi">Provinsi</label>
                                            <input type="text" name="alamat_tempat_tinggal_personal--provinsi" id="alamat_tempat_tinggal_personal--provinsi" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="alamat_tempat_tinggal_personal--kab_kota">Kab/Kota</label>
                                            <input type="text" name="alamat_tempat_tinggal_personal--kab_kota" id="alamat_tempat_tinggal_personal--kab_kota" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="alamat_tempat_tinggal_personal--kecamatan">Kecamatan</label>
                                            <input type="text" name="alamat_tempat_tinggal_personal--kecamatan" id="alamat_tempat_tinggal_personal--kecamatan" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="alamat_tempat_tinggal_personal--desa_kelurahan">Desa/Kelurahan</label>
                                            <input type="text" name="alamat_tempat_tinggal_personal--desa_kelurahan" id="alamat_tempat_tinggal_personal--desa_kelurahan" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="alamat_tempat_tinggal_personal--kode_pos">Kode Pos</label>
                                            <input type="text" name="alamat_tempat_tinggal_personal--kode_pos" id="alamat_tempat_tinggal_personal--kode_pos" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="rumah_dan_transportasi_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#rumah_dan_transportasi" aria-expanded="false" aria-controls="rumah_dan_transportasi">
                                    Jarak Rumah dan Transportasi
                                </a>
                            </h4>
                        </div>
                        <div id="rumah_dan_transportasi" class="panel-collapse collapse" role="tabpanel" aria-labelledby="rumah_dan_transportasi_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jarak_rumah_ke_madrasah_tempat_tugas">Jarak Rumah ke Madrasah Tempat Tugas</label>
                                            <select name="jarak_rumah_ke_madrasah_tempat_tugas" id="jarak_rumah_ke_madrasah_tempat_tugas" class="form-control">
                                                <option value=""></option>
                                                <option value="1">< 5 Km</option>
                                                <option value="2">5 - 10 Km</option>
                                                <option value="3">11 - 20 Km</option>
                                                <option value="4">21 - 30 Km</option>
                                                <option value="5">> 30 Km</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="transportasi_dari_rumah_ke_madrasah_tempat_tugas">Transportasi Dari Rumah ke Madrasah Tempat Tugas</label>
                                            <select name="transportasi_dari_rumah_ke_madrasah_tempat_tugas" id="transportasi_dari_rumah_ke_madrasah_tempat_tugas" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Jalan Kaki</option>
                                                <option value="2">Sepeda</option>
                                                <option value="3">Sepeda Motor</option>
                                                <option value="4">Mobil Pribadi</option>
                                                <option value="5">Kendaraan Antar Jemput Sekolah</option>
                                                <option value="6">Angkutan Umum</option>
                                                <option value="7">Perahu/Sampan</option>
                                                <option value="8">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status_tempat_tinggal">Status Tempat Tinggal</label>
                                            <select name="status_tempat_tinggal" id="status_tempat_tinggal" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Rumah Milik Sendiri</option>
                                                <option value="2">Rumah Orangtua</option>
                                                <option value="3">Rumah Saudara/Kerabat</option>
                                                <option value="4">Rumah Dinas</option>
                                                <option value="5">Sewa/Kontrak</option>
                                                <option value="6">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="riwayat_pendidikan_ptk_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#riwayat_pendidikan_ptk" aria-expanded="false" aria-controls="riwayat_pendidikan_ptk">
                                    Riwayat Pendidikan PTK (Jenjang S1/D4, S2 dan S3)
                                </a>
                            </h4>
                        </div>
                        <div id="riwayat_pendidikan_ptk" class="panel-collapse collapse" role="tabpanel" aria-labelledby="riwayat_pendidikan_ptk_heading">
                            <div class="panel-body">
                                

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Jenjang S1/D4</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s1_d4--program_studi">Program Studi</label>
                                            <select name="riwayat_pendidikan_ptk--jenjang_s1_d4--program_studi" id="riwayat_pendidikan_ptk--jenjang_s1_d4--program_studi" class="form-control">
                                                <option value=""></option>
                                                <option value="01">Rumpun Pendidikan Agama Islam (PAI)</option>
                                                <option value="02">Bahasa Indonesia</option>
                                                <option value="03">Bahasa Inggris</option>
                                                <option value="04">Bahasa Arab</option>
                                                <option value="05">Bahasa Asing Lainnya (Bahasa Jepang, Mandarin, Korea, Jerman, Belanda, Perancis, Rusia, dll)</option>
                                                <option value="06">Matematika/Statistika</option>
                                                <option value="07">IPA (Fisika, Biologi, Kimia, Metereologi, Geofisika)</option>
                                                <option value="08">Ilmu Sosial (Ekonomi, Akuntansi, Sosiologi, Antropologi, Tata Negara, Manajemen, Administrasi)</option>
                                                <option value="09">Ilmu Komputer/Informatika/Teknologi Informasi</option>
                                                <option value="10">Pendidikan Jasmani, Olahraga dan Kesehatan</option>
                                                <option value="11">Manajemen Pendidikan / Ilmu Pendidikan</option>
                                                <option value="12">Hukum/Syari'ah/Hukum Islam</option>
                                                <option value="13">PGSD/PGMI</option>
                                                <option value="14">PGTK</option>
                                                <option value="15">Psikologi</option>
                                                <option value="16">Kesenian</option>
                                                <option value="17">Pendidikan Kewarganegaraan</option>
                                                <option value="18">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s1_d4--gelar_akademik">Gelar Akademik</label>
                                            <input type="text" name="riwayat_pendidikan_ptk--jenjang_s1_d4--gelar_akademik" id="riwayat_pendidikan_ptk--jenjang_s1_d4--gelar_akademik" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s1_d4--tahun_lulus">Tahun Lulus</label>
                                            <input type="number" name="riwayat_pendidikan_ptk--jenjang_s1_d4--tahun_lulus" id="riwayat_pendidikan_ptk--jenjang_s1_d4--tahun_lulus" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Jenjang S2</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s2--program_studi">Program Studi</label>
                                            <select name="riwayat_pendidikan_ptk--jenjang_s2--program_studi" id="riwayat_pendidikan_ptk--jenjang_s2--program_studi" class="form-control">
                                                <option value=""></option>
                                                <option value="01">Rumpun Pendidikan Agama Islam (PAI)</option>
                                                <option value="02">Bahasa Indonesia</option>
                                                <option value="03">Bahasa Inggris</option>
                                                <option value="04">Bahasa Arab</option>
                                                <option value="05">Bahasa Asing Lainnya (Bahasa Jepang, Mandarin, Korea, Jerman, Belanda, Perancis, Rusia, dll)</option>
                                                <option value="06">Matematika/Statistika</option>
                                                <option value="07">IPA (Fisika, Biologi, Kimia, Metereologi, Geofisika)</option>
                                                <option value="08">Ilmu Sosial (Ekonomi, Akuntansi, Sosiologi, Antropologi, Tata Negara, Manajemen, Administrasi)</option>
                                                <option value="09">Ilmu Komputer/Informatika/Teknologi Informasi</option>
                                                <option value="10">Pendidikan Jasmani, Olahraga dan Kesehatan</option>
                                                <option value="11">Manajemen Pendidikan / Ilmu Pendidikan</option>
                                                <option value="12">Hukum/Syari'ah/Hukum Islam</option>
                                                <option value="13">PGSD/PGMI</option>
                                                <option value="14">PGTK</option>
                                                <option value="15">Psikologi</option>
                                                <option value="16">Kesenian</option>
                                                <option value="17">Pendidikan Kewarganegaraan</option>
                                                <option value="18">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s2--gelar_akademik">Gelar Akademik</label>
                                            <input type="text" name="riwayat_pendidikan_ptk--jenjang_s2--gelar_akademik" id="riwayat_pendidikan_ptk--jenjang_s2--gelar_akademik" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s2--tahun_lulus">Tahun Lulus</label>
                                            <input type="number" name="riwayat_pendidikan_ptk--jenjang_s2--tahun_lulus" id="riwayat_pendidikan_ptk--jenjang_s2--tahun_lulus" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Jenjang S3</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s3--program_studi">Program Studi</label>
                                            <select name="riwayat_pendidikan_ptk--jenjang_s3--program_studi" id="riwayat_pendidikan_ptk--jenjang_s3--program_studi" class="form-control">
                                                <option value=""></option>
                                                <option value="01">Rumpun Pendidikan Agama Islam (PAI)</option>
                                                <option value="02">Bahasa Indonesia</option>
                                                <option value="03">Bahasa Inggris</option>
                                                <option value="04">Bahasa Arab</option>
                                                <option value="05">Bahasa Asing Lainnya (Bahasa Jepang, Mandarin, Korea, Jerman, Belanda, Perancis, Rusia, dll)</option>
                                                <option value="06">Matematika/Statistika</option>
                                                <option value="07">IPA (Fisika, Biologi, Kimia, Metereologi, Geofisika)</option>
                                                <option value="08">Ilmu Sosial (Ekonomi, Akuntansi, Sosiologi, Antropologi, Tata Negara, Manajemen, Administrasi)</option>
                                                <option value="09">Ilmu Komputer/Informatika/Teknologi Informasi</option>
                                                <option value="10">Pendidikan Jasmani, Olahraga dan Kesehatan</option>
                                                <option value="11">Manajemen Pendidikan / Ilmu Pendidikan</option>
                                                <option value="12">Hukum/Syari'ah/Hukum Islam</option>
                                                <option value="13">PGSD/PGMI</option>
                                                <option value="14">PGTK</option>
                                                <option value="15">Psikologi</option>
                                                <option value="16">Kesenian</option>
                                                <option value="17">Pendidikan Kewarganegaraan</option>
                                                <option value="18">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s3--gelar_akademik">Gelar Akademik</label>
                                            <input type="text" name="riwayat_pendidikan_ptk--jenjang_s3--gelar_akademik" id="riwayat_pendidikan_ptk--jenjang_s3--gelar_akademik" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riwayat_pendidikan_ptk--jenjang_s3--tahun_lulus">Tahun Lulus</label>
                                            <input type="number" name="riwayat_pendidikan_ptk--jenjang_s3--tahun_lulus" id="riwayat_pendidikan_ptk--jenjang_s3--tahun_lulus" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                
                            </div>

                            
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="tambahan_data_guru_tetap_non_pns_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#tambahan_data_guru_tetap_non_pns" aria-expanded="false" aria-controls="tambahan_data_guru_tetap_non_pns">
                                    Tambahan Data Guru Tetap Non-PNS 
                                    <br>(SK Pengangkatan Guru Tetap Non-PNS)
                                </a>
                            </h4>
                        </div>
                        <div id="tambahan_data_guru_tetap_non_pns" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tambahan_data_guru_tetap_non_pns_heading">
                            <div class="panel-body">
                                

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tambahan_data_guru_tetap_non_pns--nomor_sk">Nomor SK</label>
                                            <input type="text" name="tambahan_data_guru_tetap_non_pns--nomor_sk" id="tambahan_data_guru_tetap_non_pns--nomor_sk" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tambahan_data_guru_tetap_non_pns--tanggal_sk">Tanggal SK</label>
                                            <input type="date" name="tambahan_data_guru_tetap_non_pns--tanggal_sk" id="tambahan_data_guru_tetap_non_pns--tanggal_sk" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="tambahan_data_inspassing_guru_non_pns_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#tambahan_data_inspassing_guru_non_pns" aria-expanded="false" aria-controls="tambahan_data_inspassing_guru_non_pns">
                                    Tambahan Data Inpassing Guru Non-PNS    
                                </a>
                            </h4>
                        </div>
                        <div id="tambahan_data_inspassing_guru_non_pns" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tambahan_data_inspassing_guru_non_pns_heading">
                            <div class="panel-body">
                                

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tambahan_data_inpassing_guru_non_pns--nomor_sk_inpassing">Nomor SK Inpassing</label>
                                            <input type="text" name="tambahan_data_inpassing_guru_non_pns--nomor_sk_inpassing" id="tambahan_data_inpassing_guru_non_pns--nomor_sk_inpassing" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tambahan_data_inpassing_guru_non_pns--tanggal_sk_inpassing">Tanggal SK Inpassing</label>
                                            <input type="date" name="tambahan_data_inpassing_guru_non_pns--tanggal_sk_inpassing" id="tambahan_data_inpassing_guru_non_pns--tanggal_sk_inpassing" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="sertifikasi_pendidik_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#sertifikasi_pendidik" aria-expanded="false" aria-controls="sertifikasi_pendidik">
                                    Informasi Tambahan terkait Sertifikasi Pendidik                     
                                </a>
                            </h4>
                        </div>
                        <div id="sertifikasi_pendidik" class="panel-collapse collapse" role="tabpanel" aria-labelledby="sertifikasi_pendidik_heading">
                            <div class="panel-body">
                                

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sertifikasi_pendidik--nomor_peserta_sertifikasi">Nomor Peserta Sertifikasi</label>
                                            <input type="text" name="sertifikasi_pendidik--nomor_peserta_sertifikasi" id="sertifikasi_pendidik--nomor_peserta_sertifikasi" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tambahan_data_inpassing_guru_non_pns--jenis_jalur_sertifikasi">Jenis/Jalur Sertifikasi</label>
                                            <select name="tambahan_data_inpassing_guru_non_pns--jenis_jalur_sertifikasi" id="tambahan_data_inpassing_guru_non_pns--jenis_jalur_sertifikasi" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Portofolio</option>
                                                <option value="2">PLPG</option>
                                                <option value="3">PSPL</option>
                                                <option value="4">PPG Dalam Jabatan (PPGJ)<option>
                                                <option value="5">PPG Pra Jabatan</option>
                                                <option value="6">Lainnya</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sertifikasi_pendidik--tanggal_kelulusan_sertifikasi">Tanggal Kelulusan Sertifikasi</label>
                                            <input type="date" name="sertifikasi_pendidik--tanggal_kelulusan_sertifikasi" id="sertifikasi_pendidik--tanggal_kelulusan_sertifikasi" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sertifikasi_pendidik--nomor_sertifikat_pendidik">Nomor Sertifikat Pendidik</label>
                                            <input type="date" name="sertifikasi_pendidik--nomor_sertifikat_pendidik" id="sertifikasi_pendidik--nomor_sertifikat_pendidik" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sertifikasi_pendidik--tanggal_penerbitan_sertifikat">Tanggal Penerbitan Sertifikat</label>
                                            <input type="date" name="sertifikasi_pendidik--tanggal_penerbitan_sertifikat" id="sertifikasi_pendidik--tanggal_penerbitan_sertifikat" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label for="sertifikasi_pendidik--lptk_penyelenggara_sertifikasi">Tanggal Penerbitan Sertifikat</label>
                                            <input type="hidden" name="sertifikasi_pendidik--lptk_penyelenggara_sertifikasi--nama" id="sertifikasi_pendidik--lptk_penyelenggara_sertifikasi--nama" class="form-control">
                                            <select name="sertifikasi_pendidik--lptk_penyelenggara_sertifikasi--kode" id="sertifikasi_pendidik--lptk_penyelenggara_sertifikasi--kode" class="form-control">
                                                <option value=""></option>
                                                <option value="001">001 - UIN Ar-Raniry Banda Aceh </option>
                                                <option value="002">002 - UIN Sumatera Utara Medan </option>
                                                <option value="003">003 - UIN Sultan Syarif Kasim Pekanbaru </option>
                                                <option value="004">004 - UIN Raden Fatah Palembang </option>
                                                <option value="005">005 - UIN Syarif Hidayatullah Jakarta </option>
                                                <option value="006">006 - UIN Sunan Gunung Djati Bandung </option>
                                                <option value="007">007 - UIN Walisongo Semarang </option>
                                                <option value="008">008 - UIN Sunan Kalijaga Yogyakarta </option>
                                                <option value="009">009 - UIN Maulana Malik Ibrahim Malang </option>
                                                <option value="010">010 - UIN Sunan Ampel Surabaya </option>
                                                <option value="011">011 - UIN Alauddin Makassar </option>
                                                <option value="012">012 - IAIN Zawiyah Cot Kala Langsa </option>
                                                <option value="013">013 - IAIN Padangsidimpuan </option>
                                                <option value="014">014 - IAIN Imam Bonjol Padang </option>
                                                <option value="015">015 - IAIN Sjech M. Djamil Djambek Bukittinggi </option>
                                                <option value="016">016 - IAIN Sulthan Thaha Saifuddin Jambi </option>
                                                <option value="017">017 - IAIN Bengkulu </option>
                                                <option value="018">018 - IAIN Raden Intan Lampung </option>
                                                <option value="019">019 - IAIN Syekh Nurjati Cirebon </option>
                                                <option value="020">020 - IAIN Surakarta </option>
                                                <option value="021">021 - IAIN Purwokerto </option>
                                                <option value="022">022 - IAIN Salatiga </option>
                                                <option value="023">023 - IAIN Tulungagung </option>
                                                <option value="024">024 - IAIN Jember </option>
                                                <option value="025">025 - IAIN Sultan Maulana Hasanuddin Banten </option>
                                                <option value="026">026 - IAIN Mataram </option>
                                                <option value="027">027 - IAIN Pontianak </option>
                                                <option value="028">028 - IAIN Palangkaraya </option>
                                                <option value="029">029 - IAIN Antasari Banjarmasin </option>
                                                <option value="030">030 - IAIN Sultan Sulaiman Samarinda </option>
                                                <option value="031">031 - IAIN Manado </option>
                                                <option value="032">032 - IAIN Palu </option>
                                                <option value="033">033 - IAIN Palopo </option>
                                                <option value="034">034 - IAIN Sultan Qaimuddin Kendari </option>
                                                <option value="035">035 - IAIN Sultan Amai Gorontalo </option>
                                                <option value="036">036 - IAIN Ambon </option>
                                                <option value="037">037 - IAIN Ternate </option>
                                                <option value="038">038 - STAIN Malikussaleh Lhokseumawe </option>
                                                <option value="039">039 - STAIN Gajah Putih Takengon </option>
                                                <option value="040">040 - STAIN Meulaboh </option>
                                                <option value="041">041 - STAIN Batusangkar </option>
                                                <option value="042">042 - STAIN Bengkalis </option>
                                                <option value="043">043 - STAIN Kerinci </option>
                                                <option value="044">044 - STAIN Curup </option>
                                                <option value="045">045 - STAIN Syaik Abdurrahman Siddik Bangka Belitung </option>
                                                <option value="046">046 - STAIN Jurai Siwo Metro </option>
                                                <option value="047">047 - STAIN Kudus </option>
                                                <option value="048">048 - STAIN Pekalongan </option>
                                                <option value="049">049 - STAIN Kediri </option>
                                                <option value="050">050 - STAIN Pamekasan </option>
                                                <option value="051">051 - STAIN Ponorogo </option>
                                                <option value="052">052 - STAIN Watampone </option>
                                                <option value="053">053 - STAIN Parepare </option>
                                                <option value="054">054 - STAIN Al Fatah Jayapura </option>
                                                <option value="055">055 - STAIN Sorong </option>
                                                <option value="056">056 - Universitas Malikussaleh </option>
                                                <option value="057">057 - Universitas Syiah Kuala </option>
                                                <option value="058">058 - Universitas Negeri Medan </option>
                                                <option value="059">059 - Universitas Sumatera Utara </option>
                                                <option value="060">060 - Universitas Andalas </option>
                                                <option value="061">061 - Universitas Negeri Padang </option>
                                                <option value="062">062 - Universitas Riau </option>
                                                <option value="063">063 - Universitas Maritim Raja Ali Haji </option>
                                                <option value="064">064 - Universitas Jambi </option>
                                                <option value="065">065 - Universitas Bengkulu </option>
                                                <option value="066">066 - Universitas Sriwijaya </option>
                                                <option value="067">067 - Universitas Bangka Belitung </option>
                                                <option value="068">068 - Universitas Lampung </option>
                                                <option value="069">069 - Universitas Indonesia </option>
                                                <option value="070">070 - Universitas Negeri Jakarta </option>
                                                <option value="071">071 - Institut Pertanian Bogor </option>
                                                <option value="072">072 - Institut Teknologi Bandung </option>
                                                <option value="073">073 - Universitas Padjadjaran </option>
                                                <option value="074">074 - Universitas Pendidikan Indonesia </option>
                                                <option value="075">075 - Universitas Diponegoro </option>
                                                <option value="076">076 - Universitas Jenderal Soedirman </option>
                                                <option value="077">077 - Universitas Negeri Semarang </option>
                                                <option value="078">078 - Universitas Sebelas Maret </option>
                                                <option value="079">079 - Universitas Gadjah Mada </option>
                                                <option value="080">080 - Universitas Negeri Yogyakarta </option>
                                                <option value="081">081 - Institut Teknologi Sepuluh Nopember </option>
                                                <option value="082">082 - Universitas Airlangga </option>
                                                <option value="083">083 - Universitas Brawijaya </option>
                                                <option value="084">084 - Universitas Jember </option>
                                                <option value="085">085 - Universitas Negeri Malang </option>
                                                <option value="086">086 - Universitas Negeri Surabaya </option>
                                                <option value="087">087 - Universitas Trunojoyo </option>
                                                <option value="088">088 - Universitas Sultan Ageng Tirtayasa </option>
                                                <option value="089">089 - Universitas Pendidikan Ganesha </option>
                                                <option value="090">090 - Universitas Udayana </option>
                                                <option value="091">091 - Universitas Mataram </option>
                                                <option value="092">092 - Universitas Nusa Cendana </option>
                                                <option value="093">093 - Universitas Tanjungpura </option>
                                                <option value="094">094 - Universitas Palangkaraya </option>
                                                <option value="095">095 - Universitas Lambung Mangkurat </option>
                                                <option value="096">096 - Universitas Mulawarman </option>
                                                <option value="097">097 - Universitas Borneo Tarakan </option>
                                                <option value="098">098 - Universitas Negeri Manado </option>
                                                <option value="099">099 - Universitas Sam Ratulangi </option>
                                                <option value="100">100 - Universitas Tadulako </option>
                                                <option value="101">101 - Universitas Hasanuddin </option>
                                                <option value="102">102 - Universitas Negeri Makassar </option>
                                                <option value="103">103 - Universitas Haluoleo </option>
                                                <option value="104">104 - Universitas Negeri Gorontalo </option>
                                                <option value="105">105 - Universitas Pattimura </option>
                                                <option value="106">106 - Universitas Khairun </option>
                                                <option value="107">107 - Universitas Cenderawasih </option>
                                                <option value="108">108 - Universitas Musamus Merauke </option>
                                                <option value="109">109 - Universitas Papua </option>
                                                <option value="110">110 - Sekolah Tinggi Akuntansi Negara (STAN) Jakarta </option>
                                                <option value="111">111 - Institut Pemerintahan Dalam Negeri (IPDN) Jatinangor </option>
                                                <option value="112">112 - Sekolah Tinggi Perikanan (STP) Jakarta </option>
                                                <option value="113">113 - Sekolah Tinggi Penerbangan Indonesia (STPI) Curug </option>
                                                <option value="114">114 - Sekolah Tinggi Ilmu Pelayaran Jakarta </option>
                                                <option value="115">115 - Sekolah Tinggi Ilmu Statistik (STIS) Jakarta </option>
                                                <option value="116">116 - STIA Lembaga Administrasi Negara (STIA-LAN) Bandung </option>
                                                <option value="117">117 - Sekolah Tinggi Sandi Negara (STSN) Bogor </option>
                                                <option value="118">118 - Akademi Kepolisian (Akpol) Semarang </option>
                                                <option value="119">119 - Akademi Militer (TNI Angkatan Darat) Magelang </option>
                                                <option value="120">120 - Lainnya </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Ubah</button>
            </div>
        </form>
    </div>
</div>


<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-delete" class="modal-content">

            <input type="hidden" name="id" id="id">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Hapus Data Guru</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>Anda yakin ingin menghapus data <strong id="identifier">Guru</strong>?</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
            </div>
        </form>
    </div>
</div>



<script src="<?php echo base_url('assets/scripts/guru.js') ?>"></script>