<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Tool_cell extends Cell_Controller {

  /* render_cell ('tool_cell', 'pagination', $pagination); */
  // public function _cache_pagination ($pagination) {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function pagination ($pagination) {
    return $this->setUseCssList (true)
                ->load_view (array ('pagination' => $pagination));
  }
  /* render_cell ('tool_cell', 'conditions', $url, $qs, $search_url, $new_url); */
  // public function _cache_list ($qs, $search_url, $new_url) {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function conditions ($qs, $search_url, $new_url) {
    return $this->setUseCssList (true)
                ->load_view (array ('qs' => $qs, 'search_url' => $search_url, 'new_url' => $new_url));
  }
}