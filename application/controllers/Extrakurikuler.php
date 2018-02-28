<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Extrakurikuler extends Backend {

	public function __construct(){
		parent::__construct();
	}

	public function json_extrakurikuler(){
		header('Content-Type: application/json');

		$tahunajaran_id  = ($this->input->get('tahunajaran_id')) ? $this->input->get('tahunajaran_id') : false;
		$tingkat_id  = ($this->input->get('tingkat_id')) ? $this->input->get('tingkat_id') : false;

		if($tahunajaran_id AND $tingkat_id){
			$query = $this->db->query("SELECT * FROM extrakurikuler WHERE extrakurikuler.tahunajaran_id = {$tahunajaran_id} AND extrakurikuler.tingkat_id = {$tingkat_id} ");
			if($query->num_rows()){
				echo json_encode($query->result());
			}else{
				echo json_encode([]);	
			}
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

		$tahunajaran_id  = ($this->input->get('tahunajaran_id')) ? $this->input->get('tahunajaran_id') : false;
		$tingkat_id  = ($this->input->get('tingkat_id')) ? $this->input->get('tingkat_id') : false;

		if($tahunajaran_id AND $tingkat_id){

			$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 10;
			$offset = ($this->input->get('offset')) ? $this->input->get('offset') : 0;
			$search = ($this->input->get('search')) ? $this->input->get('search') : '';
			$sort   = ($this->input->get('sort')) ? $this->input->get('sort') : '';
			$order  = ($this->input->get('order')) ? $this->input->get('order') : '';

			$sql = "SELECT x.* FROM (
						SELECT
							extrakurikuler.id,
							extrakurikuler.extrakurikuler,
							extrakurikuler.tahunajaran_id,
							extrakurikuler.tingkat_id
						FROM
							extrakurikuler 
						WHERE 
							extrakurikuler.tahunajaran_id = {$tahunajaran_id} AND 
							extrakurikuler.tingkat_id = {$tingkat_id} 
					) x ";

			if($search !== ''){
			    $sql .= "WHERE
			    			x.id LIKE '%". $search ."%' OR 
							x.extrakurikuler LIKE '%". $search ."%' OR 
							x.tahunajaran_id LIKE '%". $search ."%' OR 
							x.tingkat_id LIKE '%". $search ."%' ";
			}

			if($sort !== ''){
			    $sql .= "ORDER BY x.". $sort . " " . $order. " ";
			}else{
			    $sql .= "ORDER BY x.id ASC ";
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

		$this->form_validation->set_rules('extrakurikuler', 'extrakurikuler', 'required');

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$formData = [
				'tahunajaran_id'          => $this->input->post('tahunajaran_id'),
				'tingkat_id'          => $this->input->post('tingkat_id'),
				'extrakurikuler'          => $this->input->post('extrakurikuler'),
			];

			$insert = $this->db->insert('extrakurikuler', $formData);

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
        $query = $this->db->get_where('extrakurikuler', $data);
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

    public function update(){
        header('Content-Type: application/json');

        $result = [];

        $this->form_validation->set_rules('extrakurikuler', 'extrakurikuler', 'required');

        if($this->form_validation->run() == false){
            $result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();
        }else{
            $id = $this->input->post('id');
            $data = [
				'extrakurikuler'          => $this->input->post('extrakurikuler'),
            ];
            $this->db->where('id', $id);
            $query = $this->db->update('extrakurikuler', $data);
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
        $query = $this->db->delete('extrakurikuler');
        if($query){
            $result['status'] = 'success';
        }else{
            $result['status'] = 'error';
        }

        echo json_encode($result);
    }

    public function form(){
    	echo '
    		<form action="'. base_url('extrakurikuler/submit') .'" method="POST">
    			<input type="text" name="predikat[1]"><br />
    			<textarea name="keterangan[1]"></textarea><br /><br />
    			<input type="text" name="predikat[2]"><br />
    			<textarea name="keterangan[2]"></textarea><br /><br />
    			<input type="text" name="predikat[4]"><br />
    			<textarea name="keterangan[4]"></textarea><br /><br />
    			<input type="submit">
    		</form>
    	';
    }

    public function submit(){
    	print_r($_POST);
    }
}