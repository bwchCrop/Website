<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="refresh" content="900;url=<?php echo base_url('admin-log-out');?>" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title><?php echo $titlebar;?></title>

  <link rel="shortcut icon" href="<?php echo base_url(_FAVICON);?>" type="image/x-icon">
  <link rel="icon" href="<?php echo base_url(_FAVICON);?>" type="image/x-icon">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/dist/css/AdminLTE.min.css');?>">
</head>
<body class="hold-transition lockscreen" style="background: <?php echo 'url('.base_url()._ADMINWALL.')';?> ; background-position-x : -65px;">
  <div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
      <a href="#"><b style="color: #FFF;">Admin </b><img src="<?php echo _WEBLOGO;?>" style="width: 30%;" /></a>
    </div>

    <div style="padding: 0px 10%;">
      <?php echo $this->session->flashdata('message'); ?>
    </div>

    <div class="lockscreen-name"><?php echo $this->session->userdata(_PREFIX.'name');?></div>

    <div class="lockscreen-item">
      <div class="lockscreen-image">
        <img src="<?php echo $this->session->userdata(_PREFIX.'photo');?>" alt="User Image">
      </div>
      <form class="lockscreen-credentials" action="<?php echo base_url('admin-do-login');?>" method="post">
        <div class="input-group">
          <input type="hidden" name="username" value="<?php echo $this->session->userdata(_PREFIX.'username');?>">
          <input type="password" name="password" class="form-control" placeholder="password">

          <div class="input-group-btn">
            <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
          </div>
        </div>
      </form>
    </div>

    <div class="help-block text-center">
      Enter your password to retrieve your session
    </div>
    <div class="text-center">
      <a href="<?php echo base_url('admin-log-out');?>">Or sign in as a different user</a>
    </div>
  </div>
</body>
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<script>
  jQuery(document).ready(function() {       
        $('#message').fadeOut(3500); 
    });
</script>
</html>
