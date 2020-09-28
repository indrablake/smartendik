/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100121
 Source Host           : localhost:3306
 Source Schema         : simapedu_igni263

 Target Server Type    : MySQL
 Target Server Version : 100121
 File Encoding         : 65001

 Date: 30/08/2020 12:05:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for dat_berita
-- ----------------------------
DROP TABLE IF EXISTS `dat_berita`;
CREATE TABLE `dat_berita`  (
  `berita_kd` int(11) NOT NULL AUTO_INCREMENT,
  `user_kd` int(11) NOT NULL,
  `berita_judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `berita_tgl_kirim` date NOT NULL,
  `berita_tgl_expired` date NOT NULL,
  `berita_isi` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `berita_video` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `berita_gambar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `berita_status` int(2) NULL DEFAULT NULL,
  PRIMARY KEY (`berita_kd`) USING BTREE,
  INDEX `NP_SENDER`(`user_kd`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 76 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dat_berita
-- ----------------------------
INSERT INTO `dat_berita` VALUES (65, 0, 'Tes123', '2020-08-29', '2020-08-31', '                                ', NULL, 'f6b9cc5ef55dbaf02e8b5156c3ebb753.jpg', 1);
INSERT INTO `dat_berita` VALUES (62, 0, 'Tess90', '2020-08-29', '2020-08-31', '                                ', NULL, 'eaad3d395b2d4d82055e90a30fab3ffd.jpg', 1);
INSERT INTO `dat_berita` VALUES (63, 0, 'Tess80', '2020-08-29', '2020-08-31', '                                ', NULL, '928ff6db5adbca43d1b7fafb0312c940.PNG', 1);
INSERT INTO `dat_berita` VALUES (64, 0, 'Tes18', '2020-08-29', '2020-08-31', '                                ', NULL, '064d2a579425196abd0da8be24a368a7.PNG', 1);
INSERT INTO `dat_berita` VALUES (61, 0, 'Tesss6', '2020-08-29', '2020-09-15', '                                                                                                ', '', 'b5217f7a92f0d7e0b0686b23f6264ff0.PNG', 1);
INSERT INTO `dat_berita` VALUES (60, 0, 'Tess4', '2020-08-29', '2030-06-04', '                                ', NULL, '6a56d3f5beabac0cc389e1172f025c17.jpg', 1);
INSERT INTO `dat_berita` VALUES (66, 0, 'Tess5', '2020-08-29', '2020-08-31', '                                ', NULL, '7381a05a8aeba0f7dcd505c334602aef.jpg', 1);
INSERT INTO `dat_berita` VALUES (67, 0, 'Tess6', '2020-08-29', '2020-08-31', 'Hll', NULL, 'e5d420600a60705b43c098bf1345d8a9.jpg', 1);
INSERT INTO `dat_berita` VALUES (68, 0, 'Tess8', '2020-08-29', '2020-08-31', '                                ', NULL, '47e660350652ebccfa5b23a19cf52ff5.jpg', 1);
INSERT INTO `dat_berita` VALUES (69, 0, 'Tess8', '2020-08-29', '2020-08-31', '<p>Tesss10</p>\r\n', NULL, 'e3a1c60e011e83ffc24501da38a305f2.jpg', 1);
INSERT INTO `dat_berita` VALUES (70, 0, 'Tess11', '2020-08-29', '2020-08-31', '                                ', NULL, 'cbd7ccb4c2f424b2d3eb72f2fcac42c6.jpg', 1);
INSERT INTO `dat_berita` VALUES (71, 0, 'Tes123', '2020-08-29', '2020-08-31', '<p>tESS</p>\r\n', NULL, 'db29c63e865902ef103247c8dd995ddb.jpg', 1);
INSERT INTO `dat_berita` VALUES (72, 0, 'Tesstya67', '2020-08-29', '2020-08-31', '', NULL, 'f4900ef410b4fd9e4029a386e80b1347.jpg', 1);
INSERT INTO `dat_berita` VALUES (73, 0, 'Tess8128', '2020-08-29', '2020-08-31', '', NULL, '3ea8673d6c6898338d0a61b4725ed2c2.jpg', 1);
INSERT INTO `dat_berita` VALUES (74, 0, 'Tes42', '2020-08-29', '2020-08-31', '<p>dsadsa</p>\r\n', NULL, 'e45a91a05c9fbeb52cc2ef14ff6c5bc8.jpg', 1);
INSERT INTO `dat_berita` VALUES (75, 0, 'Tes42', '2020-08-29', '2020-08-31', '<p><img alt=\"\" src=\"/Smartendik/assets/kcfinder/upload/files/003-mountain-forest-foggy-wallpaper-1920x1280p-free-download.jpg\" style=\"height:200px; width:300px\" /></p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"height:360px; width:500px\">\r\n			<table align=\"left\" border=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>\r\n						<table>\r\n							<tbody>\r\n								<tr>\r\n									<td style=\"width:50%\">\r\n									<table align=\"left\" border=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n									', NULL, '9214a5a190ed46b6857d56d09da32355.jpg', 1);

-- ----------------------------
-- Table structure for dat_iklan
-- ----------------------------
DROP TABLE IF EXISTS `dat_iklan`;
CREATE TABLE `dat_iklan`  (
  `iklan_kd` int(11) NOT NULL AUTO_INCREMENT,
  `jns_brg_kd` int(11) NOT NULL,
  `iklan_pengirim` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `iklan_disetujui_oleh` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `iklan_judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `iklan_deskripsi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `iklan_tgl_kirim` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `iklan_tgl_expired` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `iklan_status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`iklan_kd`) USING BTREE,
  INDEX `UG_ID`(`jns_brg_kd`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 46 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dat_iklan
-- ----------------------------
INSERT INTO `dat_iklan` VALUES (21, 1, '0', '0', 'dsa', 'dsa', '2020-01-09', '2020-08-26', '0');
INSERT INTO `dat_iklan` VALUES (20, 1, '0', '0', 'Tes', 'Tes2', '2020-01-09', '2020-08-26', '0');
INSERT INTO `dat_iklan` VALUES (19, 1, '0', '0', 'Tes', 'Tes2', '2020-01-09', '2020-08-26', '0');
INSERT INTO `dat_iklan` VALUES (18, 1, '0', '0', '', '', '2020-01-09', '2020-08-26', '0');
INSERT INTO `dat_iklan` VALUES (17, 1, '0', '0', '', '', '2020-01-09', '2020-08-26', '0');
INSERT INTO `dat_iklan` VALUES (16, 1, '0', '0', 'Judul', 'Deskripsi', '2020-01-09', '2020-08-26', '0');
INSERT INTO `dat_iklan` VALUES (22, 1, '0', '0', '', '', '2020-01-09', '2020-08-26', '0');
INSERT INTO `dat_iklan` VALUES (23, 1, '0', '0', '', '', '2020-01-09', '2020-08-26', '0');
INSERT INTO `dat_iklan` VALUES (24, 1, '0', '0', '', '', '2020-01-09', '2020-08-26', '0');
INSERT INTO `dat_iklan` VALUES (25, 1, '0', '0', '', '', '2020-01-09', '2020-08-26', '0');
INSERT INTO `dat_iklan` VALUES (26, 1, '0', '0', '', '', '2020-01-09', '2020-08-26', '0');
INSERT INTO `dat_iklan` VALUES (27, 1, '0', '0', '', '', '2020-01-09', '2020-08-26', '0');
INSERT INTO `dat_iklan` VALUES (28, 1, '0', '0', '', '', '2020-01-09', '2020-08-26', '0');
INSERT INTO `dat_iklan` VALUES (29, 1, '0', '0', '', '', '2020-01-09', '2020-08-26', '0');
INSERT INTO `dat_iklan` VALUES (30, 1, '0', '0', '', '', '2020-01-09', '2020-08-26', '0');
INSERT INTO `dat_iklan` VALUES (31, 1, '0', '0', '', '', '2020-01-09', '2020-08-26', '0');
INSERT INTO `dat_iklan` VALUES (32, 1, '0', '0', '', '', '2020-01-09', '2020-08-26', '0');
INSERT INTO `dat_iklan` VALUES (33, 1, '0', '0', '', '', '2020-01-09', '2020-08-27', '0');
INSERT INTO `dat_iklan` VALUES (34, 1, '0', '0', '', '', '2020-01-09', '2020-08-27', '0');
INSERT INTO `dat_iklan` VALUES (35, 1, '0', '0', '', '', '2020-01-09', '2020-08-27', '0');
INSERT INTO `dat_iklan` VALUES (36, 1, '0', '0', '', '', '2020-01-09', '2020-08-27', '0');
INSERT INTO `dat_iklan` VALUES (37, 1, '0', '0', '', '', '2020-01-09', '2020-08-27', '0');
INSERT INTO `dat_iklan` VALUES (38, 1, '0', '0', '', '', '2020-01-09', '2020-08-27', '0');
INSERT INTO `dat_iklan` VALUES (39, 1, '0', '0', '', '', '2020-01-09', '2020-08-27', '0');
INSERT INTO `dat_iklan` VALUES (40, 1, '0', '0', '', '', '2020-01-09', '2020-08-27', '0');
INSERT INTO `dat_iklan` VALUES (41, 1, '0', '0', '', '', '2020-01-09', '2020-08-27', '0');
INSERT INTO `dat_iklan` VALUES (42, 1, '0', '0', '', '', '2020-01-09', '2020-08-27', '0');
INSERT INTO `dat_iklan` VALUES (43, 1, '0', '0', '', '', '2020-01-09', '2020-08-27', '0');
INSERT INTO `dat_iklan` VALUES (44, 1, '0', '0', '', '', '2020-01-09', '2020-08-27', '0');
INSERT INTO `dat_iklan` VALUES (45, 1, '0', '0', '', '', '2020-01-09', '2020-08-27', '0');

-- ----------------------------
-- Table structure for dat_iklan_gambar
-- ----------------------------
DROP TABLE IF EXISTS `dat_iklan_gambar`;
CREATE TABLE `dat_iklan_gambar`  (
  `iklan_gambar_kd` int(11) NOT NULL AUTO_INCREMENT,
  `iklan_kd` int(11) NOT NULL,
  `iklan_gambar_link` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`iklan_gambar_kd`) USING BTREE,
  INDEX `UG_ID`(`iklan_kd`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 80 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dat_iklan_gambar
-- ----------------------------
INSERT INTO `dat_iklan_gambar` VALUES (79, 45, ' 1e392e468e57070521433a0f563900383915b325faaacfd0d4e5800b8a489f710.jpg');
INSERT INTO `dat_iklan_gambar` VALUES (77, 45, ' eb2580af6745d1025ef2f6f3eb6d61d81b6e3160394c82ed251b5b9c04bdbade0.jpg');
INSERT INTO `dat_iklan_gambar` VALUES (78, 45, ' 4ea208a1fe4919661a24e4c0b1e4caa35beffb110941879c2121761defd32ad6e.jpg');
INSERT INTO `dat_iklan_gambar` VALUES (76, 45, ' e800a66b3537cada8bae0eac852e42028e3c4d248422e2b8795e88f6a275e5683.PNG');
INSERT INTO `dat_iklan_gambar` VALUES (75, 44, ' 62cba4a861e38b7b03a5f446d5e31173d21365e5531451862b363b0ca0b444aeq.jpg');
INSERT INTO `dat_iklan_gambar` VALUES (74, 44, ' a5bad0e16a99ef51291de61b217d1fd46bca19cf9f55cdb439c96224c0f3af9a0.jpg');
INSERT INTO `dat_iklan_gambar` VALUES (73, 43, ' f0a0f5ba132c11ea3c997489f9e380ba09e3637e2a9cb410dc8958c95e2f04b9n.PNG');
INSERT INTO `dat_iklan_gambar` VALUES (72, 43, ' a8909ced7950b84e8b4be82960d3b320537aada02db618762204bf3e9ce40407a.jpg');

-- ----------------------------
-- Table structure for dat_profile
-- ----------------------------
DROP TABLE IF EXISTS `dat_profile`;
CREATE TABLE `dat_profile`  (
  `profile_kd` int(11) NOT NULL AUTO_INCREMENT,
  `jns_user_kd` int(11) NULL DEFAULT NULL,
  `profile_nomor_id` int(11) NULL DEFAULT NULL,
  `profile_nm_1` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_nm_2` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_nm_3` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `agama_kd` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_tempat_lahir` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_tgl_lahir` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_jns_kelamin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `propinsi_kd` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dati2_kd` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kecamatan_kd` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_alamat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_kelurahan` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_kd_pos` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_telp` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_email` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_foto` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_ket_jabatan` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_status` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`profile_kd`) USING BTREE,
  INDEX `USER_ID`(`jns_user_kd`) USING BTREE,
  INDEX `SCH_ID`(`profile_nomor_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 26 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dat_profile
-- ----------------------------
INSERT INTO `dat_profile` VALUES (1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin.PNG', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `dat_profile` VALUES (2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin1.PNG', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `dat_profile` VALUES (3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin2.PNG', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `dat_profile` VALUES (4, 1, NULL, '8888', 'Difa', 'Bekasi', '0000-00-00', 'l', 'i', 'Bekasi', 'Bekasi', NULL, '92929', 'bekasi@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `dat_profile` VALUES (5, 4, NULL, '0292929', 'Difa Ardiansyah', 'Bekasi', '0000-00-00', 'l', 'i', 'Bekasi', 'Kab.Bekasi', NULL, '08992292', 'difa@gmail.com', 'remaja.jpg', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `dat_profile` VALUES (6, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin.PNG', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `dat_profile` VALUES (7, 6, 0, '22', '', '', '0000-00-00', 'l', 'i', '', '', NULL, '', '', 'remaja.jpg', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `dat_profile` VALUES (8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `dat_profile` VALUES (9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `dat_profile` VALUES (11, 9, NULL, '022929', 'Guru Inggris', 'Bogor', '0000-00-00', 'l', 'i', 'Bekasi', 'Bandungg', NULL, '0829922', 'inggris@gmail.com', '1390510_599157100154245_362733406_n.jpg', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `dat_profile` VALUES (12, 1, 231, 'Difa', '', 'Ardiansyah', '0000-00-00', 'B', NULL, 'L', '6', '11', '12', 'Bogor', 'Gadog', '9292', '0892929', 'difaart69@gmail.com', NULL, 'Programmer', '2');
INSERT INTO `dat_profile` VALUES (13, 1, 292992, 'Difa', '', 'Ardiansyah', '0000-00-00', 'B', NULL, 'L', '6', '11', '12', 'Bogor', 'Gadog', '9292', '0892922', 'difaart69@gmail.com', NULL, 'Admin', '2');
INSERT INTO `dat_profile` VALUES (14, 1, 0, '', '', '', '0000-00-00', '', NULL, 'L', '6', '11', '12', '', '', '', '', '', NULL, '', '2');
INSERT INTO `dat_profile` VALUES (15, 1, 0, '', '', '', '0000-00-00', '', NULL, 'L', '6', '11', '12', '', '', '', '', '', 'ds', '', '1');
INSERT INTO `dat_profile` VALUES (16, 1, 231, 'Difa', '', 'Ardiansyah', '1', 'Bekasids', '', 'L', '6', '11', '12', 'Bandung', 'Bogor', '9302', '089222', 'difaart69@gmail.com', '428bd03608823f230d94305192679f15.jpg', 'Admin', '2');
INSERT INTO `dat_profile` VALUES (17, 1, 321, 'saw', 'dsa', 'dsa', '1', 'dsa', '', 'L', '6', '11', '12', 'das', 'dsa', '321', '2432', 'difaart69@gmail.com', '91dcb80f0778306cfe6b850ac3a7a48a.jpg', '432', '1');
INSERT INTO `dat_profile` VALUES (18, 5, 12345, 'Tes', 'Tes', 'Tes', '1', 'Bekasi', NULL, 'L', '6', '11', '12', 'Tes', 'Tes', '1231', '089292', 'tes@gmail.com', '7aafdec42dda7cf2e9b8465e5cc19bb9.jpg', 'Tes', '1');
INSERT INTO `dat_profile` VALUES (19, 5, 12345, 'Tes', 'Tes', 'Tes', '1', 'Bekasi', NULL, 'L', '6', '11', '12', 'Tes', 'Tes', '1231', '089292', 'tes@gmail.com', '05ed8eab2606dc80f8f30967bcec0d60.jpg', 'Tes', '1');
INSERT INTO `dat_profile` VALUES (20, 5, 12345, 'Tes', 'Tes', 'Tes', '1', 'Bekasi', NULL, 'L', '6', '11', '12', 'Tes', 'Tes', '1231', '089292', 'tes@gmail.com', 'f1669856d91727d1b2a010e67a843764.jpg', 'Tes', '1');
INSERT INTO `dat_profile` VALUES (21, 6, 98392, 'Tes2', 'Tes2', 'Tes2', '1', 'Tes2', NULL, 'L', '6', '11', '12', 'Tes2', 'Tes2', '232', '32324', 'difaart69@gmail.com', '384451a9030fa22112ab25769ac4d266.jpg', 'Tes2', '1');
INSERT INTO `dat_profile` VALUES (22, 11, 12345, 'Tes3', 'Tes3', 'Tes3', '1', 'Tes3', NULL, 'L', '6', '11', '12', 'Tes3', 'Tes3', '123', '123', 'difaart69@gmail.com', 'ac250a0cd7bf5b8db1fc22619ea8db6a.jpg', 'Tes3', '1');
INSERT INTO `dat_profile` VALUES (23, 11, 12345, 'Tes3', 'Tes3', 'Tes3', '1', 'Tes3', NULL, 'L', '6', '11', '12', 'Tes3', 'Tes3', '123', '123', 'difaart69@gmail.com', '48e92cf1aa64c11f364bff66247bdc67.jpg', 'Tes3', '1');
INSERT INTO `dat_profile` VALUES (24, 11, 12345, 'Tes3', 'Tes3', 'Tes3', '1', 'Tes3', NULL, 'L', '6', '11', '12', 'Tes3', 'Tes3', '123', '123', 'difaart69@gmail.com', '45495d982e57a325888868343885006d.jpg', 'Tes3', '1');
INSERT INTO `dat_profile` VALUES (25, 11, 12345, 'Tes4', 'Tes4', 'Tes4', '1', 'Tes4', NULL, 'L', '6', '11', '12', 'Tes4', 'Tes4', '123', '123', 'difaart69@gmail.com', '62b144a8a5eef8f2a6a96bfd954d8b0a.jpg', 'Tes4', '1');

-- ----------------------------
-- Table structure for dat_sekolah
-- ----------------------------
DROP TABLE IF EXISTS `dat_sekolah`;
CREATE TABLE `dat_sekolah`  (
  `sekolah_kd` int(11) NOT NULL AUTO_INCREMENT,
  `jenjang_kd` int(11) NOT NULL,
  `sekolah_npsn` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `sekolah_nm` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sekolah_status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `propinsi_kd` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dati2_kd` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kecamatan_kd` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sekolah_alamat` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sekolah_kelurahan` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sekolah_yayasan` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sekolah_kd_pos` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sekolah_telp` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sekolah_fax` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sekolah_email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sekolah_website` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sekolah_facebook` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sekolah_instagram` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sekolah_twitter` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sekolah_logo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sekolah_header1` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sekolah_header2` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sekolah_header3` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`sekolah_kd`) USING BTREE,
  INDEX `FK_REFERENCE_5`(`jenjang_kd`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dat_sekolah
-- ----------------------------
INSERT INTO `dat_sekolah` VALUES (1, 2, '00202', 'SDN 4 Cipanas', '1', 'Jl. Taman Jaya', 'Pacet', 'Gadog', 'Cipanas', 'Jawa Barat', 'Negeri', '083929322', '2222', 'sdn@gmail.com', 'SDN4 Cipanas', 'SDN 4 Cipanas', 'SDN 4 Cipanas', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `dat_sekolah` VALUES (2, 2, '43324', 'SMPN 1 Cipanas', '0', 'JL.Cipanas', 'Cianjur', 'Cianjur', 'Cianjur', 'Jawa Barat', 'Negeri', '082929222', '2322', 'smpn1@gmail.com', 'SMPN 1 Cipanas', 'SMPN 1 Cipanas', 'SMPN 1 Cipanas', 'logo.png', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `dat_sekolah` VALUES (3, 8, '1234', 'SMP 1 Cipanas', '1', '6', '11', '12', 'Bekasi', 'Bogor', 'Negeri', '123', '089322', '12321', 'difaart@gmail.com', 'dsad', 'dsad', 'dsad', 'dsad', NULL, 'dsa', 'sad', 'asd');

-- ----------------------------
-- Table structure for dat_user
-- ----------------------------
DROP TABLE IF EXISTS `dat_user`;
CREATE TABLE `dat_user`  (
  `user_kd` int(11) NOT NULL AUTO_INCREMENT,
  `profile_kd` int(11) NOT NULL,
  `user_nm` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_password` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`user_kd`) USING BTREE,
  INDEX `UG_ID`(`profile_kd`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 22 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dat_user
-- ----------------------------
INSERT INTO `dat_user` VALUES (10, 12, 'Difa167', '$2y$10$gC7QPZNWCFTpvcvmeXeePuTlvkHSwzAB6h5lf9p00A3CQSmdgFNW.');
INSERT INTO `dat_user` VALUES (11, 13, 'Difaart', '$2y$10$05RL/mc5sTrcCroG337BBOUGNzwtWrOhRwXf1oAX3u46s/kAUuUL.');
INSERT INTO `dat_user` VALUES (12, 14, 'dsa', '$2y$10$awg/9MDQ37gQMpxwuExltep416vbE29BGRLCS1gqs1LlX6bfAqkeW');
INSERT INTO `dat_user` VALUES (13, 15, 'sas', '$2y$10$RKobgFGcZSX0//9watXCy.JLnCp3WUd4g73HbGw3VuLt2fCSM1cyO');
INSERT INTO `dat_user` VALUES (14, 16, 'Difa28', '$2y$10$d3k/L2ED4hmaUWAcHcru7.EpPTZv1zRVsnl7S5w1dYvg2ZCb3yTFm');
INSERT INTO `dat_user` VALUES (18, 21, 'pengawas', '$2y$10$YLmECpHnxgHVWBIipkDbnOXMqV.1LHnMQRCbg8BcO0kO0NxsckC.G');
INSERT INTO `dat_user` VALUES (17, 20, 'kepalasekolah123', '$2y$10$/K0QEvgwXcBfk0D0r.3/iuYN7lvHSxhjiM4G3BK6QDsQEuEBv4Kfu');
INSERT INTO `dat_user` VALUES (19, 24, 'guru', '$2y$10$Gl3FjI.Xvnar2Gfc0s1RjuQG89JbN1waEplGWLa0QAyYO.JVHhkZG');
INSERT INTO `dat_user` VALUES (20, 25, 'guruMatematika', '$2y$10$AtZeSQoi7j9HScw5xfxP6.1uRAC1D2M5c9HW0eGNeF5m37Wg9Bj5y');
INSERT INTO `dat_user` VALUES (21, 0, 'guru123', '$2y$10$e77eFJz22AuhnCN19XOvUePyIjFqSzLM7Zib35cFmJ6ynDc1mVAZ2');

-- ----------------------------
-- Table structure for guru_mengajar
-- ----------------------------
DROP TABLE IF EXISTS `guru_mengajar`;
CREATE TABLE `guru_mengajar`  (
  `pegawai_kd` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `kelas_kd` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of guru_mengajar
-- ----------------------------
INSERT INTO `guru_mengajar` VALUES ('20', '17');

-- ----------------------------
-- Table structure for pengawas_sekolah
-- ----------------------------
DROP TABLE IF EXISTS `pengawas_sekolah`;
CREATE TABLE `pengawas_sekolah`  (
  `pws_skl_kd` int(11) NOT NULL AUTO_INCREMENT,
  `profile_kd` int(11) NOT NULL,
  `sekolah_kd` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pws_skl_tgl_mulai` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pws_skl_tgl_akhir` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pws_skl_kd`) USING BTREE,
  INDEX `UG_ID`(`profile_kd`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengawas_sekolah
-- ----------------------------
INSERT INTO `pengawas_sekolah` VALUES (19, 21, '2', '2020', '2020');

-- ----------------------------
-- Table structure for ref_agama
-- ----------------------------
DROP TABLE IF EXISTS `ref_agama`;
CREATE TABLE `ref_agama`  (
  `agama_kd` int(255) NOT NULL AUTO_INCREMENT,
  `agama_nm` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`agama_kd`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ref_agama
-- ----------------------------
INSERT INTO `ref_agama` VALUES (1, 'Admin');

-- ----------------------------
-- Table structure for ref_dati2
-- ----------------------------
DROP TABLE IF EXISTS `ref_dati2`;
CREATE TABLE `ref_dati2`  (
  `propinsi_kd` int(255) NOT NULL,
  `dati2_kd` int(255) NOT NULL AUTO_INCREMENT,
  `dati2_nm` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`dati2_kd`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ref_dati2
-- ----------------------------
INSERT INTO `ref_dati2` VALUES (6, 12, 'Kabupaten Banjarnegara');
INSERT INTO `ref_dati2` VALUES (6, 13, 'Kabupaten Banyumas');
INSERT INTO `ref_dati2` VALUES (6, 14, 'Kabupaten Batang');
INSERT INTO `ref_dati2` VALUES (6, 15, 'Kabupaten Blora');
INSERT INTO `ref_dati2` VALUES (6, 16, 'Kabupaten Boyolali');
INSERT INTO `ref_dati2` VALUES (6, 17, 'Kabupaten Brebes');
INSERT INTO `ref_dati2` VALUES (6, 18, 'Kabupaten Cilacap');
INSERT INTO `ref_dati2` VALUES (6, 19, 'Kabupaten Demak');
INSERT INTO `ref_dati2` VALUES (6, 20, 'Kabupaten Grobogan');
INSERT INTO `ref_dati2` VALUES (6, 21, 'Kabupaten Jepara');
INSERT INTO `ref_dati2` VALUES (6, 22, 'Kabupaten Karanganyar');
INSERT INTO `ref_dati2` VALUES (6, 23, 'Kabupaten Kebumen');
INSERT INTO `ref_dati2` VALUES (6, 24, 'Kabupaten Kendal');
INSERT INTO `ref_dati2` VALUES (6, 25, 'Kabupaten Klaten');
INSERT INTO `ref_dati2` VALUES (6, 26, 'Kabupaten Kudus');
INSERT INTO `ref_dati2` VALUES (6, 27, 'Kabupaten Magelang');
INSERT INTO `ref_dati2` VALUES (6, 28, 'Kabupaten Pati');
INSERT INTO `ref_dati2` VALUES (6, 29, 'Kabupaten Pekalongan');

-- ----------------------------
-- Table structure for ref_jenis_barang
-- ----------------------------
DROP TABLE IF EXISTS `ref_jenis_barang`;
CREATE TABLE `ref_jenis_barang`  (
  `jns_brg_kd` int(255) NOT NULL AUTO_INCREMENT,
  `jns_brg_nm` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`jns_brg_kd`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ref_jenis_barang
-- ----------------------------
INSERT INTO `ref_jenis_barang` VALUES (1, 'Admin');
INSERT INTO `ref_jenis_barang` VALUES (3, 'Programmer');
INSERT INTO `ref_jenis_barang` VALUES (5, 'Kulkas');

-- ----------------------------
-- Table structure for ref_jenis_pegawai
-- ----------------------------
DROP TABLE IF EXISTS `ref_jenis_pegawai`;
CREATE TABLE `ref_jenis_pegawai`  (
  `jns_pegawai_kd` int(255) NOT NULL AUTO_INCREMENT,
  `jns_pegawai_nm` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`jns_pegawai_kd`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ref_jenis_pegawai
-- ----------------------------
INSERT INTO `ref_jenis_pegawai` VALUES (1, 'Kepala Sekolah');
INSERT INTO `ref_jenis_pegawai` VALUES (3, 'Guru');

-- ----------------------------
-- Table structure for ref_jenis_user
-- ----------------------------
DROP TABLE IF EXISTS `ref_jenis_user`;
CREATE TABLE `ref_jenis_user`  (
  `jns_user_kd` int(255) NOT NULL AUTO_INCREMENT,
  `jns_user_nm` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`jns_user_kd`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ref_jenis_user
-- ----------------------------
INSERT INTO `ref_jenis_user` VALUES (4, 'Admin Pusat');
INSERT INTO `ref_jenis_user` VALUES (5, 'Admin Kota');
INSERT INTO `ref_jenis_user` VALUES (6, 'Pengawas');
INSERT INTO `ref_jenis_user` VALUES (7, 'Siswa');
INSERT INTO `ref_jenis_user` VALUES (8, 'Admin Kabupaten');
INSERT INTO `ref_jenis_user` VALUES (11, 'Pegawai');

-- ----------------------------
-- Table structure for ref_jenjang_sekolah
-- ----------------------------
DROP TABLE IF EXISTS `ref_jenjang_sekolah`;
CREATE TABLE `ref_jenjang_sekolah`  (
  `jenjang_kd` int(255) NOT NULL AUTO_INCREMENT,
  `jenjang_nm` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`jenjang_kd`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ref_jenjang_sekolah
-- ----------------------------
INSERT INTO `ref_jenjang_sekolah` VALUES (8, 'SD');

-- ----------------------------
-- Table structure for ref_kecamatan
-- ----------------------------
DROP TABLE IF EXISTS `ref_kecamatan`;
CREATE TABLE `ref_kecamatan`  (
  `propinsi_kd` int(255) NOT NULL,
  `dati2_kd` int(255) NOT NULL,
  `kecamatan_nm` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `kecamatan_kd` int(255) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`kecamatan_kd`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ref_kecamatan
-- ----------------------------
INSERT INTO `ref_kecamatan` VALUES (6, 11, 'Bogor', 12);

-- ----------------------------
-- Table structure for ref_propinsi
-- ----------------------------
DROP TABLE IF EXISTS `ref_propinsi`;
CREATE TABLE `ref_propinsi`  (
  `propinsi_kd` int(255) NOT NULL AUTO_INCREMENT,
  `propinsi_nm` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`propinsi_kd`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ref_propinsi
-- ----------------------------
INSERT INTO `ref_propinsi` VALUES (6, 'Jawa Tengah');
INSERT INTO `ref_propinsi` VALUES (7, 'Jawa Timur');
INSERT INTO `ref_propinsi` VALUES (8, 'Nagroe Aceh Darussalam');
INSERT INTO `ref_propinsi` VALUES (9, 'Sumatera Utara');
INSERT INTO `ref_propinsi` VALUES (10, 'Sumatera Barat');
INSERT INTO `ref_propinsi` VALUES (11, 'Riau');
INSERT INTO `ref_propinsi` VALUES (12, 'Kepulauan Riau');
INSERT INTO `ref_propinsi` VALUES (13, 'Jambi');
INSERT INTO `ref_propinsi` VALUES (14, 'Bengkulu');
INSERT INTO `ref_propinsi` VALUES (15, 'Sumatera Selatan');
INSERT INTO `ref_propinsi` VALUES (16, 'Kepulauan Bangka Belitung');
INSERT INTO `ref_propinsi` VALUES (17, 'Lampung');
INSERT INTO `ref_propinsi` VALUES (18, 'Banten');
INSERT INTO `ref_propinsi` VALUES (19, 'DKI Jakarta');
INSERT INTO `ref_propinsi` VALUES (20, 'Jawa Barat');
INSERT INTO `ref_propinsi` VALUES (21, 'Jawa Tengah');
INSERT INTO `ref_propinsi` VALUES (22, 'Jawa Timur');
INSERT INTO `ref_propinsi` VALUES (23, 'DI Yogyakarta');
INSERT INTO `ref_propinsi` VALUES (24, 'Bali');
INSERT INTO `ref_propinsi` VALUES (25, 'Nusa Tenggara Barat');
INSERT INTO `ref_propinsi` VALUES (26, 'Nusa Tenggara Timur');
INSERT INTO `ref_propinsi` VALUES (27, 'Kalimantan Barat');
INSERT INTO `ref_propinsi` VALUES (28, 'Kalimantan Timur');
INSERT INTO `ref_propinsi` VALUES (29, 'Kalimantan Selatan');
INSERT INTO `ref_propinsi` VALUES (30, 'Kalimantan Tengah');
INSERT INTO `ref_propinsi` VALUES (31, 'Kalimantan Utara');
INSERT INTO `ref_propinsi` VALUES (32, 'Gorontalo');
INSERT INTO `ref_propinsi` VALUES (33, 'Sulawesi Barat');
INSERT INTO `ref_propinsi` VALUES (34, 'Sulawesi Selatan');
INSERT INTO `ref_propinsi` VALUES (35, 'Sulawesi Tenggara');
INSERT INTO `ref_propinsi` VALUES (36, 'Sulawesi Utara');
INSERT INTO `ref_propinsi` VALUES (37, 'Maluku');
INSERT INTO `ref_propinsi` VALUES (38, 'Maluku Utara');
INSERT INTO `ref_propinsi` VALUES (39, 'Papua');
INSERT INTO `ref_propinsi` VALUES (40, 'Papua Barat');

-- ----------------------------
-- Table structure for ref_tingkat_kelas
-- ----------------------------
DROP TABLE IF EXISTS `ref_tingkat_kelas`;
CREATE TABLE `ref_tingkat_kelas`  (
  `tk_kelas_level` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `tk_kelas_kode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ref_tingkat_kelas
-- ----------------------------
INSERT INTO `ref_tingkat_kelas` VALUES ('1', 'B');

-- ----------------------------
-- Table structure for sekolah_kelas
-- ----------------------------
DROP TABLE IF EXISTS `sekolah_kelas`;
CREATE TABLE `sekolah_kelas`  (
  `kelas_kd` int(11) NOT NULL AUTO_INCREMENT,
  `sekolah_kd` int(11) NOT NULL,
  `kelas_nm` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `t_kelas_level` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`kelas_kd`) USING BTREE,
  INDEX `UG_ID`(`sekolah_kd`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sekolah_kelas
-- ----------------------------
INSERT INTO `sekolah_kelas` VALUES (16, 3, '1', '1');
INSERT INTO `sekolah_kelas` VALUES (17, 3, '3', '1');

-- ----------------------------
-- Table structure for sekolah_pegawai
-- ----------------------------
DROP TABLE IF EXISTS `sekolah_pegawai`;
CREATE TABLE `sekolah_pegawai`  (
  `pegawai_kd` int(11) NOT NULL AUTO_INCREMENT,
  `sekolah_kd` int(11) NOT NULL,
  `profile_kd` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jns_pegawai_kd` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pegawai_tgl_mulai` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pegawai_tgl_berakhir` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pegawai_kd`) USING BTREE,
  INDEX `UG_ID`(`sekolah_kd`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 21 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sekolah_pegawai
-- ----------------------------
INSERT INTO `sekolah_pegawai` VALUES (19, 24, '2', '3 guru', '2020', '2020');
INSERT INTO `sekolah_pegawai` VALUES (20, 25, '2', '3', '2020', '2020');
INSERT INTO `sekolah_pegawai` VALUES (18, 1, '0', '1', '25/08/2020', '25/08/2020');
INSERT INTO `sekolah_pegawai` VALUES (16, 1, '0', '1', '', '');
INSERT INTO `sekolah_pegawai` VALUES (17, 1, '17', '1', '25/08/2020', '25/08/2020');

-- ----------------------------
-- Table structure for tbl_classsmember
-- ----------------------------
DROP TABLE IF EXISTS `tbl_classsmember`;
CREATE TABLE `tbl_classsmember`  (
  `CLSMEM_STUDYYEAR` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CLASS_ID` int(11) NOT NULL,
  `STD_ID` int(11) NOT NULL,
  PRIMARY KEY (`CLSMEM_STUDYYEAR`, `CLASS_ID`, `STD_ID`) USING BTREE,
  INDEX `CLASS_ID`(`CLASS_ID`) USING BTREE,
  INDEX `STD_ID`(`STD_ID`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of tbl_classsmember
-- ----------------------------
INSERT INTO `tbl_classsmember` VALUES ('1990', 1, 1);
INSERT INTO `tbl_classsmember` VALUES ('1990', 1, 2);
INSERT INTO `tbl_classsmember` VALUES ('1990', 1, 3);
INSERT INTO `tbl_classsmember` VALUES ('1990', 2, 2);

-- ----------------------------
-- Table structure for tbl_dailyvaluation
-- ----------------------------
DROP TABLE IF EXISTS `tbl_dailyvaluation`;
CREATE TABLE `tbl_dailyvaluation`  (
  `DVAL_DATE` date NOT NULL,
  `RPPH_ID` int(11) NOT NULL,
  `RPPHVALINDICATOR_INDEX` int(11) NOT NULL,
  `RPPHVALINDDET_CODE` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STD_ID` int(11) NOT NULL,
  `DVAL_BB` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DVAL_MB` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DVAL_BSH` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DVAL_BSB` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`DVAL_DATE`, `RPPH_ID`, `RPPHVALINDICATOR_INDEX`, `RPPHVALINDDET_CODE`, `STD_ID`) USING BTREE,
  INDEX `RPPH_ID`(`RPPH_ID`, `RPPHVALINDICATOR_INDEX`, `RPPHVALINDDET_CODE`) USING BTREE,
  INDEX `STD_ID`(`STD_ID`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_dailyvaluation
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_newspost
-- ----------------------------
DROP TABLE IF EXISTS `tbl_newspost`;
CREATE TABLE `tbl_newspost`  (
  `NP_ID` int(11) NOT NULL AUTO_INCREMENT,
  `NP_SENDER` int(11) NOT NULL,
  `NP_TITLE` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `NP_EXPDATE` date NOT NULL,
  `NP_POSTDATE` date NOT NULL,
  `NP_CONTENT` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `NP_VIDEOLINK` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `NP_IMAGELINK` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`NP_ID`) USING BTREE,
  INDEX `NP_SENDER`(`NP_SENDER`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 45 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_newspost
-- ----------------------------
INSERT INTO `tbl_newspost` VALUES (5, 0, 'Kelurahan Parung Jaya di Tangerang Nihil Covid-19, Tokoh Agama dan Pemuda Jadi Kunci ', '0000-00-00', '2020-07-18', '<div style=\"position: absolute; left: -99999px;\">TANGERANG, KOMPAS.com - Pendekatan keagamaan dan gerakan kepemudaan menjadi kunci Kelurahan Parung Jaya, Kota Tangerang mempertahankan status salah satu kelurahan yang tak memiliki riwayat kasus Covid-19 hingga saat ini. Kepala Lurah Parung Jaya, Mardani mengatakan pendekatan keagamaan dinilai paling memiliki pengaruh terhadap kesadaran masyarakat di Parung Jaya untuk melaksanakan protokol kesehatan. &quot;Sejak sebelum pengajian dilarang, kami sudah mulai sosialisasikan bahaya corona ini,&quot; ujar dia saat dihubungi Kompas.com, Rabu (15/7/2020). Mardani mengatakan, setelah pengajian ditutup untuk menghindari penyebaran Covid-19, tokoh agama di tempat tersebut berperan aktif memberikan kesadaran kepada masyarakat sekitar. Baca juga: 7 Kelurahan di Tangerang Masih Nihil Kasus Positif Covid-19, Di Mana Saja? Warga dengan mayoritas Betawi Muslim juga langsung memberikan respons positif terhadap sosialisasi protokol Covid-19 dari pendekatan keagamaan. Begitu juga saat shalat jumat mulai dibuka, Mardani mengatakan khutbah Jumat sering diselipkan pentingnya menjaga diri dan keluarga dari penularan virus Corona. &quot;Ketika Jumat juga kita minta untuk disosialisasikan,&quot; kata dia. Kelurahan yang terdiri 6.131 Kepala Keluarga tersebut berhasil mempertahankan status nihil kasus Covid-19 meskipun Covid-19 di Indonesia sudah berjalan lebih dari 4 bulan. Selain pendekatan keagamaan, Mardani mengatakan peran serta para pemuda di Parung Jaya juga memiliki andil besar. Baca juga: Gubernur Banten Izinkan Ojol GoJek dan Grab Angkut Penumpang di Tangerang Raya Ketika diimbau untuk melakukan penjagaan ketat terhadap pendatang, organisasi pemuda di kelurahan langsung bertindak untuk membuat portal-portal di jalur-jalur masuk kelurahan.<br />\r\n<br />\r\nArtikel ini telah tayang di <a href=\"http://kompas.com\">Kompas.com</a> dengan judul &quot;Kelurahan Parung Jaya di Tangerang Nihil Covid-19, Tokoh Agama dan Pemuda Jadi Kunci&quot;, <a href=\"https://nasional.kompas.com/read/2020/07/15/16453451/kelurahan-parung-jaya-di-tangerang-nihil-covid-19-tokoh-agama-dan-pemuda\">https://nasional.kompas.com/read/2020/07/15/16453451/kelurahan-parung-jaya-di-tangerang-nihil-covid-19-tokoh-agama-dan-pemuda</a>.<br />\r\nPenulis : Singgih Wiryono<br />\r\nEditor : Sabrina Asril</div>\r\n\r\n<p><strong>Jakarta</strong> -</p>\r\n\r\n<p>Sekali pranata sosial berubah, tak ada lagi jalan memutar untuk kembali kepada situasi yang sama. Ketika kebijakan untuk membuka semua sektor setelah beberapa bulan lumpuh akibat pandemi, kita tahu, istilah kenormalan baru hanyalah retorika. Pola sosial akan seterusnya, dan selamanya, berubah.</p>\r\n\r\n<p>Pola hidup baru hanyalah salah satu perubahan yang paling tampak. Di balik wajah yang akan terus menggunakan masker, tangan yang akan terus bersentuhan dengan sabun dan <em>hand sanitizer</em>, jauh di dalam hati dan pikiran, berlangsung pembangunan-ulang cara kita memandang dunia dan kehidupan.</p>\r\n\r\n<p>Hubungan manusia dan alam tidaklah sesederhana pengatur dan yang diatur, kini alam mengada dalam alur kehidupan sebagai penentu sebuah perubahan. Dalam waktu yang akan datang, buku-buku sejarah tidak lagi diisi hanya oleh nama, tempat, dan peristiwa, bukan juga politik, ekonomi dan sosial, tetapi unsur-unsur alam yang menjelma menjadi wabah, pergeseran kerak bumi, dan gerakan benda-benda langit.</p>\r\n\r\n<div class=\"clearfix\">&nbsp;</div>\r\n\r\n<div class=\"parallax_detail parallaxB\" style=\"margin:0px auto 20px auto;position: relative;\">\r\n<div class=\"parallax_abs\" style=\"width:430px;\">\r\n<div class=\"parallax_fix\" style=\"width:430px;\">\r\n<div class=\"parallax_ads\" style=\"width:430px;\">&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<p>Ini kali pertama Indonesia sebagai negara berdaulat menghadapi pandemi, dan manusia-manusia yang menghidupnya baru lahir setelah kolera dan flu Spanyol membunuh jutaan jiwa. Namun piranti-piranti yang membentuk negara kita, dan semua negara modern, adalah warisan dari masa-masa wabah.</p>\r\n\r\n<p>Mark Harrison dalam <em>Contagion: How Commerce Has Spread Disease</em> (Yale University Press: 2012) merunut sejarah kebangkitan ekonomi merkantilis setelah wabah pes melanda dunia sejak abad ke-14. Dan ini membentuk sistem negara-bangsa. Karantina dan isolasi yang membantu menahan wabah pes terbukti tidak efektif terhadap pandemi kolera yang melanda Amerika Serikat, Timur Tengah, Rusia, dan Eropa pada abad ke-19.</p>\r\n\r\n<p>Masyarakat harus beradaptasi lagi ketika penyakit mengerikan menyerang orang-orang yang tampaknya sehat, membunuh puluhan ribu masyarakat perkotaan. Karantina tidak dapat membendung mikroba yang tiba di pelabuhan dan stasiun kereta api, sebab negara tidak mungkin hidup tanpa perdagangan.</p>\r\n\r\n<p>Pandemi, kolera, sekali lagi memaksa masyarakat untuk melakukan reformasi. Wabah menyebar bersama kapal-kapal dan kereta api yang menggerakkan ekonomi. Selama ekonomi masing-masing negara saling terikat, selama itu pula wabah menjangkit. Maka menghentikannya mesti melibatkan seluruh negara.</p>\r\n\r\n<p>Pada tahun 1851, negara-negara Eropa mengadakan International Sanitary Conference pertama untuk membahas perbaikan sanitasi dan memperketat suplai air karena kolera menular melalui air dan masuk melalui mulut. Pertemuan itu pula membahas kerja sama global mengurangi kerugian ekonomi dan kesehatan masing-masing negara.</p>\r\n\r\n<p>Pada tahun 1902, organisasi Sanitary Bureau kemudian berubah nama menjadi Pan American Health Organization. Inisiatif internasional ini adalah model awal dari segala kontrak internasional dan pembahasan masalah transnasional lainnya, seperti polusi, perdagangan opium, praktik perburuhan, nuklir, hingga terorisme. PBB baru didirikan pada Oktober 1945.</p>\r\n\r\n<p><strong>Agama Setelah Pandemi </strong></p>\r\n\r\n<p>Marshall Hodgson dalam<em> The Venture of Islam</em> (Volume I: 146) mengatakan, dunia tetap akan berubah bahkan jika Islam tidak muncul di Jazirah Arab. Baginya, kodrat dunia membangkitkan kekuatan baru di samping dua kekuatan besar, Romawi dan Persia, yang kian terpuruk dalam perang berkepanjangan serta kemiskinan yang menyebar di seluruh wilayah. Hanya Jazirah Arab yang hidup dalam kedamaian lantaran jauh dan tidak terjangkau oleh perang.</p>\r\n\r\n<p>Namun Michael W. Dols bergerak lebih jauh (<em>Plague in Early Islamic History</em> dalam <em>Journal of the American Oriental Society,</em> Vol. 94: 371). Kedatangan Muhammad dan Islam, secara politik dan ekonomi, sangat tidak terduga. Namun alam memang menghendakinya.</p>\r\n\r\n<p>Alam merupakan sinonim dari dua peristiwa besar: perubahan iklim dan kepungan wabah. Sepanjang tahun 530-540, 30 tahun sebelum Nabi Muhammad lahir, gunung-gunung berapi memuntahkan lahar tanpa henti. Langit dipenuhi abu vulkanik, sinar matahari tak mampu menembus ke Bumi. Sehingga pada tahun-tahun itu, cuaca menjadi lebih dingin, paceklik di mana-mana, kemiskinan menjalar.</p>\r\n\r\n<p>Kemunculan pandemi pertama sepanjang sejarah umat manusia terjadi pada masa ini. Kita mungkin mengenalnya sebagai wabah Yustinianus, karena muncul ketika Yustinianus I memerintah Romawi. Puncaknya terjadi antara tahun 541-542, namun terus hilang dan muncul sampai tahun 750. Wabah Yustinianus berjalan tiada henti, mengikuti lembah dan sungai atau rute-rute darat, menembus jauh ke pedalaman. Di timur sampai ke kekaisaran Sasani-Persia, di utara sampai ke kepulauan Inggris.</p>\r\n\r\n<p>Wabah menghancurkan masyarakat perkotaan. Populasi Romawi mencapai titik paling rendah dalam sejarah. Hanya penduduk nomaden dan semi-nomaden, yang hidup di pedalaman dan mengandalkan masing-masing suku, tidak menggantungkan ekonomi dari masyarakat lain --karenanya tidak bersentuhan langsung dengan kekaisaran Romawi dan negara-negara di sekitar Mediterania-- yang tetap utuh. Itulah mengapa suku-suku di Arab tiba-tiba bangkit menjadi salah satu kekuatan besar.</p>\r\n\r\n<p>Romawi dan Persia bisa saja runtuh bahkan sebelum suku-suku Arab bersatu dalam panji Islam. Wabah berperan besar dalam kemunculan Islam. Namun di masa-masa setelah kenabian, wabah juga terus muncul dan hilang mengiringi bangkit dan tumbangnya dinasti-dinasti dalam Islam.</p>\r\n\r\n<p>Dinasti Umayyah, menurut catatan Ibn Hajar al-Askalani dalam<em> Badzl al-Ma&#39;un fi Fadl al-</em><em>Tha&#39;un</em>, tak satu tahun pun daerah-daerah metropolitan yang berada dalam kontrolnya tidak terjangkiti wabah. Black Death mengiringi bermacam dinasti sejak kemunculannya di abad ke-14 sampai abad ke-18. Dinasti terakhir, Turki Ottoman, hancur bukan hanya karena Perang Dunia I, tetapi juga wabah kolera yang menyerang berkompi-kompi pasukan kerajaan.</p>\r\n\r\n<p><strong>Pandemi dan Kebangkitan Sains dalam Islam </strong></p>\r\n\r\n<p>Saya membuka kembali kitab <em>al-Istiqamah</em> (Maktabah Awaliyah Semarang, 1411 H/1991 M). Kitab tipis berbahasa Jawa dengan aksara Pegon, berisi doa dan amalan sehari-hari. Sebuah teks salawat pendek yang khusus dibaca setiap wabah tiba, disertai tatacara pembacaannya, kapan, dalam waktu apa, dan berapa kali harus dibaca dalam sehari.</p>\r\n\r\n<p>Salawat tersebut ditulis bersebelahan dengan salawat di masa paceklik, penambah rezeki, amalan-amalan ketika gerhana bulan dan matahari, bahkan bagaimana memperbanyak keturunan. Layaknya buku-buku panduan salat dan doa sehari-hari yang dijual murah dan dapat ditemui di kios buku paling kecil, namun kitab ini didistribusikan terbatas di kalangan keluarga dan murid pengarangnya, Kiai Haji Hasan Abdillah Glenmore, Banyuwangi.</p>\r\n\r\n<p>Saya, dan umumnya muslim Indonesia yang mengikuti oksionalisme Asy&#39;ari, yang meyakini bahwa campur tangan Allah ada dalam segala peristiwa mental dan tubuh ragawi, bergegas mencari perlindungan kepada agama. Kitab-kitab dibuka kembali, riwayat-riwayat ditelusuri demi mencari amalan yang paling kuat untuk menghalau wabah. Nyatanya hampir seluruh kitab, yang tipis dan tebal, yang ditulis dari abad ke-9 sampai abad ke-20, memberikan doa dan tatacara lengkap.</p>\r\n\r\n<p>Bagi Kiai Hasan Abdillah, meski tahun-tahun kehidupannya tidak bersentuhan dengan pandemi, tetap mewariskan panduan paling sederhana, yakni dengan doa. Kitab <em>al-Istiqamah</em> menyiratkan, wabah akan selalu datang sebagaimana kedatangan gerhana, kelaparan, atau masalah keturunan bagi orang-orang tertentu. Wabah tidak ubahnya siklus yang terus berulang. Menjaga diri dari wabah sama pentingnya dengan menjaga ekonomi, perubahan alam, serta ibadah <em>mahdah</em> kepada Allah. Dan karenanya, penjabaran tentang wabah tidak kalah penting dengan penentuan awal dan akhir puasa, perlu atau tidaknya khilafah, hukum memanjangkan janggut, atau poligami.</p>\r\n\r\n<p>Wabah datang tidak hanya mengabarkan kemurkaan Tuhan dan statistik kematian, karenanya agama tidak hanya mengajarkan doa dan tawakal. Wabah selalu datang bersamaan dengan kemiskinan, gejolak alam (bisa sebelum, bersamaan, atau mengakhiri bencana alam), dan perubahan dunia secara besar-besaran.</p>\r\n\r\n<p>Dinasti Umayyah menerbitkan mata uang sendiri untuk menjaga stabilitas ekonomi, bersamaan dengan pendirian biro persuratan untuk memudahkan mobilitas wilayah yang semakin meluas. Ibn Sina menggunakan teori <em>al-arba&#39;iniyah</em> (berdiam di rumah selama 40 hari) untuk mengisolasi pengidap penyakit menular. Ini memungkinkan para pengamal tasawuf untuk menuntaskan suatu amalan yang juga hitungannya 40 hari. Hukum-hukum fikih diperbaharui untuk mengatur kehidupan sosial di tengah pandemi.</p>\r\n\r\n<p>Kedokteran mungkin wilayah yang paling sibuk: menyatukan doktrin agama dan kebebasan pengetahuan di dalam laboratorium. Pertanyaan-pertanyaan apakah wabah murni takdir atau sesuatu yang dapat menular, simptom masing-masing penyakit, bagaimana menjaga imunitas, serta perilaku-perilaku sosial yang bisa dijalankan sekelompok masyarakat menghadapi wabah. Perkembangan ini ditandai sejak tahun 750 (kehancuran Dinasti Umayyah bersamaan dengan hilangnya wabah dan permulaan zaman keemasan Islam) setelah penerjemahan naskah-naskah Yunani, Romawi dan India. Terutama pada masa pandemi Black Death yang juga menghabiskan banyak wilayah Islam.</p>\r\n\r\n<p>Ketika kehidupan modern memisahkan antara ilmu alam dan sosial, dan agama disempitkan sebagai aturan antara Tuhan dan sesama manusia, lambat laun agama kehilangan kepiawaiannya dalam menafsirkan gejolak alam. Kedekatan agama dengan ilmu-ilmu sosial masih sangat terasa. Namun dalam pengetahuan alam, hanya astronomi --lewat ilmu falak-- yang masih bertahan.</p>\r\n\r\n<p>Di samping itu, kita kehilangan cendekiawan-cendekiawan yang mahir baik dalam ilmu agama dan ilmu alam. Rasanya hampir mustahil melihat seorang agamawan terlibat dalam perbincangan-perbincangan kesehatan dan penemuan vaksin.</p>\r\n\r\n<p>Kita masih bertanya-tanya perubahan apa yang bakal terjadi setelah pandemi. Namun agama sepertinya kehilangan posisi tawar jika tidak menggunakan cermin ini sebaik-baiknya: kita telah kehilangan sensibilitas terhadap siklus alam dan pengetahuan yang maha luas.</p>\r\n\r\n<p>&nbsp;\r\n<div style=\"position: absolute; left: -99999px;\">TANGERANG, KOMPAS.com - Pendekatan keagamaan dan gerakan kepemudaan menjadi kunci Kelurahan Parung Jaya, Kota Tangerang mempertahankan status salah satu kelurahan yang tak memiliki riwayat kasus Covid-19 hingga saat ini. Kepala Lurah Parung Jaya, Mardani mengatakan pendekatan keagamaan dinilai paling memiliki pengaruh terhadap kesadaran masyarakat di Parung Jaya untuk melaksanakan protokol kesehatan. &quot;Sejak sebelum pengajian dilarang, kami sudah mulai sosialisasikan bahaya corona ini,&quot; ujar dia saat dihubungi Kompas.com, Rabu (15/7/2020). Mardani mengatakan, setelah pengajian ditutup untuk menghindari penyebaran Covid-19, tokoh agama di tempat tersebut berperan aktif memberikan kesadaran kepada masyarakat sekitar. Baca juga: 7 Kelurahan di Tangerang Masih Nihil Kasus Positif Covid-19, Di Mana Saja? Warga dengan mayoritas Betawi Muslim juga langsung memberikan respons positif terhadap sosialisasi protokol Covid-19 dari pendekatan keagamaan. Begitu juga saat shalat jumat mulai dibuka, Mardani mengatakan khutbah Jumat sering diselipkan pentingnya menjaga diri dan keluarga dari penularan virus Corona. &quot;Ketika Jumat juga kita minta untuk disosialisasikan,&quot; kata dia. Kelurahan yang terdiri 6.131 Kepala Keluarga tersebut berhasil mempertahankan status nihil kasus Covid-19 meskipun Covid-19 di Indonesia sudah berjalan lebih dari 4 bulan. Selain pendekatan keagamaan, Mardani mengatakan peran serta para pemuda di Parung Jaya juga memiliki andil besar. Baca juga: Gubernur Banten Izinkan Ojol GoJek dan Grab Angkut Penumpang di Tangerang Raya Ketika diimbau untuk melakukan penjagaan ketat terhadap pendatang, organisasi pemuda di kelurahan langsung bertindak untuk membuat portal-portal di jalur-jalur masuk kelurahan.<br />\r\n<br />\r\nArtikel ini telah tayang di <a href=\"http://kompas.com\">Kompas.com</a> dengan judul &quot;Kelurahan Parung Jaya di Tangerang Nihil Covid-19, Tokoh Agama dan Pemuda Jadi Kunci&quot;, <a href=\"https://nasional.kompas.com/read/2020/07/15/16453451/kelurahan-parung-jaya-di-tangerang-nihil-covid-19-tokoh-agama-dan-pemuda\">https://nasional.kompas.com/read/2020/07/15/16453451/kelurahan-parung-jaya-di-tangerang-nihil-covid-19-tokoh-agama-dan-pemuda</a>.<br />\r\nPenulis : Singgih Wiryono<br />\r\nEditor : Sabrina Asril</div>\r\n</p>\r\n\r\n<div style=\"position: absolute; left: -99999px;\">TANGERANG, KOMPAS.com - Pendekatan keagamaan dan gerakan kepemudaan menjadi kunci Kelurahan Parung Jaya, Kota Tangerang mempertahankan status salah satu kelurahan yang tak memiliki riwayat kasus Covid-19 hingga saat ini. Kepala Lurah Parung Jaya, Mardani mengatakan pendekatan keagamaan dinilai paling memiliki pengaruh terhadap kesadaran masyarakat di Parung Jaya untuk melaksanakan protokol kesehatan. &quot;Sejak sebelum pengajian dilarang, kami sudah mulai sosialisasikan bahaya corona ini,&quot; ujar dia saat dihubungi Kompas.com, Rabu (15/7/2020). Mardani mengatakan, setelah pengajian ditutup untuk menghindari penyebaran Covid-19, tokoh agama di tempat tersebut berperan aktif memberikan kesadaran kepada masyarakat sekitar. Baca juga: 7 Kelurahan di Tangerang Masih Nihil Kasus Positif Covid-19, Di Mana Saja? Warga dengan mayoritas Betawi Muslim juga langsung memberikan respons positif terhadap sosialisasi protokol Covid-19 dari pendekatan keagamaan. Begitu juga saat shalat jumat mulai dibuka, Mardani mengatakan khutbah Jumat sering diselipkan pentingnya menjaga diri dan keluarga dari penularan virus Corona. &quot;Ketika Jumat juga kita minta untuk disosialisasikan,&quot; kata dia. Kelurahan yang terdiri 6.131 Kepala Keluarga tersebut berhasil mempertahankan status nihil kasus Covid-19 meskipun Covid-19 di Indonesia sudah berjalan lebih dari 4 bulan. Selain pendekatan keagamaan, Mardani mengatakan peran serta para pemuda di Parung Jaya juga memiliki andil besar. Baca juga: Gubernur Banten Izinkan Ojol GoJek dan Grab Angkut Penumpang di Tangerang Raya Ketika diimbau untuk melakukan penjagaan ketat terhadap pendatang, organisasi pemuda di kelurahan langsung bertindak untuk membuat portal-portal di jalur-jalur masuk kelurahan.<br />\r\n<br />\r\nArtikel ini telah tayang di <a href=\"http://kompas.com\">Kompas.com</a> dengan judul &quot;Kelurahan Parung Jaya di Tangerang Nihil Covid-19, Tokoh Agama dan Pemuda Jadi Kunci&quot;, <a href=\"https://nasional.kompas.com/read/2020/07/15/16453451/kelurahan-parung-jaya-di-tangerang-nihil-covid-19-tokoh-agama-dan-pemuda\">https://nasional.kompas.com/read/2020/07/15/16453451/kelurahan-parung-jaya-di-tangerang-nihil-covid-19-tokoh-agama-dan-pemuda</a>.<br />\r\nPenulis : Singgih Wiryono<br />\r\nEditor : Sabrina Asril</div>\r\n\r\n<div style=\"position: absolute; left: -99999px;\">TANGERANG, KOMPAS.com - Pendekatan keagamaan dan gerakan kepemudaan menjadi kunci Kelurahan Parung Jaya, Kota Tangerang mempertahankan status salah satu kelurahan yang tak memiliki riwayat kasus Covid-19 hingga saat ini. Kepala Lurah Parung Jaya, Mardani mengatakan pendekatan keagamaan dinilai paling memiliki pengaruh terhadap kesadaran masyarakat di Parung Jaya untuk melaksanakan protokol kesehatan. &quot;Sejak sebelum pengajian dilarang, kami sudah mulai sosialisasikan bahaya corona ini,&quot; ujar dia saat dihubungi Kompas.com, Rabu (15/7/2020). Mardani mengatakan, setelah pengajian ditutup untuk menghindari penyebaran Covid-19, tokoh agama di tempat tersebut berperan aktif memberikan kesadaran kepada masyarakat sekitar. Baca juga: 7 Kelurahan di Tangerang Masih Nihil Kasus Positif Covid-19, Di Mana Saja? Warga dengan mayoritas Betawi Muslim juga langsung memberikan respons positif terhadap sosialisasi protokol Covid-19 dari pendekatan keagamaan. Begitu juga saat shalat jumat mulai dibuka, Mardani mengatakan khutbah Jumat sering diselipkan pentingnya menjaga diri dan keluarga dari penularan virus Corona. &quot;Ketika Jumat juga kita minta untuk disosialisasikan,&quot; kata dia. Kelurahan yang terdiri 6.131 Kepala Keluarga tersebut berhasil mempertahankan status nihil kasus Covid-19 meskipun Covid-19 di Indonesia sudah berjalan lebih dari 4 bulan. Selain pendekatan keagamaan, Mardani mengatakan peran serta para pemuda di Parung Jaya juga memiliki andil besar. Baca juga: Gubernur Banten Izinkan Ojol GoJek dan Grab Angkut Penumpang di Tangerang Raya Ketika diimbau untuk melakukan penjagaan ketat terhadap pendatang, organisasi pemuda di kelurahan langsung bertindak untuk membuat portal-portal di jalur-jalur masuk kelurahan.<br />\r\n<br />\r\nArtikel ini telah tayang di <a href=\"http://kompas.com\">Kompas.com</a> dengan judul &quot;Kelurahan Parung Jaya di Tangerang Nihil Covid-19, Tokoh Agama dan Pemuda Jadi Kunci&quot;, <a href=\"https://nasional.kompas.com/read/2020/07/15/16453451/kelurahan-parung-jaya-di-tangerang-nihil-covid-19-tokoh-agama-dan-pemuda\">https://nasional.kompas.com/read/2020/07/15/16453451/kelurahan-parung-jaya-di-tangerang-nihil-covid-19-tokoh-agama-dan-pemuda</a>.<br />\r\nPenulis : Singgih Wiryono<br />\r\nEditor : Sabrina Asril</div>\r\n\r\n<div style=\"position: absolute; left: -99999px;\">TANGERANG, KOMPAS.com - Pendekatan keagamaan dan gerakan kepemudaan menjadi kunci Kelurahan Parung Jaya, Kota Tangerang mempertahankan status salah satu kelurahan yang tak memiliki riwayat kasus Covid-19 hingga saat ini. Kepala Lurah Parung Jaya, Mardani mengatakan pendekatan keagamaan dinilai paling memiliki pengaruh terhadap kesadaran masyarakat di Parung Jaya untuk melaksanakan protokol kesehatan. &quot;Sejak sebelum pengajian dilarang, kami sudah mulai sosialisasikan bahaya corona ini,&quot; ujar dia saat dihubungi Kompas.com, Rabu (15/7/2020). Mardani mengatakan, setelah pengajian ditutup untuk menghindari penyebaran Covid-19, tokoh agama di tempat tersebut berperan aktif memberikan kesadaran kepada masyarakat sekitar. Baca juga: 7 Kelurahan di Tangerang Masih Nihil Kasus Positif Covid-19, Di Mana Saja? Warga dengan mayoritas Betawi Muslim juga langsung memberikan respons positif terhadap sosialisasi protokol Covid-19 dari pendekatan keagamaan. Begitu juga saat shalat jumat mulai dibuka, Mardani mengatakan khutbah Jumat sering diselipkan pentingnya menjaga diri dan keluarga dari penularan virus Corona. &quot;Ketika Jumat juga kita minta untuk disosialisasikan,&quot; kata dia. Kelurahan yang terdiri 6.131 Kepala Keluarga tersebut berhasil mempertahankan status nihil kasus Covid-19 meskipun Covid-19 di Indonesia sudah berjalan lebih dari 4 bulan. Selain pendekatan keagamaan, Mardani mengatakan peran serta para pemuda di Parung Jaya juga memiliki andil besar. Baca juga: Gubernur Banten Izinkan Ojol GoJek dan Grab Angkut Penumpang di Tangerang Raya Ketika diimbau untuk melakukan penjagaan ketat terhadap pendatang, organisasi pemuda di kelurahan langsung bertindak untuk membuat portal-portal di jalur-jalur masuk kelurahan.<br />\r\n<br />\r\nArtikel ini telah tayang di <a href=\"http://kompas.com\">Kompas.com</a> dengan judul &quot;Kelurahan Parung Jaya di Tangerang Nihil Covid-19, Tokoh Agama dan Pemuda Jadi Kunci&quot;, <a href=\"https://nasional.kompas.com/read/2020/07/15/16453451/kelurahan-parung-jaya-di-tangerang-nihil-covid-19-tokoh-agama-dan-pemuda\">https://nasional.kompas.com/read/2020/07/15/16453451/kelurahan-parung-jaya-di-tangerang-nihil-covid-19-tokoh-agama-dan-pemuda</a>.<br />\r\nPenulis : Singgih Wiryono<br />\r\nEditor : Sabrina Asril</div>\r\n', NULL, '003-mountain-forest-foggy-wallpaper-1920x1280p-free-download.jpg');
INSERT INTO `tbl_newspost` VALUES (3, 0, 'Maintenance', '0000-00-00', '2020-07-18', '<p>Konten Kosong</p>\r\n', NULL, 'black_light_dark_figures_73356_1920x10801.jpg');
INSERT INTO `tbl_newspost` VALUES (6, 0, 'Malapetaka Berulang dan Wacana Spiritualisme Kritis ', '2020-03-18', '2020-07-18', '<div style=\"text-align: left;\">Salah satu kekhasan yang menonjol dari manusia adalah kemampuannya mengkhidmati tiga dimensi waktu: lampau, kini, dan menjelang. Ketidakmampuan menghidupkan salah satu dimensi hanya akan membuat manusia menjadi tuna sejarah. Dan, keengganan menghidupkan dimensi yang silam menjadi salah satu persoalan serius yang sering kita lihat. Dari waktu ke waktu, tidak sedikit orang gampang berurusan dengan hal yang sama (telah terjadi), lagi dan lagi.<br />\r\n<br />\r\nDalam konteks polemik kebenaran ajaran agama, kita sering melihat orang-orang bertikai saling memperebutkan &quot;kebenaran&quot; masing-masing ajarannya; bersitegang, berangsur kemudian melupakan. Setelahnya, kita tahu, polemik yang sama terulang kembali untuk kemudian saling bersitegang lagi seraya menuding &quot;kafir&quot; satu sama lain. Tak berkesudahan.</div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\nPersoalan berbuntut malapetaka seperti itulah yang berusaha disuguhkan Aveus Har dalam novelnya yang berjudul <em>Forgulos</em> ini. Karya yang memenangkan Sayembara Novel Basabasi 2019 dengan mengalahkan hampir 1700-an naskah ini berusaha menggambarkan sebuah ironi yang tak berkesudahan dan terus berulang.</div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\n<em>Forgulos</em> terutama bercerita tentang kehidupan para<em> vuloses</em> di Vulos, lembah subur di tepi pantai yang terimpit bukit hijau. Dikisahkan kehidupan <em>vuloses</em> semula berjalan damai dan tenteram. Aveus berusaha mempertahankan stereotip gambaran kehidupan &quot;masyarakat primitif&quot; pada umumnya yang belum terjamah oleh peradaban luar, hingga kemudian tubuh Arthur ditemukan mengambang di pantai Vulos dan mengubah stagnasi kehidupan para <em>vuloses</em>.</div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\nLebih dari sekadar mengubah, diam-diam kehadiran Arthur di tengah-tengah <em>vuloses</em> justru telah membuka tabir atas malapetaka yang akan terjadi di lembah nan damai tersebut. Sebab seluruh tragedi yang terjadi di Vulos, baik di masa lalu maupun di masa yang mendatang, bermula karena kehadiran<em> forgulos --</em>sesuatu yang asing.</div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\nAdapun Arthur adalah seorang <em>Priusta Quosa</em> (Serdadu Tuhan) dalam agama Quos --sebuah agama yang mempercayai Quo sebagai perwujudan Tuhan dalam sosok manusia yang menunjukkan Jalan Kebenaran. Semua bermula ketika di tempatnya tinggal, bersama tiga puluh Serdadu Tuhan serta sepuluh Pelayan Tuhan dan awak-awak kapal, Arthur diutus oleh Kaisar untuk melayar ke berbagai penjuru untuk menyerukan ajaran agamanya, Misi Suci Agama Quos.</div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\nSebagaimana titah Kaisar, pelayaran itu hanya akan berhenti oleh dua hal, menemukan daratan atau ditelan lautan. Tersebab oleh pusaran angin di tengah samudera, kapal yang ditumpangi para utusan Kaisar itu telah lebih dulu porak-poranda sebelum menemukan daratan yang kelak menjadi tempat Arthur beserta rekannya menjalankan misi suci mereka. Hanya Arthur yang berhasil selamat dari badai dan pusaran angin yang menghantam kapal tersebut.<br />\r\n<br />\r\nDitopang oleh bongkahan kapal yang didorong oleh dua lumba-lumba, sampailah tubuh Arthur di lembah Vulos dan ditemukan oleh dua nelayan <em>vuloses. </em>Di Vulos ada Konstitue Vulos (Dewan Konstitusi) yang memerintah dan memastikan keberlangsungan hidup para<em> vuloses</em>. Ada empat belas Komitus (komite) yang mewakili<br />\r\nmasing-masing klan atau marga di Konstitue Vulos. Sehingga gedung dewan konstitusi di sana disebut sebagai Rumah Empat Belas.</div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\nDari empat belas Komitus, hanya Bero yang menolak Arthur, sebagai <em>forgulos --</em>sesuatu yang asing-- untuk diterima hidup bersama para <em>vuloses</em> di Vulos, sebagaimana anjuran nenek moyang <em>vuloses</em> untuk selalu menjauhi <em>forgulos</em>.</div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\nSebagaimana misi awalnya, ketika sudah bertahun-tahun tinggal dan mampu berbahasa dengan para <em>vuloses</em>, Arthur mulai menyerukan ajaran agama Quos serta diizinkan membangun Chuosa, tempat peribadatan agama Quos. Semula para <em>vuloses</em> adalah orang-orang <em>atoses</em> --tak beragama, tetapi meyakini adanya Tuhan. Tetapi diam-diam, jauh sebelum kedatangan Arthur beserta ajaran agama Quos, Elua, salah satu Komitus di Rumah Empat Belas dan sebagian besar <em>vuloses</em>, telah menganut ajaran agama Freos, agama monoestik yang menyembah Freo sebagai Tuhan yang tunggal dan meyakini Muos sebagai leluhur serta nabi agama Freos.</div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\nLalu cerita bergulir hingga para <em>vuloses</em> yang mulanya <em>atoses</em>, masing-masing memeluk satu agama, Quos atau Freos, dan tetap hidup berdampingan, kecuali Bero yang tetap memilih menjadi <em>atoses</em> dan mengasingkan diri di gua di atas bukit. Hingga beratus-ratus kemudian, terjadi malapetaka di lembah tersebut.</div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\nMalapetaka yang tak berkesudahan dan terus berulang itu diinformasikan oleh Aveus melalui pertanyaan serta pengamatan para <em>vuloses</em> terkait runtuhan puing-puing bangunan yang terbuat dari baja dan beton di sekitar mereka. Sebab jauh sebelum tubuh Arthur mengambang di pantai Vulos, pernah ada suatu peradaban &quot;maju&quot; di Vulos. Sebagaimana tulisan yang tercantum di sampul belakang buku ini:</div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\n<em>Ada bekas-bekas peradaban yang tak mampu mereka bayangkan di Vulos, namun tidak ada cerita masa lalu yang diturun-temurunkan selain anjuran, &#39;Jauhi forgulos, usir forgulos!&#39;</em></div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\nMelalui plot utama tersebut premis novel ini dibangun: sejarah selalu berulang pada dirinya sendiri, pertama sebagai tragedi, kedua sebagai lelucon --berangkat dari ungkapan terkenal Karl Marx dalam <em>Eighteenth Brumaire of Louis Bonaparte</em>. (Atau mungkin premis yang lebih tepat ialah, sejarah selalu berulang pada dirinya sendiri, pertama sebagai tragedi, kedua tetap sebagai tragedi).</div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\nHal tersebut bisa dilihat bagaimana Aveus mengakhiri bab 11: <em>Vulos kembali menjadi suku yang tidak terhubung dengan dunia luar, bertahun-tahun lamanya mereka taat pada petuah moyang untuk mengusir dan menjauhi forgulos. Namun, selama tahun-tahun itu mereka tidak tahu apa atau siapa yang dimaksud moyang mereka itu, hingga... </em>Dan bagaimana Aveus mengawali bab 12 novel ini: <em>...dua ratus tahun kemudian, sesosok tubuh mengambang di pantai Vulos.</em></div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\nKetika membaca paragraf penutup dan pembuka tadi, tampak jelas bahwa paragraf tersebut adalah paragraf yang utuh. Demikianlah Aveus menyajikan kisah kepada kita. Ia memberikan penegasan setelah kolofon, sebelum daftar isi:</div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\n<em>Perhatian! Jika kau menyimak (membaca) cerita (novel) ini dari bab dua belas, memang demikianlah (kisah ini diceritakan).</em></div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\n<strong>Kritik Keberagamaan</strong></div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\n<em>Forgulos</em> seolah hadir sebagai kritik atas laku keberagamaan masyarakat dewasa ini yang, kita tahu, sering kali bertikai menuding kafir satu sama lain. Ada kecenderungan gagasan &quot;spiritualisme kritis&quot; dalam novel ini. Meminjam definisi Ayu Utami yang sebelumnya membawa gagasan ini dalam novel <em>Bilangan Fu</em> (2008), spiritualisme kritis adalah keterbukaan terhadap yang spiritual tanpa mengkhianati nalar kritis: sikap kritis terhadap kebenaran yang dibawa oleh seluruh agama tanpa menimbulkan sikap anti terhadap agama itu sendiri.</div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\nMunculnya konsep spiritualisme kritis dalam <em>Forgulos</em> mulanya dipicu oleh perbedaan paham kebenaran antara penganut Agama Quos dan Agama Freos, khususnya kebenaran tentang sifat-sifat ketuhanan, lalu berlanjut dalam ranah sosial, politik dan ekonomi. Perbedaan paham yang berujung pada pertikaian, bahkan peperangan antara pemeluk masing-masing agama.</div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\nPermasalahan spiritualisme kritis diinformasikan oleh Aveus melalui laku kritik dua tokoh lintas generasi, Bero dan Obre. Keduanya semacam anomali yang sama-sama terasing. Keduanya enggan menjadi pemeluk agama Quos maupun Freos kendati mereka tetap percaya terhadap keberadaan Tuhan di alam semesta.</div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\nKeberanian Aveus menyajikan kisah dengan tema yang terbilang rumit ini tentu saja patut diapresiasi. Ia mampu menyajikan cerita menarik dengan narasi-narasi yang memikat dan tampak berusaha menghindari narasi yang bersifat didaktis.</div>\r\n\r\n<div style=\"text-align: left;\"><br />\r\nSebagai novel eksperimental berisi pelbagai konflik yang tidak klise ditambah sedikit bumbu romantisme di dalamnya, bagi saya, ia memang layak keluar sebagai pemenang sayembara. Sungguh karya yang patut dirayakan!</div>\r\n', NULL, 'forgulos_169.jpg');
INSERT INTO `tbl_newspost` VALUES (7, 0, 'Tes', '2013-03-19', '2020-08-20', '<p>Tes4</p>\r\n', NULL, 'belibuk1.PNG');
INSERT INTO `tbl_newspost` VALUES (8, 0, 'Tes', '2013-03-20', '2020-08-20', '<p>Ts35</p>\r\n', NULL, NULL);
INSERT INTO `tbl_newspost` VALUES (9, 0, 'ats', '2013-03-06', '2020-08-20', '                                ', NULL, NULL);
INSERT INTO `tbl_newspost` VALUES (10, 0, 'Tes77', '2013-03-18', '2020-08-20', '                                ', NULL, NULL);
INSERT INTO `tbl_newspost` VALUES (11, 0, 'Yes', '2013-03-18', '2020-08-20', '                                ', NULL, '');
INSERT INTO `tbl_newspost` VALUES (12, 0, 'Tesss', '2013-03-18', '2020-08-20', '                                ', NULL, NULL);
INSERT INTO `tbl_newspost` VALUES (13, 0, 'Tesss', '2013-03-18', '2020-08-20', '                                ', NULL, NULL);
INSERT INTO `tbl_newspost` VALUES (14, 0, 'S', '2013-03-18', '2020-08-20', '                                ', NULL, NULL);
INSERT INTO `tbl_newspost` VALUES (15, 0, 'Ss', '2013-03-18', '2020-08-20', '                                ', NULL, 'C:\\fakepath\\003-mountain-forest-foggy-wallpaper-1920x1280p-free-download.jpg');
INSERT INTO `tbl_newspost` VALUES (16, 0, 'ds', '2013-03-18', '2020-08-20', '                                ', NULL, NULL);
INSERT INTO `tbl_newspost` VALUES (17, 0, 'Tsss', '2013-03-18', '2020-08-20', '                                ', NULL, NULL);
INSERT INTO `tbl_newspost` VALUES (18, 0, 'as', '2013-03-18', '2020-08-20', '                                ', NULL, NULL);
INSERT INTO `tbl_newspost` VALUES (19, 0, 'dsa', '2013-03-18', '2020-08-20', '         dsa                       ', NULL, NULL);
INSERT INTO `tbl_newspost` VALUES (20, 0, NULL, '2020-08-20', '0000-00-00', NULL, NULL, '');
INSERT INTO `tbl_newspost` VALUES (21, 0, NULL, '2020-08-20', '0000-00-00', NULL, NULL, '');
INSERT INTO `tbl_newspost` VALUES (22, 0, NULL, '2020-08-20', '0000-00-00', NULL, NULL, '');
INSERT INTO `tbl_newspost` VALUES (23, 0, 'sds', '2013-03-18', '0000-00-00', '                                ', NULL, '');
INSERT INTO `tbl_newspost` VALUES (24, 0, 'Tes', '0000-00-00', '2020-08-22', '<p>Tes</p>\r\n', NULL, '2f0404f6ebf2309316c0f86511f3f47f.jpg');
INSERT INTO `tbl_newspost` VALUES (25, 0, 'Tess3', '0000-00-00', '2020-08-22', '                                ', NULL, '4afa06c9a7b5038bdecaeea305059257.jpg');
INSERT INTO `tbl_newspost` VALUES (26, 0, 'GDD', '0000-00-00', '2020-08-22', '                                ', NULL, '2acf30e2e5155e294f60ee23ea5820b0.PNG');
INSERT INTO `tbl_newspost` VALUES (27, 0, 'GDD', '0000-00-00', '2020-08-22', '<p>FSFS</p>\r\n', NULL, '76412e31c4544113858739e894a41cac.mp4');
INSERT INTO `tbl_newspost` VALUES (28, 0, 'FSA', '0000-00-00', '2020-08-22', '                                ', NULL, '2a7be793d80e3eb03d3637690ffbc0ec.mp4');
INSERT INTO `tbl_newspost` VALUES (29, 0, 'FSA', '0000-00-00', '2020-08-22', '<p>dsa</p>\r\n', NULL, '6db655c818e68c86ba1e389f846d2ae0.mp4');
INSERT INTO `tbl_newspost` VALUES (30, 0, 'Tes2', '0000-00-00', '2020-08-22', '<p>Tesssss</p>\r\n', NULL, '80a98814093b0b1fbc93d718c2c5f447.mp4');
INSERT INTO `tbl_newspost` VALUES (31, 0, 'Tess', '0000-00-00', '2020-08-22', '                                ', NULL, 'a31a290a12eb3af8c99063a1df3495f9.mp4');
INSERT INTO `tbl_newspost` VALUES (32, 0, 'TTes', '0000-00-00', '2020-08-22', '                                ', '9e77f0ec99a1b03bbe91d27a26068863.mp4', NULL);
INSERT INTO `tbl_newspost` VALUES (33, 0, 'TTes', '0000-00-00', '2020-08-22', '<p>sad</p>\r\n', 'd5d59b059548b5f1198fc268284d4a83.mp4', NULL);
INSERT INTO `tbl_newspost` VALUES (34, 0, 'Tesss', '0000-00-00', '2020-08-22', '<p>TESSS</p>\r\n', '7996e9d4edd8db7e59164f47b3941d3d.mp4', NULL);
INSERT INTO `tbl_newspost` VALUES (35, 0, 'TEssssa', '0000-00-00', '2020-08-22', '<p>dsadas</p>\r\n', 'faadc5a2021d023be67745153e2f6eb9.mp4', NULL);
INSERT INTO `tbl_newspost` VALUES (36, 0, 'TEssssa', '0000-00-00', '2020-08-22', '<p>dsadas</p>\r\n', NULL, '52bed8c181589f85093af78bad383438.jpg');
INSERT INTO `tbl_newspost` VALUES (37, 0, 'dsa', '0000-00-00', '2020-08-22', '                                ', NULL, 'ed0aa887fa7f3fd4fa030fc77f0bede5.jpg');
INSERT INTO `tbl_newspost` VALUES (38, 0, 'Tessas', '0000-00-00', '2020-08-22', '                                ', NULL, 'c7ddc4dbcadc03f23b5b94576a2ecd8a.jpg');
INSERT INTO `tbl_newspost` VALUES (39, 0, 'rew', '0000-00-00', '2020-08-22', '                                ', NULL, 'c27273386ec7898f762c4151b83483fb.jpg');
INSERT INTO `tbl_newspost` VALUES (40, 0, 'sda', '0000-00-00', '2020-08-22', '                                ', NULL, 'b1eaa1f931c8f9dfe8acc78f29be5120.jpg');
INSERT INTO `tbl_newspost` VALUES (41, 0, 'dsa', '0000-00-00', '2020-08-22', '                                ', '0886a4f552b4bc43da2e62a31e24a3d2.mp4', NULL);
INSERT INTO `tbl_newspost` VALUES (42, 0, 'Tesss12', '0000-00-00', '2020-08-23', '                                ', NULL, '4bf50ed183737e3b09895b8ce08d85b9.jpg');
INSERT INTO `tbl_newspost` VALUES (43, 0, 'Coba Berita', '0000-00-00', '2020-08-23', '                                ', NULL, '6222dce0bb5841067faa400fae344827.jpg');

-- ----------------------------
-- Table structure for tbl_profile_copy1
-- ----------------------------
DROP TABLE IF EXISTS `tbl_profile_copy1`;
CREATE TABLE `tbl_profile_copy1`  (
  `profile_kd` int(11) NOT NULL AUTO_INCREMENT,
  `jns_user_kd` int(11) NULL DEFAULT NULL,
  `profile_nomor_id` int(11) NULL DEFAULT NULL,
  `profile_nm_1` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_nm_2` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_nm_3` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `agama_kd` date NULL DEFAULT NULL,
  `profile_tempat_lahir` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_tgl_lahir` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_jns_kelamin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `propinsi_kd` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dati2_kd` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kecamatan_kd` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_alamat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_kelurahan` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_kd_pos` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_telp` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_email` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_foto` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_ket_jabatan` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_status` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`profile_kd`) USING BTREE,
  INDEX `USER_ID`(`jns_user_kd`) USING BTREE,
  INDEX `SCH_ID`(`profile_nomor_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_profile_copy1
-- ----------------------------
INSERT INTO `tbl_profile_copy1` VALUES (1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin.PNG', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_profile_copy1` VALUES (2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin1.PNG', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_profile_copy1` VALUES (3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin2.PNG', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_profile_copy1` VALUES (4, 1, NULL, '8888', 'Difa', 'Bekasi', '0000-00-00', 'l', 'i', 'Bekasi', 'Bekasi', NULL, '92929', 'bekasi@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_profile_copy1` VALUES (5, 4, NULL, '0292929', 'Difa Ardiansyah', 'Bekasi', '0000-00-00', 'l', 'i', 'Bekasi', 'Kab.Bekasi', NULL, '08992292', 'difa@gmail.com', 'remaja.jpg', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_profile_copy1` VALUES (6, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin.PNG', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_profile_copy1` VALUES (7, 6, 0, '22', '', '', '0000-00-00', 'l', 'i', '', '', NULL, '', '', 'remaja.jpg', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_profile_copy1` VALUES (8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_profile_copy1` VALUES (9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_profile_copy1` VALUES (11, 9, NULL, '022929', 'Guru Inggris', 'Bogor', '0000-00-00', 'l', 'i', 'Bekasi', 'Bandungg', NULL, '0829922', 'inggris@gmail.com', '1390510_599157100154245_362733406_n.jpg', NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tbl_promes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_promes`;
CREATE TABLE `tbl_promes`  (
  `PROMES_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CLASS_ID` int(11) NOT NULL,
  `PROMES_SEMESTER` int(11) NOT NULL,
  `PROMES_YEAR` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PROMES_STRATEGY` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`PROMES_ID`) USING BTREE,
  INDEX `CLASS_ID`(`CLASS_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 31 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_promes
-- ----------------------------
INSERT INTO `tbl_promes` VALUES (4, 0, 0, '1996/199', '');
INSERT INTO `tbl_promes` VALUES (8, 0, 0, '1990/199', '');
INSERT INTO `tbl_promes` VALUES (9, 0, 0, '1990/199', '');
INSERT INTO `tbl_promes` VALUES (10, 0, 3, '1990/199', 'Kelompok E');
INSERT INTO `tbl_promes` VALUES (11, 0, 0, '1990/199', '');
INSERT INTO `tbl_promes` VALUES (12, 0, 0, '1990/199', '');
INSERT INTO `tbl_promes` VALUES (18, 1, 5, '1990/199', 'Tes65');

-- ----------------------------
-- Table structure for tbl_promes_competency
-- ----------------------------
DROP TABLE IF EXISTS `tbl_promes_competency`;
CREATE TABLE `tbl_promes_competency`  (
  `COMPETENCY_ID` int(11) NOT NULL AUTO_INCREMENT,
  `GOAL_ID` int(11) NOT NULL,
  `COMPETENCY_CODE` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `COMPETENCY_DESC` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`COMPETENCY_ID`) USING BTREE,
  INDEX `GOAL_ID`(`GOAL_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_promes_competency
-- ----------------------------
INSERT INTO `tbl_promes_competency` VALUES (1, 1, '1.1', 'Mempercayai Adanya Tuhan');
INSERT INTO `tbl_promes_competency` VALUES (2, 1, '3.1.4', 'Mengenal Kegiatan Beribadah Wudhu');
INSERT INTO `tbl_promes_competency` VALUES (3, 1, '4.1', 'Melakukan Kegiatan Beribadah');
INSERT INTO `tbl_promes_competency` VALUES (8, 1, '5.2', 'Tes2');
INSERT INTO `tbl_promes_competency` VALUES (7, 1, '5.1', 'Tes');
INSERT INTO `tbl_promes_competency` VALUES (6, 1, '3.3', 'Tes3');

-- ----------------------------
-- Table structure for tbl_promes_goal
-- ----------------------------
DROP TABLE IF EXISTS `tbl_promes_goal`;
CREATE TABLE `tbl_promes_goal`  (
  `GOAL_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SUBTHEME_ID` int(11) NOT NULL,
  `GOAL_DESC` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`GOAL_ID`) USING BTREE,
  INDEX `SUBTHEME_ID`(`SUBTHEME_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_promes_goal
-- ----------------------------
INSERT INTO `tbl_promes_goal` VALUES (1, 1, 'Nilai Agama Dan Moral');
INSERT INTO `tbl_promes_goal` VALUES (2, 1, 'Fisik Motorik');
INSERT INTO `tbl_promes_goal` VALUES (3, 1, 'Fisik Motorr');
INSERT INTO `tbl_promes_goal` VALUES (4, 1, 'Fisik Mobil');
INSERT INTO `tbl_promes_goal` VALUES (5, 1, 'Fisik Motor');
INSERT INTO `tbl_promes_goal` VALUES (6, 1, 'Fisik Mobil');
INSERT INTO `tbl_promes_goal` VALUES (7, 1, 'Tes');
INSERT INTO `tbl_promes_goal` VALUES (8, 1, 'Tes');
INSERT INTO `tbl_promes_goal` VALUES (9, 1, 'Tes2');
INSERT INTO `tbl_promes_goal` VALUES (10, 1, 'Tes2');
INSERT INTO `tbl_promes_goal` VALUES (11, 1, 'Tes33');
INSERT INTO `tbl_promes_goal` VALUES (12, 1, 'Tes34');
INSERT INTO `tbl_promes_goal` VALUES (13, 1, 'Tes45');

-- ----------------------------
-- Table structure for tbl_promes_subtheme
-- ----------------------------
DROP TABLE IF EXISTS `tbl_promes_subtheme`;
CREATE TABLE `tbl_promes_subtheme`  (
  `SUBTHEME_ID` int(11) NOT NULL AUTO_INCREMENT,
  `THEME_ID` int(11) NOT NULL,
  `SUBTHEME_NAME` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`SUBTHEME_ID`) USING BTREE,
  INDEX `THEME_ID`(`THEME_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_promes_subtheme
-- ----------------------------
INSERT INTO `tbl_promes_subtheme` VALUES (1, 1, 'LEBARANN');
INSERT INTO `tbl_promes_subtheme` VALUES (2, 1, 'Kesukaanku');
INSERT INTO `tbl_promes_subtheme` VALUES (3, 1, 'Diriku');
INSERT INTO `tbl_promes_subtheme` VALUES (4, 2, 'Identitass');
INSERT INTO `tbl_promes_subtheme` VALUES (15, 2, 'Tes2');
INSERT INTO `tbl_promes_subtheme` VALUES (6, 2, 'Kesukaanku');
INSERT INTO `tbl_promes_subtheme` VALUES (7, 2, 'Tess');
INSERT INTO `tbl_promes_subtheme` VALUES (16, 2, 'Tes1');
INSERT INTO `tbl_promes_subtheme` VALUES (9, 2, 'Tess3');
INSERT INTO `tbl_promes_subtheme` VALUES (10, 2, 'Idul');
INSERT INTO `tbl_promes_subtheme` VALUES (11, 2, 'Adha');
INSERT INTO `tbl_promes_subtheme` VALUES (12, 2, 'Idul');
INSERT INTO `tbl_promes_subtheme` VALUES (13, 2, 'Adha');
INSERT INTO `tbl_promes_subtheme` VALUES (14, 2, 'Tes1');
INSERT INTO `tbl_promes_subtheme` VALUES (17, 2, 'Tes2');

-- ----------------------------
-- Table structure for tbl_promes_theme
-- ----------------------------
DROP TABLE IF EXISTS `tbl_promes_theme`;
CREATE TABLE `tbl_promes_theme`  (
  `THEME_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PROMES_ID` int(11) NOT NULL,
  `THEME_THEME` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `THEME_MONTHLY_EVALUATION` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `THEME_TIME_ALLOCATION` int(11) NOT NULL,
  `THEME_TIME_TYPE` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`THEME_ID`) USING BTREE,
  INDEX `PROMES_ID`(`PROMES_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 44 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_promes_theme
-- ----------------------------
INSERT INTO `tbl_promes_theme` VALUES (8, 1, 'Idul Adha', 'Penugasan Observasi Unjuk Kerja Hasil Karya Percakapan Catatan Anekdot Potofolio', 2, '');
INSERT INTO `tbl_promes_theme` VALUES (7, 1, 'Lebaran', 'Penugasan Observasi Unjuk Kerja Hasil Karya Percakapan Catatan Anekdot Potofolio', 1, '');
INSERT INTO `tbl_promes_theme` VALUES (2, 12, 'Tes Tema 2', '2', 2, '3');
INSERT INTO `tbl_promes_theme` VALUES (1, 12, 'Tes Tema', '1', 1, '1');
INSERT INTO `tbl_promes_theme` VALUES (9, 1, 'Liburan', 'Penugasan Observasi Unjuk Kerja Hasil Karya Percakapan Catatan Anekdot Potofolio', 3, '');
INSERT INTO `tbl_promes_theme` VALUES (10, 18, 'Liburan', 'Evaluasi', 1, '');
INSERT INTO `tbl_promes_theme` VALUES (11, 18, 'Idul Adha', 'Evaluasi 4', 2, '');
INSERT INTO `tbl_promes_theme` VALUES (22, 18, 'Liburan', 'Penugasan Observasi Unjuk Kerja Hasil Karya Percakapan Catatan Anekdot Potofolio', 1, '');
INSERT INTO `tbl_promes_theme` VALUES (23, 18, 'Liburan', 'Penugasan Observasi Unjuk Kerja Hasil Karya Percakapan Catatan Anekdot Potofolio', 1, '');
INSERT INTO `tbl_promes_theme` VALUES (24, 30, 'Lebaran', 'Penugasan Observasi Unjuk Kerja Hasil Karya Percakapan Catatan Anekdot Potofolio', 1, '');
INSERT INTO `tbl_promes_theme` VALUES (25, 30, 'Lebaran', 'Penugasan Observasi Unjuk Kerja Hasil Karya Percakapan Catatan Anekdot Potofolio', 1, '');
INSERT INTO `tbl_promes_theme` VALUES (30, 18, 'Tes1', 'Penugasan Observasi Unjuk Kerja Hasil Karya Percakapan Catatan Anekdot Potofolio', 1, '');
INSERT INTO `tbl_promes_theme` VALUES (31, 18, 'Tes 2', 'PenugasanObservasiUnjukKerjaHasilKaryaPercakapanCatatanAnekdotPotofolio', 3, '');
INSERT INTO `tbl_promes_theme` VALUES (32, 18, 'Tes1', 'Penugasan Observasi Unjuk Kerja Hasil Karya Percakapan Catatan Anekdot Potofolio', 1, '');
INSERT INTO `tbl_promes_theme` VALUES (33, 18, 'Tes 2', 'PenugasanObservasiUnjukKerjaHasilKaryaPercakapanCatatanAnekdotPotofolio', 3, '');
INSERT INTO `tbl_promes_theme` VALUES (34, 18, 'Hallo2', 'Tes6', 1, '');
INSERT INTO `tbl_promes_theme` VALUES (35, 18, 'Tes 7', 'Tes 8 ', 3, '');
INSERT INTO `tbl_promes_theme` VALUES (36, 18, 'Hallo2', 'Tes6', 1, '');
INSERT INTO `tbl_promes_theme` VALUES (37, 18, 'Tes 7', 'Tes 8 ', 3, '');
INSERT INTO `tbl_promes_theme` VALUES (42, 18, 'Tesss9', 'Tesss10', 3, '');
INSERT INTO `tbl_promes_theme` VALUES (43, 18, 'Tesss11', 'Tesss12', 4, '');

-- ----------------------------
-- Table structure for tbl_religion
-- ----------------------------
DROP TABLE IF EXISTS `tbl_religion`;
CREATE TABLE `tbl_religion`  (
  `REL_ID` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `REL_NAME` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`REL_ID`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_religion
-- ----------------------------
INSERT INTO `tbl_religion` VALUES ('1', 'Islam');
INSERT INTO `tbl_religion` VALUES ('2', 'Kristen');
INSERT INTO `tbl_religion` VALUES ('', 'Hindu');

-- ----------------------------
-- Table structure for tbl_rpph
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rpph`;
CREATE TABLE `tbl_rpph`  (
  `RPPH_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CLASS_ID` int(11) NOT NULL,
  `RPPH_STUDYYEAR` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RPPH_SEMESTER` int(11) NOT NULL,
  `RPPH_MONTH` int(11) NOT NULL,
  `RPPH_WEEK` smallint(6) NOT NULL,
  `RPPH_DAY` smallint(6) NOT NULL,
  `RPPH_DATE` date NOT NULL,
  `RPPH_THEME` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RPPH_SUBTHEME` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `RPPH_STRATEGY` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`RPPH_ID`) USING BTREE,
  INDEX `CLASS_ID`(`CLASS_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_rpph
-- ----------------------------
INSERT INTO `tbl_rpph` VALUES (3, 1, '2019/202', 2, 1, 1, 0, '0000-00-00', 'Aja', 'Suka', 'Tes');
INSERT INTO `tbl_rpph` VALUES (2, 1, '2019/202', 1, 1, 1, 0, '0000-00-00', 'Lebaran', 'Idul Adha', 'Kelompok dengan Kegiatan Pengamanan');

-- ----------------------------
-- Table structure for tbl_rpphactdetail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rpphactdetail`;
CREATE TABLE `tbl_rpphactdetail`  (
  `RPPHACTIVITY_ID` int(11) NOT NULL,
  `RPPHACTDETAIL_INDEX` int(11) NOT NULL,
  `RPPHACTDETAIL_DESC` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`RPPHACTIVITY_ID`, `RPPHACTDETAIL_INDEX`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_rpphactdetail
-- ----------------------------
INSERT INTO `tbl_rpphactdetail` VALUES (1, 1, 'Berenangf');
INSERT INTO `tbl_rpphactdetail` VALUES (3, 2, 'Mengaji');
INSERT INTO `tbl_rpphactdetail` VALUES (3, 1, 'Berenangf');
INSERT INTO `tbl_rpphactdetail` VALUES (2, 2, 'Solatt');
INSERT INTO `tbl_rpphactdetail` VALUES (1, 2, 'Solatt');
INSERT INTO `tbl_rpphactdetail` VALUES (5, 3, 'sa');
INSERT INTO `tbl_rpphactdetail` VALUES (5, 2, 'sad');
INSERT INTO `tbl_rpphactdetail` VALUES (18, 3, 'Belajar');
INSERT INTO `tbl_rpphactdetail` VALUES (4, 4, 'Solat5');
INSERT INTO `tbl_rpphactdetail` VALUES (4, 3, 'Mengaji34');
INSERT INTO `tbl_rpphactdetail` VALUES (4, 2, 'Tes2');
INSERT INTO `tbl_rpphactdetail` VALUES (5, 1, 'Berenangf');
INSERT INTO `tbl_rpphactdetail` VALUES (14, 4, 'Berenanggg');
INSERT INTO `tbl_rpphactdetail` VALUES (14, 3, 'Memanah');

-- ----------------------------
-- Table structure for tbl_rpphactivity
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rpphactivity`;
CREATE TABLE `tbl_rpphactivity`  (
  `RPPHACTIVITY_ID` int(11) NOT NULL AUTO_INCREMENT,
  `RPPH_ID` int(11) NOT NULL,
  `RPPHACTIVITY_NAME` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `RPPHACTIVITY_TIME` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`RPPHACTIVITY_ID`) USING BTREE,
  INDEX `RPPH_ID`(`RPPH_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 19 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_rpphactivity
-- ----------------------------
INSERT INTO `tbl_rpphactivity` VALUES (1, 1, 'Pembukaan', '07300800');
INSERT INTO `tbl_rpphactivity` VALUES (2, 3, 'Mengaji', '12000130');
INSERT INTO `tbl_rpphactivity` VALUES (3, 3, 'Hapalan', '12000100');
INSERT INTO `tbl_rpphactivity` VALUES (4, 3, 'Hapalan', '12000100');
INSERT INTO `tbl_rpphactivity` VALUES (5, 3, 'Kesenianb', '12:30');
INSERT INTO `tbl_rpphactivity` VALUES (18, 3, 'Solatt', '20192119');

-- ----------------------------
-- Table structure for tbl_rpphlearning
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rpphlearning`;
CREATE TABLE `tbl_rpphlearning`  (
  `RPPHLEARNING_ID` int(11) NOT NULL AUTO_INCREMENT,
  `RPPH_ID` int(11) NOT NULL,
  `RPPHLEARNING_CODE` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RPPHLEARNING_THEORY` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RPPHLEARNING_GOAL` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`RPPHLEARNING_ID`) USING BTREE,
  INDEX `RPPH_ID`(`RPPH_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_rpphlearning
-- ----------------------------
INSERT INTO `tbl_rpphlearning` VALUES (1, 1, '1.1', 'Anak mengenal cara menjaga kebersihann', 'Anak Terbiasa Mempercayai Adanya Tuhan Melalui Penciptanya');
INSERT INTO `tbl_rpphlearning` VALUES (2, 1, '3.1', 'Anak mengenal cara menjaga kebersihan', 'Anak dapat mengenal hari besar');
INSERT INTO `tbl_rpphlearning` VALUES (3, 3, '1.1', 'Tes234', 'Tes2');

-- ----------------------------
-- Table structure for tbl_rpphmaterial
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rpphmaterial`;
CREATE TABLE `tbl_rpphmaterial`  (
  `RPPHMATERIAL_ID` int(11) NOT NULL AUTO_INCREMENT,
  `RPPH_ID` int(11) NOT NULL,
  `RPPHMATERIAL_ACTIVITY` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RPPHMATERIAL_TOOLS` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`RPPHMATERIAL_ID`) USING BTREE,
  INDEX `RPPH_ID`(`RPPH_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_rpphmaterial
-- ----------------------------
INSERT INTO `tbl_rpphmaterial` VALUES (1, 1, 'Menjiplak Tulisan Huruf Hijaiyah', 'Huruf Hijaiyah');
INSERT INTO `tbl_rpphmaterial` VALUES (2, 1, 'Menyusun Geometri', 'Geomentrii');
INSERT INTO `tbl_rpphmaterial` VALUES (3, 3, 'Idul Adha', 'Bukuu');
INSERT INTO `tbl_rpphmaterial` VALUES (4, 3, 'Lebara', 'Bahan');

-- ----------------------------
-- Table structure for tbl_rpphvalindicatordetail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rpphvalindicatordetail`;
CREATE TABLE `tbl_rpphvalindicatordetail`  (
  `RPPH_ID` int(11) NOT NULL,
  `RPPHVALINDICATOR_INDEX` int(11) NOT NULL,
  `RPPHVALINDDET_CODE` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RPPHVALINDDET_TECHNIQUE` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RPPHVALINDDET_INDICATOR` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`RPPH_ID`, `RPPHVALINDICATOR_INDEX`, `RPPHVALINDDET_CODE`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_rpphvalindicatordetail
-- ----------------------------
INSERT INTO `tbl_rpphvalindicatordetail` VALUES (1, 321, '3123', 'Hapalan', 'Surat');
INSERT INTO `tbl_rpphvalindicatordetail` VALUES (1, 321, '4323', 'Surat', 'Hapalan');
INSERT INTO `tbl_rpphvalindicatordetail` VALUES (3, 22, '1.2', 'Res', 'Res2');
INSERT INTO `tbl_rpphvalindicatordetail` VALUES (3, 8, '1.2', 'rea', 'sd');
INSERT INTO `tbl_rpphvalindicatordetail` VALUES (3, 1, '1.1', 'Mengaji', 'Belajar');
INSERT INTO `tbl_rpphvalindicatordetail` VALUES (1, 3214, '24', 'Solat', 'Mengaji');
INSERT INTO `tbl_rpphvalindicatordetail` VALUES (1, 3215, '54', 'Hapalan', 'Solat');
INSERT INTO `tbl_rpphvalindicatordetail` VALUES (1, 3216, '3123', 'Mengajar', 'Solat');
INSERT INTO `tbl_rpphvalindicatordetail` VALUES (1, 3214, '432', 'Mengajar', 'Solat');
INSERT INTO `tbl_rpphvalindicatordetail` VALUES (3, 8, '2.1', 'Tes 3', 'Tes 4');

-- ----------------------------
-- Table structure for tbl_rpphvaluationindicator
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rpphvaluationindicator`;
CREATE TABLE `tbl_rpphvaluationindicator`  (
  `RPPH_ID` int(11) NOT NULL,
  `RPPHVALINDICATOR_INDEX` int(11) NOT NULL,
  `RPPHVALINDICATOR_DESC` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`RPPH_ID`, `RPPHVALINDICATOR_INDEX`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_rpphvaluationindicator
-- ----------------------------
INSERT INTO `tbl_rpphvaluationindicator` VALUES (1, 1, 'Mengajar');
INSERT INTO `tbl_rpphvaluationindicator` VALUES (1, 1231, 'Kaligrafi');
INSERT INTO `tbl_rpphvaluationindicator` VALUES (1, 3213, 'Mengajar');
INSERT INTO `tbl_rpphvaluationindicator` VALUES (1, 212, 'Solat');
INSERT INTO `tbl_rpphvaluationindicator` VALUES (1, 321, 'Mengajar');
INSERT INTO `tbl_rpphvaluationindicator` VALUES (1, 2, 'Nilai Agama & Moral');
INSERT INTO `tbl_rpphvaluationindicator` VALUES (1, 3214, 'Mengajarrr');
INSERT INTO `tbl_rpphvaluationindicator` VALUES (3, 1, 'Tes');
INSERT INTO `tbl_rpphvaluationindicator` VALUES (3, 2, 'Tes2');
INSERT INTO `tbl_rpphvaluationindicator` VALUES (3, 3, 'Tes2');
INSERT INTO `tbl_rpphvaluationindicator` VALUES (3, 4, 'Tes2');
INSERT INTO `tbl_rpphvaluationindicator` VALUES (3, 5, 'Tes2');
INSERT INTO `tbl_rpphvaluationindicator` VALUES (3, 6, 'Mengaji');
INSERT INTO `tbl_rpphvaluationindicator` VALUES (3, 7, 'Solat');
INSERT INTO `tbl_rpphvaluationindicator` VALUES (3, 8, 'Tes4');
INSERT INTO `tbl_rpphvaluationindicator` VALUES (3, 9, 'Tes4');

-- ----------------------------
-- Table structure for tbl_rpphvaluationtechnique
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rpphvaluationtechnique`;
CREATE TABLE `tbl_rpphvaluationtechnique`  (
  `RPPHVALTECH_ID` int(11) NOT NULL AUTO_INCREMENT,
  `RPPH_ID` int(11) NOT NULL,
  `RPPHVALTECH_DESC` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`RPPHVALTECH_ID`) USING BTREE,
  INDEX `RPPH_ID`(`RPPH_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_rpphvaluationtechnique
-- ----------------------------
INSERT INTO `tbl_rpphvaluationtechnique` VALUES (1, 1, 'Observasii');
INSERT INTO `tbl_rpphvaluationtechnique` VALUES (2, 1, 'Analisa');
INSERT INTO `tbl_rpphvaluationtechnique` VALUES (3, 3, 'Tes');
INSERT INTO `tbl_rpphvaluationtechnique` VALUES (4, 3, 'Tes2');
INSERT INTO `tbl_rpphvaluationtechnique` VALUES (5, 3, 'Tes45');

-- ----------------------------
-- Table structure for tbl_rppm
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rppm`;
CREATE TABLE `tbl_rppm`  (
  `RPPM_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CLASS_ID` int(11) NOT NULL,
  `RPPM_STUDYYEAR` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RPPM_SEMESTER` int(11) NOT NULL,
  `RPPM_MONTH` int(11) NOT NULL,
  `RPPM_WEEK` int(11) NOT NULL,
  `RPPM_THEME` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RPPM_SUBTHEME` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `RPPM_STUDYMODEL` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`RPPM_ID`) USING BTREE,
  INDEX `CLASS_ID`(`CLASS_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_rppm
-- ----------------------------
INSERT INTO `tbl_rppm` VALUES (8, 1, '2019/202', 4, 1, 1, 'Idul Adha', 'Lebaran', 'Mengaji');
INSERT INTO `tbl_rppm` VALUES (3, 1, '2019/202', 2, 1, 1, 'Idul Adha', 'Lebaran', 'Mengaji');
INSERT INTO `tbl_rppm` VALUES (4, 1, '2020/202', 3, 1, 1, 'Muharram', 'Libur', 'Mengaji2');
INSERT INTO `tbl_rppm` VALUES (5, 1, '2020/202', 2, 1, 1, 'Mengaji', 'Solat', 'Hapalan');
INSERT INTO `tbl_rppm` VALUES (6, 1, '2020/202', 3, 1, 1, 'Liburan', 'Mengaji', 'Idul Adha');
INSERT INTO `tbl_rppm` VALUES (7, 1, '1990/199', 3, 1, 1, 'sda', 'dsad', 'dsad');

-- ----------------------------
-- Table structure for tbl_rppmactivity
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rppmactivity`;
CREATE TABLE `tbl_rppmactivity`  (
  `RPPMACTIVITY_ID` int(11) NOT NULL AUTO_INCREMENT,
  `RPPM_ID` int(11) NOT NULL,
  `RPPMACTIVITY_DAYINDEX` int(11) NOT NULL,
  `RPPMACTIVITY_DESC` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`RPPMACTIVITY_ID`) USING BTREE,
  INDEX `RPPM_ID`(`RPPM_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_rppmactivity
-- ----------------------------
INSERT INTO `tbl_rppmactivity` VALUES (4, 1, 4, '1. Mengurutkan gambar sapi dari kecil kebesar dan memberi angka\r\n2. Mengurutkangambarsapidarikecilkebesardanmemberiangka');
INSERT INTO `tbl_rppmactivity` VALUES (5, 1, 5, '<h1>Apollo 11</h1>\r\n\r\n<p><img alt=\"Saturn V carrying Apollo 11\" class=\"float-right\" src=\"http://c.cksource.com/a/1/img/sample.jpg\" style=\"margin-left: 20px;\" /></p>\r\n\r\n<p><strong>Apollo 11</strong> was the spaceflight that landed the first humans, Americans <a href=\"#\">Neil Armstrong</a> and <a href=\"#\">Buzz Aldrin</a>, on the Moon on July 20, 1969, at 20:18 UTC. Armstrong became the first to step onto the lunar surface 6 hours later on July 21 at 02:56 UTC.</p>\r\n\r\n<p class=\"mb-3\">Armstrong spent about <s>t');
INSERT INTO `tbl_rppmactivity` VALUES (2, 1, 2, '<p>- Belajar Mengaji</p>\r\n\r\n<p>- Belajar Solat</p>\r\n');
INSERT INTO `tbl_rppmactivity` VALUES (3, 1, 3, '<p>Mengaji</p>\r\n');
INSERT INTO `tbl_rppmactivity` VALUES (6, 2, 1, '<p>- Menjiplak Tulisan Huruf Hijaiyahh</p>\r\n\r\n<p>- Menyusun Geometri</p>\r\n');
INSERT INTO `tbl_rppmactivity` VALUES (7, 2, 2, '<p>Mengurutkan Gambar Sapi</p>\r\n');
INSERT INTO `tbl_rppmactivity` VALUES (8, 8, 1, '<p>- Belajar Mengaji</p>\r\n');

-- ----------------------------
-- Table structure for tbl_rppmlearning
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rppmlearning`;
CREATE TABLE `tbl_rppmlearning`  (
  `RPPMLEARNING_ID` int(11) NOT NULL AUTO_INCREMENT,
  `RPPM_ID` int(11) NOT NULL,
  `RPPMLEARNING_CODE` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RPPMLEARNING_THEORY` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RPPMLEARNING_GOAL` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`RPPMLEARNING_ID`) USING BTREE,
  INDEX `RPPM_ID`(`RPPM_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_rppmlearning
-- ----------------------------
INSERT INTO `tbl_rppmlearning` VALUES (1, 1, '1.1', 'Mengenal sifat Tuhan sebagai pencipta (NAM)', 'Anak Terbiasa Mempercayai Adanya Tuhan Melalui Penciptanya');
INSERT INTO `tbl_rppmlearning` VALUES (2, 1, '3.1', 'Terbiasa Berdoa', 'Anak dapat mengenal hari besar');
INSERT INTO `tbl_rppmlearning` VALUES (3, 8, '1.1', 'Mengaji', 'Menghapal');
INSERT INTO `tbl_rppmlearning` VALUES (4, 8, '1.2', 'Seni', 'Kaligrafi');

-- ----------------------------
-- Table structure for tbl_school_copy1
-- ----------------------------
DROP TABLE IF EXISTS `tbl_school_copy1`;
CREATE TABLE `tbl_school_copy1`  (
  `SCH_ID` int(11) NOT NULL AUTO_INCREMENT,
  `GRADE_ID` int(11) NOT NULL,
  `SCH_NPSN` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SCH_NAME` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SCH_STATUS` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SCH_ADDRESS` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SCH_VILLAGE` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SCH_DISTRICT` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SCH_CITY` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SCH_PROVINCE` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SCH_INSTITUTION` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SCH_PHONE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SCH_FAX` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SCH_EMAIL` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SCH_FACEBOOK` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SCH_INSTAGRAM` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SCH_TWITTER` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SCH_LOGO` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SCH_HEADER1` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SCH_HEADER2` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SCH_HEADER3` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`SCH_ID`) USING BTREE,
  INDEX `FK_REFERENCE_5`(`GRADE_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_school_copy1
-- ----------------------------
INSERT INTO `tbl_school_copy1` VALUES (1, 2, '00202', 'SDN 4 Cipanas', '1', 'Jl. Taman Jaya', 'Pacet', 'Gadog', 'Cipanas', 'Jawa Barat', 'Negeri', '083929322', '2222', 'sdn@gmail.com', 'SDN4 Cipanas', 'SDN 4 Cipanas', 'SDN 4 Cipanas', NULL, NULL, NULL, NULL);
INSERT INTO `tbl_school_copy1` VALUES (2, 2, '43324', 'SMPN 1 Cipanas', '0', 'JL.Cipanas', 'Cianjur', 'Cianjur', 'Cianjur', 'Jawa Barat', 'Negeri', '082929222', '2322', 'smpn1@gmail.com', 'SMPN 1 Cipanas', 'SMPN 1 Cipanas', 'SMPN 1 Cipanas', 'logo.png', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tbl_schoolclass
-- ----------------------------
DROP TABLE IF EXISTS `tbl_schoolclass`;
CREATE TABLE `tbl_schoolclass`  (
  `CLASS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SCH_ID` int(11) NOT NULL,
  `CLASS_LEVEL` int(11) NOT NULL,
  `CLASS_NAME` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`CLASS_ID`) USING BTREE,
  INDEX `SCH_ID`(`SCH_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_schoolclass
-- ----------------------------
INSERT INTO `tbl_schoolclass` VALUES (1, 1, 2, 'SD');
INSERT INTO `tbl_schoolclass` VALUES (2, 1, 1, 'SD');
INSERT INTO `tbl_schoolclass` VALUES (3, 2, 0, '2');
INSERT INTO `tbl_schoolclass` VALUES (4, 2, 0, '3');
INSERT INTO `tbl_schoolclass` VALUES (5, 1, 3, 'SD');
INSERT INTO `tbl_schoolclass` VALUES (6, 1, 2, 'B');
INSERT INTO `tbl_schoolclass` VALUES (7, 1, 2, 'B');
INSERT INTO `tbl_schoolclass` VALUES (8, 1, 2, 'B');
INSERT INTO `tbl_schoolclass` VALUES (9, 1, 0, '2');

-- ----------------------------
-- Table structure for tbl_schoolgrade
-- ----------------------------
DROP TABLE IF EXISTS `tbl_schoolgrade`;
CREATE TABLE `tbl_schoolgrade`  (
  `GRADE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `GRADE_NAME` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`GRADE_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_schoolgrade
-- ----------------------------
INSERT INTO `tbl_schoolgrade` VALUES (1, 'SD');
INSERT INTO `tbl_schoolgrade` VALUES (2, 'SMP');
INSERT INTO `tbl_schoolgrade` VALUES (3, 'SMA');
INSERT INTO `tbl_schoolgrade` VALUES (4, 'SMK');

-- ----------------------------
-- Table structure for tbl_stppatk
-- ----------------------------
DROP TABLE IF EXISTS `tbl_stppatk`;
CREATE TABLE `tbl_stppatk`  (
  `STPPATK_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SCH_ID` int(11) NULL DEFAULT NULL,
  `STPPATK_YEAR` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `STPPATK_STUDYYEAR` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `STPPATK_NUMBER` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `STPPATK_APPOINTEDPLACE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `STPPATK_APPOINTEDDATE` date NULL DEFAULT NULL,
  `STPPATK_HEADMASTER` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `STPPATK_INSTITUTIONHEAD` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`STPPATK_ID`) USING BTREE,
  INDEX `SCH_ID`(`SCH_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_stppatk
-- ----------------------------
INSERT INTO `tbl_stppatk` VALUES (1, 202, '2020', '2020', '12', 'Bekasi', '2020-07-01', 'Difa', 'Difa');
INSERT INTO `tbl_stppatk` VALUES (2, 2, '2020', '2020', '2', 'Bekasi', '2020-07-29', 'Difa', 'Difa');
INSERT INTO `tbl_stppatk` VALUES (3, 2, '2015', '2020', '90', 'Jakarta', '2020-07-23', 'Bram', 'Bram');

-- ----------------------------
-- Table structure for tbl_student
-- ----------------------------
DROP TABLE IF EXISTS `tbl_student`;
CREATE TABLE `tbl_student`  (
  `STD_ID` int(11) NOT NULL AUTO_INCREMENT,
  `STD_NISN` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `STD_FIRSTNAME` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STD_LASTNAME` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `STD_BIRTHPLACE` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STD_BIRTHDATE` date NOT NULL,
  `STD_GENDER` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `REL_ID` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STD_ADDRESS` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STD_VILLAGE` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STD_DISTRICT` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STD_CITY` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STD_PROVINCE` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STD_PHONE` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `STD_EMAIL` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`STD_ID`) USING BTREE,
  INDEX `REL_ID`(`REL_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_student
-- ----------------------------
INSERT INTO `tbl_student` VALUES (1, '02828', 'Difa', 'Ardiansyah', 'Bekasi', '2020-07-14', 'L', '1', 'Jati Mulya', 'Bekasi', 'Bekasi Timur', 'Bekasi Timur', 'Jawa Barat', '0829191', 'difaart69@gmail.com');
INSERT INTO `tbl_student` VALUES (2, '321312', 'Difa', 'Ardiansyah', 'Bekasi', '2020-08-11', 'L', '1', 'ds', 'sds', 'dsd', 'dsd', 'ds', '0839292', 'difa@gmail.com');

-- ----------------------------
-- Table structure for tbl_user_copy1
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_copy1`;
CREATE TABLE `tbl_user_copy1`  (
  `USER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `UG_ID` int(11) NOT NULL,
  `USER_NAME` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `USER_PASSWORD` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`USER_ID`) USING BTREE,
  INDEX `UG_ID`(`UG_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_user_copy1
-- ----------------------------
INSERT INTO `tbl_user_copy1` VALUES (1, 1, 'Difa', '123456789');
INSERT INTO `tbl_user_copy1` VALUES (2, 2, 'Tono', '123456789');
INSERT INTO `tbl_user_copy1` VALUES (3, 2, 'Tono Hartono', '123456789');
INSERT INTO `tbl_user_copy1` VALUES (4, 2, 'Difa Ardiansyah', '123456789');
INSERT INTO `tbl_user_copy1` VALUES (5, 1, 'Bram', '123456789');
INSERT INTO `tbl_user_copy1` VALUES (6, 3, 'Admin', '$2y$10$sJduEhYrHi.KZEXi11Q5v.HjGUiwya3W5lp.TFl.MnXtvLTnzyPqW');
INSERT INTO `tbl_user_copy1` VALUES (7, 1, 'Guru2', '$2y$10$/zRUABdwYHtk0SkYauWJAePNeozM1hE/KN/Dw3LKnv0FN/rgvQXoq');
INSERT INTO `tbl_user_copy1` VALUES (8, 1, 'Guru3', '$2y$10$845eUiC6JDKOwlFWakGvEetOYtCUvZ4p6z99k10lOZ7bJEnnICqEu');
INSERT INTO `tbl_user_copy1` VALUES (9, 1, 'Guru4', '$2y$10$6DQPk55C/DiAXHg0eQ2lce/eTad./84fOJWfhiA5DGEIwyvj4jtdK');

-- ----------------------------
-- Table structure for tbl_usergroup
-- ----------------------------
DROP TABLE IF EXISTS `tbl_usergroup`;
CREATE TABLE `tbl_usergroup`  (
  `UG_ID` int(11) NOT NULL AUTO_INCREMENT,
  `UG_NAME` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`UG_ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_usergroup
-- ----------------------------
INSERT INTO `tbl_usergroup` VALUES (1, 'Guru');
INSERT INTO `tbl_usergroup` VALUES (2, 'Kepala Sekolah');
INSERT INTO `tbl_usergroup` VALUES (3, 'Administrator');

SET FOREIGN_KEY_CHECKS = 1;
