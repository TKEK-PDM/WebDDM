<!-- list start -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default" style="margin-bottom: 0px;">
			<div class="panel-body table_panel supplier_table">
				<form action="" method="post" id="form">
					<table
						class="table table-striped table-bordered table-hover dataTables_paging"
						id="copy_table1">
						<thead>
							<tr>
								<th><?php echo lang('label_no');?></th>
								<th><?php echo lang('label_supplier_code');?></th>
								<th><?php echo lang('label_supplier_name');?></th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($data as $key => $val):?>
						<tr>
								<td><?php echo $key+1;?></td>
								<td><a href="#"
									onclick="fill_supplier_info('<?php echo $val->SUP_CODE;?>','<?php echo $val->SUP_NAME;?>')"><?php echo $val->SUP_CODE;?></a></td>
								<td><a href="#"
									onclick="fill_supplier_info('<?php echo $val->SUP_CODE;?>','<?php echo $val->SUP_NAME;?>')"><?php echo $val->SUP_NAME;?></a></td>
							</tr>
						<?php endforeach?>
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>


<script>
function fill_supplier_info(sup_code,sup_name){
	//from
	<?php if($from_to == 0):?>
	$("#sup_code_from").val(sup_code);
	$("#sup_name_from").val(sup_name);
	<?php endif;?>
	//to
	<?php if($from_to == 1):?>
	$("#sup_code_to").val(sup_code);
	$("#sup_name_to").val(sup_name);
	<?php endif;?>
	$('#selectSupplierModal').modal('hide');
}
</script>