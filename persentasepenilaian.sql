CREATE TABLE `persentasepenilaian` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`mapel_id` int NULL,
`pengetahuan_tnh` decimal NULL,
`pengetahuan_nilai_uts` decimal NULL,
`pengetahuan_nilai_uas` decimal NULL,
`keterampilan_tnh` decimal NULL,
`keterampilan_projek` decimal NULL,
`keterampilan_porto` decimal NULL,
`keterampilan_nilai_uts` decimal NULL,
`keterampilan_nilai_uas` decimal NULL,
`sikap_tnh` decimal NULL,
`sikap_pd` decimal NULL,
`sikap_ps` decimal NULL,
`sikap_jurnal` decimal NULL,
`sikap_nilai_akhir` decimal NULL,
PRIMARY KEY (`id`) 
);

