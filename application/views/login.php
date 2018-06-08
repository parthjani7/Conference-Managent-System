<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Conference Management System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/main.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
       <?php if(isset($param)){?>
            <h2 class="text-primary"><b>Login for Conference <?php echo strtoupper($param); ?></b></h2>
       <?php }else{ ?>
            <h2 class="text-primary"><b>Admin Login</b></h2>
       <?php }?>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
  <p class="text-danger text-center"><strong><?php if(isset($error)){echo $error; }?></strong></p>
     <?php if(isset($param)){ ?>
          <p class="login-box-msg">Sign in to start your session or <a class="Link" href="<?php echo base_url().$param;?>/registration">Sign Up</a></p>
     <?php }?>

    <form method="post" action="login">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="pass" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	  <a href="javascript:void(0)" class="text-center col-xs-12 Link">I forgot my password</a><br/><br/>
     <input type='hidden' name='conf_id' value='<?php echo $param; ?>'>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" name="submitData" class="btn btn-success btn-block" value="Sign In">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
	</form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>

<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
