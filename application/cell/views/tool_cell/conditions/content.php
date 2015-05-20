<form action='<?php echo $search_url;?>' method='get'>
  <div class='conditions'>
    <div class='l'>
<?php if ($types = Cfg::setting ('din_tao_info', 'types')) { ?>
        <label for='type'>類型:
          <select id='type' name='type'>
            <option value=''>全部</option>
      <?php foreach ($types as $key => $type) { ?>
              <option value='<?php echo $key;?>'<?php echo isset ($qs['type']) && $qs['type'] == $key ? ' selected' : '';?>><?php echo $type;?></option>
      <?php } ?>
          </select>
        </label>
<?php } ?>
      <input type='text' name='name' value='<?php echo isset ($qs['name']) ? $qs['name'] : '';?>' placeholder='關鍵字..' />
      <button type='submit'>尋找</button>
    </div>
    <div class='r'>
      <a class='new' href='<?php echo $new_url;?>'>新增</a>
    </div>
  </div>
</form>
