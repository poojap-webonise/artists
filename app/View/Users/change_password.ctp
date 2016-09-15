<div class="users form">
  <?php //echo $this->Flash->render('auth'); ?>
  <?php echo $this->Form->create('User'); ?>
  <fieldset>
    <?php echo $this->Form->input('password',array('id'=>'n_pwd'));
    echo $this->Form->input('confirm_password',array('id'=>'c_pwd'));
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

<script type="text/javascript">

  function validate()
  {
    var n_pwd = document.getElementById('n_pwd').value;
    var c_pwd = document.getElementById('c_pwd').value;
    if(n_pwd != c_pwd)
    {
      alert("Password doesn't match");
      return false;
    }
  }

</script>