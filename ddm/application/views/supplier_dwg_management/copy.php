<!-- list start -->
<div class="row">
	<div class="col-xs-12">

		<form action="" method="post" id="form">
			<table class="table table-striped table-bordered" id="copy_table1">
				<tbody>
					<tr>
						<td style="background-color: #fff; text-align: left;" colspan="5"><strong><?php echo lang('label_from_a');?></strong></td>
					</tr>
					<tr>
						<td><?php echo lang('label_supplier_code');?></td>
						<td><input type="text" id="sup_code_from" name="sup_code_from"
							readonly value="<?php echo $sup_code_from;?>"></td>
						<td><button id="search_sup_from" onclick="return get_suppliers(0)">...</button></td>
						<td><?php echo lang('label_supplier_name');?></td>
						<td><input type="text" id="sup_name_from" name="sup_name_from"
							disabled="disabled" value="<?php echo $sup_name_from;?>"></td>
					</tr>

					<tr>
						<td style="background-color: #fff; text-align: left;" colspan="5"><strong><?php echo lang('label_to_b');?></strong></td>
					</tr>
					<tr>
						<td><?php echo lang('label_supplier_code');?></td>
						<td><input type="text" id="sup_code_to" name="sup_code_to"
							readonly value=""></td>
						<td><button id="search_sup_to" onclick="return get_suppliers(1)">...</button></td>
						<td><?php echo lang('label_supplier_name');?></td>
						<td><input type="text" id="sup_name_to" name="sup_name_to"
							disabled="disabled" value=""></td>
					</tr>
				</tbody>
			</table>

			<button class="btn btn-outline btn-blue buttonSpace" type="button"
				id="" onclick="copy()"><?php echo lang('button_copy');?></button>

		</form>

	</div>
</div>

<!-- test modal begin-->
<div class="container">
	<div class="modal" id="selectSupplierModal" tabindex="1" role="dialog">
		<div class="modal-header" id="selectSupplierModalHeader">
			<h4><?php echo lang('label_select_supplier');?></h4>
		</div>
		<div class="modal-body" id="selectSupplierModalBody"><?php echo lang('label_please_wait')?>...</div>
		<div class="modal-footer" id="selectSupplierModalfooter">
			<button class="btn btn-outline btn-blue buttonSpace" type="button"
				onclick="flushCss();"><?php echo lang('button_close');?></button>
		</div>
	</div>
</div>
<!-- test modal end-->

<div class="modal fade" id="copy_check_modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo lang('label_message');?></h4>
			</div>
			<div class="modal-body" id="copy_check_message"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default"
					onclick="$('#copy_check_modal').modal('hide')";><?php echo lang('button_close');?></button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>


<script>
function copy(){
	var sup_code_from = $("#sup_code_from").val();
	var sup_code_to = $("#sup_code_to").val();

	var sup_name_from = $("#sup_name_from").val();
	var sup_name_to = $("#sup_name_to").val();
	if(sup_code_from == ""){
		$('#copy_check_message').html("<?php echo lang('message_source_supplier_code');?>");
		$('#copy_check_modal').modal('show');
		return false;
	}
	if(sup_code_to ==""){
		$('#copy_check_message').html("<?php echo lang('message_destination_supplier_code');?>");
		$('#copy_check_modal').modal('show');
		return false;
	}
	$.ajax({
		type: "POST",
		async: false,
		cache: false,
		url: "<?php echo site_url('supplier_dwg_management/copy_insert'); ?>",
		data:{
				'sup_code_from':sup_code_from,
				'sup_code_to':sup_code_to
    		},
		success: function(msg){

			$('#profile_card_header').modal('hide');
			$('#copy_check_message').html(msg+ " <?php echo lang('message_assigned_drawing_copy');?>(  " +sup_name_from+ "->"+sup_name_to+"  )");
			$('#copy_check_modal').modal('show');
		}
	});
	return false;

}
function get_suppliers(attr){
	$('#selectSupplierModalBody').html("<?php echo lang('label_please_wait')?>...");
	$('#selectSupplierModal').modal({backdrop: 'static', keyboard: false});
	$.ajax({
		type: "POST",
		async: false,
		cache: false,
		url: "<?php echo site_url('supplier_dwg_management/get_all_suppliers'); ?>",
		data:{
			'from_to':attr
		},
		success: function(msg){
			$('#selectSupplierModalBody').html(msg);
			$('#selectSupplierModal').modal({backdrop: 'static', keyboard: false});
			$("#selectSupplierModal").draggable({
	    		cursor: "move",
	    		handle: '#selectSupplierModalHeader'
	    	});
			$('#selectSupplierModalBody').show();
		}
	});


	return false;
}

function flushCss(){
	$('#selectSupplierModal').modal('hide');
	setTimeout(function(){
    	$('#selectSupplierModal').css("left","50%");
    	$('#selectSupplierModal').css("margin-left","-300px");
    },1000);
}

</script>