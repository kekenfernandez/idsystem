<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-flex justify-content-between align-items-center">
    <h1 class="h3 mb-4 text-gray-800"> <?= strtoupper($page_title); ?> </h1>
    <?php $this->load->view('sms/sms-alerts'); ?>
  </div>
  <div class="row">
    <div class="col">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary"> Create SMS for Students </h6>
          <div id="data-buttons">
          </div>
        </div>
        <div class="card-body">
          <?=form_open('sms/student_send') ?>
          <div class="form-group">
            <label for="send_to"> To: </label>
            <select name="send_to[]" id="send_to" class="form-control js-select" multiple="multiple" required>
              <option value="all"> All Students </option>
              <optgroup label="Students">
                <?php foreach($users as $user) :?>
                <option value="<?=$user['full_name'].'_'.$user['contact_number']?>"> <?= $user['full_name']; ?></option>
                <?php endforeach;?>
              </optgroup>
            </select>
          </div>
          <div class="form-group">
            <label for="message"> Message: </label>
            <textarea name="message" id="message" cols="30" rows="5" class="form-control" required></textarea>
          </div>
          <div class="form-group d-flex justify-content-between align-items-center">
            <div class="buttons">
              <button type="submit" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-100">
                  <i class="fas fa-paper-plane"></i>
                </span>
                <span class="text"> Create </span>
              </button>
              <a href="<?= site_url('sms/students'); ?>" class="btn btn-secondary btn-icon-split">
                <span class="icon text-white-100">
                  <i class="fas fa-ban"></i>
                </span>
                <span class="text">Clear</span>
              </a>
            </div>
            <div id="character-counter">
              <span id="typed-characters"> 0 </span> / <span id="maximum-characters"> 150 </span>
            </div>
          </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->