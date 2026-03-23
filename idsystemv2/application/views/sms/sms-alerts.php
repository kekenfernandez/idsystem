<?php if($this->session->flashdata('sms_created')): ?>
<div class="alert alert-success alert-sm" role="alert">
  <?= $this->session->flashdata('sms_created') ;?>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('sms_error')): ?>
<div class="alert alert-danger alert-sm" role="alert">
  <?= $this->session->flashdata('sms_error') ;?>
</div>
<?php endif; ?>