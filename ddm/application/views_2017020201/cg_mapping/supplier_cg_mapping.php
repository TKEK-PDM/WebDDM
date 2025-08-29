<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><?php echo lang('label_supplier-cg_mapping'); ?></h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<form class="form-horizontal searchForm keep" id="form" method="post"
		action="">
		<input type="hidden" id="keep" name="keep" value="<?php echo $keep;?>" />
		<div class="form-group">
			<label class="tableLabel col-lg-2"><?php echo lang('label_sup_code'); ?></label>
			<div class="col-lg-4">
				<input class="form-control normalInput" name="SUP_CODE"
					id="SUP_CODE" value="<?php echo  $info['SUP_CODE'];?>" type="text">
			</div>
			<label class="tableLabel col-lg-2"><?php echo lang('label_sup_name'); ?></label>
			<div class="col-lg-4">
				<input class="form-control normalInput" name="SUP_NAME"
					id="SUP_NAME" value="<?php echo  $info['SUP_NAME'];?>" type="text">
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-12">
				<input type="hidden" name="query" id="query">
				<button class="btn btn-outline btn-blue buttonSpace" type="button"
					onclick="return submitSearch();"><?php echo lang('button_search'); ?></button>
				<?php if($this->session->user_role != '4'):?>
				<button id='add' class="btn btn-outline btn-blue buttonSpace"
					type="button"><?php echo lang('button_add'); ?></button>
				<button class="btn btn-outline btn-blue buttonSpace" type="button"
					onclick="return del();"><?php echo lang('button_delete'); ?></button>
				<?php endif;?>	
				<button class="btn btn-outline btn-blue buttonSpace" type="button"
					onclick="exportexcel();"><?php echo lang('button_excel_export'); ?></button>
				<?php if($this->session->user_role != '4'):?>
				<button class="btn btn-outline btn-blue buttonSpace" type="button"
					onclick="return importexcel();"><?php echo lang('button_excel_import'); ?></button>
				<?php endif;?>	
			</div>

		</div>

	</form>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading panel_blue">
					<b><?php echo lang('label_supplier_cg_mapping_list'); ?> (<?php echo $count;?>)</b>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<form class="form-horizontal searchForm" method="post"
							id="cg_mapping_form" action="<?php echo current_url();?>">
							<table
								class="table table-striped table-bordered table-hover dataTables_paging"
								id="SupplierCGMapping">
								<thead>
									<tr>
										<?php if($this->session->user_role != '4'):?>
										<th><input type="checkbox" name="checkall" id="checkall" /></th>
										<?php endif;?>
										<th><?php echo lang('label_no'); ?></th>
										<th><?php echo lang('label_sup_code'); ?></th>
										<th><?php echo lang('label_sup_name'); ?></th>
										<th><?php echo lang('label_cg'); ?></th>
									</tr>
								</thead>
								<tbody>
							<?php foreach ($data as $key=>$value){?>
    							<tr class="odd gradeX">
    									<?php if($this->session->user_role != '4'):?>
										<td class="align_middle"><input type="checkbox" name="check[]"
											value="<?php echo implode( ',', array( $value->SUP_CODE,$value->CG));?>" /></td>
										<?php endif;?>
										<td class="align_middle"><?php echo $key+1; ?></td>
										<td><?php echo $value->SUP_CODE;?></td>
										<td><?php echo $value->SUP_NAME;?></td>
										<td class="align_middle"><?php echo $value->CG;?></td>
									</tr>
							<?php }?>

							</tbody>
							</table>
						</form>


					</div>
					<!-- /.table-responsive -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
</div>
<div>
	<input type="hidden" name="modal_flag" id="modal_flag"
		value="<?php echo $modal_flag;?>" />
