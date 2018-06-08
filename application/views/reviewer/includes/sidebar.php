<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active">
        <a href="<?php echo base_url($_SESSION['conf'].'/reviewer/dashboard'); ?>">
          <i class="fa fa-dashboard"></i> <span> Dashboard</span>
        </a>
      </li>
      <li>
        <a href="<?php echo base_url().$_SESSION['conf']; ?>/reviewer/paper_list">
          <i class="fa fa-file"></i>
          <span>My Papers</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
