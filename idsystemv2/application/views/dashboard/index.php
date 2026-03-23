<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"> Dashboard </h1>

  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                DAILY LOGINS</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $login_count; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                DAILY LOGOUTS</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $logout_count; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                REGISTERED STUDENTS / EMPLOYEES </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $student_count.' / '. $employee_count ; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                SMS SENT / SENDING</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $sent .'/'. $sending; ?> </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">Daily Records - <?= date('F d, Y'); ?></h6>
          <div id="data-buttons"> </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-sm" id="datatable-dashboard" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Grade & Section / Role</th>
                  <th>Login</th>
                  <th>Logout</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($daily_attendance as $attendance) : ?>
                <tr>
                  <td><?= $attendance['full_name'];?></td>
                  <td>
                    <?= ($attendance['role'] == 'student') ? $attendance['grade_level'] .'-'. $attendance['section_name'] : 'Employee'?>
                  </td>
                  <td><?= $attendance['login']; ?></td>
                  <td><?= $attendance['logout']; ?></td>
                  <td><?= $attendance['date']; ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->