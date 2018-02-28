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
					</div>
					<table id="table"></table>
				</div>
			</div>
		</div>
	</div>
</div>




<div id="modal-add" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-add" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Siswa</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nis_lokal">NIS Lokal</label>
                            <input type="text" class="form-control" id="nis_lokal" name="nis_lokal" placeholder="NIS Lokal">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control" id="nisn" name="nisn" placeholder="NISN">
                        </div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_hijaiyah">Nama Hijaiyah</label>
                            <input type="text" class="form-control" id="nama_hijaiyah" name="nama_hijaiyah" placeholder="اسم الطالبة/سم الطالب" style="font-size: 20px;">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
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
                    <div class="col-md-6">
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
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
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



                    <div class="col-md-6">
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
                    <div class="col-md-6">
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

                    <div class="col-md-6">
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
                </div>

                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="jumlah_saudara">Jumlah Saudara</label>
                            <input type="number" class="form-control" name="jumlah_saudara" id="jumlah_saudara">
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
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-edit" class="modal-content">

            <input type="hidden" name="id" id="id">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Data Siswa</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nis_lokal">NIS Lokal</label>
                            <input type="text" class="form-control" id="nis_lokal" name="nis_lokal" placeholder="NIS Lokal">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control" id="nisn" name="nisn" placeholder="NISN">
                        </div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_hijaiyah">Nama Hijaiyah</label>
                            <input type="text" class="form-control" id="nama_hijaiyah" name="nama_hijaiyah" placeholder="اسم الطالبة/سم الطالب" style="font-size: 20px;">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                <option value=""></option>
                                <option value="l">Laki-laki</option>
                                <option value="p">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                </div>

                <div class="row">
                    <div class="col-md-6">
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