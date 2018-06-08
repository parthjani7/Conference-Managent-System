<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active">
        <a href="<?php echo base_url($slug.'/track_admin/dashboard'); ?>">
          <i class="fa fa-dashboard"></i> <span> Dashboard</span>
        </a>
      </li>
      <li class="treeview">
       <a href="#">
          <i class="fa fa-user"></i> <span>Reviewers</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
       </a>
       <ul class="treeview-menu">
          <li><a href="<?php echo base_url().$slug; ?>/track_admin/reviewers_add"><i class="fa fa-circle-o"></i> Add New Reviewers</a></li>
          <li><a href="<?php echo base_url().$slug; ?>/track_admin/reviewers"><i class="fa fa-circle-o"></i> View Reviewers</a></li>
       </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-file"></i>
          <span>Papers</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
         <li><a href="<?php echo base_url($slug); ?>/track_admin/papers_list"><i class="fa fa-circle-o"></i> Papers List</a></li>
         <li><a href="<?php echo base_url($slug); ?>/track_admin/papers_assignment"><i class="fa fa-circle-o"></i>Paper Assignment</a></li>
       </ul>
      </li>
      <li>
       <a href="<?php echo base_url().$slug; ?>/track_admin/track_admins">
          <i class="fa fa-user"></i> <span>Track Admins</span>
       </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
