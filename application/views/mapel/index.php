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
		<div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Data Kelompok Mapel</div>
                </div>
                <div class="panel-body">
                    <div id="table-toolbar-kelompokmapel">
                        <a id="btn-add-kelompokmapel" href="" class="btn btn-primary btn-sm"><i class="fa fa-plus" title="Tambah Kelompok Mapel"></i></a>
                    </div>
                    <table id="table-kelompokmapel"></table>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Data Mapel</div>
                </div>
                <div class="panel-body">
                    <div id="table-toolbar">
                        <a id="btn-add" href="" class="btn btn-primary btn-sm"><i class="fa fa-plus" title="Tambah Mapel"></i> Mapel</a>
                        <a id="btn-add-sub" href="" class="btn btn-primary btn-sm"><i class="fa fa-plus" title="Tambah Mapel"></i> Sub Mapel</a>
                    </div>
                    <table id="table"></table>
                </div>
            </div>
        </div>
	</div>
</div>


<!-- Kelompok Mapel -->

<div id="modal-add-kelompokmapel" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-add-kelompokmapel" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Kelompok Mapel</h4>
            </div>
            <div class="modal-body">
                

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kelompokmapel">Kelompok Mapel</label>
                            <input type="text" class="form-control" id="kelompokmapel" name="kelompokmapel" placeholder="Kelompok Mapel">
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

<div id="modal-edit-kelompokmapel" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-edit-kelompokmapel" class="modal-content">

            <input type="hidden" name="id" id="id">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Data Kelompok Mapel</h4>
            </div>
            <div class="modal-body">
                

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kelompokmapel">Kelompok Mapel</label>
                            <input type="text" class="form-control" id="kelompokmapel" name="kelompokmapel" placeholder="Kelompok Mapel">
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

<div id="modal-delete-kelompokmapel" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-delete-kelompokmapel" class="modal-content">

            <input type="hidden" name="id" id="id">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Hapus Data Kelompok Mapel</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>Anda yakin ingin menghapus data <strong id="identifier">Kelompok Mapel</strong>?</p>
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


<!-- Mapel -->

<div id="modal-add" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-add" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Mapel</h4>
            </div>
            <div class="modal-body">
                

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kelompokmapel_id">Kelompok Mapel</label>
                            <select name="kelompokmapel_id" id="kelompokmapel_id" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="mapel">Mapel</label>
                            <input type="text" class="form-control" id="mapel" name="mapel" placeholder="Mapel">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="guru_id">Guru</label>
                            <select name="guru_id" id="guru_id" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kkm">KKM</label>
                            <input type="number" name="kkm" id="kkm" step="0.01" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="is_gabungan">Tata Cara Penilaian</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="is_gabungan" class="is_gabungan" value="0" checked=""> Normal
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label>
                                <input type="radio" name="is_gabungan" class="is_gabungan" value="1"> Gabungan Dari Mapel Dayah
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row row-mapeldayah" style="display: none;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mapeldayah_id">Mapel Dayah</label>
                            <select name="mapeldayah_id" id="mapeldayah_id" class="form-control" multiple="" style="height: 300px;">
                                <option value="">test</option>
                                <option value="">test</option>
                                <option value="">test</option>
                            </select>
                            <p class="help-block">Untuk memilih lebih dari satu mapel dayah, tekan tahan tombol CTRL dan click.</p>
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

<div id="modal-add-sub" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-add-sub" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Mapel</h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="parent_id">Parent</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="mapel">Mapel</label>
                            <input type="text" class="form-control" id="mapel" name="mapel" placeholder="Mapel">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="guru_id">Guru</label>
                            <select name="guru_id" id="guru_id" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kkm">KKM</label>
                            <input type="number" name="kkm" id="kkm" step="0.01" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="is_gabungan">Tata Cara Penilaian</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="is_gabungan" class="is_gabungan" value="0" checked=""> Normal
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label>
                                <input type="radio" name="is_gabungan" class="is_gabungan" value="1"> Gabungan Dari Mapel Dayah
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row row-mapeldayah" style="display: none;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mapeldayah_id">Mapel Dayah</label>
                            <select name="mapeldayah_id" id="mapeldayah_id" class="form-control" multiple="" style="height: 300px;">
                                <option value="">test</option>
                                <option value="">test</option>
                                <option value="">test</option>
                            </select>
                            <p class="help-block">Untuk memilih lebih dari satu mapel dayah, tekan tahan tombol CTRL dan click.</p>
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
                <h4 class="modal-title" id="myModalLabel">Ubah Data Mapel</h4>
            </div>
            <div class="modal-body">
                

                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kelompokmapel_id">Kelompok Mapel</label>
                            <select name="kelompokmapel_id" id="kelompokmapel_id" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="mapel">Mapel</label>
                            <input type="text" class="form-control" id="mapel" name="mapel" placeholder="Mapel">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="guru_id">Guru</label>
                            <select name="guru_id" id="guru_id" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kkm">KKM</label>
                            <input type="number" name="kkm" id="kkm" step="0.01" class="form-control">
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="is_gabungan">Tata Cara Penilaian</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="is_gabungan" class="is_gabungan" value="0" checked=""> Normal
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label>
                                <input type="radio" name="is_gabungan" class="is_gabungan" value="1"> Gabungan Dari Mapel Dayah
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row row-mapeldayah" style="display: none;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mapeldayah_id">Mapel Dayah</label>
                            <select name="mapeldayah_id" id="mapeldayah_id" class="form-control" multiple="" style="height: 300px;">
                                <option value="">test</option>
                                <option value="">test</option>
                                <option value="">test</option>
                            </select>
                            <p class="help-block">Untuk memilih lebih dari satu mapel dayah, tekan tahan tombol CTRL dan click.</p>
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

<div id="modal-edit-sub" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-edit-sub" class="modal-content">

            <input type="hidden" name="id" id="id">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Data Mapel</h4>
            </div>
            <div class="modal-body">
                

                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="parent_id">Parent</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="mapel">Mapel</label>
                            <input type="text" class="form-control" id="mapel" name="mapel" placeholder="Mapel">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="guru_id">Guru</label>
                            <select name="guru_id" id="guru_id" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kkm">KKM</label>
                            <input type="number" name="kkm" id="kkm" step="0.01" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="is_gabungan">Tata Cara Penilaian</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="is_gabungan" class="is_gabungan" value="0" checked=""> Normal
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label>
                                <input type="radio" name="is_gabungan" class="is_gabungan" value="1"> Gabungan Dari Mapel Dayah
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row row-mapeldayah" style="display: none;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mapeldayah_id">Mapel Dayah</label>
                            <select name="mapeldayah_id" id="mapeldayah_id" class="form-control" multiple="" style="height: 300px;">
                                <option value="">test</option>
                                <option value="">test</option>
                                <option value="">test</option>
                            </select>
                            <p class="help-block">Untuk memilih lebih dari satu mapel dayah, tekan tahan tombol CTRL dan click.</p>
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
                <h4 class="modal-title" id="myModalLabel">Hapus Data Mapel</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>Anda yakin ingin menghapus data <strong id="identifier">Mapel</strong>?</p>
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


<script src="<?php echo base_url('assets/scripts/mapel.js') ?>"></script>