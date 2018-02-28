<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">Data Siswa</div>
				</div>
				<div class="panel-body">
					<div id="table-toolbar">
                        <a id="btn-add" href="" class="btn btn-primary btn-sm"><i class="fa fa-plus" title="Tambah Siswa"></i> Tambah</a>
						<a id="btn-print" href="" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print" title="Cetak"></i> Cetak</a>
					</div>
					<table id="table"></table>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="modal-print" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form id="form-print" class="modal-content" action="<?php echo base_url('siswa/cetak') ?>" target="_blank">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cetak Data Siswa</h4>
            </div>
            <div class="modal-body">

               
                <div class="form-group">
                    <label for="tahunajaran_id">Tahun Ajaran</label>
                    <select name="tahunajaran_id" id="tahunajaran_id" class="form-control">
                        <option value=""></option>
                        <?php if($tahunajaran): foreach($tahunajaran as $ta): ?>
                            <option value="<?php echo $ta->id ?>"><?php echo $ta->tahunajaran ?></option>
                        <?php endforeach; endif; ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="tingkat_id">Tingkat</label>
                    <select name="tingkat_id" id="tingkat_id" class="form-control">
                        <option value=""></option>
                        <option value="7, 8, 9">MTS</option>
                        <option value="10, 11, 12">MA</option>
                    </select>
                </div> 
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
            </div>
        </form>
    </div>
</div>



