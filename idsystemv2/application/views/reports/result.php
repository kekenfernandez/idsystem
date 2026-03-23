<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-flex justify-content-between align-items-center">
    <h1 class="h3 mb-4 text-gray-800"> <?= strtoupper($page_title); ?></h1>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary"> <i class="fas fa-table"></i> </h6>
          <div id="data-buttons">
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-sm" id="datatable-attendance" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th> Name </th>
                  <th> <?= ($role == 'student') ? 'Grade & Section' : 'Role'; ?> </th>
                  <th> Login </th>
                  <th> Logout </th>
                  <th> Date </th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($results as $result):?>
                <tr>
                  <td> <?= $result['full_name']; ?> </td>
                  <td>
                    <?= ($result['role'] == 'student') ? $result['grade_level'].' - '.$result['section_name'] : 'Employee'; ?>
                  </td>
                  <td> <?= $result['login']; ?> </td>
                  <td> <?= $result['logout']; ?> </td>
                  <td> <?= $result['date']; ?> </td>
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