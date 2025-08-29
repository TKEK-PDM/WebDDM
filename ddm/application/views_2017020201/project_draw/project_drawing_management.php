<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><?php echo lang('label_project_drawing'); ?></h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<form class="form-horizontal searchForm" method="post"
		action="<?php echo current_url();?>" id="project_drawing">
		<div class="form-group">
			<label class="tableLabel col-lg-2 smallLabel"><?php echo lang('label_project_no'); ?></label>
			<div class="col-lg-2">
				<input class="form-control normalInput" type="text"
					name="project_no" id="project_no"
					title="<?php echo lang('message_project_no_check'); ?>"
					value="<?php echo $project_id; ?>" />
			</div>
			<label class="tableLabel col-lg-2 smallLabel"><?php echo lang('label_project_name'); ?></label>
			<div class="col-lg-4">
				<input class="form-control normalInput" type="text"
					id="project_name" readonly="readonly"
					value="<?php echo $pro_name;?>" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-6">
				<button class="btn btn-outline btn-blue buttonSpace" type="button"
					onclick="return checksearch();"><?php echo lang('button_search'); ?></button>
					<?php if($this->session->user_type == 'supplier'):?>
						<button class="btn btn-outline btn-blue buttonSpace" type="button"
					onclick="" disabled="disabled" id="multi_download"><?php echo lang('button_multi_download'); ?></button>
						<?php else:?>
						<a
					href="mailto:rira.seo@tkeap.com;jeonghyun.nam@tkeap.com?cc=seonuk.lee@tkeap.com&subject=[Web DDM] Missing Files&body=<?php echo $email_message; ?>"
					onclick="return checkemail('<?php echo $count;?>');">
					<button class="btn btn-outline btn-blue buttonSpace" type="button"
						onclick="" id="send_file_missing" disabled="disabled"><?php echo lang('button_send_mail_file_missing'); ?></button>
				</a>
						<?php endif;?>
			</div>
		</div>
	</form>
	<!-- search field  end-->

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading panel_blue">
					<b><?php echo lang('label_project_drawing_list'); ?>(<?php echo count($data);?>)</b>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<form action="<?php echo site_url('download/download_zip');?>"
							method="post" id="multi_download_form">
							<table
								class="table table-striped table-bordered table-hover dataTables_single"
								id="Projectdrawing">
								<thead>
									<tr>
									<?php if($this->session->user_type == 'supplier'):?>
										<th><input type="checkbox" name="checkall" id="checkall" /></th>
										<?php endif;?>
										<th><?php echo lang('label_no'); ?></th>
										<th><?php echo lang('label_class'); ?></th>
										<th><?php echo lang('label_dwg_no'); ?></th>
										<th><?php echo lang('label_revision'); ?></th>
										<th><?php echo lang('label_dwg_name'); ?>(EN)</th>
										<th><?php echo lang('label_dwg_name'); ?>(KO)</th>
										<th><?php echo lang('label_file_type'); ?></th>
										<th><?php echo lang('label_file_name'); ?></th>
									<?php if($this->session->user_type == 'supplier'):?>
									<th><?php echo lang('label_down_date'); ?></th>
										<th><?php echo lang('label_down_time'); ?></th>
										<th><?php echo lang('label_pdf'); ?></th>
									<?php else:?>
									<th><?php echo lang('label_pdf'); ?></th>
										<th><?php echo lang('label_dwg'); ?></th>
									<?php endif;?>
								</tr>
								</thead>
								<tbody>
							<?php foreach ($data as $key=>$value){?>
    							<tr class="odd gradeX">
    							<?php if($this->session->user_type == 'supplier'):?>
										<td class="align_middle"><input type="checkbox"
											name="file_name[]" site="<?php echo $value->SITE_NAME;?>"
											revision="<?php echo $value->REVISION;?>"
											file="<?php echo $value->FILE_NAME;?>"
											tdm_id="<?php echo $value->TDM_ID;?>"
											value="<?php echo $key;?>" /> <input type="hidden"
											name="need_check_file[]"
											value="<?php echo $value->FILE_NAME;?>"></td>
											<?php endif;?>
										<td class="align_middle"><input type="hidden"
											name="object_id[]" value="<?php echo $value->OBJECT_ID;?>"><?php echo $key+1; ?></td>
										<td><input type="hidden" name="class_id[]"
											value="<?php echo $value->CLASS_ID;?>"><?php echo $value->CLASS_NAME;?></td>
										<td><input type="hidden" name="tdm_id[]"
											value="<?php echo $value->TDM_ID;?>"><a
											onclick="showProfileCard('<?php echo $value->TDM_ID;?>','<?php echo $value->REVISION; ?>')"><?php echo $value->TDM_ID;?></a></td>
										<td class="align_middle"><?php echo $value->REVISION;?></td>
										<td><input type="hidden" name="version[]"
											value="<?php echo $value->REVISION;?>"><?php echo $value->TDM_DESCRIPTION;?></td>
										<td><?php echo $value->CN_LOCAL_DESCRIPTION;?></td>
										<td><input type="hidden" name="site[]"
											value="<?php echo $value->SITE_NAME;?>"><?php echo $value->FILE_TYPE_NAME;?></td>
										<td><a href="javascript:void(0);"
											onclick="check_file_exist(<?php echo "'".$value->FILE_NAME."','".$value->SITE_NAME."','".$value->REVISION."','".$value->OBJECT_ID."','".$value->CLASS_ID."','".$value->TDM_ID."')";?>"><?php echo $value->FILE_NAME;?></a></td>
									<?php if($this->session->user_type == 'supplier'):?>
									<td><?php echo $value->downdate;?></td>
										<td><?php echo $value->downtime;?></td>
										<?php if ($value->pdf == 'Y'):?>
    										<td><a href="javascript:void(0);"
											onclick="check_file_exist(<?php echo "'".$value->pdf_file_name."','".$value->SITE_NAME."','".$value->REVISION."','".$value->OBJECT_ID."','".$value->CLASS_ID."','".$value->TDM_ID."')";?>">
											<?php echo $value->pdf; ?>
											</a></td>
										<?php else:?>
											<td><?php echo $value->pdf; ?></td>
										<?php endif;?>
									<?php else:?>
										<?php if ($value->pdf == 'Y'):?>
    										<td><a href="javascript:void(0);"
											onclick="check_file_exist(<?php echo "'".$value->pdf_file_name."','".$value->SITE_NAME."','".$value->REVISION."','".$value->OBJECT_ID."','".$value->CLASS_ID."','".$value->TDM_ID."')";?>">
											<?php echo $value->pdf; ?>
											</a></td>
										<?php else:?>
											<td><?php echo $value->pdf; ?></td>
										<?php endif;?>
										<td><?php echo $value->dwg; ?></td>
									<?php endif;?>
								</tr>
							<?php }?>
							</tbody>
							</table>

						</form>
					</div>
					<!-- /.table-responsive -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
