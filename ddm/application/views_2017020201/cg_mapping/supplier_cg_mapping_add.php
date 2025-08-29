<div class="cg_mapping_add" style="margin-left:0px">
	<div class="modal-header ui-draggable-handle" id="add_modal_header">
			<h4><?php echo lang('label_supplier-cg_mapping'); ?></h4> 
	</div>
	<div class="modal-body" style="width:100%">
    	<form class="searchForm" role="form">
    		<div class="row">
    			<label class="tableLabel col-xs-2 smallLabel"><?php echo lang('label_sup_code'); ?></label>
    			<input class="form-control normalInput col-xs-3" type="text" id="sup_code"
    					name="sup_code" value="<?php echo $sup_code;?>" style="width:150px;">
    			<button class="btn btn-outline btn-blue buttonSpace" type="button"
    					onclick="return checkcode();" style="margin-left:10px"><?php echo lang('button_check'); ?></button>
    		</div>
    		<div class="row"  style="margin-top: 10px">
    			<label class="tableLabel col-xs-2 smallLabel"><?php echo lang('label_sup_name'); ?></label>
    			<input class="form-control normalInput" type="text"
    					readonly="readonly" id="sup_name" name="sup_name"
    					value="<?php echo $sup_name;?>" style="width:150px;">
    		</div>
    		<div class="row" style="margin-top: 10px">
    			<label class="tableLabel col-xs-2 smallLabel"><?php echo lang('label_cg'); ?></label>
    			<input class="form-control normalInput" type="text" id="cg"
    					name="cg" value="<?php echo $cg;?>" style="width:150px;">
    		</div>
    		<div class="row"  style="margin-top: 10px">
    			<div class="col-lg-12">
    				<button class="btn btn-outline btn-blue buttonSpace" type="button"
    					onclick="return save('save');"><?php echo lang('button_save'); ?></button>
    				<button class="btn btn-outline btn-blue buttonSpace" type="button"
    					onclick="return save('new');"><?php echo lang('button_save_new'); ?></button>
    				<button id="close" class="btn btn-outline btn-blue buttonSpace" type="button"><?php echo lang('button_close'); ?></button>
    			</div>
    		</div>
    	</form>
    </div>
</div>
<div>
	<input type="hidden" name="modal_flag" id="modal_flag"
		value="<?php echo $modal_flag;?>" />
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true"></button>
				<h4 class="modal-title" id="myModalLabel">Message</h4>
			</div>
			<div class="modal-body"><?php echo $message;?></div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close
				</button> -->
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /#page-wrapper -->
<script type="text/javascript">
    function checkcode(){
    	$.getsuppliername($("#sup_code").val());	
    }
    function save($action){
		if($("#cg").val() == '' || isNaN($("#cg").val())){
			$("#error_message").html("<?php echo lang('message_cg_not_number');?>");
			$("#error_modal").modal();
			}else{
				if($("#sup_name").val() == ''){
					$("#error_message").html("<?php echo lang('message_retry_check_button');?>");
					$("#error_modal").modal();
				}else{
					//window.location="save?sup_code="+$('#sup_code').val()+"&cg="+$('#cg').val()+"&sup_name="+$('#sup_name').val()+"&action="+$action;
					$.ajax({
							'type':'post',
							'dataType':'json',
							'url':"<?php echo site_url('Supplier_cg_mapping/save');?>",
							'data':{'sup_code':$.trim($('#sup_code').val()),'cg':$('#cg').val(),'sup_name':$('#sup_name').val(),'action':$action},
							'success':function(msg){
								 if(msg.status == false){
									 	$("#error_message").html(msg.message);
										$("#error_modal").modal();
									 }else if($action == 'save'){
										 	$("#error_message").html(msg.message);
											$("#error_modal").modal();
											$("#cg,#sup_code,#sup_name").val('');
												 window.location='search';
										 }else{
											 	$("#error_message").html(msg.message);
												$("#error_modal").modal();
											 	$("#cg").val('');
											 	$("#close").click(function(){
													 window.location='search';
													})
											 }
								}
						})
				}

			}
        }
	$.getsuppliername = function(sup_code) {
		 $.ajax({
			type: "GET",
			async: false,
			cache: false,
			url: "get_supplier_name",
			data: {
				sup_code: $.trim(sup_code),
			},
			beforeSend: function(){
				//$(".modal-body").html('loading......');
			//	$('#myModal').modal('show');
			    },
		    complete: function () {
		    //	$('#myModal').modal('hide');
			    },
			success: function(msg) {
				if(jQuery.parseJSON(msg).status){
					 $("#sup_name").val(jQuery.parseJSON(msg).data); 
					}else{
						$("#error_message").html(jQuery.parseJSON(msg).message);
						$("#error_modal").modal();
				    //	$('#error_modal').modal().css({  
					//	    'margin-top': function () {  
					//	        return ($(this).height() / 3);  
					//	    }  
					//	});
						 $("#sup_name").val('');
						};
			}
		})

	};

	$(document).ready(function() {
		 if($("#modal_flag").val()==1){
			 $("#error_message").html("<?php echo $message;?>");
				$("#error_modal").modal();
		    //	$('#error_modal').modal().css({  
			//	    'margin-top': function () {  
			//	        return ($(this).height() / 3);  
			//	    }  
			//	});  
			    }
		//$.unblockUI();
		$("#close").click(function(){
			$("#cg,#sup_code,#sup_name").val('');
			$('#add_modal').modal('hide');
			})
	});


</script>