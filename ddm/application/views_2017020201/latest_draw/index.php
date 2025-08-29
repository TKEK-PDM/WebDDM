<div id="page-wrapper">

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><?php echo lang('label_latest_drawing');?></h1>
		</div>
	</div>
	<form class="ng-pristine ng-valid form-horizontal" role="form"
		method="post" id="multi_download_form"
		action="<?php echo site_url('download/download_zip');?>">
		<!-- list start -->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading panel_blue">
						<b><?php echo lang('label_latest_drawing_list');?></b>
					</div>
					<div class="panel-body table_panel">
						<table
							class="table table-striped table-bordered table-hover dataTables_single"
							id="demoTable">
							<thead>
								<tr>
									<th><input type="checkBox" id="checkAll" value=""></th>
									<th><?php echo lang('label_no');?></th>
									<th><?php echo lang('label_site_name');?></th>
									<th><?php echo lang('label_class');?></th>
									<th><?php echo lang('label_dwg_no');?></th>
									<th><?php echo lang('label_my_rev');?></th>

									<th><?php echo lang('label_tkek_rev');?></th>
									<th><?php echo lang('label_dwg_name');?>(EN)</th>
									<th><?php echo lang('label_dwg_name');?>(KO)</th>
									<th><?php echo lang('label_file_type');?></th>
									<th><?php echo lang('label_file_name');?></th>
									<th><?php echo lang('label_action');?></th>
								</tr>
							</thead>
							<tbody>
                                <?php foreach($data as $key => $value){?>
								<tr>
									<td class="align_middle"><input type="checkBox"
										tdm_id="<?php echo $value->TDM_ID;?>"
										revision="<?php echo $value->REVISION; ?>"
										site="<?php echo $value->SITE_NAME; ?>"
										file="<?php echo $value->FILE_NAME;?>" name="file_name[]"
										value="<?php echo $key;?>"
										object_id="<?php echo $value->OBJECT_ID;?>"
										class_id="<?php echo $value->CLASS_ID;?>"> <input
										type="hidden" name="site[]"
										value="<?php echo $value->SITE_NAME;?>"> <input type="hidden"
										name="version[]" value="<?php echo $value->REVISION;?>"> <input
										type="hidden" name="object_id[]"
										value="<?php echo $value->OBJECT_ID;?>"> <input type="hidden"
										name="class_id[]" value="<?php echo $value->CLASS_ID;?>"> <input
										type="hidden" name="tdm_id[]"
										value="<?php echo $value->TDM_ID;?>"> <input type="hidden"
										name="need_check_file[]"
										value="<?php echo $value->FILE_NAME;?>"></td>
									<td class="align_middle"><?php echo $key+1; ?></td>
									<td class="align_middle"><?php echo $value->SITE_NAME; ?></td>
									<td><?php echo $value->CLASS_NAME; ?></td>
									<td><a
										onclick="showProfileCard('<?php echo $value->TDM_ID;?>','<?php echo $value->REVISION; ?>')"><?php echo $value->TDM_ID;?></a></td>
									<td class="align_middle"><?php echo $value->MY_REVISION; ?></td>
									<td class="align_middle"><?php echo $value->REVISION; ?></td>
									<td><?php echo $value->TDM_DESCRIPTION; ?></td>
									<td><?php echo $value->CN_LOCAL_DESCRIPTION; ?></td>
									<td><?php echo $value->FILE_TYPE_NAME; ?></td>
									<td><a
										onclick="return check_file_exist('<?php echo $value->FILE_NAME; ?>','<?php echo $value->SITE_NAME; ?>','<?php echo $value->REVISION; ?>','<?php echo $value->OBJECT_ID;?>','<?php echo $value->CLASS_ID;?>','<?php echo $value->TDM_ID;?>')"
										href="#"><?php echo $value->FILE_NAME; ?></a></td>
									<td class="align_middle"><button
											class="btn btn-outline btn-blue" type="button"
											onclick='save(
											"<?php echo $value->OBJECT_ID;?>",
											"<?php echo $this->session->uid;?>",
											"<?php echo $value->CLASS_ID;?>")'><?php echo lang('button_hide');?></button></td>
								</tr>

								<div class="modal fade" id="myModal<?php echo $key;?>"
									tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
									aria-hidden="true" data-keyboard="false" data-backdrop="false">
									<div class="modal-dialog"
										style="width: 700px; margin-top: 15%;">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal"
													aria-hidden="true">&times;</button>
											</div>
											<div class="modal-body">
												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-2"><?php echo lang('label_created_by');?></div>
														<div class="col-lg-2"><?php echo lang('label_create_date');?></div>
														<div class="col-lg-2">Create Time</div>
														<div class="col-lg-2">Modified By</div>
														<div class="col-lg-2">Modified Date</div>
														<div class="col-lg-2">Modified Time</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12">&nbsp;</div>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-2"><?php echo $value->CRT_USER; ?></div>
														<div class="col-lg-2"><?php echo $value->CRT_DATE; ?></div>
														<div class="col-lg-2"><?php echo $value->CRT_TIME; ?></div>
														<div class="col-lg-2"><?php echo $value->MOD_USER; ?></div>
														<div class="col-lg-2"><?php echo $value->MOD_DATE; ?></div>
														<div class="col-lg-2"><?php echo $value->MOD_TIME; ?></div>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default"
													data-dismiss="modal"><?php echo lang('button_close');?></button>
											</div>
										</div>
										<!-- /.modal-content -->
									</div>
									<!-- /.modal -->

                                <?php } ?>
							</div>

							</tbody>
						</table>

					</div>

				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<?php if(!empty($data)):?>
						<br>
						<button class="btn btn-outline btn-blue" type="button"
					id="multi_download" onclick=""><?php echo lang('button_multi_download');?>
						</button>
				<button class="btn btn-outline btn-blue" type="button"
					id="multi_hide" onclick=""><?php echo lang('button_multi_action');?>
						</button>
						<?php endif;?>
		</div>
		</div>
		<!-- list end -->
	</form>
