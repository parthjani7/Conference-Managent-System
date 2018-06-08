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
      Track Settings
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Home</li>
      <li> Settings</li>
      <li> Track Settings</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="form box-body">
               <script>
               var urlPart=window.location.hash.substr(1);
               switch(urlPart){
                    case 'delete_error':
                         document.write('<div class="callout callout-warning"><p>Error, Title of the Track is already being used, Track cannot be deleted..!</p></div>')
                         break;
                    case 'deleted':
                         document.write('<div class="callout callout-success"><p>Track has been Deleted..!</p></div>')
                         break;
               }
               </script>
                    <?php if(isset($data['msg'])){
                      echo "<div class='callout callout-warning'><p>Record not Found..!</p></div>";
                 }else{?>
                           <h3>Existing Tracks</h3>
                      <table id="papers_list" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                          <th>Track Name</th>
                          <th>Full Track Name</th>
                          <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php
                              foreach ($data as $key => $value) { ?>
                                <tr>
                                  <td class='track_value'><?php echo ucwords($value['track_short_name']);?></td>
                                  <td class='track_value'><?php echo ucwords($value['track_name']);?></td>
                                  <td><a class="add_titles" href="<?php echo $value['track_id']; ?>">Add Titles</a> | <a href="edit_track/<?php echo $value['track_id']; ?>">Edit</a> | <a class="delete_record" href="delete_track/<?php echo $value['track_id']; ?>">Delete</a></td>
                                <tr>
                              <?php
                            }
                          ?>
                        </tbody>
                      </table>
               <?php } ?>
               <h3>Enter New Track</h3>
                   <form method="post" action="add_track">
                       <div class="form-group has-feedback">
                            <label>Short Name</label>
                           <input type="text" class="form-control" placeholder="Short Name" name="track_short_name"  required>
                           <span class="help-block">(i.e. Track A or Track 1)</span>
                      </div>
                      <div class="form-group has-feedback">
                           <label>Full Name</label>
                          <input type="text" class="form-control" placeholder="Full Track Name" name="track_name"  required>
                          <span class="help-block">(i.e. Artificial Intelligence & Soft Computing )</span>
                     </div>
                      <input type='hidden' name='conf_id' value="<?php echo $conf_id; ?>">
                       <div class="row">
                           <div class="col-xs-12 col-md-3 col-sm-4">
                               <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block btn-flat">Submit Tack</button>
                           </div>
                       </div>
                   </form>
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

     <div class="modal" id="add_title_modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
                <h3>Existing Titles</h3>
                <table id="title_list" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Title Name</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <form method="post" id="add_title_form">
                     <div class="form-group has-feedback">
                         <input type="text" class="form-control" placeholder="Enter Title" id="title_name">
                    </div>
                    <input type='hidden' id='track_id'>
                    <button type="button" id="add_title" value="submit" class="btn btn-success btn-flat">Add Title</button>
               </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
     <!-- /.modal-dialog -->
     </div>
<!-- /.modal -->

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
$('.add_titles').click(function(e){
     var track_id=$(this).attr('href');
     var track_name=$(this).closest('tr').find('td.track_value').html();
     $('#add_title_modal .modal-title').html(track_name);
     $('#add_title_modal #track_id').val(track_id);
     $.ajax({
          url:'<?php echo base_url()."admin/TitleList/"?>'+track_id,
          success:function(data){
               var parse=jQuery.parseJSON(data);
               if (parse.fail!='0'){
                     var str='';
                     $.each(parse, function(index,value){
                        str+="<tr><td>"+value.title_name+"</td><td><a href='"+value.title_id+"' class='delete_title'>delete</a></td></tr>"
                     });
                      $('#title_list tbody').html(str);
               }else{
                   $('#title_list tbody').html('');
              }
              $('#add_title_modal').modal('show');
              initiateDelete();
          }
     });
     e.preventDefault();
});
$('#add_title').click(function(){
     var track_id=$('#track_id').val();
     var title_name=$('#title_name').val();
     $.ajax({
          url:'<?php echo base_url()."admin/addTitle/"?>',
          type:'post',
          data:{'track_id':track_id,'title_name':title_name},
          success:function(data){
               $('#add_title_form')[0].reset();
               var parse=jQuery.parseJSON(data);
              if(parse.success=='1'){
                   $('#title_list tbody').append('<tr><td>'+title_name+'</td><td><a href='+parse.title_id+' class="delete_title">delete</a></td></tr>');
              }else{
                   alert('Error while insertion, Try Later');
              }
              initiateDelete();
          }
     });
});
function initiateDelete(){
     $('.delete_title').click(function(e){
          var context=$(this);
          var title_id=context.attr('href');
          $.ajax({
               url:'<?php echo base_url()."admin/removeTitle/"?>',
               type:'post',
               data:{'title_id':title_id},
               success:function(data){
                    console.info(data);
                   if(data=='1'){
                        context.closest('tr').remove();
                   }else{
                        alert('Title cannot be deleted, Paper has been uploaded for this title.');
                   }
               }
          });
          e.preventDefault();
     });
}
</script>
</body>
</html>
