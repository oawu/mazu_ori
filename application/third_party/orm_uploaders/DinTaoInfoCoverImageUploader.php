<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class DinTaoInfoCoverImageUploader extends OrmImageUploader {

  public function getVersions () {
    return array (
        '' => array (),
        '50w' => array ('adaptiveResizeQuadrant', 50, 50, 'width'),
        '100w' => array ('resize', 100, 100, 'width')
      );
  }
}