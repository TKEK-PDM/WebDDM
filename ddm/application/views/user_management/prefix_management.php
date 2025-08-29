<div id="page-wrapper">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header"></h1>
		</div>
	</div>
	<form class="ng-pristine ng-valid searchForm keep" role="form" id="frm"
		method="post" action=" ">
        <div id="collapsingDiv" class="form-inline">
			<div class="form-group searchDiv">
				<div class="col-xs-12">
					<label class="tableLabel smallLabel"><?php echo lang('label_prefix_name');?></label>
					<input class="form-control normalInput" type="text" name="PREFIX"
					id="PREFIX" value="<?php echo $info['PREFIX']; ?>">
				</div>
			</div>
			<div class="form-group btn-group searchDiv5">
				<div class="col-xs-12" style="margin-bottom: 0px;">
                    <input class="btn btn-outline btn-blue buttonSpace" type="submit"
								value="<?php echo lang('button_add');?>"
                                onclick="return saveAssign();" />
				</div>
			</div>
		</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
                <div class="panel-heading panel_blue">
                <b><?php echo lang('label_prefix_list');?>(<?php echo empty($data) ? 0 : count($data); ?>)</b>
						<span class="pull-right">
							<input class="btn btn-outline btn-blue buttonSpace" type="submit"
								value="<?php echo lang('button_delete');?>"
								onclick="return checkflag();" />
						</span>
				</div>
				<div class="panel-body table_panel">
					<table class="table table-striped table-bordered table-hover"
						id="dataTables-single">
						<thead>
							<tr>
                                <th><input type="checkbox" id="checkall" /></th>
								<th><?php echo lang('label_prefix_name');?></th>
							</tr>
						</thead>
						<tbody>	
					  <?php if (!empty($data)){
                        foreach($data as $key => $value){?>				
						<tr class="odd gradeX">
                            <th><input type="checkbox" name="id[]" id="checkid"
											class="checkid" value="<?php echo $value->ID;?>"></th>	
							<td class="align_middle"><?php echo $value->PREFIX; ?></td>
						</tr>
					<?php }}else{?>
                        <tr class="odd gradeX"></tr>
                        <?php }?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
    </form>
</div>

<!-- delete modal begin-->
<div class="modal fade" id="delete_modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo lang('label_message');?></h4>
			</div>
			<div class="modal-body" id="delete_message"><?php echo lang('message_delete_supplier_confirm')?>(<b
					id="delete_count"></b>)
			</div>
			<div class="modal-footer" id="delete_modal_footer">
				<button class="btn btn-outline btn-blue buttonSpace" type="button"
					onclick="delete_prefix();"><?php echo lang('button_delete');?></button>
				<button class="btn btn-outline btn-blue buttonSpace" type="button"
					onclick="$('#delete_modal').modal('hide');"><?php echo lang('button_close');?></button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<!-- delete modal end-->

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
            "bInfo": false,
            "showRowNumber" : true,
            ordering:true,
            "bSort": true,
            "bFilter": false,
            "order": [[ 1, "asc" ]], 
            "scrollY": collapsingHeight,
            "scrollX": true,
            "sScrollX": "100%",  
            "sScrollXInner": "100%",  
            "bScrollCollapse": true,
            "scrollY": collapsingHeight,
            "scrollX": true,
            "sScrollX": "100%",  
            "sScrollXInner": "100%",  
            "bScrollCollapse": true  
	    });
	});

    function saveAssign(){
      var prefix = document.getElementById("PREFIX");
      if (!prefix.value.trim()) {
            $("#error_message").html("<p><?php echo lang('message_field_required');?></p>");
            $("#error_modal").modal();
		    return false;
        }
      else{
            $.ajax({
                    type: "POST",
                    url:"<?php echo site_url("Prefix_management/save");?>",
                    data:{"PREFIX": prefix.value},
                    success: function(msg){
                        window.location.reload(true);
                    }
                });
            return false;
        }
    }

    $("#checkall").click(function(){
		if(this.checked){
			$("input[name='id[]']").each(function(){this.checked=true;}); 
		}else{
			$("input[name='id[]']").each(function(){this.checked=false;}); 
		}
	});

    function checkflag(){
    var num = $(".checkid:checked").size();
    if(num == 0){
        $("#error_message").html("<p><?php echo lang('message_checkbox_select');?></p>");
        $("#error_modal").modal();
        return false;
    }else{
        $("#delete_count").html(num);  
        $('#delete_modal').modal({backdrop: 'static', keyboard: false});  
        return false;  
    }
    }

    function delete_prefix() {
        var selected_ids = [];
        $(".checkid:checked").each(function() {
            selected_ids.push($(this).val());
        });

        if (selected_ids.length > 0) {
            $("#frm").attr("action", "<?php echo site_url("Prefix_management/delete"); ?>"); 
            $("#frm").append('<input type="hidden" name="ids" value="' + selected_ids.join(',') + '" />');  
            $("#frm").submit();  
        }
    }

</script>