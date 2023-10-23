<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title><?php echo $titlebar;?></title>

  <link rel="shortcut icon" href="<?php echo base_url(_FAVICON);?>" type="image/x-icon">
  <link rel="icon" href="<?php echo base_url(_FAVICON);?>" type="image/x-icon">

  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/dist/css/AdminLTE.min.css');?>">
</head>
<body class="hold-transition login-page" style="background: <?php echo 'url('.base_url()._ADMINWALL.')';?> ; background-position-x : -65px;">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b style="color: #FFF;">Admin </b><img src="<?php echo _WEBLOGO;?>" style="width: 30%;" /></a>
    </div>

    <div class="login-box-body">
      <?php echo $this->session->flashdata('message'); ?>
      <p class="login-box-msg">Enter your Username or Email</p>

      <form action="<?php echo base_url('admin-confirm-password');?>" method="post">
        <div class="form-group has-feedback">
          <input type="username" name="username" class="form-control" placeholder="Username or Email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-4">
            <button type="button" class="btn btn-primary btn-block btn-flat" onClick="javascript:history.go(-1);">Back</button>
          </div>
          <div class="col-xs-4"></div>
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Confirm</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</body>

<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
<script>
  jQuery(document).ready(function() {       
        $('#message').fadeOut(3500); 
    });
</script>
</html>
