<div id="page-wrapper">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header"><?php echo lang('label_tis_supplier_user');?></h1>
		</div>
	</div>
	<!-- search field -->
	<!-- search field  end-->
	<!-- list start -->
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading panel_blue">
					<b><?php echo lang('label_tis_supplier_user_list');?> (<?php echo $count;?>)</b>
				</div>
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table
							class="table table-striped table-bordered table-hover dataTables_paging"
							id="demoTable">
							<thead>
								<tr>
									<td><?php echo lang('label_no');?></td>
									<td><?php echo lang('label_user_id');?></td>
									<td><?php echo lang('label_user_name');?></td>
									<td><?php echo lang('label_password');?></td>
									<td><?php echo lang('label_sup_code');?></td>
									<td><?php echo lang('label_sup_name');?></td>
									<td><?php echo lang('label_person_name');?></td>
									<td><?php echo lang('label_business_no');?></td>
									<td><?php echo lang('label_buyer_code');?></td>
									<td><?php echo lang('label_type');?></td>
									<td><?php echo lang('label_items');?></td>
									<td><?php echo lang('label_tel_no');?></td>
								</tr>
								<tr>
									<th><?php echo lang('label_no');?></th>
									<th><?php echo lang('label_user_id');?></th>
									<th><?php echo lang('label_user_name');?></th>
									<th><?php echo lang('label_password');?></th>
									<th><?php echo lang('label_sup_code');?></th>
									<th><?php echo lang('label_sup_name');?></th>
									<th><?php echo lang('label_person_name');?></th>
									<th><?php echo lang('label_business_no');?></th>
									<th><?php echo lang('label_buyer_code');?></th>
									<th><?php echo lang('label_type');?></th>
									<th><?php echo lang('label_items');?></th>
									<th><?php echo lang('label_tel_no');?></th>
								</tr>
							</thead>
							<tbody>	       
    							<?php foreach ($data as $key=>$val):?>		
    							<tr class="odd gradeX">
									<td class="align_middle"><?php echo $val['index'];?></td>
									<td><?php echo $val['EMP_ID'];?></td>
									<td><?php echo $val['EMP_NAME'];?></td>
									<td><?php echo $val['PASSWORD'];?></td>
									<td><?php echo $val['SUP_CODE'];?></td>
									<td><?php echo $val['SUP_NAME'];?></td>
									<td><?php echo $val['INST_NAME'];?></td>
									<td><?php echo $val['BUSI_NO'];?></td>
									<td><?php echo $val['BUYER_CODE'];?></td>
									<td><?php echo $val['UPTAE'];?></td>
									<td><?php echo $val['JONGMOK'];?></td>
									<td><?php echo $val['TEL_NO'];?></td>
								</tr>								
    							<?php endforeach;?>	      							
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- list end -->
</div>
<script>
$(document).ready(function() {
    if(screen.height > 900){
    	var collapsingHeight="520px";
    }else{
    	var collapsingHeight="355px";
    }
	//custom search filter
    $('.dataTables_paging thead td').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" />' );

    });
    
    var table=$('.dataTables_paging').DataTable({
    	"bPaginate": false,
    	"bFilter": true,
    	"bInfo": false,
		ordering:true,
        "scrollY": collapsingHeight,
        "scrollX": true,
        "sScrollX": "100%",  
        "sScrollXInner": "100%",  
        "bScrollCollapse": true,
		"language": {
   	        url: "/public/js/<?php echo $this->session->lan_package;?>"
   	    },
   	 	"initComplete": function () { 
   	 		$("#demoTable_filter").hide();
   	   	}
    });
    $('input').on('keyup change', function () {
        var index = $(this).parent().index();
        var that = table.columns(index);
        if ( that.search() !== $(this).val() ) {
            that.search( $(this).val() ).draw();
            $("#demoTable_filter").hide();
        }
    });
});

</script>