TRUNCATE TABLE tahunajaran;
INSERT INTO tahunajaran (tahun_awal, tahun_akhir) VALUES 
(2016, 2017), # 1
(2017, 2018), # 2
(2018, 2019), # 3
(2019, 2020), # 4
(2020, 2021), # 5
(2021, 2022), # 6
(2022, 2023), # 7
(2023, 2024), # 8
(2024, 2025), # 9
(2025, 2026); # 10


TRUNCATE TABLE semester;
INSERT INTO semester (ganjil_genap, tahunajaran_id) VALUES 
('ganjil', 1), ('genap', 1),
('ganjil', 2), ('genap', 2),
('ganjil', 3), ('genap', 3),
('ganjil', 4), ('genap', 4),
('ganjil', 5), ('genap', 5),
('ganjil', 6), ('genap', 6),
('ganjil', 7), ('genap', 7),
('ganjil', 8), ('genap', 8),
('ganjil', 9), ('genap', 9),
('ganjil', 10), ('genap', 10);


TRUNCATE TABLE guru;

INSERT INTO guru (kode, nama, nip) VALUES 
("AM", 	"Abdullah Manaf, ST.", ""),
("AJ", 	"Aznur Johan, S.HI.", ""),
("BR", 	"Baidhawi Razi, Bcl.", ""),
("DI", 	"Devi Intan Purnawan, Lc.", ""),
("DF", 	"Dewi Febrianti, M.Pd.", ""),
("ES", 	"Edi Saputra, Lc., MA.", ""),
("EF", 	"Erida Fitri, M.A.(TESOL).", ""),
("FD", 	"Fadhil Ahmadi, M.Ed.", ""),
("FI", 	"Fauzul Ihsan, S.HI.", ""),
("GA", 	"Gamal Akhyar, Lc.", ""),
("HD", 	"Hanif Dahlan, Lc. MA.", ""),
("IA", 	"Ikhsan Amiruddin, S.Pd.I.", ""),
("AH", 	"Ilham Hidayatullah, Lc., MA.", ""),
("IV", 	"Ivan Aulia, Lc.", ""),
("KH", 	"Khairul Hanif, S.Pd.", ""),
("MW", 	"Mawardi Slamat Harianto, M.Pd.", ""),
("MN", 	"Mizani Nurdin, MA.", ""),
("MY", 	"Muhammad Yasin, Lc.", ""),
("MD", 	"Mulyadi Dahlan, Bcl.", ""),
("MQ", 	"Muttaqin Anas, Lc., MA.", ""),
("NS", 	"Nanda Silvia, S.Kep.", ""),
("NL", 	"Nurul Latifa, S.Pd.", ""),
("RH", 	"Rahmadi, Lc.", ""),
("RR", 	"Raidi Rizki Anshari, Bcl.", ""),
("SM", 	"Sulfia Maulidar, S.Pd.", ""),
("SY", 	"Syafruddin, Lc.", ""),
("WS", 	"Wahyu Saputra, S.Pd.I.", ""),
("WH", 	"Wahyuddin, Lc., M.Sh.", ""),
("ZB", 	"Zahrul Bawadi, Lc., MA.", ""),
("XYZ", 	"NEXT TSANAWIYAH", ""),
("AS", 	"Ade Sarwan, Lc.", ""),
("AA", 	"Ahmad Arief M, S.Pd.", ""),
("BR", 	"Baidhawi Razi, Lc.", ""),
("CP", 	"Cut Putri Ainun Jariya", ""),
("MI", 	"dr. Muhammad Ilham", ""),
("EE", 	"Elly Elvina, S. Pd.I.", ""),
("FS", 	"Faisal Ibnu Hajar, S.S.", ""),
("AL", 	"Fatayathul Alim, S. Pd.I.", ""),
("FI", 	"Fauzul Ihsan, S. HI.", ""),
("FA", 	"Fery Adriansyah, Lc.", ""),
("FP", 	"Firdaus Putra, MA.", ""),
("FR", 	"Fitra Ramadhani, Lc.", ""),
("FQ", 	"Furqan Ar-Rasyid, Lc.", ""),
("HY", 	"Hayaturriza, S.Pd.I.", ""),
("IR", 	"Isra Rizki Muntari, S.I.", ""),
("IS", 	"Ista'ana, S. Pd.", ""),
("IT", 	"Istiqamah, Lc.", ""),
("MF", 	"M. Fakhrurrazi, Lc.", ""),
("MU", 	"Munandar", ""),
("MM", 	"Murni Mustari, S.Pd.", ""),
("MJ", 	"Murtadha MJ, Lc.", ""),
("ND", 	"Nanda Elian Sari, S.Pd.", ""),
("AF", 	"Nur Afnidar, S.Pd.", ""),
("NE", 	"Nur Eliani, S.Pd.", ""),
("NM", 	"Nur Masyitah", ""),
("NN", 	"Nur Novianti", ""),
("RR", 	"Raidi Rizki Anshari, Lc.", ""),
("RS", 	"Risa Khairiah", ""),
("RW", 	"Risna Wardani", ""),
("SF", 	"Safrina, S.Pd.I.", ""),
("SD", 	"Shafiatuddiyanah", ""),
("SA", 	"Siti Aisyah", ""),
("UK", 	"Ulfa Khaira", ""),
("UJ", 	"Uzlifatul Jannah, S.S.", ""),
("WS", 	"Wahyu Saputra, S.Pd.", ""),
("WH", 	"Wahyuddin, Lc. M.Sh.", ""),
("WN", 	"Wahyun Nas, S. Pd.I.", ""),
("ZD", 	"Zainuddin", ""),
("ZK", 	"Zikrina", ""),
("FL", 	"Muhammad Fadhil, Lc.", ""),
("L", 	"Linda", ""),
("NO", 	"Novan Satria, S. Sy", ""),
("TI", 	"Teuku Iqhwana. S. Pd", ""),
("ZS", 	"Ziaus Shabri, Lc.", ""),
("MR", 	"Muhammad Rizal, Lc.", ""),
("SAB", 	"Syukran Abu Bakar", ""),
("FSR", 	"Ferra Sri Rizki", "");


