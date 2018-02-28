<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">Data Tahun Ajaran</div>
				</div>
				<div class="panel-body">
					<div id="table-toolbar">
						<a id="btn-add" href="" class="btn btn-primary btn-sm"><i class="fa fa-plus" title="Tambah Tahun Ajaran"></i> Tambah</a>
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
                <h4 class="modal-title" id="myModalLabel">Tambah Data Tahun Ajaran</h4>
            </div>
            <div class="modal-body">
               

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun_awal">Tahun Awal</label>
                            <input type="number" class="form-control" id="tahun_awal" name="tahun_awal" placeholder="Tahun Awal">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun_akhir">Tahun Akhir</label>
                            <input type="number" class="form-control" id="tahun_akhir" name="tahun_akhir" placeholder="Tahun Akhir" readonly="">
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
                <h4 class="modal-title" id="myModalLabel">Ubah Data Tahun Ajaran</h4>
            </div>
            <div class="modal-body">
               

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun_awal">Tahun Awal</label>
                            <input type="number" class="form-control" id="tahun_awal" name="tahun_awal" placeholder="Tahun Awal">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun_akhir">Tahun Akhir</label>
                            <input type="number" class="form-control" id="tahun_akhir" name="tahun_akhir" placeholder="Tahun Akhir" readonly="">
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
                <h4 class="modal-title" id="myModalLabel">Hapus Data Tahun Ajaran</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>Anda yakin ingin menghapus data <strong id="identifier">Tahun Ajaran</strong>?</p>
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



<script src="<?php echo base_url('assets/scripts/tahunajaran.js') ?>"></script>