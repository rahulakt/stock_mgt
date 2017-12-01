<!-- BEGIN HEADER TOP -->
<div class="page-header-top">
    <div class="container">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="#/dashboard.html">
                <img src="<?php echo base_url();?>assets/layouts/layout3/img/logo-default.jpg" alt="logo" class="logo-default"> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler"></a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <?php $title = $this->session->userdata('title'); 
        $first_name = $this->session->userdata('first_name'); 
        $last_name = $this->session->userdata('last_name'); 
        $name = $title.' '.$first_name.' '.$last_name;
        $user_id = $this->session->userdata('user_id'); ?>
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <?php if(isset($user_id) && !empty($user_id)){ ?>
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" dropdown-menu-hover data-toggle="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="<?php echo base_url();?>assets/layouts/layout3/img/avatar9.jpg">
                            <span class="username username-hide-mobile"><?php echo (isset($name) && !empty($name))?$name:'';?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="#/change_pass">
                                    <i class="icon-user"></i> Change Password </a>
                            </li>
                            <!-- <li class="divider"> </li> -->
                            <li>
                                <a href="logout">
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
            <?php } ?>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
</div>
<!-- END HEADER TOP -->
<!-- BEGIN HEADER MENU -->
<div class="page-header-menu">
    <div class="container">
        <!-- BEGIN HEADER SEARCH BOX -->
        <form class="search-form" action="extra_search.html" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="query">
                <span class="input-group-btn">
                    <a href="javascript:;" class="btn submit">
                        <i class="icon-magnifier"></i>
                    </a>
                </span>
            </div>
        </form>
        <!-- END HEADER SEARCH BOX -->
        <!-- BEGIN MEGA MENU -->
        <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
        <!-- DOC: Remove dropdown-menu-hover and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
        <div class="hor-menu">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="#/dashboard"> <i class="icon-home"></i> Dashboard</a>
                </li>
                <li class="menu-dropdown classic-menu-dropdown ">
                    <a href="javascript:void(0);"> 
                        <i class="icon-basket-loaded"></i> Products
                        <span class="arrow"></span>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li class=" ">
                            <a href="#/purchase" class="nav-link  ">
                                <i class="icon-puzzle"></i> Purchase
                            </a>
                        </li>
                        <li class=" ">
                            <a href="#/sale" class="nav-link  ">
                                <i class="icon-cloud-download"></i> Sale 
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-dropdown classic-menu-dropdown ">
                    <a href="javascript:void(0);"> 
                        <i class="icon-book-open"></i> Report
                        <span class="arrow"></span>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li class=" ">
                            <a href="#/purchase_report" class="nav-link  ">
                                <i class="icon-docs"></i> Purchase
                            </a>
                        </li>
                        <li class=" ">
                            <a href="#/sale_report" class="nav-link  ">
                                <i class="icon-docs"></i> Sale 
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END MEGA MENU -->
    </div>
</div>
<!-- END HEADER MENU -->