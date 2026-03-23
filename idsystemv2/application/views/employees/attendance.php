<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-flex justify-content-between align-items-center">
    <h1 class="h3 mb-4 text-gray-800">
      <?= $employee['full_name']; ?>
    </h1>
    <?php $this->load->view('employees/employee-alerts'); ?>
  </div>

  <div class="row">
    <div class="col">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-chalkboard-teacher"></i>
          </h6>
          <div id="data-buttons">
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-sm" id="datatable-employee" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th> Date </th>
                  <th> Login </th>
                  <th> Logout </th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($attendance_records as $attendance_record):?>
                <tr>
                  <td> <?= $attendance_record['date']; ?> </td>
                  <td> <?= $attendance_record['login']; ?> </td>
                  <td> <?= $attendance_record['logout']; ?> </td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->