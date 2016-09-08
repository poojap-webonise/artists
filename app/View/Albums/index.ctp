<div class="albums index">
	<h2><?php echo __('Albums'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
    <?php //if($albums['sessionData']['role'] == 2)
          {?>
			      <th class="actions"><?php echo __('Actions'); ?></th>
    <?php } ?>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($albums['getAlbumsByUserid'] as $album): ?>
	<tr>
		<td><?php echo h($album['Album']['id']); ?>&nbsp;</td>

		<td><?php echo h($album['Album']['title']); ?>&nbsp;</td>
    <?php if($albums['sessionData']['role'] == 2)
    { ?>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $album['Album']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $album['Album']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $album['Album']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $album['Album']['id']))); ?>
		</td>
    <?php }
    else{?>
    <td class="actions">
      <?php echo $this->Html->link(__('View'), array('action' => 'view', $album['Album']['id'])); ?></td>
  <?php  }?>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
    <?php if($albums['sessionData']['role'] == 2) { ?>
		<li><?php echo $this->Html->link(__('New Album'), array('action' => 'add')); ?></li>
    <?php } ?>
	</ul>
</div>
