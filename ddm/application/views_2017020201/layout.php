<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo lang('label_site_title');?></title>
<!-- Bootstrap Core CSS -->
<?php echo css(css_url('/bootstrap.min.css'));?>
<!-- MetisMenu CSS -->
<?php echo css(css_url('/metisMenu.min.css'));?>
<!-- DataTables CSS -->
<?php echo css(css_url('/dataTables.bootstrap.css'));?>
<!-- DataTables Responsive CSS -->
<!-- Custom CSS -->

<?php echo css(css_url('/sb-admin-2.css'));?>
<!-- Custom Fonts -->
<?php echo css(css_url('/font-awesome.min.css'));?>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- Default CSS -->
<?php echo css(css_url('/default.css'));?>
<!-- Custom CSS -->
<?php echo css(css_url('/ict-style.css'))?>
<?php echo css(css_url('/jquery-ui.css'));?>
<!-- jQuery -->
<?php echo js(js_url('/jquery.min.js'));?>
<?php echo js(js_url('/jquery-ui.min.js'));?>
<!-- Bootstrap Core JavaScript -->
<?php echo js(js_url('/bootstrap.min.js'));?>
<!-- Metis Menu Plugin JavaScript -->
<?php echo js(js_url('/metisMenu.min.js'));?>
<!-- DataTables JavaScript -->
<?php echo js(js_url('/jquery.dataTables.min.js'));?>
<?php echo js(js_url('/dataTables.bootstrap.min.js'));?>
<?php echo js(js_url('/jquery.blockUI.min.js'));?>
<!-- Custom Theme JavaScript -->
<?php echo js(js_url('/sb-admin-2.js'));?>
<!-- jquery validate -->
<?php echo js(js_url('/jquery.validate-1.14.0.min.js'));?>

<?php echo js(js_url('/jquery-validate.bootstrap-tooltip.js'));?>

