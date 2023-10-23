<!DOCTYPE html>
<html>
  <head>
    <?php $this->session->set_userdata(_PREFIX.'lasturl', current_url());?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $titlebar;?></title>
    <meta http-equiv="refresh" content="1800;url=<?php echo base_url('admin-log-offsession_expired');?>" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
    <?php $this->load->view('template/head_load'); ?>
  </head>

  <?php if(_CUSTOMCOLOR == TRUE){ ?>
  <style>
    .sidebar-mini .main-header .navbar {
      background-color: <?php echo _COLORADMIN; ?> !important;
    }
    .sidebar-mini .main-header .logo {
        background-color: <?php echo _COLORADMIN; ?> !important;
    }
    .sidebar-mini .main-header li.user-header {
        background-color: <?php echo _COLORADMIN; ?> !important;
    }
  </style>
  <?php } ?>

  <body class="sidebar-mini fixed <?php echo _COLORTHEME;?>" data-spy="scroll" data-target="#scrollspy">
  <div class="overlay main"><i class="fa fa-refresh fa-spin"></i></div>
  <div class="wrapper">

  <header class="main-header">
    <a href="<?php echo base_url('');;?>" class="logo">
      <span class="logo-mini"><img src="<?php echo base_url()._WEBLOGO;?>" style="max-height: 50px;"></span>
      <span class="logo-lg"><img src="<?php echo base_url()._WEBLOGO;?>" style="max-height: 50px;"></span>
    </a>

    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $this->session->userdata(_PREFIX.'photo');?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata(_PREFIX.'username');?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?php echo $this->session->userdata(_PREFIX.'photo');?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata(_PREFIX.'name');?>
                  <small><?php echo $this->session->userdata(_PREFIX.'email');?></small>
                  <?php $getGroup = $this->mgroupmenu->getIdGroup($this->session->userdata(_PREFIX.'menurole'))->row_array();?>
                  <small><?php echo 'Group Menu : '.$getGroup['groupname']; ?></small>
                </p>
              </li>

              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url('admin-account');?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('admin-log-off');?>" class="btn btn-default btn-flat"><i class="fa fa-lock"></i></a>
                  <a href="<?php echo base_url('admin-log-out');?>" class="btn btn-default btn-flat">Log out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

