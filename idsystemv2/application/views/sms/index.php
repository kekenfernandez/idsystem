<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-flex justify-content-between align-items-center">
    <h1 class="h3 mb-4 text-gray-800"> <?= strtoupper($page_title); ?> </h1>
  </div>
  <div class="row">
    <div class="col">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary"> <i class="fas fa-comments"></i> </h6>
          <div id="data-buttons">
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-sm" id="datatable-sms" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th> Name </th>
                  <th> Number </th>
                  <th> Message </th>
                  <th> Status </th>
                  <th> Date Created </th>
                  <th> Date Sent </th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($logs as $sms) : ?>
                <tr>
                  <td> <?= $sms['name']; ?> </td>
                  <td> <?= $sms['number']; ?> </td>
                  <td> <?= $sms['content']; ?> </td>
                  <td> <?= ($sms['status'] == '1') ? 'Sent' : 'Sending' ;?> </td>
                  <td> <?= $sms['date_created']; ?> </td>
                  <td> <?= $sms['date_sent']?> </td>
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