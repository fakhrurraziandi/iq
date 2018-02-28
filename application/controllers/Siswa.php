<?php

require_once 'Backend.php';
require_once APPPATH . '/libraries/PHPExcel-1.8/Classes/PHPExcel.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends Backend {

	public function __construct(){
		parent::__construct();
		$this->load->model('Tingkatmodel');
		$this->load->model('Tahunajaranmodel');

		$this->load->helper('siswa_helper');
	}

	public function index(){

		$data['tingkat'] = $this->Tingkatmodel->all();
		$data['tahunajaran'] = $this->Tahunajaranmodel->all();

		$this->load->view('templates/header');
		$this->load->view('templates/nav-'. $this->session->userdata('group'));
		$this->load->view('siswa/index', $data);
		$this->load->view('templates/footer');
	}

	public function cetak(){

		$objPHPExcel = PHPExcel_IOFactory::load('siswa.xlsx');
		$objWorksheet = $objPHPExcel->getActiveSheet();

		$tahunajaran_id = $this->input->get('tahunajaran_id');
		$tingkat_id = $this->input->get('tingkat_id');

		$query = $this->db->query("SELECT
										siswa.id,
										siswa.nisn,
										siswa.nis_lokal,
										siswa.nama,
										siswa.nama_hijaiyah,
										siswa.jenis_kelamin,
										siswa.tingkat_id,
										siswa.kelas_id,
										siswa.tahunajaran_id,
										siswa.tempat_lahir,
										siswa.tanggal_lahir,
										siswa.status_siswa,
										siswa.asal_sekolah,
										siswa.hobi,
										siswa.cita_cita,
										siswa.jumlah_saudara,
										siswa.`asal_sekolah_jenjang_sebelumnya--jenis_sekolah`,
										siswa.`asal_sekolah_jenjang_sebelumnya--status_sekolah`,
										siswa.`asal_sekolah_jenjang_sebelumnya--kab_kota`,
										siswa.`asal_sekolah_jenjang_sebelumnya--no_peserta-skhun`,
										siswa.`informasi_alamat_orangtua_wali--alamat`,
										siswa.`informasi_alamat_orangtua_wali--provinsi`,
										siswa.`informasi_alamat_orangtua_wali--kab_kota`,
										siswa.`informasi_alamat_orangtua_wali--kecamatan`,
										siswa.`informasi_alamat_orangtua_wali--desa_kelurahan`,
										siswa.`informasi_alamat_orangtua_wali--kode_pos`,
										siswa.jarak_rumah_siswa_ke_madrasah,
										siswa.transportasi_dari_rumah_ke_madrasah,
										siswa.`informasi_kebutuhan_khusus--tuna_rungu`,
										siswa.`informasi_kebutuhan_khusus--tuna_netra`,
										siswa.`informasi_kebutuhan_khusus--tuna_daksa`,
										siswa.`informasi_kebutuhan_khusus--tuna_grahita`,
										siswa.`informasi_kebutuhan_khusus--tuna_laras`,
										siswa.`informasi_kebutuhan_khusus--lamban_belajar`,
										siswa.`informasi_kebutuhan_khusus--sulit_belajar`,
										siswa.`informasi_kebutuhan_khusus--gangguan_komunikasi`,
										siswa.`informasi_kebutuhan_khusus--bakat_luar_biasa`,
										siswa.`informasi_orangtua_wali--no_kk`,
										siswa.`informasi_orangtua_wali--ayah_wali--nama_lengkap`,
										siswa.`informasi_orangtua_wali--ayah_wali--nik_noktp`,
										siswa.`informasi_orangtua_wali--ayah_wali--pendidikan`,
										siswa.`informasi_orangtua_wali--ayah_wali--pekerjaan`,
										siswa.`informasi_orangtua_wali--ibu_wali--nama_lengkap`,
										siswa.`informasi_orangtua_wali--ibu_wali--nik_noktp`,
										siswa.`informasi_orangtua_wali--ibu_wali--pendidikan`,
										siswa.`informasi_orangtua_wali--ibu_wali--pekerjaan`,
										siswa.`informasi_orangtua_wali--rata_rata_penghasilan_perbulan`,
										siswa.`program_indonesia_pintar_bsm--status_penerima`,
										siswa.`program_indonesia_pintar_bsm--alasan_menerima`,
										siswa.`program_indonesia_pintar_bsm--periode_menerima`,
										siswa.`prestasi_tertinggi--bidang_prestasi`,
										siswa.`prestasi_tertinggi--tingkat-prestasi`,
										siswa.`prestasi_tertinggi--peringkat_yang_diraih`,
										siswa.`prestasi_tertinggi--tahun_meraih_prestasi`,
										siswa.`beasiswa--status_beasiswa`,
										siswa.`beasiswa--sumber_beasiswa`,
										siswa.no_kks_kps,
										siswa.no_kartu_pkh,
										siswa.no_kip,
										kelas.tingkat_id,
										kelas.peminatan_id,
										kelas.paralel,
										kelas.guru_id,
										kelas.tahunajaran_id,
										peminatan.peminatan
									FROM
										siswa
									LEFT JOIN kelas ON siswa.kelas_id = kelas.id
									LEFT JOIN peminatan ON kelas.peminatan_id = kelas.id
									WHERE siswa.tahunajaran_id = {$tahunajaran_id} AND siswa.tingkat_id IN ({$tingkat_id})");

		$siswa = $query->result_array();

		echo '<pre>';
		print_r($siswa);

		$x = 5;

		if($siswa): foreach($siswa as $s):
			$objWorksheet->setCellValue("K$x", $s['nis_lokal']);
			$objWorksheet->setCellValue("L$x", $s['nisn']);
			$objWorksheet->setCellValue("M$x", '');
			$objWorksheet->setCellValue("N$x", $s['nama']);
			$objWorksheet->setCellValue("O$x", $s['tempat_lahir']);
			$objWorksheet->setCellValue("P$x", $s['tanggal_lahir']);
			$objWorksheet->setCellValue("Q$x", $s['jenis_kelamin']);
			$objWorksheet->setCellValue("R$x", $s['tingkat_id']);
			$objWorksheet->setCellValue("S$x", $s['peminatan']);
			$objWorksheet->setCellValue("T$x", $s['paralel']);
			$objWorksheet->setCellValue("U$x", '');
			$objWorksheet->setCellValue("V$x", '');
			$objWorksheet->setCellValue("W$x", $s['status_siswa']);
			$objWorksheet->setCellValue("X$x", $s['asal_sekolah']);
			$objWorksheet->setCellValue("Y$x", $s['hobi']);
			$objWorksheet->setCellValue("Z$x", $s['cita_cita']);
			$objWorksheet->setCellValue("AA$x", $s['jumlah_saudara']);
			$objWorksheet->setCellValue("AB$x", $s['asal_sekolah_jenjang_sebelumnya--jenis_sekolah']);
			$objWorksheet->setCellValue("AC$x", $s['asal_sekolah_jenjang_sebelumnya--status_sekolah']);
			$objWorksheet->setCellValue("AD$x", $s['asal_sekolah_jenjang_sebelumnya--kab_kota']);
			$objWorksheet->setCellValue("AE$x", $s['asal_sekolah_jenjang_sebelumnya--no_peserta-skhun']);

			$objWorksheet->setCellValue("AF$x", $s['informasi_alamat_orangtua_wali--alamat']);
			$objWorksheet->setCellValue("AG$x", $s['informasi_alamat_orangtua_wali--provinsi']);
			$objWorksheet->setCellValue("AH$x", $s['informasi_alamat_orangtua_wali--kab_kota']);
			$objWorksheet->setCellValue("AI$x", $s['informasi_alamat_orangtua_wali--kecamatan']);
			$objWorksheet->setCellValue("AJ$x", $s['informasi_alamat_orangtua_wali--desa_kelurahan']);
			$objWorksheet->setCellValue("AK$x", $s['informasi_alamat_orangtua_wali--kode_pos']);

			$objWorksheet->setCellValue("AL$x", $s['jarak_rumah_siswa_ke_madrasah']);
			$objWorksheet->setCellValue("AM$x", $s['transportasi_dari_rumah_ke_madrasah']);

			$objWorksheet->setCellValue("AN$x", $s['informasi_kebutuhan_khusus--tuna_rungu']);
			$objWorksheet->setCellValue("AO$x", $s['informasi_kebutuhan_khusus--tuna_netra']);
			$objWorksheet->setCellValue("AP$x", $s['informasi_kebutuhan_khusus--tuna_daksa']);
			$objWorksheet->setCellValue("AQ$x", $s['informasi_kebutuhan_khusus--tuna_grahita']);
			$objWorksheet->setCellValue("AR$x", $s['informasi_kebutuhan_khusus--tuna_laras']);
			$objWorksheet->setCellValue("AS$x", $s['informasi_kebutuhan_khusus--lamban_belajar']);
			$objWorksheet->setCellValue("AT$x", $s['informasi_kebutuhan_khusus--sulit_belajar']);
			$objWorksheet->setCellValue("AU$x", $s['informasi_kebutuhan_khusus--gangguan_komunikasi']);
			$objWorksheet->setCellValue("AV$x", $s['informasi_kebutuhan_khusus--bakat_luar_biasa']);

			$objWorksheet->setCellValue("AW$x", $s['informasi_orangtua_wali--no_kk']);
			$objWorksheet->setCellValue("AX$x", $s['informasi_orangtua_wali--ayah_wali--nama_lengkap']);
			$objWorksheet->setCellValue("AY$x", $s['informasi_orangtua_wali--ayah_wali--nik_noktp']);
			$objWorksheet->setCellValue("AZ$x", $s['informasi_orangtua_wali--ayah_wali--pendidikan']);
			$objWorksheet->setCellValue("BA$x", $s['informasi_orangtua_wali--ayah_wali--pekerjaan']);
			$objWorksheet->setCellValue("BB$x", $s['informasi_orangtua_wali--ibu_wali--nama_lengkap']);
			$objWorksheet->setCellValue("BC$x", $s['informasi_orangtua_wali--ibu_wali--nik_noktp']);
			$objWorksheet->setCellValue("BD$x", $s['informasi_orangtua_wali--ibu_wali--pendidikan']);
			$objWorksheet->setCellValue("BE$x", $s['informasi_orangtua_wali--ibu_wali--pekerjaan']);
			$objWorksheet->setCellValue("BF$x", $s['informasi_orangtua_wali--rata_rata_penghasilan_perbulan']);

			$objWorksheet->setCellValue("BG$x", '');
			$objWorksheet->setCellValue("BH$x", '');
			$objWorksheet->setCellValue("BI$x", '');

			$objWorksheet->setCellValue("BJ$x", $s['program_indonesia_pintar_bsm--status_penerima']);
			$objWorksheet->setCellValue("BK$x", $s['program_indonesia_pintar_bsm--alasan_menerima']);
			$objWorksheet->setCellValue("BL$x", $s['program_indonesia_pintar_bsm--periode_menerima']);

			$objWorksheet->setCellValue("BM$x", $s['prestasi_tertinggi--bidang_prestasi']);
			$objWorksheet->setCellValue("BN$x", $s['prestasi_tertinggi--tingkat-prestasi']);
			$objWorksheet->setCellValue("BO$x", $s['prestasi_tertinggi--peringkat_yang_diraih']);
			$objWorksheet->setCellValue("BP$x", $s['prestasi_tertinggi--tahun_meraih_prestasi']);

			$objWorksheet->setCellValue("BQ$x", $s['beasiswa--status_beasiswa']);
			$objWorksheet->setCellValue("BR$x", $s['beasiswa--sumber_beasiswa']);

			




			echo get_status_siswa($s->status_siswa);

			$x++;
		endforeach; endif;

		

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $filename = 'TP_';
		$objWriter->save($filename.'.xls');

		echo "<script>window.open('" . base_url($filename.'.xls') . "')</script>";
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

		$sql = "SELECT * FROM (
			SELECT
				siswa.id,
				siswa.nisn,
				siswa.nis_lokal,
				siswa.nama,
				siswa.nama_hijaiyah,
				siswa.jenis_kelamin,
				siswa.tingkat_id,
				siswa.kelas_id,
				tingkat.tingkat
			FROM
				siswa
			LEFT JOIN tingkat ON tingkat.id = siswa.tingkat_id
		) x ";

		if($search !== ''){
		    $sql .= "WHERE
		                x.id LIKE '%". $search ."%' OR
		                x.nisn LIKE '%". $search ."%' OR
		                x.nis_lokal LIKE '%". $search ."%' OR
		                x.nama LIKE '%". $search ."%' OR
		                x.nama_hijaiyah LIKE '%". $search ."%' OR
		                x.jenis_kelamin LIKE '%". $search ."%' OR
		                x.tingkat LIKE '%". $search ."%' ";
		}

		if($sort !== ''){
		    $sql .= "ORDER BY x.". $sort . " " . $order. " ";
		}else{
		    $sql .= "ORDER BY x.nisn ASC ";
		}

		$query = $this->db->query($sql);
		$result['total'] = $query->num_rows();

		$query_limit = $this->db->query($sql . " LIMIT ". $offset . ", ". $limit);
		$result['rows'] = $query_limit->result();


		echo json_encode($result);

	}

	public function create(){

		header('Content-Type: application/json');

		$result = [
			'status' => 'success',
			'error_message' => [],
		];

		// $this->form_validation->set_rules('nisn', 'nisn', 'required');
		$this->form_validation->set_rules('nis_lokal', 'NIS Lokal', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('nama_hijaiyah', 'Nama hijaiyah', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('tingkat_id', 'Tingkat', 'required');
		$this->form_validation->set_rules('tahunajaran_id', 'Tahun ajaran', 'required');

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$formData = [
				/*'nisn'          => $this->input->post('nisn'),
				'nis_lokal'     => $this->input->post('nis_lokal'),
				'nama'          => $this->input->post('nama'),
				'nama_hijaiyah' => $this->input->post('nama_hijaiyah'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tingkat_id'    => $this->input->post('tingkat_id'),
				'tahunajaran_id'    => $this->input->post('tahunajaran_id'),*/

				'nisn'                                                    => $this->input->post('nisn'),
				'nis_lokal'                                               => $this->input->post('nis_lokal'),
				'nama'                                                    => $this->input->post('nama'),
				'nama_hijaiyah'                                           => $this->input->post('nama_hijaiyah'),
				'jenis_kelamin'                                           => $this->input->post('jenis_kelamin'),
				'tingkat_id'                                              => $this->input->post('tingkat_id'),
				'kelas_id'                                                => $this->input->post('kelas_id'),
				'tahunajaran_id'                                          => $this->input->post('tahunajaran_id'),
				'tempat_lahir'                                            => $this->input->post('tempat_lahir'),
				'tanggal_lahir'                                           => $this->input->post('tanggal_lahir'),
				'status_siswa'                                            => $this->input->post('status_siswa'),
				'asal_sekolah'                                            => $this->input->post('asal_sekolah'),
				'hobi'                                                    => $this->input->post('hobi'),
				'cita_cita'                                               => $this->input->post('cita_cita'),
				'jumlah_saudara'                                          => $this->input->post('jumlah_saudara'),
				'asal_sekolah_jenjang_sebelumnya--jenis_sekolah'          => $this->input->post('asal_sekolah_jenjang_sebelumnya--jenis_sekolah'),
				'asal_sekolah_jenjang_sebelumnya--status_sekolah'         => $this->input->post('asal_sekolah_jenjang_sebelumnya--status_sekolah'),
				'asal_sekolah_jenjang_sebelumnya--kab_kota'               => $this->input->post('asal_sekolah_jenjang_sebelumnya--kab_kota'),
				'asal_sekolah_jenjang_sebelumnya--no_peserta-skhun'       => $this->input->post('asal_sekolah_jenjang_sebelumnya--no_peserta-skhun'),
				'informasi_alamat_orangtua_wali--alamat'                  => $this->input->post('informasi_alamat_orangtua_wali--alamat'),
				'informasi_alamat_orangtua_wali--provinsi'                => $this->input->post('informasi_alamat_orangtua_wali--provinsi'),
				'informasi_alamat_orangtua_wali--kab_kota'                => $this->input->post('informasi_alamat_orangtua_wali--kab_kota'),
				'informasi_alamat_orangtua_wali--kecamatan'               => $this->input->post('informasi_alamat_orangtua_wali--kecamatan'),
				'informasi_alamat_orangtua_wali--desa_kelurahan'          => $this->input->post('informasi_alamat_orangtua_wali--desa_kelurahan'),
				'informasi_alamat_orangtua_wali--kode_pos'                => $this->input->post('informasi_alamat_orangtua_wali--kode_pos'),
				'jarak_rumah_siswa_ke_madrasah'                           => $this->input->post('jarak_rumah_siswa_ke_madrasah'),
				'transportasi_dari_rumah_ke_madrasah'                     => $this->input->post('transportasi_dari_rumah_ke_madrasah'),
				'informasi_kebutuhan_khusus--tuna_rungu'                  => $this->input->post('informasi_kebutuhan_khusus--tuna_rungu'),
				'informasi_kebutuhan_khusus--tuna_netra'                  => $this->input->post('informasi_kebutuhan_khusus--tuna_netra'),
				'informasi_kebutuhan_khusus--tuna_daksa'                  => $this->input->post('informasi_kebutuhan_khusus--tuna_daksa'),
				'informasi_kebutuhan_khusus--tuna_grahita'                => $this->input->post('informasi_kebutuhan_khusus--tuna_grahita'),
				'informasi_kebutuhan_khusus--tuna_laras'                  => $this->input->post('informasi_kebutuhan_khusus--tuna_laras'),
				'informasi_kebutuhan_khusus--lamban_belajar'              => $this->input->post('informasi_kebutuhan_khusus--lamban_belajar'),
				'informasi_kebutuhan_khusus--sulit_belajar'               => $this->input->post('informasi_kebutuhan_khusus--sulit_belajar'),
				'informasi_kebutuhan_khusus--gangguan_komunikasi'         => $this->input->post('informasi_kebutuhan_khusus--gangguan_komunikasi'),
				'informasi_kebutuhan_khusus--bakat_luar_biasa'            => $this->input->post('informasi_kebutuhan_khusus--bakat_luar_biasa'),
				'informasi_orangtua_wali--no_kk'                          => $this->input->post('informasi_orangtua_wali--no_kk'),
				'informasi_orangtua_wali--ayah_wali--nama_lengkap'        => $this->input->post('informasi_orangtua_wali--ayah_wali--nama_lengkap'),
				'informasi_orangtua_wali--ayah_wali--nik_noktp'           => $this->input->post('informasi_orangtua_wali--ayah_wali--nik_noktp'),
				'informasi_orangtua_wali--ayah_wali--pendidikan'          => $this->input->post('informasi_orangtua_wali--ayah_wali--pendidikan'),
				'informasi_orangtua_wali--ayah_wali--pekerjaan'           => $this->input->post('informasi_orangtua_wali--ayah_wali--pekerjaan'),
				'informasi_orangtua_wali--ibu_wali--nama_lengkap'         => $this->input->post('informasi_orangtua_wali--ibu_wali--nama_lengkap'),
				'informasi_orangtua_wali--ibu_wali--nik_noktp'            => $this->input->post('informasi_orangtua_wali--ibu_wali--nik_noktp'),
				'informasi_orangtua_wali--ibu_wali--pendidikan'           => $this->input->post('informasi_orangtua_wali--ibu_wali--pendidikan'),
				'informasi_orangtua_wali--ibu_wali--pekerjaan'            => $this->input->post('informasi_orangtua_wali--ibu_wali--pekerjaan'),
				'informasi_orangtua_wali--rata_rata_penghasilan_perbulan' => $this->input->post('informasi_orangtua_wali--rata_rata_penghasilan_perbulan'),
				'program_indonesia_pintar_bsm--status_penerima'           => $this->input->post('program_indonesia_pintar_bsm--status_penerima'),
				'program_indonesia_pintar_bsm--alasan_menerima'           => $this->input->post('program_indonesia_pintar_bsm--alasan_menerima'),
				'program_indonesia_pintar_bsm--periode_menerima'          => $this->input->post('program_indonesia_pintar_bsm--periode_menerima'),
				'prestasi_tertinggi--bidang_prestasi'                     => $this->input->post('prestasi_tertinggi--bidang_prestasi'),
				'prestasi_tertinggi--tingkat-prestasi'                    => $this->input->post('prestasi_tertinggi--tingkat-prestasi'),
				'prestasi_tertinggi--peringkat_yang_diraih'               => $this->input->post('prestasi_tertinggi--peringkat_yang_diraih'),
				'prestasi_tertinggi--tahun_meraih_prestasi'               => $this->input->post('prestasi_tertinggi--tahun_meraih_prestasi'),
				'beasiswa--status_beasiswa'                               => $this->input->post('beasiswa--status_beasiswa'),
				'beasiswa--sumber_beasiswa'                               => $this->input->post('beasiswa--sumber_beasiswa'),
				'no_kks_kps'                                              => $this->input->post('no_kks_kps'),
				'no_kartu_pkh'                                            => $this->input->post('no_kartu_pkh'),
				'no_kip'                                                  => $this->input->post('no_kip'),

			];

			$insert = $this->db->insert('siswa', $formData);

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
        $query = $this->db->get_where('siswa', $data);
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

    public function update(){
        header('Content-Type: application/json');

        $result = [];

        // $this->form_validation->set_rules('nisn', 'NISN', 'required');
        $this->form_validation->set_rules('nis_lokal', 'NIS Lokal', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nama_hijaiyah', 'Nama Hijaiyah', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tingkat_id', 'Tingkat', 'required');
        $this->form_validation->set_rules('tahunajaran_id', 'Tahun Ajaran', 'required');

        if($this->form_validation->run() == false){
            $result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();
        }else{
            $id = $this->input->post('id');
            $data = [
				'nisn'                                                    => $this->input->post('nisn'),
				'nis_lokal'                                               => $this->input->post('nis_lokal'),
				'nama'                                                    => $this->input->post('nama'),
				'nama_hijaiyah'                                           => $this->input->post('nama_hijaiyah'),
				'jenis_kelamin'                                           => $this->input->post('jenis_kelamin'),
				'tingkat_id'                                              => $this->input->post('tingkat_id'),
				'kelas_id'                                                => $this->input->post('kelas_id'),
				'tahunajaran_id'                                          => $this->input->post('tahunajaran_id'),
				'tempat_lahir'                                            => $this->input->post('tempat_lahir'),
				'tanggal_lahir'                                           => $this->input->post('tanggal_lahir'),
				'status_siswa'                                            => $this->input->post('status_siswa'),
				'asal_sekolah'                                            => $this->input->post('asal_sekolah'),
				'hobi'                                                    => $this->input->post('hobi'),
				'cita_cita'                                               => $this->input->post('cita_cita'),
				'jumlah_saudara'                                          => $this->input->post('jumlah_saudara'),
				'asal_sekolah_jenjang_sebelumnya--jenis_sekolah'          => $this->input->post('asal_sekolah_jenjang_sebelumnya--jenis_sekolah'),
				'asal_sekolah_jenjang_sebelumnya--status_sekolah'         => $this->input->post('asal_sekolah_jenjang_sebelumnya--status_sekolah'),
				'asal_sekolah_jenjang_sebelumnya--kab_kota'               => $this->input->post('asal_sekolah_jenjang_sebelumnya--kab_kota'),
				'asal_sekolah_jenjang_sebelumnya--no_peserta-skhun'       => $this->input->post('asal_sekolah_jenjang_sebelumnya--no_peserta-skhun'),
				'informasi_alamat_orangtua_wali--alamat'                  => $this->input->post('informasi_alamat_orangtua_wali--alamat'),
				'informasi_alamat_orangtua_wali--provinsi'                => $this->input->post('informasi_alamat_orangtua_wali--provinsi'),
				'informasi_alamat_orangtua_wali--kab_kota'                => $this->input->post('informasi_alamat_orangtua_wali--kab_kota'),
				'informasi_alamat_orangtua_wali--kecamatan'               => $this->input->post('informasi_alamat_orangtua_wali--kecamatan'),
				'informasi_alamat_orangtua_wali--desa_kelurahan'          => $this->input->post('informasi_alamat_orangtua_wali--desa_kelurahan'),
				'informasi_alamat_orangtua_wali--kode_pos'                => $this->input->post('informasi_alamat_orangtua_wali--kode_pos'),
				'jarak_rumah_siswa_ke_madrasah'                           => $this->input->post('jarak_rumah_siswa_ke_madrasah'),
				'transportasi_dari_rumah_ke_madrasah'                     => $this->input->post('transportasi_dari_rumah_ke_madrasah'),
				'informasi_kebutuhan_khusus--tuna_rungu'                  => $this->input->post('informasi_kebutuhan_khusus--tuna_rungu'),
				'informasi_kebutuhan_khusus--tuna_netra'                  => $this->input->post('informasi_kebutuhan_khusus--tuna_netra'),
				'informasi_kebutuhan_khusus--tuna_daksa'                  => $this->input->post('informasi_kebutuhan_khusus--tuna_daksa'),
				'informasi_kebutuhan_khusus--tuna_grahita'                => $this->input->post('informasi_kebutuhan_khusus--tuna_grahita'),
				'informasi_kebutuhan_khusus--tuna_laras'                  => $this->input->post('informasi_kebutuhan_khusus--tuna_laras'),
				'informasi_kebutuhan_khusus--lamban_belajar'              => $this->input->post('informasi_kebutuhan_khusus--lamban_belajar'),
				'informasi_kebutuhan_khusus--sulit_belajar'               => $this->input->post('informasi_kebutuhan_khusus--sulit_belajar'),
				'informasi_kebutuhan_khusus--gangguan_komunikasi'         => $this->input->post('informasi_kebutuhan_khusus--gangguan_komunikasi'),
				'informasi_kebutuhan_khusus--bakat_luar_biasa'            => $this->input->post('informasi_kebutuhan_khusus--bakat_luar_biasa'),
				'informasi_orangtua_wali--no_kk'                          => $this->input->post('informasi_orangtua_wali--no_kk'),
				'informasi_orangtua_wali--ayah_wali--nama_lengkap'        => $this->input->post('informasi_orangtua_wali--ayah_wali--nama_lengkap'),
				'informasi_orangtua_wali--ayah_wali--nik_noktp'           => $this->input->post('informasi_orangtua_wali--ayah_wali--nik_noktp'),
				'informasi_orangtua_wali--ayah_wali--pendidikan'          => $this->input->post('informasi_orangtua_wali--ayah_wali--pendidikan'),
				'informasi_orangtua_wali--ayah_wali--pekerjaan'           => $this->input->post('informasi_orangtua_wali--ayah_wali--pekerjaan'),
				'informasi_orangtua_wali--ibu_wali--nama_lengkap'         => $this->input->post('informasi_orangtua_wali--ibu_wali--nama_lengkap'),
				'informasi_orangtua_wali--ibu_wali--nik_noktp'            => $this->input->post('informasi_orangtua_wali--ibu_wali--nik_noktp'),
				'informasi_orangtua_wali--ibu_wali--pendidikan'           => $this->input->post('informasi_orangtua_wali--ibu_wali--pendidikan'),
				'informasi_orangtua_wali--ibu_wali--pekerjaan'            => $this->input->post('informasi_orangtua_wali--ibu_wali--pekerjaan'),
				'informasi_orangtua_wali--rata_rata_penghasilan_perbulan' => $this->input->post('informasi_orangtua_wali--rata_rata_penghasilan_perbulan'),
				'program_indonesia_pintar_bsm--status_penerima'           => $this->input->post('program_indonesia_pintar_bsm--status_penerima'),
				'program_indonesia_pintar_bsm--alasan_menerima'           => $this->input->post('program_indonesia_pintar_bsm--alasan_menerima'),
				'program_indonesia_pintar_bsm--periode_menerima'          => $this->input->post('program_indonesia_pintar_bsm--periode_menerima'),
				'prestasi_tertinggi--bidang_prestasi'                     => $this->input->post('prestasi_tertinggi--bidang_prestasi'),
				'prestasi_tertinggi--tingkat-prestasi'                    => $this->input->post('prestasi_tertinggi--tingkat-prestasi'),
				'prestasi_tertinggi--peringkat_yang_diraih'               => $this->input->post('prestasi_tertinggi--peringkat_yang_diraih'),
				'prestasi_tertinggi--tahun_meraih_prestasi'               => $this->input->post('prestasi_tertinggi--tahun_meraih_prestasi'),
				'beasiswa--status_beasiswa'                               => $this->input->post('beasiswa--status_beasiswa'),
				'beasiswa--sumber_beasiswa'                               => $this->input->post('beasiswa--sumber_beasiswa'),
				'no_kks_kps'                                              => $this->input->post('no_kks_kps'),
				'no_kartu_pkh'                                            => $this->input->post('no_kartu_pkh'),
				'no_kip'                                                  => $this->input->post('no_kip'),
            ];
            $this->db->where('id', $id);
            $query = $this->db->update('siswa', $data);
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
        $query = $this->db->delete('siswa');
        if($query){
            $result['status'] = 'success';
        }else{
            $result['status'] = 'error';
        }

        echo json_encode($result);
    }
}