<?php

require_once 'Backend.php';
require_once APPPATH . '/libraries/PHPExcel-1.8/Classes/PHPExcel.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Rapordayah extends Backend {

	public function __construct(){
		parent::__construct();
		$this->load->model('Tahunajaranmodel');
		$this->load->model('Tingkatmodel');
		$this->load->model('Kelasmodel');
		$this->load->model('Rapordayahmodel');

        $this->load->helper('arabic_helper');
	}

	public function index(){

		$data['tahunajaran'] = $this->Tahunajaranmodel->all();
		$data['tingkat']     = $this->Tingkatmodel->all();

		$this->load->view('templates/header');
		$this->load->view('templates/nav-'. $this->session->userdata('group'));
		$this->load->view('rapordayah/index', $data);
		$this->load->view('templates/footer');
	}

	public function download(){

		// ini_set('memory_limit', '1000M');



		$kelas_id = $this->input->get('kelas_id') ? $this->input->get('kelas_id') : false;
		$semester_id = $this->input->get('semester_id') ? $this->input->get('semester_id') : false;
		$penempatansiswa_id = $this->input->get('penempatansiswa_id') ? $this->input->get('penempatansiswa_id') : false;

        $objPHPExcel = PHPExcel_IOFactory::load('rapordayah.xlsx');

		$objWorksheet = $objPHPExcel->getActiveSheet();

		$query = $this->db->query("SELECT
                                    siswa.id AS siswa_id,
                                    siswa.nisn,
                                    siswa.nis_lokal,
                                    siswa.nama,
                                    siswa.nama_hijaiyah,
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

		// print_r($penempatansiswa); die();

		$query = $this->db->query("SELECT
										`profile`.id,
										`profile`.nama_sekolah,
                                        `profile`.alamat,
										`profile`.nama_kepala_sekolah
									FROM
										`profile`
									WHERE `profile`.id = 1");
		$profile = $query->num_rows() ? $query->row() : die("Error: Profile Sekolah belum di set! harap hubungi administrator");

		$query = $this->db->query("SELECT
										semester.id,
										semester.ganjil_genap,
										semester.tahunajaran_id
									FROM
										semester
									WHERE semester.id = {$semester_id} ");
		$semester = $query->num_rows() ? $query->row() : die("Error: Semester Tidak ditemukan");

		$x = 9;

        $objWorksheet->mergeCells("BP$x:BU$x");
        $objWorksheet->getStyle("BP$x:BU$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $jenis_kelamin = '';
        if($penempatansiswa->jenis_kelamin == 'p'){
            $jenis_kelamin = 'اسم الطالب';
        }else if($penempatansiswa->jenis_kelamin == 'l'){
            $jenis_kelamin = 'اسم الطالبة';
        }
        $objWorksheet->setCellValue("BP$x", $jenis_kelamin);

        // $objWorksheet->mergeCells("BP$x:BU$x");
        $objWorksheet->getStyle("BO$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("BO$x", ":");


        $objWorksheet->mergeCells("AT$x:BN$x");
        $objWorksheet->getStyle("AT$x:BN$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AT$x", $penempatansiswa->nama_hijaiyah);

        $objWorksheet->mergeCells("AI$x:AL$x");
        $objWorksheet->getStyle("AI$x:AL$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AI$x", "المرحلة");

        // $objWorksheet->mergeCells("AI$x:AL$x");
        $objWorksheet->getStyle("AH$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AH$x", ":");

        $objWorksheet->mergeCells("K$x:AG$x");
        $objWorksheet->getStyle("K$x:AG$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("K$x", "");

        

        $x++;


        $objWorksheet->mergeCells("BP$x:BU$x");
        $objWorksheet->getStyle("BP$x:BU$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("BP$x", "رقم القيد");

        // $objWorksheet->mergeCells("BP$x:BU$x");
        $objWorksheet->getStyle("BO$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("BO$x", ":");


        $objWorksheet->mergeCells("AT$x:BN$x");
        $objWorksheet->getStyle("AT$x:BN$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AT$x", $penempatansiswa->nis_lokal);

        $objWorksheet->mergeCells("AI$x:AL$x");
        $objWorksheet->getStyle("AI$x:AL$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AI$x", "الفصل");

        // $objWorksheet->mergeCells("AI$x:AL$x");
        $objWorksheet->getStyle("AH$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AH$x", ":");

        $objWorksheet->mergeCells("K$x:AG$x");
        $objWorksheet->getStyle("K$x:AG$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("K$x", arabic_kelas($penempatansiswa->tingkat_id) . ' - '. arabic_character($penempatansiswa->paralel));

        

        $x++;


        $objWorksheet->mergeCells("BH$x:BU" . ($x + 3));
        $objWorksheet->getStyle("BH$x:BU" . ($x + 3))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("BH$x", "المواد الدراسية");

        $objWorksheet->mergeCells("AX$x:BG$x");
        $objWorksheet->getStyle("AX$x:BG$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AX$x", "الدرجة الكبرى");

        $objWorksheet->mergeCells("AT$x:AW$x");
        $objWorksheet->getStyle("AT$x:AW$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AT$x", "١٠٠");

        $objWorksheet->mergeCells("AX". ($x + 1) .":BG". ($x + 1));
        $objWorksheet->getStyle("AX". ($x + 1) .":BG". ($x + 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AX". ($x + 1), "الدرجة الصغرى");

        $objWorksheet->mergeCells("AT". ($x + 1) . ":AW". ($x + 1));
        $objWorksheet->getStyle("AT". ($x + 1) . ":AW". ($x + 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AT". ($x + 1), "٠");

        $objWorksheet->mergeCells("AT". ($x + 2) . ":BG". ($x + 2));
        $objWorksheet->getStyle("AT". ($x + 2) . ":BG". ($x + 2))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AT". ($x + 2), "الدرجة المكتسبة");

        $objWorksheet->mergeCells("BD". ($x + 3) . ":BG". ($x + 3));
        $objWorksheet->getStyle("BD". ($x + 3) . ":BG". ($x + 3))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("BD". ($x + 3), "رقم");

        $objWorksheet->mergeCells("AT". ($x + 3) . ":BC". ($x + 3));
        $objWorksheet->getStyle("AT". ($x + 3) . ":BC". ($x + 3))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AT". ($x + 3), "كتابة");

        $objWorksheet->mergeCells("AM$x:AS" . ($x + 3));
        $objWorksheet->getStyle("AM$x:AS" . ($x + 3))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AM$x", "المعدلة للفصل");


        // -----------------------------------------------------------------------------------

        $objWorksheet->mergeCells("Y$x:AL" . ($x + 3));
        $objWorksheet->getStyle("Y$x:AL" . ($x + 3))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("Y$x", "المواد الدراسية");

        $objWorksheet->mergeCells("O$x:X$x");
        $objWorksheet->getStyle("O$x:X$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("O$x", "الدرجة الكبرى");

        $objWorksheet->mergeCells("K$x:N$x");
        $objWorksheet->getStyle("K$x:N$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("K$x", "١٠٠");

        $objWorksheet->mergeCells("O". ($x + 1) .":X". ($x + 1));
        $objWorksheet->getStyle("O". ($x + 1) .":X". ($x + 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("O". ($x + 1), "الدرجة الصغرى");

        $objWorksheet->mergeCells("K". ($x + 1) . ":N". ($x + 1));
        $objWorksheet->getStyle("K". ($x + 1) . ":N". ($x + 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("K". ($x + 1), "٠");

        $objWorksheet->mergeCells("K". ($x + 2) . ":X". ($x + 2));
        $objWorksheet->getStyle("K". ($x + 2) . ":X". ($x + 2))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("K". ($x + 2), "الدرجة المكتسبة");

        $objWorksheet->mergeCells("U". ($x + 3) . ":X". ($x + 3));
        $objWorksheet->getStyle("U". ($x + 3) . ":X". ($x + 3))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("U". ($x + 3), "رقم");

        $objWorksheet->mergeCells("K". ($x + 3) . ":T". ($x + 3));
        $objWorksheet->getStyle("K". ($x + 3) . ":T". ($x + 3))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("K". ($x + 3), "كتابة");

        $objWorksheet->mergeCells("C$x:J" . ($x + 3));
        $objWorksheet->getStyle("C$x:J" . ($x + 3))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("C$x", "المعدلة للفصل");

        $x++;

        

        $x = 15;



        $mapeldayah = $this->Rapordayahmodel->get_mapel($kelas_id, $semester_id, $penempatansiswa_id);
        $per_chunk = floor(count($mapeldayah) / 2);
        $mapeldayah = array_chunk($mapeldayah, $per_chunk);

        

        if(isset($mapeldayah[0])){
            foreach($mapeldayah[0] as $mapel){

                $objWorksheet->mergeCells("BH$x:BU$x");
                $objWorksheet->getStyle("BH$x:BU$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                $objWorksheet->setCellValue("BH$x", $mapel->mapel_hijaiyah);

                $objWorksheet->mergeCells("BD$x:BG$x");
                $objWorksheet->getStyle("BD$x:BG$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                $objWorksheet->setCellValue("BD$x", ($mapel->pengetahuan_nilai_rapor_dayah) ? arabic_w2e("" . $mapel->pengetahuan_nilai_rapor_dayah) : '-');

                $objWorksheet->mergeCells("AT$x:BC$x");
                $objWorksheet->getStyle("AT$x:BC$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                $objWorksheet->setCellValue("AT$x", (arabic_terbilang(arabic_w2e($mapel->pengetahuan_nilai_rapor_dayah))) ? arabic_terbilang(arabic_w2e($mapel->pengetahuan_nilai_rapor_dayah)) : '-');

                $objWorksheet->mergeCells("AM$x:AS$x");
                $objWorksheet->getStyle("AM$x:AS$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                $objWorksheet->setCellValue("AM$x", arabic_w2e("" .$this->Rapordayahmodel->get_nilai_rapor_dayah_rata_rata($kelas_id, $semester_id, $mapel->id)));

                $x++;
            }

            $x = 15;
        }

        if(isset($mapeldayah[1])){
            foreach($mapeldayah[1] as $mapel){

                


                $objWorksheet->mergeCells("Y$x:AL$x");
                $objWorksheet->getStyle("Y$x:AL$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                $objWorksheet->setCellValue("Y$x", $mapel->mapel_hijaiyah);

                $objWorksheet->mergeCells("U$x:X$x");
                $objWorksheet->getStyle("U$x:X$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                $objWorksheet->setCellValue("U$x", ($mapel->pengetahuan_nilai_rapor_dayah) ? arabic_w2e("" . $mapel->pengetahuan_nilai_rapor_dayah) : '-');

                $objWorksheet->mergeCells("K$x:T$x");
                $objWorksheet->getStyle("K$x:T$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                $objWorksheet->setCellValue("K$x", (arabic_terbilang(arabic_w2e($mapel->pengetahuan_nilai_rapor_dayah))) ? arabic_terbilang(arabic_w2e($mapel->pengetahuan_nilai_rapor_dayah)) : '-');

                $objWorksheet->mergeCells("C$x:J$x");
                $objWorksheet->getStyle("C$x:J$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                $objWorksheet->setCellValue("C$x", arabic_w2e("" .$this->Rapordayahmodel->get_nilai_rapor_dayah_rata_rata($kelas_id, $semester_id, $mapel->id)));
                

                $x++;
            }
        }



        



        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $filename = 'Rapor-Dayah_'. str_replace('/', '-', $penempatansiswa->tahunajaran). '_' .$penempatansiswa->kelas . '_' . $semester->ganjil_genap . '_' . str_replace(' ', '-', $penempatansiswa->nama);
		$objWriter->save($filename.'.xls');

		echo "<script>window.open('" . base_url($filename.'.xls') . "')</script>";
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

	public function create(){

		header('Content-Type: application/json');

		$result = [
			'status' => 'success',
			'error_message' => [],
		];


		
		$this->form_validation->set_rules('kelakuan', 'kelakuan', 'required');
		$this->form_validation->set_rules('kedisiplinan', 'kedisiplinan', 'required');
		$this->form_validation->set_rules('kerapian', 'kerapian', 'required');
		

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$formData = [
				'penempatansiswa_id' => $this->input->post('penempatansiswa_id'),
				'semester_id'        => $this->input->post('semester_id'),
				'kelakuan'           => $this->input->post('kelakuan'),
				'kedisiplinan'       => $this->input->post('kedisiplinan'),
				'kerapian'           => $this->input->post('kerapian'),
			];

			$insert = $this->db->insert('kepribadian', $formData);

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
        $query = $this->db->query("SELECT * FROM `kepribadian` WHERE kepribadian.id = {$id}");
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

    public function update(){
        header('Content-Type: application/json');

        $result = [];

        $this->form_validation->set_rules('kelakuan', 'kelakuan', 'required');
		$this->form_validation->set_rules('kedisiplinan', 'kedisiplinan', 'required');
		$this->form_validation->set_rules('kerapian', 'kerapian', 'required');

        if($this->form_validation->run() == false){
            $result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();
        }else{
            $id = $this->input->post('id');
            $data = [
				'kelakuan'           => $this->input->post('kelakuan'),
				'kedisiplinan'       => $this->input->post('kedisiplinan'),
				'kerapian'           => $this->input->post('kerapian'),
            ];
            $this->db->where('id', $id);
            $query = $this->db->update('kepribadian', $data);
            if($query){
                $result['status'] = 'success';
            }else{
                $result['status'] = 'error';
            }
        }

        echo json_encode($result);
    }

   
}