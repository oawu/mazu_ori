<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Migration_Add_din_tao_infos extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `din_tao_infos` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '名稱',
        `cover` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '封面',
        `type` int(11) NOT NULL DEFAULT '0' COMMENT '類型，config.setting.din_tao',
        `content` text COMMENT '內容',
        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '註冊時間',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '更新時間',
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `din_tao_infos`;"
    );
  }
}