<?php echo js(js_url('/locales/datepicker-ko.js'));?>
</head>
<body>
	<div class="modal fade" id="error_modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><?php echo lang('label_message');?></h4>
				</div>
				<div class="modal-body" id="error_message"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close');?></button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<div class="modal fade" id="file_not_exist_modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><?php echo lang('label_message');?></h4>
				</div>
				<div class="modal-body" id="not_exist_msg"><?php echo lang('message_file_not_exist');?></div>
				<div class="modal-body" id="tdm_id_msg"></div>
				<div class="modal-body" id="revision_msg"></div>
				<div class="modal-body" id="file_name_msg"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close');?></button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<div class="container">
		<div class="modal fade" id="profile_card">
			<div class="modal-header">
				<h4 id="profile_card_header"><?php echo lang('label_profile_card');?></h4>
			</div>
			<div class="modal-body" id="modalBody"><?php echo lang('label_please_wait')?>...</div>
			<div class="modal-footer" id="modalfooter">
				<button class="btn btn-outline btn-blue buttonSpace" type="button"
					onclick="flushProfileCardCss();"><?php echo lang('button_close');?></button>
			</div>
		</div>
	</div>

	<div id="wrapper">
		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-static-top" role="navigation"
			style="margin-bottom: 0">
			<div class="navbar-header text-center" style="width: 250px">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<img style="height: 100px"
					src="<?php echo public_url('/images/tk_Primary_Logo_RGB_white_72dpi.png');?>">
			</div>
			<div style="float: left">
				<h2 style="margin-left: 0px"><?php echo lang('label_site_title');?></h2>
			</div>
			<!-- /.navbar-header -->
			<ul class="nav navbar-top-links navbar-right">
				<!-- /.dropdown -->
				<li class="dropdown"><a class="dropdown-toggle"
					data-toggle="dropdown" href="#" title="Language"> <i
						class="fa fa-globe fa-fw"></i> <i class="fa fa-caret-down"></i>
				</a>
					<ul class="dropdown-menu">
						<li><a href="#" onclick="change_language('korean');return false;">
								<i class="fa fa-flag fa-fw"></i> 한국어
						</a></li>
						<li class="divider"></li>
						<li><a href="#" onclick="change_language('english');return false;">
								<i class="fa fa-flag fa-fw"></i> English
						</a></li>
					</ul> <!-- /.dropdown-alerts --></li>
				<!-- /.dropdown -->
				<li class="dropdown"><a class="dropdown-toggle"
					data-toggle="dropdown" href="#" title="User"> <i
						class="fa fa-user fa-fw"></i> <?php echo $this->session->username?> <i
						class="fa fa-caret-down"></i>
				</a>
					<ul class="dropdown-menu dropdown-user">
						<li><a href="<?php echo site_url('user/logout')?>"><i
								class="fa fa-sign-out fa-fw"></i> <?php echo lang('label_logout');?></a></li>
					</ul> <!-- /.dropdown-user --></li>
				<!-- /.dropdown -->
			</ul>
			<!-- /.navbar-top-links -->
			<div class="navbar-default sidebar" role="navigation"
				style="position: relative;">
				<?php if($this->session->user_type == 'supplier' || $this->session->user_role == '4'):?>
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav in" id="supplier-menu">
					<?php if($this->session->user_type == 'supplier' || $this->session->user_role == '4'):?>
					<?php endif;?>
						<li ui-sref-active="active" class="active">
						<?php if($this->session->user_type == 'supplier'):?>
							<label><?php echo lang('label_supplier');?></label>
						<?php else:?>
							<label><?php echo lang('label_internal_user');?></label>
						<?php endif;?>
							<ul class="nav nav-second-level">
								<!-- <li><a href="<?php echo site_url('latest_draw/index'); ?>"><?php echo lang('label_latest_drawing');?></a></li>  -->
								<li><a href="<?php echo site_url('search_job/index'); ?>"><?php echo lang('label_search_job');?></a></li>
								<li><a href="<?php echo site_url('general_draw/index'); ?>"><?php echo lang('label_general_drawing');?></a></li>
								<li><a
									href="<?php echo site_url('Project_drawing_management/index'); ?>"><?php echo lang('label_project_drawing');?></a></li>
								<?php if($this->session->user_role == '4'):?>
								<li><a
									href="<?php echo site_url('Supplier_cg_mapping/index'); ?>"><?php echo lang('label_supplier-cg_mapping');?></a></li>
								<li><a
									href="<?php echo site_url('supplier_dwg_management/index'); ?>"><?php echo lang('label_supplier_dwg_management');?></a></li>	
								<?php endif;?>		
							</ul> <!-- /.nav-second-level -->
						</li>
					</ul>
				</div>
				<?php else:?>
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
						<?php if($this->session->user_role == '2'):?>
						<li><a href="#"><?php echo lang('label_administrator');?></a></li>
						<?php endif;?>
						<?php if($this->session->user_role == '3'):?>
						<li><a href="#"><?php echo lang('label_purchasing');?></a></li>
						<?php endif;?>
						<li><a href="#"> <?php echo lang('label_mapping_drawing_for_supplier');?> <span
								class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="<?php echo site_url('search_job/index');?>"><?php echo lang('label_search_job');?></a></li>
								<li><a href="<?php echo site_url('general_draw/index'); ?>"><?php echo lang('label_general_drawing');?></a></li>
								<li><a
									href="<?php echo site_url('Project_drawing_management/index'); ?>"><?php echo lang('label_project_drawing');?></a></li>
							</ul> <!-- /.nav-second-level --></li>
						<li><a href="#"> <?php echo lang('label_user_management');?> <span
								class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="<?php echo site_url('Role_management/index'); ?>"><?php echo lang('label_role_management');?></a></li>
								<li><a
									href="<?php echo site_url('Internal_user_management/index'); ?>"><?php echo lang('label_internal_user_management');?></a></li>
							</ul> <!-- /.nav-second-level --></li>
						<li><a href="#"> <?php echo lang('label_supplier_management');?> <span
								class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a
									href="<?php echo site_url('Supplier_management/index'); ?>"><?php echo lang('label_supplier_user_management');?></a></li>
								<li><a
									href="<?php echo site_url('Supplier_cg_mapping/index'); ?>"><?php echo lang('label_supplier-cg_mapping');?></a></li>
								<li><a
									href="<?php echo site_url('supplier_dwg_management/index'); ?>"><?php echo lang('label_supplier_dwg_management');?></a></li>

							</ul> <!-- /.nav-second-level --></li>
						<li><a href="#"> <?php echo lang('label_library');?> <span
								class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="<?php echo site_url('cg_library/index'); ?>"><?php echo lang('label_cg');?></a></li>
								<li><a href="<?php echo site_url('tis_supplier_user/index'); ?>"><?php echo lang('label_tis_supplier_user');?></a></li>
							</ul> <!-- /.nav-second-level --></li>
						<li><a href="#"> <?php echo lang('label_user_log');?> <span
								class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="<?php echo site_url('Login_logout_log/index'); ?>"><?php echo lang('label_login_logout_log');?></a></li>
								<li><a href="<?php echo site_url('Download_log/index'); ?>"><?php echo lang('label_download_log');?></a></li>
							</ul> <!-- /.nav-second-level --></li>
					</ul>
				</div>
				<?php endif;?>
				<!-- /.sidebar-collapse -->
				<div style="position: absolute; top: 5px; left: 210px;">
					<button id="showHideMenus"
						class="showHideMenus btn btn-outline btn-blue buttonSpace">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true">
						</span>
					</button>
				</div>
			</div>
			<!-- /.navbar-static-side -->
		</nav>
		<div id="showMenuBtn"
			style="position: absolute; top: 100px; left: 0px; display: none;">
			<button class="showHideMenus btn btn-outline btn-blue buttonSpace">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true">
				</span>
			</button>
		</div>
		<!-- <div id="resizeDiv"></div> -->
		<?php echo $content;?>
	</div>
	<!-- /#wrapper -->
	<footer id="footer">
		<div class="copyright">thyssenkrupp &#169; 2016</div>
	</footer>
