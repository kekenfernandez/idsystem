<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"> <?= strtoupper($page_title); ?> </h1>

  <div class="row">
    <div class="col-md-8">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary"> Grade and Section Information </h6>
        </div>
        <div class="card-body">
          <?= validation_errors(); ?>
          <?= form_open('sections/create', 'autocomplete="off"');?>

          <div class="form-group">
            <label for="grade"> Grade Level </label>
            <select class="form-control" id="grade" name="grade" required>
              <option disabled selected> ----- Choose Grade Level ------ </option>
              <option value="Nursery"> Nursery </option>
              <option value="Kindergarten 1"> Kindergarten 1 </option>
              <option value="Kindergarten 2"> Kindergarten 2</option>
              <option value="Grade 1"> Grade 1 </option>
              <option value="Grade 2"> Grade 2 </option>
              <option value="Grade 3"> Grade 3 </option>
              <option value="Grade 4"> Grade 4 </option>
              <option value="Grade 5"> Grade 5 </option>
              <option value="Grade 6"> Grade 6 </option>
              <option value="Grade 7"> Grade 7 </option>
              <option value="Grade 8"> Grade 8 </option>
              <option value="Grade 9"> Grade 9 </option>
              <option value="Grade 10"> Grade 10 </option>
            </select>
          </div>

          <div class="form-group">
            <label for="section"> Section Name </label>
            <input type="text" class="form-control" id="section" name="section" required>
          </div>
          <hr>
          <div>
            <button type="submit" class="btn btn-success btn-icon-split">
              <span class="icon text-white-100">
                <i class="fas fa-save"></i>
              </span>
              <span class="text"> Save </span>
            </button>
            <a href="<?= base_url('sections/index'); ?>" class="btn btn-secondary btn-icon-split">
              <span class="icon text-white-100">
                <i class="fas fa-ban"></i>
              </span>
              <span class="text"> Cancel </span>
            </a>
          </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>

</div>