</div>
<div class="modal fade" id="import_excel" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header ui-draggable-handle"
		id="cgMapping_import_header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true"></button>
		<h4 id="myModalLabel"><?php echo lang('button_excel_import'); ?></h4>
	</div>
	<div class="modal-body">
		<form class="form-horizontal searchForm" method="post" id="file_form"
			enctype="multipart/form-data">
			<input type="file" name="import_file" id="import_file"> <input
				type="radio" name="radio_import" value="all_add" /><?php echo lang('label_all_add'); ?>
							<input type="radio" name="radio_import" value="additional" /><?php echo lang('label_additional'); ?>
					</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-blue"
			onclick="return submitimport();">import</button>
		<button type="button" class="btn btn-blue" data-dismiss="modal">Close</button>
	</div>
</div>

<div class="modal fade" id="add_modal" tabindex="-1" role="dialog"
	style="overflow: hidden;">
	<div class="modal-content">
		<!-- <div class="modal-header">
			<h4 class="modal-title"></h4>
		</div>
		<div class="modal-body"></div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close');?></button>
		</div> -->
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal -->
<script type="text/javascript">
    function submitSearch(){
			$.blockUI({ message: '<h3><?php echo lang('label_please_wait');?>...</h3>' });
			$("#query").val('search');
	        $("#form").attr("action","search");
	        $("#form").submit();
    }

    function del(){
    	if($("input[name='check[]']:checked").length < 1){
			$("#error_message").html("<?php echo lang('message_multi_download_no_row_select');?>");
			$("#error_modal").modal();
    	}else{
    		$("#cg_mapping_form").attr("action","delete");
			$("#cg_mapping_form").submit();
    	}
    }

    function exportexcel(){
        $("#query").val('export');
        $("#form").attr("action","search");
        $("#form").submit();
        }
    function importexcel(){
    	$('#import_excel').css("margin-left","-200px");
		$('#import_excel').css("left","50%");
    	$('#import_excel').css("top","175px");

    	$("#file_form p").remove();
    	$("#import_file").val('');
    	$('#import_file').modal('hide');
    	$("input:radio[name='radio_import']").attr("checked",false);
    	$("#import_excel").draggable({
		    cursor: "move",
		    handle: '#cgMapping_import_header'
		});
    	$('#import_excel').modal({backdrop: 'static', keyboard: false});
        }
    function submitimport(){
    	if($("#import_file").val()==''){
        	$("#file_form p").remove();
        	$("#import_file").after("<p style='color: red; margin-left: 20px;'><?php echo lang('message_select_import_excel');?></p>");
    		}else{
				if($("input:radio[name='radio_import']:checked").length < 1){
					$("#file_form p").remove();
		        	$("#file_form").append("<p style='color: red; margin-left: 20px;'><?php echo lang('message_select_import_option');?></p>");
					}else{
						$("#file_form").attr("action","import_file");
						$("#file_form").submit();
						}

    			}

        }


	$(document).ready(function() {
		$.unblockUI();
	    $('.dataTables_paging').DataTable({
	    	responsive: true,
			ordering:true,
        	"bFilter": false,
        	"aoColumnDefs": [
       	           	        {
       	           	        	"bSortable": false, "aTargets": [ 0 ]
       	           	          }
       	           	        ],
       	        "aaSorting":[],
       	     "language": {
       	        url: "/public/js/<?php echo $this->session->lan_package;?>"
       	    }

	    });

		$("#checkall").click(function(){
			if(this.checked){
				$("input[name='check[]']").each(function(){this.checked=true;});
				}else{
					$("input[name='check[]']").each(function(){this.checked=false;});
					}
			})
			//not pass checking
		    if($("#modal_flag").val()==1){
		    	$("#error_message").html("<?php echo $message;?>");
				$("#error_modal").modal();
			    }
	  	$("#add").click(function(){

	  		$('#add_modal').css("margin-left","-200px");
			$('#add_modal').css("left","50%");
	    	$('#add_modal').css("top","175px");
            $("#add_modal").draggable({
            		cursor: "move",
            		handle: '#add_modal_header'
            	});
            $("#add_modal").modal({
            	remote: "<?php echo site_url('Supplier_cg_mapping/add');?>",
            	backdrop: 'static',
            	keyboard: false
            })
		 })
	});
</script>
<!-- /#page-wrapper -->