<div class="cg_mapping_table" style="border: #ccc 1px solid;width:40%;float:left">
	<?php echo lang('label_list');?>
	<table id="table1"
		class="table table-striped table-bordered table-hover">
		<tr>
			<th></th>
			<th><?php echo lang('label_sup_code');?></th>
			<th><?php echo lang('label_sup_name');?></th>
			<th><?php echo lang('label_cg');?></th>
		</tr>
		<?php foreach ($data as $key=>$val):?>
		<tr>
			<td><input type="checkbox" name="sup_code[]"
				value="<?php echo $val['SUP_CODE'];?>" /></td>
			<td><?php echo $val['SUP_CODE'];?></td>
			<td><?php echo $val['SUP_NAME'];?></td>
			<td><?php echo $val['CG'];?></td>
		</tr>
		<?php endforeach;?>
	</table>
</div>
<div id="cg_mapping_button" style="width:20%;float:left;position: relative;">
	<div style="position: absolute; left: 40%; top: 40%">
		<input type="button" value=">" id="moveRight" style="width:50px;height:35px;font-size:20px"/>
		<br /> <br />
		<input id="moveLeft" type="button" value="<" style="width:50px;height:35px;font-size:20px" />
	</div>

</div>
<div class="cg_mapping_table" style="border: #ccc 1px solid;width:40%;float:right">
	<?php echo lang('label_assigned_supplier');?>
	<table id="table2"
		class="table table-striped table-bordered table-hover">
		<tr>
			<th></th>
			<th><?php echo lang('label_sup_code');?></th>
			<th><?php echo lang('label_sup_name');?></th>
			<th><?php echo lang('label_cg');?></th>
		</tr>
	<?php foreach ($rightDate as $key=>$val):?>
	<tr>
			<td><input type="checkbox" name="sup_code[]"
				value="<?php echo $val['SUP_CODE'];?>" /></td>
			<td><?php echo $val['SUP_CODE'];?></td>
			<td><?php echo $val['SUP_NAME'];?></td>
			<td><?php echo $val['CG'];?></td>
		</tr>
	<?php endforeach;?>
	</table>
</div>

	<script type="text/javascript">
$(document).ready(function() {
	$("#moveRight").click(function(){
    	$("#table1 input:checked").each(function(){
    		var copytd = $(this).parent().parent().clone();
			$("#table2").append(copytd);
			$(this).parent().parent().remove();
        });
   	});
	$("#moveLeft").click(function(){
    	$("#table2 input:checked").each(function(){
    		var copytd = $(this).parent().parent().clone();
			$("#table1").append(copytd);
			$(this).parent().parent().remove();
        });
   	});
});
</script>