<div id="modal-add" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <form id="form-add" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Siswa</h4>
            </div>
            <div class="modal-body">

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="informasi_pribadi_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#informasi_pribadi" aria-expanded="false" aria-controls="informasi_pribadi">
                                    Informasi Pribadi Siswa
                                </a>
                            </h4>
                        </div>
                        <div id="informasi_pribadi" class="panel-collapse collapse" role="tabpanel" aria-labelledby="informasi_pribadi_heading">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nis_lokal">NIS Lokal</label>
                                            <input type="text" class="form-control" id="nis_lokal" name="nis_lokal" placeholder="NIS Lokal">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nik">NISN</label>
                                            <input type="text" class="form-control" id="nik" name="nik" placeholder="NISN">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nisn">NIK</label>
                                            <input type="text" class="form-control" id="nisn" name="nisn" placeholder="NIK">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama_hijaiyah">Nama Hijaiyah</label>
                                            <input type="text" class="form-control" id="nama_hijaiyah" name="nama_hijaiyah" placeholder="اسم الطالبة/سم الطالب" style="font-size: 20px;">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                                <option value=""></option>
                                                <option value="l">Laki-laki</option>
                                                <option value="p">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tingkat_id">Tingkat</label>
                                            <select name="tingkat_id" id="tingkat_id" class="form-control">
                                                <option value=""></option>
                                                <?php foreach($tingkat as $tk): ?>
                                                    <option value="<?php echo $tk->id ?>"><?php echo $tk->tingkat ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tahunajaran_id">Tahun Ajaran</label>
                                            <select name="tahunajaran_id" id="tahunajaran_id" class="form-control">
                                                <option value=""></option>
                                                <?php foreach($tahunajaran as $ta): ?>
                                                    <option value="<?php echo $ta->id ?>"><?php echo $ta->tahunajaran ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_siswa">Status Siswa</label>
                                            <select name="status_siswa" id="status_siswa" class="form-control">
                                                <option value="1">Naik dari tingkat sebelumnya</option>
                                                <option value="2">Mengulang (tidak naik kelas)</option>
                                                <option value="3">Siswa pindah/mutasi masuk</option>
                                                <option value="4">Drop-out kembali</option>
                                                <option value="5">Siswa baru tingkat 7 (MTS)/ 10 (MA)</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="asal_sekolah_pindah">Asal Sekolah</label>
                                            <select name="asal_sekolah_pindah" id="asal_sekolah_pindah" class="form-control" disabled="">
                                                <option value=""></option>
                                                <option value="1">MTS/MA</option>
                                                <option value="2">SMP/SMA</option>
                                                <option value="3">Paket B/Paket C</option>
                                                <option value="4">Pondok Pesantren</option>
                                                <option value="5">SMP/SMA di Luar Negeri</option>
                                                <option value="6">Lainnya</option>
                                            </select>
                                            <p class="help-block">Diisi dengan jenis Asal Sekolah sebelumnya (khusus bagi siswa pindah masuk atau mutasi dari madrasah/sekolah lain)</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hobi">Hobi</label>
                                            <select name="hobi" id="hobi" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Olahraga</option>
                                                <option value="2">Kesenian</option>
                                                <option value="3">Membaca</option>
                                                <option value="4">Menulis</option>
                                                <option value="5">Travelling</option>
                                                <option value="6">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cita_cita">Cita-cita</label>
                                            <select name="cita_cita" id="cita_cita" class="form-control">
                                                <option value=""></option>
                                                <option value="1">PNS</option>
                                                <option value="2">TNI/Polri</option>
                                                <option value="3">Guru/Dosen</option>
                                                <option value="4">Dokter</option>
                                                <option value="5">Politikus</option>
                                                <option value="6">Wiraswasta</option>
                                                <option value="7">Pekerja Seni/Lukis/Artis/Sejenis</option>
                                                <option value="8">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="jumlah_saudara">Jumlah Saudara</label>
                                            <input type="number" class="form-control" name="jumlah_saudara" id="jumlah_saudara">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="asal_sekolah_jenjang_sebelumnya_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#asal_sekolah_jenjang_sebelumnya" aria-expanded="false" aria-controls="asal_sekolah_jenjang_sebelumnya">
                                    Asal Sekolah Jenjang Sebelumnya
                                </a>
                            </h4>
                        </div>
                        <div id="asal_sekolah_jenjang_sebelumnya" class="panel-collapse collapse" role="tabpanel" aria-labelledby="asal_sekolah_jenjang_sebelumnya_heading">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="asal_sekolah_jenjang_sebelumnya--jenis_sekolah">Jenis Sekolah</label>
                                            <select name="asal_sekolah_jenjang_sebelumnya--jenis_sekolah" id="asal_sekolah_jenjang_sebelumnya--jenis_sekolah" class="form-control">
                                                <option value=""></option>
                                                <option value="1">SD/SMP</option>
                                                <option value="2">MI/MTs</option>
                                                <option value="3">SD/SMP Terbuka</option>
                                                <option value="4">SLB</option>
                                                <option value="5">Paket A/B</option>
                                                <option value="6">Pesantren Salafiyah Wustha</option>
                                                <option value="7">SD/SMP di Luar Negeri</option>
                                            </select>
                                            <p class="help-block">Diisi dengan Jenis Sekolah Jenjang Sebelumnya (jenjang SMP/MTs/Sederajat) dari siswa yang bersangkutan</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="asal_sekolah_jenjang_sebelumnya--status_sekolah">Status Sekolah</label>
                                            <select name="asal_sekolah_jenjang_sebelumnya--status_sekolah" id="asal_sekolah_jenjang_sebelumnya--status_sekolah" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Negeri</option>
                                                <option value="2">Swasta</option>
                                            </select>
                                            <p class="help-block">Diisi dengan Status Sekolah Jenjang Sebelumnya (jenjang SMP/MTs/Sederajat) dari siswa yang bersangkutan</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="asal_sekolah_jenjang_sebelumnya--kab_kota">Kabupaten/Kota</label>
                                            <input type="text" class="form-control" id="asal_sekolah_jenjang_sebelumnya--kab_kota" name="asal_sekolah_jenjang_sebelumnya--kab_kota">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="asal_sekolah_jenjang_sebelumnya--no_peserta_skhun">No. Peserta/SKHUN pada Jenjang Sebelumnya (SMP/MTs)</label>
                                            <input type="text" class="form-control" id="asal_sekolah_jenjang_sebelumnya--no_peserta_skhun" name="asal_sekolah_jenjang_sebelumnya--no_peserta_skhun">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="informasi_alamat_orangtua_wali_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#informasi_alamat_orangtua_wali" aria-expanded="false" aria-controls="informasi_alamat_orangtua_wali">
                                    Informasi Alamat Orang Tua Wali
                                </a>
                            </h4>
                        </div>
                        <div id="informasi_alamat_orangtua_wali" class="panel-collapse collapse" role="tabpanel" aria-labelledby="informasi_alamat_orangtua_wali_heading">
                            <div class="panel-body">
                                <div class="row">
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="asal_sekolah_jenjang_sebelumnya--alamat">Alamat</label>
                                            <textarea name="asal_sekolah_jenjang_sebelumnya--alamat" id="asal_sekolah_jenjang_sebelumnya--alamat" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="informasi_alamat_orangtua_wali--provinsi">Provinsi</label>
                                                    <input type="text" class="form-control" id="informasi_alamat_orangtua_wali--provinsi" name="informasi_alamat_orangtua_wali--provinsi">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="informasi_alamat_orangtua_wali--kab_kota">Kabupaten/Kota</label>
                                                    <input type="text" class="form-control" id="informasi_alamat_orangtua_wali--kab_kota" name="informasi_alamat_orangtua_wali--kab_kota">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="informasi_alamat_orangtua_wali--kecamatan">Kecamatan</label>
                                                    <input type="text" class="form-control" id="informasi_alamat_orangtua_wali--kecamatan" name="informasi_alamat_orangtua_wali--kecamatan">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="informasi_alamat_orangtua_wali--desa_kelurahan">Desa/Kelurahan</label>
                                                    <input type="text" class="form-control" id="informasi_alamat_orangtua_wali--desa_kelurahan" name="informasi_alamat_orangtua_wali--desa_kelurahan">
                                                </div>
                                            </div>
                                        </div>

                                         <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="informasi_alamat_orangtua_wali--kode_pos">Kode Pos</label>
                                                    <input type="text" class="form-control" id="informasi_alamat_orangtua_wali--kode_pos" name="informasi_alamat_orangtua_wali--kode_pos">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="jarak_rumah_dan_transportasi_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#jarak_rumah_dan_transportasi" aria-expanded="false" aria-controls="jarak_rumah_dan_transportasi">
                                    Jarak Rumah dan Transportasi
                                </a>
                            </h4>
                        </div>
                        <div id="jarak_rumah_dan_transportasi" class="panel-collapse collapse" role="tabpanel" aria-labelledby="jarak_rumah_dan_transportasi_heading">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jarak_rumah_siswa_ke_madrasah">Jarak Rumah Siswa ke Madrasah</label>
                                            <select class="form-control" name="jarak_rumah_siswa_ke_madrasah" id="jarak_rumah_siswa_ke_madrasah">
                                                <option value=""></option>
                                                <option value="1">< 1 Km</option>
                                                <option value="2">1 - 3 Km</option>
                                                <option value="3">3 - 5 Km</option>
                                                <option value="4">5 - 10 Km</option>
                                                <option value="5">> 10 Km</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="transportasi_dari_rumah_ke_madrasah">Tranportasi dari Rumah ke Madrasah</label>
                                            <select class="form-control" name="transportasi_dari_rumah_ke_madrasah" id="transportasi_dari_rumah_ke_madrasah">
                                                <option value=""></option>
                                                <option value="1">Jalan Kaki</option>
                                                <option value="2">Sepeda</option>
                                                <option value="3">Sepeda Motor</option>
                                                <option value="4">Mobil Pribadi</option>
                                                <option value="5">Antar Jemput Sekolah</option>
                                                <option value="6">Angkutan Umum</option>
                                                <option value="7">Perahu/Sampan</option>
                                                <option value="8">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="informasi_kebutuhan_khusus_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#informasi_kebutuhan_khusus" aria-expanded="false" aria-controls="informasi_kebutuhan_khusus">
                                    Informasi Kebutuhan Khusus
                                </a>
                            </h4>
                        </div>
                        <div id="informasi_kebutuhan_khusus" class="panel-collapse collapse" role="tabpanel" aria-labelledby="informasi_kebutuhan_khusus_heading">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--tuna_rungu" id="informasi_kebutuhan_khusus--tuna_rungu"> Tuna Rungu
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--tuna_netra" id="informasi_kebutuhan_khusus--tuna_netra"> Tuna Netra
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--tuna_daksa" id="informasi_kebutuhan_khusus--tuna_daksa"> Tuna Daksa
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--tuna_grahita" id="informasi_kebutuhan_khusus--tuna_grahita"> Tuna Grahita
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--tuna_laras" id="informasi_kebutuhan_khusus--tuna_laras"> Tuna Laras
                                            </label>
                                        </div>
                                    </div>

                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--lamban_belajar" id="informasi_kebutuhan_khusus--lamban_belajar"> Lamban Belajar
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--sulit_belajar" id="informasi_kebutuhan_khusus--sulit_belajar"> Sulit Belajar
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--gangguan_komunikasi" id="informasi_kebutuhan_khusus--gangguan_komunikasi"> Gangguan Komunikasi
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">

                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--bakat_luar_biasa" id="informasi_kebutuhan_khusus--bakat_luar_biasa"> Bakat Luar Biasa
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="program_indonesia_pintar_bsm_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#program_indonesia_pintar_bsm" aria-expanded="false" aria-controls="program_indonesia_pintar_bsm">
                                    Program Indonesia Pintar (PIP) / BSM
                                </a>
                            </h4>
                        </div>
                        <div id="program_indonesia_pintar_bsm" class="panel-collapse collapse" role="tabpanel" aria-labelledby="program_indonesia_pintar_bsm_heading">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="program_indonesia_pintar_bsm--status_penerima">Status Penerima</label>
                                            <select class="form-control" id="program_indonesia_pintar_bsm--status_penerima" name="program_indonesia_pintar_bsm--status_penerima">
                                                <option value=""></option>
                                                <option value="0">Bukan Penerima PIP/BSM Tahun 2015</option>
                                                <option value="1">Penerima PIP/BSM Tahun 2015</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="program_indonesia_pintar_bsm--alasan_menerima">Alasan Menerima</label>
                                            <select class="form-control" id="program_indonesia_pintar_bsm--alasan_menerima" name="program_indonesia_pintar_bsm--alasan_menerima">
                                                <option value=""></option>
                                                <option value="1">Pemegang Kartu Indonesia Pintar (KIP)</option>
                                                <option value="2">Memiliki Surat Keterangan Tidak Mampu (SKTM)</option>
                                                <option value="3">Yatim Piatu</option>
                                                <option value="4">Terancam Putus Sekolah</option>
                                                <option value="5">Kelainan Fisik</option>
                                                <option value="6">Korban Bencana</option>
                                                <option value="7">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="program_indonesia_pintar_bsm--periode_menerima">Periode Menerima</label>
                                            <input type="text" class="form-control" id="program_indonesia_pintar_bsm--periode_menerima" name="program_indonesia_pintar_bsm--periode_menerima">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="prestasi_tertinggi_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#prestasi_tertinggi" aria-expanded="false" aria-controls="prestasi_tertinggi">
                                    Prestasi Tertinggi Yang Pernah Diraih Oleh Siswa
                                </a>
                            </h4>
                        </div>
                        <div id="prestasi_tertinggi" class="panel-collapse collapse" role="tabpanel" aria-labelledby="prestasi_tertinggi_heading">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="prestasi_tertinggi--bidang_prestasi">Bidang Prestasi</label>
                                            <select class="form-control" id="prestasi_tertinggi--bidang_prestasi" name="prestasi_tertinggi--bidang_prestasi">
                                                <option value=""></option>
                                                <option value="1">Akademik, seperti : lomba Olimpiade Bidang Studi, Kompetisi Sains Madrasah, Cerdas Cermat, dll</option>
                                                <option value="2">Keagamaan, seperti : lomba Baca/Hafalan Al Qur'an, Kaligrafi, Adzan, dll.</option>
                                                <option value="3">Teknologi, seperti : lomba robotik, perancangan web atau sistem informasi, perakitan mesin, dll</option>
                                                <option value="4">Olahraga, seperti : lomba bela diri, sepakbola, bola basket, bulutangkis, catur, tenis meja, bola voli, dll</option>
                                                <option value="5">Pramuka/Paskribaka</option>
                                                <option value="6">Karya Ilmiah Remaja</option>
                                                <option value="7">Kesenian, seperti : lomba menyanyi, menari, melukis, alat musik, marching band, dll</option>
                                                <option value="8">Pidato Bahasa Asing, seperti : lomba pidato bahasa inggris, bahasa mandarain, bahasa arab, dll</option>
                                                <option value="9">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="prestasi_tertinggi--tingkat_prestasi">Tingkat Prestasi</label>
                                            <select class="form-control" id="prestasi_tertinggi--tingkat_prestasi" name="prestasi_tertinggi--tingkat_prestasi">
                                                <option value=""></option>
                                                <option value="1">Tingkat Kabupaten/Kota</option>
                                                <option value="2">Tingkat Provinsi</option>
                                                <option value="3">Tingkat Nasional</option>
                                                <option value="4">Tingkat Internasional</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="prestasi_tertinggi--peringkat_yang_diraih">Peringkat Yang Diraih</label>
                                            <select class="form-control" id="prestasi_tertinggi--peringkat_yang_diraih" name="prestasi_tertinggi--peringkat_yang_diraih">
                                                <option value=""></option>
                                                <option value="1">Juara I</option>
                                                <option value="2">Juara II</option>
                                                <option value="3">Juara III</option>
                                                <option value="4">Juara Harapan I</option>
                                                <option value="5">Juara Harapan II</option>
                                                <option value="6">Juara Harapan III</option>
                                                <option value="7">Juara Favorit</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="prestasi_tertinggi--tahun_meraih_prestasi">Tahun Meraih Prestasi</label>
                                            <input type="number" min="4" max="4" class="form-control" id="prestasi_tertinggi--tahun_meraih_prestasi" name="prestasi_tertinggi--tahun_meraih_prestasi">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="beasiswa_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#beasiswa" aria-expanded="false" aria-controls="beasiswa">
                                    Beasiswa
                                </a>
                            </h4>
                        </div>
                        <div id="beasiswa" class="panel-collapse collapse" role="tabpanel" aria-labelledby="beasiswa_heading">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="beasiswa--status_beasiswa">Status Beasiswa</label>
                                            <select class="form-control" id="beasiswa--status_beasiswa" name="beasiswa--status_beasiswa">
                                                <option value=""></option>
                                                <option value="0">Menerima Beasiswa</option>
                                                <option value="1">Tidak Menerima Beasiswa</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="beasiswa--sumber_beasiswa">Sumber Beasiswa</label>
                                            <select class="form-control" id="beasiswa--sumber_beasiswa" name="beasiswa--sumber_beasiswa">
                                                <option value=""></option>
                                                <option value="1">Pemerintah Pusat (Kementerian)</option>
                                                <option value="2">Pemerintah Daerah</option>
                                                <option value="3">Badan Usaha Milik Negara (BUMN), seperti : Pertamina, Telkom, PLN, dll</option>
                                                <option value="4">Badan Usaha Milik Daerah (BUMD), seperti : Bank Pembangunan Daerah, Perusahaan Daerah Air Minum (PDAM), dll</option>
                                                <option value="5">Perusahaan Swasta</option>
                                                <option value="6">Yayasan/Lembaga Nirlaba</option>
                                                <option value="7">Perseorangan</option>
                                                <option value="8">Lainnya</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="lain_lain_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#lain_lain" aria-expanded="false" aria-controls="lain_lain">
                                    Lain-lain
                                </a>
                            </h4>
                        </div>
                        <div id="lain_lain" class="panel-collapse collapse" role="tabpanel" aria-labelledby="lain_lain_heading">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_kks_kps">No KKS/KPS</label>
                                            <input type="text" max="14" class="form-control" id="no_kks_kps" name="no_kks_kps">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_kartu_pkh">No Kartu PKH</label>
                                            <input type="text" max="14" class="form-control" id="no_kartu_pkh" name="no_kartu_pkh">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_kip">No Kartu Indonesia Pintar</label>
                                            <input type="text" max="14" class="form-control" id="no_kip" name="no_kip">
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
                <h4 class="modal-title" id="myModalLabel">Ubah Data Siswa</h4>
            </div>
            <div class="modal-body">

                <div class="panel-group" id="accordion_edit" role="tablist" aria-multiselectable="true">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="informasi_pribadi_edit_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_edit" href="#informasi_pribadi_edit" aria-expanded="false" aria-controls="informasi_pribadi_edit">
                                    Informasi Pribadi Siswa
                                </a>
                            </h4>
                        </div>
                        <div id="informasi_pribadi_edit" class="panel-collapse collapse" role="tabpanel" aria-labelledby="informasi_pribadi_edit_heading">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nis_lokal">NIS Lokal</label>
                                            <input type="text" class="form-control" id="nis_lokal" name="nis_lokal" placeholder="NIS Lokal">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nik">NISN</label>
                                            <input type="text" class="form-control" id="nik" name="nik" placeholder="NISN">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nisn">NIK</label>
                                            <input type="text" class="form-control" id="nisn" name="nisn" placeholder="NIK">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama_hijaiyah">Nama Hijaiyah</label>
                                            <input type="text" class="form-control" id="nama_hijaiyah" name="nama_hijaiyah" placeholder="اسم الطالبة/سم الطالب" style="font-size: 20px;">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                                <option value=""></option>
                                                <option value="l">Laki-laki</option>
                                                <option value="p">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tingkat_id">Tingkat</label>
                                            <select name="tingkat_id" id="tingkat_id" class="form-control">
                                                <option value=""></option>
                                                <?php foreach($tingkat as $tk): ?>
                                                    <option value="<?php echo $tk->id ?>"><?php echo $tk->tingkat ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tahunajaran_id">Tahun Ajaran</label>
                                            <select name="tahunajaran_id" id="tahunajaran_id" class="form-control">
                                                <option value=""></option>
                                                <?php foreach($tahunajaran as $ta): ?>
                                                    <option value="<?php echo $ta->id ?>"><?php echo $ta->tahunajaran ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_siswa">Status Siswa</label>
                                            <select name="status_siswa" id="status_siswa" class="form-control">
                                                <option value="1">Naik dari tingkat sebelumnya</option>
                                                <option value="2">Mengulang (tidak naik kelas)</option>
                                                <option value="3">Siswa pindah/mutasi masuk</option>
                                                <option value="4">Drop-out kembali</option>
                                                <option value="5">Siswa baru tingkat 7 (MTS)/ 10 (MA)</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="asal_sekolah_pindah">Asal Sekolah</label>
                                            <select name="asal_sekolah_pindah" id="asal_sekolah_pindah" class="form-control" disabled="">
                                                <option value=""></option>
                                                <option value="1">MTS/MA</option>
                                                <option value="2">SMP/SMA</option>
                                                <option value="3">Paket B/Paket C</option>
                                                <option value="4">Pondok Pesantren</option>
                                                <option value="5">SMP/SMA di Luar Negeri</option>
                                                <option value="6">Lainnya</option>
                                            </select>
                                            <p class="help-block">Diisi dengan jenis Asal Sekolah sebelumnya (khusus bagi siswa pindah masuk atau mutasi dari madrasah/sekolah lain)</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hobi">Hobi</label>
                                            <select name="hobi" id="hobi" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Olahraga</option>
                                                <option value="2">Kesenian</option>
                                                <option value="3">Membaca</option>
                                                <option value="4">Menulis</option>
                                                <option value="5">Travelling</option>
                                                <option value="6">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cita_cita">Cita-cita</label>
                                            <select name="cita_cita" id="cita_cita" class="form-control">
                                                <option value=""></option>
                                                <option value="1">PNS</option>
                                                <option value="2">TNI/Polri</option>
                                                <option value="3">Guru/Dosen</option>
                                                <option value="4">Dokter</option>
                                                <option value="5">Politikus</option>
                                                <option value="6">Wiraswasta</option>
                                                <option value="7">Pekerja Seni/Lukis/Artis/Sejenis</option>
                                                <option value="8">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="jumlah_saudara">Jumlah Saudara</label>
                                            <input type="number" class="form-control" name="jumlah_saudara" id="jumlah_saudara">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="asal_sekolah_jenjang_sebelumnya_edit_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#asal_sekolah_jenjang_sebelumnya_edit" aria-expanded="false" aria-controls="asal_sekolah_jenjang_sebelumnya_edit">
                                    Asal Sekolah Jenjang Sebelumnya
                                </a>
                            </h4>
                        </div>
                        <div id="asal_sekolah_jenjang_sebelumnya_edit" class="panel-collapse collapse" role="tabpanel" aria-labelledby="asal_sekolah_jenjang_sebelumnya_edit_heading">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="asal_sekolah_jenjang_sebelumnya--jenis_sekolah">Jenis Sekolah</label>
                                            <select name="asal_sekolah_jenjang_sebelumnya--jenis_sekolah" id="asal_sekolah_jenjang_sebelumnya--jenis_sekolah" class="form-control">
                                                <option value=""></option>
                                                <option value="1">SD/SMP</option>
                                                <option value="2">MI/MTs</option>
                                                <option value="3">SD/SMP Terbuka</option>
                                                <option value="4">SLB</option>
                                                <option value="5">Paket A/B</option>
                                                <option value="6">Pesantren Salafiyah Wustha</option>
                                                <option value="7">SD/SMP di Luar Negeri</option>
                                            </select>
                                            <p class="help-block">Diisi dengan Jenis Sekolah Jenjang Sebelumnya (jenjang SMP/MTs/Sederajat) dari siswa yang bersangkutan</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="asal_sekolah_jenjang_sebelumnya--status_sekolah">Status Sekolah</label>
                                            <select name="asal_sekolah_jenjang_sebelumnya--status_sekolah" id="asal_sekolah_jenjang_sebelumnya--status_sekolah" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Negeri</option>
                                                <option value="2">Swasta</option>
                                            </select>
                                            <p class="help-block">Diisi dengan Status Sekolah Jenjang Sebelumnya (jenjang SMP/MTs/Sederajat) dari siswa yang bersangkutan</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="asal_sekolah_jenjang_sebelumnya--kab_kota">Kabupaten/Kota</label>
                                            <input type="text" class="form-control" id="asal_sekolah_jenjang_sebelumnya--kab_kota" name="asal_sekolah_jenjang_sebelumnya--kab_kota">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="asal_sekolah_jenjang_sebelumnya--no_peserta_skhun">No. Peserta/SKHUN pada Jenjang Sebelumnya (SMP/MTs)</label>
                                            <input type="text" class="form-control" id="asal_sekolah_jenjang_sebelumnya--no_peserta_skhun" name="asal_sekolah_jenjang_sebelumnya--no_peserta_skhun">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="informasi_alamat_orangtua_wali_edit_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#informasi_alamat_orangtua_wali_edit" aria-expanded="false" aria-controls="informasi_alamat_orangtua_wali_edit">
                                    Informasi Alamat Orang Tua Wali
                                </a>
                            </h4>
                        </div>
                        <div id="informasi_alamat_orangtua_wali_edit" class="panel-collapse collapse" role="tabpanel" aria-labelledby="informasi_alamat_orangtua_wali_edit_heading">
                            <div class="panel-body">
                                <div class="row">
                                
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="asal_sekolah_jenjang_sebelumnya--alamat">Alamat</label>
                                            <textarea name="asal_sekolah_jenjang_sebelumnya--alamat" id="asal_sekolah_jenjang_sebelumnya--alamat" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="informasi_alamat_orangtua_wali--provinsi">Provinsi</label>
                                                    <input type="text" class="form-control" id="informasi_alamat_orangtua_wali--provinsi" name="informasi_alamat_orangtua_wali--provinsi">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="informasi_alamat_orangtua_wali--kab_kota">Kabupaten/Kota</label>
                                                    <input type="text" class="form-control" id="informasi_alamat_orangtua_wali--kab_kota" name="informasi_alamat_orangtua_wali--kab_kota">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="informasi_alamat_orangtua_wali--kecamatan">Kecamatan</label>
                                                    <input type="text" class="form-control" id="informasi_alamat_orangtua_wali--kecamatan" name="informasi_alamat_orangtua_wali--kecamatan">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="informasi_alamat_orangtua_wali--desa_kelurahan">Desa/Kelurahan</label>
                                                    <input type="text" class="form-control" id="informasi_alamat_orangtua_wali--desa_kelurahan" name="informasi_alamat_orangtua_wali--desa_kelurahan">
                                                </div>
                                            </div>
                                        </div>

                                         <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="informasi_alamat_orangtua_wali--kode_pos">Kode Pos</label>
                                                    <input type="text" class="form-control" id="informasi_alamat_orangtua_wali--kode_pos" name="informasi_alamat_orangtua_wali--kode_pos">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="jarak_rumah_dan_transportasi_edit_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#jarak_rumah_dan_transportasi_edit" aria-expanded="false" aria-controls="jarak_rumah_dan_transportasi_edit">
                                    Jarak Rumah dan Transportasi
                                </a>
                            </h4>
                        </div>
                        <div id="jarak_rumah_dan_transportasi_edit" class="panel-collapse collapse" role="tabpanel" aria-labelledby="jarak_rumah_dan_transportasi_edit_heading">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jarak_rumah_siswa_ke_madrasah">Jarak Rumah Siswa ke Madrasah</label>
                                            <select class="form-control" name="jarak_rumah_siswa_ke_madrasah" id="jarak_rumah_siswa_ke_madrasah">
                                                <option value=""></option>
                                                <option value="1">< 1 Km</option>
                                                <option value="2">1 - 3 Km</option>
                                                <option value="3">3 - 5 Km</option>
                                                <option value="4">5 - 10 Km</option>
                                                <option value="5">> 10 Km</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="transportasi_dari_rumah_ke_madrasah">Tranportasi dari Rumah ke Madrasah</label>
                                            <select class="form-control" name="transportasi_dari_rumah_ke_madrasah" id="transportasi_dari_rumah_ke_madrasah">
                                                <option value=""></option>
                                                <option value="1">Jalan Kaki</option>
                                                <option value="2">Sepeda</option>
                                                <option value="3">Sepeda Motor</option>
                                                <option value="4">Mobil Pribadi</option>
                                                <option value="5">Antar Jemput Sekolah</option>
                                                <option value="6">Angkutan Umum</option>
                                                <option value="7">Perahu/Sampan</option>
                                                <option value="8">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="informasi_kebutuhan_khusus_edit_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#informasi_kebutuhan_khusus_edit" aria-expanded="false" aria-controls="informasi_kebutuhan_khusus_edit">
                                    Informasi Kebutuhan Khusus
                                </a>
                            </h4>
                        </div>
                        <div id="informasi_kebutuhan_khusus_edit" class="panel-collapse collapse" role="tabpanel" aria-labelledby="informasi_kebutuhan_khusus_edit_heading">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--tuna_rungu" id="informasi_kebutuhan_khusus--tuna_rungu"> Tuna Rungu
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--tuna_netra" id="informasi_kebutuhan_khusus--tuna_netra"> Tuna Netra
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--tuna_daksa" id="informasi_kebutuhan_khusus--tuna_daksa"> Tuna Daksa
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--tuna_grahita" id="informasi_kebutuhan_khusus--tuna_grahita"> Tuna Grahita
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--tuna_laras" id="informasi_kebutuhan_khusus--tuna_laras"> Tuna Laras
                                            </label>
                                        </div>
                                    </div>

                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--lamban_belajar" id="informasi_kebutuhan_khusus--lamban_belajar"> Lamban Belajar
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--sulit_belajar" id="informasi_kebutuhan_khusus--sulit_belajar"> Sulit Belajar
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--gangguan_komunikasi" id="informasi_kebutuhan_khusus--gangguan_komunikasi"> Gangguan Komunikasi
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">

                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="informasi_kebutuhan_khusus--bakat_luar_biasa" id="informasi_kebutuhan_khusus--bakat_luar_biasa"> Bakat Luar Biasa
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="program_indonesia_pintar_bsm_edit_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#program_indonesia_pintar_bsm_edit" aria-expanded="false" aria-controls="program_indonesia_pintar_bsm_edit">
                                    Program Indonesia Pintar (PIP) / BSM
                                </a>
                            </h4>
                        </div>
                        <div id="program_indonesia_pintar_bsm_edit" class="panel-collapse collapse" role="tabpanel" aria-labelledby="program_indonesia_pintar_bsm_edit_heading">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="program_indonesia_pintar_bsm--status_penerima">Status Penerima</label>
                                            <select class="form-control" id="program_indonesia_pintar_bsm--status_penerima" name="program_indonesia_pintar_bsm--status_penerima">
                                                <option value=""></option>
                                                <option value="0">Bukan Penerima PIP/BSM Tahun 2015</option>
                                                <option value="1">Penerima PIP/BSM Tahun 2015</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="program_indonesia_pintar_bsm--alasan_menerima">Alasan Menerima</label>
                                            <select class="form-control" id="program_indonesia_pintar_bsm--alasan_menerima" name="program_indonesia_pintar_bsm--alasan_menerima">
                                                <option value=""></option>
                                                <option value="1">Pemegang Kartu Indonesia Pintar (KIP)</option>
                                                <option value="2">Memiliki Surat Keterangan Tidak Mampu (SKTM)</option>
                                                <option value="3">Yatim Piatu</option>
                                                <option value="4">Terancam Putus Sekolah</option>
                                                <option value="5">Kelainan Fisik</option>
                                                <option value="6">Korban Bencana</option>
                                                <option value="7">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="program_indonesia_pintar_bsm--periode_menerima">Periode Menerima</label>
                                            <input type="text" class="form-control" id="program_indonesia_pintar_bsm--periode_menerima" name="program_indonesia_pintar_bsm--periode_menerima">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="prestasi_tertinggi_edit_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#prestasi_tertinggi_edit" aria-expanded="false" aria-controls="prestasi_tertinggi_edit">
                                    Prestasi Tertinggi Yang Pernah Diraih Oleh Siswa
                                </a>
                            </h4>
                        </div>
                        <div id="prestasi_tertinggi_edit" class="panel-collapse collapse" role="tabpanel" aria-labelledby="prestasi_tertinggi_edit_heading">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="prestasi_tertinggi--bidang_prestasi">Bidang Prestasi</label>
                                            <select class="form-control" id="prestasi_tertinggi--bidang_prestasi" name="prestasi_tertinggi--bidang_prestasi">
                                                <option value=""></option>
                                                <option value="1">Akademik, seperti : lomba Olimpiade Bidang Studi, Kompetisi Sains Madrasah, Cerdas Cermat, dll</option>
                                                <option value="2">Keagamaan, seperti : lomba Baca/Hafalan Al Qur'an, Kaligrafi, Adzan, dll.</option>
                                                <option value="3">Teknologi, seperti : lomba robotik, perancangan web atau sistem informasi, perakitan mesin, dll</option>
                                                <option value="4">Olahraga, seperti : lomba bela diri, sepakbola, bola basket, bulutangkis, catur, tenis meja, bola voli, dll</option>
                                                <option value="5">Pramuka/Paskribaka</option>
                                                <option value="6">Karya Ilmiah Remaja</option>
                                                <option value="7">Kesenian, seperti : lomba menyanyi, menari, melukis, alat musik, marching band, dll</option>
                                                <option value="8">Pidato Bahasa Asing, seperti : lomba pidato bahasa inggris, bahasa mandarain, bahasa arab, dll</option>
                                                <option value="9">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="prestasi_tertinggi--tingkat_prestasi">Tingkat Prestasi</label>
                                            <select class="form-control" id="prestasi_tertinggi--tingkat_prestasi" name="prestasi_tertinggi--tingkat_prestasi">
                                                <option value=""></option>
                                                <option value="1">Tingkat Kabupaten/Kota</option>
                                                <option value="2">Tingkat Provinsi</option>
                                                <option value="3">Tingkat Nasional</option>
                                                <option value="4">Tingkat Internasional</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="prestasi_tertinggi--peringkat_yang_diraih">Peringkat Yang Diraih</label>
                                            <select class="form-control" id="prestasi_tertinggi--peringkat_yang_diraih" name="prestasi_tertinggi--peringkat_yang_diraih">
                                                <option value=""></option>
                                                <option value="1">Juara I</option>
                                                <option value="2">Juara II</option>
                                                <option value="3">Juara III</option>
                                                <option value="4">Juara Harapan I</option>
                                                <option value="5">Juara Harapan II</option>
                                                <option value="6">Juara Harapan III</option>
                                                <option value="7">Juara Favorit</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="prestasi_tertinggi--tahun_meraih_prestasi">Tahun Meraih Prestasi</label>
                                            <input type="number" min="4" max="4" class="form-control" id="prestasi_tertinggi--tahun_meraih_prestasi" name="prestasi_tertinggi--tahun_meraih_prestasi">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="beasiswa_edit_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#beasiswa_edit" aria-expanded="false" aria-controls="beasiswa_edit">
                                    Beasiswa
                                </a>
                            </h4>
                        </div>
                        <div id="beasiswa_edit" class="panel-collapse collapse" role="tabpanel" aria-labelledby="beasiswa_edit_heading">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="beasiswa--status_beasiswa">Status Beasiswa</label>
                                            <select class="form-control" id="beasiswa--status_beasiswa" name="beasiswa--status_beasiswa">
                                                <option value=""></option>
                                                <option value="0">Menerima Beasiswa</option>
                                                <option value="1">Tidak Menerima Beasiswa</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="beasiswa--sumber_beasiswa">Sumber Beasiswa</label>
                                            <select class="form-control" id="beasiswa--sumber_beasiswa" name="beasiswa--sumber_beasiswa">
                                                <option value=""></option>
                                                <option value="1">Pemerintah Pusat (Kementerian)</option>
                                                <option value="2">Pemerintah Daerah</option>
                                                <option value="3">Badan Usaha Milik Negara (BUMN), seperti : Pertamina, Telkom, PLN, dll</option>
                                                <option value="4">Badan Usaha Milik Daerah (BUMD), seperti : Bank Pembangunan Daerah, Perusahaan Daerah Air Minum (PDAM), dll</option>
                                                <option value="5">Perusahaan Swasta</option>
                                                <option value="6">Yayasan/Lembaga Nirlaba</option>
                                                <option value="7">Perseorangan</option>
                                                <option value="8">Lainnya</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="lain_lain_edit_heading">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#lain_lain_edit" aria-expanded="false" aria-controls="lain_lain_edit">
                                    Lain-lain
                                </a>
                            </h4>
                        </div>
                        <div id="lain_lain_edit" class="panel-collapse collapse" role="tabpanel" aria-labelledby="lain_lain_edit_heading">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_kks_kps">No KKS/KPS</label>
                                            <input type="text" max="14" class="form-control" id="no_kks_kps" name="no_kks_kps">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_kartu_pkh">No Kartu PKH</label>
                                            <input type="text" max="14" class="form-control" id="no_kartu_pkh" name="no_kartu_pkh">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_kip">No Kartu Indonesia Pintar</label>
                                            <input type="text" max="14" class="form-control" id="no_kip" name="no_kip">
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
                <h4 class="modal-title" id="myModalLabel">Hapus Data Siswa</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>Anda yakin ingin menghapus data <strong id="identifier">Siswa</strong>?</p>
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



<script src="<?php echo base_url('assets/scripts/siswa.js') ?>"></script>