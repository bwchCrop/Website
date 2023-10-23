<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Page Not Found</title>

  <link rel="shortcut icon" href="<?php echo base_url(_FAVICON);?>" type="image/x-icon">
  <link rel="icon" href="<?php echo base_url(_FAVICON);?>" type="image/x-icon">

  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/dist/css/AdminLTE.min.css');?>">
</head>
<body class="hold-transition lockscreen" style="background: <?php echo 'url('.base_url()._ADMINWALL.')';?> ; background-position-x : -65px;">
  <div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
      <a href="#"><b style="color: #FFF;">Admin </b><img src="<?php echo _WEBLOGO;?>" style="width: 30%;" /></a>
    </div>
  </div>
  <style>.headline.text-black{ margin: 0; margin-top: -20px; }</style>
  <section class="content">
    <div class="error-page">
      <h2 class="headline text-black"> 404</h2>
      <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
        <p>
          We could not find the page you were looking for.
          Meanwhile, you may 
          <?php if($this->session->userdata(_PREFIX.'login') == TRUE){ ?>
            <a href="<?php echo base_url('admin');?>">return to dashboard</a>
          <?php }else{ ?>
            <!-- <a href="<?php echo base_url('admin');?>">return to login</a> or  -->be <a href="javascript:history.go(-1);">back</a>
          <?php } ?>
        </p>
      </div>
    </div>
  </section>
</body>
</html>