</body>
<script type="text/javascript">
	$(document).ready(function() {

		// $(".showHideMenus").on("click",function(){
		// 	if($(".sidebar").is(":visible")){
		// 		$(".sidebar").hide();
		// 		$("#showMenuBtn").show();
		// 		$("#showHideDiv").css("margin-left","40px");
		// 		$("#resizeDiv").css("left","40px");
		// 		$("#page-wrapper").css("margin-left","40px");
		// 	}else{
		// 		$(".sidebar").show();
		// 		$("#showMenuBtn").hide();
		// 		$("#showHideDiv").css("margin-left","250px");
		// 		$("#resizeDiv").css("left","250px");
		// 		$("#page-wrapper").css("margin-left","250px");
		// 	}

		// 	/*use jquery to resize the table head*/
		// 	var scrollTableBodyWidth = $(".dataTables_scrollBody table").width();
		// 	var scrollTableHeaderWidth = scrollTableBodyWidth;			
		// 	$(".dataTables_scrollHeadInner table").width(scrollTableHeaderWidth);
			
		// });

        $('#side-menu').metisMenu();
        var url = '<?php echo $this->session->userdata('menu_url'); ?>';
        var element = $('ul.nav a').filter(function() {
            return this.href == url /*|| url.href.indexOf(this.href) == 0 */ ;
        }).addClass('active').parent().parent().addClass('in').parent();
        if (element.is('li')) {
            element.addClass('active');
        }

		/*var h=$(window).height()-150;
		$("#resizeDiv").css("height",h);
		$("#resizeDiv").mousedown(function(e){
			$(".sidebar").show();
			var disX = (e || event).clientX;
			document.onmousemove = function(e) {
				if((e || event).clientX<=250){
					$(".sidebar").css("width",(e || event).clientX);
					$(".sidebar").css("overflow","hidden");
					$("#resizeDiv").css("left",(e || event).clientX);
					$("#page-wrapper").css("margin-left",(e || event).clientX);
				}

    			var h=$("#page-wrapper").height();
    			$("#resizeDiv").css("height",h);
    			return false ;
			};
			document.onmouseup = function() {
				document.onmousemove = null;
				document.onmouseup = null;
				$("#page-wrapper").releaseCapture && $("#page-wrapper").releaseCapture() ;

			};
			$("#page-wrapper").setCapture && $("#page-wrapper").setCapture();
			return false ;
		});*/

		$("#multi_download").on('click',function(){
    		if($("input[name='file_name[]']:checked").length < 1){
				$("#error_message").html("<?php echo lang('message_multi_download_no_row_select');?>");
				$("#error_modal").modal();
    		}else{
				var check_result = "Y";
				$("input[name='file_name[]']:checked").each(function (i){
					var filename = $(this).attr("file");
					var site = $(this).attr("site");
					var revision = $(this).attr("revision");
					var tdm_id = $(this).attr("tdm_id");
					$.ajax({
			    		type: "POST",
			    		async: false,
			    		cache: false,
			    		url: "<?php echo site_url('latest_draw/check_single_file_exist'); ?>",
			    		data:{
							'file_name':filename,
							'site':site,
			        	},
			    		success: function(msg){
			        		if(msg == "N"){
			        			check_result = "N"
			        			$('#tdm_id_msg').html("TDM ID:"+tdm_id);
			        			$('#revision_msg').html("<?php echo lang('label_revision');?>:"+revision);
			        			$('#file_name_msg').html("<?php echo lang('label_file_name');?>:"+filename);
			        			$('#file_not_exist_modal').modal();
			        			return false;
			        		}
			    		}
			    	});
    			});

    	    	if(check_result == "Y"){
    				$("#multi_download_form").submit();
    	    	}
    		}
    	});

	});

	function check_file_exist(filename,site,revision,object_id,class_id,tdm_id){
    	$.ajax({
    		type: "POST",
    		async: false,
    		cache: false,
    		url: "<?php echo site_url('download/check_single_file_exist'); ?>",
    		data:{
					'file_name':filename,
					'site':site,
        		},
    		success: function(msg){
        		if(msg == "N"){
        			$('#tdm_id_msg').html("TDM ID:"+tdm_id);
        			$('#revision_msg').html("<?php echo lang('label_revision');?>:"+revision);
        			$('#file_name_msg').html("<?php echo lang('label_file_name');?>:"+filename);
        			$('#file_not_exist_modal').modal();
        			return false;
        		}else{
        			window.location.href = "<?php echo site_url("download/download_file/")?>/"+filename+"/"+site+"/"+revision+"/"+object_id+"/"+class_id+"/"+tdm_id;
        		}
    		}
    	});
	}

	function showProfileCard(TDM_ID,REVISION){
		$('#modalBody').html("<?php echo lang('label_please_wait');?>...");
		$('#profile_card_header').html("<?php echo lang('label_profile_card');?>");
		$('#modalfooter').hide();
		$("#profile_card").draggable({
		     cursor: "move",
		     handle: '#profile_card_header'
		    });
		$('#profile_card').modal({backdrop: 'static', keyboard: false});
    	$.ajax({
    		type: "POST",
    		async: false,
    		cache: false,
    		url: "<?php echo site_url('profile_card/index'); ?>",
    		data:{
					'TDM_ID':TDM_ID,
					'REVISION':REVISION,
        		},
    		success: function(msg){
    			$('#modalBody').html(msg);

    			$('#modalfooter').show();
    		}
    	});
    	return false;
    }

    function change_language(language){
        	var form = $('form.keep');
        	if(form.length > 0){
            		var keep = $('#keep').val();
            		if(keep == true){
                			var action = form.attr('action');
                			form.attr('action',action+"?language="+language);
                			form.submit();
                		}else{
								window.location.href="<?php echo current_url();?>?language="+language
                    		}
            	}else{
            			window.location.href="<?php echo current_url();?>?language="+language
                	}
        }

    function flushProfileCardCss(){
    	$('#profile_card').modal('hide');
    	setTimeout(function(){
    		$('#profile_card').css("margin-left","-350px");
        	$('#profile_card').css("top","75px");
        	$('#profile_card').css("left","50%");
        	$('#profile_card').css("bottom","75px");
        },1000);
    }
</script>
</html>
