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
                            <div class="col-md-2">
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

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="semester_id">Semester</label>
                                    <select name="semester_id" id="semester_id" class="form-control">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
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

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="kelas_id">Kelas Tujuan</label>
                                    <select name="kelas_id" id="kelas_id" class="form-control">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mapeldayah_id">Mapel Dayah</label>
                                    <select name="mapeldayah_id" id="mapeldayah_id" class="form-control">
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
                    <div class="panel-title">Data Penilaian Dayah</div>
                </div>
                <div class="panel-body">
                    <div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            
                            
                            <li role="presentation"><a href="#persentasepenilaian" aria-controls="persentasepenilaian" role="tab" data-toggle="tab">Persentase Penilaian</a></li>
                            <li role="presentation" class="active"><a href="#penilaian" aria-controls="penilaian" role="tab" data-toggle="tab">Penilaian</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane" id="persentasepenilaian">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="panel-title">Persentase Penilaian</div>
                                            </div>
                                            <div class="panel-body">
                                                <table id="table-persentasepenilaian"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div role="tabpanel" class="tab-pane active" id="penilaian">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="panel-title">Penilaian</div>
                                            </div>
                                            <div class="panel-body">
                                                <table id="table"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
	</div>
</div>







<div id="modal-add" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-add" class="modal-content">

            <input type="hidden" name="penempatansiswa_id" id="penempatansiswa_id">
            <input type="hidden" name="mapeldayah_id" id="mapeldayah_id">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Penilaian Untuk Siswa <span id="nama_siswa"></span></h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-12">
                        <h4>Pengetahuan</h4>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="pengetahuan_tnh">TNH</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="pengetahuan_tnh" name="pengetahuan_tnh" placeholder="TNH">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="pengetahuan_nilai_uts">Nilai UTS</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="pengetahuan_nilai_uts" name="pengetahuan_nilai_uts" placeholder="Nilai UTS">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="pengetahuan_nilai_uas">Nilai UAS</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="pengetahuan_nilai_uas" name="pengetahuan_nilai_uas" placeholder="Nilai UAS">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h4>Keterampilan</h4>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_tnh">TNH</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="keterampilan_tnh" name="keterampilan_tnh" placeholder="TNH">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_projek">Projek</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="keterampilan_projek" name="keterampilan_projek" placeholder="Projek">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_porto">Porto</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="keterampilan_porto" name="keterampilan_porto" placeholder="Porto">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_nilai_uts">Nilai UTS</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="keterampilan_nilai_uts" name="keterampilan_nilai_uts" placeholder="Nilai UTS">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_nilai_uas">Nilai UAS</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="keterampilan_nilai_uas" name="keterampilan_nilai_uas" placeholder="Nilai UAS">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <h4>Sikap</h4>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_tnh">TNH</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="sikap_tnh" name="sikap_tnh" placeholder="TNH">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_pd">PD</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="sikap_pd" name="sikap_pd" placeholder="PD">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_ps">PS</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="sikap_ps" name="sikap_ps" placeholder="PS">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_jurnal">Jurnal</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="sikap_jurnal" name="sikap_jurnal" placeholder="Jurnal">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_nilai_akhir">Nilai Akhir</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="sikap_nilai_akhir" name="sikap_nilai_akhir" placeholder="Nilai Akhir">
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
                <h4 class="modal-title" id="myModalLabel">Ubah Data Penilaian Untuk Siswa <span id="nama_siswa"></span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Pengetahuan</h4>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="pengetahuan_tnh">TNH</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="pengetahuan_tnh" name="pengetahuan_tnh" placeholder="TNH">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="pengetahuan_nilai_uts">Nilai UTS</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="pengetahuan_nilai_uts" name="pengetahuan_nilai_uts" placeholder="Nilai UTS">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="pengetahuan_nilai_uas">Nilai UAS</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="pengetahuan_nilai_uas" name="pengetahuan_nilai_uas" placeholder="Nilai UAS">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h4>Keterampilan</h4>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_tnh">TNH</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="keterampilan_tnh" name="keterampilan_tnh" placeholder="TNH">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_projek">Projek</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="keterampilan_projek" name="keterampilan_projek" placeholder="Projek">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_porto">Porto</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="keterampilan_porto" name="keterampilan_porto" placeholder="Porto">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_nilai_uts">Nilai UTS</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="keterampilan_nilai_uts" name="keterampilan_nilai_uts" placeholder="Nilai UTS">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_nilai_uas">Nilai UAS</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="keterampilan_nilai_uas" name="keterampilan_nilai_uas" placeholder="Nilai UAS">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <h4>Sikap</h4>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_tnh">TNH</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="sikap_tnh" name="sikap_tnh" placeholder="TNH">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_pd">PD</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="sikap_pd" name="sikap_pd" placeholder="PD">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_ps">PS</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="sikap_ps" name="sikap_ps" placeholder="PS">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_jurnal">Jurnal</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="sikap_jurnal" name="sikap_jurnal" placeholder="Jurnal">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_nilai_akhir">Nilai Akhir</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="sikap_nilai_akhir" name="sikap_nilai_akhir" placeholder="Nilai Akhir">
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



