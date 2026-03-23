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
          <?= form_open('sections/update', 'autocomplete="off"');?>

          <div class="form-group">
            <label for="grade"> Grade Level </label>
            <select class="form-control" id="grade" name="grade" required>
              <option disabled> ----- Choose Grade Level ------ </option>
              <option value="Nursery" <?=($section['grade_level'] == 'Nursery') ? 'selected' : ''?>> Nursery </option>
              <option value="Kindergarten 1" <?=($section['grade_level'] == 'Kindergarten 1') ? 'selected' : ''?>>
                Kindergarten
                1 </option>
              <option value="Kindergarten 2" <?=($section['grade_level'] == 'Kindergarten 2') ? 'selected' : ''?>>
                Kindergarten
                2</option>
              <option value="Grade 1" <?=($section['grade_level'] == 'Grade 1') ? 'selected' : ''?>> Grade 1 </option>
              <option value="Grade 2" <?=($section['grade_level'] == 'Grade 2') ? 'selected' : ''?>> Grade 2 </option>
              <option value="Grade 3" <?=($section['grade_level'] == 'Grade 3') ? 'selected' : ''?>> Grade 3 </option>
              <option value="Grade 4" <?=($section['grade_level'] == 'Grade 4') ? 'selected' : ''?>> Grade 4 </option>
              <option value="Grade 5" <?=($section['grade_level'] == 'Grade 5') ? 'selected' : ''?>> Grade 5 </option>
              <option value="Grade 6" <?=($section['grade_level'] == 'Grade 6') ? 'selected' : ''?>> Grade 6 </option>
              <option value="Grade 7" <?=($section['grade_level'] == 'Grade 7') ? 'selected' : ''?>> Grade 7 </option>
              <option value="Grade 8" <?=($section['grade_level'] == 'Grade 8') ? 'selected' : ''?>> Grade 8 </option>
              <option value="Grade 9" <?=($section['grade_level'] == 'Grade 9') ? 'selected' : ''?>> Grade 9 </option>
              <option value="Grade 10" <?=($section['grade_level'] == 'Gradde 10') ? 'selected' : ''?>> Grade 10
              </option>
            </select>
          </div>

          <div class="form-group">
            <label for="section"> Section Name </label>
            <input type="text" class="form-control" id="section" name="section" value="<?=$section['section_name'];?>"
              required>
            <input type="hidden" name="id" value="<?=$section['id']?>">
          </div>

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