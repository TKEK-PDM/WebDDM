<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><?php echo lang('label_role_management');?></h1>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading panel_blue">
					<b><?php echo lang('label_role_list');?>(<?php echo count($data);?>)</b>
				</div>
				<div class="panel-body table_panel">
					<table class="table table-striped table-bordered table-hover"
						id="dataTables-single">
						<thead>
							<tr>
								<th><?php echo lang('label_no');?></th>
								<th><?php echo lang('label_object_id');?></th>
								<th><?php echo lang('label_role_name');?></th>
							</tr>
						</thead>
						<tbody>	
					  <?php foreach($data as $key => $value){?>				
						<tr class="odd gradeX">
								<td class="align_middle"><?php echo $key+1; ?></td>
								<td><?php echo $value->OBJECT_ID; ?></td>
								<td><?php echo $value->ROLE_NAME; ?></td>
							</tr>
					<?php }?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    $('.dataTables_paging').DataTable({
	            responsive: true,
				ordering:false,
	        	"bFilter": false 
	
	    });
	});
	$(document).ready(function() {
	    $('.dataTables_single').DataTable({
	    	"bPaginate": false,
	    	"bFilter": false,
	    	"bInfo": false,
			ordering:false
	    });
	});
</script>