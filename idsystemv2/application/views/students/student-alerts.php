<?php if($this->session->flashdata('student_created')): ?>
<div class="alert alert-success alert-sm" role="alert">
  <?= $this->session->flashdata('student_created') ;?>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('student_updated')): ?>
<div class="alert alert-success alert-sm" role="alert">
  <?= $this->session->flashdata('student_updated') ;?>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('student_update_error')): ?>
<div class="alert alert-danger alert-sm" role="alert">
  <?= $this->session->flashdata('student_update_error') ;?>
</div>
<?php endif; ?>