TRUNCATE TABLE siswa;
TRUNCATE TABLE penempatansiswa;
INSERT INTO siswa (nis_lokal, nisn, nama, nama_hijaiyah, tingkat_id, tahunajaran_id) VALUES 
('036',	'', 	'Aini Fatin', 'عينى فاطن', 11, 1),
('038',	'', 	'Anis Nahdah Salami', 'أنيس نهضة سلامى', 11, 1),
('039',	'9993719233', 	'Anisa Fitri', 'النساء فطرى', 11, 1),
('041',	'9992087297', 	'Balqis Annisa', 'بلقيس النساء', 11, 1),
('043',	'', 	'Eliatunnisa', 'إيلية النساء', 11, 1),
('044',	'0008559292', 	'Hidayatul Hayah', 'هداية الحياة', 11, 1),
('045',	'', 	'Hikmatul Husna', 'حكمة الحسنى', 11, 1),
('046',	'9994291495', 	'Hilda Safira', 'هلدا سافرة', 11, 1),
('072',	'9997158100', 	'Indah Nisri Yana', 'إنداه نسريانا', 11, 1),
('047',	'0001798792', 	'Intan Lestari', 'إنتان ليستارى', 11, 1),
('049',	'0001988898', 	'Khaira Fitri', 'خيرا فطرى', 11, 1),
('050',	'0002162683', 	'Marza Ikrima', 'مرزا إكريما', 11, 1),
('051',	'9992311727', 	'Maulina', 'مولينا', 11, 1),
('052',	'9991201290', 	'Mawaddah Warahmah', 'مودة ورحمة', 11, 1),
('053',	'', 	'Minhajul Ulfah', 'منهاج الألفة', 11, 1),
('054',	'9991507690', 	'Muna Mawaddah', 'مونا مودة', 11, 1),
('055',	'0002614372', 	'Nafilah Afrach Shanty', 'نافلة أفرح صانتى', 11, 1),
('056',	'9990922000', 	'Naflah Taqiya', 'نفلة تقيّة', 11, 1),
('057',	'', 	'Najwa Al Husda', 'نجوى الحسدا', 11, 1),
('058',	'9990700496', 	'Naufir Raudhatiz Zayyan', 'نوفير روضة الزيان', 11, 1),
('059',	'9990921999', 	'Nisa Adilla', 'نيسا أدلّة', 11, 1),
('070',	'9998771561', 	'Nur Akmalia', 'نور أكماليا', 11, 1),
('060',	'9991507703', 	'Nurul Keumala Sari', 'نور الكومالا سارى', 11, 1),
('061',	'9991525327', 	'Nurul Mahfudhah', 'نور المحفوظة', 11, 1),
('062',	'9991353364', 	'Raihan Fitri', 'ريحان فطرى', 11, 1),
('064',	'0001922021', 	'Safitri Wulandari', 'سافطرى ولاندرى', 11, 1),
('065',	'9995418051', 	'Sarah Rustam', 'سارة روستام', 11, 1),
('066',	'9996956597', 	'Septia Ulfa Lestari', 'سيبتيا أولفا ليستارى', 11, 1),
('071',	'9990921640', 	'Siti Karimah', 'سيتى كريمة', 11, 1),
('067',	'9991465666', 	'Siti Zahara', 'سيتى زهرا', 11, 1),
('068',	'', 	'Ulya Rifqah', 'عليا رفقة', 11, 1),
('073',	'9993807022', 	'Zuhra Intan', 'زهرة إنتان', 11, 1);


