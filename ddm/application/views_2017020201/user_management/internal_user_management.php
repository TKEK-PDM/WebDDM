<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><?php echo lang('label_internal_user_management');?></h1>
		</div>
	</div>
	<!-- search field -->
	<form class="ng-pristine ng-valid searchForm keep" role="form" id="frm"
		method="post" action=" ">
		<input type="hidden" id="keep" name="keep" value="<?php echo $keep;?>" />
		<input type="hidden" id="objectId" name="objectId" /> <input
			type="hidden" id="roleobjectId" name="roleobjectId" />
		<div class="form-group searchDiv">
			<div class="col-lg-1">
				<label class="tableLabel smallLabel"><?php echo lang('label_8id');?></label>
			</div>
			<div class="col-lg-3">
				<input class="form-control normalInput" type="text" name="USER_8_ID"
					id="USER_8_ID" value="<?php echo $info['USER_8_ID']; ?>">
			</div>
			<div class="col-lg-1">
				<label class="tableLabel smallLabel"><?php echo lang('label_user_name');?></label>
			</div>
			<div class="col-lg-3">
				<input class="form-control normalInput" type="text"
					name="TDM_DESCRIPTION" id="TDM_DESCRIPTION"
					value="<?php echo $info['TDM_DESCRIPTION'];?>">
			</div>
			<div class="col-lg-1">
				<label class="tableLabel smallLabel"><?php echo lang('label_assign');?></label>
			</div>
			<div class="col-lg-3">
				<td><select class="form-control normalInput" name="ASSIGNED_VALUE"
					id="ASSIGNED_VALUE">
						<option value="0" <?php if ( $info['ASSIGNED_VALUE'] == '0'):?>
							selected <?php endif;?>>All</option>
						<option value="1"
							<?php if($info['ASSIGNED_VALUE'] ===null || $info['ASSIGNED_VALUE'] == '1'):?>
							selected <?php endif;?>>Assigned</option>
						<option value="2" <?php if($info['ASSIGNED_VALUE'] == '2'):?>
							selected <?php endif;?>>Not Assigned</option>
				</select></td>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12" style="height: 10px"></div>
		</div>

		<div class="form-group searchDiv">
			<input type="hidden" id="search" name="search" />
			<button class="btn btn-outline btn-blue buttonSpace" type="button"
				onclick="searchInternal();"><?php echo lang('button_search');?></button>
			<input class="btn btn-outline btn-blue buttonSpace" type="submit"
				value="<?php echo lang('button_delete_assign');?>"
				onclick="return checkflag();" />
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading panel_blue">
						<b><?php echo lang('label_internal_user_list');?>(<?php echo count($data);?>)</b>
					</div>
					<div class="panel-body">
						<div class="dataTable_wrapper">
							<table
								class="table table-striped table-bordered table-hover dataTables_single"
								id="internalTable">
								<thead>
									<tr>
										<th><input type="checkbox" id="checkall" /></th>
										<th><?php echo lang('label_no');?></th>
										<th><?php echo lang('label_division');?></th>
										<th><?php echo lang('label_title');?></th>
										<th><?php echo lang('label_login');?></th>
										<th><?php echo lang('label_user_name');?>(KO)</th>
										<th><?php echo lang('label_role_name');?></th>
										<th><?php echo lang('label_first_name');?></th>
										<th><?php echo lang('label_last_name');?></th>
										<th><?php echo lang('label_phone');?></th>
										<th><?php echo lang('label_fax');?></th>
										<th><?php echo lang('label_email');?></th>
									</tr>
								</thead>
								<tbody>	
								<?php foreach ($data as $key=>$val):?>
								<tr class="odd gradeX">
										<th><input type="checkbox" name="id[]" id="checkid"
											class="checkid" value="<?php echo $val->OBJECT_ID;?>"></th>
										<td class="align_middle"><?php echo $key+1;?></td>
										<td><?php echo $val->USER_DIVISION;?></td>
										<td><?php echo $val->USER_TITLE;?></td>
										<td><?php echo $val->LOGIN;?></td>
										<td><?php echo $val->TDM_DESCRIPTION;?></td>
										<td><select name="role[]" id="role" onchange=saveAssign(this);
											objectId="<?php echo $val->OBJECT_ID;?>">
												<option value="0">please select</option>
								<?php foreach ($role as $key=>$value):?>
									<option name="roleid" id="roleid" class="roleid"
													value="<?php echo $value->OBJECT_ID;?>"
													<?php if ($val->ROLE_OBJECT_ID == $value->OBJECT_ID):?>
													selected <?php endif;?>><?php echo $value->ROLE_NAME?></option>
								<?php endforeach;?>
						        </select></td>
										<td><?php echo $val->FIRST_NAME;?></td>
										<td><?php echo $val->LAST_NAME;?></td>
										<td><?php echo $val->USER_PHONE;?></td>
										<td><?php echo $val->USER_FAX;?></td>
										<td><?php echo $val->USER_EMAIL;?></td>
									</tr>	
							<?php endforeach;?>	
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>



	</form>
