<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-flex justify-content-between align-items-center">
    <h1 class="h3 mb-4 text-gray-800"> <?= strtoupper($page_title); ?> </h1>
    <?php $this->load->view('sections/section-alerts'); ?>
  </div>

  <div class="row">
    <div class="col">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary"> <i class="fas fa-university"></i>
          </h6>
          <div id="data-buttons">
            <a href="<?= base_url('sections/create'); ?>" class="btn btn-primary btn-icon-split">
              <span class="icon text-white-100">
                <i class="fas fa-plus-circle"></i>
              </span>
              <span class="text"> Add Grade & Section </span>
            </a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-sm" id="datatable-sections" width="100%" cellspacing="0">
              <thead>
                <tr>

                  <th> Grade Level </th>
                  <th> Section Name</th>
                  <th> No. of Students </th>
                  <th> Actions </th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($sections as $section): ?>
                <tr>
                  <td><?= $section['grade_level']?></td>
                  <td><?= $section['section_name']?></td>
                  <td> <?= $this->section->count_students($section['id']); ?> </td>
                  <td>
                    <a href="<?= site_url('sections/edit/'. $section['id']); ?>"
                      class="btn btn-sm btn-warning btn-icon-split">
                      <span class="icon text-white-100">
                        <i class="fas fa-edit"></i>
                      </span>
                      <span class="text"> Edit </span>
                    </a>
                    <a href="<?= site_url('sections/members/'. $section['id']); ?>" class="btn btn-sm btn-info">
                      <span class="icon text-white-100">
                        <i class="fas fa-users"></i>
                      </span>
                      <span class="text"> Members </span>
                    </a>
                    <a href="<?= site_url('sections/delete/'. $section['id']); ?>"
                      class="btn btn-sm btn-danger btn-icon-split" onclick="return confirmDelete()">
                      <span class="icon text-white-100">
                        <i class="fas fa-trash"></i>
                      </span>
                      <span class="text"> Delete </span>
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