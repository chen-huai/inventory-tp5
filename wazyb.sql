
DROP TABLE IF EXISTS `admin_article`;
CREATE TABLE `admin_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `abstract` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `del` int(1) DEFAULT '0' COMMENT '0代表正常，1代表删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_article
-- ----------------------------
INSERT INTO `admin_article` VALUES ('1', '大家好', '呵呵哒，还斩妖', '2017-01-12 16:55:55', 'admin', '阿萨飒飒飒飒飒飒撒飒飒飒飒飒飒飒飒飒飒飒飒飒飒所所所所所所所所', '0');
INSERT INTO `admin_article` VALUES ('2', '12', '12', '2017-01-13 11:36:33', 'admin', '12', '0');
INSERT INTO `admin_article` VALUES ('3', '这是我的新文章嘿嘿', '你想看吗', '2017-01-13 15:00:59', 'admin', '你是谁？', '0');
INSERT INTO `admin_article` VALUES ('4', '有时间了！1', '你看', '2017-01-13 14:47:16', 'admin', '上看看', '0');
INSERT INTO `admin_article` VALUES ('5', '你好', '怎么好', '2017-01-13 11:36:16', 'admin', '我也不知道', '0');
INSERT INTO `admin_article` VALUES ('6', '阿萨德', '在线', '2017-01-13 11:40:34', 'admin', '121212啊', '0');
INSERT INTO `admin_article` VALUES ('7', '12', '12', '2017-01-13 14:47:27', 'admin', '12', '1');
INSERT INTO `admin_article` VALUES ('8', '12', '12', '2017-01-13 14:47:35', 'admin', '12', '1');
INSERT INTO `admin_article` VALUES ('9', '12', '12', '2017-01-13 11:44:34', 'admin', '12', '0');
INSERT INTO `admin_article` VALUES ('10', '12', '12', '2017-01-13 11:49:50', 'admin', '12', '0');
INSERT INTO `admin_article` VALUES ('11', '可以吗', 'assassin', '2017-01-13 11:51:23', 'admin', '好吧', '0');
INSERT INTO `admin_article` VALUES ('12', '是', '2', '2017-01-13 11:52:10', 'admin', '场', '0');
INSERT INTO `admin_article` VALUES ('13', '撒', '手', '2017-01-13 11:52:44', 'admin', '吧', '0');
INSERT INTO `admin_article` VALUES ('14', '阿萨', '在学校', '2017-01-13 11:53:36', 'admin', '撒啊飒飒', '0');
INSERT INTO `admin_article` VALUES ('15', '1必须好啊！', '2', '2017-01-13 14:50:28', 'admin', '3', '0');
INSERT INTO `admin_article` VALUES ('16', '这分页真好用', '你知道吗', '2017-01-13 13:34:22', 'admin', '哈哈哈', '1');
INSERT INTO `admin_article` VALUES ('17', '我来看看', '还不错', '2017-01-13 15:36:03', 'test', '就你了！怎么用', '0');
INSERT INTO `admin_article` VALUES ('18', '测试', '11', '2017-01-13 16:07:29', 'admin', '啊啊', '0');
INSERT INTO `admin_article` VALUES ('19', '在', '啊啊', '2017-01-13 16:07:42', 'admin', '啊啊', '0');
INSERT INTO `admin_article` VALUES ('20', '31', '13', '2017-01-13 16:08:35', 'admin', '13', '0');
INSERT INTO `admin_article` VALUES ('21', '11', '11', '2017-01-13 16:08:41', 'admin', '11', '0');
INSERT INTO `admin_article` VALUES ('22', 'zzz', 'zzz', '2017-01-13 16:42:41', 'admin', 'zzz', '1');
INSERT INTO `admin_article` VALUES ('23', 'Ccc', 'ccc', '2017-01-13 16:42:38', 'admin', 'ccc', '1');
INSERT INTO `admin_article` VALUES ('24', 'vvv', 'vvv', '2017-01-13 16:42:35', 'admin', 'vvv', '1');
INSERT INTO `admin_article` VALUES ('25', '12', '31', '2017-01-13 16:42:28', 'admin', '13', '1');
INSERT INTO `admin_article` VALUES ('26', 'xc', 'xc', '2017-01-13 16:42:25', 'admin', 'xc', '1');
INSERT INTO `admin_article` VALUES ('27', '', '', '2017-01-13 17:26:48', 'admin', '', '1');
INSERT INTO `admin_article` VALUES ('28', '', '', '2017-01-13 17:26:44', 'admin', '', '1');
INSERT INTO `admin_article` VALUES ('29', 'ssss', 'ssss', '2017-01-13 17:26:21', 'admin', 'sss', '0');
INSERT INTO `admin_article` VALUES ('30', '21', '12', '2017-01-13 17:26:29', 'admin', '12', '0');
INSERT INTO `admin_article` VALUES ('31', '', '', '2017-01-13 17:26:40', 'admin', '', '1');
INSERT INTO `admin_article` VALUES ('32', 'asasd', 'asdd', '2017-01-13 17:49:13', 'test', 'asdadsad', '0');
INSERT INTO `admin_article` VALUES ('33', '11111111111', '11111111', '2017-01-13 17:49:21', 'test', '1111111111111', '0');
INSERT INTO `admin_article` VALUES ('34', '1asd', '1asdasd', '2017-01-13 18:00:15', 'admin', '1asdas', '0');
INSERT INTO `admin_article` VALUES ('35', '1212', '1212', '2017-01-13 18:00:25', 'admin', '121212', '0');
INSERT INTO `admin_article` VALUES ('36', '12', '12', '2017-01-13 18:00:56', 'admin', '12', '0');
INSERT INTO `admin_article` VALUES ('37', '12121212121212121212', '121212121212121212', '2017-01-13 18:04:20', 'admin', '12121', '0');
INSERT INTO `admin_article` VALUES ('38', '好开心啊啊', '好开心啊啊', '2017-01-13 18:05:42', 'admin', '好开心啊啊', '0');
INSERT INTO `admin_article` VALUES ('39', 'qw', 'qw', '2017-01-13 18:09:07', 'admin', 'qw', '0');
INSERT INTO `admin_article` VALUES ('40', '22', '22', '2017-01-13 18:09:12', 'admin', '22', '0');
INSERT INTO `admin_article` VALUES ('41', '442', '2424', '2017-01-13 18:09:18', 'admin', '24224', '0');
INSERT INTO `admin_article` VALUES ('42', 'qwqw1', 'qqwqw', '2017-01-17 22:18:26', 'test', 'qwqwqqw', '1');
INSERT INTO `admin_article` VALUES ('43', '12', '13', '2017-01-17 18:01:09', 'test', '14', '1');

-- ----------------------------
-- Table structure for admin_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `admin_auth_group`;
CREATE TABLE `admin_auth_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` text COMMENT '规则id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='用户组表';

-- ----------------------------
-- Records of admin_auth_group
-- ----------------------------
INSERT INTO `admin_auth_group` VALUES ('1', '超级管理员', '1', '1,14,143,144,6,2,3,15,16,17,18,4,20,21,7,8,9,10,11,140,141,142,12,13,19');
INSERT INTO `admin_auth_group` VALUES ('2', '产品经理', '1', '1,2,3,4,5,6,19');
INSERT INTO `admin_auth_group` VALUES ('4', '新闻发布人员', '1', '14,15,16,17,18,12,13,19');
INSERT INTO `admin_auth_group` VALUES ('15', '文章管理员', '1', '1,143,144,6,10,11,140,19');

-- ----------------------------
-- Table structure for admin_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `admin_auth_group_access`;
CREATE TABLE `admin_auth_group_access` (
  `uid` int(11) unsigned NOT NULL COMMENT '用户id',
  `group_id` int(11) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组明细表';

-- ----------------------------
-- Records of admin_auth_group_access
-- ----------------------------
INSERT INTO `admin_auth_group_access` VALUES ('88', '1');
INSERT INTO `admin_auth_group_access` VALUES ('89', '2');
INSERT INTO `admin_auth_group_access` VALUES ('89', '4');
INSERT INTO `admin_auth_group_access` VALUES ('90', '2');
INSERT INTO `admin_auth_group_access` VALUES ('91', '1');
INSERT INTO `admin_auth_group_access` VALUES ('92', '15');

-- ----------------------------
-- Table structure for admin_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `admin_auth_rule`;
CREATE TABLE `admin_auth_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=148 DEFAULT CHARSET=utf8 COMMENT='规则表';

