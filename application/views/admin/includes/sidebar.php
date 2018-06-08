<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active">
        <a href="<?php echo base_url(); ?>admin/dashboard">
          <i class="fa fa-dashboard"></i> <span> Dashboard</span>
        </a>
      </li>
     <?php if($this->session->userdata('conf_id')==''){ ?>
     <li>
       <a href="<?php echo base_url(); ?>admin/create_conference">
         <i class="fa fa-dashboard"></i> <span> Create Conference</span>
       </a>
     </li>
     <?php }else{ ?>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-user"></i> <span>Track Admins</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>admin/add_track_admin"><i class="fa fa-circle-o"></i> Add New Track Admin</a></li>
          <li><a href="<?php echo base_url(); ?>admin/track_admins"><i class="fa fa-circle-o"></i> View Track Admin</a></li>
        </ul>
      </li>
      <li class="treeview">
       <a href="#">
          <i class="fa fa-user"></i> <span>Reviewers</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
       </a>
       <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>admin/reviewers_add"><i class="fa fa-circle-o"></i> Add New Reviewers</a></li>
          <li><a href="<?php echo base_url(); ?>admin/reviewers"><i class="fa fa-circle-o"></i> View Reviewers</a></li>
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
          <li><a href="<?php echo base_url(); ?>admin/papers_list"><i class="fa fa-circle-o"></i> Papers List</a></li>
          <li><a href="<?php echo base_url(); ?>admin/papers_assignment"><i class="fa fa-circle-o"></i>Paper Assignment</a></li>
        </ul>
      </li>
      <li>
        <a href="<?php echo base_url(); ?>admin/authors">
          <i class="fa fa-user"></i> <span>Authors</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-pie-chart"></i>
          <span>Settings</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>admin/conference_settings"><i class="fa fa-circle-o"></i> Conference Settings</a></li>
          <li><a href="<?php echo base_url(); ?>admin/track_settings"><i class="fa fa-circle-o"></i> Track Settings</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-pie-chart"></i>
          <span>Report</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i> Payment Report</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Paper Report</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Reviewer Report</a></li>
        </ul>
      </li>
      <?php } ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