TRUNCATE TABLE kelompokmapel;

INSERT INTO `iq`.`kelompokmapel`(`kelompokmapel`, `kelas_id`, `semester_id`) VALUES ('Kelompok A (Wajib)', 3, 2);
INSERT INTO `iq`.`kelompokmapel`(`kelompokmapel`, `kelas_id`, `semester_id`) VALUES ('Kelompok B (Wajib)', 3, 2);
INSERT INTO `iq`.`kelompokmapel`(`kelompokmapel`, `kelas_id`, `semester_id`) VALUES ('Kelompok C (Peminatan) - Peminatan Matematika dan Ilmu Alam', 3, 2);
INSERT INTO `iq`.`kelompokmapel`(`kelompokmapel`, `kelas_id`, `semester_id`) VALUES ('Kelompok D (Lintas Minat)', 3, 2);


TRUNCATE TABLE mapel;
TRUNCATE TABLE predikatpengetahuan;
TRUNCATE TABLE predikatketerampilan;
TRUNCATE TABLE predikatsikap;
TRUNCATE TABLE persentasepenilaian;

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Pendidikan Agama', 3, 20, 1, 2, 1, NULL, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Qur\'an Hadist', 3, 20, 1, 2, 0, 1, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Aqidah Akhlak', 3, 11, 1, 2, 0, 1, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Fiqh', 3, 70, 1, 2, 0, 1, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Sejarah Kebudayaan Islam', 3, 75, 1, 2, 0, 1, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Pend. Pancasila dan Kewarganegaraan', 3, 1, 1, 2, 1, NULL, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Bahasa Indonesia', 3, 77, 1, 2, 1, NULL, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Bahasa Arab', 3, 17, 1, 2, 1, NULL, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Matematika', 3, 58, 1, 2, 1, NULL, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Sejarah Indonesia', 3, 5, 1, 2, 1, NULL, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Bahasa Inggris', 3, 7, 1, 2, 1, NULL, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Seni Budaya', 3, 21, 2, 2, 1, NULL, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Pend. Jasmani, Olah Raga, dan Kesehatan', 3, 73, 2, 2, 1, NULL, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Prakarya', 3, 74, 2, 2, 1, NULL, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Matematika (Peminatan)', 3, 1, 3, 2, 1, NULL, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Biologi', 3, 71, 3, 2, 1, NULL, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Fisika', 3, 37, 3, 2, 1, NULL, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Kimia', 3, 16, 3, 2, 1, NULL, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Ushul Fiqh', 3, 19, 4, 2, 1, NULL, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

INSERT INTO `iq`.`mapel`(`mapel`, `kelas_id`, `guru_id`, `kelompokmapel_id`, `semester_id`, `parent`, `parent_id`, `kkm`) VALUES ('Ulumul Hadist', 3, 11, 4, 2, 1, NULL, 2.67);
SET @mapel_id = LAST_INSERT_ID();
INSERT INTO predikatpengetahuan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatketerampilan (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'A',  4), (@mapel_id, 'A-', 3.68), (@mapel_id, 'B+', 3.34), (@mapel_id, 'B',  3.01), (@mapel_id, 'B-', 2.68), (@mapel_id, 'C+', 2.34), (@mapel_id, 'C',  2.01), (@mapel_id, 'C-', 1.68), (@mapel_id, 'D+', 1.34), (@mapel_id, 'D',  1.01), (@mapel_id, 'E',  0);
INSERT INTO predikatsikap (mapel_id, huruf, lebih_kecil_atau_sama_dengan) VALUES (@mapel_id, 'K', 60), (@mapel_id, 'C', 75), (@mapel_id, 'B', 91), (@mapel_id, 'SB', 100);