</div>
<div>
	<input type="hidden" name="object_id" id="object_id" value="" /> <input
		type="hidden" name="folder_object_id" id="folder_object_id" value="" />
	<input type="hidden" name="modal_flag" id="modal_flag"
		value="<?php echo $modal_flag;?>" /> <input type="hidden"
		name="folder_object_id" id="folder_object_id"
		value="<?php echo $folder_object_id;?>" /> <input type="hidden"
		name="count" id="count" value="<?php echo $count;?>" />
</div>
<script type="text/javascript">
	function checksearch() {
		if($("#project_no").val()=="") {
		    $("#project_no").tooltip("show"); 
		}else{
			$.blockUI({ message: '<h3><?php echo lang('label_please_wait');?>...</h3>' });
			// window.location="search?project_no="+$("#project_no").val();
			$("#project_drawing").attr("action","search");
			$("#project_drawing").submit();
			 
		}
	
	}
	function checkemail($count){
		if($count == 0){
			$("#error_message").html("<?php echo lang('message_all_file_exist');?>");
			$("#error_modal").modal();
	   // 	$('#error_modal').modal().css({  
		//	    'margin-top': function () {  
		//	        return ($(this).height() / 3);  
	//		    }  
	//		});  
			return false;
			}

		}
	$("#checkall").click(function(){
		if(this.checked){
			$("input[name='file_name[]']").each(function(){this.checked=true;}); 
			}else{
				$("input[name='file_name[]']").each(function(){this.checked=false;}); 
				}
		})

	$.getcheckoption = function(projectno) {
		 $.ajax({
			type: "GET",
			async: false,
			cache: false,
			url: "checkoption",
			data: {
				projectno: projectno,
			},
			beforeSend: function(){
				$(".modal-body").html('loading......');
				$('#myModal').modal('show');
			    },
		    complete: function () {
		    //	$('#myModal').modal('hide');
			    },
			success: function(msg) {
				if(jQuery.parseJSON(msg).status){
					 window.location="search?folderobjectid="+jQuery.parseJSON(msg).message+"&projectname="+jQuery.parseJSON(msg).projectname; 
					}else{
						$("#error_message").html(jQuery.parseJSON(msg).message);
						$("#error_modal").modal();
						 $("#projectname").val('');
						};
			}
		})

	};
	$(document).ready(function() {
		$.unblockUI();
	    $('.dataTables_single').DataTable({
	            responsive: true,
				ordering:true,
	        	"bFilter": false,
	        	<?php if($this->session->user_type == 'supplier'):?>
	        	"aoColumnDefs": [
	       	           	        {
	       	           	        	"bSortable": false, "aTargets": [ 0 ]
	       	           	          }
	       	           	        ],
           	    <?php endif;?>
	       	        "aaSorting":[],
	       	     "language": {
	       	        url: "/public/js/<?php echo $this->session->lan_package;?>"
	       	    }
 
	
	    });
	    if($("#modal_flag").val()==1){
	    	$("#error_message").html("<?php echo $message;?>");
			$("#error_modal").modal();
	    	//$('#myModal').modal('show');
	    	//$(".modal-body").html('<?php echo $message;?>');
	    //	$('#error_modal').modal().css({  
		//	    'margin-top': function () {  
		//	        return ($(this).height() / 3);  
		//	    }  
		//	});  
		    }else{
			    if($("#modal_flag").val()==2){
				  //  if($("#count").val() != 0){
		    		$("#send_file_missing").removeAttr("disabled");
				//	    }
		    		$("#multi_download").removeAttr("disabled");
			    }
			    }
	});
</script>
<!-- /#page-wrapper -->