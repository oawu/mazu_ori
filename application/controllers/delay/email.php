<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Email extends Delay_controller {

  public function __construct () {
    parent::__construct ();
  }

  public function forgot_password () {
    $email = $this->input_post ('email');

    if ($user = User::find ('one', array ('select' => 'id, name, email, password', 'conditions' => array ('email = ?', $email)))) {
      $this->load->library ('CreateDemo');

      $password = CreateDemo::password ();
      $user->password = password ($password);

      if ($user->save ()) {
        $msg = 'Hi ' . $user->name . ',<br/><br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;系統已經幫您設定了一組新密碼，您現在可以使用這組新密碼<a href="' . base_url (array ('platform', 'login')) . '" target="_blank">登入</a>網站了。<br/><br/>這是您的新密碼: <font color="#bf242c">' . $password . '</font> 登入後記得重新設定個人密碼喔！<br/><br/><br/><font color="#666666">--</font><br/><br/><font color="#777777">' . Cfg::setting ('mail_gun', 'user', 'system', 'signature') . '</font><br/>';
        $this->load->library ('OaMailGun');

        $mail = new OaMailGun ();

        $result = $mail->sendMessage (array (
                    'from' => Cfg::setting ('mail_gun', 'user', 'system', 'name') . ' <' . Cfg::setting ('mail_gun', 'user', 'system', 'email') . '>',
                    'to' => $user->name . ' <' . $user->email . '>',
                    'subject' => Cfg::setting ('mail_gun', 'user', 'system', 'subject'),
                    'html' => $msg
                  ));
      }
    }
  }
}