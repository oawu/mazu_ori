<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Migration_Add_articles extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `articles` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `user_id` int(11) NOT NULL,
        `cover` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '封面',
        `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '標題',
        `content` text COMMENT '內容',
        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '註冊時間',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '更新時間',
        PRIMARY KEY (`id`),
        KEY `user_id_index` (`user_id`),
        FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `articles`;"
    );
  }
}