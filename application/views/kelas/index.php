<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">Data Kelas</div>
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
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Kelas</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahunajaran">Tahun Ajaran</label>
                            <select name="tahunajaran_id" id="tahunajaran_id" class="form-control">
                                <option value=""></option>
                                <?php if($tahunajaran): foreach($tahunajaran as $ta): ?>
                                    <option value="<?php echo $ta->id ?>"><?php echo $ta->tahunajaran ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="peminatan">Peminatan</label>
                            <select name="peminatan_id" id="peminatan_id" class="form-control">
                                <option value=""></option>
                                <?php if($peminatan): foreach($peminatan as $pm): ?>
                                    <option value="<?php echo $pm->id ?>"><?php echo $pm->peminatan ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                       <div class="form-group">
                            <label for="paralel">Paralel</label>
                            <input type="text" class="form-control" id="paralel" name="paralel" placeholder="Paralel">
                        </div>
                    </div>
                </div>

                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="guru">Wali Kelas</label>
                            <select name="guru_id" id="guru_id" class="form-control">
                                <option value=""></option>
                                <?php if($guru): foreach($guru as $gr): ?>
                                    <option value="<?php echo $gr->id ?>"><?php echo $gr->nama ?></option>
                                <?php endforeach; endif; ?>
                            </select>
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
                <h4 class="modal-title" id="myModalLabel">Ubah Data Kelas</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahunajaran">Tahun Ajaran</label>
                            <select name="tahunajaran_id" id="tahunajaran_id" class="form-control">
                                <option value=""></option>
                                <?php if($tahunajaran): foreach($tahunajaran as $ta): ?>
                                    <option value="<?php echo $ta->id ?>"><?php echo $ta->tahunajaran ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="peminatan">Peminatan</label>
                            <select name="peminatan_id" id="peminatan_id" class="form-control">
                                <option value=""></option>
                                <?php if($peminatan): foreach($peminatan as $pm): ?>
                                    <option value="<?php echo $pm->id ?>"><?php echo $pm->peminatan ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                       <div class="form-group">
                            <label for="paralel">Paralel</label>
                            <input type="text" class="form-control" id="paralel" name="paralel" placeholder="Paralel">
                        </div>
                    </div>
                </div>

                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="guru">Wali Kelas</label>
                            <select name="guru_id" id="guru_id" class="form-control">
                                <option value=""></option>
                                <?php if($guru): foreach($guru as $gr): ?>
                                    <option value="<?php echo $gr->id ?>"><?php echo $gr->nama ?></option>
                                <?php endforeach; endif; ?>
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
                <h4 class="modal-title" id="myModalLabel">Hapus Data Kelas</h4>
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



<script src="<?php echo base_url('assets/scripts/kelas.js') ?>"></script>