<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Din_tao_infos extends Admin_controller {

  public function __construct () {
    parent::__construct ();
  }

  public function x () {

    $this->load->library ('CreateDemo');

    foreach (CreateDemo::pics (20, 30) as $pic) {
      if ($pic && verifyCreateOrm ($din_tao = DinTaoInfo::create (array (
                      'name' => CreateDemo::text (3, 5),
                      'cover' => $pic['url'],
                      'type' => rand (0, 1),
                      'content' => CreateDemo::text (200, 500),
                    ))))
      $din_tao->cover->put_url ($pic['url']);
    }
  }

  public function destroy ($id = 0) {
    if (!($din_tao_info = DinTaoInfo::find_by_id ($id)))
      return redirect (array ('admin', 'din_tao_infos'));

    $message = $din_tao_info->cover->cleanAllFiles () && $din_tao_info->delete () ? '刪除成功！' : '刪除失敗！';

    return identity ()->set_session ('_flash_message', $message, true)
                    && redirect (array ('admin', 'din_tao_infos'), 'refresh');
  }

  public function upload_ckedit () {
    $url = base_url ('temp', 'a.jpg');
    $message = '上傳成功';

    $funcNum = $_GET['CKEditorFuncNum'];

    echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction ($funcNum, '$url', '$message');</script>";
  }
  public function edit ($id = 0) {
    if (!($din_tao_info = DinTaoInfo::find_by_id ($id)))
      return redirect (array ('admin', 'din_tao_infos'));

    $message = identity ()->get_session ('_flash_message', true);
    $name    = identity ()->get_session ('name', true);
    $type    = identity ()->get_session ('type', true);
    $content = identity ()->get_session ('content', true);

    $this->add_hidden (array ('id' => 'upload_ckedit_url', 'value' => base_url ('admin', 'din_tao_infos', 'upload_ckedit')))
         ->load_view (array (
        'message' => $message,
        'name' => $name,
        'type' => $type,
        'content' => $content,
        'din_tao_info' => $din_tao_info
      ));
  }


  public function update ($id = 0) {
    if (!($din_tao_info = DinTaoInfo::find_by_id ($id)))
      return redirect (array ('admin', 'din_tao_infos'));

    if (!$this->has_post ())
      return redirect (array ('admin', 'din_tao_infos', 'edit', $din_tao_info->id));

    $name    = trim ($this->input_post ('name'));
    $type    = trim ($this->input_post ('type'));
    $content = trim ($this->input_post ('content', false, false));
    $cover   = $this->input_post ('cover', true);

    if (!($name && in_array ($type, array_keys (Cfg::setting ('din_tao_info', 'types'))) && $content))
      return identity ()->set_session ('_flash_message', '填寫資訊有少！', true)
                        ->set_session ('name', $name, true)
                        ->set_session ('type', $type, true)
                        ->set_session ('content', $content, true)
                        && redirect (array ('admin', 'din_tao_infos', 'edit', $din_tao_info->id), 'refresh');

    $din_tao_info->name = $name;
    $din_tao_info->type = $type;
    $din_tao_info->content = $content;
    if (!$din_tao_info->save ())
      return identity ()->set_session ('_flash_message', '修改失敗！', true)
                  ->set_session ('name', $name, true)
                  ->set_session ('type', $type, true)
                  ->set_session ('content', $content, true)
                  && redirect (array ('admin', 'din_tao_infos', 'edit', $din_tao_info->id), 'refresh');

    if ($cover && !$din_tao_info->cover->put ($cover))
        return identity ()->set_session ('_flash_message', '修改圖片失敗！', true)
                    ->set_session ('name', $name, true)
                    ->set_session ('type', $type, true)
                    ->set_session ('content', $content, true)
                    && redirect (array ('admin', 'din_tao_infos', 'edit', $din_tao_info->id), 'refresh');

    return identity ()->set_session ('_flash_message', '新增成功！', true)
                    && redirect (array ('admin', 'din_tao_infos'), 'refresh');
  }

  public function add () {

    $message = identity ()->get_session ('_flash_message', true);
    $name    = identity ()->get_session ('name', true);
    $type    = identity ()->get_session ('type', true);
    $content = identity ()->get_session ('content', true);

    $this->add_hidden (array ('id' => 'upload_ckedit_url', 'value' => base_url ('admin', 'din_tao_infos', 'upload_ckedit')))
         ->load_view (array (
        'message' => $message,
        'name' => $name,
        'type' => $type,
        'content' => $content,
      ));
  }

  public function create () {
    if (!$this->has_post ())
      return redirect (array ('admin', 'din_tao_infos', 'add'));

    $name    = trim ($this->input_post ('name'));
    $type    = trim ($this->input_post ('type'));
    $content = trim ($this->input_post ('content', false, false));
    $cover   = $this->input_post ('cover', true);

    if (!($name && in_array ($type, array_keys (Cfg::setting ('din_tao_info', 'types'))) && $content && $cover))
      return identity ()->set_session ('_flash_message', '填寫資訊有少！', true)
                        ->set_session ('name', $name, true)
                        ->set_session ('type', $type, true)
                        ->set_session ('content', $content, true)
                        && redirect (array ('admin', 'din_tao_infos', 'add'), 'refresh');

    $params = array (
        'name' => $name,
        'type' => $type,
        'content' => $content,
        'cover' => '',
      );

    if (!verifyCreateOrm ($din_tao_info = DinTaoInfo::create ($params)))
        return identity ()->set_session ('_flash_message', '新增失敗！', true)
                    ->set_session ('name', $name, true)
                    ->set_session ('type', $type, true)
                    ->set_session ('content', $content, true)
                    && redirect (array ('admin', 'din_tao_infos', 'add'), 'refresh');

    if (!$din_tao_info->cover->put ($cover))
        return identity ()->set_session ('_flash_message', '新增圖片失敗！', true)
                    ->set_session ('name', $name, true)
                    ->set_session ('type', $type, true)
                    ->set_session ('content', $content, true)
                    && redirect (array ('admin', 'din_tao_infos', 'edit', $din_tao_info->id), 'refresh');

    return identity ()->set_session ('_flash_message', '新增成功！', true)
                    && redirect (array ('admin', 'din_tao_infos'), 'refresh');
  }

  public function index ($offset = 0) {

    $qks = array ('name', 'type');
    $qs = array_filter (array_combine ($qks, array_map (function ($q) { return $this->input_get ($q); }, $qks)), function ($t) { return is_numeric ($t) ? true : $t; });
    $temp = array_slice ($qs, 0);
    array_walk ($temp, function (&$v, $k) { $v = $k . '=' . $v; });
    $q = implode ('&amp;', $temp);

    $temp = array_slice ($qs, 0);
    array_walk ($temp, function (&$v, $k) { $v = in_array ($k, array ('name')) ? ($k . ' LIKE ' . DinTaoInfo::escape ('%' . $v . '%')) : ($k . ' = ' . DinTaoInfo::escape ($v)); });
    $conditions = array (implode (' AND ', $temp));

    $limit = 10;
    $total = DinTaoInfo::count (array ('conditions' => $conditions));
    $offset = $offset < $total ? $offset : 0;

    $this->load->library ('pagination');
    $pagination_config = array (
      'total_rows' => $total,
      'num_links' => 5,
      'per_page' => $limit,
      'base_url' => base_url (array ('admin', 'din_tao_infos', '%s', $q ? '?' . $q : '')),
      'uri_segment' => $offset ? 3 : 0,
      'page_query_string' => false,
      'first_link' => '第一頁', 'last_link' => '最後頁', 'prev_link' => '上一頁', 'next_link' => '下一頁',
      'full_tag_open' => '<ul class="pagination">', 'full_tag_close' => '</ul>', 'first_tag_open' => '<li>', 'first_tag_close' => '</li>',
      'prev_tag_open' => '<li>', 'prev_tag_close' => '</li>', 'num_tag_open' => '<li>', 'num_tag_close' => '</li>',
      'cur_tag_open' => '<li class="active"><a href="#">', 'cur_tag_close' => '</a></li>',
      'next_tag_open' => '<li>', 'next_tag_close' => '</li>', 'last_tag_open' => '<li>', 'last_tag_close' => '</li>',
      );

    $this->pagination->initialize ($pagination_config);
    $pagination = $this->pagination->create_links ();

    $din_tao_infos = DinTaoInfo::find ('all', array ('offset' => $offset, 'limit' => $limit, 'order' => 'id DESC', 'conditions' => $conditions));

    $message = identity ()->get_session ('_flash_message', true);

    $this->load_view (array ('message' => $message, 'pagination' => $pagination, 'din_tao_infos' => $din_tao_infos, 'qs' => $qs));
  }
}
