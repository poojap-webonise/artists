<div class="albums view">
<h2><?php echo __('Album'); ?></h2>
	<dl>

		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($album[0]['Album']['title']); ?>
			&nbsp;
		</dd>
    <dt><?php echo __('Image'); ?></dt>
    <?php foreach($album as $photoval)
    { ?>
      <dd>
        <?php  echo $this->Html->image($photoval['Photo']['image_path'], array('alt' => 'CakePHP')); ?>
        &nbsp;
      </dd>
      </br>
      </br>
    <?php }?>

	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Album'), array('action' => 'edit', $album[0]['Album']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Album'), array('action' => 'delete', $album[0]['Album']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $album[0]['Album']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Albums'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Album'), array('action' => 'add')); ?> </li>
	</ul>
</div>
