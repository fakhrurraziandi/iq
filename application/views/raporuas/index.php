<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Filter</div>
                </div>
                <div class="panel-body">
                    <form id="form-filter" action="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tahunajaran_id">Tahun Ajaran</label>
                                    <select name="tahunajaran_id" id="tahunajaran_id" class="form-control">
                                        <option value=""></option>
                                        <?php if($tahunajaran): foreach($tahunajaran as $ta): ?>
                                            <option value="<?php echo $ta->id ?>"><?php echo $ta->tahunajaran ?></option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester_id">Semester</label>
                                    <select name="semester_id" id="semester_id" class="form-control">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tingkat_id">Tingkat</label>
                                    <select name="tingkat_id" id="tingkat_id" class="form-control">
                                        <option value=""></option>
                                        <?php if($tingkat): foreach($tingkat as $tk): ?>
                                            <option value="<?php echo $tk->id ?>"><?php echo $tk->tingkat ?></option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kelas_id">Kelas Tujuan</label>
                                    <select name="kelas_id" id="kelas_id" class="form-control">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


	<div class="row" id="row-table" style="display: none;">
		

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Data Rapor Uas</div>
                </div>
                <div class="panel-body">
                    <table id="table"></table>
                </div>
            </div>
        </div>
	</div>
</div>







<div id="modal-add" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-add" class="modal-content">

            <input type="hidden" name="penempatansiswa_id" id="penempatansiswa_id">
            <input type="hidden" name="semester_id" id="semester_id">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Rapor Uas Untuk Siswa <span id="nama_siswa"></span></h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="kelakuan">Kelakuan</label>
                            <input type="text" class="form-control" id="kelakuan" name="kelakuan">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="kedisiplinan">Kedisiplinan</label>
                            <input type="text" class="form-control" id="kedisiplinan" name="kedisiplinan">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="kerapian">Kerapian</label>
                            <input type="text" class="form-control" id="kerapian" name="kerapian">
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
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-edit" class="modal-content">

            <input type="hidden" name="id" id="id">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Data Rapor Uas Untuk Siswa <span id="nama_siswa"></span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="kelakuan">Kelakuan</label>
                            <input type="text" class="form-control" id="kelakuan" name="kelakuan">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="kedisiplinan">Kedisiplinan</label>
                            <input type="text" class="form-control" id="kedisiplinan" name="kedisiplinan">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="kerapian">Kerapian</label>
                            <input type="text" class="form-control" id="kerapian" name="kerapian">
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






<script src="<?php echo base_url('assets/scripts/raporuas.js') ?>"></script>