<!-- persentasepenilaian -->
<div id="modal-add-persentasepenilaian" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-add-persentasepenilaian" class="modal-content">

            <input type="hidden" name="mapeldayah_id" id="mapeldayah_id">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Persentase Penilaian</h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-12">
                        <h4>Pengetahuan</h4>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="pengetahuan_tnh">TNH</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="pengetahuan_tnh" name="pengetahuan_tnh" placeholder="TNH">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="pengetahuan_nilai_uts">Nilai UTS</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="pengetahuan_nilai_uts" name="pengetahuan_nilai_uts" placeholder="Nilai UTS">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="pengetahuan_nilai_uas">Nilai UAS</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="pengetahuan_nilai_uas" name="pengetahuan_nilai_uas" placeholder="Nilai UAS">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h4>Keterampilan</h4>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_tnh">TNH</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="keterampilan_tnh" name="keterampilan_tnh" placeholder="TNH">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_projek">Projek</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="keterampilan_projek" name="keterampilan_projek" placeholder="Projek">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_porto">Porto</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="keterampilan_porto" name="keterampilan_porto" placeholder="Porto">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_nilai_uts">Nilai UTS</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="keterampilan_nilai_uts" name="keterampilan_nilai_uts" placeholder="Nilai UTS">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_nilai_uas">Nilai UAS</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="keterampilan_nilai_uas" name="keterampilan_nilai_uas" placeholder="Nilai UAS">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <h4>Sikap</h4>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_tnh">TNH</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="sikap_tnh" name="sikap_tnh" placeholder="TNH">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_pd">PD</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="sikap_pd" name="sikap_pd" placeholder="PD">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_ps">PS</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="sikap_ps" name="sikap_ps" placeholder="PS">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_jurnal">Jurnal</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="sikap_jurnal" name="sikap_jurnal" placeholder="Jurnal">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_nilai_akhir">Nilai Akhir</label>
                            <input type="number" value="0" step="0.01" min="0" class="form-control" id="sikap_nilai_akhir" name="sikap_nilai_akhir" placeholder="Nilai Akhir">
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

<div id="modal-edit-persentasepenilaian" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-edit-persentasepenilaian" class="modal-content">

            <input type="hidden" name="id" id="id">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Data Persentase Penilaian </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Pengetahuan</h4>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="pengetahuan_tnh">TNH</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="pengetahuan_tnh" name="pengetahuan_tnh" placeholder="TNH">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="pengetahuan_nilai_uts">Nilai UTS</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="pengetahuan_nilai_uts" name="pengetahuan_nilai_uts" placeholder="Nilai UTS">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="pengetahuan_nilai_uas">Nilai UAS</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="pengetahuan_nilai_uas" name="pengetahuan_nilai_uas" placeholder="Nilai UAS">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h4>Keterampilan</h4>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_tnh">TNH</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="keterampilan_tnh" name="keterampilan_tnh" placeholder="TNH">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_projek">Projek</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="keterampilan_projek" name="keterampilan_projek" placeholder="Projek">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_porto">Porto</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="keterampilan_porto" name="keterampilan_porto" placeholder="Porto">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_nilai_uts">Nilai UTS</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="keterampilan_nilai_uts" name="keterampilan_nilai_uts" placeholder="Nilai UTS">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="keterampilan_nilai_uas">Nilai UAS</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="keterampilan_nilai_uas" name="keterampilan_nilai_uas" placeholder="Nilai UAS">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <h4>Sikap</h4>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_tnh">TNH</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="sikap_tnh" name="sikap_tnh" placeholder="TNH">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_pd">PD</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="sikap_pd" name="sikap_pd" placeholder="PD">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_ps">PS</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="sikap_ps" name="sikap_ps" placeholder="PS">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_jurnal">Jurnal</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="sikap_jurnal" name="sikap_jurnal" placeholder="Jurnal">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sikap_nilai_akhir">Nilai Akhir</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="sikap_nilai_akhir" name="sikap_nilai_akhir" placeholder="Nilai Akhir">
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



<script src="<?php echo base_url('assets/scripts/penilaianmapel.js') ?>"></script>