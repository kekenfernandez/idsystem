<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ID System | <?= $page_title;?></title>

  <link rel="stylesheet" href="<?=base_url('assets/kiosk/bootstrap5.3/css/bootstrap.css');?>">
  <link rel="stylesheet" href="<?=base_url('assets/kiosk/css/custom-style.css');?>">
  <link rel="stylesheet" href="<?=base_url('assets/kiosk/bs-font/bootstrap-icons.css');?>">
</head>

<body>

  <!-- <?php echo gethostbyname(trim(`hostname`)); ?> -->

  <div class="container-lg mt-3">
    <div class="row">
      <div class="col-6">
        <div class="card custom-border">

          <?php $image = FCPATH . 'assets/images/users/' . $current['image'];
  if(!file_exists($image)) {
      $image = base_url('assets/images/system/default.jpg');
  } else {
      $image = base_url('assets/images/users/' . $current['image']);
  }
  ?>
          <img src="<?= $image; ?>" class="card-img-top current-image" alt="...">

          <?php if($this->session->flashdata('timeInterval')): ?>
          <p class="alert alert-secondary alert-sm px-3 interval-alert">
            <?= $this->session->flashdata('timeInterval') ?> </p>
          <?php endif;?>

          <div class="card-body text-center py-2">
            <h3 class="card-title mb-1 current-name"><?= $current['full_name']; ?> </h3>
            <a href="#" class="btn btn-danger btn-sm current-time">
              <i class="bi bi-box-arrow-in-left"></i>
              OUT: <?= ($current['logout']) ? $current['logout'] : '----- --'; ?>
            </a>
          </div>
          <div class="card-footer text-center">
            <h5 class="card-text mb-0"> <em> <?= $current['date']; ?></em> </h5>
          </div>
        </div>
      </div>
      <div class="col-6 d-flex flex-column">
        <!-- Nav Here -->
        <nav class="navbar py-0 mb-3 custom-nav">
          <div class="container-fluid d-flex justify-content-center">
            <a class="navbar-brand" href="<?= base_url('gate'); ?>">
              <img src="<?=base_url('assets/images/system/logo.png');?>" alt="Logo" width="auto" height="50px"
                class="d-inline-block align-text-center">
            </a>
            <div class="text-center">
              <h4 class="m-0"> <?= $GLOBALS['SCHOOL_SHORT_NAME'];?> | Exit </h4>
            </div>
          </div>
        </nav>
        <!-- End Nav -->

        <div class="row row-cols-1 row-cols-md-3 g-3">
          <?php if(!$recents): ?>
          <?php $i = 6;
              for ($x = 1; $x <= $i; $x++) {
                  echo '<div class="col">
                  <div class="card h-100">
                    <img src="' . base_url("assets/images/system/default.jpg") . '" class="card-img-top recent-image" alt="..."
          style="">
          <div class="card-body p-2 text-center">
            <h5 class="card-title recent-card-name mb-1"> ----- </h5>
            <span class="badge text-bg-success">
              <i class="bi bi-box-arrow-in-right"></i>
              -----
            </span>
            <span class="badge text-bg-danger">
              <i class="bi bi-box-arrow-in-left"></i>
              -----
            </span>
          </div>
          <div class="card-footer p-0 text-center">
            <small class="text-body-secondary"><em>-----</em></small>
          </div>
        </div>
      </div>';
              } ?>
          <?php else:?>
          <?php foreach($recents as $recent): ?>
          <div class="col">
            <div class="card h-100">
              <?php $image = FCPATH . 'assets/images/users/' . $recent['image'];
              if(!file_exists($image)) {
                  $image = base_url('assets/images/system/default.jpg');
              } else {
                  $image = base_url('assets/images/users/' . $recent['image']);
              }
              ?>
              <img src="<?= $image; ?>" class="card-img-top recent-image" alt="..." style="">
              <div class="card-body p-1 text-center">
                <h5 class="card-title recent-card-name mb-0"><?= $recent['full_name']; ?></h5>
                <span class="badge text-bg-success recent-time">
                  <i class="bi bi-box-arrow-in-right"></i>
                  <?= $recent['login']; ?>
                </span>
                <span class="badge text-bg-danger recent-time">
                  <i class="bi bi-box-arrow-in-left"></i>
                  <?= $recent['logout']; ?>
                </span>
              </div>
              <div class="card-footer p-0 text-center recent-date">
                <small class="text-body-secondary"><em><?= $recent['date']; ?></em></small>
              </div>
            </div>
          </div>
          <?php endforeach;?>
          <?php endif; ?>
        </div>

        <div class="row mt-auto">
          <div class="col">
            <?= form_open('attendance/exit', 'id="rfidForm" autocomplete="off"'); ?>
            <input type="text" name="rfidno" id="rfidno" style="width:100%; height: 15px;" autofocus>
            <?= form_close();?>
            <div class="card bg-dark">
              <div class="card-body text-white text-center py-2 mb-0">
                <h2 class="mb-0" id="clock"> </h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="<?=base_url('assets/kiosk/bootstrap5.3/js/bootstrap.js');?>"></script>
  <script src="<?=base_url('assets/kiosk/js/jquery-3.7.0.min.js');?>"></script>

  <script>
  const body = document.querySelector("body");
  const rfid = document.querySelector("#rfidno");
  const clockDisplay = document.querySelector("#clock");

  function refreshTime() {
    var dateString = new Date().toLocaleString("en-US", {
      timeZone: "Asia/Manila",
      year: "numeric",
      month: "long",
      day: "numeric",
      hour: "numeric",
      minute: "numeric"
    });
    clockDisplay.innerHTML = dateString.toUpperCase();
  }

  setInterval(refreshTime, 10);

  body.addEventListener("click", () => {
    rfid.focus();
  });

  $(document).ready(function() {
    $("#rfidno").focus();

    var timeout;
    var delay = 400; // 1 seconds

    $('#rfidno').keyup(function(e) {
      if (timeout) {
        clearTimeout(timeout);
      }
      timeout = setTimeout(function() {
        myFunction();
      }, delay);
    });

    function myFunction() {
      $("#rfidForm").submit();
    }
  });

  setInterval(() => {
    const a = document.querySelector(".interval-alert");
    a.classList.add("hide");
  }, 4000);
  </script>
</body>

</html>