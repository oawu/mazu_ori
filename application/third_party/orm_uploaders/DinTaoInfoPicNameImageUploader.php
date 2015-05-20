<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class DinTaoInfoPicNameImageUploader extends OrmImageUploader {

  public function getVersions () {
    return array (
        '' => array (),
        '100x100c' => array ('resize', 100, 100, 'c'),
        '640w' => array ('resize', 640, 640, 'width')
      );
  }
}