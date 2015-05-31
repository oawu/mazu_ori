<?php
  if ($groups) {
    foreach ($groups as $title => $links) { ?>
      <div class='side'>
        <div class='title'><?php echo $title;?></div>
        <div class='links'>
    <?php if ($links) {
            foreach ($links as $text => $link) { ?>
              <a href='<?php echo $link;?>' class='active'><?php echo $text;?></a>
      <?php }
          } ?>
        </div>
      </div>
<?php
    }
  }
