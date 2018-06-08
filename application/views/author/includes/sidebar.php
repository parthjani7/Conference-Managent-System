<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active">
        <a href="dashboard">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li>
     <a href="<?php echo base_url().$_SESSION['conf']; ?>/author/about_conference">
      <i class="fa fa-info-circle"></i> <span>About <?php echo strtoupper($_SESSION['conf']); ?></span>
     </a>
     <li>
      <li class="treeview">
        <a href="<?php echo base_url().$_SESSION['conf']; ?>/author/upload_paper">
          <i class="fa fa-file"></i> <span>New Submission</span>
        </a>
      </li>
      <li>
        <a href="<?php echo base_url().$_SESSION['conf']; ?>/author/paper_review">
          <i class="fa fa-calendar"></i> <span>Submission Status</span>
        </a>
     </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
