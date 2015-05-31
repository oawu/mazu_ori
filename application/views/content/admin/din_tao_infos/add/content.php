<?php echo render_cell ('admin_frame_cell', 'header', array ()); ?>

<div class='center'>
  <div class='left'>
<?php echo render_cell ('admin_frame_cell', 'side', array ()); ?>
  </div>
  <div class='right'>

<?php
    if (isset ($message) && $message) { ?>
      <div class='error'><?php echo $message;?></div>
<?php
    } ?>

    <form action='<?php echo base_url (array ('admin', 'din_tao_infos', 'create'));?>' method='post' enctype='multipart/form-data'>
      <table class='table-form'>
        <tbody>
          <tr>
            <th>名稱</th>
            <td>
              <input type='text' name='name' value='<?php echo $name;?>' placeholder='請輸入名稱..' maxlength='200' pattern='.{1,200}' required title='輸入 1~200 個字元!' />
            </td>
          </tr>
          <tr>
            <th>類型</th>
            <td>
        <?php if ($types = Cfg::setting ('din_tao_info', 'types')) { ?>
                <label for='type'>
                  <select id='type' name='type'>
                    <option value='' selected>全部</option>
              <?php foreach ($types as $key => $type_value) { ?>
                      <option value='<?php echo $key;?>'<?php echo $key === $type ? ' selected' : '';?>><?php echo $type_value;?></option>
              <?php } ?>
                  </select>
                </label>
        <?php } ?>
            </td>
          </tr>
          <tr>
            <th>封面</th>
            <td>
              <input type='file' name='cover' value='' accept="image/gif, image/jpeg, image/png" pattern='.{1,}' required title='請選擇檔案!' />
            </td>
          </tr>
          <tr>
            <th>內容</th>
            <td>
              <textarea id='content' name='content' placeholder='請輸入內容..' pattern='.{1,}' required title='輸入至少 1 個字元!' ><?php echo $content;?></textarea>
            </td>
          </tr>
          <tr>
            <td colspan='2'>
              <a href='<?php echo base_url ('admin', 'din_tao_infos');?>'>回列表</a>
              <button type='reset' class='button'>重填</button>
              <button type='submit' class='button'>確定</button>
            </td>
          </tr>
        </tbody>
      </table>
    </form>

  </div>
</div>

<?php echo render_cell ('admin_frame_cell', 'footer', array ()); ?>
