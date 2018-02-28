/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : iq

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-11-23 11:15:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for extrakurikuler
-- ----------------------------
DROP TABLE IF EXISTS `extrakurikuler`;
CREATE TABLE `extrakurikuler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `extrakurikuler` varchar(255) DEFAULT NULL,
  `tahunajaran_id` int(11) DEFAULT NULL,
  `tingkat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of extrakurikuler
-- ----------------------------
INSERT INTO `extrakurikuler` VALUES ('1', 'Pramuka', '1', '11');
INSERT INTO `extrakurikuler` VALUES ('5', 'Paskibraka ', '1', '11');
INSERT INTO `extrakurikuler` VALUES ('6', 'Test', '1', '11');
INSERT INTO `extrakurikuler` VALUES ('7', 'Test2', '1', '11');

-- ----------------------------
-- Table structure for guru
-- ----------------------------
DROP TABLE IF EXISTS `guru`;
CREATE TABLE `guru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of guru
-- ----------------------------
INSERT INTO `guru` VALUES ('1', 'Fakhrurrazi Andi', 'FA', '1');
INSERT INTO `guru` VALUES ('2', 'Baihaqi', 'BAI', '2');

-- ----------------------------
-- Table structure for kelas
-- ----------------------------
DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tingkat_id` int(11) DEFAULT NULL,
  `peminatan_id` int(11) DEFAULT NULL,
  `paralel` char(1) DEFAULT NULL,
  `guru_id` int(11) DEFAULT NULL,
  `tahunajaran_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kelas
-- ----------------------------
INSERT INTO `kelas` VALUES ('1', '10', null, 'A', '1', '1');
INSERT INTO `kelas` VALUES ('2', '10', null, 'B', '2', '1');
INSERT INTO `kelas` VALUES ('3', '10', null, 'C', '1', '1');
INSERT INTO `kelas` VALUES ('4', '11', '0', 'A', '1', '1');
INSERT INTO `kelas` VALUES ('5', '11', '1', 'B', '2', '1');
INSERT INTO `kelas` VALUES ('7', '12', '0', 'A', '1', '1');
INSERT INTO `kelas` VALUES ('8', '12', '0', 'B', '2', '1');
INSERT INTO `kelas` VALUES ('9', '12', '0', 'C', '1', '1');

-- ----------------------------
-- Table structure for kelompokmapel
-- ----------------------------
DROP TABLE IF EXISTS `kelompokmapel`;
CREATE TABLE `kelompokmapel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelompokmapel` varchar(255) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `semester_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kelompokmapel
-- ----------------------------
INSERT INTO `kelompokmapel` VALUES ('1', 'Kelompok A (Wajib)', '5', '2');
INSERT INTO `kelompokmapel` VALUES ('2', 'Kelompok B (Wajib)', '5', '2');
INSERT INTO `kelompokmapel` VALUES ('3', 'Kelompok C (Peminatan)', '5', '2');
INSERT INTO `kelompokmapel` VALUES ('4', 'Kelompok D (Lintas Minat)', '5', '2');
INSERT INTO `kelompokmapel` VALUES ('7', 'Kelompok A (Wajib)', '4', '2');

-- ----------------------------
-- Table structure for kepribadian
-- ----------------------------
DROP TABLE IF EXISTS `kepribadian`;
CREATE TABLE `kepribadian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `penempatansiswa_id` int(11) DEFAULT NULL,
  `kelakuan` char(5) DEFAULT NULL,
  `kedisiplinan` char(5) DEFAULT NULL,
  `kerapian` char(5) DEFAULT NULL,
  `semester_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kepribadian
-- ----------------------------
INSERT INTO `kepribadian` VALUES ('1', '24', 'A', 'A', 'B', '2');
INSERT INTO `kepribadian` VALUES ('2', '25', 'A', 'B', 'B', '2');

