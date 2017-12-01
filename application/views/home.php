<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.6
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js" data-ng-app="MetronicApp"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js" data-ng-app="MetronicApp"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" data-ng-app="MetronicApp">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <title data-ng-bind="'Metronic AngularJS | ' + $state.current.data.pageTitle"></title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- Angular Material style sheet -->
        <link href="<?php echo base_url();?>assets/global/plugins/angularjs/angular-material.min.css" rel="stylesheet" type="text/css">
        <!-- END GLOBAL MANDATORY STYLES -->
        <link href="<?php echo base_url();?>assets/global/plugins/data-tables/DT_bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>assets/global/plugins/angularjs/angular-datatables.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>assets/global/plugins/angularjs/angular-growl.min.css" rel="stylesheet" type="text/css">
        <!-- BEGIN DYMANICLY LOADED CSS FILES(all plugin and page related styles must be loaded between GLOBAL and THEME css files ) -->
        <link id="ng_load_plugins_before" />
        <!-- END DYMANICLY LOADED CSS FILES -->
        <!-- BEGIN THEME STYLES -->
        <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
        <link href="<?php echo base_url();?>assets/global/css/components.min.css" id="style_components" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url();?>assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
        <!-- <base href="<?php //echo base_url();?>">  -->
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
    <!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->

    <body ng-controller="AppController" class="page-on-load">
        <!-- BEGIN PAGE SPINNER -->
        <div ng-spinner-bar class="page-spinner-bar">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
        <!-- END PAGE SPINNER -->
        <div class="page-wrapper">
            <div class="page-wrapper-row">
                <div class="page-wrapper-top">
                    <!-- BEGIN HEADER -->
                    <div data-ng-controller="HeaderController" class="page-header"> 
                        <?php $this->load->view('tpl/header');?>
                    </div>
                    <!-- END HEADER -->
                </div>
            </div>
            <div class="page-wrapper-row full-height">
                <div class="page-wrapper-middle">
                    <!-- BEGIN CONTAINER -->
                    <div class="page-container">
                        <!-- BEGIN PAGE HEAD -->
                        <div data-ng-controller="PageHeadController" class="page-head">
                            <?php $this->load->view('tpl/page-head');?>
                        </div>
                        <!-- END PAGE HEAD -->
                        <!-- BEGIN PAGE CONTENT -->
                        <div class="page-content">
                            <div class="container">
                                <!-- BEGIN ACTUAL CONTENT -->
                                <div ui-view class="fade-in-up"> </div>
                                <!-- END ACTUAL CONTENT -->
                            </div>
                        </div>
                        <!-- END PAGE CONTENT -->
                        <!-- BEGIN QUICK SIDEBAR -->
                        <a href="javascript:;" class="page-quick-sidebar-toggler">
                            <i class="icon-login"></i>
                        </a>
                        <div data-ng-controller="QuickSidebarController" class="page-quick-sidebar-wrapper">
                            <?php $this->load->view('tpl/quick-sidebar');?>
                        </div>
                        <!-- END QUICK SIDEBAR -->
                    </div>
                    <!-- END CONTAINER -->
                </div>
            </div>
            <div class="page-wrapper-row">
                <div class="page-wrapper-bottom">
                    <!-- BEGIN FOOTER -->
                    <div data-ng-controller="FooterController">
                        <?php $this->load->view('tpl/footer');?>
                    </div>
                    <!-- END FOOTER -->
                </div>
            </div>
        </div>
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE JQUERY PLUGINS -->
        <!--[if lt IE 9]>
	<script src="<?php echo base_url();?>assets/global/plugins/respond.min.js"></script>
	<script src="<?php echo base_url();?>assets/global/plugins/excanvas.min.js"></script> 
	<![endif]-->
        <script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE JQUERY PLUGINS -->
        <!-- BEGIN CORE ANGULARJS PLUGINS -->
        <script src="<?php echo base_url();?>assets/global/plugins/angularjs/angular.min.js" type="text/javascript"></script>
        <!-- Angular Material requires Angular.js Libraries -->
        <script src="<?php echo base_url();?>assets/global/plugins/angularjs/angular-animate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/angularjs/angular-aria.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/angularjs/angular-messages.min.js" type="text/javascript"></script>
        <!-- Angular Material Library -->
        <script src="<?php echo base_url();?>assets/global/plugins/angularjs/angular-material.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url();?>assets/global/plugins/angularjs/angular-sanitize.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/angularjs/angular-touch.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/angularjs/plugins/angular-ui-router.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/angularjs/plugins/ocLazyLoad.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/angularjs/plugins/ui-bootstrap-tpls.min.js" type="text/javascript"></script> 
        <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-growl/jquery.bootstrap-growl.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/angularjs/angular-growl.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/angularjs/angular-datatables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/data-tables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/data-tables/DT_bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/angularjs/ngBootbox.min.js"></script> 
        <script src="<?php echo base_url();?>assets/global/plugins/angularjs/angular-messages.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/angularjs/typeahead-focus.js" type="text/javascript"></script>
        <!-- END CORE ANGULARJS PLUGINS -->
        <!-- BEGIN APP LEVEL ANGULARJS SCRIPTS -->
        <script src="<?php echo base_url();?>js/main.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>js/directives.js" type="text/javascript"></script>
        <!-- END APP LEVEL ANGULARJS SCRIPTS -->
        <!-- BEGIN APP LEVEL JQUERY SCRIPTS -->
        <script src="<?php echo base_url();?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/layouts/layout3/scripts/demo.min.js" type="text/javascript"></script>
        <!-- END APP LEVEL JQUERY SCRIPTS -->
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->

</html>