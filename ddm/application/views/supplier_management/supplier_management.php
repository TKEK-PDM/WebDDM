<div id="page-wrapper">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header"><?php echo lang('label_supplier_user_management');?>
			<div style="float: right">
					<button class="btn btn-outline btn-blue buttonSpace"
						onclick="return collapsingDiv()" id="collapsing">
						<span class="glyphicon glyphicon-chevron-up" aria-hidden="true" />
					</button>
				</div>
			</h1>
		</div>
	</div>
	<!-- search field -->
	<form class="form-horizontal searchForm keep" id="frm" role="form"
		method="post" action="">
		<input type="hidden" id="keep" name="keep" value="<?php echo $keep;?>" />
		<div id="collapsingDiv" class="form-inline">
			<div class="form-group searchDiv5">				
				<div class="col-xs-12">
					<label class="tableLabel smallLabel"><?php echo lang('label_supplier_user_id');?></label>
					<input class="form-control normalInput" type="text" name="EMP_ID"
					id="EMP_ID" value="<?php echo  $info['EMP_ID'];?>">
				</div>
			</div>
			<div class="form-group searchDiv5">
				<div class="col-xs-12">
					<label class="tableLabel smallLabel"><?php echo lang('label_supplier_user_name');?></label>
					<input class="form-control normalInput" type="text" name="EMP_NAME"
						id="EMP_NAME" VALUE="<?php echo $info['EMP_NAME'];?>">
				</div>
			</div>
			
			<div class="form-group searchDiv5 btn-group">
				<div class="col-xs-12">
					<button class="btn btn-outline btn-blue buttonSpace" type="button"
					onclick="searchSupplier();"><?php echo lang('button_search');?></button>
				</div>
			</div>
		</div>

		<!-- search field  end-->
		<!-- list start -->
		<div class="form-group">
			<div class="col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading panel_blue">
						<b><?php echo lang('label_supplier_user_list');?>(<?php echo count($data);?>)</b>
					</div>
					<div class="panel-body table_panel">
						<table
							class="table table-striped table-bordered table-hover dataTables_single"
							id="demoTable">
							<thead>
								<tr>
									<th><?php echo lang('label_no');?></th>
									<th><?php echo lang('label_user_id');?></th>
									<th><?php echo lang('label_user_name');?></th>
									<!-- <th><?php echo lang('label_password');?></th>  -->
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $key=>$val):?>
							<tr class="odd gradeX">
									<td class="align_middle"><?php echo $key+1;?></td>
									<td><?php echo $val->EMP_ID;?></td>
									<td><?php echo $val->EMP_NAME;?></td>
									<!-- <td><?php echo $val->PASSWORD;?></td>  -->
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
<script type="text/javascript">
if(screen.height > 900){
	 var collapsingHeight="450px";
	}else{
	 var collapsingHeight="280px";
	}
$(document).ready(function() {
	$.unblockUI();
    var t = $('.dataTables_single').DataTable({
    	"bPaginate": false,
    	"bFilter": false,
    	"bInfo": false,
		ordering:false,
    	"showRowNumber" : true,
    	ordering:true,
        "bSort": true,
        "bFilter": false,
        "scrollY": collapsingHeight,
        "scrollX": true,
        "sScrollX": "100%",  
        "sScrollXInner": "100%",  
        "bScrollCollapse": true,
        "language": {
   	        url: "/public/js/<?php echo $this->session->lan_package;?>"
   	    }
    });
   
    $("#frm").validate({
    	 tooltip_options: {
    		 job2_code: {placement:'bottom'}

    		}, 
		submitHandler: function(form) {
			form.submit();
		},
	});
});
	
	function searchSupplier(){
		$.blockUI({ message: '<h3><?php echo lang('label_please_wait');?>...</h3>' });
		 $("#frm").submit();
	}
</script>