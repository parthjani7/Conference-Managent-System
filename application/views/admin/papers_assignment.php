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
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/main.css">
<style>
.select2{width:60%;float:left;margin-right:5px;}
.assign_paper{padding: 4px 15px;}
</style>
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
      Assigned Papers
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Home</li>
      <li> Papers</li>
      <li>Assigned Papers</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
             <form method='post' id="form_assign">
               <div class="box-header">
                 <h3 class="box-title">Total Papers</h3>
                 <small>(<?php if(isset($data['msg'])){echo '0';}else{echo count($data);}?>)</small>
                 <div class="col-md-6 pull-right">
                    <div class="form-group">
                        <select class="form-control select2" required name="reviewrs">
                            <option value=''>Select Option</option>
                            <option value='0'>-- UNASSIGN FROM ALL --</option>
                            <?php
                            if(!isset($reviewrs['msg'])){
                            foreach($reviewrs as $result){ ?>
                              <option value="<?php echo $result['id']; ?>"><?php echo $result['fullname']; ?></option>
                            <?php } } ?>
                        </select>
                        <button type='submit' class='btn btn-success assign_paper' value='submit' name='submit'>Assign</button>
                        <button type='submit' class='btn btn-warning assign_paper' value='submit' name='unassign'>Unassign</button>
                    </div>
                 </div>
               </div>
               <?php
               if(isset($status['unassigned'])){?>
                    <div class="callout callout-success"><p>Papers Unassigned Successfully..!</p></div>
               <?php }else if(isset($status['assigned'])){ ?>
                    <div class="callout callout-success"><p>Papers Assigned Successfully..!</p></div>
               <?php }else if(isset($status['error'])){ ?>
                    <div class="callout callout-warning"><p><?php echo $status['error'];?></p></div>
               <?php }
                ?>
               <!-- /.box-header -->
               <div class="box-body">
                 <table id="papers_list" class="table table-bordered table-hover">
                   <thead>
                   <tr>
                      <th><input type="checkbox" class="minimal" id="check_all"></th>
                     <th>Paper ID</th>
                     <th>Track Name</th>
                     <th>Track Title</th>
                     <th>Paper Title</th>
                     <th>Author Name</th>
                     <th>Papers</th>
                     <th>Total Assign</th>
                     <th>Date-Time</th>
                   </tr>
                   </thead>
                   <tbody>
                     <?php
                       if(!isset($data['msg'])){
                         foreach ($data as $key => $value) { ?>
                           <tr>
                              <td><input type="checkbox" name='papers[]' value='<?php echo $value['pid'];?>' class="minimal papers"></td>
                             <td><?php echo $value['paper_id'];?></td>
                             <td><?php echo ucwords($value['track_name']);?></td>
                            <td><?php echo ucwords($value['title_name']);?></td>
                            <td><?php echo ucwords($value['paper_title']);?></td>
                             <td><?php echo ucwords($value['author_names']);?></td>
                             <td><a href="<?php echo base_url().$value['original_paper'];?>">Original</a><br/>
                               <a href="<?php echo base_url().$value['blind_paper'];?>">Blind</a></td>
                             <td><?php echo $value['total_assign'];?></td>
                             <td><?php echo $value['date'];?></td>
                           <tr>
                         <?php }
                       }
                     ?>
                   </tbody>
                 </table>
               </div>
               <!-- /.box-body -->
            </form>
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
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $("#example2").DataTable();
  $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue'
    });

    $('#check_all').on('ifChecked', function (event) {
        $('.minimal').iCheck('check');
   });
    $('#check_all').on('ifUnchecked', function (event) {
        $('.minimal').iCheck('uncheck');
   });
   $('#form_assign').on('submit',function(e){
        if(!$('.papers').iCheck('update')[0].checked){
             alert('Please Select at least one Paper');
             e.preventDefault();
        }
   })
</script>
</body>
</html>
