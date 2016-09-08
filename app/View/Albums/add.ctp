<div class="albums form">
<?php echo $this->Form->create('Album'); ?>
	<fieldset>
		<legend><?php echo __('Add Album'); ?></legend>
	<?php
    $userSession = $this->Session->read('User');
    echo  $this->Form->input('user_id', array('type' => 'hidden','value'=> $userSession['userid']));

		echo $this->Form->input('title');

		echo  $this->Form->input('image_path', array('type' => 'file'));

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
