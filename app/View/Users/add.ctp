<div class="users form">
<?php echo $this->Form->create('User',array('id'=>'user-form')); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username',array('id'=>'username'));
		echo $this->Form->input('password',array('id'=>'pwd'));
		echo $this->Form->input('first_name',array('id'=>'fname'));
		echo $this->Form->input('last_name',array('id'=>'lname'));
    echo $this->Form->input('email',array('id'=>'email'));
    echo $this->Form->input('role',array('type'=>'hidden','value'=>2));
	?>
	</fieldset>
<?php
$options = array(
  'label' => 'Submit',
  'id' => 'submit',
  'onclick' => 'validate()'
);
echo $this->Form->end($options); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Albums'), array('controller' => 'albums', 'action' => 'index')); ?> </li>
	</ul>
</div>
<script type="text/javascript">

  function validate()
  {
    var email = document.getElementById('email').value;
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (re.test(email))
    {
      $("#user-form").submit();
    }
    else{
      alert('Invalid Email Id');
      return false;
    }
  }

</script>