<?php
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];
$privilege = new privilegeController;
$mat = new materialController;

$userrow = $mat->userregDetails($loguserid);
$gender = $userrow['gender'];

$usertyRow = $mat->usertypebyid($userrow['usertype']);

?>
<header class="main-header">
    <!-- Logo -->
    <a href="login" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>MO</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Demo</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
<!--
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
-->
                <!-- inner menu: contains the actual data -->
<!--
                <ul class="menu">
                  <li> start message 
-->
<!--
                    <a href="#">
                      <div class="pull-left">
                        <img src="../public/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
-->
                  <!-- end message -->
<!--
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="../public/img/user1-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="../public/img/user1-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="../public/img/user1-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="../public/img/user1-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
-->
          <!-- Notifications: style can be found in dropdown.less -->
<!--
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
-->
                <!-- inner menu: contains the actual data -->
<!--
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
-->
          <!-- Tasks: style can be found in dropdown.less -->
<!--
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
-->
                <!-- inner menu: contains the actual data -->
<!--
                <ul class="menu">
                  <li> Task item 
-->
<!--
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
-->
                  <!-- end task item -->
<!--
                  <li> Task item 
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
-->
                  <!-- end task item -->
<!--
                  <li> Task item 
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
-->
                  <!-- end task item -->
<!--
                  <li> Task item 
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
-->
                  <!-- end task item -->
<!--
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
-->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php 
                if($gender == 'male')
                {
                    ?><img src="/../public/img/avatar.jpg" class="user-image" alt="User Image"><?php
                }
                else
                {
                    ?><img src="/../public/img/avatar3.png" class="user-image" alt="User Image"><?php
                }
                ?>              
              <span class="hidden-xs"><?=$userrow['first_name']." ".$userrow['last_name']?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php 
                if($gender == 'male')
                {
                    ?><img src="/../public/img/avatar.jpg" class="img-circle" alt="User Image"><?php
                }
                else
                {
                    ?><img src="/../public/img/avatar3.png" class="img-circle" alt="User Image"><?php
                }
                ?>

                <p>
                  <?=$userrow['first_name']." ".$userrow['last_name']?> - <?=$usertyRow['name']?>
                </p>
              </li>
              <!-- Menu Body -->
<!--
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                 /.row 
              </li>
-->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="userPasswordChange" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <button class="btn btn-default btn-flat" id="signout">Sign Out</button>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>  
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php 
          if($gender == 'male')
          {
            ?><img src="/../public/img/avatar.jpg" class="img-circle" alt="User Image"><?php
          }
          else
          {
              ?><img src="/../public/img/avatar3.png" class="img-circle" alt="User Image"><?php
          }
          ?>
        </div>
          <div class="pull-left info" style="position: unset; font-size: 13px;">
          <p><?=$userrow['first_name']." ".$userrow['last_name']?></p>
          <a href="#"><i class="fab fa-stumbleupon-circle text-success"></i>&nbsp; Online</a>
        </div>
      </div>
      <!-- search form -->
<!--
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
-->
        <div style="height: 15px"></div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      
      <ul class="sidebar-menu" data-widget="tree">
        <?php
          $result = $privilege->selectPageSide($loguserid);
          foreach($result as $row)
          {
              if($row['primarysection'] == 'Employee Related')
              {
                    $icon = 'fab fa-d-and-d';
                    $navName = 'Employee Related';   
              }
              else if($row['primarysection'] == 'Dashboard')
              {
                    $icon = 'fas fa-tachometer-alt';
                    $navName = 'Dashboard';   
              }
              else if($row['primarysection'] == 'Student Related')
              {
                    $icon = 'fab fa-modx';
                    $navName = 'Student Related';   
              }
              else if($row['primarysection'] == 'Schedule Related')
              {
                    $icon = 'fab fa-sellcast';
                    $navName = 'Schedule Related';   
              }
              else if($row['primarysection'] == 'Leave Management')
              {
                    $icon = 'fab fa-steam';
                    $navName = 'Leave Management';
              }
              else if($row['primarysection'] == 'Library')
              {
                  $icon = 'fab fa-stack-overflow';
                  $navName = 'Library';
              }
              else if($row['primarysection'] == 'Hostel')
              {
                  $icon = 'fa fa-h-square';
                  $navName = 'Hostel';
              }
              else if($row['primarysection'] == 'Settings')
              {
                    $icon = 'fab fa-google-wallet';
                    $navName = 'Settings';   
              }
              else if($row['primarysection'] == 'Fees')
              {
                    $icon = 'fab fa-opencart';
                    $navName = 'Fees';   
              }
              else if($row['primarysection'] == 'Transport')
              {
                    $icon = 'fab fa-ioxhost';
                    $navName = 'Transport';   
              }
              else if($row['primarysection'] == 'Exam Related')
              {
                    $icon = 'fab fa-joget';
                    $navName = 'Exam Related';   
              }
              $select_enable_hedding = $privilege->enablePriviledge($loguserid, $navName);
              if(count($select_enable_hedding) >= 1)
              {
                  ?>
                 <li id="<?=$navName?>">
                    <a href="menu?page=<?=$navName?>" return false>
                        <i class="<?=$icon?>"></i> &nbsp;<span><?=$navName?></span>
                    </a>
                </li>
                  <?php
              }
          }
          ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>