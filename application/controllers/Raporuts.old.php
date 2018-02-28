<?php

require_once 'Backend.php';
require_once APPPATH . '/libraries/PHPExcel-1.8/Classes/PHPExcel.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Raporuts extends Backend {

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
        $this->load->view('raporuts/index', $data);
        $this->load->view('templates/footer');
    }

    public function coret(){
        $this->Rapormodel->get_total_nilai_uts(3, 2, 1, $kelompokmapel_id);
    }

    public function download(){

        // ini_set('memory_limit', '1000M');

        $kelas_id = $this->input->get('kelas_id') ? $this->input->get('kelas_id') : false;
        $semester_id = $this->input->get('semester_id') ? $this->input->get('semester_id') : false;
        $penempatansiswa_id = $this->input->get('penempatansiswa_id') ? $this->input->get('penempatansiswa_id') : false;

        $objPHPExcel = PHPExcel_IOFactory::load('raporuts.xlsx');

        $objWorksheet = $objPHPExcel->getActiveSheet();

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

        $x = 6;

        $objWorksheet->mergeCells("C$x:BM$x");
        $objWorksheet->getStyle("C$x:BM$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("C$x", $profile->alamat);

        $x++;

        $objWorksheet->mergeCells("C$x:BM$x");
        $objWorksheet->getStyle("C$x:BM$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("C$x", "RAPOR UJIAN TENGAH SEMESTER");

        $x++;

        $objWorksheet->mergeCells("C$x:J$x");
        $objWorksheet->getStyle("C$x:J$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("C$x", "Nama Sekolah");

        // $objWorksheet->mergeCells("C$x:J$x");
        $objWorksheet->getStyle("K$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("K$x", ":");

        $objWorksheet->mergeCells("L$x:AN$x");
        $objWorksheet->getStyle("L$x:AN$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("L$x", "Madrasah Aliyah Insan Qur'ani");

        $objWorksheet->mergeCells("AO$x:AW$x");
        $objWorksheet->getStyle("AO$x:AW$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AO$x", "Kelas");

        $objWorksheet->getStyle("AX$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AX$x", ":");

        $objWorksheet->mergeCells("AY$x:BM$x");
        $objWorksheet->getStyle("AY$x:BM$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AY$x", $penempatansiswa->kelas);

        $x++;

        $objWorksheet->mergeCells("C$x:J$x");
        $objWorksheet->getStyle("C$x:J$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("C$x", "Nama");

        // $objWorksheet->mergeCells("C$x:J$x");
        $objWorksheet->getStyle("K$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("K$x", ":");

        $objWorksheet->mergeCells("L$x:AN$x");
        $objWorksheet->getStyle("L$x:AN$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("L$x", $penempatansiswa->nama);

        $objWorksheet->mergeCells("AO$x:AW$x");
        $objWorksheet->getStyle("AO$x:AW$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AO$x", "Jurusan");

        $objWorksheet->getStyle("AX$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AX$x", ":");

        $objWorksheet->mergeCells("AY$x:BM$x");
        $objWorksheet->getStyle("AY$x:BM$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AY$x", $penempatansiswa->peminatan);

        $x++;

        $objWorksheet->mergeCells("C$x:J$x");
        $objWorksheet->getStyle("C$x:J$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("C$x", "NIS/NISN");

        // $objWorksheet->mergeCells("C$x:J$x");
        $objWorksheet->getStyle("K$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("K$x", ":");

        $objWorksheet->mergeCells("L$x:AN$x");
        $objWorksheet->getStyle("L$x:AN$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("L$x", $penempatansiswa->nis_lokal. '/'. $penempatansiswa->nisn);

        $objWorksheet->mergeCells("AO$x:AW$x");
        $objWorksheet->getStyle("AO$x:AW$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AO$x", "Semester");

        $objWorksheet->getStyle("AX$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AX$x", ":");

        $objWorksheet->mergeCells("AY$x:BM$x");
        $objWorksheet->getStyle("AY$x:BM$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AY$x", $semester->ganjil_genap);

        $x++;

        $objWorksheet->mergeCells("AO$x:AW$x");
        $objWorksheet->getStyle("AO$x:AW$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AO$x", "Tahun Pelajaran");

        $objWorksheet->getStyle("AX$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AX$x", ":");

        $objWorksheet->mergeCells("AY$x:BM$x");
        $objWorksheet->getStyle("AY$x:BM$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AY$x", $penempatansiswa->tahunajaran);

        $x +=2;

        $objWorksheet->mergeCells("C$x:BM$x");
        $objWorksheet->getStyle("C$x:BM$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("C$x", "CAPAIAN");

        $x++;

        $objWorksheet->mergeCells("C$x:Z". ($x + 1));
        $objWorksheet->getStyle("C$x:Z". ($x + 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("C$x", "MATA PELAJARAN");

        $objWorksheet->mergeCells("AA$x:AR". ($x + 1));
        $objWorksheet->getStyle("AA$x:AR". ($x + 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AA$x", "NAMA GURU BIDANG STUDI");

        $objWorksheet->mergeCells("AS$x:BM$x");
        $objWorksheet->getStyle("AS$x:BM$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AS$x", "NILAI");

        $objWorksheet->mergeCells("AS". ($x + 1) .":AY". ($x + 1));
        $objWorksheet->getStyle("AS". ($x + 1) .":AY". ($x + 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AS". ($x + 1), "Skala 100");

        $objWorksheet->mergeCells("AZ". ($x + 1) .":BF". ($x + 1));
        $objWorksheet->getStyle("AZ". ($x + 1) .":BF". ($x + 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AZ". ($x + 1), "Skala 4");

        $objWorksheet->mergeCells("BG". ($x + 1) .":BM". ($x + 1));
        $objWorksheet->getStyle("BG". ($x + 1) .":BM". ($x + 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("BG". ($x + 1), "Predikat");

        $x += 2;

        $no_mapel = 1;
        $kelompokmapel = $this->Rapormodel->get_kelompokmapel($kelas_id);

        foreach($kelompokmapel as $kelompok){
            $objWorksheet->mergeCells("C$x:BM$x");
            $objWorksheet->getStyle("C$x:BM$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
            $objWorksheet->setCellValue("C$x", $kelompok->kelompokmapel);

            $x++;

            $mapelparent = $this->Rapormodel->get_mapel_parent($kelas_id, $semester_id, $penempatansiswa_id, $kelompok->id);

            foreach($mapelparent as $parent){

                if($parent->has_child > 0) {

                    $objWorksheet->mergeCells("C$x:D$x");
                    $objWorksheet->getStyle("C$x:D$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("C$x", $no_mapel);

                    $objWorksheet->mergeCells("E$x:BM$x");
                    $objWorksheet->getStyle("E$x:BM$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("E$x", $parent->mapel);

                    $x++;

                    $mapelchild = $this->Rapormodel->get_mapel_child($kelas_id, $semester_id, $penempatansiswa_id, $kelompok->id, $parent->id);

                    foreach($mapelchild as $child){

                        $objWorksheet->mergeCells("E$x:Z$x");
                        $objWorksheet->getStyle("E$x:Z$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                        $objWorksheet->setCellValue("E$x", $child->mapel);

                        $objWorksheet->mergeCells("AA$x:AR$x");
                        $objWorksheet->getStyle("AA$x:AR$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                        $objWorksheet->setCellValue("AA$x", $child->guru);

                        $objWorksheet->mergeCells("AS$x:AY$x");
                        $objWorksheet->getStyle("AS$x:AY$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                        $objWorksheet->setCellValue("AS$x", $child->pengetahuan_nilai_uts);

                        $objWorksheet->mergeCells("AZ$x:BF$x");
                        $objWorksheet->getStyle("AZ$x:BF$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                        $objWorksheet->setCellValue("AZ$x", ($child->pengetahuan_nilai_uts / 25));

                        $objWorksheet->mergeCells("BG$x:BM$x");
                        $objWorksheet->getStyle("BG$x:BM$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                        $objWorksheet->setCellValue("BG$x", $child->pengetahuan_predikat_huruf);

                        $x++;
                    }

                    
                    $objWorksheet->mergeCells("C". ($x - count($mapelchild)) .":D" . ($x - 1));
                    $objWorksheet->getStyle("C". ($x - count($mapelchild)) .":D" . ($x - 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);

                }else{
                    $objWorksheet->mergeCells("C$x:D$x");
                    $objWorksheet->getStyle("C$x:D$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("C$x", $no_mapel);

                    $objWorksheet->mergeCells("E$x:Z$x");
                    $objWorksheet->getStyle("E$x:Z$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("E$x", $parent->mapel);

                    $objWorksheet->mergeCells("AA$x:AR$x");
                    $objWorksheet->getStyle("AA$x:AR$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("AA$x", $parent->guru);

                    $objWorksheet->mergeCells("AS$x:AY$x");
                    $objWorksheet->getStyle("AS$x:AY$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("AS$x", $parent->pengetahuan_nilai_uts);

                    $objWorksheet->mergeCells("AZ$x:BF$x");
                    $objWorksheet->getStyle("AZ$x:BF$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("AZ$x", ($parent->pengetahuan_nilai_uts / 25));

                    $objWorksheet->mergeCells("BG$x:BM$x");
                    $objWorksheet->getStyle("BG$x:BM$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("BG$x", $parent->pengetahuan_predikat_huruf);

                    $x++;
                }

                $no_mapel++;
            }
        }

        $objWorksheet->mergeCells("C$x:BM$x");
        $objWorksheet->getStyle("C$x:BM$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);

        $x++;

        $objWorksheet->mergeCells("C$x:AR$x");
        $objWorksheet->getStyle("C$x:AR$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("C$x", "Total Nilai");

        $objWorksheet->mergeCells("AS$x:AY$x");
        $objWorksheet->getStyle("AS$x:AY$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AS$x", "0");

        $objWorksheet->mergeCells("AZ$x:BF$x");
        $objWorksheet->getStyle("AZ$x:BF$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AZ$x", "0");

        $objWorksheet->mergeCells("AZ$x:BF$x");
        $objWorksheet->getStyle("AZ$x:BF$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AZ$x", "0");

        $objWorksheet->mergeCells("BG$x:BM". ($x + 1));
        $objWorksheet->getStyle("BG$x:BM". ($x + 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("BG$x", "0");

        $x++;

        $objWorksheet->mergeCells("C$x:AR$x");
        $objWorksheet->getStyle("C$x:AR$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("C$x", "Nilai Rata-rata");

        $objWorksheet->mergeCells("AS$x:AY$x");
        $objWorksheet->getStyle("AS$x:AY$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AS$x", "0");

        $objWorksheet->mergeCells("AZ$x:BF$x");
        $objWorksheet->getStyle("AZ$x:BF$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AZ$x", "0");

        $objWorksheet->mergeCells("AZ$x:BF$x");
        $objWorksheet->getStyle("AZ$x:BF$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AZ$x", "0");

        $x++;

        $objWorksheet->mergeCells("C$x:AR$x");
        $objWorksheet->getStyle("C$x:AR$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("C$x", "Rangking");

        $objWorksheet->mergeCells("AS$x:AV$x");
        $objWorksheet->getStyle("AS$x:AV$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AS$x", "0");

        $objWorksheet->mergeCells("AW$x:AZ$x");
        $objWorksheet->getStyle("AW$x:AZ$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AW$x", "dari");

        $objWorksheet->mergeCells("BA$x:BM$x");
        $objWorksheet->getStyle("BA$x:BM$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("BA$x", "33 Siswa");

        $x++;

        $objWorksheet->mergeCells("C$x:BM$x");
        $objWorksheet->getStyle("C$x:BM$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);

        $x++;

        $query = $this->db->query("SELECT
                                    penilaianextrakurikuler.id,
                                    penilaianextrakurikuler.penempatansiswa_id,
                                    penilaianextrakurikuler.extrakurikuler_id,
                                    penilaianextrakurikuler.predikat,
                                    penilaianextrakurikuler.keterangan,
                                    penilaianextrakurikuler.semester_id,
                                    extrakurikuler.extrakurikuler,
                                    extrakurikuler.tahunajaran_id,
                                    extrakurikuler.tingkat_id
                                    FROM
                                    penilaianextrakurikuler
                                    INNER JOIN extrakurikuler ON penilaianextrakurikuler.extrakurikuler_id = extrakurikuler.id
                                    WHERE penilaianextrakurikuler.penempatansiswa_id = {$penempatansiswa_id} ");

        $penilaianextrakurikuler = $query->num_rows() ? $query->result() : [];

        $objWorksheet->mergeCells("C$x:Z" . ($x + count($penilaianextrakurikuler)));
        $objWorksheet->getStyle("C$x:Z" . ($x + count($penilaianextrakurikuler)))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("C$x", "KEGIATAN EKTRAKURIKULER");

        $objWorksheet->mergeCells("AA$x:AL$x");
        $objWorksheet->getStyle("AA$x:AL$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AA$x", "Ekstrakurikuler");

        $objWorksheet->mergeCells("AM$x:AR$x");
        $objWorksheet->getStyle("AM$x:AR$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AM$x", "Predikat");

        $objWorksheet->mergeCells("AS$x:BM$x");
        $objWorksheet->getStyle("AS$x:BM$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AS$x", "Keterangan");

        $x++;
        $i = 1;


        foreach($penilaianextrakurikuler AS $pe){

            $objWorksheet->mergeCells("AA$x:AB$x");
            $objWorksheet->getStyle("AA$x:AB$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
            $objWorksheet->setCellValue("AA$x", $i.".");

            $objWorksheet->mergeCells("AC$x:AL$x");
            $objWorksheet->getStyle("AC$x:AL$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
            $objWorksheet->setCellValue("AC$x", $pe->extrakurikuler);

            $objWorksheet->mergeCells("AM$x:AR$x");
            $objWorksheet->getStyle("AM$x:AR$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
            $objWorksheet->setCellValue("AM$x", $pe->predikat);

            $objWorksheet->mergeCells("AS$x:BM$x");
            $objWorksheet->getStyle("AS$x:BM$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
            $objWorksheet->setCellValue("AS$x", $pe->keterangan);

            $x++;
            $i++;
        }

        $x++;

        $objWorksheet->mergeCells("AT$x:BK$x");
        $objWorksheet->getStyle("AT$x:BK$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        $objWorksheet->setCellValue("AT$x", "Aneuk Batee, ". date('d'). ' '. $bulan[date('n')]. ' '. date('Y'));

        $x++;

        $objWorksheet->mergeCells("E$x:Q$x");
        $objWorksheet->getStyle("E$x:Q$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("E$x", "Orang Tua/Wali");

        $objWorksheet->mergeCells("AT$x:BK$x");
        $objWorksheet->getStyle("AT$x:BK$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AT$x", "Wali Kelas");

        $x++;
        
        $objWorksheet->mergeCells("Z$x:AN$x");
        $objWorksheet->getStyle("Z$x:AN$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("Z$x", "Mengetahui");

        $x++;

        $objWorksheet->mergeCells("Z$x:AN$x");
        $objWorksheet->getStyle("Z$x:AN$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("Z$x", "Kepala Sekolah");

        $x++;        
        $x++;        

        $objWorksheet->mergeCells("E$x:Q$x");
        $objWorksheet->getStyle("E$x:Q$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("E$x", ".................................................");

        $objWorksheet->mergeCells("AT$x:BK$x");
        $objWorksheet->getStyle("AT$x:BK$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("AT$x", $penempatansiswa->nama_walikelas);

        $x++;
        $x++;

        $objWorksheet->mergeCells("Z$x:AN$x");
        $objWorksheet->getStyle("Z$x:AN$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => false], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_NONE, 'color' => ['argb', 'FFFF0000']]]]);
        $objWorksheet->setCellValue("Z$x", $profile->nama_kepala_sekolah);



        echo $x;





        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $filename = 'Rapor-UAS_'. str_replace('/', '-', $penempatansiswa->tahunajaran). '_' .$penempatansiswa->kelas . '_' . $semester->ganjil_genap . '_' . str_replace(' ', '-', $penempatansiswa->nama);
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