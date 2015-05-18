<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Migration_Add_users extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `users` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '信箱',
        `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '密碼',
        `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '暱稱',
        `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '照片',
        `login_count` int(11) NOT NULL DEFAULT '0' COMMENT '登入次數',
        `logined_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '登入時間',
        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '註冊時間',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '更新時間',
        PRIMARY KEY (`id`),
        KEY `email_index` (`email`),
        KEY `email_password_index` (`email`, `password`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );

    $this->db->query (
      "INSERT INTO `users` (`id`, `email`, `password`, `name`, `login_count`, `logined_at`, `created_at`, `updated_at`)
        VALUES (1, 'root@mazu.ioa.tw', '" . md5 ('123456') . "', 'OA', 0, '" . date ('Y-m-d H:i:s') . "', '" . date ('Y-m-d H:i:s') . "', '" . date ('Y-m-d H:i:s') . "');"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `users`;"
    );
  }
}