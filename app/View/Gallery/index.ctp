<button onclick="goBack()">Go Back</button>
    <?php
    foreach($album as $album)
    {
      echo '<b><i><font size="4">'.$album['Album']['title'].'</font></i></b>';

      foreach($album['Photo'] as $photoval)
      { ?>
        <dd>
          <?php  echo '</br><div align="left">'.$this->Html->image($photoval['image_path'], array('alt' => 'CakePHP')).'</div></br>'; ?>

        </dd>
        </br>
        </br>
      <?php }
    }?>
<script type="text/javascript">
  function goBack() {
    window.history.back();
  }
</script>
