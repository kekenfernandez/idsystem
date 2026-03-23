<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-flex justify-content-between align-items-center">
    <h1 class="h3 mb-4 text-gray-800"> <?= strtoupper($page_title); ?></h1>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary"> Generate Employee Report </h6>
          <div id="data-buttons">
          </div>
        </div>
        <div class="card-body">
          <?= form_open('reports/generate_employee'); ?>

          <div class="form-group">
            <label for="employees"> Select Employee </label>
            <select id="employees" class="form-control js-select" name="employees[]" multiple="multiple"
              style="width:100%" required>

              <option value="all-employees"> ALL EMPLOYEES </option>
              <optgroup label="Employees">
                <?php foreach($employees as $employee): ?>
                <option value="<?= $employee['id']?>">
                  <?= $employee['full_name']?>
                </option>
                <?php endforeach; ?>
              </optgroup>

            </select>
          </div>

          <div class="form-row">
            <div class="form-group col">
              <label for="date_from"> From </label>
              <input type="date" class="form-control" name="date_from" id="date_from" required>
            </div>
            <div class="form-group col">
              <label for="date_to"> To </label>
              <input type="date" class="form-control" name="date_to" id="date_to" required>
            </div>
          </div>

          <button type="submit" class="btn btn-primary"> Generate Report</button>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->