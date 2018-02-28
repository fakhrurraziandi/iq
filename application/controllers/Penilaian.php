<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends Backend {

	public function __construct(){
		parent::__construct();
		$this->load->model('Tahunajaranmodel');
		$this->load->model('Tingkatmodel');
		$this->load->model('Kelasmodel');
	}

	public function index(){

		$data['tahunajaran'] = $this->Tahunajaranmodel->all();
		$data['tingkat']     = $this->Tingkatmodel->all();

		$this->load->view('templates/header');
		$this->load->view('templates/nav-'. $this->session->userdata('group'));
		$this->load->view('penilaian/index', $data);
		$this->load->view('templates/footer');
	}

	public function json_parent_mapel(){

		header('Content-Type: application/json');

		$kelas_id = $this->input->get('kelas_id');
		$semester_id = $this->input->get('semester_id');

		$query = $this->db->query("SELECT * FROM mapel WHERE mapel.parent = 1 AND mapel.kelas_id = {$kelas_id} AND mapel.semester_id = {$semester_id}");
		if($query->num_rows() > 0){
			echo json_encode($query->result());
		}else{
			echo json_encode([]);
		}
	}



	public function json(){

		header('Content-Type: application/json');

		$result = [
			'total' => 0,
			// 'rows' => []
		];

		$mapel_id = ($this->input->get('mapel_id')) ? $this->input->get('mapel_id') : false;
		$kelas_id  = ($this->input->get('kelas_id')) ? $this->input->get('kelas_id') : false;
		// $semester_id  = ($this->input->get('semester_id')) ? $this->input->get('semester_id') : 10;

		if($mapel_id AND $kelas_id){
			$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 10;
			$offset = ($this->input->get('offset')) ? $this->input->get('offset') : 0;
			$search = ($this->input->get('search')) ? $this->input->get('search') : '';
			$sort   = ($this->input->get('sort')) ? $this->input->get('sort') : '';
			$order  = ($this->input->get('order')) ? $this->input->get('order') : '';

			$sql = "SELECT
						x.*,
						(SELECT predikatpengetahuan.huruf FROM predikatpengetahuan WHERE  predikatpengetahuan.mapel_id = {$mapel_id}  AND (x.pengetahuan_nilai_rapor_sekolah <= predikatpengetahuan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatpengetahuan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS pengetahuan_predikat_huruf,
						(SELECT predikatpengetahuan.deskripsi FROM predikatpengetahuan WHERE  predikatpengetahuan.mapel_id = {$mapel_id}  AND (x.pengetahuan_nilai_rapor_sekolah <= predikatpengetahuan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatpengetahuan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS pengetahuan_predikat_deskripsi,

						(SELECT predikatketerampilan.huruf FROM predikatketerampilan WHERE  predikatketerampilan.mapel_id = {$mapel_id}  AND (x.keterampilan_nilai_rapor_sekolah <= predikatketerampilan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatketerampilan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS keterampilan_predikat_huruf,
						(SELECT predikatketerampilan.deskripsi FROM predikatketerampilan WHERE  predikatketerampilan.mapel_id = {$mapel_id}  AND (x.keterampilan_nilai_rapor_sekolah <= predikatketerampilan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatketerampilan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS keterampilan_predikat_deskripsi,

						(SELECT predikatsikap.huruf FROM predikatsikap WHERE  predikatsikap.mapel_id = {$mapel_id}  AND (x.sikap_nilai_rapor_sekolah <= predikatsikap.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatsikap.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS sikap_predikat_huruf,
						(SELECT predikatsikap.deskripsi FROM predikatsikap WHERE  predikatsikap.mapel_id = {$mapel_id}  AND (x.sikap_nilai_rapor_sekolah <= predikatsikap.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatsikap.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS sikap_predikat_deskripsi
					FROM
						(
							SELECT
								i.*,
								FORMAT(IF(i.pengetahuan_nilai_rapor_dayah < 70, (75/25), IF(i.pengetahuan_nilai_rapor_dayah < 75, (76/25), (i.pengetahuan_nilai_rapor_dayah/25) )), 2) AS pengetahuan_nilai_rapor_sekolah,
								FORMAT(IF(i.keterampilan_total_nilai < 70, (75/25), IF(i.keterampilan_total_nilai < 75, (76/25), (i.keterampilan_total_nilai/25) )), 2) AS keterampilan_nilai_rapor_sekolah
							FROM (
								SELECT
									y.*,
									ROUND(
										((persentasepenilaian_pengetahuan_tnh / 100) * pengetahuan_tnh) +
										((persentasepenilaian_pengetahuan_nilai_uts / 100) * pengetahuan_nilai_uts) +
										((persentasepenilaian_pengetahuan_nilai_uas / 100) * pengetahuan_nilai_uas)
									) AS pengetahuan_nilai_rapor_dayah,
									ROUND(
										((persentasepenilaian_keterampilan_tnh / 100) * keterampilan_tnh) +
										((persentasepenilaian_keterampilan_projek / 100) * keterampilan_projek) +
										((persentasepenilaian_keterampilan_porto / 100) * keterampilan_porto) +
										((persentasepenilaian_keterampilan_nilai_uts / 100) * keterampilan_nilai_uts) +
										((persentasepenilaian_keterampilan_nilai_uas / 100) * keterampilan_nilai_uas)
									) AS keterampilan_total_nilai,
									ROUND(
										((persentasepenilaian_sikap_tnh / 100) * sikap_tnh) +
										((persentasepenilaian_sikap_pd / 100) * sikap_pd) +
										((persentasepenilaian_sikap_ps / 100) * sikap_ps) +
										((persentasepenilaian_sikap_jurnal / 100) * sikap_jurnal) +
										((persentasepenilaian_sikap_nilai_akhir / 100) * sikap_nilai_akhir)
									) AS sikap_nilai_rapor_sekolah
								FROM (
									SELECT
										z.*,
										(SELECT pengetahuan_tnh FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_pengetahuan_tnh,
										(SELECT pengetahuan_nilai_uts FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_pengetahuan_nilai_uts,
										(SELECT pengetahuan_nilai_uas FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_pengetahuan_nilai_uas,

										(SELECT keterampilan_tnh FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_keterampilan_tnh,
										(SELECT keterampilan_projek FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_keterampilan_projek,
										(SELECT keterampilan_porto FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_keterampilan_porto,
										(SELECT keterampilan_nilai_uts FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_keterampilan_nilai_uts,
										(SELECT keterampilan_nilai_uas FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_keterampilan_nilai_uas,

										(SELECT sikap_tnh FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_sikap_tnh,
										(SELECT sikap_pd FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_sikap_pd,
										(SELECT sikap_ps FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_sikap_ps,
										(SELECT sikap_jurnal FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_sikap_jurnal,
										(SELECT sikap_nilai_akhir FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_sikap_nilai_akhir


									FROM (
										SELECT
											j.*,
											IF(
												j.is_gabungan,
												null,
												(SELECT penilaian.id FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
											) AS penilaian_id,

											# (SELECT penilaian.mapel_id FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1) AS mapel_id,
											{$mapel_id} AS mapel_id,

											ROUND(IF(
												j.is_gabungan,
												(SELECT AVG(penilaiandayah.pengetahuan_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
												(SELECT penilaian.pengetahuan_tnh FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
											)) as pengetahuan_tnh,
											ROUND(IF(
												j.is_gabungan,
												(SELECT AVG(penilaiandayah.pengetahuan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
												(SELECT penilaian.pengetahuan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
											)) as pengetahuan_nilai_uts,
											ROUND(IF(
												j.is_gabungan,
												(SELECT AVG(penilaiandayah.pengetahuan_nilai_uas) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
												(SELECT penilaian.pengetahuan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
											)) as pengetahuan_nilai_uas,

											ROUND(IF(
												j.is_gabungan,
												(SELECT AVG(penilaiandayah.keterampilan_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
												(SELECT penilaian.keterampilan_tnh FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
											)) as keterampilan_tnh,
											ROUND(IF(
												j.is_gabungan,
												(SELECT AVG(penilaiandayah.keterampilan_projek) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
												(SELECT penilaian.keterampilan_projek FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
											)) as keterampilan_projek,
											ROUND(IF(
												j.is_gabungan,
												(SELECT AVG(penilaiandayah.keterampilan_porto) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
												(SELECT penilaian.keterampilan_porto FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
											)) as keterampilan_porto,
											ROUND(IF(
												j.is_gabungan,
												(SELECT AVG(penilaiandayah.keterampilan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
												(SELECT penilaian.keterampilan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
											)) as keterampilan_nilai_uts,
											ROUND(IF(
												j.is_gabungan,
												(SELECT AVG(penilaiandayah.keterampilan_nilai_uas) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
												(SELECT penilaian.keterampilan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
											)) as keterampilan_nilai_uas,

											ROUND(IF(
												j.is_gabungan,
												(SELECT AVG(penilaiandayah.sikap_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
												(SELECT penilaian.sikap_tnh FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
											)) as sikap_tnh,
											ROUND(IF(
												j.is_gabungan,
												(SELECT AVG(penilaiandayah.sikap_pd) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
												(SELECT penilaian.sikap_pd FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
											)) as sikap_pd,
											ROUND(IF(
												j.is_gabungan,
												(SELECT AVG(penilaiandayah.sikap_ps) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
												(SELECT penilaian.sikap_ps FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
											)) as sikap_ps,
											ROUND(IF(
												j.is_gabungan,
												(SELECT AVG(penilaiandayah.sikap_jurnal) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
												(SELECT penilaian.sikap_jurnal FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
											)) as sikap_jurnal,
											ROUND(IF(
												j.is_gabungan,
												(SELECT AVG(penilaiandayah.sikap_nilai_akhir) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
												(SELECT penilaian.sikap_nilai_akhir FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
											)) as sikap_nilai_akhir

										FROM (
											SELECT
												penempatansiswa.id,
												penempatansiswa.kelas_id,
												penempatansiswa.siswa_id,
												siswa.nisn,
												siswa.nis_lokal,
												siswa.nama,
												siswa.jenis_kelamin,
												(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AS is_gabungan
											FROM
												penempatansiswa
											INNER JOIN siswa ON penempatansiswa.siswa_id = siswa.id
											INNER JOIN kelas ON penempatansiswa.kelas_id = kelas.id
											WHERE penempatansiswa.kelas_id = {$kelas_id}
										) j
									) z
								) y
							) i
						) x ";



			// echo $sql;

			if($search !== ''){
			    $sql .= "WHERE
			                x.nisn LIKE '%". $search ."%' OR
			                x.nis_lokal LIKE '%". $search ."%' OR
			                x.nama LIKE '%". $search ."%' ";
			}

			if($sort !== ''){
			    $sql .= "ORDER BY x.". $sort . " " . $order. " ";
			}else{
			    $sql .= "ORDER BY x.nisn, x.nis_lokal, x.nama ASC ";
			}

			$query = $this->db->query($sql);
			$result['total'] = $query->num_rows();

			$query_limit = $this->db->query($sql . " LIMIT ". $offset . ", ". $limit);
			$result['rows'] = $query_limit->result();



		}

		echo json_encode($result);

	}

	public function create(){

		header('Content-Type: application/json');

		$result = [
			'status' => 'success',
			'error_message' => [],
		];


		// $this->form_validation->set_rules('penempatansiswa_id', 'penempatansiswa_id', 'required');
		// $this->form_validation->set_rules('mapel_id', 'mapel_id', 'required');
		$this->form_validation->set_rules('pengetahuan_tnh', 'pengetahuan_tnh', 'required|numeric');
		$this->form_validation->set_rules('pengetahuan_nilai_uts', 'pengetahuan_nilai_uts', 'required|numeric');
		$this->form_validation->set_rules('pengetahuan_nilai_uas', 'pengetahuan_nilai_uas', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_tnh', 'keterampilan_tnh', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_projek', 'keterampilan_projek', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_porto', 'keterampilan_porto', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_nilai_uts', 'keterampilan_nilai_uts', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_nilai_uas', 'keterampilan_nilai_uas', 'required|numeric');
		$this->form_validation->set_rules('sikap_tnh', 'sikap_tnh', 'required|numeric');
		$this->form_validation->set_rules('sikap_pd', 'sikap_pd', 'required|numeric');
		$this->form_validation->set_rules('sikap_ps', 'sikap_ps', 'required|numeric');
		$this->form_validation->set_rules('sikap_jurnal', 'sikap_jurnal', 'required|numeric');
		$this->form_validation->set_rules('sikap_nilai_akhir', 'sikap_nilai_akhir', 'required|numeric');
		// $this->form_validation->set_rules('semester_id', 'semester_id', 'required');

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$formData = [
				'penempatansiswa_id'     => $this->input->post('penempatansiswa_id'),
				'mapel_id'               => $this->input->post('mapel_id'),
				'pengetahuan_tnh'        => $this->input->post('pengetahuan_tnh'),
				'pengetahuan_nilai_uts'  => $this->input->post('pengetahuan_nilai_uts'),
				'pengetahuan_nilai_uas'  => $this->input->post('pengetahuan_nilai_uas'),
				'keterampilan_tnh'       => $this->input->post('keterampilan_tnh'),
				'keterampilan_projek'    => $this->input->post('keterampilan_projek'),
				'keterampilan_porto'     => $this->input->post('keterampilan_porto'),
				'keterampilan_nilai_uts' => $this->input->post('keterampilan_nilai_uts'),
				'keterampilan_nilai_uas' => $this->input->post('keterampilan_nilai_uas'),
				'sikap_tnh'              => $this->input->post('sikap_tnh'),
				'sikap_pd'               => $this->input->post('sikap_pd'),
				'sikap_ps'               => $this->input->post('sikap_ps'),
				'sikap_jurnal'           => $this->input->post('sikap_jurnal'),
				'sikap_nilai_akhir'      => $this->input->post('sikap_nilai_akhir'),
			];

			$insert = $this->db->insert('penilaian', $formData);

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
      	$id = $this->input->get('id');
        $query = $this->db->query("SELECT * FROM `penilaian` WHERE penilaian.id = {$id}");
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

    public function update(){
        header('Content-Type: application/json');

        $result = [];

        $this->form_validation->set_rules('pengetahuan_tnh', 'pengetahuan_tnh', 'required|numeric');
		$this->form_validation->set_rules('pengetahuan_nilai_uts', 'pengetahuan_nilai_uts', 'required|numeric');
		$this->form_validation->set_rules('pengetahuan_nilai_uas', 'pengetahuan_nilai_uas', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_tnh', 'keterampilan_tnh', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_projek', 'keterampilan_projek', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_porto', 'keterampilan_porto', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_nilai_uts', 'keterampilan_nilai_uts', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_nilai_uas', 'keterampilan_nilai_uas', 'required|numeric');
		$this->form_validation->set_rules('sikap_tnh', 'sikap_tnh', 'required|numeric');
		$this->form_validation->set_rules('sikap_pd', 'sikap_pd', 'required|numeric');
		$this->form_validation->set_rules('sikap_ps', 'sikap_ps', 'required|numeric');
		$this->form_validation->set_rules('sikap_jurnal', 'sikap_jurnal', 'required|numeric');
		$this->form_validation->set_rules('sikap_nilai_akhir', 'sikap_nilai_akhir', 'required|numeric');

        if($this->form_validation->run() == false){
            $result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();
        }else{
            $id = $this->input->post('id');
            $data = [
				'pengetahuan_tnh'        => $this->input->post('pengetahuan_tnh'),
				'pengetahuan_nilai_uts'  => $this->input->post('pengetahuan_nilai_uts'),
				'pengetahuan_nilai_uas'  => $this->input->post('pengetahuan_nilai_uas'),
				'keterampilan_tnh'       => $this->input->post('keterampilan_tnh'),
				'keterampilan_projek'    => $this->input->post('keterampilan_projek'),
				'keterampilan_porto'     => $this->input->post('keterampilan_porto'),
				'keterampilan_nilai_uts' => $this->input->post('keterampilan_nilai_uts'),
				'keterampilan_nilai_uas' => $this->input->post('keterampilan_nilai_uas'),
				'sikap_tnh'              => $this->input->post('sikap_tnh'),
				'sikap_pd'               => $this->input->post('sikap_pd'),
				'sikap_ps'               => $this->input->post('sikap_ps'),
				'sikap_jurnal'           => $this->input->post('sikap_jurnal'),
				'sikap_nilai_akhir'      => $this->input->post('sikap_nilai_akhir'),
            ];
            $this->db->where('id', $id);
            $query = $this->db->update('penilaian', $data);
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
        $query = $this->db->delete('mapel');
        if($query){
            $result['status'] = 'success';
        }else{
            $result['status'] = 'error';
        }

        echo json_encode($result);
    }

    public function test_query(){

    	$sql = "SELECT ";
    	$query = $this->db->query("SELECT mapel.id, mapel.mapel FROM mapel WHERE mapel.kelas_id = 3");
    	if($query->num_rows() > 0){
    		foreach($query->result() as $mapel){
    			$sql .= "(SELECT penilaian.pengetahuan_nilai_uts FROM penilaian WHERE penilaian.penempatansiswa_id = penempatansiswa.id AND penilaian.mapel_id = {$mapel->id}) AS {$mapel->id}, ";
    		}
    	}
    	$sql .= "FROM penempatansiswa ";

    	echo $sql;
    }


}
