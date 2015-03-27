DROP TABLE IF EXISTS `core_action`;
CREATE TABLE `core_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_module` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `component` varchar(150) NOT NULL,
  `controllers` varchar(150) NOT NULL,
  `tasks` varchar(150) NOT NULL,
  `location` varchar(50) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `is_public` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_module` (`id_module`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_action
-- ----------------------------
INSERT INTO core_action VALUES ('1', '2', '34343 action', 'com_phanquyen', '', '', 'site', '1', '1');
INSERT INTO core_action VALUES ('3', '2', 'Cấp giấy chứng nhận biển số nhà (cá nhân)', 'com_phanquyen', 'action', '', 'site', '1', '1');
INSERT INTO core_action VALUES ('4', '2', 'Thay đổi nội dung GP', 'com_phanquyen', 'action', 'default', 'admin', '0', '1');
INSERT INTO core_action VALUES ('5', '1', 'Thay đổi nội dung GP', '', '123232', '1232', '1', null, '0');
INSERT INTO core_action VALUES ('6', '1', 'hệ thống', 'com_phanquyen', '123232', '123', 'admin', '1', '0');
INSERT INTO core_action VALUES ('7', '2', 'templ', '', 'Action', 'saveAction', 'site', '1', null);
INSERT INTO core_action VALUES ('8', '1', 'Đăng ký hộ kinh doanh', '', '', '123', '123', '1', '1');
INSERT INTO core_action VALUES ('2', '1', 'Một cửa điện tử', '23434 component', 'Action', 'saveAction', '2343 contr', '0', '0');
INSERT INTO core_action VALUES ('12', '1', 'Báo cáo hồ sơ', 'com_baocao', 'bienche', 'add', '123', '1', '1');
INSERT INTO core_action VALUES ('13', '0', 'sdfd', '', 'sdfd', 'sdf', 'sdfd', '0', '0');
INSERT INTO core_action VALUES ('14', '1', 'Public 11', 'com_phanquyen', '', '', 'admin', '1', '1');
INSERT INTO core_action VALUES ('15', '7', 'Bâo cáo hồ sơ', 'com_baocao', 'baocao', '', 'site', '1', '0');
INSERT INTO core_action VALUES ('16', '7', 'Báo cáo biên chế', 'com_baocao', 'bienche', '', 'site', '1', '0');
INSERT INTO core_action VALUES ('17', '7', 'Báo cáo chờ nâng chức vụ', 'com_baocao', 'chonangchucvu', '', 'site', '1', '0');
INSERT INTO core_action VALUES ('18', '7', 'Báo cáo viên chức', 'com_baocao', 'vienchuc', '', 'site', '1', '0');
INSERT INTO core_action VALUES ('19', '7', 'Báo cáo công chức', 'com_baocao', 'congchuc', '', 'site', '1', '0');
INSERT INTO core_action VALUES ('20', '8', 'Báo cáo hồ sơ Công chức', 'com_baocaohoso', 'congchuc', '', 'site', '1', '0');
INSERT INTO core_action VALUES ('21', '8', 'Báo cáo hồ sơ Viên chức', 'com_baocaohoso', 'vienchuc', '', 'site', '1', '0');
INSERT INTO core_action VALUES ('22', '8', 'Báo cáo hồ sơ Thống kê nhanh', 'com_baocaohoso', 'thongkenhanh', '', 'site', '1', '0');
INSERT INTO core_action VALUES ('23', '8', 'Báo cáo hồ sơ Sử dụng', 'com_baocaohoso', 'sudung', '', 'site', '1', '0');

-- ----------------------------
-- Table structure for `core_group`
-- ----------------------------
DROP TABLE IF EXISTS `core_group`;
CREATE TABLE `core_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `code` varchar(10) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `orders` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_group
-- ----------------------------

-- ----------------------------
-- Table structure for `core_group_action`
-- ----------------------------
DROP TABLE IF EXISTS `core_group_action`;
CREATE TABLE `core_group_action` (
  `group_id` int(11) NOT NULL DEFAULT '0',
  `action_id` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`,`action_id`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_group_action
-- ----------------------------

-- ----------------------------
-- Table structure for `core_module`
-- ----------------------------
DROP TABLE IF EXISTS `core_module`;
CREATE TABLE `core_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_module
-- ----------------------------

-- ----------------------------
-- Table structure for `core_user_action_donvi`
-- ----------------------------
DROP TABLE IF EXISTS `core_user_action_donvi`;
CREATE TABLE `core_user_action_donvi` (
  `user_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `iddonvi` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_user_action_donvi
-- ----------------------------

-- ----------------------------
-- Table structure for `core_user_donvi`
-- ----------------------------
DROP TABLE IF EXISTS `core_user_donvi`;
CREATE TABLE `core_user_donvi` (
  `id_user` int(11) NOT NULL,
  `id_donvi` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
