<?php

require_once 'Backend.php';
require_once APPPATH . '/libraries/PHPExcel-1.8/Classes/PHPExcel.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Raporuas extends Backend {

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
		$this->load->view('raporuas/index', $data);
		$this->load->view('templates/footer');
	}

	public function download(){

		// ini_set('memory_limit', '1000M');

		$kelas_id = $this->input->get('kelas_id') ? $this->input->get('kelas_id') : false;
		$semester_id = $this->input->get('semester_id') ? $this->input->get('semester_id') : false;
		$penempatansiswa_id = $this->input->get('penempatansiswa_id') ? $this->input->get('penempatansiswa_id') : false;

        $objPHPExcel = PHPExcel_IOFactory::load('raporuas.xlsx');

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

		$x = 3;

		$objWorksheet->setCellValue("C$x", "Nama Sekolah");
        $objWorksheet->setCellValue("K$x", ":");
        $objWorksheet->mergeCells("L$x:AQ$x");
        $objWorksheet->setCellValue("L$x", $profile->nama_sekolah);
        $objWorksheet->setCellValue("AS$x", "Kelas");
        $objWorksheet->setCellValue("AY$x", ":");
        $objWorksheet->mergeCells("AZ$x:BM$x");
        $objWorksheet->setCellValue("AZ$x", $penempatansiswa->kelas);

        $x++;

        $objWorksheet->setCellValue("C$x", "Alamat");
        $objWorksheet->setCellValue("K$x", ":");
        $objWorksheet->mergeCells("L$x:AQ". ($x + 1));
        $objWorksheet->getStyle("L$x:AQ". ($x + 1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)->setWrapText(true);
        $objWorksheet->setCellValue("L$x", $profile->alamat);
        $objWorksheet->setCellValue("AS$x", "Jurusan");
        $objWorksheet->setCellValue("AY$x", ":");
        $objWorksheet->mergeCells("AZ$x:BM$x");
        $objWorksheet->setCellValue("AZ$x", $penempatansiswa->peminatan);

        $x++;

        $objWorksheet->setCellValue("AS$x", "Semester");
        $objWorksheet->setCellValue("AY$x", ":");
        $objWorksheet->mergeCells("AZ$x:BM$x");
        $objWorksheet->setCellValue("AZ$x", $semester->ganjil_genap);

        $x++;

        $objWorksheet->setCellValue("C$x", "Nama");
        $objWorksheet->setCellValue("K$x", ":");
        $objWorksheet->mergeCells("L$x:AQ$x");
        $objWorksheet->setCellValue("L$x", $penempatansiswa->nama);

        /*
        $x++;
        $objWorksheet->setCellValue("AS$x", "Jurusan");
        $objWorksheet->setCellValue("AY$x", ":");
        $objWorksheet->setCellValue("AZ$x", "IPA");
        */

        $x++;

        $objWorksheet->setCellValue("C$x", "NIS/NISN");
        $objWorksheet->setCellValue("K$x", ":");
        $objWorksheet->mergeCells("L$x:AQ$x");
        $objWorksheet->setCellValue("L$x", $penempatansiswa->nis_lokal . '/'. $penempatansiswa->nisn);
        $objWorksheet->setCellValue("AS$x", "Tahun Pelajaran");
        $objWorksheet->setCellValue("BB$x", ":");
        $objWorksheet->mergeCells("BC$x:BM$x");
        $objWorksheet->setCellValue("BC$x", $penempatansiswa->tahunajaran);

        $x++;
        $x++;

        $objWorksheet->mergeCells("C$x:BM$x");
        $objWorksheet->setCellValue("C$x", "CAPAIAN");

        $x++; // 10

        $objWorksheet->mergeCells("C$x:AA". ($x+2));
        $objWorksheet->setCellValue("C$x", "MATA PELAJARAN");

        $objWorksheet->mergeCells("AB$x:AD". ($x+2));
        $objWorksheet->setCellValue("AB$x", "KM");

        $objWorksheet->mergeCells("AE$x:AL$x");
        $objWorksheet->setCellValue("AE$x", "Pengetahuan");
        $objWorksheet->mergeCells("AE". ($x + 1) .":AL". ($x + 1));
        $objWorksheet->setCellValue("AE". ($x + 1) ."", "(KI 3)");

        $objWorksheet->mergeCells("AM$x:AT$x");
        $objWorksheet->setCellValue("AM$x", "Keterampilan");
        $objWorksheet->mergeCells("AM". ($x + 1) .":AT". ($x + 1));
        $objWorksheet->setCellValue("AM". ($x + 1) ."", "(KI 4)");

        // 10

        $objWorksheet->mergeCells("AU$x:BM$x");
        $objWorksheet->setCellValue("AU$x", "Sikap Spiritual dan Sosial");
        $objWorksheet->mergeCells("AU". ($x + 1) .":BM". ($x + 1) ."");
        $objWorksheet->setCellValue("AU". ($x + 1) ."", "(KI 1 dan KI 2)");

        $objWorksheet->getStyle("C$x:BM" . ($x+2))
            ->getAlignment()
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $x++;
        $x++;

        $objWorksheet->mergeCells("AE$x:AH$x");
        $objWorksheet->setCellValue("AE$x", "Angka");
        $objWorksheet->mergeCells("AI$x:AL$x");
        $objWorksheet->setCellValue("AI$x", "Predikat");

        $objWorksheet->mergeCells("AM$x:AP$x");
        $objWorksheet->setCellValue("AM$x", "Angka");
        $objWorksheet->mergeCells("AQ$x:AT$x");
        $objWorksheet->setCellValue("AQ$x", "Predikat");

        $objWorksheet->mergeCells("AU$x:AX$x");
        $objWorksheet->setCellValue("AU$x", "Dalam");
        $objWorksheet->mergeCells("AY$x:BM$x");
        $objWorksheet->setCellValue("AY$x", 'Antar Mapel');

        $objWorksheet->getStyle("C". ($x - 3) .":BM$x")->applyFromArray([
            'borders' => [
                'outline' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
                'inside' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);

        $x = 13;
        $no_mapel = 1;
        $merge_row_antar_mapel = 0;
        $kelompokmapel = $this->Rapormodel->get_kelompokmapel($kelas_id);

        foreach($kelompokmapel as $kelompok){

        	$merge_row_antar_mapel++;

        	$objWorksheet->mergeCells("C$x:AX$x");
        	$objWorksheet->setCellValue("C$x", $kelompok->kelompokmapel);
        	$objWorksheet->getStyle("C$x:AX$x")->applyFromArray([
	            'borders' => [
	                'allborders' => [
	                    'style' => PHPExcel_Style_Border::BORDER_THIN,
	                    'color' => ['argb', 'FFFF0000']
	                ]
	            ]
	        ]);
        	

        	$x++;

            $penilaian_rapor = $this->Rapormodel->get_penilaian_rapor($penempatansiswa_id, $semester_id, $kelompok->id);

            // print_r($penilaian_rapor);

            $huruf_mapel = 'a';

        	foreach($penilaian_rapor as $rapor){

                if($rapor->parent){

                    $huruf_mapel = 'a';

                    if($rapor->has_child){

                        $objWorksheet->mergeCells("C$x:D$x");
                        $objWorksheet->setCellValue("C$x", $no_mapel++);

                        $objWorksheet->mergeCells("E$x:AX$x");
                        $objWorksheet->setCellValue("E$x", $rapor->mapel);

                        $objWorksheet->getStyle("C$x:AX$x")->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);  

                        $x += 1;

                    }else{

                        $objWorksheet->mergeCells("C$x:D". ($x + 1));
                        $objWorksheet->setCellValue("C$x", $no_mapel++);

                        $objWorksheet->mergeCells("E$x:AA$x");
                        $objWorksheet->setCellValue("E$x", $rapor->mapel);

                        $objWorksheet->mergeCells("C". ($x + 1) .":D". ($x + 1));

                        $objWorksheet->mergeCells("E". ($x + 1) .":J". ($x + 1));
                        $objWorksheet->setCellValue("E". ($x + 1), "Nama Guru");

                        $objWorksheet->setCellValue("K". ($x + 1), ":");

                        $objWorksheet->mergeCells("L". ($x + 1) .":AA". ($x + 1));
                        $objWorksheet->setCellValue("L". ($x + 1), $rapor->guru);

                        $objWorksheet->mergeCells("AB". ($x) .":AD". ($x + 1));
                        $objWorksheet->setCellValue("AB". ($x), $rapor->kkm);

                        $objWorksheet->mergeCells("AE". ($x) .":AH". ($x + 1));
                        $objWorksheet->setCellValue("AE". ($x), $rapor->pengetahuan_nilai_rapor_sekolah ? $rapor->pengetahuan_nilai_rapor_sekolah : 0);

                        $objWorksheet->mergeCells("AI". ($x) .":AL". ($x + 1));
                        $objWorksheet->setCellValue("AI". ($x), $rapor->pengetahuan_predikat_huruf ? $rapor->pengetahuan_predikat_huruf : '-');

                        $objWorksheet->mergeCells("AM". ($x) .":AP". ($x + 1));
                        $objWorksheet->setCellValue("AM". ($x), $rapor->keterampilan_nilai_rapor_sekolah ? $rapor->keterampilan_nilai_rapor_sekolah : 0);

                        $objWorksheet->mergeCells("AQ". ($x) .":AT". ($x + 1));
                        $objWorksheet->setCellValue("AQ". ($x), $rapor->keterampilan_predikat_huruf ? $rapor->keterampilan_predikat_huruf : '-');

                        $objWorksheet->mergeCells("AU". ($x) .":AX". ($x + 1));
                        $objWorksheet->setCellValue("AU". ($x), $rapor->sikap_predikat_huruf ? $rapor->sikap_predikat_huruf : '-');

                        $objWorksheet->getStyle("C$x:D". ($x + 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);  

                        $objWorksheet->getStyle("E$x:AA". ($x + 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['outline' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]); 

                        $objWorksheet->getStyle("AB$x:AX". ($x + 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);  

                        $x += 2;
                    }

                }else{

                    $objWorksheet->mergeCells("C$x:D" . ($x + 1));

                    $objWorksheet->mergeCells("E$x:F$x");
                    $objWorksheet->setCellValue("E$x", $huruf_mapel);

                    $objWorksheet->mergeCells("G$x:AA$x");
                    $objWorksheet->setCellValue("G$x", $rapor->mapel);

                    $objWorksheet->mergeCells("C". ($x + 1) .":D". ($x + 1));

                    $objWorksheet->mergeCells("E". ($x + 1) .":J". ($x + 1));
                    $objWorksheet->setCellValue("E". ($x + 1), "Nama Guru");

                    $objWorksheet->setCellValue("K". ($x + 1), ":");

                    $objWorksheet->mergeCells("L". ($x + 1) .":AA". ($x + 1));
                    $objWorksheet->setCellValue("L". ($x + 1), $rapor->guru);

                    $objWorksheet->mergeCells("AB". ($x) .":AD". ($x + 1));
                    $objWorksheet->setCellValue("AB". ($x), $rapor->kkm);

                    $objWorksheet->mergeCells("AE". ($x) .":AH". ($x + 1));
                    $objWorksheet->setCellValue("AE". ($x), $rapor->pengetahuan_nilai_rapor_sekolah ? $rapor->pengetahuan_nilai_rapor_sekolah : 0);

                    $objWorksheet->mergeCells("AI". ($x) .":AL". ($x + 1));
                    $objWorksheet->setCellValue("AI". ($x), $rapor->pengetahuan_predikat_huruf ? $rapor->pengetahuan_predikat_huruf : '-');

                    $objWorksheet->mergeCells("AM". ($x) .":AP". ($x + 1));
                    $objWorksheet->setCellValue("AM". ($x), $rapor->keterampilan_nilai_rapor_sekolah ? $rapor->keterampilan_nilai_rapor_sekolah : 0);

                    $objWorksheet->mergeCells("AQ". ($x) .":AT". ($x + 1));
                    $objWorksheet->setCellValue("AQ". ($x), $rapor->keterampilan_predikat_huruf ? $rapor->keterampilan_predikat_huruf : '-');

                    $objWorksheet->mergeCells("AU". ($x) .":AX". ($x + 1));
                    $objWorksheet->setCellValue("AU". ($x), $rapor->sikap_predikat_huruf ? $rapor->sikap_predikat_huruf : '-');


                    $objWorksheet->getStyle("C$x:D". ($x + 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);  

                    $objWorksheet->getStyle("E$x:AA". ($x + 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['outline' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]); 

                    $objWorksheet->getStyle("AB$x:AX". ($x + 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);  




                    $x += 2;
                    $huruf_mapel++;               
                }
            }
        }

        $objWorksheet->mergeCells("AY13:BM". ($x - 1));
        $objWorksheet->getStyle("AY13:BM". ($x - 1))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);  
        $objWorksheet->setCellValue("AY13", "Peserta didik sudah menunjukkan kesungguhannya dalam mengamalkan ajaran agama dengan sangat baik. Sudah menunjukkan sikap santun, kerja sama, gotong royong, cinta damai, ramah lingkungan, sikap jujur, peduli dan percaya diri.");
        

    	

        
        $objWorksheet->mergeCells("C$x:BM$x");
        $objWorksheet->getStyle("C$x:BM$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);

        $ledger_uas_siswa = $this->Rapormodel->get_ledger_uas_siswa($kelas_id, $semester_id, $penempatansiswa_id);

        print_r($ledger_uas_siswa);


        $x++;
        $objWorksheet->mergeCells("C$x:AA$x");
        $objWorksheet->getStyle("C$x:AA$x")->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objWorksheet->setCellValue("C$x", "Total Nilai");

		$objWorksheet->mergeCells("AB$x:BM$x");
        $objWorksheet->getStyle("AB$x:BM$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$objWorksheet->setCellValue("AB$x", $ledger_uas_siswa->total_nilai);

		$x++;
        $objWorksheet->mergeCells("C$x:AA$x");
        $objWorksheet->getStyle("C$x:AA$x")->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objWorksheet->setCellValue("C$x", "Nilai Rata Rata");

		$objWorksheet->mergeCells("AB$x:BM$x");
        $objWorksheet->getStyle("AB$x:BM$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$objWorksheet->setCellValue("AB$x", $ledger_uas_siswa->nilai_rata_rata);

		$x++;
        $objWorksheet->mergeCells("C$x:AA$x");
        $objWorksheet->getStyle("C$x:AA$x")->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objWorksheet->setCellValue("C$x", "Peringkat");

		$objWorksheet->mergeCells("AB$x:AE$x");
        $objWorksheet->getStyle("AB$x:AE$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objWorksheet->setCellValue("AB$x", $ledger_uas_siswa->ranking);

		$objWorksheet->mergeCells("AF$x:AK$x");
        $objWorksheet->getStyle("AF$x:AK$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objWorksheet->setCellValue("AF$x", "dari");

		$objWorksheet->mergeCells("AL$x:BM$x");
        $objWorksheet->getStyle("AL$x:BM$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$objWorksheet->setCellValue("AL$x", $ledger_uas_siswa->dari ." Siswa");

		$objWorksheet->getStyle("C". ($x - 2) .":BM$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);

        $objWorksheet->getStyle("AB$x:BM$x")->applyFromArray([
            'borders' => [
                'inside' => [
                    'style' => PHPExcel_Style_Border::BORDER_NONE,
                ],
            ]
        ]);

        $x++;

        $objWorksheet->mergeCells("C$x:BM$x");
        $objWorksheet->getStyle("C$x:BM$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);

        $x++;

        $objWorksheet->mergeCells("AB$x:AL$x");
        $objWorksheet->getStyle("AB$x:AL$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("AB$x:AL$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("AB$x", "Ekstrakurikuler");

        $objWorksheet->mergeCells("AM$x:AQ$x");
        $objWorksheet->getStyle("AM$x:AQ$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("AM$x:AQ$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("AM$x", "Predikat");

        $objWorksheet->mergeCells("AR$x:BM$x");
        $objWorksheet->getStyle("AR$x:BM$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("AR$x:BM$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("AR$x", "Keterangan");



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

        if($penilaianextrakurikuler){
            
            $objWorksheet->mergeCells("C$x:AA". ($x + count($penilaianextrakurikuler)));
            $objWorksheet->getStyle("C$x:AA". ($x + count($penilaianextrakurikuler)))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objWorksheet->getStyle("C$x:AA". ($x + count($penilaianextrakurikuler)))->applyFromArray([
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['argb', 'FFFF0000']
                    ],
                ]
            ]);
            $objWorksheet->setCellValue("C$x", "KEGIATAN EKSTRAKURIKULER");

            $i = 1;
            foreach($penilaianextrakurikuler as $pe){

                $x++;

                $objWorksheet->setCellValue("AB$x", $i .".");
                $objWorksheet->getStyle("AB$x")->applyFromArray([
                    'borders' => [
                        'allborders' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ],
                    ]
                ]);

                $objWorksheet->mergeCells("AC$x:AL$x");
                $objWorksheet->getStyle("AC$x:AL$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objWorksheet->getStyle("AC$x:AL$x")->applyFromArray([
                    'borders' => [
                        'allborders' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ],
                    ]
                ]);
                $objWorksheet->setCellValue("AC$x", $pe->extrakurikuler);

                $objWorksheet->mergeCells("AM$x:AQ$x");
                $objWorksheet->getStyle("AM$x:AQ$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objWorksheet->getStyle("AM$x:AQ$x")->applyFromArray([
                    'borders' => [
                        'allborders' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ],
                    ]
                ]);
                $objWorksheet->setCellValue("AM$x", $pe->predikat);

                $objWorksheet->mergeCells("AR$x:BM$x");
                $objWorksheet->getStyle("AR$x:BM$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objWorksheet->getStyle("AR$x:BM$x")->applyFromArray([
                    'borders' => [
                        'allborders' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ],
                    ]
                ]);
                $objWorksheet->setCellValue("AR$x", $pe->keterangan);

                $i++;
            }

            $x++;

            $objWorksheet->mergeCells("C$x:BM$x");
            $objWorksheet->getStyle("C$x:BM". ($x + count($penilaianextrakurikuler)))->applyFromArray([
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['argb', 'FFFF0000']
                    ],
                ]
            ]);
        }

        $x++;

        $objWorksheet->mergeCells("C$x:AA". ($x + 1));
        $objWorksheet->getStyle("C$x:AA". ($x + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("C$x:AA". ($x + 1))->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("C$x", "KEPRIBADIAN");


        $objWorksheet->mergeCells("AB$x:AN$x");
        $objWorksheet->getStyle("AB$x:AN$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("AB$x:AN$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("AB$x", "Kelakuan");

        $objWorksheet->mergeCells("AO$x:AZ$x");
        $objWorksheet->getStyle("AO$x:AZ$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("AO$x:AZ$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("AO$x", "Kedisiplinan");


        $objWorksheet->mergeCells("BA$x:BM$x");
        $objWorksheet->getStyle("BA$x:BM$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("BA$x:BM$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("BA$x", "Kerapian");

        $x++;

        $query = $this->db->query("SELECT * FROM kepribadian WHERE penempatansiswa_id = {$penempatansiswa_id}");
        $kepribadian = $query->num_rows() ? $query->row() : false;

        if($kepribadian){
            $kelakuan = $kepribadian->kelakuan;
            $kedisiplinan = $kepribadian->kedisiplinan;
            $kerapian = $kepribadian->kerapian;
        }else{
            $kelakuan = '';
            $kedisiplinan = '';
            $kerapian = '';
        }

        $objWorksheet->mergeCells("AB$x:AN$x");
        $objWorksheet->getStyle("AB$x:AN$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("AB$x:AN$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("AB$x", $kelakuan);

        $objWorksheet->mergeCells("AO$x:AZ$x");
        $objWorksheet->getStyle("AO$x:AZ$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("AO$x:AZ$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("AO$x", $kedisiplinan);


        $objWorksheet->mergeCells("BA$x:BM$x");
        $objWorksheet->getStyle("BA$x:BM$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("BA$x:BM$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("BA$x", $kerapian);

        $x++;

        $objWorksheet->mergeCells("C$x:BM$x");
        $objWorksheet->getStyle("C$x:BM$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);

        $x++;

        


        $objWorksheet->mergeCells("C$x:AA". ($x + 3));
        $objWorksheet->getStyle("C$x:AA". ($x + 3))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("C$x:AA". ($x + 3))->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("C$x", "KEHADIRAN");

        $query = $this->db->query("SELECT * FROM rekapabsen WHERE rekapabsen.penempatansiswa_id = {$penempatansiswa_id}");
        $rekapabsen = $query->num_rows() ? $query->row() : false;

        if($rekapabsen){
            $sakit = $rekapabsen->sakit;
            $izin  = $rekapabsen->izin;
            $alpha = $rekapabsen->alpha;
        }else{
            $sakit = '';
            $izin  = '';
            $alpha = '';
        }

        $objWorksheet->mergeCells("AB$x:AQ$x");
        $objWorksheet->getStyle("AB$x:AQ$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("AB$x:AQ$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("AB$x", "Sakit");

        $objWorksheet->mergeCells("AR$x:BA$x");
        $objWorksheet->getStyle("AR$x:BA$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("AR$x:BA$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("AR$x", $sakit);

        $objWorksheet->mergeCells("BB$x:BM$x");
        $objWorksheet->getStyle("BB$x:BM$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("BB$x:BM$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("BB$x", "Hari");

        $x++;


        $objWorksheet->mergeCells("AB$x:AQ$x");
        $objWorksheet->getStyle("AB$x:AQ$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("AB$x:AQ$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("AB$x", "Izin");

        $objWorksheet->mergeCells("AR$x:BA$x");
        $objWorksheet->getStyle("AR$x:BA$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("AR$x:BA$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("AR$x", $izin);

        $objWorksheet->mergeCells("BB$x:BM$x");
        $objWorksheet->getStyle("BB$x:BM$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("BB$x:BM$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("BB$x", "Hari");

        $x++;

        $objWorksheet->mergeCells("AB$x:AQ$x");
        $objWorksheet->getStyle("AB$x:AQ$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("AB$x:AQ$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("AB$x", "Tanpa Keterangan");

        $objWorksheet->mergeCells("AR$x:BA$x");
        $objWorksheet->getStyle("AR$x:BA$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("AR$x:BA$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("AR$x", $alpha);

        $objWorksheet->mergeCells("BB$x:BM$x");
        $objWorksheet->getStyle("BB$x:BM$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("BB$x:BM$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("BB$x", "Hari");

        $x++;

        $objWorksheet->mergeCells("AB$x:AQ$x");
        $objWorksheet->getStyle("AB$x:AQ$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("AB$x:AQ$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("AB$x", "Persentase Kehadiran");

        $objWorksheet->mergeCells("AR$x:BM$x");
        $objWorksheet->getStyle("AR$x:BM$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->getStyle("AR$x:BM$x")->applyFromArray([
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['argb', 'FFFF0000']
                ],
            ]
        ]);
        $objWorksheet->setCellValue("AR$x", "100%");

        $x++;

        $objWorksheet->mergeCells("C$x:BM$x");

        $x++;

        $objWorksheet->mergeCells("AT$x:BK$x");
        $objWorksheet->getStyle("AT$x:BK$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $objWorksheet->setCellValue("AT$x", "Aneuk Batee, ". date('d') .' '. $bulan[date('n')]. ' ' . date('Y'));

        $x++;

        $objWorksheet->mergeCells("E$x:Q$x");
        $objWorksheet->getStyle("E$x:Q$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->setCellValue("E$x", "Orang Tua/Wali");

        $objWorksheet->mergeCells("AT$x:BK$x");
        $objWorksheet->getStyle("AT$x:BK$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->setCellValue("AT$x", "Wali Kelas");

        $x++;

        $objWorksheet->mergeCells("AB$x:AL$x");
        $objWorksheet->getStyle("AB$x:AL$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->setCellValue("AB$x", "Mengetahui");

        $x++;

        $objWorksheet->mergeCells("AB$x:AL$x");
        $objWorksheet->getStyle("AB$x:AL$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->setCellValue("AB$x", "Kepala Sekolah");

        $x += 2;

        $objWorksheet->mergeCells("E$x:Q$x");
        $objWorksheet->getStyle("E$x:Q$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->setCellValue("E$x", "(............................)");

        $objWorksheet->mergeCells("AT$x:BK$x");
        $objWorksheet->getStyle("AT$x:BK$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->setCellValue("AT$x", $penempatansiswa->nama_walikelas);

        $x += 2;

        $objWorksheet->mergeCells("AB$x:AL$x");
        $objWorksheet->getStyle("AB$x:AL$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->setCellValue("AB$x", $profile->nama_kepala_sekolah);

        $x += 3;

        $objWorksheet->setCellValue("C$x", "Nama Sekolah");
        $objWorksheet->setCellValue("K$x", ":");
        $objWorksheet->mergeCells("L$x:AQ$x");
        $objWorksheet->setCellValue("L$x", $profile->nama_sekolah);
        $objWorksheet->setCellValue("AS$x", "Kelas");
        $objWorksheet->setCellValue("AY$x", ":");
        $objWorksheet->mergeCells("AZ$x:BM$x");
        $objWorksheet->setCellValue("AZ$x", $penempatansiswa->kelas);

        $x++;

        $objWorksheet->setCellValue("C$x", "Alamat");
        $objWorksheet->setCellValue("K$x", ":");
        $objWorksheet->mergeCells("L$x:AQ". ($x + 1));
        $objWorksheet->getStyle("L$x:AQ". ($x + 1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)->setWrapText(true);
        $objWorksheet->setCellValue("L$x", $profile->alamat);
        $objWorksheet->setCellValue("AS$x", "Jurusan");
        $objWorksheet->setCellValue("AY$x", ":");
        $objWorksheet->mergeCells("AZ$x:BM$x");
        $objWorksheet->setCellValue("AZ$x", $penempatansiswa->peminatan);

        $x++;

        $objWorksheet->setCellValue("AS$x", "Semester");
        $objWorksheet->setCellValue("AY$x", ":");
        $objWorksheet->mergeCells("AZ$x:BM$x");
        $objWorksheet->setCellValue("AZ$x", $semester->ganjil_genap);

        $x++;

        $objWorksheet->setCellValue("C$x", "Nama");
        $objWorksheet->setCellValue("K$x", ":");
        $objWorksheet->mergeCells("L$x:AQ$x");
        $objWorksheet->setCellValue("L$x", $penempatansiswa->nama);

        /*
        $x++;
        $objWorksheet->setCellValue("AS$x", "Jurusan");
        $objWorksheet->setCellValue("AY$x", ":");
        $objWorksheet->setCellValue("AZ$x", "IPA");
        */

        $x++;

        $objWorksheet->setCellValue("C$x", "NIS/NISN");
        $objWorksheet->setCellValue("K$x", ":");
        $objWorksheet->mergeCells("L$x:AQ$x");
        $objWorksheet->setCellValue("L$x", $penempatansiswa->nis_lokal . '/'. $penempatansiswa->nisn);
        $objWorksheet->setCellValue("AS$x", "Tahun Pelajaran");
        $objWorksheet->setCellValue("BB$x", ":");
        $objWorksheet->mergeCells("BC$x:BM$x");
        $objWorksheet->setCellValue("BC$x", $penempatansiswa->tahunajaran);

        $x++;

        $objWorksheet->mergeCells("C$x:BM$x");

        $x++;

        $objWorksheet->mergeCells("C$x:X". ($x + 1));
        $objWorksheet->getStyle("C$x:X". ($x + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->setCellValue("C$x", "MATA PELAJARAN");

        $objWorksheet->mergeCells("Y$x:AK". ($x + 1));
        $objWorksheet->getStyle("Y$x:AK". ($x + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->setCellValue("Y$x", "KOMPETENSI");

        $objWorksheet->mergeCells("AL$x:BM". ($x + 1));
        $objWorksheet->getStyle("AL$x:BM". ($x + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objWorksheet->setCellValue("AL$x", "CATATAN");

        $objWorksheet->getStyle("C$x:BM". ($x + 1))->applyFromArray(['borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);

        $x += 2;

        $no_mapel = 1;
        foreach($kelompokmapel as $kelompok){

            $objWorksheet->mergeCells("C$x:BM$x");
            $objWorksheet->getStyle("C$x:BM$x")->applyFromArray(['borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
            $objWorksheet->setCellValue("C$x", $kelompok->kelompokmapel);

            $x++;

            $mapelparent = $this->Rapormodel->get_mapel_parent($kelas_id, $semester_id, $penempatansiswa_id, $kelompok->id);

            // print_r($mapelparent);
            


            foreach($mapelparent as $parent){

                if($parent->has_child > 0) { 

                    
                    
                    $objWorksheet->setCellValue("C$x", $no_mapel);

                    $objWorksheet->mergeCells("E$x:BM$x");
                    $objWorksheet->getStyle("E$x:BM$x")->applyFromArray(['borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("E$x", $parent->mapel);

                    $mapelchild = $this->Rapormodel->get_mapel_child($kelas_id, $semester_id, $penempatansiswa_id, $kelompok->id, $parent->id);

                    // print_r($mapelchild);

                    $objWorksheet->mergeCells("C$x:D" . ($x + (count($mapelchild) * 9)));
                    $objWorksheet->getStyle("C$x:D" . ($x + (count($mapelchild) * 9)))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP, ], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000'] ] ] ]);
                    $x++;
                    // print_r($mapelchild); die();

                    $huruf_mapel_child = 'a';

                    

                    foreach($mapelchild as $child){

                        $objWorksheet->mergeCells("E$x:F$x");
                        $objWorksheet->getStyle("E$x:F$x")->applyFromArray(['borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                        $objWorksheet->setCellValue("E$x", $huruf_mapel_child);

                        $objWorksheet->mergeCells("G$x:X$x");
                        $objWorksheet->getStyle("G$x:X$x")->applyFromArray(['borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                        $objWorksheet->setCellValue("G$x", $child->mapel);

                        $objWorksheet->mergeCells("E". ($x + 1) .":J". ($x + 8));
                        $objWorksheet->getStyle("E". ($x + 1) .":J". ($x + 8))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                        $objWorksheet->setCellValue("E". ($x + 1), "Nama Guru");

                        $objWorksheet->mergeCells("K". ($x + 1) .":K". ($x + 8));
                        $objWorksheet->getStyle("K". ($x + 1) .":K". ($x + 8))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                        $objWorksheet->setCellValue("K". ($x + 1), ":");

                        $objWorksheet->mergeCells("L". ($x + 1) .":X". ($x + 8));
                        $objWorksheet->getStyle("L". ($x + 1) .":X". ($x + 8))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                        $objWorksheet->setCellValue("L". ($x + 1), $child->guru);

                        $objWorksheet->mergeCells("Y$x:AK". ($x + 2));
                        $objWorksheet->getStyle("Y$x:AK". ($x + 2))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                        $objWorksheet->setCellValue("Y$x", "Pengetahuan");

                        $objWorksheet->mergeCells("Al$x:BM". ($x + 2));
                        $objWorksheet->getStyle("Al$x:BM". ($x + 2))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                        $objWorksheet->setCellValue("Al$x", trim($child->pengetahuan_predikat_deskripsi));

                        $objWorksheet->mergeCells("Y". ($x + 3) .":AK". ($x + 5));
                        $objWorksheet->getStyle("Y". ($x + 3) .":AK". ($x + 5))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                        $objWorksheet->setCellValue("Y". ($x + 3), "Keterampilan");

                        $objWorksheet->mergeCells("Al". ($x + 3) .":BM". ($x + 5));
                        $objWorksheet->getStyle("Al". ($x + 3) .":BM". ($x + 5))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                        $objWorksheet->setCellValue("Al". ($x + 3), trim($child->keterampilan_predikat_deskripsi));

                        $objWorksheet->mergeCells("Y". ($x + 6) .":AK". ($x + 8));
                        $objWorksheet->getStyle("Y". ($x + 6) .":AK". ($x + 8))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                        $objWorksheet->setCellValue("Y". ($x + 6), "Sikap Spiritual dan Sosial");

                        $objWorksheet->mergeCells("Al". ($x + 6) .":BM". ($x + 8));
                        $objWorksheet->getStyle("Al". ($x + 6) .":BM". ($x + 8))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                        $objWorksheet->setCellValue("Al". ($x + 6), trim($child->sikap_predikat_deskripsi));

                        $x += 9;
                    }
                }else{ 

                    

                    $objWorksheet->mergeCells("C$x:D". ($x + 8));
                    $objWorksheet->getStyle("C$x:D". ($x + 8))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("C$x", $no_mapel);

                    $objWorksheet->mergeCells("E$x:X$x");
                    $objWorksheet->getStyle("E$x:X$x")->applyFromArray(['borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("E$x", $parent->mapel);

                    $objWorksheet->mergeCells("E". ($x + 1) .":J". ($x + 8));
                    $objWorksheet->getStyle("E". ($x + 1) .":J". ($x + 8))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("E". ($x + 1), "Nama Guru");

                    $objWorksheet->mergeCells("K". ($x + 1) .":K". ($x + 8));
                    $objWorksheet->getStyle("K". ($x + 1) .":K". ($x + 8))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("K". ($x + 1), ":");

                    $objWorksheet->mergeCells("L". ($x + 1) .":X". ($x + 8));
                    $objWorksheet->getStyle("L". ($x + 1) .":X". ($x + 8))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("L". ($x + 1), $parent->guru);

                    $objWorksheet->mergeCells("Y$x:AK". ($x + 2));
                    $objWorksheet->getStyle("Y$x:AK". ($x + 2))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("Y$x", "Pengetahuan");

                    $objWorksheet->mergeCells("Al$x:BM". ($x + 2));
                    $objWorksheet->getStyle("Al$x:BM". ($x + 2))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("Al$x", $parent->pengetahuan_predikat_deskripsi);

                    $objWorksheet->mergeCells("Y". ($x + 3) .":AK". ($x + 5));
                    $objWorksheet->getStyle("Y". ($x + 3) .":AK". ($x + 5))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("Y". ($x + 3), "Keterampilan");

                    $objWorksheet->mergeCells("Al". ($x + 3) .":BM". ($x + 5));
                    $objWorksheet->getStyle("Al". ($x + 3) .":BM". ($x + 5))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("Al". ($x + 3), $parent->keterampilan_predikat_deskripsi);

                    $objWorksheet->mergeCells("Y". ($x + 6) .":AK". ($x + 8));
                    $objWorksheet->getStyle("Y". ($x + 6) .":AK". ($x + 8))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("Y". ($x + 6), "Sikap Spiritual dan Sosial");

                    $objWorksheet->mergeCells("Al". ($x + 6) .":BM". ($x + 8));
                    $objWorksheet->getStyle("Al". ($x + 6) .":BM". ($x + 8))->applyFromArray(['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true], 'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['argb', 'FFFF0000']]]]);
                    $objWorksheet->setCellValue("Al". ($x + 6), $parent->sikap_predikat_deskripsi);

                    $x += 9;
                }

                $no_mapel++;
            }


        }


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