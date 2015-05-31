<?php echo render_cell ('admin_frame_cell', 'header', array ()); ?>

<div class='center'>
  <div class='left'>
<?php echo render_cell ('admin_frame_cell', 'side', array ()); ?>
  </div>
  <div class='right'>

<?php
    if (isset ($message) && $message) { ?>
      <div class='info'><?php echo $message;?></div>
<?php
    } ?>

<?php echo render_cell ('tool_cell', 'conditions', $qs, base_url ('admin', 'din_tao_infos'), base_url ('admin', 'din_tao_infos', 'add')); ?>

    <table class='table-list'>
      <thead>
        <tr>
          <th width='60'>ID</th>
          <th width='150'>名稱</th>
          <th width='100'>類型</th>
          <th width='80'>封面</th>
          <th >內容</th>
          <th width='120'>編輯/刪除</th>
        </tr>
      </thead>
      <tbody>
    <?php
        if ($din_tao_infos) {
          $types = Cfg::setting ('din_tao_info', 'types');
          foreach ($din_tao_infos as $din_tao_info) { ?>
            <tr>
              <td><?php echo $din_tao_info->id;?></td>
              <td><?php echo $din_tao_info->name;?></td>
              <td><?php echo $types[$din_tao_info->type];?></td>
              <td><?php echo img ($din_tao_info->cover->url ('50x50c'));?></td>
              <td><?php echo mb_strimwidth (remove_ckedit_tag ($din_tao_info->content), 0, 100, '…','UTF-8');?></td>
              <td class='edit'>
                <a href='<?php echo base_url ('admin', 'din_tao_infos', 'edit', $din_tao_info->id);?>'><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32"><path fill="#444444" d="M12 20l4-2 14-14-2-2-14 14-2 4zM9.041 27.097c-0.989-2.085-2.052-3.149-4.137-4.137l3.097-8.525 4-2.435 12-12h-6l-12 12-6 20 20-6 12-12v-6l-12 12-2.435 4z"></path></svg></a>
                /
                <a href='<?php echo base_url ('admin', 'din_tao_infos', 'destroy', $din_tao_info->id);?>'><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32"><path fill="#444444" d="M4 10v20c0 1.1 0.9 2 2 2h18c1.1 0 2-0.9 2-2v-20h-22zM10 28h-2v-14h2v14zM14 28h-2v-14h2v14zM18 28h-2v-14h2v14zM22 28h-2v-14h2v14z"></path><path fill="#444444" d="M26.5 4h-6.5v-2.5c0-0.825-0.675-1.5-1.5-1.5h-7c-0.825 0-1.5 0.675-1.5 1.5v2.5h-6.5c-0.825 0-1.5 0.675-1.5 1.5v2.5h26v-2.5c0-0.825-0.675-1.5-1.5-1.5zM18 4h-6v-1.975h6v1.975z"></path></svg></a>
              </td>
            </tr>
    <?php }
        } else { ?>
          <tr><td colspan='6'>目前沒有任何資料。</td></tr>
    <?php
        } ?>
      <tbody>
    </table>

<?php echo render_cell ('tool_cell', 'pagination', $pagination); ?>

  </div>
</div>

<?php echo render_cell ('admin_frame_cell', 'footer', array ()); ?>
