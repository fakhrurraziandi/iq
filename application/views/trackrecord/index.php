
<input type="hidden" id="hidden_siswa_id" value="<?php echo $siswa_id ?>">

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title"><a href="<?php echo base_url('siswa') ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a> &nbsp;&nbsp;&nbsp;&nbsp;Data Track Record Siswa <strong><?php echo $siswa->nama ?></strong></div>
				</div>
				<div class="panel-body">
					<div id="table-toolbar">
						<a id="btn-add" href="" class="btn btn-primary btn-sm"><i class="fa fa-plus" title="Tambah Kelas"></i> Tambah</a>
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

            <input type="hidden" name="siswa_id" id="siswa_id" value="<?php echo $siswa_id ?>">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Track Record</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenistrackrecord_id">Jenis Track Record</label>
                            <select name="jenistrackrecord_id" id="jenistrackrecord_id" class="form-control">
                                <option value=""></option>
                                <?php if($jenistrackrecord): foreach($jenistrackrecord as $jtr): ?>
                                    <option value="<?php echo $jtr->id ?>"><?php echo $jtr->jenistrackrecord ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                   
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" class="form-control"></textarea>
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
            <input type="hidden" name="siswa_id" id="siswa_id" value="<?php echo $siswa_id ?>">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Track Record</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenistrackrecord_id">Jenis Track Record</label>
                            <select name="jenistrackrecord_id" id="jenistrackrecord_id" class="form-control">
                                <option value=""></option>
                                <?php if($jenistrackrecord): foreach($jenistrackrecord as $jtr): ?>
                                    <option value="<?php echo $jtr->id ?>"><?php echo $jtr->jenistrackrecord ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                   
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" class="form-control"></textarea>
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
                <h4 class="modal-title" id="myModalLabel">Hapus Track Record</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>Anda yakin ingin menghapus data <strong id="identifier">Kelas</strong>?</p>
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



<script src="<?php echo base_url('assets/scripts/trackrecord.js') ?>"></script>