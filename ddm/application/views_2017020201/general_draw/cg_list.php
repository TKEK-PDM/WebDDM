<!-- list start -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default" style="margin-bottom: 0px;">
			<div class="panel-body table_panel cg_list_table">
				<table
					class="table table-striped table-bordered table-hover dataTables_paging_cg"
					id="">
					<thead>

						<tr>
							<th><?php echo lang('label_no');?></th>
							<th><?php echo lang('button_cg');?></th>
							<th><?php echo lang('label_part_no');?></th>
							<th><?php echo lang('label_part_name');?></th>
							<th><?php echo lang('label_draw_no');?></th>
						</tr>
					</thead>
					<tbody>
							<?php foreach ($data as $key=>$val):?>
						<tr class="odd gradeX">
							<td><?php echo $key+1;?></td>
							<td class="align_middle"><?php echo $val->CG;?></td>
							<td style="text-align: left;"><?php echo $val->PART_CODE;?></td>
							<td style="text-align: left;"><?php echo $val->PART_NAME;?></td>
							<td style="text-align: left;"><?php echo $val->DRAW_CODE;?></td>
						</tr>
    						<?php endforeach;?>
						</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		 var table = $('.dataTables_paging_cg').DataTable({
		    	"bPaginate": false,
	            responsive: true,
				ordering:false,
	        	"bFilter": false,
	        	"bInfo": false

	    });
	});
</script>