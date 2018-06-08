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
  <style>
  .modal .table > tbody > tr > td{padding:3px 8px;}
  .modal-body {padding: 5px 15px;}
  .form-group{margin-bottom: 5px;}
  .modal table input[type="radio"]{margin:0 auto!important;display: block;}
  </style>
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
      Papers Details
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Papers</a></li>
      <li class="active">Papers List</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Total Papers</h3>
            <small>(<?php if(isset($data['msg'])){echo '0';}else{echo count($data);}?>)</small>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="papers_list" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Paper ID</th>
                <th>Paper Title</th>
                <th>Paper Track</th>
                <th>Track Title</th>
                <th>Papers</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                <?php
                  if(!isset($data['msg'])){
                    foreach ($data as $key => $value) { ?>
                      <tr>
                        <td><?php echo $value['paper_id'];?></td>
                        <td class='paper_title'><?php echo ucwords($value['paper_title']);?></td>
                        <td><?php echo ucwords($value['track_short_name']);?></td>
                        <td><?php echo ucwords($value['title_name']);?></td>
                        <td><a href="<?php echo base_url().$value['blind_paper'];?>">View</a></td>
                        <td><a class="review" href="<?php echo $value['assignment_id'];?>">Review</a></td>
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
  <div class="modal" id="review">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">×</span></button>
           <h4 class="modal-title"></h4>
         </div>
         <form id="paperReviewForm" action='<?php echo base_url($_SESSION["conf"]."/reviewer/submitReview");?>'>
             <div class="modal-body">
			<div class="form-group">
				<table class="table table-hover authReview">
					<thead>
						<tr>
							<th>Review Scale</th>
							<th>Poor</th>
							<th>Average</th>
							<th>Good</th>
							<th>Very Good</th>
							<th>Excellent</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Innovative Concept</td>
							<td><input type="radio" name="innovative_concept" value="1"></td>
							<td><input type="radio" name="innovative_concept" value="2"></td>
							<td><input type="radio" name="innovative_concept" value="3"></td>
							<td><input type="radio" name="innovative_concept" value="4"></td>
							<td><input type="radio" name="innovative_concept" value="5"></td>
						</tr>
						<tr>
							<td>Content content_origionality</td>
							<td><input type="radio" name="content_origionality" value="1"></td>
							<td><input type="radio" name="content_origionality" value="2"></td>
							<td><input type="radio" name="content_origionality" value="3"></td>
							<td><input type="radio" name="content_origionality" value="4"></td>
							<td><input type="radio" name="content_origionality" value="5"></td>
						</tr>
						<tr>
							<td>Technicality</td>
							<td><input type="radio" name="technicality" value="1"></td>
							<td><input type="radio" name="technicality" value="2"></td>
							<td><input type="radio" name="technicality" value="3"></td>
							<td><input type="radio" name="technicality" value="4"></td>
							<td><input type="radio" name="technicality" value="5"></td>
						</tr>
						<tr>
							<td>Structured Organization of Paper</td>
							<td><input type="radio" name="structure" value="1"></td>
							<td><input type="radio" name="structure" value="2"></td>
							<td><input type="radio" name="structure" value="3"></td>
							<td><input type="radio" name="structure" value="4"></td>
							<td><input type="radio" name="structure" value="5"></td>
						</tr>
						<tr>
							<td>References</td>
							<td><input type="radio" name="reference" value="1"></td>
							<td><input type="radio" name="reference" value="2"></td>
							<td><input type="radio" name="reference" value="3"></td>
							<td><input type="radio" name="reference" value="4"></td>
							<td><input type="radio" name="reference" value="5"></td>
						</tr>
						<tr>
							<td>lang_grammer & Grammar</td>
							<td><input type="radio" name="lang_grammer" value="1"></td>
							<td><input type="radio" name="lang_grammer" value="2"></td>
							<td><input type="radio" name="lang_grammer" value="3"></td>
							<td><input type="radio" name="lang_grammer" value="4"></td>
							<td><input type="radio" name="lang_grammer" value="5"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="form-group">
				<label for="name">General Remark:</label>
				<div>
					<textarea class="form-control" name="gen_remarks" placeholder="General Remark" required></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="AuthRemark">Remark to Authors:</label>
				<div>
					<textarea class="form-control" name="author_remarks" placeholder="Remark to Authors" required></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="AuthRemark">Review Paper:</label>
				<div class="reviewWrapper">
					<label><input type="radio" name="status" value="1"> Accept</label>&nbsp;
					<label><input type="radio" name="status" value="2"> Accept with Modification</label>&nbsp;
					<label><input type="radio" name="status" value="3"> Reject</label>
				</div>
			</div>
			<input type="hidden" name="assignment_id" id="assignment_id">

	        </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" id='submit_review' class="btn btn-primary">Save changes</button>
              </div>
          </form>
       </div>
       <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
   </div>
</div>
<!-- /.content-wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<?php include_once('includes/footer.php'); ?>
</div>
<!-- ./wrapper -->

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
<script>



</script>
</body>
</html>
