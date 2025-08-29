<!-- multi select -->
<div class="modal fade" id="cg_mapping" tabindex="-1" role="dialog" style="overflow:hidden;">
	<div class="modal-header" id="cg_mapping_header">
		<h4><?php echo lang('label_select_supplier');?></h4>
	</div>
	<div class="modal-body" id="modalBody_cg_mapping" style="width:100%">
		<form id="cg_mapping_form" name="cg_mapping_form"
			class="ng-pristine ng-valid searchForm" role="form" method="post">
			<input type="hidden" id="hidObj" />
			<div class="row">
				<label class="col-lg-2"><?php echo lang('label_dwg_no');?> </label>
				<input
					type="text" id="search_dwg_no" name="TDM_ID" class="col-lg-3"
					readonly="readonly" /> <label class="col-lg-2"><?php echo lang('label_cg_filter');?></label>
				<input type="text" id="cg_filter" name="cg_filter" class="col-lg-3" />
				<button class="btn btn-outline btn-blue buttonSpace" type="button"
					onclick="searchSupCG()"
					style="padding: 0px 5px; margin-left: 10px;"><?php echo lang('label_search');?></button>
			</div>
			<div class="row">
				<hr />
			</div>
			<div class="row cg_mapping_div" style="width:100%"><?php echo lang('label_please_wait');?> ...</div>

		</form>
	</div>
	<div class="modal-footer" id="modalfooter_cg_mapping">
		<button class="btn btn-outline btn-blue buttonSpace" type="button"
			onclick="save_cg_mapping()"><?php echo lang('button_save');?></button>
		<button class="btn btn-outline btn-blue buttonSpace" type="button"
			onclick="flushCss();"><?php echo lang('button_close');?></button>
	</div>
</div>
<!-- multi select end -->
<script type="text/javascript">
	
    function show_CG_mapping(obj,tdm_id,cg){
        $("#search_dwg_no").val(tdm_id);
        $("#cg_filter").val(cg);      
        window.operateRow = $(obj);
        searchSupCG();
    }
    
    function searchSupCG(){
        var tdm_id =  $("#search_dwg_no").val();
        var cg = $("#cg_filter").val();
        $('.cg_mapping_div').html("<?php echo lang('label_please_wait');?> ...");
    	//$('#cg_mapping').modal('show');	
    	$("#cg_mapping").draggable({
		     cursor: "move",
		     handle: '#cg_mapping_header'
		});
    	$('#cg_mapping').modal({backdrop: 'static', keyboard: false});
		$('#modalfooter_cg_mapping').hide();
    	$.ajax({
    		type: "POST",
    		async: false,
    		cache: false,
    		url: "<?php echo site_url('assign_supplier/index'); ?>",
    		data:{
					'TDM_ID':tdm_id,
					'cg_filter':cg,
        		},
    		success: function(msg){
    			$('.cg_mapping_div').html(msg);
    			$('#modalfooter_cg_mapping').show();
    		}
    	});
    }

    function save_cg_mapping(){
		$("#table2 input[type='checkbox']").prop("checked",true);
		$("#table1 input[type='checkbox']").prop("checked",false);

    	$.ajax({
    		type: "POST",
    		async: false,
    		cache: false,
    		url: "<?php echo site_url('assign_supplier/assignSupplier'); ?>",
    		data:$("#cg_mapping_form").serialize(),
    		success: function(msg){
    			if(msg=='successfully'){
        			
					var num = $("#table2 input[type='checkbox']").size();
					var fistSup = $("#table2 input[type='checkbox']").eq(0).val() || "";
					var firstSupName = $("#table2 tr:eq(1) td:eq(2)").html() || "";
					var obj = $(operateRow).parent().parent().parent().children().has("input[name='tdm_id[]'][value="+$("#search_dwg_no").val()+"]")
					if(num>1){
						$(".supNum",obj).html("("+num+")");
					}else{
						$(".supNum",obj).html("");
					}
					$(".supNumA",obj).html(num);
					$(".firstSupCode",obj).html(fistSup);
					$(".firstSupName",obj).html(firstSupName);
					$('#cg_mapping').modal('hide');
            	}
    		}
    	});
    }

    function flushCss(){
    	$('#cg_mapping').modal('hide');
    	setTimeout(function(){
        	$('#cg_mapping').css("left","50%");
        	$('#cg_mapping').css("margin-left","-500px");
        	$('#cg_mapping').css("top","100px");
        	$('#cg_mapping').css("bottom-left","100px");
        },1000);
    }
</script>