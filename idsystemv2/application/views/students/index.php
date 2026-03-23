<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-flex justify-content-between align-items-center">
    <h1 class="h3 mb-4 text-gray-800"> <?= strtoupper($page_title); ?> </h1>
    <?php $this->load->view('students/student-alerts'); ?>
  </div>

  <div class="row">
    <div class="col">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users"></i></h6>
          <div id="data-buttons">
            <a href="<?= base_url('students/create'); ?>" class="btn btn-primary btn-icon-split">
              <span class="icon text-white-100">
                <i class="fas fa-plus-circle"></i>
              </span>
              <span class="text"> Add Student </span>
            </a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-sm" id="datatable-students" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>RFID</th>
                  <th>School ID</th>
                  <th>Name</th>
                  <th>Grade & Section</th>
                  <th>Image</th>
                  <th>Contact No.</th>
                  <th style="width: 15%">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($students as $student):?>
                <tr>
                  <td><?= $student['rfid_number']; ?></td>
                  <td><?= $student['school_id_number']; ?></td>
                  <td><?= $student['full_name']; ?></td>
                  <td><?= $student['grade_level'] .'-'. $student['section_name'];?></td>
                  <td><?=$student['image']; ?></td>
                  <td><?= $student['contact_number']; ?></td>
                  <td>
                    <a href="<?= site_url('students/view/'. $student['id']); ?>" class="btn btn-success btn-sm">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="<?= site_url('students/attendance/'.$student['id']); ?>" class="btn btn-sm btn-info">
                      <i class="fas fa-list"></i>
                    </a>
                    <a href="<?= site_url('students/delete/'. $student['id']); ?>" class="btn btn-danger btn-sm"
                      onclick="return confirmDelete()">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
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