-- ----------------------------
-- Records of admin_auth_rule
-- ----------------------------
INSERT INTO `admin_auth_rule` VALUES ('16', '3', 'Admin/Rule/add_group', '添加角色', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('17', '3', 'Admin/Rule/edit_group', '修改角色', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('18', '3', 'Admin/Rule/delete_group', '删除角色', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('14', '1', 'Test/index/index', '测试权限', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('20', '4', 'Admin/User/add_user', '添加用户（管理员）', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('7', '6', 'Admin/Rule/add', '添加权限', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('1', '0', 'Admin/Index/index', '控制台', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('10', '0', 'Admin/ShowNav/posts', '系统设置', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('11', '10', 'Admin/Article/index', '文章管理', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('12', '10', 'Admin/Posts/add_posts', '菜单管理', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('13', '10', 'Admin/Posts/edit_posts', '日志管理', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('4', '6', 'Admin/User/index', '用户管理', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('19', '10', 'Admin/Index/logout', '退出登录', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('6', '0', 'Admin/Rule/', '权限控制', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('3', '6', 'Admin/Rule/rule_group', '角色管理', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('8', '6', 'Admin/Rule/edit', '修改权限', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('9', '6', 'Admin/Rule/delete', '删除权限', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('2', '6', 'Admin/Rule/rule_list', '权限管理', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('15', '3', 'Admin/Rule/rule_distribution', '角色分配权限', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('21', '4', 'Admin/User/edit_user', '修改用户', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('140', '11', 'Admin/Article/add_art', '新增文章', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('141', '11', 'Admin/Article/del_art', '删除文章', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('142', '11', 'Admin/Article/edi_art', '文章编辑', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('143', '1', 'Admin/User/my_center', '个人中心', '1', '1', '');
INSERT INTO `admin_auth_rule` VALUES ('144', '143', 'Admin/User/change_msg', '修改个人资料', '1', '1', '');

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '登录密码；mb_password加密',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像，相对于upload/avatar目录',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '登录邮箱',
  `email_code` varchar(60) DEFAULT NULL COMMENT '激活码',
  `phone` bigint(11) unsigned DEFAULT NULL COMMENT '手机号',
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '用户状态 0：禁用； 1：正常 ；2：未验证',
  `register_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` varchar(16) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  PRIMARY KEY (`id`),
  KEY `user_login_key` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES ('88', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '/Upload/avatar/user1.jpg', '1113249273@qq.com', '', '18712377777', '1', '1449199996', '', '0');
INSERT INTO `admin_users` VALUES ('89', 'admin2', 'e10adc3949ba59abbe56e057f20f883e', '/Upload/avatar/user2.jpg', '', '', null, '1', '1449199996', '', '0');
INSERT INTO `admin_users` VALUES ('90', 'zy', 'e10adc3949ba59abbe56e057f20f883e', '', '1113249273@qq.com', null, '18712377077', '1', '1484121804', '', '0');
INSERT INTO `admin_users` VALUES ('91', 'zy2', 'e10adc3949ba59abbe56e057f20f883e', '', '12121212121212121212', null, '1212', '1', '1484121843', '', '0');
INSERT INTO `admin_users` VALUES ('92', 'test', 'e10adc3949ba59abbe56e057f20f883e', '', '1262135552@qq.com', null, '18712377077', '1', '1484284579', '', '0');
