<?php if($this->session->flashdata('section_created')): ?>
<div class="alert alert-success alert-sm" role="alert">
  <?= $this->session->flashdata('section_created') ;?>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('section_updated')): ?>
<div class="alert alert-success alert-sm" role="alert">
  <?= $this->session->flashdata('section_updated') ;?>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('section_deleted')): ?>
<div class="alert alert-warning alert-sm" role="alert">
  <?= $this->session->flashdata('section_deleted') ;?>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('member_removed')): ?>
<div class="alert alert-warning alert-sm" role="alert">
  <?= $this->session->flashdata('member_removed') ;?>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('member_added')): ?>
<div class="alert alert-success alert-sm" role="alert">
  <?= $this->session->flashdata('member_added') ;?>
</div>
<?php endif; ?>