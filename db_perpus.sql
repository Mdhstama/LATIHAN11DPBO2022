/*
 Navicat Premium Data Transfer

 Source Server         : MyKoneksi
 Source Server Type    : MySQL
 Source Server Version : 100418
 Source Host           : localhost:3306
 Source Schema         : db_perpus

 Target Server Type    : MySQL
 Target Server Version : 100418
 File Encoding         : 65001

 Date: 05/05/2022 17:19:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for author
-- ----------------------------
DROP TABLE IF EXISTS `author`;
CREATE TABLE `author`  (
  `id_author` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_author`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of author
-- ----------------------------
INSERT INTO `author` VALUES (1, 'Richard Adkins', 'Senior');
INSERT INTO `author` VALUES (2, 'Pein Akatsuki', 'Senior');
INSERT INTO `author` VALUES (4, 'Ken Northwood', 'Senior');
INSERT INTO `author` VALUES (6, 'Adit', 'Pendatang Baru');
INSERT INTO `author` VALUES (7, 'Yonezawa Honobu', 'Senior');

-- ----------------------------
-- Table structure for buku
-- ----------------------------
DROP TABLE IF EXISTS `buku`;
CREATE TABLE `buku`  (
  `id_buku` int NOT NULL AUTO_INCREMENT,
  `judul_buku` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `penerbit` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_author` int NOT NULL,
  PRIMARY KEY (`id_buku`) USING BTREE,
  INDEX `id_author`(`id_author` ASC) USING BTREE,
  CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `author` (`id_author`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of buku
-- ----------------------------
INSERT INTO `buku` VALUES (1, 'Alan Wade', 'Premium #', 'Cerita dibalik cerita', 'Best Seller', 2);
INSERT INTO `buku` VALUES (2, 'Awan', 'Akamedia', 'buku tentang cerita awan, hujan, langit', 'Best Seller', 1);
INSERT INTO `buku` VALUES (4, 'Puisi Patrick Star', 'Patrick', 'mawar itu biru, violet itu merah', 'Best Seller', 2);
INSERT INTO `buku` VALUES (9, 'Libur', 'Adit_Buku', 'pengen cepet libur', 'Best Seller', 6);
INSERT INTO `buku` VALUES (10, 'Hyouka', 'Gramedia', 'gua banget nih oreki', 'Best Seller', 7);

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member`  (
  `nim` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jurusan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`nim`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('2000360', 'Sancho', 'Matematika Teknik');
INSERT INTO `member` VALUES ('2000361', 'Ronaldo', 'Teknik Informatika');
INSERT INTO `member` VALUES ('2000362', 'Muhammad Aditya Hasta Pratama', 'Grafika Komputer');

-- ----------------------------
-- Table structure for pinjam
-- ----------------------------
DROP TABLE IF EXISTS `pinjam`;
CREATE TABLE `pinjam`  (
  `id_pinjam` int NOT NULL AUTO_INCREMENT,
  `member_pinjam` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `buku_pinjam` int NOT NULL,
  `status_kembali` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_pinjam`) USING BTREE,
  INDEX `judul_buku`(`buku_pinjam` ASC) USING BTREE,
  INDEX `nama_member`(`member_pinjam` ASC) USING BTREE,
  CONSTRAINT `judul_buku` FOREIGN KEY (`buku_pinjam`) REFERENCES `buku` (`id_buku`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `nama_member` FOREIGN KEY (`member_pinjam`) REFERENCES `member` (`nim`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pinjam
-- ----------------------------
INSERT INTO `pinjam` VALUES (1, '2000362', 4, 'Sudah');
INSERT INTO `pinjam` VALUES (3, '2000360', 2, 'Sudah');
INSERT INTO `pinjam` VALUES (6, '2000361', 1, 'Belum');
INSERT INTO `pinjam` VALUES (7, '2000362', 10, 'Belum');

SET FOREIGN_KEY_CHECKS = 1;
