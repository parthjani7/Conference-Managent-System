<!DOCTYPE html>
<html>

     <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <title>Author | Dashboard</title>
         <!-- Tell the browser to be responsive to screen width -->
         <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
         <!-- Bootstrap 3.3.6 -->
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
         <!-- Font Awesome -->
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/font-awesome.min.css">
         <!-- Ionicons <link rel="stylesheet" href="<?php echo base_url(); ?>assets/https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">-->
         <!-- Theme style -->
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
         <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
         <!-- iCheck -->
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/flat/blue.css">
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/main.css">
         <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]> <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script> <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> <![endif]-->
     </head>

     <body class="hold-transition skin-blue sidebar-mini">
         <div class="wrapper">
             <?php include_once( 'includes/header.php'); ?>
             <!-- Left side column. contains the logo and sidebar -->
             <?php include_once( 'includes/sidebar.php'); ?>
             <!-- Content Wrapper. Contains page content -->
             <div class="content-wrapper">
                 <!-- Content Header (Page header) -->
                 <section class="content-header">
                     <h1> New Submission </h1>
                     <ol class="breadcrumb">
                         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a>
                         </li>
                         <li><a href="#"><i class="fa fa-user"></i> New Submission</a>
                         </li>
                    </ol>
                 </section>
                 <!-- Main content -->
                 <section class="content">
                     <div class="row">
                         <div class="col-xs-12">
                             <div class="box box-warning">
                                 <div class="form box-body">
                                      <?php
                                        if(isset($error['op_error'])){ ?>
                                             <div class="callout callout-warning"><p><?php echo $error['op_error']; ?></p></div>
                                        <?php }else if(isset($error['bl_error'])){ ?>
                                             <div class="callout callout-warning"><p><?php echo $error['bl_error']; ?></p></div>
                                        <?php }else if(isset($error['exists'])){ ?>
                                             <div class="callout callout-warning"><p><?php echo $error['exists']; ?></p></div>
                                        <?php }
                                      ?>
                                      <form method="post" enctype="multipart/form-data">
                                           <div class="form-group has-feedback">
                                               <label>Paper Title</label>
                                               <input type="text" class="form-control" placeholder="Paper Title" name="papertitle" required> <span class="fa fa-file form-control-feedback"></span> </div>
                                           <div class="form-group has-feedback">
                                               <label>Author's Name(Comma Separated)</label>
                                               <input type="text" class="form-control" placeholder="Author Name" name="author" required> <span class="fa fa-user form-control-feedback"></span>
                                                 <span class="help-block">(i.e. Author1, Author2)</span></div>
                                           <div class="form-group">
                                               <label>Paper Track</label>
                                               <select class="form-control track_list" required name="track">
                                                 <option value='' selected>Select Track</option>
                                                  <?php foreach ($data as $d) { ?>
                                                    <option value="<?php echo $d['track_id']?>"><?php echo $d['track_short_name'].' - '.$d['track_name']?></option>
                                                      <?php }?>
                                               </select>
                                           </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">Track Title</label>
                                                <select class="form-control title_list" name="title">
                                                </select>
                                            </div>

                                          <div class="form-group">
                                             <label for="exampleInputFile">Original Paper</label>
                                             <input type="file" id="opaper" name="opaper" required>
                                             <span class="help-block">(i.e. Filesize: < 10 MB | Filetype: *.Doc / *.Docx)</span>
                                          </div>
                                          <div class="form-group">
                                              <label for="exampleInputFile">Blind Paper</label>
                                              <input type="file" id="bpaper" name="bpaper" required>
                                              <span class="help-block">(i.e. Filesize: < 10 MB | Filetype: *.Doc / *.Docx)</span>
                                          </div>
                                          <div class="row">
                                              <div class="col-xs-12 col-md-3 col-sm-4">
                                                  <button type="submit" name="uploadpaper" value="uploadpaper" class="btn btn-success btn-block">Upload Paper</button>
                                              </div>
                                          </div>

                                         </form>
                                 </div>
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
             <?php include_once( 'includes/footer.php'); ?> </div>
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
         <script>
         $('.track_list').change(function(){
           var track_id=$(this).val();
           $.ajax({
             url:'<?php echo base_url()."$param/author/TitleList/"?>'+track_id,
             success:function(data){
                var parse=jQuery.parseJSON(data);
               if (parse.fail!='0'){
                 var str="<option value=''>Select Title</option>";
                 $.each(parse, function(index,value){
                    str+="<option value="+value.title_id+">"+value.title_name+"</option>"
                 });
                  $('.title_list').html(str);
               }else{
                 $('.title_list').html('');
               }
             }
           })
         });
         </script>
     </body>
</html>
