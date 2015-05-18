<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Articles extends Site_controller {

  public function __construct () {
    parent::__construct ();
  }


  public function xxx () {
    $url = base_url ('temp', 'a.jpg');
    $message = '上傳成功';

    $funcNum = $_GET['CKEditorFuncNum'];

    echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction ($funcNum, '$url', '$message');</script>";
  }

  public function index () {
    $this
                ->add_js (base_url ('resource', 'javascript', 'ckeditor_d2015_05_18', 'ckeditor.js'), false)
                ->add_js (base_url ('resource', 'javascript', 'ckeditor_d2015_05_18', 'adapters', 'jquery.js'), false)
                ->add_hidden (array ('id' => 'xxx', 'value' => base_url ($this->get_class (), 'xxx')))
    ->load_view (null);
  }
}
