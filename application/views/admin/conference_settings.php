<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/main.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include_once('includes/header.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php include_once('includes/sidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Conference Settings
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Home</li>
      <li> Settings</li>
      <li>Conference Settings</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
               <div class="form box-body">
                    <?php if(isset($msg)){
                      echo "<div class='callout callout-danger'><p>Record not Found..!</p></div>";
                 }else{?>
                   <form method="post">
                        <?php if(isset($success)){
                          echo "<div class='callout callout-success'><p>Success, Updates has been Saved..!</p></div>";
                     }else if(isset($error)){
                          echo "<div class='callout callout-success'><p>Error, Updates could not be  Saved..!</p></div>";
                     } ?>
                       <div class="form-group has-feedback">
                            <label>Conference Full Name</label>
                           <input type="text" class="form-control" placeholder="Conference Full Name" name="conf_name" value="<?php echo $conf_name ?>" required> <span class="fa fa-user form-control-feedback"></span>
                           <span class="help-block">(i.e. Conference on Computer and Network Administration)</span>
                      </div>
                       <div class="form-group has-feedback">
                            <label>Conference Slug/Abbraviation</label>
                           <input type="text" class="form-control" placeholder="Slug (i.e. USA)" name="conf_slug" value="<?php echo $conf_slug; ?>" required> <span class="fa fa-paragraph form-control-feedback"></span>
                           <span class="help-block">(i.e. CCNA)</span>
                      </div>
                      <div class="row">
                           <div class="col-md-6 col-sm-6">
                              <div class="form-group has-feedback">
                                   <label>Conference Start Date</label>
                                   <div class="input-group date">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input required readonly class="form-control pull-right datepicker" placeholder="Start Date" name="conf_start_date" value="<?php echo $conf_start_date; ?>" id="datepicker_start" type="text">
                                   </div>
                              </div>
                           </div>
                           <div class="col-md-6 col-sm-6">
                                <label>Conference End Date</label>
                                <div class="input-group date">
                                     <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                     <input required readonly class="form-control pull-right datepicker" placeholder="End Date" name="conf_end_date" value="<?php echo $conf_end_date; ?>" id="datepicker_end" type="text">
                                </div>
                           </div>
                      </div>
                      <input type="hidden" name="conf_id" value="<?php echo $conf_id; ?>">
                       <div class="row">
                           <div class="col-xs-12 col-md-3 col-sm-6">
                               <button type="submit" name="update" value="settings" class="btn btn-primary btn-block btn-flat">Update Settings</button>
                           </div>
                           <div class="col-xs-12 col-md-3 col-sm-6">
                               <a target='_blank' href='<?php echo base_url().$conf_slug.'/login';?>' class="btn btn-success btn-block btn-flat">Publish Conference</a>
                           </div>
                       </div>
                   </form>
                   <?php } ?>
               </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once('includes/footer.php'); ?>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
<script>

$('#datepicker_start').datepicker({
     autoclose: true,
     format: 'yyyy-mm-dd',
     calendarWeeks: true,
     startDate:new Date()
}).on('changeDate', function(e) {
     $('#datepicker_end').val('');
     $('#datepicker_end').datepicker({
        autoclose: true,
        calendarWeeks: true,
        format: 'yyyy-mm-dd',
        startDate:new Date(e.dates[0])
     });
 });
</script>
</body>
</html>
