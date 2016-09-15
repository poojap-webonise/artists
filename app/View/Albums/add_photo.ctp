<div class="albums form">
<?php echo $this->Form->create('Album',array(
  'enctype' => 'multipart/form-data'
)); ?>
	<fieldset>
		<legend><?php echo __('Add Album'); ?></legend>
	<?php
    $userSession = $this->Session->read('User');
    echo  $this->Form->input('album_id', array('type' => 'hidden','value'=> $albumData[0]['Album']['id']));

		echo $this->Form->input('title',array('value'=>$albumData[0]['Album']['title'],'readonly'=>true));

    echo  $this->Form->input('upload', array('type' => 'file'));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Albums'), array('action' => 'index')); ?></li>
	</ul>
</div>
