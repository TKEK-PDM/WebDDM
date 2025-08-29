<nav class="side-nav">
    <div class="side-top">
        <div class="side-logo">
            <img style="height: 100px"
                src="<?php echo public_url('/images/__tk_Primary_Logo_RGB_white_72dpi.png'); ?>">
        </div>
        <!-- <span style="margin-left: 0px;">MOVE<br>&nbsp;&nbsp;&nbsp; BEYOND</span> -->
        <!-- <span style="margin-left: 0px;" ><?php echo lang('label_site_title'); ?></span> -->
        <!-- <span>
            <?php if ($this->session->user_role == '2'): ?>
                <small style="word-break: keep-all;margin-top: 0;"  class="h5"><?php echo lang('label_administrator'); ?></small>
            <?php endif; ?>

            <?php if ($this->session->user_role == '3'): ?>
                <span><?php echo lang('label_purchasing'); ?></span>
            <?php endif; ?>

            <?php if ($this->session->user_type == 'supplier'): ?>
                <span><?php echo lang('label_supplier'); ?></span>
                <small style="word-break: keep-all;margin-bottom: 0;" class="h5"><?php echo $this->session->user_display_name ?></small>
                <?php else: ?>                        
                <span><?php echo lang('label_internal_user'); ?></span>
            <?php endif; ?>
        </span> -->
    </div>
    <div class="navbar-default sidebar" role="navigation"
         style="">
        <?php if ($this->session->user_type == 'supplier' || $this->session->user_role == '4'): ?>
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav in" id="supplier-menu">
                    <?php if ($this->session->user_type == 'supplier' || $this->session->user_role == '4'): ?>
                    <?php endif; ?>
                    <li ui-sref-active="active" class="active">
                        <!-- <?php if ($this->session->user_type == 'supplier'): ?>
                            <label><?php echo lang('label_supplier'); ?></label>
                        <?php else: ?>
                            <label><?php echo lang('label_internal_user'); ?></label>
                        <?php endif; ?> -->
                        <ul class="nav nav-second-level">
                            <!-- <li><a href="<?php echo site_url('latest_draw/index'); ?>"><?php echo lang('label_latest_drawing'); ?></a></li>  -->
                            <li>
                                <a href="<?php echo site_url('search_job/index'); ?>"><?php echo lang('label_search_job'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('general_draw/index'); ?>"><?php echo lang('label_general_drawing'); ?></a>
                            </li>
                            <li><a
                                    href="<?php echo site_url('Project_drawing_management/index'); ?>"><?php echo lang('label_project_drawing'); ?></a>
                            </li>
                            <?php if ($this->session->user_role == '4'): ?>
                                <li><a
                                        href="<?php echo site_url('Supplier_cg_mapping/index'); ?>"><?php echo lang('label_supplier-cg_mapping'); ?></a>
                                </li>
                                <li><a
                                        href="<?php echo site_url('supplier_dwg_management/index'); ?>"><?php echo lang('label_supplier_dwg_management'); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul> <!-- /.nav-second-level -->
                    </li>
                </ul>
                <!-- <ul class="nav" >
                    <li><a href="<?php echo site_url('user/logout') ?>" style="color: #fff;padding: 18px 15px;position: fixed;bottom: 0;width: 250px;BACKGROUND: #1e0b2c;"><i
                            class="fa fa-sign-out fa-fw"></i> <?php echo lang('label_logout'); ?></a></li>
                </ul> -->
            </div>
        <?php else: ?>
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <!-- <?php if ($this->session->user_role == '2'): ?>
                        <li><a href="#"><?php echo lang('label_administrator'); ?></a></li>
                    <?php endif; ?>
                    <?php if ($this->session->user_role == '3'): ?>
                        <li><a href="#"><?php echo lang('label_purchasing'); ?></a></li>
                    <?php endif; ?> -->
                    <li><a href="#"> <?php echo lang('label_mapping_drawing_for_supplier'); ?> <span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href="<?php echo site_url('search_job/index'); ?>"><?php echo lang('label_search_job'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('general_draw/index'); ?>"><?php echo lang('label_general_drawing'); ?></a>
                            </li>
                            <li><a
                                    href="<?php echo site_url('Project_drawing_management/index'); ?>"><?php echo lang('label_project_drawing'); ?></a>
                            </li>
                        </ul> <!-- /.nav-second-level --></li>
                    <?php if ($this->session->user_role == '2'): ?>
                    <li><a href="#"> <?php echo lang('label_user_management'); ?> <span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href="<?php echo site_url('Prefix_management/index'); ?>"><?php echo lang('label_prefix_management'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('Role_management/index'); ?>"><?php echo lang('label_role_management'); ?></a>
                            </li>
                            <li><a
                                    href="<?php echo site_url('Internal_user_management/index'); ?>"><?php echo lang('label_internal_user_management'); ?></a>
                            </li>
                        </ul> <!-- /.nav-second-level --></li>
                    <?php endif; ?>
                    <li><a href="#"> <?php echo lang('label_supplier_management'); ?> <span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a
                                    href="<?php echo site_url('Supplier_management/index'); ?>"><?php echo lang('label_supplier_user_management'); ?></a>
                            </li>
                            <li><a
                                    href="<?php echo site_url('Supplier_cg_mapping/index'); ?>"><?php echo lang('label_supplier-cg_mapping'); ?></a>
                            </li>
                            <li><a
                                    href="<?php echo site_url('supplier_dwg_management/index'); ?>"><?php echo lang('label_supplier_dwg_management'); ?></a>
                            </li>

                        </ul> <!-- /.nav-second-level --></li>
                    <li><a href="#"> <?php echo lang('label_library'); ?> <span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href="<?php echo site_url('cg_library/index'); ?>"><?php echo lang('label_cg'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('tis_supplier_user/index'); ?>"><?php echo lang('label_tis_supplier_user'); ?></a>
                            </li>
                        </ul> <!-- /.nav-second-level --></li>
                    <?php if ($this->session->user_role == '2'): ?>
                    <li><a href="#"> <?php echo lang('label_user_log'); ?> <span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href="<?php echo site_url('Login_logout_log/index'); ?>"><?php echo lang('label_login_logout_log'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('Download_log/index'); ?>"><?php echo lang('label_download_log'); ?></a>
                            </li>
                        </ul> <!-- /.nav-second-level --></li>
                    <?php endif; ?>    
                </ul>
                <!-- <ul class="nav" >
                    <li><a href="<?php echo site_url('user/logout') ?>" style="color: #fff;padding: 18px 15px;position: fixed;bottom: 0;width: 250px;BACKGROUND: #1e0b2c;"><i
                            class="fa fa-sign-out fa-fw"></i> <?php echo lang('label_logout'); ?></a></li>
                </ul> -->
            </div>
        <?php endif; ?>
        <!-- /.sidebar-collapse -->
        <!-- <div id="show-menu-btn">
            <button id="showHideMenus"
                    class="showHideMenus btn btn-outline btn-blue buttonSpace">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true">
						</span>
            </button>
        </div> -->
    </div>
</nav>
<!-- <div id="showMenuBtn">
    <button class="showHideMenus btn btn-outline btn-blue buttonSpace">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true">
				</span>
    </button>
</div> -->