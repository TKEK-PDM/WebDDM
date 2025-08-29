<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><?php echo lang('label_login_logout_log');?></h1>
		</div>
	</div>
	<!-- search field -->
	<form class="form-horizontal searchForm keep" id="frm" role="form"
		method="post" action="">
		<input type="hidden" id="keep" name="keep" value="<?php echo $keep;?>" />
		<div class="form-group searchDiv" style="padding-left: 15px;">
			<label class="tableLabel  smallLabel"><?php echo lang('label_user_type');?></label>
			<label class="radio-inline"> <input name="user_type" type="radio"
				value="A" checked="checked"> ALL
			</label> <label class="radio-inline"> <input name="user_type"
				id="$info['DWG_NO']" type="radio" value="S"
				<?php if($info['USER_TYPE'] == 'S'):?> checked="checked"
				<?php endif;?>><?php echo lang('label_supplier_user');?>
			</label> <label class="radio-inline"> <input name="user_type"
				id="user_type" type="radio" value="I"
				<?php if($info['USER_TYPE'] == 'I'):?> checked="checked"
				<?php endif;?>><?php echo lang('label_internal_user');?>
					</label>
		</div>

		<div class="form-group searchDiv" style="padding-left: 15px;">
			<label class="tableLabel tableLabel smallLabel"><?php echo lang('label_user_id');?></label>
			<label class="radio-inline" style="padding-left: 0px"> <input
				class="form-control  normalInput" type="text" name="USER_ID"
				id="USER_ID" value="<?php echo $info['USER_ID'];?>">
			</label> <label class="tableLabel tableLabel smallLabel"><?php echo lang('label_user_name');?></label>
			<label class="radio-inline" style="padding-left: 0px"> <input
				class="form-control  normalInput" type="text" name="USER_NAME"
				id="USER_NAME" value="<?php echo $info['USER_NAME'];?>">
			</label>
		</div>
		<div class="form-group searchDiv" style="padding-left: 15px;">
			<label class="tableLabel smallLabel"><?php echo lang('label_date');?></label>
			<label class="radio-inline"> <input name="date" type="radio"
				value="1" checked="checked" id="date" class="datenow"> <?php echo lang('label_today');?>
					</label> <label class="radio-inline"> <input name="date" id="date"
				type="radio" value="2" class="datenow"
				<?php if($info['DATE'] == 2):?> checked="checked" <?php endif;?>><?php echo lang('label_1week');?>
				</label> <label class="radio-inline"> <input name="date" id="date"
				type="radio" value="3" class="datenow"
				<?php if($info['DATE'] == 3):?> checked="checked" <?php endif;?>><?php echo lang('label_manually');?>

			</label> <label class="radio-inline calendar" style="display: none;">
			 <?php echo lang('label_from');?>
			 <div class="input-append date form_datetime" id="fromdacl">
					<input type="text" name="fromdate" id="fromdate"
						readonly="readonly" value="<?php echo $info['FROM'];?>"> <span
						class="add-on"><i class="icon-calendar"></i></span>
				</div>
			</label> <label class="radio-inline calendar" style="display: none;"> <?php echo lang('label_to');?>
				 <div class="input-append date form_datetime" id="todacl">
					<input type="text" name="todate" id="todate" readonly
						value="<?php echo $info['TO'];?>"> <span class="add-on"><i
						class="icon-calendar"></i></span>
				</div>
			</label> <input type="hidden" id="fromcal" name="fromcal"
				value="<?php echo $info['FROM'];?>"> <input type="hidden" id="tocal"
				name="tocal" value="<?php echo $info['TO'];?>">
		</div>
		<div class="form-group" style="padding-left: 15px;">
			<input type="hidden" name="query" id="query">
			<button class="btn btn-outline btn-blue buttonSpace" type="button"
				onclick="searchloginLog();"><?php echo lang('button_search');?></button>
			<form class="form-horizontal searchForm" method="post" id="file_form"
				enctype="multipart/form-data">
				<button class="btn btn-outline btn-blue buttonSpace" type="button"
					onclick="exportexcel();"><?php echo lang('button_excel_export'); ?></button>
			</form>
		</div>
	</form>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading panel_blue">
					<b>Login-Logout Log List(<?php echo count($data);?>)</b>
				</div>
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table
							class="table table-striped table-bordered table-hover dataTables_paging"
							id="login-logoutlog">
							<thead>
								<tr>
									<th><?php echo lang('label_no');?></th>
									<th><?php echo lang('label_seq');?></th>
									<th><?php echo lang('label_user_type');?></th>
									<th><?php echo lang('label_user_id');?></th>
									<th><?php echo lang('button_sup_code');?></th>
									<th><?php echo lang('label_user_name');?></th>
									<th><?php echo lang('label_action_type');?></th>
									<th><?php echo lang('label_action_date');?></th>
									<th><?php echo lang('label_action_time');?></th>
								</tr>
							</thead>
							<tbody>
					    <?php foreach($data as $key => $value):?>
						<tr class="odd gradeX">
									<td class="align_middle"><?php echo $key+1; ?></td>
									<td><?php echo $value->SEQ; ?></td>
									<td><?php echo $value->USER_TYPE; ?></td>
									<td><?php echo $value->USER_ID; ?></td>
									<td><?php echo $value->SUP_CODE; ?></td>
									<td><?php echo $value->USER_NAME; ?></td>
									<td><?php echo $value->ACTION_TYPE; ?></td>
									<td><?php echo $value->ACTION_DATE; ?></td>
									<td><?php echo $value->ACTION_TIME; ?></td>
								</tr>
					   <?php endforeach;?>
					     </tbody>
						</table>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {

	$.unblockUI();
    $('.dataTables_paging').DataTable({
    	responsive: true,
    	ordering:true,
        "bSort": true,
        "bFilter": false,
         "language": {
            url: "/public/js/<?php echo $this->session->lan_package;?>"
        }


    });

	$(".datenow").click(function(){
		if($(this).val()==3){
			$(".calendar").removeAttr("style");
			$(".day").removeClass("active");
			$(".today").addClass("active");
			$("#todate").val("<?php echo $todayval;?>");
		}else{
			$("#fromdate").val("");
			$("#todate").val("");
			$(".calendar").attr("style","display:none");
			$("#todate").datepicker('option', 'minDate', null);
			$("#fromdate").datepicker('option', 'maxDate', null);

		}
		});

	if($("input[name='date']:checked").val()==3){
		$(".calendar").removeAttr("style");
	}

	$('#fromdate').datepicker( $.datepicker.regional[ "<?php if ($this->session->lan_package == 'english.json'):?>en<?php elseif ($this->session->lan_package == 'korean.json'):?>ko<?php endif;?>" ]
	);
	$( "#fromdate" ).datepicker( "option", "dateFormat", "yymmdd" );

	$('#todate').datepicker( $.datepicker.regional[ "<?php if ($this->session->lan_package == 'english.json'):?>en<?php elseif ($this->session->lan_package == 'korean.json'):?>ko<?php endif;?>" ]
	);
	$( "#todate" ).datepicker( "option", "dateFormat", "yymmdd" );
      // Lock the min date cant less than start date
	$("#fromdate").bind("change", function() {
    	$("#todate").datepicker('option', 'minDate', $(this).datepicker('getDate'));
    });
	$("#todate").bind("change", function() {
    	$("#fromdate").datepicker('option', 'maxDate', $(this).datepicker('getDate'));
    });
	$( "#fromdate" ).val("<?php echo $info['FROM'];?>");
	$( "#todate" ).val("<?php echo $info['TO'];?>");

});
function searchloginLog(){
	 $("#query").val('');
	 var from = $("#fromdate").val();
	 $("#fromcal").val(from);
	 var from = $("#todate").val();
	 $("#tocal").val(from);
	 $.blockUI({ message: '<h3><?php echo lang('label_please_wait');?>...</h3>' });
	 $("#frm").attr("action","<?php echo site_url("Login_logout_log/search")?>");
	 $("#frm").submit();
}

function exportexcel(){
    $("#query").val('export');
    $("#frm").attr("action","<?php echo site_url("Login_logout_log/search")?>");
    $("#frm").submit();
    }


</script>