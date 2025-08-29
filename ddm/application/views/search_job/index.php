<style type="text/css">
.mask {
	position: absolute;
	top: 0px;
	filter: alpha(opacity = 60);
	background-color: #777;
	z-index: 1002;
	left: 0px;
	opacity: 0.5;
	-moz-opacity: 0.5;
}
.panel-heading{
	height: 40px;
}
</style>
<div id="page-wrapper">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header"><?php //echo lang('label_search_job');?>
			
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
	<form class="form-horizontal searchForm keep" id="serach_job"
		method="post" action="<?php echo current_url();?>">
		<input type="hidden" id="keep" name="keep" value="<?php echo $keep;?>" />
		<div id="collapsingDiv" class="form-inline">
			<div class="form-group searchDiv5">
				<div class="col-xs-12 form-inline" >
					<label class="tableLabel smallLabel"><?php echo lang('label_job_no');?></label>
					<input class="form-control normalInput" type="text"
						name="job1_code" required="required"
						value="<?php echo $info->job1_code;?>"
						style="display: inline-block; width: calc(100% - 40px) !important;"> <input
						style="width: 40px !important; display: inline-block;"
						class="form-control normalInput" type="text" name="job2_code"
						required="required" value="<?php echo $info->job2_code;?>"
						onchange="this.value=this.value.toUpperCase()">
				</div>
			</div>
			<div class="form-group searchDiv5">
				<div class="col-xs-12">
					<label class="tableLabel smallLabel"><?php echo lang('label_project_name');?></label>
					<input class="form-control normalInput" type="text" disabled
						value="<?php echo $info->project_name;?>">
				</div>

			</div>
			<div class="form-group searchDiv5">
				<div class="col-xs-12" >
					<label class="tableLabel smallLabel"><?php echo lang('label_me');?></label>
					<select class="form-control" name="clas_kind">
						<option value="M" <?php if($info->clas_kind == 'M'):?> selected
							<?php endif;?>>Mechanical</option>
						<option value="E" <?php if($info->clas_kind == 'E'):?> selected
							<?php endif;?>>Electrical</option>
					</select>
				</div>
			</div>
			<div class="form-group searchDiv5">
				<div class="col-xs-12">
				<label class="tableLabel smallLabel"><?php echo lang('label_production_class');?></label>
					<input class="form-control normalInput" type="text" disabled
						value="<?php echo $info->production_class;?>">
				</div>
			</div>
			<div class="form-group searchDiv5">
				<div class="col-xs-12" >
				<label class="tableLabel smallLabel"><?php echo lang('label_job_qty');?></label>
					<input class="form-control normalInput"
						type="text" name="job_qty" disabled
						value="<?php echo $info->job_qty;?>">
				</div>
			</div>
			<div class="form-group searchDiv5">
				<div class="col-xs-12">
				<label class="tableLabel smallLabel"><?php echo lang('label_spec');?></label>
					<input class="form-control normalInput" type="text" disabled
						value="<?php echo $info->spec;?>">
				</div>
			</div>
			<div class="form-group searchDiv5" style="max-widht:150px">
				<div class="col-xs-12">
				<label class="nav-justified" style="font-size:14px"><input type="checkbox" name="level" value="1"
							<?php if($info->level == 1):?> checked="checked" <?php endif;?>>
								<?php echo lang('label_show_1_level');?> </label>
				</div>
			</div>
			<div class="form-group btn-group searchDiv5">
				<div class="col-xs-12">
					<!-- <label class="nav-justified" style="font-size:14px"><input type="checkbox" name="level" value="1"
							<?php if($info->level == 1):?> checked="checked" <?php endif;?>>
								<?php echo lang('label_show_1_level');?> </label> -->
							<button class="btn btn-outline btn-blue buttonSpace" type="submit"
					onclick="" id="search" style="width:100%"><?php echo lang('button_search');?></button>
				</div>
			</div>
		</div>
		<!-- search field  end-->
		<!-- list start -->
		<div class="form-group" style="margin-bottom: 0px;">
			<div class="col-xs-12">
				<div class="panel">
					<div class="panel-heading panel_blue">
						<b><?php echo lang('label_search_list');?>(<?php echo count($data);?>)</b>
						
						<span class="pull-right">
							
							<button class="btn btn-outline btn-blue buttonSpace" type="button"
								onclick="" id="check_file_exist" style="display:none"
								<?php echo empty($data)?"disabled":"";?>><?php echo lang('button_checking_file_exsit');?>
							</button>
							
							<?php if($this->session->user_type != 'supplier'):?>
							<a href="#" id="send_mail_link"><button
									class="btn btn-outline btn-blue buttonSpace" type="button"
									onclick="return send_mail_check()" disabled id="send_mail"><?php echo lang('button_send_mail_file_missing');?></button></a>
							<?php endif;?>
							<input type="hidden" id="mail_row_count" value="0">
						</span>
					</div>
					<div class="panel-body">
						<table
							class="table table-striped table-bordered table-hover dataTables_single"
							id="demoTable">
							<thead>
								<tr>
									<th><?php echo lang('label_no');?></th>
									<th><?php echo lang('label_lev');?></th>
									<th><?php echo lang('label_cg');?></th>
									<!-- <th><?php echo lang('label_sbl');?></th> -->
									<th><?php echo lang('label_part_name');?></th>
									<th><?php echo lang('label_pg_draw_no');?></th>
									<th><?php echo lang('label_part_no');?></th>
									<th><?php echo lang('label_part_qty');?></th>
									<th><?php echo lang('label_note');?></th>
									<!-- <th><?php echo lang('label_dwg_no');?></th> -->
									<th><?php echo lang('label_dwg_file_type');?></th>
									<th style="width: 56px;"><?php echo lang('label_dwg_file');?></th>
									<th style="width: 56px;"><?php echo lang('label_pdf');?></th>
									<?php if($this->session->user_type == 'supplier'):?>
										<th><?php echo lang('label_my_rev');?></th>
									<th><?php echo lang('label_tkek_rev');?></th>
									<?php else:?>
									<th><?php echo lang('label_sup_qty');?></th>
									<th><?php echo lang('label_sup_code');?></th>
									<th><?php echo lang('label_sup_name');?></th>
									<?php endif;?>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $key=>$val):?>
								<tr class="odd gradeX">
									<td class="align_middle"><?php echo $val->INDEX;?>
									<input type="hidden" id="" class="mp_info" name="tdm_id[]"
										value="<?php echo $val->DWG_NO;?>"></td>
									<td class="align_middle"><?php echo $val->M_LEVEL;?></td>
									<td class="align_middle"><?php echo $val->COMP_GROUP;?></td>
									<!-- <td class="align_middle"><?php echo $val->SUPER_PROP;?></td> -->
									<td class="wrapTd"><?php echo $val->PART_NAME;?></td>
									<td class="align_middle"><?php echo $val->DRAW_NO;?></td>
									<td class="align_middle"><?php echo $val->PART_CODE;?></td>
									<td class="align_middle"><?php echo $val->PART_QTY;?></td>
									<td class="wrapTd"><?php echo $val->MEMO;?></td>
									<!-- <td class="align_middle">
										<?php if(($this->session->user_type == 'supplier')):?>
											<?php echo $val->DWG_NO;?>
											<?php else:?>
												<input style="float: none;" class="edit_dwg_no" type="text"
												old_dwg_no="<?php echo $val->DWG_NO;?>"
												part_code="<?php echo $val->PART_CODE?>"
												value="<?php echo $val->DWG_NO;?>">
												<?php endif;?>	
									</td> -->
									<td class="align_middle"><?php echo $val->FILE_TYPE_NAME?></td>
									<td class="align_middle">
												<?php if($val->DWG_NO && (($this->session->user_type == 'supplier' && $val->SHOW_YN != '') or $this->session->user_type != 'supplier' )):?>
													<a href="javascript:void(0);" target="_blank"
															onclick="sup_down('<?php echo $val->DWG_NO;?>');return false;">
															<?php $firstChar = substr($val->FILE_TYPE_NAME, 0, 10); ?>
															<?php if($val->FILE_TYPE_NAME =='AutoCAD'){?>
															<img src="<?php echo base_url();?>public/images/cad.png" style="max-width:50%"></a>
                                                            <?php } else if($val->FILE_TYPE_NAME =='Microsoft Excel'){ ?>
															<img src="<?php echo base_url();?>public/images/excel.png" style="max-width:50%"></a>
															<?php } else if($val->FILE_TYPE_NAME =='Microsoft Word'){?>
															<img src="<?php echo base_url();?>public/images/word.png" style="max-width:50%"></a>
															<?php } else if($val->FILE_TYPE_NAME =='Microsoft PowerPoint'){?>
															<img src="<?php echo base_url();?>public/images/ppt.png" style="max-width:50%"></a>
															<?php } else if($firstChar =='SolidWorks'){?>
															<img src="<?php echo base_url();?>public/images/solidworks.png" style="max-width:50%"></a>
															<?php } else if($val->FILE_TYPE_NAME =='PDF'){?>
															<img src="<?php echo base_url();?>public/images/pdf.png" style="max-width:50%"></a>
															<?php } else if($val->FILE_TYPE_NAME =='Image'){?>
															<img src="<?php echo base_url();?>public/images/image.png" style="max-width:50%"></a>
															<?php } else {?>
															<img src="<?php echo base_url();?>public/images/default.png" style="max-width:50%"></a>
															<?php }?>
													</a>
												<?php endif;?>
									</td>
									<td class="align_middle <?php echo $val->DWG_NO."_pdf";?>"></td>
									<?php if($this->session->user_type == 'supplier'):?>
									<td class="align_middle"><?php echo $val->REV1;?></td>
									<td class="align_middle"><?php echo $val->REV2;?></td>
									<?php else:?>
									<td class="align_middle"><a class="supNumA" href="#"
										onclick="show_CG_mapping(this,'<?php echo $val->DWG_NO;?>','<?php echo $val->COMP_GROUP;?>');return false;">
									<?php echo $val->SUP_QTY?>
									</a></td>
									<td class="align_middle"><span class="firstSupCode"><?php echo $val->SUP_CODE;?></span>
										<span class="supNum">
    												<?php if($val->SUP_QTY > 1):?>
    													(<?php echo $val->SUP_QTY;?>)
    												<?php endif;?>
    												</span></td>
									<td><span class="firstSupName"><?php echo $val->SUP_NAME;?></span>
										<span class="supNum">
    												<?php if($val->SUP_QTY > 1):?>
    													(<?php echo $val->SUP_QTY;?>)
    												<?php endif;?>
    												</span></td>
									<?php endif;?>
								</tr>
								<?php endforeach;?>
							</tbody>
						</table>

						<br>
					</div>
				</div>
			</div>
		</div>

	</form>
