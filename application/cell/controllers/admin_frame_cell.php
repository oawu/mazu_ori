<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Admin_frame_cell extends Cell_Controller {

  /* render_cell ('admin_frame_cell', 'header', array ()); */
  // public function _cache_header () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function header () {
    return $this->setUseCssList (true)
                ->load_view ();
  }

  /* render_cell ('admin_frame_cell', 'footer', array ()); */
  // public function _cache_footer () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function footer () {
    return $this->setUseCssList (true)
                ->load_view ();
  }

  /* render_cell ('admin_frame_cell', 'side', array ()); */
  // public function _cache_side () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function side () {
    $groups = array (
        '地方陣頭' => array (
            '＋管理列表' => base_url ('admin', 'din_tao_infos')
          )
      );

    return $this->setUseCssList (true)
                ->load_view (array ('groups' => $groups));
  }
}