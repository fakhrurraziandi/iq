<?php

require_once 'Backend.php';
require_once APPPATH . '/libraries/PHPExcel-1.8/Classes/PHPExcel.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Rapor extends Backend {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Rapormodel');
	}

	public function html(){
		$content = $this->load->view('rapor/sample', '', true);
		file_put_contents('filename.html', $content);
		$objReader = new PHPExcel_Reader_HTML();
		$objPHPExcel = $objReader->load('filename.html');

		$objWorksheet = $objPHPExcel->getActiveSheet();

        $objWorksheet->getStyle('A1:E1')
            ->getAlignment()
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setWrapText(true);
        $objWorksheet->getStyle('A1:E9')
            ->getBorders()->getOutline();


		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('filename.xls');
		echo "<script>window.open('" . base_url('filename.xls') . "')</script>";
	}

	public function html_excel(){
		$objReader = new PHPExcel_Reader_HTML();
		$objPHPExcel = $objReader->load('rapor/html');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('raporsekolah.xls');
	}

	public function index(){

		// ini_set('memory_limit', '1000M');

		$kelas_id = $this->input->get('kelas_id') ? $this->input->get('kelas_id') : false;
		$semester_id = $this->input->get('semester_id') ? $this->input->get('semester_id') : false;
		$penempatansiswa_id = $this->input->get('penempatansiswa_id') ? $this->input->get('penempatansiswa_id') : false;

        $objPHPExcel = PHPExcel_IOFactory::load('template.xlsx');

		$objWorksheet = $objPHPExcel->getActiveSheet();



        $objWorksheet->setCellValue('C3', 'Nama Sekolah');
        $objWorksheet->setCellValue('K3', ':');
        $objWorksheet->mergeCells('L3:AQ3');
        $objWorksheet->setCellValue('L3', 'Madrasah Aliyah Insan Qur\'ani');
        $objWorksheet->setCellValue('AS3', 'Kelas');
        $objWorksheet->setCellValue('AY3', ':');
        $objWorksheet->mergeCells('AZ3:BM3');
        $objWorksheet->setCellValue('AZ3', 'XI-B');

        $objWorksheet->setCellValue('C4', 'Alamat');
        $objWorksheet->setCellValue('K4', ':');
        $objWorksheet->mergeCells('L4:AQ5');
        $objWorksheet->getStyle('L4:AQ5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)->setWrapText(true);
        $objWorksheet->setCellValue('L4', 'Jln. Banda Aceh – Medan Km.12,5 Komp. Masjid Baitul ‘Adhim Ds. Aneuk Batee Kec. Suka Makmur – Aceh Besar');
        $objWorksheet->setCellValue('AS4', 'Jurusan');
        $objWorksheet->setCellValue('AY4', ':');
        $objWorksheet->mergeCells('AZ4:BM4');
        $objWorksheet->setCellValue('AZ4', 'IPA');

        $objWorksheet->setCellValue('AS5', 'Semester');
        $objWorksheet->setCellValue('AY5', ':');
        $objWorksheet->mergeCells('AZ5:BM5');
        $objWorksheet->setCellValue('AZ5', 'Genap');

        $objWorksheet->setCellValue('C6', 'Nama');
        $objWorksheet->setCellValue('K6', ':');
        $objWorksheet->mergeCells('L6:AQ6');
        $objWorksheet->setCellValue('L6', 'Intan Lestari');

        /*
        $objWorksheet->setCellValue('AS6', 'Jurusan');
        $objWorksheet->setCellValue('AY6', ':');
        $objWorksheet->setCellValue('AZ6', 'IPA');
        */

        $objWorksheet->setCellValue('C7', 'NIS/NISN');
        $objWorksheet->setCellValue('K7', ':');
        $objWorksheet->mergeCells('L7:AQ7');
        $objWorksheet->setCellValue('L7', '047/0001798792');
        $objWorksheet->setCellValue('AS7', 'Tahun Pelajaran');
        $objWorksheet->setCellValue('BB7', ':');
        $objWorksheet->mergeCells('BC7:BM7');
        $objWorksheet->setCellValue('BC7', '2015/2016');

        $objWorksheet->mergeCells('C9:BM9');
        $objWorksheet->setCellValue('C9', 'CAPAIAN');

        $objWorksheet->mergeCells('C10:AA12');
        $objWorksheet->setCellValue('C10', 'MATA PELAJARAN');

        $objWorksheet->mergeCells('AB10:AD12');
        $objWorksheet->setCellValue('AB10', 'KM');

        $objWorksheet->mergeCells('AE10:AL10');
        $objWorksheet->setCellValue('AE10', 'Pengetahuan');
        $objWorksheet->mergeCells('AE11:AL11');
        $objWorksheet->setCellValue('AE11', '(KI 3)');

        $objWorksheet->mergeCells('AM10:AT10');
        $objWorksheet->setCellValue('AM10', 'Keterampilan');
        $objWorksheet->mergeCells('AM11:AT11');
        $objWorksheet->setCellValue('AM11', '(KI 4)');

        $objWorksheet->mergeCells('AU10:BM10');
        $objWorksheet->setCellValue('AU10', 'Sikap Spiritual dan Sosial');
        $objWorksheet->mergeCells('AU11:BM11');
        $objWorksheet->setCellValue('AU11', '(KI 1 dan KI 2)');

        $objWorksheet->mergeCells('AE12:AH12');
        $objWorksheet->setCellValue('AE12', 'Angka');
        $objWorksheet->mergeCells('AI12:AL12');
        $objWorksheet->setCellValue('AI12', 'Predikat');

        $objWorksheet->mergeCells('AM12:AP12');
        $objWorksheet->setCellValue('AM12', 'Angka');
        $objWorksheet->mergeCells('AQ12:AT12');
        $objWorksheet->setCellValue('AQ12', 'Predikat');

        $objWorksheet->mergeCells('AU12:AX12');
        $objWorksheet->setCellValue('AU12', 'Dalam');
        $objWorksheet->mergeCells('AY12:BM12');
        $objWorksheet->setCellValue('AY12', 'Antar Mapel');

        $objWorksheet->getStyle('C9:BM12')->applyFromArray([
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
        $antar_mapel_x = $x;

        // $query_kelompokmapel = $this->db->query("SELECT * FROM kelompokmapel WHERE kelompokmapel.kelas_id = 5");
        if($kelas_id){



        	$kelompokmapel_rows = $this->Rapormodel->get_kelompokmapel($kelas_id);

	        if($kelompokmapel_rows){

	        	$array_pengetahuan_nilai_rapor_sekolah = [];

	            foreach($kelompokmapel_rows as $kelompokmapel){
	                // C13:BM13
	                $objWorksheet->mergeCells("C$x:AX$x");
	                $objWorksheet->setCellValue("C$x", $kelompokmapel->kelompokmapel);

	                $objWorksheet->getStyle("C$x:AX$x")->applyFromArray([
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

	                $x++;

                	$mapel_rows = $this->Rapormodel->get_mapel($kelas_id, $semester_id, $penempatansiswa_id, $kelompokmapel->id);
                	// print_r($mapel_rows);
	                if($mapel_rows){

	                	

	                    $huruf_mapel = "a";
	                    foreach($mapel_rows as $mapel){
	                        if($mapel->parent == 1){

	                            $huruf_mapel = "a";

	                            
	                            if($mapel->has_child){
	                                $objWorksheet->mergeCells("C$x:D" . ($x + ($mapel->has_child * 2)));
	                                $objWorksheet->getStyle("C$x")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	                                $objWorksheet->setCellValue("C$x", $no_mapel);

	                                $objWorksheet->mergeCells("E$x:AX$x");
	                                $objWorksheet->setCellValue("E$x", $mapel->mapel);

	                                $objWorksheet->getStyle("C$x:AX$x")->applyFromArray([
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

	                            }else{

	                                $objWorksheet->mergeCells("C$x:D" . ($x + 1));
	                                $objWorksheet->getStyle("C$x")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	                                $objWorksheet->setCellValue("C$x", $no_mapel);

	                                $objWorksheet->mergeCells("E$x:AA$x");
	                                $objWorksheet->setCellValue("E$x", $mapel->mapel);

	                                $x++;

	                                

	                                $objWorksheet->mergeCells("E$x:J$x");
	                                $objWorksheet->setCellValue("E$x", "Nama Guru");
	                                $objWorksheet->setCellValue("K$x", ":");

	                                $objWorksheet->mergeCells("L$x:AA$x");
	                                $objWorksheet->getStyle("L$x:AA$x")->getAlignment()->setWrapText(true);
	                                $objWorksheet->setCellValue("L$x", $mapel->guru);

	                                $objWorksheet->mergeCells("AB". ($x-1) .":AD$x");
	                                $objWorksheet->setCellValue("AB" . ($x-1), "2,67");

	                                // $penilaian = $this->Rapormodel->get_penilaian($mapel->id, $penempatansiswa_id);

	                                $objWorksheet->mergeCells("AE". ($x-1) .":AH$x");
	                                $objWorksheet->setCellValue("AE" . ($x-1), isset($mapel->pengetahuan_nilai_rapor_sekolah) ? $mapel->pengetahuan_nilai_rapor_sekolah : 0);

	                                $array_pengetahuan_nilai_rapor_sekolah[] = isset($mapel->pengetahuan_nilai_rapor_sekolah) ? $mapel->pengetahuan_nilai_rapor_sekolah : 0;

	                                $objWorksheet->mergeCells("AI". ($x-1) .":AL$x");
	                                $objWorksheet->setCellValue("AI" . ($x-1), isset($mapel->pengetahuan_predikat_huruf) ? $mapel->pengetahuan_predikat_huruf : '-');

	                                $objWorksheet->mergeCells("AM". ($x-1) .":AP$x");
	                                $objWorksheet->setCellValue("AM" . ($x-1), isset($mapel->keterampilan_nilai_rapor_sekolah) ? $mapel->keterampilan_nilai_rapor_sekolah : 0);

	                                $objWorksheet->mergeCells("AQ". ($x-1) .":AT$x");
	                                $objWorksheet->setCellValue("AQ" . ($x-1), isset($mapel->keterampilan_predikat_huruf) ? $mapel->keterampilan_predikat_huruf : '-');

	                                $objWorksheet->mergeCells("AU". ($x-1) .":AX$x");
	                                $objWorksheet->setCellValue("AU" . ($x-1), isset($mapel->sikap_predikat_huruf) ? $mapel->sikap_predikat_huruf : '-');

	                                $objWorksheet->getStyle("AB". ($x-1) .":AX$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	                                $objWorksheet->getStyle("C". ($x - 1) .":AX$x")->applyFromArray([
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

	                                $objWorksheet->getStyle("E". ($x - 1) .":AA$x")->applyFromArray([
	                                    'borders' => [
	                                        'inside' => [
	                                            'style' => PHPExcel_Style_Border::BORDER_NONE,
	                                        ],
	                                    ]
	                                ]);
	                            }



	                            $no_mapel++;

	                        }else if ($mapel->parent == 0){

	                            $objWorksheet->mergeCells("E$x:F$x");
	                            $objWorksheet->setCellValue("E$x", $huruf_mapel);
	                            $objWorksheet->mergeCells("G$x:AA$x");
	                            $objWorksheet->setCellValue("G$x", $mapel->mapel);

	                            $x++;

	                            $objWorksheet->mergeCells("E$x:J$x");
	                            $objWorksheet->setCellValue("E$x", "Nama Guru");
	                            $objWorksheet->setCellValue("K$x", ":");

	                            $objWorksheet->mergeCells("L$x:AA$x");
	                            $objWorksheet->getStyle()->getAlignment()->setWrapText(true);
	                            $objWorksheet->setCellValue("L$x", $mapel->guru);

	                            $objWorksheet->mergeCells("AB". ($x-1) .":AD$x");
	                            $objWorksheet->setCellValue("AB" . ($x-1), "2,67");

	                            // $penilaian = $this->Rapormodel->get_penilaian($mapel->id, $penempatansiswa_id);



	                            $objWorksheet->mergeCells("AE". ($x-1) .":AH$x");
	                            $objWorksheet->setCellValue("AE" . ($x-1), isset($mapel->pengetahuan_nilai_rapor_sekolah) ? $mapel->pengetahuan_nilai_rapor_sekolah : 0);

	                            $array_pengetahuan_nilai_rapor_sekolah[] = isset($mapel->pengetahuan_nilai_rapor_sekolah) ? $mapel->pengetahuan_nilai_rapor_sekolah : 0;

	                            $objWorksheet->mergeCells("AI". ($x-1) .":AL$x");
	                            $objWorksheet->setCellValue("AI" . ($x-1), isset($mapel->pengetahuan_predikat_huruf) ? $mapel->pengetahuan_predikat_huruf : '-');

	                            $objWorksheet->mergeCells("AM". ($x-1) .":AP$x");
	                            $objWorksheet->setCellValue("AM" . ($x-1), isset($mapel->keterampilan_nilai_rapor_sekolah) ? $mapel->keterampilan_nilai_rapor_sekolah : 0);

	                            $objWorksheet->mergeCells("AQ". ($x-1) .":AT$x");
	                            $objWorksheet->setCellValue("AQ" . ($x-1), isset($mapel->keterampilan_predikat_huruf) ? $mapel->keterampilan_predikat_huruf : '-');

	                            $objWorksheet->mergeCells("AU". ($x-1) .":AX$x");
	                            $objWorksheet->setCellValue("AU" . ($x-1), isset($mapel->sikap_predikat_huruf) ? $mapel->sikap_predikat_huruf : '-');

	                            $objWorksheet->getStyle("AB". ($x-1) .":AX$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	                            $objWorksheet->getStyle("C". ($x - 1) .":AX$x")->applyFromArray([
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

	                            $objWorksheet->getStyle("E". ($x - 1) .":AA$x")->applyFromArray([
	                                'borders' => [
	                                    'inside' => [
	                                        'style' => PHPExcel_Style_Border::BORDER_NONE,
	                                    ],
	                                ]
	                            ]);



	                            $huruf_mapel++;
	                        }



	                        $x++;
	                    }
	                }

	            }




	           	$objWorksheet->mergeCells("AY$antar_mapel_x:BM". ($x - 1));
	            $objWorksheet->setCellValue("AY$antar_mapel_x", "Peserta didik sudah menunjukkan kesungguhannya dalam mengamalkan ajaran agama dengan sangat baik. Sudah menunjukkan sikap santun, kerja sama, gotong royong, cinta damai, ramah lingkungan, sikap jujur, peduli dan percaya diri.");
	            $objWorksheet->getStyle("AY$antar_mapel_x:BM". ($x - 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setWrapText(true);
	            $objWorksheet->getStyle("AY$antar_mapel_x:BM". ($x - 1))->applyFromArray([
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



	            $objWorksheet->mergeCells("C$x:BM$x");

                $x++;
                $objWorksheet->mergeCells("C$x:AA$x");
                $objWorksheet->setCellValue("C$x", "Total Nilai");
                $objWorksheet->getStyle("C$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objWorksheet->mergeCells("AB$x:BM$x");
                $objWorksheet->setCellValue("AB$x", array_sum($array_pengetahuan_nilai_rapor_sekolah));
                // $objWorksheet->getStyle("AB$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


                $x++;
                $objWorksheet->mergeCells("C$x:AA$x");
                $objWorksheet->setCellValue("C$x", "Nilai Rata-rata");
                $objWorksheet->getStyle("C$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objWorksheet->mergeCells("AB$x:BM$x");
                $objWorksheet->setCellValue("AB$x", array_sum($array_pengetahuan_nilai_rapor_sekolah) / count($array_pengetahuan_nilai_rapor_sekolah));
                // $objWorksheet->getStyle("AB$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


                $x++;
                $objWorksheet->mergeCells("C$x:AA$x");
                $objWorksheet->setCellValue("C$x", "Peringkat");
                $objWorksheet->getStyle("C$x:BM$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objWorksheet->mergeCells("AB$x:AE$x");
                $objWorksheet->setCellValue("AB$x", "3");
                
                $objWorksheet->mergeCells("AF$x:AK$x");
                $objWorksheet->setCellValue("AF$x", "dari");
                $objWorksheet->mergeCells("AL$x:BM$x");
                $objWorksheet->setCellValue("AL$x", "33 Siswa");
                $objWorksheet->getStyle("AL$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

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
                        'outline' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ],
                        'inside' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ]
                    ]
                ]);

                $x++;



				$objWorksheet->mergeCells("AB$x:AL$x");
				$objWorksheet->mergeCells("AM$x:AQ$x");
				$objWorksheet->mergeCells("AR$x:BM$x");
				$objWorksheet->getStyle("AB$x:BM$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objWorksheet->getStyle("AB$x:BM$x")->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ],
                        'inside' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ]
                    ]
                ]);

				$objWorksheet->setCellValue("AB$x", "Extrakurikuler");
				$objWorksheet->setCellValue("AM$x", "Predikat");
				$objWorksheet->setCellValue("AR$x", "Keterangan");

				$x++;



				$penilaianextrakurikuler = $this->Rapormodel->get_penilaianextrakurikuler($penempatansiswa_id, $semester_id);
				$no_extrakurikuler = 1;
				foreach($penilaianextrakurikuler as $penilaianextra){
					
					$objWorksheet->mergeCells("AC$x:AL$x");
					$objWorksheet->mergeCells("AM$x:AQ$x");
					$objWorksheet->mergeCells("AR$x:BM$x");
					$objWorksheet->setCellValue("AB$x", $no_extrakurikuler++);
					$objWorksheet->setCellValue("AC$x", $penilaianextra->extrakurikuler);
					$objWorksheet->setCellValue("AM$x", $penilaianextra->predikat);
					$objWorksheet->setCellValue("AR$x", $penilaianextra->keterangan);
					$x++;
				}

				

				$objWorksheet->mergeCells("C".($x - (count($penilaianextrakurikuler) + 1)).":AA" . ($x - 1));
				$objWorksheet->setCellValue("C".($x - (count($penilaianextrakurikuler) + 1)), "KEGIATAN EXTRAKURIKULER");
				$objWorksheet->getStyle("C".($x - (count($penilaianextrakurikuler) + 1)))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objWorksheet->getStyle("AM".($x - count($penilaianextrakurikuler)).":BM". ($x - 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$objWorksheet->getStyle("C".($x - (count($penilaianextrakurikuler) + 1)).":BM" . ($x - 1))->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ],
                        'inside' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ]
                    ]
                ]);

                // ----------------------------------------------------------------

                $objWorksheet->mergeCells("C$x:BM$x");
                $objWorksheet->getStyle("C$x:BM$x")->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ],
                        'inside' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ]
                    ]
                ]);

                $x++;
                $objWorksheet->mergeCells("C$x:AA". ($x + 1));
                $objWorksheet->getStyle("C$x:AA". ($x + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objWorksheet->mergeCells("AB$x:AN$x");
				$objWorksheet->mergeCells("AO$x:AZ$x");
				$objWorksheet->mergeCells("BA$x:BM$x");
				$objWorksheet->getStyle("AB$x:BM$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objWorksheet->getStyle("C$x:BM" . ($x + 1))->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ],
                        'inside' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ]
                    ]
                ]);


				$objWorksheet->setCellValue("C$x", "KEPRIBADIAN");
				$objWorksheet->setCellValue("AB$x", "Kelakuan");
				$objWorksheet->setCellValue("AO$x", "Kedisiplinan");
				$objWorksheet->setCellValue("BA$x", "Kerapian");

				$x++;

				$kepribadian = $this->Rapormodel->get_kepribadian($penempatansiswa_id, $semester_id, $kelas_id);

				$objWorksheet->mergeCells("AB$x:AN$x");
				$objWorksheet->mergeCells("AO$x:AZ$x");
				$objWorksheet->mergeCells("BA$x:BM$x");
				$objWorksheet->getStyle("AB$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objWorksheet->getStyle("AO$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objWorksheet->getStyle("BA$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objWorksheet->setCellValue("AB$x", $kepribadian->kelakuan);
				$objWorksheet->setCellValue("AO$x", $kepribadian->kedisiplinan);
				$objWorksheet->setCellValue("BA$x", $kepribadian->kerapian);


				$x++;

				$objWorksheet->mergeCells("C$x:BM$x");
                $objWorksheet->getStyle("C$x:BM$x")->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ],
                        'inside' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ]
                    ]
                ]);

                $x++;

                $rekapabsen = $this->Rapormodel->get_rekapabsen($penempatansiswa_id, $semester_id);

                $objWorksheet->mergeCells("AB$x:AQ$x");
				$objWorksheet->mergeCells("AR$x:BA$x");
				$objWorksheet->mergeCells("BB$x:BM$x");
				$objWorksheet->getStyle("AB$x:BM$x")->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ],
                    ]
                ]);
				$objWorksheet->getStyle("AB$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objWorksheet->getStyle("AR$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objWorksheet->getStyle("BB$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objWorksheet->setCellValue("AB$x", "Sakit");
				$objWorksheet->setCellValue("AR$x", $rekapabsen->sakit);
				$objWorksheet->setCellValue("BB$x", "Hari");

				$x++;

				$objWorksheet->mergeCells("AB$x:AQ$x");
				$objWorksheet->mergeCells("AR$x:BA$x");
				$objWorksheet->mergeCells("BB$x:BM$x");
				$objWorksheet->getStyle("AB$x:BM$x")->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ],
                    ]
                ]);
				$objWorksheet->getStyle("AB$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objWorksheet->getStyle("AR$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objWorksheet->getStyle("BB$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objWorksheet->setCellValue("AB$x", "Izin");
				$objWorksheet->setCellValue("AR$x", $rekapabsen->izin);
				$objWorksheet->setCellValue("BB$x", "Hari");

				$x++;

				$objWorksheet->mergeCells("AB$x:AQ$x");
				$objWorksheet->mergeCells("AR$x:BA$x");
				$objWorksheet->mergeCells("BB$x:BM$x");
				$objWorksheet->getStyle("AB$x:BM$x")->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ],
                    ]
                ]);
				$objWorksheet->getStyle("AB$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objWorksheet->getStyle("AR$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objWorksheet->getStyle("BB$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objWorksheet->setCellValue("AB$x", "Alpha");
				$objWorksheet->setCellValue("AR$x", $rekapabsen->alpha);
				$objWorksheet->setCellValue("BB$x", "Hari");

				$x++;

				$objWorksheet->mergeCells("AB$x:AQ$x");
				$objWorksheet->mergeCells("AR$x:BM$x");
				$objWorksheet->getStyle("AB$x:BM$x")->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ],
                    ]
                ]);
				
				$objWorksheet->getStyle("AB$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objWorksheet->getStyle("AR$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objWorksheet->setCellValue("AB$x", "Persentase Kehadiran");
				$objWorksheet->setCellValue("AR$x", "100%");

				$objWorksheet->mergeCells("C". ($x - 3) .":AA$x");
				$objWorksheet->getStyle("C". ($x - 3))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objWorksheet->setCellValue("C". ($x - 3), "KETIDAKHADIRAN DI SEKOLAH");
				$objWorksheet->getStyle("C". ($x - 3) .":AA$x")->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['argb', 'FFFF0000']
                        ],
                    ]
                ]);




	        }
        }



        $objWorksheet->getStyle('C10:BM12')
            ->getAlignment()
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('raporsekolah.xls');

		echo "<script>window.open('" . base_url('raporsekolah.xls') . "')</script>";
	}
}