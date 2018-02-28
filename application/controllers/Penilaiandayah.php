<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaiandayah extends Backend {

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
		$this->load->view('penilaiandayah/index', $data);
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

		$mapeldayah_id = ($this->input->get('mapeldayah_id')) ? $this->input->get('mapeldayah_id') : false;
		$kelas_id  = ($this->input->get('kelas_id')) ? $this->input->get('kelas_id') : false;
		// $semester_id  = ($this->input->get('semester_id')) ? $this->input->get('semester_id') : 10;

		if($mapeldayah_id AND $kelas_id){
			$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 10;
			$offset = ($this->input->get('offset')) ? $this->input->get('offset') : 0;
			$search = ($this->input->get('search')) ? $this->input->get('search') : '';
			$sort   = ($this->input->get('sort')) ? $this->input->get('sort') : '';
			$order  = ($this->input->get('order')) ? $this->input->get('order') : '';

			$sql = "SELECT
						x.*
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
										(SELECT pengetahuan_tnh FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = z.mapeldayah_id) AS persentasepenilaian_pengetahuan_tnh,
										(SELECT pengetahuan_nilai_uts FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = z.mapeldayah_id) AS persentasepenilaian_pengetahuan_nilai_uts,
										(SELECT pengetahuan_nilai_uas FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = z.mapeldayah_id) AS persentasepenilaian_pengetahuan_nilai_uas,

										(SELECT keterampilan_tnh FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = z.mapeldayah_id) AS persentasepenilaian_keterampilan_tnh,
										(SELECT keterampilan_projek FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = z.mapeldayah_id) AS persentasepenilaian_keterampilan_projek,
										(SELECT keterampilan_porto FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = z.mapeldayah_id) AS persentasepenilaian_keterampilan_porto,
										(SELECT keterampilan_nilai_uts FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = z.mapeldayah_id) AS persentasepenilaian_keterampilan_nilai_uts,
										(SELECT keterampilan_nilai_uas FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = z.mapeldayah_id) AS persentasepenilaian_keterampilan_nilai_uas,

										(SELECT sikap_tnh FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = z.mapeldayah_id) AS persentasepenilaian_sikap_tnh,
										(SELECT sikap_pd FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = z.mapeldayah_id) AS persentasepenilaian_sikap_pd,
										(SELECT sikap_ps FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = z.mapeldayah_id) AS persentasepenilaian_sikap_ps,
										(SELECT sikap_jurnal FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = z.mapeldayah_id) AS persentasepenilaian_sikap_jurnal,
										(SELECT sikap_nilai_akhir FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = z.mapeldayah_id) AS persentasepenilaian_sikap_nilai_akhir

										
									FROM (
										SELECT
											penempatansiswa.id,
											penempatansiswa.kelas_id,
											penempatansiswa.siswa_id,
											siswa.nisn,
											siswa.nis_lokal,
											siswa.nama,
											siswa.jenis_kelamin,
											(SELECT penilaiandayah.id FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = {$mapeldayah_id} AND penilaiandayah.penempatansiswa_id = penempatansiswa.id ORDER BY penilaiandayah.id DESC LIMIT 1) AS penilaiandayah_id,
											(SELECT penilaiandayah.mapeldayah_id FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = {$mapeldayah_id} AND penilaiandayah.penempatansiswa_id = penempatansiswa.id ORDER BY penilaiandayah.id DESC LIMIT 1) AS mapeldayah_id,
											(SELECT penilaiandayah.pengetahuan_tnh FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = {$mapeldayah_id} AND penilaiandayah.penempatansiswa_id = penempatansiswa.id ORDER BY penilaiandayah.id DESC LIMIT 1) as pengetahuan_tnh,
											(SELECT penilaiandayah.pengetahuan_nilai_uts FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = {$mapeldayah_id} AND penilaiandayah.penempatansiswa_id = penempatansiswa.id ORDER BY penilaiandayah.id DESC LIMIT 1) as pengetahuan_nilai_uts,
											(SELECT penilaiandayah.pengetahuan_nilai_uas FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = {$mapeldayah_id} AND penilaiandayah.penempatansiswa_id = penempatansiswa.id ORDER BY penilaiandayah.id DESC LIMIT 1) as pengetahuan_nilai_uas,
											(SELECT penilaiandayah.keterampilan_tnh FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = {$mapeldayah_id} AND penilaiandayah.penempatansiswa_id = penempatansiswa.id ORDER BY penilaiandayah.id DESC LIMIT 1) as keterampilan_tnh,
											(SELECT penilaiandayah.keterampilan_projek FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = {$mapeldayah_id} AND penilaiandayah.penempatansiswa_id = penempatansiswa.id ORDER BY penilaiandayah.id DESC LIMIT 1) as keterampilan_projek,
											(SELECT penilaiandayah.keterampilan_porto FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = {$mapeldayah_id} AND penilaiandayah.penempatansiswa_id = penempatansiswa.id ORDER BY penilaiandayah.id DESC LIMIT 1) as keterampilan_porto,
											(SELECT penilaiandayah.keterampilan_nilai_uts FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = {$mapeldayah_id} AND penilaiandayah.penempatansiswa_id = penempatansiswa.id ORDER BY penilaiandayah.id DESC LIMIT 1) as keterampilan_nilai_uts,
											(SELECT penilaiandayah.keterampilan_nilai_uas FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = {$mapeldayah_id} AND penilaiandayah.penempatansiswa_id = penempatansiswa.id ORDER BY penilaiandayah.id DESC LIMIT 1) as keterampilan_nilai_uas,
											(SELECT penilaiandayah.sikap_tnh FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = {$mapeldayah_id} AND penilaiandayah.penempatansiswa_id = penempatansiswa.id ORDER BY penilaiandayah.id DESC LIMIT 1) as sikap_tnh,
											(SELECT penilaiandayah.sikap_pd FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = {$mapeldayah_id} AND penilaiandayah.penempatansiswa_id = penempatansiswa.id ORDER BY penilaiandayah.id DESC LIMIT 1) as sikap_pd,
											(SELECT penilaiandayah.sikap_ps FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = {$mapeldayah_id} AND penilaiandayah.penempatansiswa_id = penempatansiswa.id ORDER BY penilaiandayah.id DESC LIMIT 1) as sikap_ps,
											(SELECT penilaiandayah.sikap_jurnal FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = {$mapeldayah_id} AND penilaiandayah.penempatansiswa_id = penempatansiswa.id ORDER BY penilaiandayah.id DESC LIMIT 1) as sikap_jurnal,
											(SELECT penilaiandayah.sikap_nilai_akhir FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = {$mapeldayah_id} AND penilaiandayah.penempatansiswa_id = penempatansiswa.id ORDER BY penilaiandayah.id DESC LIMIT 1) as sikap_nilai_akhir
											
										FROM
											penempatansiswa
										INNER JOIN siswa ON penempatansiswa.siswa_id = siswa.id
										INNER JOIN kelas ON penempatansiswa.kelas_id = kelas.id
										WHERE penempatansiswa.kelas_id = {$kelas_id}
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
				'mapeldayah_id'          => $this->input->post('mapeldayah_id'),
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

			$insert = $this->db->insert('penilaiandayah', $formData);

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
        $query = $this->db->query("SELECT * FROM `penilaiandayah` WHERE penilaiandayah.id = {$id}");
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
				'pengetahuan_tnh'        => floatval($this->input->post('pengetahuan_tnh')),
				'pengetahuan_nilai_uts'  => floatval($this->input->post('pengetahuan_nilai_uts')),
				'pengetahuan_nilai_uas'  => floatval($this->input->post('pengetahuan_nilai_uas')),
				'keterampilan_tnh'       => floatval($this->input->post('keterampilan_tnh')),
				'keterampilan_projek'    => floatval($this->input->post('keterampilan_projek')),
				'keterampilan_porto'     => floatval($this->input->post('keterampilan_porto')),
				'keterampilan_nilai_uts' => floatval($this->input->post('keterampilan_nilai_uts')),
				'keterampilan_nilai_uas' => floatval($this->input->post('keterampilan_nilai_uas')),
				'sikap_tnh'              => floatval($this->input->post('sikap_tnh')),
				'sikap_pd'               => floatval($this->input->post('sikap_pd')),
				'sikap_ps'               => floatval($this->input->post('sikap_ps')),
				'sikap_jurnal'           => floatval($this->input->post('sikap_jurnal')),
				'sikap_nilai_akhir'      => floatval($this->input->post('sikap_nilai_akhir')),
            ];
            $this->db->where('id', $id);
            $query = $this->db->update('penilaiandayah', $data);
            // echo $this->db->last_query();
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

   
}