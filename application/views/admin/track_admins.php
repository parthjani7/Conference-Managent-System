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
  <!-- Ionicons
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">-->
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
      Track Admins
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Home</li>
      <li> Track Admins</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Total Track Admins</h3>
            <small>(<?php if(isset($data['msg'])){echo '0';}else{echo count($data);}?>)</small>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
               <script>
               var urlPart=window.location.hash.substr(1);
               switch(urlPart){
                    case 'updated':
                         document.write('<div class="callout callout-success"><p>Track Admin has been Updated..!</p></div>')
                         break;
                    case 'deleted':
                         document.write('<div class="callout callout-success"><p>Track Admin has been Deleted..!</p></div>')
                         break;
               }
               </script>
            <table id="papers_list" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Track Name</th>
                <th>Gender</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                <?php
                  if(!isset($data['msg'])){
                    foreach ($data as $key => $value) { ?>
                      <tr>
                        <td><?php echo $value['fullname'];?></td>
                        <td><?php echo $value['email'];?></td>
                        <td><?php echo $value['track_short_name'];?></td>
                        <td><?php echo ($value['gender']=='0')?'Male':'Female';?></td>
                        <td><a href="track_admin_edit/<?php echo $value['id'];?>">Edit</a> | <a href="track_admin_delete/<?php echo $value['id'];?>" class='delete_record'>Delete</a></td>
                      <tr>
                    <?php }
                  }
                ?>
              </tbody>
            </table>
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
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>

</body>
</html>
