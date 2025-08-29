<div id="page-wrapper">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header"><?php echo lang('label_download_log');?></h1>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading panel_blue">
					<b></b>
				</div>
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table
							class="table table-striped table-bordered table-hover dataTables_paging"
							id="downloadlog">
							<thead>
								<tr>
									<th><?php echo lang('label_no');?></th>
									<th><?php echo lang('label_object_id');?></th>
									<th><?php echo lang('label_class');?></th>
									<th><?php echo lang('label_dwg_no');?></th>
									<th><?php echo lang('label_revision');?></th>
									<th><?php echo lang('label_user_type');?></th>
									<th><?php echo lang('label_user_id');?></th>
									<th><?php echo lang('button_sup_code');?></th>
									<th><?php echo lang('label_user_name');?></th>
									<th><?php echo lang('label_down_date');?></th>
									<th><?php echo lang('label_down_time');?></th>
								</tr>
							</thead>
							<tbody>	
					    <?php foreach($data as $key => $value):?>				
						<tr class="odd gradeX">
									<td class="align_middle"><?php echo $key+1; ?></td>
									<td><?php echo $value->OBJECT_ID; ?></td>
									<td><?php echo $value->CLASS_ID; ?></td>
									<td><?php echo $value->TDM_ID; ?></td>
									<td><?php echo $value->REVISION; ?></td>
									<td><?php echo $value->USER_TYPE; ?></td>
									<td><?php echo $value->USER_ID; ?></td>
									<td><?php echo $value->SUP_CODE; ?></td>
									<td><?php echo $value->USER_NAME; ?></td>
									<td><?php echo $value->DOWN_D; ?></td>
									<td><?php echo $value->DOWN_T; ?></td>
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
	    $('.dataTables_paging').DataTable({
	    	responsive: true,
	    	ordering:true,
	        "bSort": true,
	        "bFilter": false,
             "language": {
                url: "/public/js/<?php echo $this->session->lan_package;?>"
            }
        	

	    });     	
	});

</script>