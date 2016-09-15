<div class="albums form">
<?php echo $this->Form->create('Album'); ?>
	<fieldset>
		<legend><?php echo __('Edit Album'); ?></legend>
    <?php
    $userSession = $this->Session->read('User');
    echo  $this->Form->input('user_id', array('type' => 'hidden','value'=> $userSession['userid']));
    echo $this->Form->input('user_id');
    echo $this->Form->input('title',array('value'=> $album[0]['Album']['title']));

     echo __('Image');
    foreach($album as $photoval)
    { ?>
      <dd>
        <?php  echo $this->Html->image($photoval['Photo']['image_path'], array('alt' => 'CakePHP')); ?>
        &nbsp;
      </dd>
      </br>
      </br>
    <?php }?>

	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Album.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Album.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Albums'), array('action' => 'index')); ?></li>
	</ul>
</div>
