<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $page_title; ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url("assets/admin/vendor/fontawesome-free/css/all.css"); ?>" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets/admin/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

  <!-- <link href="<?= base_url('assets/admin/vendor/datatables/dataTables.bootstrap4.css'); ?>" rel="stylesheet"> -->
  <link href="<?= base_url('assets/admin/vendor/datatables/datatables.css'); ?>" rel="stylesheet" />
  <link href="<?=base_url('assets/admin/vendor/select/css/select2.min.css'); ?>" rel="stylesheet" />
  <!-- <link type="text/css"
    href="<?= base_url('assets/admin/vendor/jquery-datatables-checkboxes/css/dataTables.checkboxes.css'); ?>"
    rel="stylesheet" /> -->
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
        <div class="sidebar-brand-text mx-3">ID System <sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?= ($url == 'dashboard') ? 'active' : '';?>">
        <a class="nav-link" href="<?= site_url('dashboard'); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <li class="nav-item <?= ($url == 'attendance') ? 'active' : '';?>">
        <a class="nav-link" href="<?= site_url('attendance'); ?>">
          <i class="far fa-calendar-check"></i>
          <span>Attendance</span></a>
      </li>

      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        User Management
      </div>
      <li class="nav-item <?= ($url == 'students') ? 'active' : '';?>">
        <a class="nav-link" href="<?= site_url('students'); ?>">
          <i class="fas fa-users"></i>
          <span>Students</span></a>
      </li>

      <li class="nav-item <?= ($url == 'employees') ? 'active' : '';?>">
        <a class="nav-link" href="<?= site_url('employees'); ?>">
          <i class="fas fa-chalkboard-teacher"></i>
          <span>Employees</span></a>
      </li>


      <li class="nav-item <?= ($url == 'sections') ? 'active' : '';?>">
        <a class="nav-link" href="<?= site_url('sections'); ?>">
          <i class="fas fa-university"></i>
          <span>Grade and Sections</span></a>
      </li>

      <hr class="sidebar-divider my-0">

      <li class="nav-item <?= ($url == 'sms') ? 'active' : '';?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSms" aria-expanded="true"
          aria-controls="collapseSms">
          <i class="fas fa-comments"></i>
          <span> SMS Blast </span>
        </a>
        <div id="collapseSms" class="collapse" aria-labelledby="smsBlast" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= site_url('sms/index'); ?>"> SMS Logs </a>
            <a class="collapse-item" href="<?= site_url('sms/all'); ?>"> Send SMS to All </a>
            <a class="collapse-item" href="<?= site_url('sms/students'); ?>"> Send SMS to Students </a>
            <a class="collapse-item" href="<?= site_url('sms/employees'); ?>"> Send SMS to Employees </a>
            <a class="collapse-item" href="<?= site_url('sms/sections'); ?>"> Send SMS to Sections </a>
          </div>
        </div>
      </li>

      <li class="nav-item <?= ($url == 'reports') ? 'active' : '';?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-table"></i>
          <span>Reports</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Generate Report by:</h6>
            <a class="collapse-item" href="<?= site_url('reports/student'); ?>"> Students </a>
            <a class="collapse-item" href="<?= site_url('reports/employee'); ?>"> Employee </a>
            <a class="collapse-item" href="<?= site_url('reports/section'); ?>"> Section </a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?= $this->session->userdata('name'); ?></span>
                <img class="img-profile rounded-circle" src="<?=base_url('assets/images/system/logo.png');?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <?php if($this->session->userdata('access') == 'superadmin'): ?>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <?php endif; ?>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->