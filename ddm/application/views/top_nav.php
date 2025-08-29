<nav class="navbar navbar-default navbar-static-top" id="navbar-static-top" role="navigation"
     style="margin-bottom: 0">
    <div class="navbar-header text-center" style="width: 250px">
        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span> <span
                class="icon-bar"></span> <span class="icon-bar"></span> <span
                class="icon-bar"></span>
        </button>
        <!-- <img style="height: 100px"
             src="<?php echo public_url('/images/tk_Primary_Logo_RGB_white_72dpi.png'); ?>"> -->
    </div>
    <div style="float: left">
			 <div id="show-menu-btn">
            <button id="showHideMenus"
                    class="showHideMenus btn ">
                    <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
        </div>
        <?php 

        $request_uri = $_SERVER['REQUEST_URI'];
        $page_name = explode("/",$request_uri);
        $header_name = '';
        switch($page_name[1]){
             case "search_job":
                $header_name = lang('label_search_job');
                break;
            case "general_draw":
                $header_name = lang('label_general_drawing');
                break;
            case "Project_drawing_management":
                $header_name = lang('label_project_drawing');
                break;
            case "Role_management":
                $header_name = lang('label_role_management');
                break;
            case "Prefix_management":
                $header_name = lang('label_prefix_management');
                break;
            case "Internal_user_management":
                $header_name = lang('label_internal_user_management');
                break;
            case "Supplier_management":
                $header_name = lang('label_supplier_user_management');
                break;
            case "Supplier_cg_mapping":
                $header_name = lang('label_supplier-cg_mapping');
                break;
            case "supplier_dwg_management":
                $header_name = lang('label_supplier_dwg_management');
                break;
            case "cg_library":
                $header_name = lang('label_cg_library');
                break;
            case "tis_supplier_user":
                $header_name = lang('label_tis_supplier_user');
                break;
            case "Login_logout_log":
                $header_name = lang('label_login_logout_log');
                break;
            case "Download_log":
                $header_name = lang('label_download_log');
                break;

        }
        if($_SERVER[ "REQUEST_URI" ] )?>
        <!-- <h2 style="margin-left: 0px;font-size: 2em;color: #333333;line-height: 100px;" ><?php echo lang('label_site_title'); ?></h2> -->
        <h2 style="margin-left: 100px;font-size: 2em;color: #333333;line-height: 100px;" ><?php echo  $header_name;  ?></h2>
        <!-- <h2 style="margin-left: 0px; color:#000;" ><?php echo lang('label_site_title'); ?></h2> -->
    </div>

    <!-- /.navbar-header -->
    <ul class="nav navbar-top-links navbar-right hidden-sm">
        <!-- /.dropdown -->
        <li class="dropdown"><a class="dropdown-toggle"
                                data-toggle="dropdown" href="#" title="User"> <i
                    class="fa fa-user"></i> <?php echo $this->session->username ?>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="<?php echo site_url('user/logout') ?>"><i
                            class="fa fa-sign-out"></i> <?php echo lang('label_logout'); ?></a></li>
            </ul> <!-- /.dropdown-user --></li>
        <!-- /.dropdown -->
        <li class="dropdown"><a class="dropdown-toggle"
                                data-toggle="dropdown" href="#" title="Language"><i class="fa fa-globe fa-fw" aria-hidden="true"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#" onclick="change_language('korean');return false;">
                        <i class="fa fa-flag"></i> 한국어
                    </a></li>
                <li class="divider"></li>
                <li><a href="#" onclick="change_language('english');return false;">
                        <i class="fa fa-flag "></i> English
                    </a></li>
            </ul> <!-- /.dropdown-alerts --></li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
</nav>