<!-- pdf_email modal begin -->
<div class="modal fade" id="pdf_email_modal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true"></button>
				<h4 class="modal-title" id="pdf_email_modal_title"><?php echo lang('label_message');?></h4>
			</div>
			<div class="modal-body" id="pdf_email_modal_body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="send_pdf_mail_link"><?php echo lang('button_yes');?></button>
				<button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang('button_no');?></button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- pdf_email modal end -->
	<!-- list end -->
	<div id="mask" class="mask"></div>
	<!-- sup mapping modal -->
    <?php echo $assign_supplier_page;?>
    <!-- sup mapping modal end -->
	<script type="text/javascript">
	if(screen.height > 900){
		var collapsingHeight="300px";
		var openHeight="480px";
	}else{
		var collapsingHeight="120px";
		var openHeight="280px";
	}
	$.fn.dataTable.ext.search.push(
	    function( settings, data, dataIndex ) {
	        var cg = data[2];
	        var input_val = $('.input-sm').val();
	        if(input_val == "") return true;
	        if ( cg.indexOf(input_val) >= 0 )
	        {
	            return true;
	        }
	        return false;
	    }
    );
	
	$(document).ready(function() {
		function fileExistClickEventHandler() {
			//var mail_content = "mailto:<?php echo config_item('to');?>?cc=<?php echo config_item('cc');?>&subject=[Web DDM] 도면 누락 건 (Missing Drawings)&body=요청자 ID(Requester ID) : ";
			var mail_content = "return window.location.href='mailto:<?php echo config_item('to');?>?cc=<?php echo config_item('cc');?>&subject=[Web DDM] 도면 누락 건 (Missing Drawings)&body=요청자 ID(Requester ID) : ";
			var userid = "<?php echo $this->session->user_login?>";
			var username = "<?php echo $this->session->user_display_name?>";
			var row_count = 0;
			var body = "";
			$("#send_mail").attr("disabled",false);
	    	$.ajax({
	      		type: "POST",
	      		async: true,
	      		cache: false,
	      		url: "<?php echo site_url('search_job/check_files'); ?>",
	      		dataType:"json",
	      		data:$('#serach_job').serialize(),
	      		beforeSend: function(){
	      			$.blockUI({ message: '<h3><?php echo lang('label_please_wait');?>...</h3>' });
	      		},
	      		success: function(msg){
					//set pdf y/n
	          		$.each(msg, function(i,n){
						if(n.pdf != ""){
							file_link = '<a href="#" target=\"_blank\" onclick="sup_down(\''+i+'\',\'pdf\');return false;">'+"<img src=\"<?php echo base_url();?>public/images/pdf.png\"" + "style=\"max-width:50%\""+'</a>';
							$("."+i+"_pdf").html(file_link)
						}
		          		if(n.pdf == 'N'){			          		
		          			row_count ++;
		          			body += i+ "|" + n.pdf +"%0A";
			          		}
	          		});
	          		if(row_count > 0){
	          			mail_content +=userid+"%0A요청자 이름(Requester Name) : "+username+"%0APDF가 존재하지 않는 항목이 "+row_count+"개 발견되었습니다.%0A도면번호%0ADWG_NO|PDF_YN%0A";
	          			mail_content += body;
	          			//$("#send_mail_link").attr("href",mail_content);
		          		mail_content +="'";
	          			$("#mail_row_count").val(1);
						$("#send_pdf_mail_link").attr("onclick",mail_content);
						}

	      		},
	      		complete: function(){
	      			t.destroy();
	      			//$('.dataTables_single').DataTable(t_options);
					$('#demoTable').DataTable(t_options);
	      			$.unblockUI();
	                 return false;
	      		}
	      	});
		}

		var t_options = {
                "bPaginate": false,
                "bFilter": false,
                "bInfo": false,
                "showRowNumber" : true,
                "ordering":true,
                "bSort": true,
                //"bFilter": true,
                "order": [[ 2, "asc" ]], //CG
                "columnDefs": [ {
                    targets: [ 2 ],
                    orderData: [ 2, 7 ],  //7 is Part No,if order by fist column, if the first column are same, then order by the second column
					searchable: true
                  }],
                "scrollY": collapsingHeight,
                "scrollX": true,
                "sScrollX": "100%",  
                "sScrollXInner": "100%",  
                "bScrollCollapse": true,
                "language": {
           	        url: "/public/js/<?php echo $this->session->lan_package;?>"
           	    }
    		};
	    //var t = $('.dataTables_single').DataTable(t_options);
		var t = $('#demoTable').DataTable(t_options);
	    
		setTimeout(function(){
			fileExistClickEventHandler()
		},500);

	    $('.input-sm').keyup( function() {
              t.draw();
		  	console.log('keyup');
         } );
        
	    $("#serach_job").validate({
	    	 tooltip_options: {
	    		 job2_code: {placement:'bottom'}

	    		}, 
			submitHandler: function(form) {
				$.blockUI({ message: '<h3><?php echo lang('label_please_wait');?>...</h3>' });
				form.submit();
			},
		});
	    $("#check_file_exist").click(function(){
			fileExistClickEventHandler();
		});
		const button = document.querySelector('#send_pdf_mail_link');

		button.addEventListener('click', () => {
			$('#pdf_email_modal').modal('hide');
		});
		$(".edit_dwg_no").on('blur',function(){
				var obj = $(this);
				var new_dwg = obj.val();
				var old_dwg = obj.attr('old_dwg_no');
				if(new_dwg != old_dwg && new_dwg != ""){
						$.ajax({
								url:"<?php echo site_url('Search_job/update_dwg_no');?>",
								type:"post",
								dataType:"json",
								data:{
									'job1_code':'<?php echo $info->job1_code;?>',
									'job2_code':'<?php echo $info->job2_code;?>',
									//'part_code':obj.attr('part_code'),
									'old_dwg_no':old_dwg,
									'dwg_no': obj.val(),								
									},
								success:function(msg){
										if(msg == 1){
    											obj.attr('old_dwg_no',new_dwg);
    											//$('#error_message').html("<?php echo lang('message_save_successfully');?>");
    											//$('#error_modal').modal('show');
    											$("#search").click();
											}else{
												$('#error_message').html("<?php echo lang('message_save_failed');?>");
												$('#error_modal').modal('show');
												}
									}
							})
					}
			});
	});
	//up collapsing
	function collapsingDiv(){
		$("#collapsingDiv").slideToggle(function(){
			if($("#collapsingDiv").is(":hidden")){
				$("#collapsing").html('<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"/>');
				$(".dataTables_scrollBody").css("height",openHeight);
				$(".dataTables_scrollBody").css("max-height",openHeight);
			}else{
				$("#collapsing").html('<span class="glyphicon glyphicon-chevron-up" aria-hidden="true"/>');
				$(".dataTables_scrollBody").css("height",collapsingHeight);
				$(".dataTables_scrollBody").css("min-height",collapsingHeight);
			}
		});
		return false;
	}
	function sup_down(dwg_no,file_type){
			$.ajax({
				url:"<?php echo site_url('search_job/sup_down')?>/"+dwg_no,
				type:'get',
				dataType:'json',
				success:function(msg){
						if(msg.status == true){
							var data = msg.data;
							if(file_type == 'pdf'){
								file_name = data.FILE_NAME;
								data.FILE_NAME = file_name.replace(file_name.split('.').pop().toLowerCase(),file_type);
								}
							 check_file_exist(data.FILE_NAME,data.SITE_NAME,data.REVISION,data.OBJECT_ID,data.CLASS_ID,data.TDM_ID);
							}else{
								$('#tdm_id_msg').html("TDM ID:"+dwg_no);
			        			$('#file_not_exist_modal').modal();
			        			return false;
								}
					}
				})
		}
	
		function send_mail_check(){
		if($("#mail_row_count").val()=="0"){
			$('#error_message').html("<?php echo lang('message_all_file_exist');?>");
			$('#error_modal').modal('show');
			return false;
		}else if($("#mail_row_count").val()=="1"){
			$('#pdf_email_modal_body').html("<?php echo lang('message_pdf_confirm_user');?>");
			$('#pdf_email_modal').modal({backdrop: 'static', keyboard: false});
			return false;
	  }


  }
</script>