-- ----------------------------
-- Table structure for mapel
-- ----------------------------
DROP TABLE IF EXISTS `mapel`;
CREATE TABLE `mapel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapel` varchar(255) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `guru_id` int(11) DEFAULT NULL,
  `kelompokmapel_id` int(11) DEFAULT NULL,
  `semester_id` int(11) DEFAULT NULL,
  `parent` int(1) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `kkm` decimal(11,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mapel
-- ----------------------------
INSERT INTO `mapel` VALUES ('35', 'Pendidikan Agama', '5', '1', '1', '2', '1', null, '2.67');
INSERT INTO `mapel` VALUES ('36', 'Pend. Pancasila dan Kewarganegaraan', '5', '2', '1', '2', '1', null, '2.67');
INSERT INTO `mapel` VALUES ('37', 'Bahasa Indonesia', '5', '1', '1', '2', '1', null, '2.67');
INSERT INTO `mapel` VALUES ('38', 'Bahasa Arab', '5', '2', '1', '2', '1', null, '2.67');
INSERT INTO `mapel` VALUES ('39', 'Matematika', '5', '1', '1', '2', '1', null, '2.67');
INSERT INTO `mapel` VALUES ('40', 'Sejarah Indonesia', '5', '2', '1', '2', '1', null, '2.67');
INSERT INTO `mapel` VALUES ('41', 'Bahasa Inggris', '5', '1', '1', '2', '1', null, '2.67');
INSERT INTO `mapel` VALUES ('46', 'Seni Budaya', '5', '1', '2', '2', '1', null, '2.67');
INSERT INTO `mapel` VALUES ('47', 'Pend. Jasmani, Olah Raga, dan Kesehatan	', '5', '2', '2', '2', '1', null, '2.67');
INSERT INTO `mapel` VALUES ('48', 'Prakarya																						', '5', '2', '2', '2', '1', null, '2.67');
INSERT INTO `mapel` VALUES ('49', 'Matematika (Peminatan)																						', '5', '1', '3', '2', '1', null, '2.67');
INSERT INTO `mapel` VALUES ('50', 'Biologi																						', '5', '1', '3', '2', '1', null, '2.67');
INSERT INTO `mapel` VALUES ('51', 'Fisika																						', '5', '2', '3', '2', '1', null, '2.67');
INSERT INTO `mapel` VALUES ('52', 'Kimia																						', '5', '1', '3', '2', '1', null, '2.67');
INSERT INTO `mapel` VALUES ('53', 'Ushul Fiqh																						', '5', '1', '4', '2', '1', null, '2.67');
INSERT INTO `mapel` VALUES ('54', 'Ulumul Hadist																						', '5', '2', '4', '2', '1', null, '2.67');
INSERT INTO `mapel` VALUES ('55', 'Qur\'an Hadist', '5', '1', '1', '2', '0', '35', '2.67');
INSERT INTO `mapel` VALUES ('56', 'Aqidah Akhlak', '5', '2', '1', '2', '0', '35', '2.67');
INSERT INTO `mapel` VALUES ('57', 'Fiqh', '5', '1', '1', '2', '0', '35', '2.67');
INSERT INTO `mapel` VALUES ('58', 'Sejarah Kebudayaan Islam', '5', '1', '1', '2', '0', '35', '2.67');

-- ----------------------------
-- Table structure for mapeldayah
-- ----------------------------
DROP TABLE IF EXISTS `mapeldayah`;
CREATE TABLE `mapeldayah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapel` varchar(255) DEFAULT NULL,
  `mapel_hijaiyah` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `guru_id` int(11) DEFAULT NULL,
  `semester_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mapeldayah
-- ----------------------------
INSERT INTO `mapeldayah` VALUES ('60', 'Tauhid', 'التوحيد', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('62', 'Tafsir', 'التفسير', '5', '2', '2');
INSERT INTO `mapeldayah` VALUES ('63', 'Ulumul Qur\'an', 'علوم القرآن', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('64', 'Hadist', 'الحديث													', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('65', 'Mustalahul Hadist						', 'علم مصطلح الحديث													', '5', '2', '2');
INSERT INTO `mapeldayah` VALUES ('66', 'Ushul Fiqh', 'أصول الفقه													', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('67', 'Fiqih', 'الفقه													', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('68', 'Faraidh						', 'الفرائض													', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('69', 'Sejarah Kebudayaan Islam				', 'تاريخ الأدب الإسلامي													', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('70', 'Pend. Pancasila dan Kewarganegaraan						', 'التربية الوطنية													', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('71', 'Bahasa Indonesia', 'اللغة الإندونيسية													', '5', '2', '2');
INSERT INTO `mapeldayah` VALUES ('72', 'Tadrib Al-lughawi						', 'التدريب اللغوي													', '5', '2', '2');
INSERT INTO `mapeldayah` VALUES ('73', 'Balaghah						', 'البلاغةُ													', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('74', 'Sharf						', 'الصرف													', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('75', 'Nahwu						', 'النحو', '5', '2', '2');
INSERT INTO `mapeldayah` VALUES ('76', 'Ta\'bir						', 'التعبير													', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('77', 'Imla\'						', 'الإملاء													', '5', '2', '2');
INSERT INTO `mapeldayah` VALUES ('78', 'Matematika						', 'الرياضيات													', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('79', 'Sejarah Indonesia						', 'التاريخ الإندونيسية													', '5', '2', '2');
INSERT INTO `mapeldayah` VALUES ('80', 'Bahasa Inggris						', 'اللغة الإنجليزية													', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('81', 'Seni Budaya						', 'الفنون الأدبي													', '5', '2', '2');
INSERT INTO `mapeldayah` VALUES ('82', 'Pend. Jasmani, Olah Raga, dan Kesehatan						', 'الرياضة													', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('83', 'Prakarya', 'المهارة اليدوية													', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('84', 'Biologi						', 'البيولوجي													', '5', '2', '2');
INSERT INTO `mapeldayah` VALUES ('85', 'Fisika', 'الفيزياء													', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('86', 'Kimia', 'الكيمياء													', '5', '2', '2');
INSERT INTO `mapeldayah` VALUES ('87', 'Speaking', 'المحادثة الإنجليزية																								', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('88', 'Listening', 'الاستماع الإنجليزي													', '5', '2', '2');
INSERT INTO `mapeldayah` VALUES ('89', 'Mufradat', 'المفردات													', '5', '2', '2');
INSERT INTO `mapeldayah` VALUES ('90', 'Muhadharah', 'المحاضرة													', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('91', 'Akhlak', 'الأخلاق‎													', '5', '2', '2');
INSERT INTO `mapeldayah` VALUES ('92', 'Bahasa Arab Syafahi', 'العربية الشفهية													', '5', '1', '2');
INSERT INTO `mapeldayah` VALUES ('93', 'Bahasa Inggris Syafahi', 'الإنجليزية الشفهية													', '5', '2', '2');
INSERT INTO `mapeldayah` VALUES ('94', 'Praktek Ibadah Syafahi', 'الأدعياء الشفهية													', '5', '1', '2');

-- ----------------------------
-- Table structure for peminatan
-- ----------------------------
DROP TABLE IF EXISTS `peminatan`;
CREATE TABLE `peminatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `peminatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of peminatan
-- ----------------------------
INSERT INTO `peminatan` VALUES ('1', 'IPA');

-- ----------------------------
-- Table structure for penempatansiswa
-- ----------------------------
DROP TABLE IF EXISTS `penempatansiswa`;
CREATE TABLE `penempatansiswa` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(8) DEFAULT NULL,
  `siswa_id` int(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of penempatansiswa
-- ----------------------------
INSERT INTO `penempatansiswa` VALUES ('21', '4', '1');
INSERT INTO `penempatansiswa` VALUES ('22', '4', '7');
INSERT INTO `penempatansiswa` VALUES ('23', '4', '2');
INSERT INTO `penempatansiswa` VALUES ('24', '5', '3');
INSERT INTO `penempatansiswa` VALUES ('25', '5', '4');
INSERT INTO `penempatansiswa` VALUES ('26', '5', '5');
INSERT INTO `penempatansiswa` VALUES ('27', '5', '6');
INSERT INTO `penempatansiswa` VALUES ('30', '5', '8');

-- ----------------------------
-- Table structure for penilaian
-- ----------------------------
DROP TABLE IF EXISTS `penilaian`;
CREATE TABLE `penilaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `penempatansiswa_id` int(11) DEFAULT NULL,
  `mapel_id` int(11) DEFAULT NULL,
  `pengetahuan_tnh` decimal(11,2) DEFAULT NULL,
  `pengetahuan_nilai_uts` decimal(11,2) DEFAULT NULL,
  `pengetahuan_nilai_uas` decimal(11,2) DEFAULT NULL,
  `keterampilan_tnh` decimal(11,2) DEFAULT NULL,
  `keterampilan_projek` decimal(11,2) DEFAULT NULL,
  `keterampilan_porto` decimal(11,2) DEFAULT NULL,
  `keterampilan_nilai_uts` decimal(11,2) DEFAULT NULL,
  `keterampilan_nilai_uas` decimal(11,2) DEFAULT NULL,
  `sikap_tnh` decimal(11,2) DEFAULT NULL,
  `sikap_pd` decimal(11,2) DEFAULT NULL,
  `sikap_ps` decimal(11,2) DEFAULT NULL,
  `sikap_jurnal` decimal(11,2) DEFAULT NULL,
  `sikap_nilai_akhir` decimal(11,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of penilaian
-- ----------------------------
INSERT INTO `penilaian` VALUES ('1', '24', '5', '83.00', '26.00', '45.00', '0.00', '0.00', '0.00', '0.00', '82.00', '0.00', '0.00', '0.00', '0.00', '82.00');
INSERT INTO `penilaian` VALUES ('2', '25', '5', '90.32', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00');
INSERT INTO `penilaian` VALUES ('3', '26', '5', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00');
INSERT INTO `penilaian` VALUES ('4', '27', '5', '20.00', '40.00', '40.00', '0.00', '0.00', '0.00', '0.00', '100.00', '0.00', '0.00', '0.00', '0.00', '100.00');
INSERT INTO `penilaian` VALUES ('5', '24', '30', '83.00', '26.00', '45.00', '0.00', '0.00', '0.00', '0.00', '82.00', '0.00', '0.00', '0.00', '0.00', '82.00');
INSERT INTO `penilaian` VALUES ('6', '25', '30', '83.00', '26.00', '45.00', '0.00', '0.00', '0.00', '0.00', '82.00', '0.00', '0.00', '0.00', '0.00', '82.00');
INSERT INTO `penilaian` VALUES ('7', '26', '30', '83.00', '26.00', '45.00', '0.00', '0.00', '0.00', '0.00', '83.00', '0.00', '0.00', '0.00', '0.00', '90.00');
INSERT INTO `penilaian` VALUES ('8', '27', '30', '90.00', '90.00', '90.00', '0.00', '0.00', '0.00', '0.00', '90.00', '0.00', '0.00', '0.00', '0.00', '90.00');
INSERT INTO `penilaian` VALUES ('9', '24', '55', '0.00', '0.00', '57.00', '0.00', '0.00', '0.00', '0.00', '80.00', '0.00', '0.00', '0.00', '0.00', '80.00');
INSERT INTO `penilaian` VALUES ('10', '24', '56', '0.00', '0.00', '69.50', '0.00', '0.00', '0.00', '0.00', '82.50', '0.00', '0.00', '0.00', '0.00', '85.00');
INSERT INTO `penilaian` VALUES ('11', '24', '57', '0.00', '0.00', '87.00', '0.00', '0.00', '0.00', '0.00', '79.00', '0.00', '0.00', '0.00', '0.00', '78.00');
INSERT INTO `penilaian` VALUES ('12', '24', '58', '80.00', '80.00', '64.00', '0.00', '0.00', '0.00', '0.00', '80.00', '0.00', '0.00', '0.00', '0.00', '80.00');
INSERT INTO `penilaian` VALUES ('13', '24', '36', '0.00', '0.00', '96.00', '0.00', '0.00', '0.00', '0.00', '75.00', '0.00', '0.00', '0.00', '0.00', '85.00');
INSERT INTO `penilaian` VALUES ('14', '24', '37', '72.00', '60.00', '61.00', '0.00', '0.00', '0.00', '0.00', '85.00', '0.00', '0.00', '0.00', '0.00', '80.00');
INSERT INTO `penilaian` VALUES ('15', '24', '38', '0.00', '0.00', '72.00', '0.00', '0.00', '0.00', '0.00', '80.00', '0.00', '0.00', '0.00', '0.00', '81.00');
INSERT INTO `penilaian` VALUES ('16', '24', '39', '83.00', '26.00', '45.00', '0.00', '0.00', '0.00', '0.00', '82.00', '0.00', '0.00', '0.00', '0.00', '82.00');
INSERT INTO `penilaian` VALUES ('17', '24', '40', '0.00', '80.00', '82.00', '0.00', '0.00', '0.00', '0.00', '80.00', '0.00', '0.00', '0.00', '0.00', '85.00');
INSERT INTO `penilaian` VALUES ('18', '24', '41', '85.00', '45.00', '42.00', '0.00', '0.00', '0.00', '0.00', '85.00', '0.00', '0.00', '0.00', '0.00', '86.00');
INSERT INTO `penilaian` VALUES ('19', '24', '46', '0.00', '0.00', '82.00', '0.00', '0.00', '0.00', '0.00', '75.00', '0.00', '0.00', '0.00', '0.00', '82.00');
INSERT INTO `penilaian` VALUES ('20', '24', '47', '0.00', '0.00', '82.00', '0.00', '0.00', '0.00', '0.00', '75.00', '0.00', '0.00', '0.00', '0.00', '85.00');
INSERT INTO `penilaian` VALUES ('21', '24', '48', '0.00', '0.00', '85.00', '0.00', '0.00', '0.00', '0.00', '75.00', '0.00', '0.00', '0.00', '0.00', '85.00');
INSERT INTO `penilaian` VALUES ('22', '24', '49', '41.00', '0.00', '25.00', '0.00', '0.00', '0.00', '0.00', '80.00', '0.00', '0.00', '0.00', '0.00', '80.00');
INSERT INTO `penilaian` VALUES ('23', '24', '50', '90.00', '85.00', '95.00', '0.00', '0.00', '0.00', '0.00', '90.00', '0.00', '0.00', '0.00', '0.00', '90.00');
INSERT INTO `penilaian` VALUES ('24', '24', '51', '80.00', '25.00', '75.00', '0.00', '0.00', '0.00', '0.00', '85.00', '0.00', '0.00', '0.00', '0.00', '85.00');
INSERT INTO `penilaian` VALUES ('25', '24', '52', '85.00', '30.00', '46.00', '0.00', '0.00', '0.00', '0.00', '86.00', '0.00', '0.00', '0.00', '0.00', '80.00');
INSERT INTO `penilaian` VALUES ('26', '24', '53', '75.00', '69.00', '60.00', '0.00', '0.00', '0.00', '0.00', '80.00', '0.00', '0.00', '0.00', '0.00', '80.00');
INSERT INTO `penilaian` VALUES ('27', '24', '54', '85.00', '65.00', '65.00', '0.00', '0.00', '0.00', '0.00', '80.00', '0.00', '0.00', '0.00', '0.00', '80.00');
INSERT INTO `penilaian` VALUES ('28', '25', '39', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00', '90.00');
INSERT INTO `penilaian` VALUES ('29', '25', '55', '10.00', '10.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00');
INSERT INTO `penilaian` VALUES ('30', '30', '55', '0.00', '0.00', '57.00', '0.00', '0.00', '0.00', '0.00', '80.00', '0.00', '0.00', '0.00', '0.00', '80.00');
INSERT INTO `penilaian` VALUES ('31', '30', '56', '0.00', '0.00', '69.50', '0.00', '0.00', '0.00', '0.00', '82.50', '0.00', '0.00', '0.00', '0.00', '85.00');
INSERT INTO `penilaian` VALUES ('32', '30', '57', '0.00', '85.00', '90.00', '0.00', '0.00', '0.00', '0.00', '85.00', '0.00', '0.00', '0.00', '0.00', '80.00');
INSERT INTO `penilaian` VALUES ('33', '30', '58', '69.00', '85.00', '69.00', '0.00', '0.00', '0.00', '0.00', '80.00', '0.00', '0.00', '0.00', '0.00', '80.00');
INSERT INTO `penilaian` VALUES ('34', '30', '36', '0.00', '0.00', '96.00', '0.00', '0.00', '0.00', '0.00', '75.00', '0.00', '0.00', '0.00', '0.00', '85.00');
INSERT INTO `penilaian` VALUES ('35', '30', '37', '72.00', '60.00', '61.00', '0.00', '0.00', '0.00', '0.00', '85.00', '0.00', '0.00', '0.00', '0.00', '80.00');
INSERT INTO `penilaian` VALUES ('36', '30', '38', '0.00', '0.00', '73.00', '0.00', '0.00', '0.00', '0.00', '80.00', '0.00', '0.00', '0.00', '0.00', '81.00');
INSERT INTO `penilaian` VALUES ('37', '30', '39', '83.00', '26.00', '45.00', '0.00', '0.00', '0.00', '0.00', '82.00', '0.00', '0.00', '0.00', '0.00', '82.00');
INSERT INTO `penilaian` VALUES ('38', '30', '40', '0.00', '80.00', '82.00', '0.00', '0.00', '0.00', '0.00', '80.00', '0.00', '0.00', '0.00', '0.00', '85.00');
INSERT INTO `penilaian` VALUES ('39', '30', '41', '85.00', '45.00', '42.00', '0.00', '0.00', '0.00', '0.00', '85.00', '0.00', '0.00', '0.00', '0.00', '86.00');
INSERT INTO `penilaian` VALUES ('40', '30', '46', '0.00', '0.00', '82.00', '0.00', '0.00', '0.00', '0.00', '75.00', '0.00', '0.00', '0.00', '0.00', '85.00');
INSERT INTO `penilaian` VALUES ('41', '30', '47', '0.00', '0.00', '82.00', '0.00', '0.00', '0.00', '0.00', '75.00', '0.00', '0.00', '0.00', '0.00', '85.00');
INSERT INTO `penilaian` VALUES ('42', '30', '48', '0.00', '0.00', '85.00', '0.00', '0.00', '0.00', '0.00', '75.00', '0.00', '0.00', '0.00', '0.00', '85.00');
INSERT INTO `penilaian` VALUES ('43', '30', '49', '41.00', '0.00', '25.00', '0.00', '0.00', '0.00', '0.00', '80.00', '0.00', '0.00', '0.00', '0.00', '80.00');
INSERT INTO `penilaian` VALUES ('44', '30', '50', '90.00', '85.00', '95.00', '0.00', '0.00', '0.00', '0.00', '90.00', '0.00', '0.00', '0.00', '0.00', '90.00');
INSERT INTO `penilaian` VALUES ('45', '30', '51', '80.00', '25.00', '75.00', '0.00', '0.00', '0.00', '0.00', '85.00', '0.00', '0.00', '0.00', '0.00', '85.00');
INSERT INTO `penilaian` VALUES ('46', '30', '52', '85.00', '30.00', '46.00', '0.00', '0.00', '0.00', '0.00', '86.00', '0.00', '0.00', '0.00', '0.00', '80.00');

-- ----------------------------
-- Table structure for penilaiandayah
-- ----------------------------
DROP TABLE IF EXISTS `penilaiandayah`;
CREATE TABLE `penilaiandayah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `penempatansiswa_id` int(11) DEFAULT NULL,
  `mapeldayah_id` int(11) DEFAULT NULL,
  `pengetahuan_tnh` decimal(11,2) DEFAULT NULL,
  `pengetahuan_nilai_uts` decimal(11,2) DEFAULT NULL,
  `pengetahuan_nilai_uas` decimal(11,2) DEFAULT NULL,
  `keterampilan_tnh` decimal(11,2) DEFAULT NULL,
  `keterampilan_projek` decimal(11,2) DEFAULT NULL,
  `keterampilan_porto` decimal(11,2) DEFAULT NULL,
  `keterampilan_nilai_uts` decimal(11,2) DEFAULT NULL,
  `keterampilan_nilai_uas` decimal(11,2) DEFAULT NULL,
  `sikap_tnh` decimal(11,2) DEFAULT NULL,
  `sikap_pd` decimal(11,2) DEFAULT NULL,
  `sikap_ps` decimal(11,2) DEFAULT NULL,
  `sikap_jurnal` decimal(11,2) DEFAULT NULL,
  `sikap_nilai_akhir` decimal(11,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of penilaiandayah
-- ----------------------------
INSERT INTO `penilaiandayah` VALUES ('48', '30', '60', '80.00', '72.00', '98.00', '0.00', '0.00', '0.00', '0.00', '85.00', '0.00', '0.00', '0.00', '0.00', '90.00');

-- ----------------------------
-- Table structure for penilaianextrakurikuler
-- ----------------------------
DROP TABLE IF EXISTS `penilaianextrakurikuler`;
CREATE TABLE `penilaianextrakurikuler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `penempatansiswa_id` int(11) DEFAULT NULL,
  `extrakurikuler_id` int(11) DEFAULT NULL,
  `predikat` char(1) DEFAULT NULL,
  `keterangan` text,
  `semester_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of penilaianextrakurikuler
-- ----------------------------
INSERT INTO `penilaianextrakurikuler` VALUES ('13', '24', '1', 'A', 'Keterangan A', '2');
INSERT INTO `penilaianextrakurikuler` VALUES ('14', '24', '5', 'B', 'Keterangan B', '2');
INSERT INTO `penilaianextrakurikuler` VALUES ('15', '24', '6', 'C', 'Keterangan C', '2');
INSERT INTO `penilaianextrakurikuler` VALUES ('16', '25', '1', 'A', 'asdasd', '2');
INSERT INTO `penilaianextrakurikuler` VALUES ('17', '25', '5', 'B', 'asdasdas', '2');
INSERT INTO `penilaianextrakurikuler` VALUES ('18', '25', '6', 'C', 'askdakdhsaldhoasd asuidoaspid', '2');
INSERT INTO `penilaianextrakurikuler` VALUES ('19', '27', '1', 'A', 'test', '2');
INSERT INTO `penilaianextrakurikuler` VALUES ('20', '27', '5', 'A', 'test', '2');
INSERT INTO `penilaianextrakurikuler` VALUES ('21', '26', '1', 'B', '', '2');
INSERT INTO `penilaianextrakurikuler` VALUES ('22', '26', '5', 'B', 'test', '2');
INSERT INTO `penilaianextrakurikuler` VALUES ('23', '30', '1', 'A', '', '2');
INSERT INTO `penilaianextrakurikuler` VALUES ('24', '30', '5', '', '', '2');
INSERT INTO `penilaianextrakurikuler` VALUES ('25', '30', '6', '', '', '2');
INSERT INTO `penilaianextrakurikuler` VALUES ('26', '30', '7', '', '', '2');

-- ----------------------------
-- Table structure for persentasepenilaian
-- ----------------------------
DROP TABLE IF EXISTS `persentasepenilaian`;
CREATE TABLE `persentasepenilaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapel_id` int(11) DEFAULT NULL,
  `pengetahuan_tnh` decimal(10,0) DEFAULT NULL,
  `pengetahuan_nilai_uts` decimal(10,0) DEFAULT NULL,
  `pengetahuan_nilai_uas` decimal(10,0) DEFAULT NULL,
  `keterampilan_tnh` decimal(10,0) DEFAULT NULL,
  `keterampilan_projek` decimal(10,0) DEFAULT NULL,
  `keterampilan_porto` decimal(10,0) DEFAULT NULL,
  `keterampilan_nilai_uts` decimal(10,0) DEFAULT NULL,
  `keterampilan_nilai_uas` decimal(10,0) DEFAULT NULL,
  `sikap_tnh` decimal(10,0) DEFAULT NULL,
  `sikap_pd` decimal(10,0) DEFAULT NULL,
  `sikap_ps` decimal(10,0) DEFAULT NULL,
  `sikap_jurnal` decimal(10,0) DEFAULT NULL,
  `sikap_nilai_akhir` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of persentasepenilaian
-- ----------------------------
INSERT INTO `persentasepenilaian` VALUES ('4', '5', '30', '30', '40', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('5', '30', '30', '30', '40', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('6', '55', '0', '0', '100', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('7', '56', '0', '0', '100', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('8', '57', '0', '40', '60', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('9', '58', '20', '30', '50', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('10', '36', '0', '0', '100', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('11', '37', '40', '30', '30', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('12', '38', '0', '0', '100', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('13', '39', '30', '30', '40', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('14', '40', '0', '40', '60', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('15', '41', '30', '30', '40', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('16', '46', '0', '0', '100', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('17', '47', '0', '0', '100', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('18', '48', '0', '0', '100', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('19', '49', '40', '0', '60', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('20', '50', '60', '5', '35', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('21', '51', '30', '30', '35', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('22', '52', '50', '25', '25', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('23', '53', '40', '20', '40', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('24', '54', '25', '25', '50', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');
INSERT INTO `persentasepenilaian` VALUES ('25', null, '25', '25', '100', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');

-- ----------------------------
-- Table structure for persentasepenilaiandayah
-- ----------------------------
DROP TABLE IF EXISTS `persentasepenilaiandayah`;
CREATE TABLE `persentasepenilaiandayah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapeldayah_id` int(11) DEFAULT NULL,
  `pengetahuan_tnh` decimal(10,0) DEFAULT NULL,
  `pengetahuan_nilai_uts` decimal(10,0) DEFAULT NULL,
  `pengetahuan_nilai_uas` decimal(10,0) DEFAULT NULL,
  `keterampilan_tnh` decimal(10,0) DEFAULT NULL,
  `keterampilan_projek` decimal(10,0) DEFAULT NULL,
  `keterampilan_porto` decimal(10,0) DEFAULT NULL,
  `keterampilan_nilai_uts` decimal(10,0) DEFAULT NULL,
  `keterampilan_nilai_uas` decimal(10,0) DEFAULT NULL,
  `sikap_tnh` decimal(10,0) DEFAULT NULL,
  `sikap_pd` decimal(10,0) DEFAULT NULL,
  `sikap_ps` decimal(10,0) DEFAULT NULL,
  `sikap_jurnal` decimal(10,0) DEFAULT NULL,
  `sikap_nilai_akhir` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of persentasepenilaiandayah
-- ----------------------------
INSERT INTO `persentasepenilaiandayah` VALUES ('26', '60', '40', '30', '30', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100');

-- ----------------------------
-- Table structure for predikatketerampilan
-- ----------------------------
DROP TABLE IF EXISTS `predikatketerampilan`;
CREATE TABLE `predikatketerampilan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapel_id` int(11) DEFAULT NULL,
  `huruf` varchar(2) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `lebih_kecil_atau_sama_dengan` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=298 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of predikatketerampilan
-- ----------------------------
INSERT INTO `predikatketerampilan` VALUES ('12', '22', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('13', '22', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('14', '22', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('15', '22', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('16', '22', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('17', '22', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('18', '22', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('19', '22', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('20', '22', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('21', '22', 'D', null, '1.00');
INSERT INTO `predikatketerampilan` VALUES ('22', '22', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('23', '27', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('24', '27', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('25', '27', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('26', '27', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('27', '27', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('28', '27', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('29', '27', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('30', '27', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('31', '27', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('32', '27', 'D', null, '1.00');
INSERT INTO `predikatketerampilan` VALUES ('33', '27', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('34', '28', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('35', '28', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('36', '28', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('37', '28', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('38', '28', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('39', '28', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('40', '28', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('41', '28', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('42', '28', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('43', '28', 'D', null, '1.00');
INSERT INTO `predikatketerampilan` VALUES ('44', '28', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('45', '29', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('46', '29', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('47', '29', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('48', '29', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('49', '29', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('50', '29', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('51', '29', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('52', '29', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('53', '29', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('54', '29', 'D', null, '1.00');
INSERT INTO `predikatketerampilan` VALUES ('55', '29', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('56', '30', 'A', 'sangat baik dan sempurna. Sangat aktif bertanya, mencoba, menalar dan kreatif dalam menyelesaikan semua soal.\r\n', '4.00');
INSERT INTO `predikatketerampilan` VALUES ('57', '30', 'A-', 'Baik dan sempurna. Aktif bertanya, mencoba, menalar dan kreatif dalam menyelesaikan semua soal.\r\n', '3.68');
INSERT INTO `predikatketerampilan` VALUES ('58', '30', 'B+', 'Baik sekali. Aktif bertanya, mencoba, menalar dan kreatif dalam menyelesaikan semua soal.\r\n', '3.34');
INSERT INTO `predikatketerampilan` VALUES ('59', '30', 'B', 'Baik. Aktif bertanya, mencoba, menalar, dan kreatif dalam menyelesaikan sebagian besar soal cerita.\r\n', '3.01');
INSERT INTO `predikatketerampilan` VALUES ('60', '30', 'B-', 'Cukup baik. Aktif bertanya, mencoba, menalar dan kreatif dalam menyelesaikan soal cerita.\r\n', '2.68');
INSERT INTO `predikatketerampilan` VALUES ('61', '30', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('62', '30', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('63', '30', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('64', '30', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('65', '30', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('66', '30', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('67', '34', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('68', '34', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('69', '34', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('70', '34', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('71', '34', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('72', '34', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('73', '34', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('74', '34', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('75', '34', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('76', '34', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('77', '34', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('78', '35', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('79', '35', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('80', '35', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('81', '35', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('82', '35', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('83', '35', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('84', '35', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('85', '35', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('86', '35', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('87', '35', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('88', '35', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('89', '36', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('90', '36', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('91', '36', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('92', '36', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('93', '36', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('94', '36', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('95', '36', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('96', '36', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('97', '36', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('98', '36', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('99', '36', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('100', '37', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('101', '37', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('102', '37', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('103', '37', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('104', '37', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('105', '37', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('106', '37', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('107', '37', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('108', '37', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('109', '37', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('110', '37', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('111', '38', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('112', '38', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('113', '38', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('114', '38', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('115', '38', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('116', '38', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('117', '38', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('118', '38', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('119', '38', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('120', '38', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('121', '38', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('122', '39', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('123', '39', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('124', '39', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('125', '39', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('126', '39', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('127', '39', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('128', '39', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('129', '39', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('130', '39', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('131', '39', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('132', '39', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('133', '40', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('134', '40', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('135', '40', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('136', '40', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('137', '40', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('138', '40', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('139', '40', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('140', '40', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('141', '40', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('142', '40', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('143', '40', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('144', '41', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('145', '41', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('146', '41', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('147', '41', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('148', '41', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('149', '41', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('150', '41', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('151', '41', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('152', '41', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('153', '41', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('154', '41', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('155', '46', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('156', '46', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('157', '46', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('158', '46', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('159', '46', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('160', '46', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('161', '46', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('162', '46', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('163', '46', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('164', '46', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('165', '46', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('166', '47', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('167', '47', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('168', '47', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('169', '47', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('170', '47', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('171', '47', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('172', '47', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('173', '47', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('174', '47', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('175', '47', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('176', '47', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('177', '48', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('178', '48', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('179', '48', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('180', '48', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('181', '48', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('182', '48', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('183', '48', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('184', '48', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('185', '48', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('186', '48', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('187', '48', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('188', '49', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('189', '49', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('190', '49', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('191', '49', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('192', '49', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('193', '49', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('194', '49', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('195', '49', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('196', '49', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('197', '49', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('198', '49', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('199', '50', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('200', '50', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('201', '50', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('202', '50', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('203', '50', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('204', '50', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('205', '50', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('206', '50', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('207', '50', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('208', '50', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('209', '50', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('210', '51', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('211', '51', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('212', '51', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('213', '51', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('214', '51', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('215', '51', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('216', '51', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('217', '51', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('218', '51', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('219', '51', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('220', '51', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('221', '52', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('222', '52', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('223', '52', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('224', '52', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('225', '52', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('226', '52', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('227', '52', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('228', '52', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('229', '52', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('230', '52', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('231', '52', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('232', '53', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('233', '53', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('234', '53', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('235', '53', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('236', '53', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('237', '53', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('238', '53', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('239', '53', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('240', '53', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('241', '53', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('242', '53', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('243', '54', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('244', '54', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('245', '54', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('246', '54', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('247', '54', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('248', '54', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('249', '54', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('250', '54', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('251', '54', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('252', '54', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('253', '54', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('254', '55', 'A', 'Sangat baik dan sempurna menghafal Al-qur\'an dan Hadits tentang nikmat Allah dan cara mensyukurinya.\r\n', '4.00');
INSERT INTO `predikatketerampilan` VALUES ('255', '55', 'A-', 'Baik dan sempurna menghafal Al-qur\'an dan Hadits tentang nikmat Allah dan cara mensyukurinya.\r\n', '3.68');
INSERT INTO `predikatketerampilan` VALUES ('256', '55', 'B+', 'Baik Sekali menghafal Al-qur\'an dan Hadits tentang nikmat Allah dan cara mensyukurinya.\r\n', '3.34');
INSERT INTO `predikatketerampilan` VALUES ('257', '55', 'B', 'Baik menghafal Al-qur\'an dan Hadits tentang nikmat Allah dan cara mensyukurinya.\r\n', '3.01');
INSERT INTO `predikatketerampilan` VALUES ('258', '55', 'B-', 'Cukup baik menghafal Al-qur\'an dan Hadits tentang nikmat Allah dan cara mensyukurinya.\r\n', '2.68');
INSERT INTO `predikatketerampilan` VALUES ('259', '55', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('260', '55', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('261', '55', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('262', '55', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('263', '55', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('264', '55', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('265', '56', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('266', '56', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('267', '56', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('268', '56', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('269', '56', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('270', '56', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('271', '56', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('272', '56', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('273', '56', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('274', '56', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('275', '56', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('276', '57', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('277', '57', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('278', '57', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('279', '57', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('280', '57', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('281', '57', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('282', '57', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('283', '57', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('284', '57', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('285', '57', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('286', '57', 'E', null, '0.00');
INSERT INTO `predikatketerampilan` VALUES ('287', '58', 'A', null, '4.00');
INSERT INTO `predikatketerampilan` VALUES ('288', '58', 'A-', null, '3.68');
INSERT INTO `predikatketerampilan` VALUES ('289', '58', 'B+', null, '3.34');
INSERT INTO `predikatketerampilan` VALUES ('290', '58', 'B', null, '3.01');
INSERT INTO `predikatketerampilan` VALUES ('291', '58', 'B-', null, '2.68');
INSERT INTO `predikatketerampilan` VALUES ('292', '58', 'C+', null, '2.34');
INSERT INTO `predikatketerampilan` VALUES ('293', '58', 'C', null, '2.01');
INSERT INTO `predikatketerampilan` VALUES ('294', '58', 'C-', null, '1.68');
INSERT INTO `predikatketerampilan` VALUES ('295', '58', 'D+', null, '1.34');
INSERT INTO `predikatketerampilan` VALUES ('296', '58', 'D', null, '1.01');
INSERT INTO `predikatketerampilan` VALUES ('297', '58', 'E', null, '0.00');

-- ----------------------------
-- Table structure for predikatpengetahuan
-- ----------------------------
DROP TABLE IF EXISTS `predikatpengetahuan`;
CREATE TABLE `predikatpengetahuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapel_id` int(11) DEFAULT NULL,
  `huruf` varchar(2) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `lebih_kecil_atau_sama_dengan` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=288 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of predikatpengetahuan
-- ----------------------------
INSERT INTO `predikatpengetahuan` VALUES ('1', '22', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('2', '22', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('3', '22', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('4', '22', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('5', '22', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('6', '22', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('7', '22', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('8', '22', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('9', '22', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('10', '22', 'D', null, '1.00');
INSERT INTO `predikatpengetahuan` VALUES ('11', '22', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('12', '27', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('13', '27', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('14', '27', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('15', '27', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('16', '27', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('17', '27', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('18', '27', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('19', '27', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('20', '27', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('21', '27', 'D', null, '1.00');
INSERT INTO `predikatpengetahuan` VALUES ('22', '27', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('23', '28', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('24', '28', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('25', '28', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('26', '28', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('27', '28', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('28', '28', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('29', '28', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('30', '28', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('31', '28', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('32', '28', 'D', null, '1.00');
INSERT INTO `predikatpengetahuan` VALUES ('33', '28', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('34', '29', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('35', '29', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('36', '29', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('37', '29', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('38', '29', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('39', '29', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('40', '29', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('41', '29', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('42', '29', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('43', '29', 'D', null, '1.00');
INSERT INTO `predikatpengetahuan` VALUES ('44', '29', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('45', '30', 'A', 'Sangat baik dan sempurna. Dapat mengingat, mengetahui, menerapkan, menganalisis, dan mengevaluasi semua materi yang telah disampaikan.', '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('46', '30', 'A-', 'Baik dan sempurna. Dapat mengingat, mengetahui, menerapkan, menganalisis semua materi tetapi kurang teliti mengevaluasi salah satu materi.\r\n', '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('47', '30', 'B+', 'Baik sekali. Dapat mengingat, mengetahui, menerapkan, menganalisis sebagian besar materi tetapi kurang bisa mengevaluasi salah satu dari materi.\r\n', '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('48', '30', 'B', 'Baik. Dapat mengingat, mengetahui, menerapkan, menganalisis sebagian besar materi, tetapi kurang bisa mengevaluasi dua materi.\r\n', '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('49', '30', 'B-', 'Cukup baik, dapat mengingat, mengetahui, menerapkan sebagian besar materi, tetapi kurang bisa menganalisis dan mengevaluasi dua materi.\r\n', '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('50', '30', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('51', '30', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('52', '30', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('53', '30', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('54', '30', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('55', '30', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('57', '34', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('58', '34', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('59', '34', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('60', '34', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('61', '34', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('62', '34', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('63', '34', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('64', '34', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('65', '34', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('66', '34', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('67', '34', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('68', '35', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('69', '35', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('70', '35', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('71', '35', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('72', '35', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('73', '35', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('74', '35', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('75', '35', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('76', '35', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('77', '35', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('78', '35', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('79', '36', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('80', '36', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('81', '36', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('82', '36', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('83', '36', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('84', '36', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('85', '36', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('86', '36', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('87', '36', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('88', '36', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('89', '36', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('90', '37', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('91', '37', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('92', '37', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('93', '37', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('94', '37', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('95', '37', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('96', '37', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('97', '37', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('98', '37', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('99', '37', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('100', '37', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('101', '38', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('102', '38', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('103', '38', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('104', '38', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('105', '38', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('106', '38', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('107', '38', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('108', '38', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('109', '38', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('110', '38', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('111', '38', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('112', '39', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('113', '39', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('114', '39', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('115', '39', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('116', '39', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('117', '39', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('118', '39', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('119', '39', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('120', '39', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('121', '39', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('122', '39', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('123', '40', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('124', '40', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('125', '40', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('126', '40', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('127', '40', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('128', '40', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('129', '40', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('130', '40', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('131', '40', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('132', '40', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('133', '40', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('134', '41', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('135', '41', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('136', '41', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('137', '41', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('138', '41', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('139', '41', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('140', '41', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('141', '41', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('142', '41', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('143', '41', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('144', '41', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('145', '46', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('146', '46', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('147', '46', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('148', '46', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('149', '46', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('150', '46', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('151', '46', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('152', '46', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('153', '46', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('154', '46', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('155', '46', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('156', '47', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('157', '47', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('158', '47', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('159', '47', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('160', '47', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('161', '47', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('162', '47', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('163', '47', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('164', '47', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('165', '47', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('166', '47', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('167', '48', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('168', '48', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('169', '48', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('170', '48', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('171', '48', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('172', '48', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('173', '48', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('174', '48', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('175', '48', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('176', '48', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('177', '48', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('178', '49', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('179', '49', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('180', '49', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('181', '49', 'B', 'bla bla bla', '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('182', '49', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('183', '49', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('184', '49', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('185', '49', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('186', '49', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('187', '49', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('188', '49', 'E', 'Lorem ipsum dolor sit amet', '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('189', '50', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('190', '50', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('191', '50', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('192', '50', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('193', '50', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('194', '50', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('195', '50', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('196', '50', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('197', '50', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('198', '50', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('199', '50', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('200', '51', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('201', '51', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('202', '51', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('203', '51', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('204', '51', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('205', '51', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('206', '51', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('207', '51', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('208', '51', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('209', '51', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('210', '51', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('211', '52', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('212', '52', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('213', '52', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('214', '52', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('215', '52', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('216', '52', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('217', '52', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('218', '52', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('219', '52', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('220', '52', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('221', '52', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('222', '53', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('223', '53', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('224', '53', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('225', '53', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('226', '53', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('227', '53', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('228', '53', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('229', '53', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('230', '53', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('231', '53', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('232', '53', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('233', '54', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('234', '54', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('235', '54', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('236', '54', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('237', '54', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('238', '54', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('239', '54', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('240', '54', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('241', '54', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('242', '54', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('243', '54', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('244', '55', 'A', 'Sangat baik dan sempurna memahami ayat-ayat Al-qur\'an dan Al-hadits tentang nikmat Allah Swt. Dan cara mensyukurinya, tentang perintah menjaga kelestarian lingkungan hidup.\r\n', '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('245', '55', 'A-', 'Baik dan sempurna memahami ayat-ayat Al-qur\'an dan Al-hadits tentang nikmat Allah Swt. Dan cara mensyukurinya, tentang perintah menjaga kelestarian lingkungan hidup.\r\n', '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('246', '55', 'B+', 'Baik sekali memahami ayat-ayat Al-qur\'an dan Al-hadits tentang nikmat Allah Swt. Dan cara mensyukurinya, tentang perintah menjaga kelestarian lingkungan hidup.\r\n', '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('247', '55', 'B', 'Baik memahami ayat-ayat Al-qur\'an dan Al-hadits tentang nikmat Allah Swt. Dan cara mensyukurinya, tentang perintah menjaga kelestarian lingkungan hidup.\r\n', '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('248', '55', 'B-', 'Cukup baik memahami ayat-ayat Al-qur\'an dan Al-hadits tentang nikmat Allah Swt. Dan cara mensyukurinya, tentang perintah menjaga kelestarian lingkungan hidup.\r\n', '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('249', '55', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('250', '55', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('251', '55', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('252', '55', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('253', '55', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('254', '55', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('255', '56', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('256', '56', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('257', '56', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('258', '56', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('259', '56', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('260', '56', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('261', '56', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('262', '56', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('263', '56', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('264', '56', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('265', '56', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('266', '57', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('267', '57', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('268', '57', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('269', '57', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('270', '57', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('271', '57', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('272', '57', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('273', '57', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('274', '57', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('275', '57', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('276', '57', 'E', null, '0.00');
INSERT INTO `predikatpengetahuan` VALUES ('277', '58', 'A', null, '4.00');
INSERT INTO `predikatpengetahuan` VALUES ('278', '58', 'A-', null, '3.68');
INSERT INTO `predikatpengetahuan` VALUES ('279', '58', 'B+', null, '3.34');
INSERT INTO `predikatpengetahuan` VALUES ('280', '58', 'B', null, '3.01');
INSERT INTO `predikatpengetahuan` VALUES ('281', '58', 'B-', null, '2.68');
INSERT INTO `predikatpengetahuan` VALUES ('282', '58', 'C+', null, '2.34');
INSERT INTO `predikatpengetahuan` VALUES ('283', '58', 'C', null, '2.01');
INSERT INTO `predikatpengetahuan` VALUES ('284', '58', 'C-', null, '1.68');
INSERT INTO `predikatpengetahuan` VALUES ('285', '58', 'D+', null, '1.34');
INSERT INTO `predikatpengetahuan` VALUES ('286', '58', 'D', null, '1.01');
INSERT INTO `predikatpengetahuan` VALUES ('287', '58', 'E', null, '0.00');

-- ----------------------------
-- Table structure for predikatsikap
-- ----------------------------
DROP TABLE IF EXISTS `predikatsikap`;
CREATE TABLE `predikatsikap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapel_id` int(11) DEFAULT NULL,
  `huruf` varchar(2) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `lebih_kecil_atau_sama_dengan` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of predikatsikap
-- ----------------------------
INSERT INTO `predikatsikap` VALUES ('12', '22', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('13', '22', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('14', '22', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('15', '22', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('16', '27', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('17', '27', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('18', '27', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('19', '27', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('20', '28', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('21', '28', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('22', '28', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('23', '28', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('24', '29', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('25', '29', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('26', '29', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('27', '29', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('28', '30', 'K', 'Siswa sangat menerima, menjalankan, menghargai, dan menghayati prinsip-prinsip agama yang dianutnya.\r\n', '60.00');
INSERT INTO `predikatsikap` VALUES ('29', '30', 'C', 'Siswa sangat menerima, menjalankan, menghargai, dan menghayati prinsip-prinsip agama yang dianutnya.\r\n', '75.00');
INSERT INTO `predikatsikap` VALUES ('30', '30', 'B', 'Siswa sangat menerima, menjalankan, menghargai, dan menghayati prinsip-prinsip agama yang dianutnya.\r\n', '91.00');
INSERT INTO `predikatsikap` VALUES ('31', '30', 'SB', 'Siswa sangat menerima, menjalankan, menghargai, dan menghayati prinsip-prinsip agama yang dianutnya.\r\n', '100.00');
INSERT INTO `predikatsikap` VALUES ('32', '34', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('33', '34', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('34', '34', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('35', '34', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('36', '35', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('37', '35', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('38', '35', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('39', '35', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('40', '36', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('41', '36', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('42', '36', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('43', '36', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('44', '37', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('45', '37', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('46', '37', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('47', '37', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('48', '38', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('49', '38', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('50', '38', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('51', '38', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('52', '39', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('53', '39', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('54', '39', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('55', '39', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('56', '40', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('57', '40', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('58', '40', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('59', '40', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('60', '41', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('61', '41', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('62', '41', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('63', '41', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('64', '46', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('65', '46', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('66', '46', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('67', '46', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('68', '47', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('69', '47', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('70', '47', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('71', '47', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('72', '48', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('73', '48', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('74', '48', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('75', '48', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('76', '49', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('77', '49', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('78', '49', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('79', '49', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('80', '50', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('81', '50', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('82', '50', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('83', '50', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('84', '51', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('85', '51', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('86', '51', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('87', '51', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('88', '52', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('89', '52', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('90', '52', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('91', '52', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('92', '53', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('93', '53', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('94', '53', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('95', '53', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('96', '54', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('97', '54', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('98', '54', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('99', '54', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('100', '55', 'K', 'KKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK\r\n', '60.00');
INSERT INTO `predikatsikap` VALUES ('101', '55', 'C', 'CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC\r\n', '75.00');
INSERT INTO `predikatsikap` VALUES ('102', '55', 'B', 'siswa beradap ketika sedang dibacakan Alqur\'an\r\n', '91.00');
INSERT INTO `predikatsikap` VALUES ('103', '55', 'SB', 'siswa sangat beradap ketika sedang dibacakan Alqur\'an\r\n', '100.00');
INSERT INTO `predikatsikap` VALUES ('104', '56', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('105', '56', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('106', '56', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('107', '56', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('108', '57', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('109', '57', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('110', '57', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('111', '57', 'SB', null, '100.00');
INSERT INTO `predikatsikap` VALUES ('112', '58', 'K', null, '60.00');
INSERT INTO `predikatsikap` VALUES ('113', '58', 'C', null, '75.00');
INSERT INTO `predikatsikap` VALUES ('114', '58', 'B', null, '91.00');
INSERT INTO `predikatsikap` VALUES ('115', '58', 'SB', null, '100.00');

-- ----------------------------
-- Table structure for profile
-- ----------------------------
DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sekolah` varchar(255) DEFAULT NULL,
  `alamat` text,
  `nama_kepala_sekolah` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of profile
-- ----------------------------
INSERT INTO `profile` VALUES ('1', 'Madrasah Aliyah Insan Qurani', 'Jln. Banda Aceh – Medan Km.12,5 Komp. Masjid Baitul ‘Adhim Ds. Aneuk Batee Kec. Suka Makmur – Aceh Besar', 'Wahyudi Saputra, S.Pd.i.');

-- ----------------------------
-- Table structure for rekapabsen
-- ----------------------------
DROP TABLE IF EXISTS `rekapabsen`;
CREATE TABLE `rekapabsen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `penempatansiswa_id` int(11) DEFAULT NULL,
  `semester_id` int(11) DEFAULT NULL,
  `sakit` int(11) DEFAULT NULL,
  `izin` int(11) DEFAULT NULL,
  `alpha` int(11) DEFAULT NULL,
  `hadir` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rekapabsen
-- ----------------------------
INSERT INTO `rekapabsen` VALUES ('1', '24', '2', '1', '1', '1', '147');
INSERT INTO `rekapabsen` VALUES ('2', '25', '2', '2', '2', '1', '145');

-- ----------------------------
-- Table structure for semester
-- ----------------------------
DROP TABLE IF EXISTS `semester`;
CREATE TABLE `semester` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ganjil_genap` enum('Ganjil','Genap') DEFAULT NULL,
  `tahunajaran_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of semester
-- ----------------------------
INSERT INTO `semester` VALUES ('1', 'Ganjil', '1');
INSERT INTO `semester` VALUES ('2', 'Genap', '1');
INSERT INTO `semester` VALUES ('3', 'Ganjil', '2');
INSERT INTO `semester` VALUES ('4', 'Genap', '2');
INSERT INTO `semester` VALUES ('5', 'Ganjil', '3');
INSERT INTO `semester` VALUES ('6', 'Genap', '3');

-- ----------------------------
-- Table structure for siswa
-- ----------------------------
DROP TABLE IF EXISTS `siswa`;
CREATE TABLE `siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nisn` varchar(255) DEFAULT NULL,
  `nis_lokal` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nama_hijaiyah` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `jenis_kelamin` varchar(1) DEFAULT NULL,
  `tingkat_id` int(11) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of siswa
-- ----------------------------
INSERT INTO `siswa` VALUES ('8', '', '036', 'Aini Fatin', 'عينى فاطن																				', 'p', '11', '5');
INSERT INTO `siswa` VALUES ('9', '', '039', 'Fakhrurrazi Andi', null, 'l', '12', null);

-- ----------------------------
-- Table structure for tahunajaran
-- ----------------------------
DROP TABLE IF EXISTS `tahunajaran`;
CREATE TABLE `tahunajaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun_awal` int(4) DEFAULT NULL,
  `tahun_akhir` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tahunajaran
-- ----------------------------
INSERT INTO `tahunajaran` VALUES ('1', '2016', '2017');
INSERT INTO `tahunajaran` VALUES ('2', '2017', '2018');
INSERT INTO `tahunajaran` VALUES ('3', '2018', '2019');

-- ----------------------------
-- Table structure for tingkat
-- ----------------------------
DROP TABLE IF EXISTS `tingkat`;
CREATE TABLE `tingkat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tingkat` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tingkat
-- ----------------------------
INSERT INTO `tingkat` VALUES ('7', 'VII');
INSERT INTO `tingkat` VALUES ('8', 'VIII');
INSERT INTO `tingkat` VALUES ('9', 'IX');
INSERT INTO `tingkat` VALUES ('10', 'X');
INSERT INTO `tingkat` VALUES ('11', 'XI');
INSERT INTO `tingkat` VALUES ('12', 'XII');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'fakhrurraziandi', 'c85bfb5795c20157585933c8086b1aff', 'Fakhrurrazi Andi');
