<!-- list start -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default" style="margin-bottom: 0px;">
			<div class="panel-body table_panel">
				<table
					class="table table-striped table-bordered table-hover dataTables_paging"
					id="demoTable">
					<thead>

						<tr>
							<th><?php echo lang('label_no');?></th>
							<th><?php echo lang('label_column');?></th>
							<th><?php echo lang('label_value');?></th>
						</tr>
					</thead>
					<tbody>
							<?php $i=1; ?>
							<?php foreach ($data as $key=>$val):?>
							<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td style="text-align: left;"><?php echo $key;?></td>
							<td style="text-align: left;"><?php echo $val;?></td>
						</tr>
    						<?php $i++;?>
    						<?php endforeach;?>
						</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		 var table = $('.dataTables_paging').DataTable({
		    	"bPaginate": false,
	            responsive: true,
				ordering:false,
	        	"bFilter": false,
	        	"bInfo": false,
	        	"language": {
	       	        url: "/public/js/<?php echo $this->session->lan_package;?>"
	       	    }

	    });
	});
</script>