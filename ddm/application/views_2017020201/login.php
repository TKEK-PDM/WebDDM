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
<?php echo css(css_url('/bootstrap.min.css'))?>
<!-- MetisMenu CSS -->
<?php echo css(css_url('/metisMenu.min.css'))?>
<!-- Custom CSS -->
<?php echo css(css_url('/sb-admin-2.css'))?>
<!-- Default CSS -->
<?php echo css(css_url('/default.css'))?>
<!-- Custom CSS -->
<?php echo css(css_url('/ict-style.css'))?>
<!-- Custom Fonts -->
<?php echo css(css_url('/font-awesome.min.css'))?>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php echo css(css_url('/login.css'))?>
</head>
<body>
	<div id="wrapper">
		<div class="navbar-header"
			style="width: 100%; background-color: #00a0f5;">
			<a href="#"><img style="height: 100px"
				src="<?php echo base_url();?>public/images/tk_Primary_Logo_RGB_white_72dpi.png">
				<h2><?php echo lang('label_site_title');?></h2></a>
		</div>
		<div class="container" style="clear: both">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="login-panel panel panel-default">
						<div class="panel-heading">
							<!--img style="margin:5px 0 0 10px;" src="<?php echo public_url();?>/images/tk_Secondary_Logo_limit.png"-->
							<h3><?php echo lang('label_login');?></h3>
						</div>
						<div class="panel-body">
								<?php if($message):?>
                                <div class="bs-callout-danger">
								<!-- 
                                	<span class="glyphicon glyphicon-warning-sign" ></span>&nbsp;&nbsp;
                                	 -->
                                	<?php echo $message;?>
                                </div>
                                <?php endif;?>
                                
                                <div class="bs-callout-danger">
                            		<?php echo validation_errors(); ?>
                                </div>
                            	<?php echo form_open('user/login',array("id"=>"loginform")); ?>
								<table id="loginTable">
								<tr>
									<td style="width: 80px"><?php echo lang('label_language');?></td>
									<td><input name="language" type="radio" value="korean"
										onclick="switchLanguage(this)"
										<?php if(empty($_COOKIE['language']) || $_COOKIE['language'] == 'korean'):?>
										checked="checked" <?php endif;?>> 한국어 <input name="language"
										type="radio" value="english"
										<?php if($_COOKIE['language'] =='english'):?>
										checked="checked" <?php endif;?>
										onclick="switchLanguage(this)"> English</td>

								</tr>
								<tr>
									<td style="width: 80px"><?php echo lang('label_user_type');?></td>
									<td><input name="user_type" type="radio" value="supplier"
										<?php if(empty($_COOKIE['user_type']) || $_COOKIE['user_type'] == 'supplier'):?>
										checked="checked" <?php endif;?>/> <?php echo lang('label_supplier');?> <input
										name="user_type" type="radio" value="internal_user" <?php if($_COOKIE['user_type'] =='internal_user'):?>
										checked="checked" <?php endif;?>/> <?php echo lang('label_internal_user');?></td>
								</tr>
								<tr>
									<td><?php echo lang('label_user_id');?></td>
									<td><input class="form-control" name="username"
										value="<?php echo set_value('username')?>" type="text"
										autofocus></td>
								</tr>
								<tr>
									<td><?php echo lang('label_password');?></td>
									<td><input class="form-control" name="password"
										value="<?php echo set_value('password')?>" type="password"
										value=""></td>
								</tr>
							</table>
							<br /> <input type="submit"
								class="btn btn-lg btn-block blueBackgroud" name="Login"
								value="<?php echo lang('label_login');?>" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- jQuery -->
<?php echo js(js_url('/jquery.min.js'))?>
<!-- Bootstrap Core JavaScript -->
<?php echo js(js_url('/bootstrap.min.js'))?>
<!-- Metis Menu Plugin JavaScript -->
<?php echo js(js_url('/metisMenu.min.js'))?>
<!-- Custom Theme JavaScript -->
<?php echo js(js_url('/sb-admin-2.js'))?>
<script type="text/javascript">
function switchLanguage(obj){
	$("#loginform").attr("action","/user/switch_language")
	$("#loginform").submit();
	
	
}
</script>
</body>
</html>
