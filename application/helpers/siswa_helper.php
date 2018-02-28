
<?php

if(!function_exists('get_status_siswa')){
	function get_status_siswa($kode){
		$data = [
			1 => 'Naik dari tingkat sebelumnya',
			2 => 'Mengulang (tidak naik kelas)',
			3 => 'Siswa pindah/mutasi masuk',
			4 => 'Drop-out kembali',
			5 => 'Siswa baru tingkat 10',
		];

		return array_key_exists($kode, $data) ? $data[$kode] : '';
	}
}