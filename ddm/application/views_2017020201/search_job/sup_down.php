<div id="page-wrapper">
	<!-- search field  end-->
	<div class="row">
		<div class="col-lg-12" style="height: 20px"></div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- list start -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading panel_blue">
					<b><?php echo lang('label_search_list');?></b>
				</div>
				<div class="panel-body table_panel">
					<form action="<?php echo site_url('download/download_zip');?>"
						method="post" id="multi_download_form">
						<table
							class="table table-striped table-bordered table-hover dataTables_single"
							id="demoTable">
							<thead>
								<tr>
									<th><input type="checkbox" id="checkall"></th>
									<th><?php echo lang('label_no');?></th>
									<th><?php echo lang('label_site_name');?></th>
									<th><?php echo lang('label_class');?></th>
									<th><?php echo lang('label_dwg_no');?></th>
									<th><?php echo lang('label_revision');?></th>
									<th><?php echo lang('label_dwg_name');?>(EN)</th>
									<th><?php echo lang('label_dwg_name');?>(KO)</th>
									<th><?php echo lang('label_file_type');?></th>
									<th><?php echo lang('label_file_name');?></th>
									<th><?php echo lang('label_down_date');?></th>
									<th><?php echo lang('label_down_time');?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $k=>$v):?>
    								<?php foreach ($v as $key=>$val):?>
    								<tr class="odd gradeX">
									<td class="align_middle"><input type="checkBox" class="file_name"
										tdm_id="<?php echo $val->TDM_ID;?>"
										revision="<?php echo $val->REVISION; ?>"
										site="<?php echo $val->SITE_NAME; ?>" name="file_name[]"
										value="<?php echo $val->FILE_NAME;?>"> 
										<div style="display: none">
										<input type="checkbox" name="site[]" value="<?php echo $val->SITE_NAME;?>"> 
										<input type="checkbox" name="version[]"	value="<?php echo $val->REVISION;?>"> 
										<input type="checkbox" name="object_id[]" value="<?php echo $val->OBJECT_ID;?>"> 
										<input type="checkbox" name="class_id[]" value="<?php echo $val->CLASS_ID;?>"> 
										<input type="checkbox" name="tdm_id[]" value="<?php echo $val->TDM_ID;?>">
										</div>
									</td>
									<td class="align_middle"></td>
									<td><?php echo $val->SITE_NAME;?></td>
									<td><?php echo $val->CLASS_NAME;?></td>
									<td><a onclick="showProfileCard(this)"><?php echo $val->TDM_ID;?></a></td>
									<td><?php echo $val->REVISION;?></td>
									<td><?php echo $val->TDM_DESCRIPTION;?></td>
									<td><?php echo $val->CN_LOCAL_DESCRIPTION;?></td>
									<td><?php echo $val->FILE_TYPE_NAME;?></td>
									<td><a
										href="#" 
										onclick='check_file_exist("<?php echo $val->FILE_NAME;?>","<?php echo $val->SITE_NAME;?>","<?php echo $val->REVISION;?>","<?php echo $val->OBJECT_ID;?>","<?php echo $val->CLASS_ID;?>","<?php echo $val->TDM_ID;?>")'><?php echo $val->FILE_NAME;?></a></td>
									<td><?php echo $val->DOWN_D;?></td>
									<td><?php echo $val->DOWN_T;?></td>
								</tr>
    								<?php endforeach;?>
								<?php endforeach;?>
							</tbody>
						</table>
						<br>
						<button class="btn btn-outline btn-blue" type="button" id="multi_download"><?php echo lang('button_multi_download');?></button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- list end -->
</div>
<div class="container">
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
		style="width: 500px; background-color: #fff; padding-right: 0px;">
		<div class="modal-header">
			<h4><?php echo lang('label_profile_card');?></h4>
		</div>
		<div class="modal-body" id="modalBody">Loading...</div>
		<div class="modal-footer" id="modalfooter">
			<button class="btn btn-outline btn-blue buttonSpace" type="button"
				onclick="$('#myModal').modal('hide');"><?php echo lang('button_close');?></button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    var t = $('.dataTables_single').DataTable({
	    	"bPaginate": false,
	    	"bFilter": false,
	    	"bInfo": false,
			ordering:false,
        	"showRowNumber" : true  
	    });
	    t.column(1).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } ).draw();

		$("#checkall").click(function(){
			var isChecked = $(this).prop("checked");
			$("input[name='file_name[]']").each(function(){
				this.checked=isChecked;
				$(this).prop('checked',isChecked).next('div').children().prop('checked',isChecked);
				});
			})
		$("input[name='file_name[]']").click(function(){
    			var isChecked = $(this).prop("checked");
    			$(this).next('div').children().prop('checked',isChecked);
			})
			
			
	});
	function showProfileCard(obj){
		$('#modalBody').html("<?php echo lang('label_please_wait');?>...");
		$('#modalfooter').hide();
		$('#myModal').modal('show');
        var TDM_ID = $(obj).html();
        var REVISION =$(obj).parent().next().html();
    	$.ajax({
    		type: "POST",
    		async: false,
    		cache: false,
    		url: "<?php echo site_url('profile_card/index'); ?>",
    		data:{
					'TDM_ID':TDM_ID,
					'REVISION':REVISION,
        		},
    		success: function(msg){
    			$('#modalBody').html(msg);

    			$('#modalfooter').show();
    		}
    	});
    	return false;
    }
</script>