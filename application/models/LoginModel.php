<?php 

class LoginModel extends CI_Model{

	public function submitLogin(){

		$result = [
			'status' => 'success',
			'error_messages' => []
		];

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		
		if($this->form_validation->run() == false){
            $result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();
		}else{
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));

			$query = $this->db->query("SELECT 
											user.id, 
											user.nama, 
											user.username, 
											user.group_id, 
											user.guru_id, 
											group.group
										FROM user 
										INNER JOIN `group` 
										ON user.group_id = group.id 
										WHERE user.username = '{$username}' AND user.password = '{$password}'");
			if($query->num_rows() > 0){
				$result['status'] = 'success';
				$user = $query->row();
				$this->session->set_userdata([
					'id'       => $user->id,
					'nama'     => $user->nama,
					'group_id' => $user->group_id,
					'guru_id'  => $user->guru_id,
					'group'    => $user->group,
				]);

			}else{
				$result['status'] = 'error';
			}
		}

		return $result;
	}
}