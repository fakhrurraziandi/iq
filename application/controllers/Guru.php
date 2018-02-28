<?php

require_once 'Backend.php';
require_once APPPATH . '/libraries/PHPExcel-1.8/Classes/PHPExcel.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends Backend {

	public function __construct(){
		parent::__construct();
		$this->load->helper('arabic_helper');
	}

	public function index(){
		
		$this->load->view('templates/header');
		$this->load->view('templates/nav-'. $this->session->userdata('group'));
		$this->load->view('guru/index');
		$this->load->view('templates/footer');
	}

	public function json_all(){
		header('Content-Type: application/json');
		$query = $this->db->query("SELECT * FROM guru ORDER BY guru.nama");
		if($query->num_rows()){
			echo json_encode($query->result());
		}else{
			echo json_encode([]);
		}
	}

	public function json(){

		header('Content-Type: application/json');

		$result = [
			'total' => 0,
			'rows' => []
		];

		$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 10;
		$offset = ($this->input->get('offset')) ? $this->input->get('offset') : 0;
		$search = ($this->input->get('search')) ? $this->input->get('search') : '';
		$sort   = ($this->input->get('sort')) ? $this->input->get('sort') : '';
		$order  = ($this->input->get('order')) ? $this->input->get('order') : '';

		$sql = "SELECT
					guru.id,
		            guru.nama,
					guru.kode,
					guru.nip_nignp,
					guru.nuptk_pegid,
					guru.nik_noktp,
					guru.tempat_lahir,
					guru.tanggal_lahir,
					guru.jenis_kelamin

		        FROM guru ";

		if($search !== ''){
		    $sql .= "WHERE
		                guru.nama LIKE '%". $search ."%' OR
		                guru.kode LIKE '%". $search ."%' OR
		                guru.nip_nignp LIKE '%". $search ."%' 
		                guru.nama LIKE '%". $search ."%' OR 
						guru.kode LIKE '%". $search ."%' OR 
						guru.nip_nignp LIKE '%". $search ."%' OR 
						guru.nuptk_pegid LIKE '%". $search ."%' OR 
						guru.nik_noktp LIKE '%". $search ."%' OR 
						guru.tempat_lahir LIKE '%". $search ."%' OR 
						guru.tanggal_lahir LIKE '%". $search ."%' OR 
						guru.jenis_kelamin LIKE '%". $search ."%' ";
		}

		if($sort !== ''){
		    $sql .= "ORDER BY guru.". $sort . " " . $order. " ";
		}else{
		    $sql .= "ORDER BY guru.nama ASC ";
		}



		$query = $this->db->query($sql);
		$result['total'] = $query->num_rows();

		$query_limit = $this->db->query($sql . " LIMIT ". $offset . ", ". $limit);
		$result['rows'] = $query_limit->result();


		echo json_encode($result);

	}


	public function cetak(){

		$objPHPExcel = PHPExcel_IOFactory::load('guru.xlsx');
		$objWorksheet = $objPHPExcel->getActiveSheet();

		$query = $this->db->query("SELECT
										guru.id,
										guru.nama,
										guru.kode,
										guru.nip_nignp,
										guru.nuptk_pegid,
										guru.nik_noktp,
										guru.tempat_lahir,
										guru.tanggal_lahir,
										guru.jenis_kelamin,
										guru.nama_ibu_kandung,
										guru.`pendidikan_terakhir--jenjang`,
										guru.`pendidikan_terakhir--kelompok_program_studi`,
										guru.status_kepegawaian,
										guru.`status_kepegawaian--status_inpassing`,
										guru.`status_kepegawaian--tmt_inpassing`,
										guru.`status_kepegawaian--golongan`,
										guru.`status_kepegawaian--tmt_sk_cpns`,
										guru.`status_kepegawaian--tmt_sk_awal`,
										guru.`status_kepagawaian--tmt_sk_akhir`,
										guru.`status_kepegawaian--instansi_yang_mengangkat`,
										guru.`status_kepegawaian--status_penugasan`,
										guru.`status_kepegawaian--gaji_pokok_perbulan`,
										guru.`status_kepegawaian--status_tempat_tugas`,
										guru.`status_kepegawaian--jenis_satminkal`,
										guru.`status_kepegawaian--npsn_satminkal`,
										guru.`status_kepegawaian--tugas_utama_di_madrasah_ini`,
										guru.`status_kepegawaian--status_keaktifan_personal`,
										guru.`tugas_utama_sebagai_pendidik--mapel_utama_yang_diampu`,
										guru.`tugas_utama_sebagai_pendidik--total_jam_tatap_muka_per_minggu`,
										guru.tugas_utama_sebagai_tenaga_kependidikan,
										guru.`tugas_tambahan--jenis_tugas`,
										guru.`tugas_tambahan--ekuivalensi_jam_tatap_muka`,
										guru.`tugas_mengajar_di_satuan_lain--jenis_tempat_tugas_lain`,
										guru.`tugas_mengajar_di_satuan_lain--npsn_tempat_tugas_lain`,
										guru.`tugas_mengajar_di_satuan_lain--mapel_yang_diampu`,
										guru.`tugas_mengajar_di_satuan_lain--jam_tatap_muka_per_minggu`,
										guru.`informasi_sertifikasi_pendidik--status_kepesertaan`,
										guru.`informasi_sertifikasi_pendidik--status_kelulusan`,
										guru.`informasi_sertifikasi_pendidik--tahun_lulus`,
										guru.`informasi_sertifikasi_pendidik--mapel_yang_disertifikasi`,
										guru.`informasi_sertifikasi_pendidik--nrg`,
										guru.`informasi_sertifikasi_pendidik--nomor_sk`,
										guru.`informasi_sertifikasi_pendidik--tanggal_sk_nrg`,
										guru.`informasi_tpg--status_penerima_tpg`,
										guru.`informasi_tpg--menerima_tpg_mulai_tahun`,
										guru.`informasi_tpg--besarnya_tpg_per_bulan`,
										guru.`informasi_tfg--status_penerima_tfg`,
										guru.`informasi_tfg--menerima_tfg_mulai_tahun`,
										guru.`informasi_tfg--besarnya_tfg_per_bulan`,
										guru.`penghargaan_tertinggi--apakah_pernah_memperoleh_penghargaan`,
										guru.`penghargaan_tertinggi--bidang_penghargaan`,
										guru.`penghargaan_tertinggi--tingkat_penghargaan`,
										guru.`penghargaan_tertinggi--tahun_perolehan_penghargaan`,
										guru.`pelatihan_kompetensi_kepribadian--keikutsertaan_pelatihan`,
										guru.`pelatihan_kompetensi_kepribadian--tahun_mengikuti`,
										guru.`pelatihan_kompetensi_manajerial--keikutsertaan_pelatihan`,
										guru.`pelatihan_kompetensi_manajerial--tahun_mengikuti`,
										guru.`pelatihan_kompetensi_kewirausahaan--keikutsertaan_pelatihan`,
										guru.`pelatihan_kompetensi_kewirausahaan--tahun_mengikuti`,
										guru.`pelatihan_kompetensi_supervisi--keikutsertaan_pelatihan`,
										guru.`pelatihan_kompetensi_supervisi--tahun_mengikuti`,
										guru.`pelatihan_kompetensi_sosial--keikutsertaan_pelatihan`,
										guru.`pelatihan_kompetensi_sosial--tahun_mengikuti`,
										guru.`alamat_tempat_tinggal_personal--alamat`,
										guru.`alamat_tempat_tinggal_personal--provinsi`,
										guru.`alamat_tempat_tinggal_personal--kab_kota`,
										guru.`alamat_tempat_tinggal_personal--kecamatan`,
										guru.`alamat_tempat_tinggal_personal--desa_kelurahan`,
										guru.`alamat_tempat_tinggal_personal--kode_pos`,
										guru.jarak_rumah_ke_madrasah_tempat_tugas,
										guru.transportasi_dari_rumah_ke_madrasah_tempat_tugas,
										guru.nomor_hp,
										guru.status_tempat_tinggal,
										guru.agama_ptk,
										guru.`riwayat_pendidikan_ptk--jenjang_s1_d4--program_studi`,
										guru.`riwayat_pendidikan_ptk--jenjang_s1_d4--gelar_akademik`,
										guru.`riwayat_pendidikan_ptk--jenjang_s1_d4--tahun_lulus`,
										guru.`riwayat_pendidikan_ptk--jenjang_s2--program_studi`,
										guru.`riwayat_pendidikan_ptk--jenjang_s2--gelar_akademik`,
										guru.`riwayat_pendidikan_ptk--jenjang_s2--tahun_lulus`,
										guru.`riwayat_pendidikan_ptk--jenjang_s3--program_studi`,
										guru.`riwayat_pendidikan_ptk--jenjang_s3--gelar_akademik`,
										guru.`riwayat_pendidikan_ptk--jenjang_s3--tahun_lulus`,
										guru.`tambahan_data_guru_tetap_non_pns--nomor_sk`,
										guru.`tambahan_data_guru_tetap_non_pns--tanggal_sk`,
										guru.`tambahan_data_inpassing_guru_non_pns--nomor_sk_inpassing`,
										guru.`tambahan_data_inpassing_guru_non_pns--tanggal_sk_inpassing`,
										guru.`sertifikasi_pendidik--nomor_peserta_sertifikasi`,
										guru.`sertifikasi_pendidik--jenis_jalur_sertifikasi`,
										guru.`sertifikasi_pendidik--tanggal_kelulusan_sertifikasi`,
										guru.`sertifikasi_pendidik--nomor_sertifikat_pendidik`,
										guru.`sertifikasi_pendidik--tanggal_penerbitan_sertifikat`,
										guru.`sertifikasi_pendidik--lptk_penyelenggara_sertifikasi--kode`,
										guru.`sertifikasi_pendidik--lptk_penyelenggara_sertifikasi--nama_lptk`
									FROM
										guru ");

		$guru = $query->result_array();

		echo '<pre>';
		print_r($guru);

		$x = 5;

		if($guru): foreach($guru as $g):
			$objWorksheet->setCellValue("K$x", $g['nip_nignp']);
			$objWorksheet->setCellValue("L$x", $g['nuptk_pegid']);
			$objWorksheet->setCellValue("M$x", $g['nama']);
			$objWorksheet->setCellValue("N$x", $g['nik_noktp']);
			$objWorksheet->setCellValue("O$x", $g['tempat_lahir']);
			$objWorksheet->setCellValue("P$x", $g['tanggal_lahir']);
			$objWorksheet->setCellValue("Q$x", $g['jenis_kelamin']);
			$objWorksheet->setCellValue("R$x", $g['nama_ibu_kandung']);
			$objWorksheet->setCellValue("S$x", $g['pendidikan_terakhir--jenjang']);
			$objWorksheet->setCellValue("T$x", $g['pendidikan_terakhir--kelompok_program_studi']);
			$objWorksheet->setCellValue("U$x", $g['status_kepegawaian']);
			$objWorksheet->setCellValue("V$x", $g['status_kepegawaian--status_inpassing']);
			$objWorksheet->setCellValue("W$x", $g['status_kepegawaian--tmt_inpassing']);
			$objWorksheet->setCellValue("X$x", $g['status_kepegawaian--golongan']);
			$objWorksheet->setCellValue("Y$x", $g['status_kepegawaian--tmt_sk_cpns']);
			$objWorksheet->setCellValue("Z$x", $g['status_kepegawaian--tmt_sk_awal']);
			$objWorksheet->setCellValue("AA$x", $g['status_kepegawaian--tmt_sk_akhir']);
			$objWorksheet->setCellValue("AB$x", $g['status_kepegawaian--instansi_yang_mengangkat']);
			$objWorksheet->setCellValue("AC$x", $g['status_kepegawaian--status_penugasan']);
			$objWorksheet->setCellValue("AD$x", $g['status_kepegawaian--gaji_pokok_perbulan']);
			$objWorksheet->setCellValue("AE$x", $g['status_kepegawaian--status_tempat_tugas']);

			$objWorksheet->setCellValue("AF$x", $g['status_kepegawaian--jenis_satminkal']);
			$objWorksheet->setCellValue("AG$x", $g['status_kepegawaian--npsn_satminkal']);
			$objWorksheet->setCellValue("AH$x", $g['status_kepegawaian--tugas_utama_di_madrasah_ini']);
			$objWorksheet->setCellValue("AI$x", $g['status_kepegawaian--status_keaktifan_personal']);
			$objWorksheet->setCellValue("AJ$x", $g['tugas_utama_sebagai_pendidik--mapel_utama_yang_diampu']);
			$objWorksheet->setCellValue("AK$x", $g['tugas_utama_sebagai_pendidik--total_jam_tatap_muka_per_minggu']);

			// asdjasgdkasdkasvdgjgashdgasdjg

			$objWorksheet->setCellValue("AL$x", $g['tugas_utama_sebagai_tenaga_kependidikan']);

			$objWorksheet->setCellValue("AM$x", $g['tugas_tambahan--jenis_tugas']);
			$objWorksheet->setCellValue("AN$x", $g['tugas_tambahan--ekuivalensi_jam_tatap_muka']);

			$objWorksheet->setCellValue("AO$x", $g['tugas_mengajar_di_satuan_lain--jenis_tempat_tugas_lain']);
			$objWorksheet->setCellValue("AP$x", $g['tugas_mengajar_di_satuan_lain--npsn_tempat_tugas_lain']);
			$objWorksheet->setCellValue("AQ$x", $g['tugas_mengajar_di_satuan_lain--mapel_yang_diampu']);
			$objWorksheet->setCellValue("AR$x", $g['tugas_mengajar_di_satuan_lain--jam_tatap_muka_per_minggu']);

			$objWorksheet->setCellValue("AS$x", $g['informasi_sertifikasi_pendidik--status_kepesertaan']);
			$objWorksheet->setCellValue("AT$x", $g['informasi_sertifikasi_pendidik--status_kelulusan']);
			$objWorksheet->setCellValue("AU$x", $g['informasi_sertifikasi_pendidik--tahun_lulus']);
			$objWorksheet->setCellValue("AV$x", $g['informasi_sertifikasi_pendidik--mapel_yang_disertifikasi']);
			$objWorksheet->setCellValue("AW$x", $g['informasi_sertifikasi_pendidik--nrg']);
			$objWorksheet->setCellValue("AX$x", $g['informasi_sertifikasi_pendidik--nomor_sk']);
			$objWorksheet->setCellValue("AY$x", $g['informasi_sertifikasi_pendidik--tanggal_sk_nrg']);

			$objWorksheet->setCellValue("AZ$x", $g['informasi_tpg--status_penerima_tpg']);
			$objWorksheet->setCellValue("BA$x", $g['informasi_tpg--menerima_tpg_mulai_tahun']);
			$objWorksheet->setCellValue("BB$x", $g['informasi_tpg--besarnya_tpg_per_bulan']);

			$objWorksheet->setCellValue("BC$x", $g['informasi_tfg--status_penerima_tfg']);
			$objWorksheet->setCellValue("BD$x", $g['informasi_tfg--menerima_tfg_mulai_tahun']);
			$objWorksheet->setCellValue("BE$x", $g['informasi_tfg--besarnya_tfg_per_bulan']);

			$objWorksheet->setCellValue("BF$x", $g['penghargaan_tertinggi--apakah_pernah_memperoleh_penghargaan']);
			$objWorksheet->setCellValue("BG$x", $g['penghargaan_tertinggi--bidang_penghargaan']);
			$objWorksheet->setCellValue("BH$x", $g['penghargaan_tertinggi--tingkat_penghargaan']);
			$objWorksheet->setCellValue("BI$x", $g['penghargaan_tertinggi--tahun_perolehan_penghargaan']);

			$objWorksheet->setCellValue("BJ$x", $g['pelatihan_kompetensi_kepribadian--keikutsertaan_pelatihan']);
			$objWorksheet->setCellValue("BK$x", $g['pelatihan_kompetensi_kepribadian--tahun_mengikuti']);

			$objWorksheet->setCellValue("BL$x", $g['pelatihan_kompetensi_manajerial--keikutsertaan_pelatihan']);
			$objWorksheet->setCellValue("BM$x", $g['pelatihan_kompetensi_manajerial--tahun_mengikuti']);

			$objWorksheet->setCellValue("BN$x", $g['pelatihan_kompetensi_kewirausahaan--keikutsertaan_pelatihan']);
			$objWorksheet->setCellValue("BO$x", $g['pelatihan_kompetensi_kewirausahaan--tahun_mengikuti']);

			$objWorksheet->setCellValue("BP$x", $g['pelatihan_kompetensi_supervisi--keikutsertaan_pelatihan']);
			$objWorksheet->setCellValue("BQ$x", $g['pelatihan_kompetensi_supervisi--tahun_mengikuti']);

			$objWorksheet->setCellValue("BR$x", $g['pelatihan_kompetensi_sosial--keikutsertaan_pelatihan']);
			$objWorksheet->setCellValue("BS$x", $g['pelatihan_kompetensi_sosial--tahun_mengikuti']);

			$objWorksheet->setCellValue("BT$x", $g['alamat_tempat_tinggal_personal--alamat']);
			$objWorksheet->setCellValue("BU$x", $g['alamat_tempat_tinggal_personal--provinsi']);
			$objWorksheet->setCellValue("BV$x", $g['alamat_tempat_tinggal_personal--kab_kota']);
			$objWorksheet->setCellValue("BW$x", $g['alamat_tempat_tinggal_personal--kecamatan']);
			$objWorksheet->setCellValue("BX$x", $g['alamat_tempat_tinggal_personal--desa_kelurahan']);
			$objWorksheet->setCellValue("BY$x", $g['alamat_tempat_tinggal_personal--kode_pos']);

			$objWorksheet->setCellValue("BZ$x", $g['jarak_rumah_ke_madrasah_tempat_tugas']);
			$objWorksheet->setCellValue("CA$x", $g['transportasi_dari_rumah_ke_madrasah_tempat_tugas']);
			$objWorksheet->setCellValue("CB$x", $g['nomor_hp']);
			$objWorksheet->setCellValue("CC$x", $g['status_tempat_tinggal']);
			$objWorksheet->setCellValue("CD$x", $g['agama_ptk']);

			$objWorksheet->setCellValue("CE$x", $g['riwayat_pendidikan_ptk--jenjang_s1_d4--program_studi']);
			$objWorksheet->setCellValue("CF$x", $g['riwayat_pendidikan_ptk--jenjang_s1_d4--gelar_akademik']);
			$objWorksheet->setCellValue("CG$x", $g['riwayat_pendidikan_ptk--jenjang_s1_d4--tahun_lulus']);

			$objWorksheet->setCellValue("CH$x", $g['riwayat_pendidikan_ptk--jenjang_s2--program_studi']);
			$objWorksheet->setCellValue("CI$x", $g['riwayat_pendidikan_ptk--jenjang_s2--gelar_akademik']);
			$objWorksheet->setCellValue("CJ$x", $g['riwayat_pendidikan_ptk--jenjang_s2--tahun_lulus']);

			$objWorksheet->setCellValue("CK$x", $g['riwayat_pendidikan_ptk--jenjang_s3--program_studi']);
			$objWorksheet->setCellValue("CL$x", $g['riwayat_pendidikan_ptk--jenjang_s3--gelar_akademik']);
			$objWorksheet->setCellValue("CM$x", $g['riwayat_pendidikan_ptk--jenjang_s3--tahun_lulus']);

			$objWorksheet->setCellValue("CN$x", $g['tambahan_data_guru_tetap_non_pns--nomor_sk']);
			$objWorksheet->setCellValue("CO$x", $g['tambahan_data_guru_tetap_non_pns--tanggal_sk']);

			$objWorksheet->setCellValue("CP$x", $g['tambahan_data_inpassing_guru_non_pns--nomor_sk_inpassing']);
			$objWorksheet->setCellValue("CQ$x", $g['tambahan_data_inpassing_guru_non_pns--tanggal_sk_inpassing']);

			$objWorksheet->setCellValue("CR$x", $g['sertifikasi_pendidik--nomor_peserta_sertifikasi']);
			$objWorksheet->setCellValue("CS$x", $g['sertifikasi_pendidik--jenis_jalur_sertifikasi']);
			$objWorksheet->setCellValue("CT$x", $g['sertifikasi_pendidik--tanggal_kelulusan_sertifikasi']);
			$objWorksheet->setCellValue("CU$x", $g['sertifikasi_pendidik--nomor_sertifikat_pendidik']);
			$objWorksheet->setCellValue("CV$x", $g['sertifikasi_pendidik--tanggal_penerbitan_sertifikat']);

			$objWorksheet->setCellValue("CW$x", $g['sertifikasi_pendidik--lptk_penyelenggara_sertifikasi--kode']);
			$objWorksheet->setCellValue("CX$x", $g['sertifikasi_pendidik--lptk_penyelenggara_sertifikasi--nama_lptk']);

			$x++;
		endforeach; endif;

		

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $filename = 'TP_';
		$objWriter->save($filename.'.xls');

		echo "<script>window.open('" . base_url($filename.'.xls') . "')</script>";
	}

	public function create(){

		header('Content-Type: application/json');

		$result = [
			'status' => 'success',
			'error_message' => [],
		];

		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('kode', 'kode', 'required');
		// $this->form_validation->set_rules('nip_nignp', 'nip_nignp', 'required');
		// $this->form_validation->set_rules('nuptk_pegid', 'nuptk_pegid', 'required');
		$this->form_validation->set_rules('nik_noktp', 'nik_noktp', 'required');
		$this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'required');
		$this->form_validation->set_rules('nama_ibu_kandung', 'nama_ibu_kandung', 'required');
		$this->form_validation->set_rules('agama_ptk', 'agama_ptk', 'required');

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$formData = [
				'`nama`'                                                            => $this->input->post('nama'),
				'`kode`'                                                            => $this->input->post('kode'),
				'`nip_nignp`'                                                       => $this->input->post('nip_nignp'),
				'`nuptk_pegid`'                                                     => $this->input->post('nuptk_pegid'),
				'`nik_noktp`'                                                       => $this->input->post('nik_noktp'),
				'`tempat_lahir`'                                                    => $this->input->post('tempat_lahir'),
				'`tanggal_lahir`'                                                   => $this->input->post('tanggal_lahir'),
				'`jenis_kelamin`'                                                   => $this->input->post('jenis_kelamin'),
				'`nama_ibu_kandung`'                                                => $this->input->post('nama_ibu_kandung'),
				'`pendidikan_terakhir--jenjang`'                                    => $this->input->post('pendidikan_terakhir--jenjang'),
				'`pendidikan_terakhir--kelompok_program_studi`'                     => $this->input->post('pendidikan_terakhir--kelompok_program_studi'),
				'`status_kepegawaian`'                                              => $this->input->post('status_kepegawaian'),
				'`status_kepegawaian--status_inpassing`'                            => $this->input->post('status_kepegawaian--status_inpassing'),
				'`status_kepegawaian--tmt_inpassing`'                               => $this->input->post('status_kepegawaian--tmt_inpassing'),
				'`status_kepegawaian--golongan`'                                    => $this->input->post('status_kepegawaian--golongan'),
				'`status_kepegawaian--tmt_sk_cpns`'                                 => $this->input->post('status_kepegawaian--tmt_sk_cpns'),
				'`status_kepegawaian--tmt_sk_awal`'                                 => $this->input->post('status_kepegawaian--tmt_sk_awal'),
				'`status_kepagawaian--tmt_sk_akhir`'                                => $this->input->post('status_kepagawaian--tmt_sk_akhir'),
				'`status_kepegawaian--instansi_yang_mengangkat`'                    => $this->input->post('status_kepegawaian--instansi_yang_mengangkat'),
				'`status_kepegawaian--status_penugasan`'                            => $this->input->post('status_kepegawaian--status_penugasan'),
				'`status_kepegawaian--gaji_pokok_perbulan`'                         => $this->input->post('status_kepegawaian--gaji_pokok_perbulan'),
				'`status_kepegawaian--status_tempat_tugas`'                         => $this->input->post('status_kepegawaian--status_tempat_tugas'),
				'`status_kepegawaian--jenis_satminkal`'                             => $this->input->post('status_kepegawaian--jenis_satminkal'),
				'`status_kepegawaian--npsn_satminkal`'                              => $this->input->post('status_kepegawaian--npsn_satminkal'),
				'`status_kepegawaian--tugas_utama_di_madrasah_ini`'                 => $this->input->post('status_kepegawaian--tugas_utama_di_madrasah_ini'),
				'`status_kepegawaian--status_keaktifan_personal`'                   => $this->input->post('status_kepegawaian--status_keaktifan_personal'),
				'`tugas_utama_sebagai_pendidik--mapel_utama_yang_diampu`'           => $this->input->post('tugas_utama_sebagai_pendidik--mapel_utama_yang_diampu'),
				'`tugas_utama_sebagai_pendidik--total_jam_tatap_muka_per_minggu`'   => $this->input->post('tugas_utama_sebagai_pendidik--total_jam_tatap_muka_per_minggu'),
				'`tugas_utama_sebagai_tenaga_kependidikan`'                         => $this->input->post('tugas_utama_sebagai_tenaga_kependidikan'),
				'`tugas_tambahan--jenis_tugas`'                                     => $this->input->post('tugas_tambahan--jenis_tugas'),
				'`tugas_tambahan--ekuivalensi_jam_tatap_muka`'                      => $this->input->post('tugas_tambahan--ekuivalensi_jam_tatap_muka'),
				'`tugas_mengajar_di_satuan_lain--jenis_tempat_tugas_lain`'          => $this->input->post('tugas_mengajar_di_satuan_lain--jenis_tempat_tugas_lain'),
				'`tugas_mengajar_di_satuan_lain--npsn_tempat_tugas_lain`'           => $this->input->post('tugas_mengajar_di_satuan_lain--npsn_tempat_tugas_lain'),
				'`tugas_mengajar_di_satuan_lain--mapel_yang_diampu`'                => $this->input->post('tugas_mengajar_di_satuan_lain--mapel_yang_diampu'),
				'`tugas_mengajar_di_satuan_lain--jam_tatap_muka_per_minggu`'        => $this->input->post('tugas_mengajar_di_satuan_lain--jam_tatap_muka_per_minggu'),
				'`informasi_sertifikasi_pendidik--status_kepesertaan`'              => $this->input->post('informasi_sertifikasi_pendidik--status_kepesertaan'),
				'`informasi_sertifikasi_pendidik--status_kelulusan`'                => $this->input->post('informasi_sertifikasi_pendidik--status_kelulusan'),
				'`informasi_sertifikasi_pendidik--tahun_lulus`'                     => $this->input->post('informasi_sertifikasi_pendidik--tahun_lulus'),
				'`informasi_sertifikasi_pendidik--mapel_yang_disertifikasi`'        => $this->input->post('informasi_sertifikasi_pendidik--mapel_yang_disertifikasi'),
				'`informasi_sertifikasi_pendidik--nrg`'                             => $this->input->post('informasi_sertifikasi_pendidik--nrg'),
				'`informasi_sertifikasi_pendidik--nomor_sk`'                    	=> $this->input->post('informasi_sertifikasi_pendidik--nomor_sk'),
				'`informasi_sertifikasi_pendidik--tanggal_sk_nrg`'                  => $this->input->post('informasi_sertifikasi_pendidik--tanggal_sk_nrg'),
				'`informasi_tpg--status_penerima_tpg`'                              => $this->input->post('informasi_tpg--status_penerima_tpg'),
				'`informasi_tpg--menerima_tpg_mulai_tahun`'                         => $this->input->post('informasi_tpg--menerima_tpg_mulai_tahun'),
				'`informasi_tpg--besarnya_tpg_per_bulan`'                           => $this->input->post('informasi_tpg--besarnya_tpg_per_bulan'),
				'`informasi_tfg--status_penerima_tfg`'                              => $this->input->post('informasi_tfg--status_penerima_tfg'),
				'`informasi_tfg--menerima_tfg_mulai_tahun`'                         => $this->input->post('informasi_tfg--menerima_tfg_mulai_tahun'),
				'`informasi_tfg--besarnya_tfg_per_bulan`'                           => $this->input->post('informasi_tfg--besarnya_tfg_per_bulan'),
				'`penghargaan_tertinggi--apakah_pernah_memperoleh_penghargaan`'     => $this->input->post('penghargaan_tertinggi--apakah_pernah_memperoleh_penghargaan'),
				'`penghargaan_tertinggi--bidang_penghargaan`'                       => $this->input->post('penghargaan_tertinggi--bidang_penghargaan'),
				'`penghargaan_tertinggi--tingkat_penghargaan`'                      => $this->input->post('penghargaan_tertinggi--tingkat_penghargaan'),
				'`penghargaan_tertinggi--tahun_perolehan_penghargaan`'              => $this->input->post('penghargaan_tertinggi--tahun_perolehan_penghargaan'),
				'`pelatihan_kompetensi_kepribadian--keikutsertaan_pelatihan`'       => $this->input->post('pelatihan_kompetensi_kepribadian--keikutsertaan_pelatihan'),
				'`pelatihan_kompetensi_kepribadian--tahun_mengikuti`'               => $this->input->post('pelatihan_kompetensi_kepribadian--tahun_mengikuti'),
				'`pelatihan_kompetensi_manajerial--keikutsertaan_pelatihan`'        => $this->input->post('pelatihan_kompetensi_manajerial--keikutsertaan_pelatihan'),
				'`pelatihan_kompetensi_manajerial--tahun_mengikuti`'                => $this->input->post('pelatihan_kompetensi_manajerial--tahun_mengikuti'),
				'`pelatihan_kompetensi_kewirausahaan--keikutsertaan_pelatihan`'     => $this->input->post('pelatihan_kompetensi_kewirausahaan--keikutsertaan_pelatihan'),
				'`pelatihan_kompetensi_kewirausahaan--tahun_mengikuti`'             => $this->input->post('pelatihan_kompetensi_kewirausahaan--tahun_mengikuti'),
				'`pelatihan_kompetensi_supervisi--keikutsertaan_pelatihan`'         => $this->input->post('pelatihan_kompetensi_supervisi--keikutsertaan_pelatihan'),
				'`pelatihan_kompetensi_supervisi--tahun_mengikuti`'                 => $this->input->post('pelatihan_kompetensi_supervisi--tahun_mengikuti'),
				'`pelatihan_kompetensi_sosial--keikutsertaan_pelatihan`'            => $this->input->post('pelatihan_kompetensi_sosial--keikutsertaan_pelatihan'),
				'`pelatihan_kompetensi_sosial--tahun_mengikuti`'                    => $this->input->post('pelatihan_kompetensi_sosial--tahun_mengikuti'),
				'`alamat_tempat_tinggal_personal--alamat`'                          => $this->input->post('alamat_tempat_tinggal_personal--alamat'),
				'`alamat_tempat_tinggal_personal--provinsi`'                        => $this->input->post('alamat_tempat_tinggal_personal--provinsi'),
				'`alamat_tempat_tinggal_personal--kab_kota`'                        => $this->input->post('alamat_tempat_tinggal_personal--kab_kota'),
				'`alamat_tempat_tinggal_personal--kecamatan`'                       => $this->input->post('alamat_tempat_tinggal_personal--kecamatan'),
				'`alamat_tempat_tinggal_personal--desa_kelurahan`'                  => $this->input->post('alamat_tempat_tinggal_personal--desa_kelurahan'),
				'`alamat_tempat_tinggal_personal--kode_pos`'                        => $this->input->post('alamat_tempat_tinggal_personal--kode_pos'),
				'`jarak_rumah_ke_madrasah_tempat_tugas`'                            => $this->input->post('jarak_rumah_ke_madrasah_tempat_tugas'),
				'`transportasi_dari_rumah_ke_madrasah_tempat_tugas`'                => $this->input->post('transportasi_dari_rumah_ke_madrasah_tempat_tugas'),
				'`nomor_hp`'                                                        => $this->input->post('nomor_hp'),
				'`status_tempat_tinggal`'                                           => $this->input->post('status_tempat_tinggal'),
				'`agama_ptk`'                                                       => $this->input->post('agama_ptk'),
				'`riwayat_pendidikan_ptk--jenjang_s1_d4--program_studi`'            => $this->input->post('riwayat_pendidikan_ptk--jenjang_s1_d4--program_studi'),
				'`riwayat_pendidikan_ptk--jenjang_s1_d4--gelar_akademik`'           => $this->input->post('riwayat_pendidikan_ptk--jenjang_s1_d4--gelar_akademik'),
				'`riwayat_pendidikan_ptk--jenjang_s1_d4--tahun_lulus`'              => $this->input->post('riwayat_pendidikan_ptk--jenjang_s1_d4--tahun_lulus'),
				'`riwayat_pendidikan_ptk--jenjang_s2--program_studi`'               => $this->input->post('riwayat_pendidikan_ptk--jenjang_s2--program_studi'),
				'`riwayat_pendidikan_ptk--jenjang_s2--gelar_akademik`'              => $this->input->post('riwayat_pendidikan_ptk--jenjang_s2--gelar_akademik'),
				'`riwayat_pendidikan_ptk--jenjang_s2--tahun_lulus`'                 => $this->input->post('riwayat_pendidikan_ptk--jenjang_s2--tahun_lulus'),
				'`riwayat_pendidikan_ptk--jenjang_s3--program_studi`'               => $this->input->post('riwayat_pendidikan_ptk--jenjang_s3--program_studi'),
				'`riwayat_pendidikan_ptk--jenjang_s3--gelar_akademik`'              => $this->input->post('riwayat_pendidikan_ptk--jenjang_s3--gelar_akademik'),
				'`riwayat_pendidikan_ptk--jenjang_s3--tahun_lulus`'                 => $this->input->post('riwayat_pendidikan_ptk--jenjang_s3--tahun_lulus'),
				'`tambahan_data_guru_tetap_non_pns--nomor_sk`'                      => $this->input->post('tambahan_data_guru_tetap_non_pns--nomor_sk'),
				'`tambahan_data_guru_tetap_non_pns--tanggal_sk`'                    => $this->input->post('tambahan_data_guru_tetap_non_pns--tanggal_sk'),
				'`tambahan_data_inpassing_guru_non_pns--nomor_sk_inpassing`'        => $this->input->post('tambahan_data_inpassing_guru_non_pns--nomor_sk_inpassing'),
				'`tambahan_data_inpassing_guru_non_pns--tanggal_sk_inpassing`'      => $this->input->post('tambahan_data_inpassing_guru_non_pns--tanggal_sk_inpassing'),
				'`sertifikasi_pendidik--nomor_peserta_sertifikasi`'                 => $this->input->post('sertifikasi_pendidik--nomor_peserta_sertifikasi'),
				'`sertifikasi_pendidik--jenis_jalur_sertifikasi`'                   => $this->input->post('sertifikasi_pendidik--jenis_jalur_sertifikasi'),
				'`sertifikasi_pendidik--tanggal_kelulusan_sertifikasi`'             => $this->input->post('sertifikasi_pendidik--tanggal_kelulusan_sertifikasi'),
				'`sertifikasi_pendidik--nomor_sertifikat_pendidik`'                 => $this->input->post('sertifikasi_pendidik--nomor_sertifikat_pendidik'),
				'`sertifikasi_pendidik--tanggal_penerbitan_sertifikat`'             => $this->input->post('sertifikasi_pendidik--tanggal_penerbitan_sertifikat'),
				'`sertifikasi_pendidik--lptk_penyelenggara_sertifikasi--kode`'      => $this->input->post('sertifikasi_pendidik--lptk_penyelenggara_sertifikasi--kode'),
				'`sertifikasi_pendidik--lptk_penyelenggara_sertifikasi--nama_lptk`' => $this->input->post('sertifikasi_pendidik--lptk_penyelenggara_sertifikasi--nama_lptk'),
			];




			$insert = $this->db->insert('guru', $formData);

			if($insert){
				$result['status'] = 'success';
			}else{
				$result['status'] = 'error';
			}
		}

		echo json_encode($result);
	}

	public function find(){

        header('Content-Type: application/json');
        $result = '';
        $data = [
            'id' => $this->input->get('id')
        ];
        $query = $this->db->get_where('guru', $data);
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

    public function update(){
        header('Content-Type: application/json');

        $result = [];

    	$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('kode', 'kode', 'required');
		$this->form_validation->set_rules('nip_nignp', 'nip_nignp', 'required');
			

        if($this->form_validation->run() == false){
            $result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();
        }else{
            $id = $this->input->post('id');
           
            $formData = [
				'nama' => $this->input->post('nama'),
				'kode' => $this->input->post('kode'),
				'nip_nignp'  => $this->input->post('nip_nignp'),
			];
            $this->db->where('id', $id);
            $query = $this->db->update('guru', $formData);
            if($query){
                $result['status'] = 'success';
            }else{
                $result['status'] = 'error';
            }
        }

        echo json_encode($result);
    }

    public function delete(){

        header('Content-Type: application/json');

        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $query = $this->db->delete('guru');
        if($query){
            $result['status'] = 'success';
        }else{
            $result['status'] = 'error';
        }

        echo json_encode($result);
    }
}