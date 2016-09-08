<div class="albums view">
<h2><?php echo __('Album'); ?></h2>
	<dl>

		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($album['Album']['title']); ?>
			&nbsp;
		</dd>
    <dt><?php echo __('Image'); ?></dt>
    <dd>
      <?php  echo $this->Html->image($album['Album']['image_path'], array('alt' => 'CakePHP')); ?>
      &nbsp;
    </dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Album'), array('action' => 'edit', $album['Album']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Album'), array('action' => 'delete', $album['Album']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $album['Album']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Albums'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Album'), array('action' => 'add')); ?> </li>
	</ul>
</div>
