<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Main extends Site_controller {

  public function __construct () {
    parent::__construct ();
  }

  public function index () {
    $this->load->library ('phpQuery');

    $url = 'http://cuy.ylc.edu.tw/~cuy14/images/S/';

    $get_html_str = str_replace ('&amp;', '&', urldecode (file_get_contents ($url)));

    $php_query = phpQuery::newDocument ($get_html_str);
    $a = $php_query->find ('a');

      echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" /><pre>';
    for ($i = 0; $i < $a->count (); $i++) {
      if (in_array (strtolower (pathinfo ($a->eq ($i)->attr ('href'), PATHINFO_EXTENSION)), array ('jpg', 'jpeg', 'png', 'gif'))) {
        $name = $a->eq ($i)->attr ('href');
        download_web_file ($url . $name, FCPATH . 'temp/image/' . $name);
        var_dump ($a->eq ($i)->attr ('href'));
      }
    }

    // download_web_file ();
    // $this->load_view (null);
  }
}
