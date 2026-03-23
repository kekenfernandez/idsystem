<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="row">
    <div class="col-sm-12 col-md-12">

      <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800"> <?= $section['grade_level'] .' - '. $section['section_name']; ?> </h1>
        <?php $this->load->view('sections/section-alerts'); ?>
      </div>

      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary"> <i class="fas fa-users"></i></h6>
          <div id="data-buttons">
            <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal"
              data-target="#addMemberModal">
              <span class="icon text-white-100">
                <i class="fas fa-plus-circle"></i>
              </span>
              <span class="text"> Add Members</span>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-sm" id="datatable-sections" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th> Name </th>
                  <th style="width:30%"> Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($members as $member):?>
                <tr>
                  <td><?= $member['full_name']; ?></td>
                  <td>
                    <a href="<?= site_url('sections/remove_member/'.$member['id']) ?>"
                      class="btn btn-danger btn-sm btn-icon-split" onclick="return confirmRemove()">
                      <span class="icon text-white-100">
                        <i class="fas fa-minus"></i>
                      </span>
                      <span class="text"> Remove </span>
                    </a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- with selected users : <button type="submit" class="btn btn-primary btn-sm btn-danger"> Remove Selected -->
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

<!-- Modal -->

<div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel"
  aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addMemberModalLabel">Add Members</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('sections/add_member'); ?>
      <div class="modal-body">
        <div class="form-group">
          <label for="members"> Name Search </label>
          <select id="members" class="form-control js-select" name="members[]" multiple="multiple" style="width:100%">
            <?php foreach($students as $student): ?>
            <option value="<?= $student['id']?>"> <?= $student['full_name'];?></option>
            <?php endforeach; ?>
          </select>
          <input type="hidden" name="section_id" value="<?= $section['id']; ?>">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">
          <span class="icon text-white-100">
            <i class="fas fa-plus"></i>
          </span>
          <span class="text"> Add </span>
        </button>
        <button type="button" class="btn btn-secondary btn-icon-split" data-dismiss="modal">
          <span class="icon text-white-100">
            <i class="fas fa-ban"></i>
          </span>
          <span class="text"> Close </span>
        </button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>