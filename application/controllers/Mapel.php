<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel extends Backend {

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
		$this->load->view('mapel/index', $data);
		$this->load->view('templates/footer');
	}

	public function json_combo_mapel(){
		header('Content-Type: application/json');

		$result = [];

		$kelas_id = $this->input->get('kelas_id');
		$semester_id = $this->input->get('semester_id');

		$query = $this->db->query("SELECT 
										mapel.*,
										(SELECT COUNT(*) FROM mapel m WHERE m.parent = 0 AND m.parent_id = mapel.id) AS has_child
									FROM mapel WHERE mapel.parent = 1 AND mapel.kelas_id = {$kelas_id} AND mapel.semester_id = {$semester_id}");
		if($query->num_rows() > 0){
			foreach($query->result() as $parent){
				$parent->sub = [];
				if($parent->has_child > 0){
					$query_sub = $this->db->query("SELECT 
											mapel.*
										FROM mapel WHERE mapel.parent = 0 AND mapel.kelas_id = {$kelas_id} AND mapel.semester_id = {$semester_id}");
					if($query_sub->num_rows()){
						foreach($query_sub->result() as $sub){
							$parent->sub[] = $sub;
						}
					}
				}

				$result[] = $parent;
			}

			echo json_encode($result);
		}else{
			echo json_encode([]);
		}
	}

	public function json_parent_mapel(){

		
		header('Content-Type: application/json');

		$kelas_id = $this->input->get('kelas_id');
		$semester_id = $this->input->get('semester_id');

		$query = $this->db->query("SELECT 
										mapel.*,
										(SELECT COUNT(*) FROM mapel m WHERE m.parent = 0 AND m.parent_id = mapel.id) AS has_child
									FROM mapel WHERE mapel.parent = 1 AND mapel.kelas_id = {$kelas_id} AND mapel.semester_id = {$semester_id}");
		if($query->num_rows() > 0){
			echo json_encode($query->result());
		}else{
			echo json_encode([]);
		}
	}


	public function json_mapeldayah(){

		
		header('Content-Type: application/json');

		$kelas_id = $this->input->get('kelas_id');
		$semester_id = $this->input->get('semester_id');

		$query = $this->db->query("SELECT
										mapeldayah.id,
										mapeldayah.mapel,
										mapeldayah.mapel_hijaiyah,
										mapeldayah.kelas_id,
										mapeldayah.guru_id,
										mapeldayah.semester_id
										FROM
										mapeldayah
 									WHERE 
 									mapeldayah.kelas_id = {$kelas_id} 
 									AND mapeldayah.semester_id = {$semester_id}");
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
			'rows' => []
		];

		$kelas_id  = ($this->input->get('kelas_id')) ? $this->input->get('kelas_id') : 10;
		$semester_id  = ($this->input->get('semester_id')) ? $this->input->get('semester_id') : 10;

		if($kelas_id AND $semester_id){
			$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 10;
			$offset = ($this->input->get('offset')) ? $this->input->get('offset') : 0;
			$search = ($this->input->get('search')) ? $this->input->get('search') : '';
			$sort   = ($this->input->get('sort')) ? $this->input->get('sort') : '';
			$order  = ($this->input->get('order')) ? $this->input->get('order') : '';

			$sql = "SELECT 
						x.*,
						(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = x.id) as is_gabungan
					FROM (
						SELECT
						mapel.id,
						mapel.mapel,
						mapel.kelas_id,
						mapel.guru_id,
						mapel.kelompokmapel_id,
						mapel.kkm,
						mapel.parent,
						mapel.parent_id,
						kelompokmapel.kelompokmapel,
						kelompokmapel.semester_id,
						guru.nama AS guru,
						(SELECT COUNT(*) FROM mapel m WHERE m.parent = 0 AND m.parent_id = mapel.id) AS has_child,
						mapel.id AS order_1,
						mapel.id AS order_2
						FROM
						mapel
						INNER JOIN kelompokmapel ON mapel.kelompokmapel_id = kelompokmapel.id
						INNER JOIN guru ON mapel.guru_id = guru.id
						WHERE 
						mapel.parent = 1 AND 
						mapel.kelas_id = {$kelas_id} AND 
						mapel.semester_id = {$semester_id} 


						UNION ALL

						SELECT
						mapel.id,
						mapel.mapel,
						mapel.kelas_id,
						mapel.guru_id,
						mapel.kelompokmapel_id,
						mapel.kkm,
						mapel.parent,
						mapel.parent_id,
						kelompokmapel.kelompokmapel,
						kelompokmapel.semester_id,
						guru.nama AS guru,
						0 AS has_child,
						mapel.parent_id AS order_1,
						mapel.id AS order_2
						FROM
						mapel
						INNER JOIN kelompokmapel ON mapel.kelompokmapel_id = kelompokmapel.id
						INNER JOIN guru ON mapel.guru_id = guru.id
						WHERE 
						mapel.parent = 0 AND 
						mapel.kelas_id = {$kelas_id} AND 
						mapel.semester_id = {$semester_id}

					) x ";

			if($search !== ''){
			    $sql .= "WHERE
			                x.kelompokmapel LIKE '%". $search ."%' OR
			                x.mapel LIKE '%". $search ."%' OR
			                x.guru LIKE '%". $search ."%' ";
			}

		    $sql .= " ORDER BY x.order_1, x.order_2 ";

			$query = $this->db->query($sql);
			$result['total'] = $query->num_rows();

			$query_limit = $this->db->query($sql . " LIMIT ". $offset . ", ". $limit);
			$result['rows'] = $query_limit->result();

			array_map([$this, 'mapping_gabungan'], $result['rows']);
		}

		echo json_encode($result);

	}

	public function mapping_gabungan($row){

		$row->mapelgabungan = '';

		$query = $this->db->query("
			SELECT
				GROUP_CONCAT(CONCAT(mapeldayah.mapel, ' (', mapeldayah.mapel_hijaiyah, ')') SEPARATOR ',  ') as mapeldayah
			FROM
				mapelgabungan
			INNER JOIN mapeldayah ON mapelgabungan.mapeldayah_id = mapeldayah.id
			WHERE mapelgabungan.mapel_id = {$row->id}
			GROUP BY mapelgabungan.mapel_id
		");

		if($query->num_rows() > 0){
			$row->mapelgabungan = $query->row()->mapeldayah;
		}
	}

	public function create(){

		header('Content-Type: application/json');

		$result = [
			'status' => 'success',
			'error_message' => [],
		];

		$this->form_validation->set_rules('mapel', 'mapel', 'required');
		// $this->form_validation->set_rules('kelas_id', 'kelas_id', 'required');
		$this->form_validation->set_rules('guru_id', 'guru_id', 'required');
		$this->form_validation->set_rules('kelompokmapel_id', 'kelompokmapel_id', 'required');
		$this->form_validation->set_rules('kkm', 'kkm', 'required');
		// $this->form_validation->set_rules('semester_id', 'semester_id', 'required');

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$formData = [
				'mapel'            => $this->input->post('mapel'),
				'kelas_id'         => $this->input->post('kelas_id'),
				'guru_id'          => $this->input->post('guru_id'),
				'kkm'              => $this->input->post('kkm'),
				'kelompokmapel_id' => $this->input->post('kelompokmapel_id'),
				'semester_id'      => $this->input->post('semester_id'),
				'parent'           => 1,
			];

			$insert = $this->db->insert('mapel', $formData);

			if($insert){

				$mapel_id = $this->db->insert_id();

				$mapelgabungan = [];
				$mapeldayah_id = $this->input->post('mapeldayah_id');
				if(count($mapeldayah_id) > 0){
					foreach($mapeldayah_id as $_mapeldayah_id){
						array_push($mapelgabungan, ['mapel_id' => $mapel_id, 'mapeldayah_id' => $_mapeldayah_id]);
					}
					$this->db->insert_batch('mapelgabungan', $mapelgabungan);
				}

				$predikatpengetahuan = [
					['mapel_id' => $mapel_id, 	'huruf' => 'A',  	'lebih_kecil_atau_sama_dengan' => 4],
					['mapel_id' => $mapel_id, 	'huruf' => 'A-',  		'lebih_kecil_atau_sama_dengan' => 3.68],
					['mapel_id' => $mapel_id, 	'huruf' => 'B+',  		'lebih_kecil_atau_sama_dengan' => 3.34],
					['mapel_id' => $mapel_id, 	'huruf' => 'B',  		'lebih_kecil_atau_sama_dengan' => 3.01],
					['mapel_id' => $mapel_id, 	'huruf' => 'B-',  		'lebih_kecil_atau_sama_dengan' => 2.68],
					['mapel_id' => $mapel_id, 	'huruf' => 'C+',  		'lebih_kecil_atau_sama_dengan' => 2.34],
					['mapel_id' => $mapel_id, 	'huruf' => 'C',  		'lebih_kecil_atau_sama_dengan' => 2.01],
					['mapel_id' => $mapel_id, 	'huruf' => 'C-',  		'lebih_kecil_atau_sama_dengan' => 1.68],
					['mapel_id' => $mapel_id, 	'huruf' => 'D+',  		'lebih_kecil_atau_sama_dengan' => 1.34],
					['mapel_id' => $mapel_id, 	'huruf' => 'D',  		'lebih_kecil_atau_sama_dengan' => 1.01],
					['mapel_id' => $mapel_id, 	'huruf' => 'E',  		'lebih_kecil_atau_sama_dengan' => 0],
				];

				$this->db->insert_batch('predikatpengetahuan', $predikatpengetahuan);

				$predikatketerampilan = [
					['mapel_id' => $mapel_id, 	'huruf' => 'A',  	'lebih_kecil_atau_sama_dengan' => 4],
					['mapel_id' => $mapel_id, 	'huruf' => 'A-',  		'lebih_kecil_atau_sama_dengan' => 3.68],
					['mapel_id' => $mapel_id, 	'huruf' => 'B+',  		'lebih_kecil_atau_sama_dengan' => 3.34],
					['mapel_id' => $mapel_id, 	'huruf' => 'B',  		'lebih_kecil_atau_sama_dengan' => 3.01],
					['mapel_id' => $mapel_id, 	'huruf' => 'B-',  		'lebih_kecil_atau_sama_dengan' => 2.68],
					['mapel_id' => $mapel_id, 	'huruf' => 'C+',  		'lebih_kecil_atau_sama_dengan' => 2.34],
					['mapel_id' => $mapel_id, 	'huruf' => 'C',  		'lebih_kecil_atau_sama_dengan' => 2.01],
					['mapel_id' => $mapel_id, 	'huruf' => 'C-',  		'lebih_kecil_atau_sama_dengan' => 1.68],
					['mapel_id' => $mapel_id, 	'huruf' => 'D+',  		'lebih_kecil_atau_sama_dengan' => 1.34],
					['mapel_id' => $mapel_id, 	'huruf' => 'D',  		'lebih_kecil_atau_sama_dengan' => 1.01],
					['mapel_id' => $mapel_id, 	'huruf' => 'E',  		'lebih_kecil_atau_sama_dengan' => 0],
				];
				$this->db->insert_batch('predikatketerampilan', $predikatketerampilan);

				$predikatsikap = [
					['mapel_id' => $mapel_id, 	'huruf' => 'K',  		'lebih_kecil_atau_sama_dengan' => 60], 
					['mapel_id' => $mapel_id, 	'huruf' => 'C',  		'lebih_kecil_atau_sama_dengan' => 75], 
					['mapel_id' => $mapel_id, 	'huruf' => 'B',  		'lebih_kecil_atau_sama_dengan' => 91], 
					['mapel_id' => $mapel_id, 	'huruf' => 'SB',  	'lebih_kecil_atau_sama_dengan' => 100], 
				];
				$this->db->insert_batch('predikatsikap', $predikatsikap);
				$result['status'] = 'success';
			}else{
				$result['status'] = 'error';
			}
		}

		echo json_encode($result);
	}

	public function create_sub(){

		header('Content-Type: application/json');

		$result = [
			'status' => 'success',
			'error_message' => [],
		];

		$this->form_validation->set_rules('parent_id', 'parent_id', 'required');
		$this->form_validation->set_rules('mapel', 'mapel', 'required');
		// $this->form_validation->set_rules('kelas_id', 'kelas_id', 'required');
		$this->form_validation->set_rules('guru_id', 'guru_id', 'required');
		$this->form_validation->set_rules('kkm', 'kkm', 'required');
		// $this->form_validation->set_rules('kelompokmapel_id', 'kelompokmapel_id', 'required');
		// $this->form_validation->set_rules('semester_id', 'semester_id', 'required');

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$formData = [
				'mapel'       => $this->input->post('mapel'),
				'kelas_id'    => $this->input->post('kelas_id'),
				'guru_id'     => $this->input->post('guru_id'),
				'kkm'     => $this->input->post('kkm'),
				'semester_id' => $this->input->post('semester_id'),
				'parent'      => 0,
				'parent_id'   => $this->input->post('parent_id'),
			];

			$query = $this->db->query("SELECT mapel.kelompokmapel_id FROM mapel WHERE mapel.id = ". $formData['parent_id']);
			$formData['kelompokmapel_id'] = $query->row()->kelompokmapel_id;

			$insert = $this->db->insert('mapel', $formData);



			if($insert){
				
				$mapel_id = $this->db->insert_id();

				$mapelgabungan = [];
				$mapeldayah_id = $this->input->post('mapeldayah_id');
				if(count($mapeldayah_id) > 0){
					foreach($mapeldayah_id as $_mapeldayah_id){
						array_push($mapelgabungan, ['mapel_id' => $mapel_id, 'mapeldayah_id' => $_mapeldayah_id]);
					}	
					$this->db->insert_batch('mapelgabungan', $mapelgabungan);
				}

				$predikatpengetahuan = [
					['mapel_id' => $mapel_id, 	'huruf' => 'A',  	'lebih_kecil_atau_sama_dengan' => 4],
					['mapel_id' => $mapel_id, 	'huruf' => 'A-',  		'lebih_kecil_atau_sama_dengan' => 3.68],
					['mapel_id' => $mapel_id, 	'huruf' => 'B+',  		'lebih_kecil_atau_sama_dengan' => 3.34],
					['mapel_id' => $mapel_id, 	'huruf' => 'B',  		'lebih_kecil_atau_sama_dengan' => 3.01],
					['mapel_id' => $mapel_id, 	'huruf' => 'B-',  		'lebih_kecil_atau_sama_dengan' => 2.68],
					['mapel_id' => $mapel_id, 	'huruf' => 'C+',  		'lebih_kecil_atau_sama_dengan' => 2.34],
					['mapel_id' => $mapel_id, 	'huruf' => 'C',  		'lebih_kecil_atau_sama_dengan' => 2.01],
					['mapel_id' => $mapel_id, 	'huruf' => 'C-',  		'lebih_kecil_atau_sama_dengan' => 1.68],
					['mapel_id' => $mapel_id, 	'huruf' => 'D+',  		'lebih_kecil_atau_sama_dengan' => 1.34],
					['mapel_id' => $mapel_id, 	'huruf' => 'D',  		'lebih_kecil_atau_sama_dengan' => 1.01],
					['mapel_id' => $mapel_id, 	'huruf' => 'E',  		'lebih_kecil_atau_sama_dengan' => 0],
				];

				$this->db->insert_batch('predikatpengetahuan', $predikatpengetahuan);

				$predikatketerampilan = [
					['mapel_id' => $mapel_id, 	'huruf' => 'A',  	'lebih_kecil_atau_sama_dengan' => 4],
					['mapel_id' => $mapel_id, 	'huruf' => 'A-',  		'lebih_kecil_atau_sama_dengan' => 3.68],
					['mapel_id' => $mapel_id, 	'huruf' => 'B+',  		'lebih_kecil_atau_sama_dengan' => 3.34],
					['mapel_id' => $mapel_id, 	'huruf' => 'B',  		'lebih_kecil_atau_sama_dengan' => 3.01],
					['mapel_id' => $mapel_id, 	'huruf' => 'B-',  		'lebih_kecil_atau_sama_dengan' => 2.68],
					['mapel_id' => $mapel_id, 	'huruf' => 'C+',  		'lebih_kecil_atau_sama_dengan' => 2.34],
					['mapel_id' => $mapel_id, 	'huruf' => 'C',  		'lebih_kecil_atau_sama_dengan' => 2.01],
					['mapel_id' => $mapel_id, 	'huruf' => 'C-',  		'lebih_kecil_atau_sama_dengan' => 1.68],
					['mapel_id' => $mapel_id, 	'huruf' => 'D+',  		'lebih_kecil_atau_sama_dengan' => 1.34],
					['mapel_id' => $mapel_id, 	'huruf' => 'D',  		'lebih_kecil_atau_sama_dengan' => 1.01],
					['mapel_id' => $mapel_id, 	'huruf' => 'E',  		'lebih_kecil_atau_sama_dengan' => 0],
				];
				$this->db->insert_batch('predikatketerampilan', $predikatketerampilan);

				$predikatsikap = [
					['mapel_id' => $mapel_id, 	'huruf' => 'K',  		'lebih_kecil_atau_sama_dengan' => 60], 
					['mapel_id' => $mapel_id, 	'huruf' => 'C',  		'lebih_kecil_atau_sama_dengan' => 75], 
					['mapel_id' => $mapel_id, 	'huruf' => 'B',  		'lebih_kecil_atau_sama_dengan' => 91], 
					['mapel_id' => $mapel_id, 	'huruf' => 'SB',  	'lebih_kecil_atau_sama_dengan' => 100], 
				];
				$this->db->insert_batch('predikatsikap', $predikatsikap);
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
        $query = $this->db->query("SELECT 
        								mapel.*,
        								(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = mapel.id) as is_gabungan
    								FROM mapel WHERE mapel.parent = 1 AND mapel.id = {$id}");
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

    public function find_sub(){

        header('Content-Type: application/json');

        $result = '';
      	$id = $this->input->get('id');
        $query = $this->db->query("SELECT  
        								mapel.*,
        								(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = mapel.id) as is_gabungan
        							FROM mapel WHERE mapel.parent = 0 AND mapel.id = {$id}");
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

    public function get_mapeldayah_id_gabungan(){
    	header('Content-Type: application/json');

    	$result = [];
    	$mapel_id = $this->input->get('mapel_id');
    	$query = $this->db->query("SELECT * FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}");
    	if($query->num_rows() > 0){
            foreach($query->result() as $row){
            	$result[] = $row->mapeldayah_id;
            }
        }
        echo json_encode($result);
    }

    public function update(){
        header('Content-Type: application/json');

        $result = [];

        $this->form_validation->set_rules('mapel', 'mapel', 'required');
        $this->form_validation->set_rules('kelompokmapel_id', 'kelompokmapel_id', 'required');
        $this->form_validation->set_rules('guru_id', 'guru_id', 'required');
        $this->form_validation->set_rules('kkm', 'kkm', 'required');

        if($this->form_validation->run() == false){
            $result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();
        }else{
            $id = $this->input->post('id');
            $data = [
				'mapel'            => $this->input->post('mapel'),
				'kelompokmapel_id' => $this->input->post('kelompokmapel_id'),
				'guru_id'          => $this->input->post('guru_id'),
				'kkm'          => $this->input->post('kkm'),
            ];
            $this->db->where('id', $id);
            $query = $this->db->update('mapel', $data);
            if($query){
            	$mapel_id = $id;

            	$this->db->query("DELETE FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}");

				$mapelgabungan = [];
				$mapeldayah_id = $this->input->post('mapeldayah_id');
				if(count($mapeldayah_id) > 0){
					foreach($mapeldayah_id as $_mapeldayah_id){
						array_push($mapelgabungan, ['mapel_id' => $mapel_id, 'mapeldayah_id' => $_mapeldayah_id]);
					}	
					$this->db->insert_batch('mapelgabungan', $mapelgabungan);
				}
                $result['status'] = 'success';
            }else{
                $result['status'] = 'error';
            }
        }

        echo json_encode($result);
    }

    public function update_sub(){
        header('Content-Type: application/json');

        $result = [];

        $this->form_validation->set_rules('mapel', 'mapel', 'required');
        $this->form_validation->set_rules('parent_id', 'parent_id', 'required');
        $this->form_validation->set_rules('guru_id', 'guru_id', 'required');
        $this->form_validation->set_rules('kkm', 'kkm', 'required');

        if($this->form_validation->run() == false){
            $result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();
        }else{
            $id = $this->input->post('id');
            $data = [
				'mapel'     => $this->input->post('mapel'),
				'parent_id' => $this->input->post('parent_id'),
				'guru_id'   => $this->input->post('guru_id'),
				'kkm'   => $this->input->post('kkm'),
            ];
            $this->db->where('id', $id);
            $query = $this->db->update('mapel', $data);
            if($query){

            	$mapel_id = $id;

            	$this->db->query("DELETE FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}");

				$mapelgabungan = [];
				$mapeldayah_id = $this->input->post('mapeldayah_id');
				if(count($mapeldayah_id) > 0){
					foreach($mapeldayah_id as $_mapeldayah_id){
						array_push($mapelgabungan, ['mapel_id' => $mapel_id, 'mapeldayah_id' => $_mapeldayah_id]);
					}	
					$this->db->insert_batch('mapelgabungan', $mapelgabungan);
				}

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