</div>
<!-- list end -->

</div>
<script type="text/javascript">
if(screen.height > 900){
	var collapsingHeight="420px";
}else{
	var collapsingHeight="220px";
}

$(document).ready(function() {
	$.unblockUI();
    var t = $('.dataTables_single').DataTable({
    	"bPaginate": false,
    	"bInfo": false,
    	"showRowNumber" : true,
    	ordering:true,
        "bSort": true,
        "bFilter": false,
        "order": [[ 1, "asc" ]], 
        "scrollY": collapsingHeight,
        "scrollX": true,
        "sScrollX": "100%",  
        "sScrollXInner": "100%",  
        "bScrollCollapse": true,
        "aoColumnDefs": [
    	           	        {
    	           	        	"bSortable": false, "aTargets": [ 0,6 ]
    	           	          }
    	           	        ],
         "language": {
            url: "/public/js/<?php echo $this->session->lan_package;?>"
        },
    	"scrollY": collapsingHeight,
    	"scrollX": true,
    	"sScrollX": "100%",  
    	"sScrollXInner": "100%",  
    	"bScrollCollapse": true  
    });
   

    $("#frm").validate({
    	 tooltip_options: {
    		 job2_code: {placement:'bottom'}

    		}, 
		submitHandler: function(form) {
			form.submit();
		},
	});
    //$("#checkall").removeAttr("class");
	$("#checkall").click(function(){
		if(this.checked){
			$("input[name='id[]']").each(function(){this.checked=true;}); 
			}else{
				$("input[name='id[]']").each(function(){this.checked=false;}); 
				}
		});
	<?php if($info['deleteflag'] == 'TRUE'):?>
	$("#error_message").html("<p><?php echo lang('message_delete_successfully');?></p>");
	$("#error_modal").modal();
	<?php elseif($info['deleteflag'] == 'FALSE'):?>
	$("#error_message").html("<p><?php echo lang('message_delete_failed');?></p>");
	$("#error_modal").modal();
	<?php endif;?>
		
	

});
function searchInternal(){
	 $.blockUI({ message: '<h3><?php echo lang('label_please_wait');?>...</h3>' });
	 $("#frm").attr("action","<?php echo site_url("Internal_user_management/search")?>");
	 $("#frm").submit();
}
function saveAssign(obj){
	var ROLE_OBJECT_ID =  $(obj).val();
	var OBJECT_ID = $(obj).attr("objectId");
	  $.ajax({
	    		type: "POST",
				url:"<?php echo site_url("Internal_user_management/save");?>",
				data:{"ROLE_OBJECT_ID":ROLE_OBJECT_ID,"OBJECT_ID":OBJECT_ID},
				success:function(msg){
					$("#error_message").html(msg);
					$("#error_modal").modal();
					}
		    });
}

function checkflag(){
	var num = $(".checkid:checked").size();
	if(num == 0){
		$("#error_message").html("<p><?php echo lang('message_multi_download_no_row_select');?></p>");
		$("#error_modal").modal();
		return false;
	}else{
		$("#frm").attr("action","<?php echo site_url("Internal_user_management/delete");?>")
		$("#frm").submit();
	}
   }

</script>