</div>
<div class="modal fade" id="alert" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width: 700px; margin-top: 15%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close
				</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal -->
</div>
<div class="container">
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
		style="width: 500px; background-color: #fff; padding-right: 0px;">
		<div class="modal-header">
			<h4><?php echo lang('label_profile_card');?></h4>
		</div>
		<div class="modal-body" id="modalBody">Loading...</div>
		<div class="modal-footer" id="modalfooter">
			<button class="btn btn-outline btn-blue buttonSpace" type="button"
				onclick="$('#myModal').modal('hide');"><?php echo lang('button_close');?></button>
		</div>
	</div>
</div>
<script type="text/javascript">
if(screen.height > 900){
	 var collapsingHeight="520px";
	}else{
	 var collapsingHeight="400px";
	}

    $(document).ready(function() {
    	$.unblockUI();
        $('.dataTables_single').DataTable({
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
            ordering:true,
            "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0 ] }],
            "aaSorting":[],
            "scrollY": collapsingHeight,
        	"scrollX": true,
        	"sScrollX": "100%",
        	"sScrollXInner": "100%",
        	"bScrollCollapse": true
        });
    });

    //checkBox
    $("#checkAll").click(function(){
		if(this.checked){
			$("input[name='file_name[]']").each(function(){this.checked=true;});
		}else{
			$("input[name='file_name[]']").each(function(){this.checked=false;});
		}
	});

    $("#multi_hide").on('click',function(){
    	if($("input[name='file_name[]']:checked").length < 1){
			$("#error_message").html("<?php echo lang('message_multi_download_no_row_select');?>");
			$("#error_modal").modal();
			return false;
		}
        var object_id_str = "";
        var class_id_str = "";
    	$("input[name='file_name[]']").each(function(){
        	if(this.checked){
            	if(object_id_str == ""){
            		object_id_str = $(this).attr("object_id");
            		class_id_str = $(this).attr("class_id");
                }else{
                	object_id_str = object_id_str + ',' + $(this).attr("object_id");
                	class_id_str = class_id_str + ',' + $(this).attr("class_id");
                }
            }
        });
    	$.ajax({
    		type: "POST",
			url:"<?php echo site_url("latest_draw/multi_hide");?>",
			data:{"object_id_str":object_id_str,"class_id_str":class_id_str},
			beforeSend:$.blockUI({ message: '<h3><?php echo lang('label_hidding');?></h3>' }),
			success: function(msg){
				 window.location.reload(true)
			   }
	    })


    });

	function save(object_id,sup_code,class_id){
	    $.ajax({
	    		type: "POST",
				url:"<?php echo site_url("latest_draw/save");?>",
				data:{"object_id":object_id,"sup_code":sup_code,"class_id":class_id},
				beforeSend:$.blockUI({ message: '<h3><?php echo lang('label_hidding');?></h3>' }),
				success: function(msg){
					 window.location.reload(true)
				   }
		    })
		}


</script>