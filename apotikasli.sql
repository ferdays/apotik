/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : apotikasli

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2016-02-16 14:09:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dokter
-- ----------------------------
DROP TABLE IF EXISTS `dokter`;
CREATE TABLE `dokter` (
  `id_dokter` varchar(500) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telepon` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id_dokter`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dokter
-- ----------------------------
INSERT INTO `dokter` VALUES ('DK-001', 'Nessa Ramadan', 'Padalarang', '08921231234');
INSERT INTO `dokter` VALUES ('DK-002', 'Ferdi Ferdiansyah', 'Padalarang', '022132493123');
INSERT INTO `dokter` VALUES ('DK-003', 'Agus Hermansyah', 'Cikalong Wetan Kaler', '081234123134');
INSERT INTO `dokter` VALUES ('DK-004', 'Reza Afrizal', 'Cipuluz', '089124643342');
INSERT INTO `dokter` VALUES ('DK-005', 'Kevin A. Yuliana', 'Padalarang', '08921231234');

-- ----------------------------
-- Table structure for faktur_pembelian
-- ----------------------------
DROP TABLE IF EXISTS `faktur_pembelian`;
CREATE TABLE `faktur_pembelian` (
  `id_faktur` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(255) DEFAULT NULL,
  `id_obat` varchar(100) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `harga_beli` int(50) DEFAULT NULL,
  `jumlah` int(50) DEFAULT NULL,
  `subtotal` int(100) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_faktur`),
  KEY `no_faktur` (`no_faktur`),
  KEY `id_obat` (`id_obat`)
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of faktur_pembelian
-- ----------------------------
INSERT INTO `faktur_pembelian` VALUES ('164', 'BOU-001', '66', '2016-02-14 20:02:19', '290000', '100', '29000000', '4');
INSERT INTO `faktur_pembelian` VALUES ('165', 'BOU-001', '67', '2016-02-14 20:03:30', '10000', '100', '1000000', '4');
INSERT INTO `faktur_pembelian` VALUES ('166', 'BOU-001', '68', '2016-02-14 20:04:10', '110000', '100', '11000000', '4');
INSERT INTO `faktur_pembelian` VALUES ('167', 'BOU-001', '69', '2016-02-14 20:05:24', '9500', '100', '950000', '4');
INSERT INTO `faktur_pembelian` VALUES ('168', 'BOU-001', '70', '2016-02-14 20:06:12', '45000', '100', '4500000', '4');
INSERT INTO `faktur_pembelian` VALUES ('169', 'BOU-002', '71', '2016-02-14 20:07:34', '250000', '100', '25000000', '4');
INSERT INTO `faktur_pembelian` VALUES ('170', 'BOU-002', '72', '2016-02-14 20:09:01', '290000', '100', '29000000', '4');
INSERT INTO `faktur_pembelian` VALUES ('171', 'BOU-002', '73', '2016-02-14 20:09:41', '550000', '50', '27500000', '4');
INSERT INTO `faktur_pembelian` VALUES ('172', 'BOU-002', '74', '2016-02-14 20:10:35', '45000', '100', '4500000', '4');
INSERT INTO `faktur_pembelian` VALUES ('173', 'BOU-002', '75', '2016-02-14 20:11:07', '10000', '100', '1000000', '4');
INSERT INTO `faktur_pembelian` VALUES ('174', 'BOU-003', '76', '2016-02-14 20:12:21', '600000', '20', '12000000', '4');
INSERT INTO `faktur_pembelian` VALUES ('175', 'BOU-003', '77', '2016-02-14 20:13:49', '7500000', '10', '75000000', '4');
INSERT INTO `faktur_pembelian` VALUES ('176', 'BOU-004', '78', '2016-02-14 20:16:02', '500000', '50', '25000000', '4');
INSERT INTO `faktur_pembelian` VALUES ('177', 'BOU-004', '79', '2016-02-14 20:16:56', '10000', '100', '1000000', '4');
INSERT INTO `faktur_pembelian` VALUES ('178', 'BOU-005', '80', '2016-02-14 20:18:38', '800000', '21', '16800000', '4');
INSERT INTO `faktur_pembelian` VALUES ('179', 'BOU-005', '81', '2016-02-14 20:19:32', '20000', '100', '2000000', '4');
INSERT INTO `faktur_pembelian` VALUES ('180', 'BOU-006', '82', '2016-02-14 20:27:41', '9000', '100', '900000', '4');
INSERT INTO `faktur_pembelian` VALUES ('181', 'BOU-006', '83', '2016-02-14 20:28:25', '115000', '100', '11500000', '4');
INSERT INTO `faktur_pembelian` VALUES ('182', 'BOU-007', '84', '2016-02-14 20:29:10', '500000', '21', '10500000', '4');
INSERT INTO `faktur_pembelian` VALUES ('183', 'BOU-007', '85', '2016-02-14 20:29:57', '20000', '100', '2000000', '4');
INSERT INTO `faktur_pembelian` VALUES ('184', 'BOU-008', '86', '2016-02-14 20:30:54', '15000', '100', '1500000', '4');
INSERT INTO `faktur_pembelian` VALUES ('185', 'BOU-008', '87', '2016-02-14 20:31:24', '200000', '30', '6000000', '4');
INSERT INTO `faktur_pembelian` VALUES ('186', 'BOU-009', '88', '2016-02-14 20:32:53', '130000', '21', '2730000', '4');
INSERT INTO `faktur_pembelian` VALUES ('187', 'BOU-009', '89', '2016-02-14 20:33:28', '35000', '100', '3500000', '4');
INSERT INTO `faktur_pembelian` VALUES ('188', 'BOU-010', '90', '2016-02-14 20:34:46', '210000', '21', '4410000', '4');
INSERT INTO `faktur_pembelian` VALUES ('189', 'BOU-011', '91', '2016-02-14 20:36:21', '65000', '100', '6500000', '4');
INSERT INTO `faktur_pembelian` VALUES ('190', 'BOU-012', '92', '2016-02-14 20:37:06', '150000', '21', '3150000', '4');
INSERT INTO `faktur_pembelian` VALUES ('191', 'BOU-013', '93', '2016-02-14 20:38:47', '40000', '100', '4000000', '4');
INSERT INTO `faktur_pembelian` VALUES ('192', 'BOU-014', '94', '2016-02-14 20:39:27', '450000', '21', '9450000', '4');
INSERT INTO `faktur_pembelian` VALUES ('193', 'BOU-015', '95', '2016-02-14 20:40:47', '330000', '21', '6930000', '4');
INSERT INTO `faktur_pembelian` VALUES ('194', 'BOU-016', '96', '2016-02-14 20:41:37', '9000', '100', '900000', '4');
INSERT INTO `faktur_pembelian` VALUES ('195', 'BOU-017', '97', '2016-02-14 20:42:30', '48000', '100', '4800000', '4');
INSERT INTO `faktur_pembelian` VALUES ('196', 'BOU-018', '98', '2016-02-14 20:44:18', '49000', '100', '4900000', '4');
INSERT INTO `faktur_pembelian` VALUES ('197', 'BOU-019', '99', '2016-02-14 20:45:40', '14000', '100', '1400000', '4');
INSERT INTO `faktur_pembelian` VALUES ('198', 'BOU-020', '100', '2016-02-14 20:47:48', '20000', '100', '2000000', '4');
INSERT INTO `faktur_pembelian` VALUES ('199', 'BOU-021', '101', '2016-02-14 20:48:22', '400000', '21', '8400000', '4');
INSERT INTO `faktur_pembelian` VALUES ('200', 'BOU-022', '102', '2016-02-14 20:49:48', '90000', '30', '2700000', '4');
INSERT INTO `faktur_pembelian` VALUES ('201', 'BOU-023', '103', '2016-02-14 20:50:37', '15000', '100', '1500000', '4');
INSERT INTO `faktur_pembelian` VALUES ('202', 'BOU-024', '104', '2016-02-14 20:51:20', '235000', '21', '4935000', '4');
INSERT INTO `faktur_pembelian` VALUES ('203', 'BOU-025', '105', '2016-02-14 20:53:20', '95000', '31', '2945000', '4');
INSERT INTO `faktur_pembelian` VALUES ('204', 'BOU-026', '106', '2016-02-14 20:55:29', '100000', '50', '5000000', '4');
INSERT INTO `faktur_pembelian` VALUES ('205', 'BOU-027', '77', '2016-02-15 13:30:40', '7500000', '1', '7500000', '4');
INSERT INTO `faktur_pembelian` VALUES ('206', 'BOU-028', '77', '2016-02-15 13:31:31', '7500000', '11', '82500000', '4');
INSERT INTO `faktur_pembelian` VALUES ('207', 'BOU-029', '76', '2016-02-15 13:32:30', '600000', '1', '600000', '4');
INSERT INTO `faktur_pembelian` VALUES ('208', 'BOU-030', '106', '2016-02-16 09:44:39', '100000', '10', '1000000', '4');
INSERT INTO `faktur_pembelian` VALUES ('209', 'BOU-031', '107', '2016-02-16 10:50:47', '500', '15', '7500', '4');
INSERT INTO `faktur_pembelian` VALUES ('210', 'BOU-032', '106', '2016-02-16 11:11:16', '100000', '2', '200000', '4');
INSERT INTO `faktur_pembelian` VALUES ('211', 'BOU-033', '106', '2016-02-16 11:21:53', '100000', '5', '500000', '4');
INSERT INTO `faktur_pembelian` VALUES ('212', 'BOU-034', '107', '2016-02-16 12:41:11', '500', '23', '11500', '4');

-- ----------------------------
-- Table structure for faktur_penjualan
-- ----------------------------
DROP TABLE IF EXISTS `faktur_penjualan`;
CREATE TABLE `faktur_penjualan` (
  `id_faktur_j` int(11) NOT NULL AUTO_INCREMENT,
  `id_obat` int(11) DEFAULT NULL,
  `no_faktur` varchar(255) DEFAULT NULL,
  `harga` int(50) DEFAULT NULL,
  `jumlah` int(50) DEFAULT NULL,
  `subtotal` int(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `resep` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_faktur_j`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of faktur_penjualan
-- ----------------------------
INSERT INTO `faktur_penjualan` VALUES ('45', '86', 'POU-001', '15400', '10', '154000', '2', '2016-02-14 21:30:04', null);
INSERT INTO `faktur_penjualan` VALUES ('46', '86', 'POU-002', '15400', '5', '77000', '2', '2016-02-14 21:31:54', null);
INSERT INTO `faktur_penjualan` VALUES ('47', '89', 'POU-003', '36300', '1', '36300', '2', '2016-02-14 21:32:12', null);
INSERT INTO `faktur_penjualan` VALUES ('48', '103', 'POU-004', '16336', '2', '32672', '2', '2016-02-15 13:27:44', null);
INSERT INTO `faktur_penjualan` VALUES ('49', '103', 'POU-005', '16336', '10', '163360', '2', '2016-02-16 09:43:42', null);
INSERT INTO `faktur_penjualan` VALUES ('50', '93', 'POU-006', '43923', '12', '527076', '2', '2016-02-16 13:26:53', '0');
INSERT INTO `faktur_penjualan` VALUES ('51', '105', 'POU-006', '96800', '12', '1161600', '2', '2016-02-16 13:26:53', '1');
INSERT INTO `faktur_penjualan` VALUES ('52', '102', 'POU-006', '90900', '1', '90900', '2', '2016-02-16 13:26:53', '1');
INSERT INTO `faktur_penjualan` VALUES ('53', '100', 'POU-006', '20500', '12', '246000', '2', '2016-02-16 13:26:53', '0');
INSERT INTO `faktur_penjualan` VALUES ('54', '103', 'POU-007', '16336', '5', '81680', '2', '2016-02-16 13:41:03', '0');
INSERT INTO `faktur_penjualan` VALUES ('55', '97', 'POU-007', '48400', '5', '242000', '2', '2016-02-16 13:41:03', '1');
INSERT INTO `faktur_penjualan` VALUES ('56', '103', 'POU-008', '16336', '10', '163360', '2', '2016-02-16 13:48:25', '0');
INSERT INTO `faktur_penjualan` VALUES ('57', '100', 'POU-008', '20500', '2', '41000', '2', '2016-02-16 13:48:25', '1');

-- ----------------------------
-- Table structure for faktur_penjualan_resep
-- ----------------------------
DROP TABLE IF EXISTS `faktur_penjualan_resep`;
CREATE TABLE `faktur_penjualan_resep` (
  `id_faktur_r` int(11) NOT NULL AUTO_INCREMENT,
  `id_obat` int(11) DEFAULT NULL,
  `no_resep` varchar(255) DEFAULT NULL,
  `harga` int(50) DEFAULT NULL,
  `jumlah` float DEFAULT NULL,
  `subtotal` int(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  PRIMARY KEY (`id_faktur_r`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of faktur_penjualan_resep
-- ----------------------------
INSERT INTO `faktur_penjualan_resep` VALUES ('47', '77', 'RSP-001', '8061737', '1', '8061737', '2', '2016-02-14 21:01:20');
INSERT INTO `faktur_penjualan_resep` VALUES ('48', '100', 'RSP-002', '20500', '10', '205000', '2', '2016-02-15 13:27:06');
INSERT INTO `faktur_penjualan_resep` VALUES ('49', '100', 'RSP-003', '20500', '2', '41000', '2', '2016-02-16 12:03:36');
INSERT INTO `faktur_penjualan_resep` VALUES ('50', '104', 'RSP-004', '243210', '1', '243210', '2', '2016-02-16 12:57:49');

-- ----------------------------
-- Table structure for keranjang
-- ----------------------------
DROP TABLE IF EXISTS `keranjang`;
CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL AUTO_INCREMENT,
  `id_supplier` int(11) DEFAULT NULL,
  `id_obat` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_dokter` varchar(255) DEFAULT '0',
  `satuan` varchar(255) DEFAULT NULL,
  `tanggal_beli` datetime DEFAULT NULL,
  `harga_beli` int(50) DEFAULT NULL,
  `harga_jual` int(50) DEFAULT NULL,
  `jumlah` float DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `resep` int(1) DEFAULT NULL,
  `kadaluarsa` datetime DEFAULT NULL,
  PRIMARY KEY (`id_keranjang`),
  KEY `id_supplier` (`id_supplier`),
  KEY `id_obat` (`id_obat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of keranjang
-- ----------------------------

-- ----------------------------
-- Table structure for obat
-- ----------------------------
DROP TABLE IF EXISTS `obat`;
CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL AUTO_INCREMENT,
  `nama_obat` varchar(50) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `harga_beli` int(50) DEFAULT NULL,
  `harga_jual` int(50) DEFAULT NULL,
  `stok` float DEFAULT '0',
  `resep` int(1) DEFAULT NULL,
  `kadaluarsa` datetime DEFAULT NULL,
  PRIMARY KEY (`id_obat`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of obat
-- ----------------------------
INSERT INTO `obat` VALUES ('66', 'A-B VASK', 'Tablet', '290000', '290400', '100', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('67', 'A-D PLEX ORAL DROPS', 'Botol', '10000', '10286', '100', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('68', 'ABBOTIC DRY', 'Botol', '110000', '111804', '100', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('69', 'ABDELYN ORAL DROPS', 'Botol', '9500', '9983', '100', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('70', 'ABDIFLAM', 'Tablet', '45000', '49600', '100', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('71', 'BACBUTINH FORTE', 'Tablet', '250000', '260150', '100', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('72', 'BACBUTOL', 'Tablet', '290000', '298870', '100', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('73', 'BACTESYN', 'Tablet', '550000', '580000', '50', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('74', 'BACTODERM', 'Pcs', '45000', '49600', '100', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('75', 'BACTOPRIM', 'Botol', '10000', '11114', '100', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('76', 'CADUET', 'Tablet', '600000', '615000', '21', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('77', 'CAELYX VIAL', 'Botol', '7500000', '8061737', '21', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('78', 'DACARBAZINE MEDAC VIAL', 'Pcs', '500000', '517759', '50', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('79', 'DACLIN ACNE', 'Pcs', '10000', '11500', '100', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('80', 'ECRON VIAL', 'Tablet', '800000', '816750', '21', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('81', 'EDEMIN AMPUL', 'Lembar', '20000', '26620', '100', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('82', 'FACENOL CREAM', 'Pcs', '9000', '9983', '100', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('83', 'FAMOCID', 'Pcs', '115000', '119000', '100', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('84', 'GABAPENTIN CAPSULE OGB NOVELL', 'Dos', '500000', '533610', '21', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('85', 'GALPECT', 'Botol', '20000', '22900', '100', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('86', 'H-BOOSTER ', 'Pcs', '15000', '15400', '85', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('87', 'HAEMACCEL ', 'Botol', '200000', '205700', '30', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('88', 'IALUSET PLUS CREAM', 'Pcs', '130000', '150040', '21', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('89', 'IBOL TABLET ', 'Tablet', '35000', '36300', '99', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('90', 'JANUMET TABLET ', 'Tablet', '210000', '213219', '21', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('91', 'KADIFLAM TABLET', 'Tablet', '65000', '66429', '100', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('92', 'LACBON TABLET', 'Tablet', '150000', '157300', '21', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('93', 'MADERVIT CAPSULE', 'Pcs', '40000', '43923', '88', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('94', 'N-EPI INFUSION', 'Pcs', '450000', '453750', '21', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('95', 'OA CAPLET', 'Pcs', '330000', '333234', '21', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('96', 'PALMICOL SYRUP', 'Botol', '9000', '9075', '100', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('97', 'Q CEF DRY SYRUP', 'Botol', '48000', '48400', '95', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('98', 'RACLONID AMPUL', 'Pcs', '49000', '49610', '100', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('99', 'SAFE CARE AROMATHERAPY', 'Botol', '14000', '14960', '100', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('100', 'TABAS SYRUP', 'Botol', '20000', '20500', '74', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('101', 'UBI-Q CAPSULE', 'Pcs', '400000', '422338', '21', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('102', 'V-LACTO', 'Botol', '90000', '90900', '29', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('103', 'WAISAN', 'Strip', '15000', '16336', '73', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('104', 'X-CAM TABLET', 'Tablet', '235000', '243210', '20', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('105', 'YARIFLAM TABLET', 'Tablet', '95000', '96800', '19', '1', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('106', 'ZADITEN ORAL DROPS', 'Pcs', '100000', '109092', '67', '0', '2018-10-03 11:20:53');
INSERT INTO `obat` VALUES ('107', 'obat pusing', 'Strip', '500', '1500', '38', '0', '2015-10-03 11:20:53');

-- ----------------------------
-- Table structure for pembelian
-- ----------------------------
DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(255) DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `total` int(50) DEFAULT NULL,
  PRIMARY KEY (`id_pembelian`),
  KEY `id_supplier` (`id_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pembelian
-- ----------------------------
INSERT INTO `pembelian` VALUES ('56', 'BOU-001', '5', '2016-02-14 20:02:19', '46450000');
INSERT INTO `pembelian` VALUES ('57', 'BOU-002', '4', '2016-02-14 20:07:34', '87000000');
INSERT INTO `pembelian` VALUES ('58', 'BOU-003', '4', '2016-02-14 20:12:21', '87000000');
INSERT INTO `pembelian` VALUES ('59', 'BOU-004', '4', '2016-02-14 20:16:02', '26000000');
INSERT INTO `pembelian` VALUES ('60', 'BOU-005', '4', '2016-02-14 20:18:38', '18800000');
INSERT INTO `pembelian` VALUES ('61', 'BOU-006', '5', '2016-02-14 20:27:41', '12400000');
INSERT INTO `pembelian` VALUES ('62', 'BOU-007', '5', '2016-02-14 20:29:10', '12500000');
INSERT INTO `pembelian` VALUES ('63', 'BOU-008', '5', '2016-02-14 20:30:54', '7500000');
INSERT INTO `pembelian` VALUES ('64', 'BOU-009', '5', '2016-02-14 20:32:53', '6230000');
INSERT INTO `pembelian` VALUES ('65', 'BOU-010', '5', '2016-02-14 20:34:46', '4410000');
INSERT INTO `pembelian` VALUES ('66', 'BOU-011', '5', '2016-02-14 20:36:21', '6500000');
INSERT INTO `pembelian` VALUES ('67', 'BOU-012', '5', '2016-02-14 20:37:06', '3150000');
INSERT INTO `pembelian` VALUES ('68', 'BOU-013', '5', '2016-02-14 20:38:47', '4000000');
INSERT INTO `pembelian` VALUES ('69', 'BOU-014', '5', '2016-02-14 20:39:27', '9450000');
INSERT INTO `pembelian` VALUES ('70', 'BOU-015', '5', '2016-02-14 20:40:47', '6930000');
INSERT INTO `pembelian` VALUES ('71', 'BOU-016', '5', '2016-02-14 20:41:37', '900000');
INSERT INTO `pembelian` VALUES ('72', 'BOU-017', '5', '2016-02-14 20:42:30', '4800000');
INSERT INTO `pembelian` VALUES ('73', 'BOU-018', '5', '2016-02-14 20:44:18', '4900000');
INSERT INTO `pembelian` VALUES ('74', 'BOU-019', '5', '2016-02-14 20:45:40', '1400000');
INSERT INTO `pembelian` VALUES ('75', 'BOU-020', '4', '2016-02-14 20:47:48', '2000000');
INSERT INTO `pembelian` VALUES ('76', 'BOU-021', '5', '2016-02-14 20:48:22', '8400000');
INSERT INTO `pembelian` VALUES ('77', 'BOU-022', '4', '2016-02-14 20:49:48', '2700000');
INSERT INTO `pembelian` VALUES ('78', 'BOU-023', '4', '2016-02-14 20:50:37', '1500000');
INSERT INTO `pembelian` VALUES ('79', 'BOU-024', '5', '2016-02-14 20:51:20', '4935000');
INSERT INTO `pembelian` VALUES ('80', 'BOU-025', '4', '2016-02-14 20:53:20', '2945000');
INSERT INTO `pembelian` VALUES ('81', 'BOU-026', '5', '2016-02-14 20:55:29', '5000000');
INSERT INTO `pembelian` VALUES ('82', 'BOU-027', '5', '2016-02-15 13:30:40', '7500000');
INSERT INTO `pembelian` VALUES ('83', 'BOU-028', '5', '2016-02-15 13:31:31', '82500000');
INSERT INTO `pembelian` VALUES ('84', 'BOU-029', '5', '2016-02-15 13:32:30', '600000');
INSERT INTO `pembelian` VALUES ('85', 'BOU-030', '4', '2016-02-16 09:44:39', '1000000');
INSERT INTO `pembelian` VALUES ('86', 'BOU-031', '5', '2016-02-16 10:50:47', '7500');
INSERT INTO `pembelian` VALUES ('87', 'BOU-032', '5', '2016-02-16 11:11:16', '200000');
INSERT INTO `pembelian` VALUES ('88', 'BOU-033', '5', '2016-02-16 11:21:53', '500000');
INSERT INTO `pembelian` VALUES ('89', 'BOU-034', '4', '2016-02-16 12:41:11', '11500');

-- ----------------------------
-- Table structure for pengaturanweb
-- ----------------------------
DROP TABLE IF EXISTS `pengaturanweb`;
CREATE TABLE `pengaturanweb` (
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pengaturanweb
-- ----------------------------
INSERT INTO `pengaturanweb` VALUES ('active');

-- ----------------------------
-- Table structure for penjualan
-- ----------------------------
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `total` int(50) DEFAULT NULL,
  `bayar` int(50) DEFAULT NULL,
  `kembalian` int(50) DEFAULT NULL,
  `id_dokter` varchar(255) DEFAULT NULL,
  `namapasien` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of penjualan
-- ----------------------------
INSERT INTO `penjualan` VALUES ('46', 'POU-001', '2016-02-14 21:30:04', '154000', '155000', '1000', null, null);
INSERT INTO `penjualan` VALUES ('47', 'POU-002', '2016-02-14 21:31:54', '77000', '80000', '3000', null, null);
INSERT INTO `penjualan` VALUES ('48', 'POU-003', '2016-02-14 21:32:12', '36300', '40000', '3700', null, null);
INSERT INTO `penjualan` VALUES ('49', 'POU-004', '2016-02-15 13:27:44', '32672', '35000', '2328', null, null);
INSERT INTO `penjualan` VALUES ('50', 'POU-005', '2016-02-16 09:43:42', '163360', '170000', '6640', null, null);
INSERT INTO `penjualan` VALUES ('51', 'POU-006', '2016-02-16 13:26:53', '2025576', '2050000', '24424', 'DK-004', 'Ferdaaay');
INSERT INTO `penjualan` VALUES ('52', 'POU-007', '2016-02-16 13:41:03', '323680', '350000', '26320', 'DK-004', 'Desri');
INSERT INTO `penjualan` VALUES ('53', 'POU-008', '2016-02-16 13:48:25', '204360', '205000', '640', 'DK-004', 'Ferday');

-- ----------------------------
-- Table structure for penjualan_resep
-- ----------------------------
DROP TABLE IF EXISTS `penjualan_resep`;
CREATE TABLE `penjualan_resep` (
  `id_penjualan_r` int(11) NOT NULL AUTO_INCREMENT,
  `no_resep` varchar(255) DEFAULT NULL,
  `id_dokter` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `total` int(50) DEFAULT NULL,
  `bayar` int(50) DEFAULT NULL,
  `kembalian` int(50) DEFAULT NULL,
  `namapasien` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_penjualan_r`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of penjualan_resep
-- ----------------------------
INSERT INTO `penjualan_resep` VALUES ('47', 'RSP-001', 'DK-002', '2016-02-14 21:01:20', '8061737', '8100000', '38263', null);
INSERT INTO `penjualan_resep` VALUES ('48', 'RSP-002', 'DK-002', '2016-02-15 13:27:06', '205000', '205000', '0', null);
INSERT INTO `penjualan_resep` VALUES ('49', 'RSP-003', 'DK-003', '2016-02-16 12:03:36', '41000', '45000', '4000', 'Ferday');
INSERT INTO `penjualan_resep` VALUES ('50', 'RSP-004', 'DK-002', '2016-02-16 12:57:49', '243210', '250000', '6790', 'Herman');

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon_supplier` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES ('4', 'PT. Medion Indonesia 40553', 'Jl. Cimareme', '087821324353');
INSERT INTO `supplier` VALUES ('5', 'PT. Combiphar Indonesia', 'Padalarang, Bandung Barat', '085912321231');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` longtext NOT NULL,
  `role` varchar(20) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Admin', '', 'active');
INSERT INTO `users` VALUES ('2', 'kasir', 'c7911af3adbd12a035b289556d96470a', 'kasir', 'Kasir', '', 'active');
INSERT INTO `users` VALUES ('3', 'pimpinan', '90973652b88fe07d05a4304f0a945de8', 'pimpinan', 'Ferdi', '', 'active');
INSERT INTO `users` VALUES ('4', 'gudang', '202446dd1d6028084426867365b0c7a1', 'gudang', 'Orang Gudang', '', 'active');
INSERT INTO `users` VALUES ('5', 'ferdi', '8bf4bb0e2efad01abe522bf314504a49', 'admin', 'Ferdy', 'ferdiindonesia554@gmail.com', 'active');
INSERT INTO `users` VALUES ('6', 'nessaramadan', 'ac43724f16e9241d990427ab7c8f4228', 'kasir', 'Nessa Ramadan', 'nessaramadan@ymail.com', 'inactive');
INSERT INTO `users` VALUES ('9', 'kevin', '9d5e3ecdeb4cdb7acfd63075ae046672', 'gudang', 'Kevin A. Yuliana', 'kevin_a@gmail.com', 'inactive');
INSERT INTO `users` VALUES ('10', 'ferdik', 'd17d35fc07b55cb9ed2dc1c76a397d43', 'kasir', 'Ferdi Kasir', 'ferdi554@yahoo.co.id', 'active');
INSERT INTO `users` VALUES ('11', 'kriswanto', '816216d8aef4dacee9aa17561e2b7159', 'kasir', 'kriswanto', 'kriswanto10@yahoo.com', 'inactive');
