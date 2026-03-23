<?php if($this->session->flashdata('employee_created')): ?>
<div class="alert alert-success alert-sm" role="alert">
  <?= $this->session->flashdata('employee_created') ;?>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('employee_updated')): ?>
<div class="alert alert-success alert-sm" role="alert">
  <?= $this->session->flashdata('employee_updated') ;?>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('employee_update_error')): ?>
<div class="alert alert-danger alert-sm" role="alert">
  <?= $this->session->flashdata('employee_update_error') ;?>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('employee_deleted')): ?>
<div class="alert alert-danger alert-sm" role="alert">
  <?= $this->session->flashdata('employee_deleted') ;?>
</div>
<?php endif; ?>