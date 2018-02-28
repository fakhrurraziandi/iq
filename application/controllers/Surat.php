<?php


require_once 'Backend.php';
require_once APPPATH. '/../vendor/autoload.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends Backend {

	public function __construct(){

		parent::__construct();
		$this->load->model('Tahunajaranmodel');
		$this->load->model('Tingkatmodel');
		$this->load->model('Kelasmodel');
		$this->load->model('Rapormodel');
	}

	public function index(){

		$data['tahunajaran'] = $this->Tahunajaranmodel->all();
		$data['tingkat']     = $this->Tingkatmodel->all();

		$this->load->view('templates/header');
		$this->load->view('templates/nav-'. $this->session->userdata('group'));
		$this->load->view('surat/index', $data);
		$this->load->view('templates/footer');
	}

    public function download(){

        $kelas_id = $this->input->get('kelas_id') ? $this->input->get('kelas_id') : false;
        $semester_id = $this->input->get('semester_id') ? $this->input->get('semester_id') : false;
        $penempatansiswa_id = $this->input->get('penempatansiswa_id') ? $this->input->get('penempatansiswa_id') : false;

        $query = $this->db->query("SELECT
                                    siswa.id AS siswa_id,
                                    siswa.nisn,
                                    siswa.nis_lokal,
                                    siswa.nama,
                                    siswa.jenis_kelamin,
                                    siswa.tingkat_id,
                                    siswa.kelas_id,
                                    penempatansiswa.id,
                                    penempatansiswa.kelas_id,
                                    penempatansiswa.siswa_id,
                                    kelas.id AS kelas_id,
                                    kelas.tingkat_id,
                                    kelas.peminatan_id,
                                    kelas.paralel,
                                    kelas.guru_id,
                                    kelas.tahunajaran_id,
                                    CONCAT(tingkat, '-', paralel) AS kelas,
                                    peminatan.id,
                                    peminatan.peminatan,
                                    tahunajaran.id AS tahunajaran_id,
                                    CONCAT(tahunajaran.tahun_awal, '/', tahunajaran.tahun_akhir) AS tahunajaran,
                                    tingkat.id,
                                    tingkat.tingkat,
                                    guru.nama as nama_walikelas,
                                    guru.kode,
                                    guru.nip_nignp
                                    FROM
                                    penempatansiswa
                                    INNER JOIN siswa ON penempatansiswa.siswa_id = siswa.id
                                    INNER JOIN kelas ON penempatansiswa.kelas_id = kelas.id
                                    INNER JOIN tingkat ON kelas.tingkat_id = tingkat.id
                                    INNER JOIN tahunajaran ON kelas.tahunajaran_id = tahunajaran.id
                                    LEFT JOIN peminatan ON peminatan.id = kelas.peminatan_id
                                    LEFT JOIN guru ON kelas.guru_id = guru.id
                                    WHERE penempatansiswa.id = {$penempatansiswa_id} ");

        $penempatansiswa = $query->num_rows() ? $query->row() : die('Error: Siswa tidak ditemukan dalam database!');
        echo '<pre>';
        print_r($penempatansiswa);
        echo '<pre>';
        // die();

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('surat_keterangan_aktif_belajar.docx');
        $templateProcessor->setValue('nama', $penempatansiswa->nama);
        $templateProcessor->setValue('tempat_tgl_lahir', 'Bireuen, 02 Agustus 2000');
        $templateProcessor->setValue('jenis_kelamin', 'Perempuan');
        $templateProcessor->setValue('no_induk_nisn', $penempatansiswa->nis_lokal .'/'. $penempatansiswa->nisn);
        $templateProcessor->setValue('kelas', $penempatansiswa->kelas);
        $templateProcessor->setValue('kelas2', $penempatansiswa->kelas);
        $templateProcessor->setValue('tahun_ajaran', $penempatansiswa->tahunajaran);

        $filename = 'surat_keterangan_aktif_belajar_'.str_replace(' ', '_', $penempatansiswa->nama).'.docx';
        $templateProcessor->saveAs($filename);



        /*$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $filename = 'helloWorld.docx';
        $objWriter->save($filename);*/
        echo "<script>window.open('" . base_url($filename) . "')</script>";
    }
	


	public function json(){

		header('Content-Type: application/json');

		$result = [
			'total' => 0,
			// 'rows' => []
		];

		$semester_id = ($this->input->get('semester_id')) ? $this->input->get('semester_id') : false;
		$kelas_id  = ($this->input->get('kelas_id')) ? $this->input->get('kelas_id') : false;
		// $semester_id  = ($this->input->get('semester_id')) ? $this->input->get('semester_id') : 10;

		if($semester_id AND $kelas_id){
			$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 10;
			$offset = ($this->input->get('offset')) ? $this->input->get('offset') : 0;
			$search = ($this->input->get('search')) ? $this->input->get('search') : '';
			$sort   = ($this->input->get('sort')) ? $this->input->get('sort') : '';
			$order  = ($this->input->get('order')) ? $this->input->get('order') : '';

			$sql = "SELECT x.* FROM (
						SELECT
							penempatansiswa.id,
							penempatansiswa.kelas_id,
							penempatansiswa.siswa_id,
							siswa.nisn,
							siswa.nis_lokal,
							siswa.nama,
							siswa.jenis_kelamin
						FROM
							penempatansiswa
						INNER JOIN siswa ON penempatansiswa.siswa_id = siswa.id
						INNER JOIN kelas ON penempatansiswa.kelas_id = kelas.id
						WHERE penempatansiswa.kelas_id = {$kelas_id}
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

	

   
}