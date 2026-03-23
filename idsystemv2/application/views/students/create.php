<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"> <?= strtoupper($page_title); ?> </h1>

  <div class="row">
    <div class="col">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary"> Personal Information </h6>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-10">
              <?= validation_errors(); ?>
              <?= form_open_multipart('students/create', 'autocomplete="off"');?>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="rfid_number">RFID Number</label>
                  <input type="text" class="form-control" id="rfid_number" name="rfid_number" value="xxxxxxxxxxx"
                    onclick="this.select()">
                  <small class="form-text text-muted">Please scan the student's ID.</small>
                </div>
                <div class="form-group col-md-6">
                  <label for="school_id_number">School ID Number</label>
                  <input type="text" class="form-control" id="school_id_number" name="school_id_number" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Fullname</label>
                  <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name'); ?>"
                    required>
                  <small class="form-text text-muted">format: LASTNAME, FIRSTNAME MI.</small>
                </div>

                <div class="form-group col-md-6">
                  <label for="contact_number">Contact Number</label>
                  <input type="text" class="form-control" id="contact_number" placeholder="format: 09xxxxxxxxx"
                    name="contact_number">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="grade_section">Grade & Section</label>
                  <select class="form-control" name="grade_section">
                    <option value=""> -- Select -- </option>
                    <?php foreach($grades as $grade): ?>
                    <option value="<?= $grade['id']; ?>"> <?= $grade['grade_level'] .'-'. $grade['section_name']; ?>
                    </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label>Image</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="userfile" onchange="preview()">
                    <label class="custom-file-label" for="image">Choose file...</label>
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                  </div>
                </div>
              </div>
              <hr>
              <div>
                <button type="submit" class="btn btn-success btn-icon-split">
                  <span class="icon text-white-100">
                    <i class="fas fa-save"></i>
                  </span>
                  <span class="text"> Save </span>
                </button>
                <a href="<?= base_url('students/index'); ?>" class="btn btn-secondary btn-icon-split">
                  <span class="icon text-white-100">
                    <i class="fas fa-ban"></i>
                  </span>
                  <span class="text"> Cancel </span>
                </a>
              </div>
              <?= form_close(); ?>
            </div>
            <div class="col-2">
              <img src="<?=base_url('assets/images/system/default.jpg');?>" alt="" class="img-thumbnail"
                id="imagePreview">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>