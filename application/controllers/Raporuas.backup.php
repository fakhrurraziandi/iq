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

        $objPHPExcel = PHPExcel_IOFactory::load('template.xlsx');

		$objWorksheet = $objPHPExcel->getActiveSheet();

		$x = 3;

        $objWorksheet->setCellValue("C$x", "Nama Sekolah");
        $objWorksheet->setCellValue("K$x", ":");
        $objWorksheet->mergeCells("L$x:AQ$x");
        $objWorksheet->setCellValue("L$x", "Madrasah Aliyah Insan Qur\"ani");
        $objWorksheet->setCellValue("AS$x", "Kelas");
        $objWorksheet->setCellValue("AY$x", ":");
        $objWorksheet->mergeCells("AZ$x:BM$x");
        $objWorksheet->setCellValue("AZ$x", "XI-B");

        $x++;

        $objWorksheet->setCellValue("C$x", "Alamat");
        $objWorksheet->setCellValue("K$x", ":");
        $objWorksheet->mergeCells("L$x:AQ". ($x + 1));
        $objWorksheet->getStyle("L$x:AQ". ($x + 1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)->setWrapText(true);
        $objWorksheet->setCellValue("L$x", "Jln. Banda Aceh – Medan Km.12,5 Komp. Masjid Baitul ‘Adhim Ds. Aneuk Batee Kec. Suka Makmur – Aceh Besar");
        $objWorksheet->setCellValue("AS$x", "Jurusan");
        $objWorksheet->setCellValue("AY$x", ":");
        $objWorksheet->mergeCells("AZ$x:BM$x");
        $objWorksheet->setCellValue("AZ$x", 'IPA');

        $x++;

        $objWorksheet->setCellValue("AS$x", "Semester");
        $objWorksheet->setCellValue("AY$x", ":");
        $objWorksheet->mergeCells("AZ$x:BM$x");
        $objWorksheet->setCellValue("AZ$x", "Genap");

        $x++;

        $objWorksheet->setCellValue("C$x", "Nama");
        $objWorksheet->setCellValue("K$x", ":");
        $objWorksheet->mergeCells("L$x:AQ$x");
        $objWorksheet->setCellValue("L$x", "Intan Lestari");

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
        $objWorksheet->setCellValue("L$x", "047/0001798792");
        $objWorksheet->setCellValue("AS$x", "Tahun Pelajaran");
        $objWorksheet->setCellValue("BB$x", ":");
        $objWorksheet->mergeCells("BC$x:BM$x");
        $objWorksheet->setCellValue("BC$x", "2015/2016");

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

                $x++;
                $x++;

                $objWorksheet->mergeCells("AT$x:BK$x");
                $objWorksheet->getStyle("AT$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objWorksheet->setCellValue("AT$x", "Aneuk Batee, 23 Juni 2016");

                $x++;

                $objWorksheet->mergeCells("E$x:Q$x");
                $objWorksheet->getStyle("E$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objWorksheet->setCellValue("E$x", "Orang Tua/Wali");

				$objWorksheet->mergeCells("AT$x:BK$x");
                $objWorksheet->getStyle("AT$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objWorksheet->setCellValue("AT$x", "Wali kelas");

                $x++;

            	$objWorksheet->mergeCells("Y$x:AO$x");
                $objWorksheet->getStyle("Y$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objWorksheet->setCellValue("Y$x", "Mengetahui");

                $x++;

                $objWorksheet->mergeCells("Y$x:AO$x");
                $objWorksheet->getStyle("Y$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objWorksheet->setCellValue("Y$x", "Kepala Sekolah");

                $x++;

                $objWorksheet->mergeCells("E$x:Q$x");
                $objWorksheet->getStyle("E$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objWorksheet->setCellValue("E$x", "(.......................)");

				$objWorksheet->mergeCells("AT$x:BK$x");
                $objWorksheet->getStyle("AT$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objWorksheet->setCellValue("AT$x", "Istiqamah, Lc.");

                $x++;
                $x++;

                $objWorksheet->mergeCells("Y$x:AO$x");
                $objWorksheet->getStyle("Y$x")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objWorksheet->setCellValue("Y$x", "Wahyu Saputra, S.Pd.I.");


            	$x++;
            	$x++;
            	$x++;
            	$x++;





	        }
        }

        $x++;
        $x++;
        $x++;
        $x++;



        $objWorksheet->setCellValue("C$x", "Nama Sekolah");
        $objWorksheet->setCellValue("K$x", ":");
        $objWorksheet->mergeCells("L$x:AQ$x");
        $objWorksheet->setCellValue("L$x", "Madrasah Aliyah Insan Qur\"ani");
        $objWorksheet->setCellValue("AS$x", "Kelas");
        $objWorksheet->setCellValue("AY$x", ":");
        $objWorksheet->mergeCells("AZ$x:BM$x");
        $objWorksheet->setCellValue("AZ$x", "XI-B");

        $x++;

        $objWorksheet->setCellValue("C$x", "Alamat");
        $objWorksheet->setCellValue("K$x", ":");
        $objWorksheet->mergeCells("L$x:AQ". ($x + 1));
        $objWorksheet->getStyle("L$x:AQ". ($x + 1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)->setWrapText(true);
        $objWorksheet->setCellValue("L$x", "Jln. Banda Aceh – Medan Km.12,5 Komp. Masjid Baitul ‘Adhim Ds. Aneuk Batee Kec. Suka Makmur – Aceh Besar");
        $objWorksheet->setCellValue("AS$x", "Jurusan");
        $objWorksheet->setCellValue("AY$x", ":");
        $objWorksheet->mergeCells("AZ$x:BM$x");
        $objWorksheet->setCellValue("AZ$x", 'IPA');

        $x++;

        $objWorksheet->setCellValue("AS$x", "Semester");
        $objWorksheet->setCellValue("AY$x", ":");
        $objWorksheet->mergeCells("AZ$x:BM$x");
        $objWorksheet->setCellValue("AZ$x", "Genap");

        $x++;

        $objWorksheet->setCellValue("C$x", "Nama");
        $objWorksheet->setCellValue("K$x", ":");
        $objWorksheet->mergeCells("L$x:AQ$x");
        $objWorksheet->setCellValue("L$x", "Intan Lestari");

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
        $objWorksheet->setCellValue("L$x", "047/0001798792");
        $objWorksheet->setCellValue("AS$x", "Tahun Pelajaran");
        $objWorksheet->setCellValue("BB$x", ":");
        $objWorksheet->mergeCells("BC$x:BM$x");
        $objWorksheet->setCellValue("BC$x", "2015/2016");

        $x++;
        $x++;

        $objWorksheet->mergeCells("C$x:BM$x");
        $objWorksheet->setCellValue("C$x", "CAPAIAN");

        $x++; // 10

        $objWorksheet->mergeCells("C$x:X". ($x+1));
        $objWorksheet->setCellValue("C$x", "MATA PELAJARAN");

        $objWorksheet->mergeCells("Y$x:AK". ($x+1));
        $objWorksheet->setCellValue("Y$x", "KOMPETENSI");

        $objWorksheet->mergeCells("AL$x:BM". ($x+1));
        $objWorksheet->setCellValue("AL$x", "CATATAN");

        $objWorksheet->getStyle("C$x:BM" . ($x+1))
            ->getAlignment()
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objWorksheet->getStyle("C". ($x-1) .":BM". ($x+1))->applyFromArray([
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
        $x++;

        if($kelas_id){



        	$kelompokmapel_rows = $this->Rapormodel->get_kelompokmapel($kelas_id);

	        if($kelompokmapel_rows){

	        	$array_pengetahuan_nilai_rapor_sekolah = [];

	        	$no_mapel = 1;
	            foreach($kelompokmapel_rows as $kelompokmapel){
	                // C13:BM13
	                $objWorksheet->mergeCells("C$x:BM$x");
	                $objWorksheet->setCellValue("C$x", $kelompokmapel->kelompokmapel);

	                $objWorksheet->getStyle("C$x:BM$x")->applyFromArray([
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
                	print_r($mapel_rows);
	                if($mapel_rows){

	                    $huruf_mapel = "a";
	                    foreach($mapel_rows as $mapel){

	                        if($mapel->parent == 1){

	                            $huruf_mapel = "a";

	                            if($mapel->has_child){
	                            	$objWorksheet->mergeCells("C$x:D$x");
		                            $objWorksheet->setCellValue("C$x", $no_mapel);

		                            $objWorksheet->mergeCells("E$x:BM$x");
		                            $objWorksheet->setCellValue("E$x", $mapel->mapel);

		                            $objWorksheet->getStyle("C$x:BM$x")->applyFromArray([
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

	                            	$objWorksheet->mergeCells("C$x:D". ($x+11));
	                            	$objWorksheet->setCellValue("C$x", $no_mapel);
	                            	$objWorksheet->getStyle("C$x:D". ($x+11))
							            ->getAlignment()
							            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
							            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						            $objWorksheet->mergeCells("E$x:X$x");
	                            	$objWorksheet->setCellValue("E$x", $mapel->mapel);
	                            	$objWorksheet->getStyle("E$x:X$x")
							            ->getAlignment()
							            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
							            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

						            $objWorksheet->mergeCells("Y$x:AK". ($x+3));
	                            	$objWorksheet->setCellValue("Y$x", "Pengetahuan");
	                            	$objWorksheet->getStyle("Y$x:AK$x")
							            ->getAlignment()
							            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
							            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

						            $objWorksheet->mergeCells("AL$x:BM". ($x+3));
	                            	$objWorksheet->setCellValue("AL$x", "Pengetahuan");
	                            	$objWorksheet->getStyle("AL$x:BM$x")
							            ->getAlignment()
							            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
							            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

						            

						            $objWorksheet->mergeCells("Y". ($x + 4) .":AK". ($x+7));
	                            	$objWorksheet->setCellValue("Y". ($x + 4), "Keterampilan");
	                            	$objWorksheet->getStyle("Y". ($x + 4) .":AK". ($x+7))
							            ->getAlignment()
							            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
							            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

						            $objWorksheet->mergeCells("AL". ($x + 4) .":BM". ($x+7));
	                            	$objWorksheet->setCellValue("AL". ($x + 4), "Keterampilan");
	                            	$objWorksheet->getStyle("AL". ($x + 4) .":BM". ($x+7))
							            ->getAlignment()
							            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
							            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

						            $objWorksheet->mergeCells("Y". ($x + 8) .":AK". ($x+11));
	                            	$objWorksheet->setCellValue("Y". ($x + 8), "Sikap");
	                            	$objWorksheet->getStyle("Y". ($x + 8) .":AK". ($x+11))
							            ->getAlignment()
							            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
							            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

						            $objWorksheet->mergeCells("AL". ($x + 8) .":BM". ($x+11));
	                            	$objWorksheet->setCellValue("AL". ($x + 8), "Sikap");
	                            	$objWorksheet->getStyle("AL". ($x + 8) .":BM". ($x+11))
							            ->getAlignment()
							            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
							            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

						            $objWorksheet->mergeCells("E". ($x+1) .":J". ($x+11));
	                            	$objWorksheet->setCellValue("E". ($x+1) ."", "Nama Guru");
	                            	$objWorksheet->getStyle("E". ($x+1) .":J". ($x+11))
							            ->getAlignment()
							            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
							            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

						            $objWorksheet->mergeCells("K". ($x+1) .":K". ($x+11));
	                            	$objWorksheet->setCellValue("K". ($x+1) ."", ":");
	                            	$objWorksheet->getStyle("K". ($x+1) .":K". ($x+11))
							            ->getAlignment()
							            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
							            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

						            $objWorksheet->mergeCells("L". ($x+1) .":X". ($x+11));
	                            	$objWorksheet->setCellValue("L". ($x+1) ."", $mapel->guru);
	                            	$objWorksheet->getStyle("L". ($x+1) .":X". ($x+11))
							            ->getAlignment()
							            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
							            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

	                            	$x = $x + 11;
    								
	                            }

	                            $no_mapel++;

	                        }else if ($mapel->parent == 0){
	                        	
	                        	$objWorksheet->mergeCells("E$x:F$x");
	                            $objWorksheet->setCellValue("E$x", $huruf_mapel);

	                            $objWorksheet->mergeCells("G$x:X$x");
	                            $objWorksheet->setCellValue("G$x", $mapel->mapel);

	                            $objWorksheet->mergeCells("E". ($x + 1) .":J" . ($x + 11));
	                            $objWorksheet->setCellValue("E". ($x + 1), "Nama Guru");

	                            $objWorksheet->setCellValue("K". ($x + 1), ":");

	                            $objWorksheet->mergeCells("L". ($x + 1) .":X" . ($x + 11));
	                            $objWorksheet->setCellValue("L". ($x + 1), $mapel->guru);

	                            $huruf_mapel++;
	                        }
	                        



	                        $x++;
	                    }
	                }



	            }




	           	





	        }
        }


        
        

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('raporsekolah.xls');

		echo "<script>window.open('" . base_url('raporsekolah.xls') . "')</script>";
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