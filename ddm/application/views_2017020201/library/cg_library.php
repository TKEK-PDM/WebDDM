<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><?php echo lang('label_cg_library');?></h1>
		</div>
	</div>
	<form class="form-horizontal  searchForm" method="post" id="frm">
		<div class="form-group col-lg-12">
			<input type="hidden" id="query" name="query" />
			<button class="btn btn-outline btn-blue buttonSpace" type="button"
				onclick="exportList()"><?php echo lang('button_export');?></button>
		</div>

		<!-- list start -->
		<div class="form-group">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading panel_blue">
						<b><?php echo lang('label_cg_library_list');?> (<?php echo $count;?>)</b>
					</div>
					<div class="panel-body table_panel">
						<table
							class="table table-striped table-bordered table-hover dataTables_single"
							id="cgLibraryTable">
							<thead>

								<tr>
									<th><?php echo lang('label_no');?></th>
									<th><?php echo lang('label_block');?></th>
									<th><?php echo lang('label_box');?></th>
									<th><?php echo lang('label_cg');?></th>
									<th><?php echo lang('label_conponent_group_naming');?></th>
									<th><?php echo lang('label_pur');?></th>
									<th><?php echo lang('label_pur_code');?></th>
									<th><?php echo lang('label_sp');?></th>
									<th><?php echo lang('label_mm');?></th>
								</tr>
							</thead>
							<tbody>			
							<?php foreach ($data as $key=>$val):?>		
							<tr class="odd gradeX">
									<td class="align_middle"><?php echo $key+1?></td>
									<td class="align_middle"><?php echo $val->BLOCK_CODE;?></td>
									<td class="align_middle"><?php echo $val->BOX_NO;?></td>
									<td class="align_middle"><?php echo $val->CG;?></td>
									<td><?php echo $val->CG_NAME;?></td>
									<td><?php echo $val->PUR;?></td>
									<td class="align_middle"><?php echo $val->PUR_CODE;?></td>
									<td><?php echo $val->SP;?></td>
									<td><?php echo $val->MM;?></td>
								</tr>								
							<?php endforeach;?>		
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</form>
	<!-- list end -->
</div>
<script>
    if(screen.height > 900){
    	var collapsingHeight="400px";
    }else{
    	var collapsingHeight="335px";
    }
    $(document).ready(function() {
        var t = $('.dataTables_single').DataTable({
        	"bPaginate": false,
        	"bFilter": false,
        	"bInfo": false,
    		ordering:true,
            "scrollY": collapsingHeight,
            "scrollX": true,
            "sScrollX": "100%",  
            "sScrollXInner": "100%",  
            "bScrollCollapse": true,
    		"language": {
       	        url: "/public/js/<?php echo $this->session->lan_package;?>"
       	    }
        });
       /* t.column(0).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } ).draw();*/
    });
    function exportList(){
    	$("#query").val("export");
    	$("#frm").submit();
    }
</script>