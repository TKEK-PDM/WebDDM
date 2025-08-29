<style>
td:last-child, td:nth-child(2) {
	text-align: center
}
</style>

<div id="page-wrapper">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-header"><?php //echo lang('label_general_drawing');?>
			<div style="float: right" class="tab-pane fade <?php if ($search_count):?>in active<?php endif;?>">
					<button class="btn btn-outline btn-blue buttonSpace"b
						onclick="return collapsingDiv()" id="collapsing">
						<span class="glyphicon glyphicon-chevron-up" aria-hidden="true" />
					</button>
				</div>
			</h1>
		</div>
	</div>
	<!-- search field -->
	<form class="ng-pristine ng-valid searchForm" role="form"></form>

	<!-- list start -->
	<div class="row">
		<div class="col-xs-12">
			<div class="panel-default">
				<!-- /.panel-heading -->
				<div class="">
					<!-- <ul id="myTab" class="nav nav-tabs">
						<li <?php if (!$search_count):?> class="active" <?php endif;?>><a
							href="#search" data-toggle="tab"><?php echo lang('label_search');?></a></li>

						<?php if($this->session->user_role != '2'):?>
						<li <?php if ($search_count):?> class="active" <?php endif;?>><a
							href="#search_result" data-toggle="tab" id="searchResult"><?php echo lang('label_search_result');?>
								</a></li><?php endif;?>

						<?php if($this->session->user_role == '2'):?>
						<li <?php if ($search_count):?> class="active" <?php endif;?>><a
							href="#mapping_supplier" data-toggle="tab" id="mappingSupplier"><?php echo lang('label_mapping_supplier');?>
							</a></li><?php endif;?>
					</ul> -->
					<div id="myTabContent" class="tab-content">
						<!-- <div class="tab-pane fade in active" id="search"> -->
						<div class="tab-pane fade in active" id="search">
						<!-- <div class="tab-pane fade <?php if (!$search_count):?>in active<?php endif;?>" id="search"> -->
							<form class="ng-pristine ng-valid searchForm keep" role="form"
								method="post" action="<?php echo current_url();?>"
								id="search_result_form">
								<input type="hidden" id="keep" name="keep"
									value="<?php echo $keep;?>" />
								<div id="collapsingDiv" class="form-inline searchDiv" style="flex-wrap: nowrap;">
									<!-- <div class="row searchDiv" style="padding-left: 20px"> -->
										<div class="form-group searchDiv5" style="max-width: 210px; place-self: start;">
											<div class="col-xs-12">
												<label class="tableLabel nav-justified"><?php echo lang('label_revision_option');?></label>
												<div class="input-group">
													<label for="revision_status1">
														<input name="revision_status" type="radio" value="latest" checked="checked" id="revision_status1">
														<span><?php echo lang('label_latest');?> </span>
													</label>
													<label for="revision_status">
													<input name="revision_status" id="revision_status" type="radio" value="all">
														<span><?php echo lang('label_all_revision');?></span>
													</label>
												</div>
											</div>
										</div>
										<div class="form-group searchDiv5">
											<div class="col-xs-12">
												<label  class="tableLabel" for="name"><?php echo lang('label_input_drawing_numbers');?></label>
												<textarea id="dwg_no" name="dwg_no" required="required"
													title="<?php echo lang('message_field_required'); ?>"
													class="" rows="1" oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"><?php echo $request_dwg_str;?></textarea>
													<script>
														const textarea = document.querySelector("textarea");

														function clickBtn() {
															text.innerHTML = textarea.value;
															textarea.value = '';
															textarea.style.height = '40px';
														}

														textarea.addEventListener("focusin", (event) => {
															event.target.style.height = textarea.scrollHeight + 'px';
														});
														textarea.addEventListener("focusout", (event) => {
															event.target.style.height = '40px';
														});
													</script>

											</div>
										</div>
										<div class="form-group searchDiv5 btn-group">
											<div class="col-xs-12">
												<button class="btn btn-outline btn-blue buttonSpace"
													type="submit"><?php echo lang('button_search');?></button>
											</div>
										</div>
									<!-- </div> -->
								</div>
							</form>
						</div>

						<?php if ($this->session->user_role == 1 || $this->session->user_role == 4):?>
						<!-- <div class="tab-pane fade in active" id="search_result"> -->
						<div class="tab-pane fade <?php if ($search_count):?>in active<?php endif;?>" id="search_result">
							<div class="panel panel-default">
								<div class="panel-heading panel_blue">
									<b><?php echo lang('label_general_drawing_list');?>(<?php echo count($data);?>)</b>
									<span class="pull-right">
										<button class="btn btn-outline btn-blue" type="button"
											id="multi_download" onclick=""><?php echo lang('button_multi_download');?></button>
										<button class="btn btn-outline btn-blue buttonSpace"
											type="button" id="check_file_exist" style="display:none" onclick="$('#org_down').val('');"
											<?php if ($item_count==0):?> disabled="disabled"
											<?php endif;?>><?php echo lang('button_checking_file_exsit');?></button>
									</span>
								</div>
								<div class="panel-body table_panel">
									<form action="<?php echo site_url('download/download_zip');?>"
										method="post" id="multi_download_form">
										<table
											class="table table-striped table-bordered table-hover dataTables_single"
											id="">
											<thead>
												<tr>
													<th><input type="checkBox" id="checkAll" value=""></th>
													<th><?php echo lang('label_no');?></th>
													
													<!-- <th><?php echo lang('label_class');?></th> -->
													<th><?php echo lang('label_dwg_no');?></th>
													<th><?php echo lang('label_revision');?></th>
													<!-- <th><?php echo lang('label_dwg_name');?>(EN)</th> -->
													<th><?php echo lang('label_dwg_name');?>(KO)</th>
													<th><?php echo lang('label_file_type');?></th>
													<th style="width: 56px;"><?php echo lang('label_dwg_file');?></th>
													<th style="width: 56px;"><?php echo lang('label_pdf');?></th>
													<th><?php echo lang('label_down_date');?></th>
													<th><?php echo lang('label_down_time');?></th>
													<th><?php echo lang('label_site_name');?></th>
												</tr>
											</thead>
											<tbody>
										<?php foreach ($data as $key=>$val):?>
											<tr>
													<td><input type="checkBox" id="" name="file_name[]"
														value="<?php echo $key;?>"
														file="<?php echo $val->FILE_NAME?>"
														tdm_id="<?php echo $val->TDM_ID;?>"
														revision="<?php echo $val->REVISION; ?>"
														site="<?php echo $val->SITE_NAME; ?>"
														<?php if($val->CONT1 == 0):?> disabled="disabled"
														<?php endif;?>> <input type="hidden"
														name="need_check_file[]"
														value="<?php echo $val->FILE_NAME;?>"> <input
														type="hidden" name="site[]"
														value="<?php echo $val->SITE_NAME;?>"> <input
														type="hidden" name="version[]"
														value="<?php echo $val->REVISION;?>"> <input type="hidden"
														name="object_id[]" value="<?php echo $val->OBJECT_ID;?>">
														<input type="hidden" name="class_id[]"
														value="<?php echo $val->CLASS_ID;?>"> <input type="hidden"
														name="tdm_id[]" value="<?php echo $val->TDM_ID;?>"></td>
													<td><?php echo $key+1; ?></td>
													
													<!-- <td><?php echo $val->CLASS_NAME;?> -->
													</td>
													<td class="align_middle"><a
														onclick="showProfileCard('<?php echo $val->TDM_ID;?>','<?php echo $val->REVISION; ?>')"><?php echo $val->TDM_ID;?></a></td>
													<td class="align_middle"><?php echo $val->REVISION;?></td>
													<!-- <td><?php echo $val->TDM_DESCRIPTION;?></td> -->
													<td class="align_middle"><?php echo $val->CN_LOCAL_DESCRIPTION;?></td>
													<td class="align_middle"><?php echo $val->FILE_TYPE_NAME;?></td>

													<td class="align_middle">
													<?php if ($this->session->user_role == 1):?>
    													<?php if($val->CONT1 > 0):?>
														<a href="javascript:void(0);" target="_blank"
														onclick="check_file_exist(<?php echo "'".$val->FILE_NAME."','".$val->SITE_NAME,"','".$val->REVISION."','".$val->OBJECT_ID."','".$val->CLASS_ID."','".$val->TDM_ID."'";?>)">
														<!-- <img src="<?php echo base_url();?>public/images/dwg.png" style="max-width:50%"></a> -->
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

    													<?php else: ?>
                                                            <?php
                                                            	$pattern = '/^MT|^MU|^ME|^MK/';
                                                            	preg_match($pattern, $val->FILE_NAME, $matches);
                                                            ?>
                                                            <?php if($matches): ?>
                                                                <a href="javascript:void(0);" target="_blank"
                                                                   onclick="check_file_exist(<?php echo "'".$val->FILE_NAME."','".$val->SITE_NAME,"','".$val->REVISION."','".$val->OBJECT_ID."','".$val->CLASS_ID."','".$val->TDM_ID."'";?>)">
																   <!-- <img src="<?php echo base_url();?>public/images/dwg.png" style="max-width:50%"></a> -->
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
                                                            <?php else: ?>
                                                                <?php echo $val->FILE_NAME;?>
                                                        	<?php endif; ?>

    													<?php endif;?>
    												<?php endif;?>

    												<?php if ($this->session->user_role == 4):?>
    												<a href="javascript:void(0);" target="_blank"
														onclick="check_file_exist(<?php echo "'".$val->FILE_NAME."','".$val->SITE_NAME,"','".$val->REVISION."','".$val->OBJECT_ID."','".$val->CLASS_ID."','".$val->TDM_ID."'";?>)">
														<!-- <img src="<?php echo base_url();?>public/images/dwg.png" style="max-width:50%"></a> -->
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

													<td class="align_middle" id="<?php echo 'pdf_'. $val->OBJECT_ID;?>"></td>
													<td class="align_middle"><?php echo $val->downdate;?></td>
													<td class="align_middle"><?php echo $val->downtime;?></td>
													<td class="align_middle"><?php echo $val->SITE_NAME;?></td>
                                                    <input type="hidden" id="<?php echo "pdf_". $val->OBJECT_ID."_site_name_link";?>" value="<?php echo $val->SITE_NAME;?>">
                                                    <input type="hidden" id="<?php echo "pdf_". $val->OBJECT_ID."_revision_link";?>" value="<?php echo $val->REVISION;?>">
                                                    <input type="hidden" id="<?php echo "pdf_". $val->OBJECT_ID."_object_id_link";?>" value="<?php echo $val->OBJECT_ID;?>">
                                                    <input type="hidden" id="<?php echo "pdf_". $val->OBJECT_ID."_class_id_link";?>" value="<?php echo $val->CLASS_ID;?>">
                                                    <input type="hidden" id="<?php echo "pdf_". $val->OBJECT_ID."_tdm_id_link";?>" value="<?php echo $val->TDM_ID;?>">
                                                    <input type="hidden" id="<?php echo "pdf_". $val->OBJECT_ID."_file_name_link";?>" value="<?php echo $val->FILE_NAME;?>">
												</tr>
										<?php endforeach;?>
											</tbody>
										</table>
										<div>
											<p style="font-size:15px"><?php echo lang('message_multi_download_disabled_note');?></p>
										</div>
									</form>
								</div>
							</div>

						</div>
						<?php else:?>

						<!-- <div class="tab-pane fade in active" id="mapping_supplier"> -->
						<div class="tab-pane fade <?php if ($search_count):?> in active <?php endif;?>" id="mapping_supplier">
							<!-- <div class="row">&nbsp;</div> -->
							<form class="form-horizontal col-xs-12" role="form"
								action="<?php echo site_url('download/download_zip');?>"
								method="post" id="multi_download_form">
								<div class="form-group table_panel">
									<div class="panel panel-default">
										<div class="form-inline clearfix" style="margin: 10px 15px; border-bottom: 1px solid #1e0b2c; padding-bottom: 15px; display: flex;">
											<div class="form-group searchDiv5">
												<div class="col-xs-12">
												<label class="tableLabel"><?php echo lang('label_supplier_code');?></label>
													<input class="form-control normalInput" type="text"
														id="sup_code" name="sup_code" value=""
														onblur="get_sup_name(this)">
												</div>
											</div>
											<div class="form-group searchDiv5">
												<div class="col-xs-12">
												<label class="tableLabel"><?php echo lang('label_supplier_name');?></label>
													<input class="form-control normalInput" type="text"
														id="sup_name" name="sup_name" value="" disabled="disabled">
												</div>
											</div>
											<div class="form-group btn-group searchDiv5">
												<div class="col-xs-12">
												<button class="btn btn-outline btn-blue buttonSpace"
													id="assign_btn" type="button" disabled="disabled"
													onclick="easy_assign()"><?php echo lang('button_multi_assign');?></button>
												</div>
											</div>
										</div>
										
										<div class="panel-heading panel_blue">
											<b><?php echo lang('label_general_drawing_list');?>(<?php echo count($data);?>)</b>
											<span class="pull-right">
												<button class="btn btn-outline btn-blue buttonSpace"
												type="button" id="check_file_exist" style="display:none"
												<?php if ($item_count==0):?> disabled="disabled"
												<?php endif;?>><?php echo lang('button_checking_file_exsit');?></button>
												<a id="send_mail_link" href="">
													<button class="btn btn-outline btn-blue buttonSpace"
														type="button" id="send_mail" disabled="disabled"
														onclick="return send_mail_check()"><?php echo lang('button_send_mail_file_missing');?></button>
													<input type="hidden" id="mail_row_count" value="0">
												</a>
												<button class="btn btn-outline btn-blue" type="button"
													id="multi_download" onclick=""><?php echo lang('button_multi_download');?></button>
											</span>
										</div>
										<div class="panel-body table_panel">
											<table
												class="table table-striped table-bordered table-hover dataTables_single"
												id="">
												<thead>
													<tr>
														<th><input type="checkBox" id="checkAll" value=""></th>
														<th><?php echo lang('label_no');?></th>
														<!-- <th><?php echo lang('label_class');?></th> -->
														<th><?php echo lang('label_dwg_no');?></th>
														<th><?php echo lang('label_revision');?></th>
														<th><?php echo lang('label_dwg_name');?>(EN)</th>
														<!-- <th><?php echo lang('label_dwg_name');?>(KO)</th> -->
														<th><?php echo lang('label_file_type');?></th>
														<th style="width: 56px;"><?php echo lang('label_dwg_file');?></th>
														<th style="width: 56px;"><?php echo lang('label_pdf');?></th>
														<th><?php echo lang('label_cg_qty');?></th>
														<th><?php echo lang('button_cg');?></th>
														<th><?php echo lang('label_sup_qty');?></th>
														<th><?php echo lang('label_sup_code');?></th>
														<th><?php echo lang('label_sup_name');?></th>
														<th><?php echo lang('label_site_name');?></th>
													</tr>
												</thead>
												<tbody>
        										<?php foreach ($data as $key=>$val):?>
        										<tr>
														<td><input type="checkBox" id="" class="mp_info"
															name="file_name[]" value="<?php echo $key;?>"
															file="<?php echo $val->FILE_NAME;?>"
															tdm_id="<?php echo $val->TDM_ID;?>"
															revision="<?php echo $val->REVISION; ?>"
															site="<?php echo $val->SITE_NAME; ?>"> <input
															type="hidden" name="need_check_file[]"
															value="<?php echo $val->FILE_NAME;?>"> <input
															type="hidden" name="site[]"
															value="<?php echo $val->SITE_NAME;?>"> <input
															type="hidden" name="version[]"
															value="<?php echo $val->REVISION;?>"> <input
															type="hidden" name="object_id[]"
															value="<?php echo $val->OBJECT_ID;?>"> <input
															type="hidden" name="class_id[]"
															value="<?php echo $val->CLASS_ID;?>"> <input
															type="hidden" name="tdm_id[]"
															value="<?php echo $val->TDM_ID;?>"></td>
														<td><?php echo $key+1; ?></td>
														<!-- <td><?php echo $val->CLASS_NAME;?></td> -->
														<input type="hidden"
															name="class_id[]" value="<?php echo $val->CLASS_ID;?>">
														<td class="align_middle"><a
															onclick="showProfileCard('<?php echo $val->TDM_ID;?>','<?php echo $val->REVISION; ?>')"><?php echo $val->TDM_ID;?></a>
														</td>
														<td class="align_middle"><?php echo $val->REVISION;?></td>
														<td><?php echo $val->TDM_DESCRIPTION;?></td>
														<!-- <td class="align_middle"><?php echo $val->CN_LOCAL_DESCRIPTION;?></td> -->
														<td class="align_middle"><?php echo $val->FILE_TYPE_NAME;?></td>
														<td class="align_middle"><a href="javascript:void(0);" target="_blank"
															onclick="check_file_exist(<?php echo "'".$val->FILE_NAME."','".$val->SITE_NAME,"','".$val->REVISION."','".$val->OBJECT_ID."','".$val->CLASS_ID."','".$val->TDM_ID."','Y'";?>)">
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
															<input type="hidden" name="exist_file_name[]"
															value="<?php echo $val->FILE_NAME?>">
														</td>
														<td class="align_middle" id="<?php echo 'pdf_'. $val->OBJECT_ID;?>"></td>
														<td class="align_middle"><a
															onclick="show_CG_list('<?php echo $val->TDM_ID;?>')"><?php echo $val->CG_QTY;?></a></td>
														<td class="align_middle"><?php echo $val->CG;?></td>
														<td class="align_middle"><a class="supNumA"
															onclick="show_CG_mapping(this,'<?php echo $val->TDM_ID;?>','<?php echo $val->CG;?>')"><?php echo $val->CONT_SUP;?></a></td>
														<td class="align_middle"><span class="firstSupCode"><?php echo $val->SUP_CODE;?></span>
															<span class="supNum">
            												<?php if($val->CONT_SUP > 1):?>
            													(<?php echo $val->CONT_SUP;?>)
            												<?php endif;?>
            												</span></td>
														<td class="align_middle"><span class="firstSupName"><?php echo $val->SUP_NAME;?></span>
															<span class="supNum">
            												<?php if($val->CONT_SUP > 1):?>
            													(<?php echo $val->CONT_SUP;?>)
            												<?php endif;?>
            												</span></td>
															<td class="align_middle"><?php echo $val->SITE_NAME;?></td>
                                                    <input
                                                            type="hidden"
                                                            id="<?php echo "pdf_". $val->OBJECT_ID."_site_name_link";?>"
                                                            value="<?php echo $val->SITE_NAME;?>"> <input
                                                            type="hidden"
                                                            id="<?php echo "pdf_". $val->OBJECT_ID."_revision_link";?>"
                                                            value="<?php echo $val->REVISION;?>"> <input
                                                            type="hidden"
                                                            id="<?php echo "pdf_". $val->OBJECT_ID."_object_id_link";?>"
                                                            value="<?php echo $val->OBJECT_ID;?>"> <input
                                                            type="hidden"
                                                            id="<?php echo "pdf_". $val->OBJECT_ID."_class_id_link";?>"
                                                            value="<?php echo $val->CLASS_ID;?>"> <input
                                                            type="hidden"
                                                            id="<?php echo "pdf_". $val->OBJECT_ID."_tdm_id_link";?>"
                                                            value="<?php echo $val->TDM_ID;?>">
                                                    <input
                                                            type="hidden"
                                                            id="<?php echo "pdf_". $val->OBJECT_ID."_file_name_link";?>"
                                                            value="<?php echo $val->FILE_NAME;?>">
                                                </tr>
        										<?php endforeach;?>
        										</tbody>
											</table>
										</div>
									</div>
									<div>
										<p><?php echo lang('message_multi_download_disabled_note');?></p>
									</div>
								</div>
							</form>



						</div>
						<?php endif;?>
						<form class="form-horizontal" role="form" method="post"
							id="check_files" style="display: none" id="multi_check_form">
							<table>
								<tbody>
										<?php foreach ($data as $key=>$val):?>
										<tr>
										<td><input type="hidden" name="exist_file_name[]"
											value="<?php echo $val->FILE_NAME?>"> <input type="hidden"
											name="site[]" value="<?php echo $val->SITE_NAME;?>"> <input
											type="hidden" name="object_id[]"
											value="<?php echo $val->OBJECT_ID;?>"> <input type="hidden"
											name="tdm_id[]" value="<?php echo $val->TDM_ID;?>">
                                            <input type="hidden" id="org_down"
                                                   name="org_down[]" value=""></td>
									</tr>
										<?php endforeach;?>
										</tbody>
							</table>
						</form>
					</div>


				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-xs-12 -->
	</div>
	<!-- list end -->
</div>

<!-- email modal begin -->
<div class="modal fade" id="email_modal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true"></button>
				<h4 class="modal-title" id="email_modal_title"><?php echo lang('label_message');?></h4>
			</div>
			<div class="modal-body" id="email_modal_body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="send_email()"><?php echo lang('button_yes');?></button>
				<button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang('button_no');?></button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- email modal end -->
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
<!-- cg_list modal begin -->
<div class="modal fade" id="cg_list_modal">
	<div class="modal-header" id="cg_list_header">
		<h4 class="modal-title"><?php echo lang('label_cg_part_list');?></h4>
	</div>
	<div class="modal-body" id="cg_list_body"></div>
	<div class="modal-footer">
		<button type="button" class="btn btn-blue" data-dismiss="modal"><?php echo lang('button_close');?></button>
	</div>
</div>
<!-- cg_list modal end -->

<!-- global hidden variables part -->
<div>
	<input type="hidden" id="email_dwg" name="email_dwg"
		value="<?php echo $email_dwg;?>">
</div>
<!-- global hidden variables part -->

<!-- sup mapping modal -->
<?php echo $assign_supplier_page;?>
<!-- sup mapping modal end -->
<script type="text/javascript">
	// if(screen.height > 900){
	// 	var collapsingHeight="300px";
	// 	var openHeight="480px";
	// }else{
	// 	var collapsingHeight="120px";
	// 	var openHeight="280px";
	// }

    $(document).ready(function() {

		function fileExistClickEventHandler() {
			//var mail_content = "mailto:rira.seo@tkeap.com; jeonghyun.nam@tkeap.com?cc=seonuk.lee@tkeap.com&subject=[Web DDM] Missing Files&body=Requester ID:";
			//var mail_content = "mailto:<?php echo config_item('to');?>?cc=<?php echo config_item('cc');?>&subject=[Web DDM] 도면 누락 건 (Missing Drawings)&body=요청자 ID(Requester ID) : ";
			var mail_content = "return window.location.href='mailto:<?php echo config_item('to');?>?cc=<?php echo config_item('cc');?>&subject=[Web DDM] 도면 누락 건 (Missing Drawings)&body=요청자 ID(Requester ID) : ";
			var userid = "<?php echo $this->session->user_login?>";
			var username = "<?php echo $this->session->user_display_name?>";
			var row_count = 0;
			$("#send_mail").attr("disabled",false);

	    	$.ajax({
	      		type: "POST",
	      		async: true,
	      		cache: false,
	      		url: "<?php echo site_url('general_draw/check_files/'); ?>",////10.126.96.58/general_draw/check_files
	      		dataType:"json",
	      		data: $("#check_files").serializeArray(),
	      		beforeSend:$.blockUI({ message: '<h3><?php echo lang('label_please_wait');?>...</h3>' }),
	      		success: function(msg){
                    console.log(msg);
	      		    // console.log(msg);return false; //{pdf_805435451: "Y|4F1N2319"}
					//set pdf y/n
	          		$.each(msg, function(i,n){

		          		var arrResult = n.split("|");
		          		//[0] is Y/N, [1] is dwg_no
                        var tmpstr = "#"+i+"_file_name_link";

                        var file_name_link = $("#"+i+"_file_name_link").val();


                        if(file_name_link === undefined) {
                            return true;
                        }
						var file_name_arr = file_name_link.split(".");
						var file_name = file_name_arr[0]+".pdf";

                        var site_name = $("#"+i+"_site_name_link").val();
                        var revision= $("#"+i+"_revision_link").val();
                        var object_id= $("#"+i+"_object_id_link").val();
                        var class_id = $("#"+i+"_class_id_link").val();
                        var tdm_id = $("#"+i+"_tdm_id_link").val();


						if(arrResult[0] =="Y"){
							var link = "<a href='javascript:void(0);' target=\"_blank\" "+
									"onclick=\"$('#org_down').val('');check_file_exist('"+file_name+"','"+site_name+"','"+revision+"','"+object_id+"','"+class_id+"','"+tdm_id+"')\">"
									+"<img src=\"<?php echo base_url();?>public/images/pdf.png\"" + "style=\"max-width:50%\""
									+"</a>";

							//console.log("#"+i); //#pdf_402681649
                            //console.log(t.cell("#"+i).data());
							t.cell("#"+i).data(link);
						}
						if(arrResult[0] =="N"){
							//t.cell("#"+i).data(arrResult[0]);
							row_count++;
						}

	          		});

	          		//show the send email button
	          		if(row_count > 0) {
	          			//mail_content +=userid+"%0ARequester Name:"+username+"%0A%0ARow Count:"+row_count+"%0A%0ADWG_NO|PDF_YN%0A";
						mail_content +=userid+"%0A요청자 이름(Requester Name) : "+username+"%0APDF가 존재하지 않는 항목이 "+row_count+"개 발견되었습니다.%0A도면번호%0ADWG_NO|PDF_YN%0A";
	          			$("#mail_row_count").val(1);
					}
	          		//set email content
	          		$.each(msg, function(i,n){
		          		var arrResult = n.split("|");
		          		//[0] is Y/N, [1] is dwg_no
						if(arrResult[0] =="N"){
							mail_content +=arrResult[1]+ "|" +arrResult[0]+"%0A";
						}
	          		});
					mail_content +="'";
	          		$("#send_pdf_mail_link").attr("onclick",mail_content);
					//$("#send_mail_link").attr("href",mail_content);
	      		},
	      		complete: function(){
	      			$.unblockUI();
	                 return false;
	      		},

	      	});
		}

    	$.unblockUI();
    	var t = $('.dataTables_single').DataTable({
    		 "bPaginate": true,
             "bFilter": false,
             "bInfo": false,
			 retrieve: true,
             ordering:true,
             "aaSorting":[],
            "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0 ] }],
           	  "language": {
       	        url: "/public/js/<?php echo $this->session->lan_package;?>"
       	    },
			drawCallback: function(){
				$('.paginate_button:not(.disabled)', this.api().table().container())          
					.on('click', function(){
						fileExistClickEventHandler();
					});       
			}
	    }); 

		setTimeout(function(){
			// document.getElementById("check_file_exist").click();
			fileExistClickEventHandler();
		},500);

    	$("#search_result_form").validate({
    	   	 tooltip_options: {
    	   		 dwg_no: {placement:'bottom'}

    	   		},
    			submitHandler: function(form) {
    				$.blockUI({ message: '<h3><?php echo lang('label_please_wait');?>...</h3>' });
    				form.submit();
    			},
    		});

    	 //checkBox
        $("#checkAll").click(function(){
    		if(this.checked){
    			$("input[name='file_name[]']").each(function(){
        			if(!this.disabled){
        				this.checked=true;
            		}else{
            			this.checked=false;
                	}
        		});
    		}else{
    			$("input[name='file_name[]']").each(function(){this.checked=false;});
    		}
    	});

		//check whether need to send email for not exist dwg no
		if($("#email_dwg").val() != ""){
			<?php if(!empty($user_email)){ ?>
				$('#email_modal_body').html("<?php echo lang('message_drawing_confirm_user');?>" + $("#email_dwg").val());
			<?php }
			else{ ?>
				$('#email_modal_body').html("<?php echo lang('message_drawing_confirm');?>" + $("#email_dwg").val());
			<?php } ?>
			$('#email_modal').modal({backdrop: 'static', keyboard: false});
		}


		const button = document.querySelector('#send_pdf_mail_link');

		button.addEventListener('click', () => {
			$('#pdf_email_modal').modal('hide');
		});

		
		$("#check_file_exist").click(function() {
			fileExistClickEventHandler();
		});

    });

    function show_CG_list(tdm_id){
    	$('#cg_list_modal').css("top","175px");
    	$('#cg_list_modal').css("left","50%");
    	$('#cg_list_modal').css("margin-left","-300px");
    	$('#cg_list_body').html("<?php echo lang('label_please_wait');?>...");
    	$('#cg_list_modal').modal({backdrop: 'static', keyboard: false});
		$("#cg_list_modal").draggable({
		     cursor: "move",
		     handle: '#cg_list_header'
		    });
        var TDM_ID = tdm_id;
    	$.ajax({
    		type: "POST",
    		async: false,
    		cache: false,
    		url: "<?php echo site_url('general_draw/cg_list'); ?>",
    		data:{
					'TDM_ID':TDM_ID
        		},
    		success: function(msg){
    			$('#cg_list_body').html(msg);
    		}
    	});
    	return false;
    }

	// onblur event get sup_name by sup_code begin
    function get_sup_name(obj){
        var sup_code = $(obj).val();
        if(sup_code == ""){
        	$("#assign_btn").attr("disabled",true);
            return false;
        }
        $.ajax({
    		type: "POST",
    		async: false,
    		cache: false,
    		url: "<?php echo site_url('general_draw/get_sup_name'); ?>",
    		data:{
					'sup_code':sup_code
        		},
    		success: function(msg){
    			var arr=msg.split(",");
				if(arr[0] != ""){
					$("#sup_name").val(arr[0]);
				}else{
					$('#error_message').html("<?php echo lang('message_no_supplier_exist')?> <br>"+ sup_code);
					$('#error_modal').modal('show');
					$("#sup_name").val("")
					$("#assign_btn").attr("disabled",true);
				}

				if(arr[1] != 0){
					$("#assign_btn").attr("disabled",false);
				}else{
					$('#error_message').html("<?php echo lang('message_supcode_not_assigned_cg')?> <br>"+ sup_code);
					$('#error_modal').modal('show');
					$("#assign_btn").attr("disabled",true);
				}
    		}
    	});
    }
 	// onblur event get sup_name by sup_code end

    //easy assign part begin
    function easy_assign(){
    	var sup_code = $("#sup_code").val();
    	var dwg_no_str = "";
    	$(".mp_info").each(function(){
            	if(dwg_no_str == ""){
					dwg_no_str = $(this).attr("tdm_id");
                }else{
                	dwg_no_str = dwg_no_str + "," + $(this).attr("tdm_id");
                }
        });
        $.ajax({
    		type: "POST",
    		async: false,
    		cache: false,
    		url: "<?php echo site_url('general_draw/easy_assign'); ?>",
    		data:{
					'sup_code':sup_code,
					'dwg_no_str':dwg_no_str
        		},
    		success: function(msg){
				if(msg != 0){
					$('#error_message').html(msg + " <?php echo lang('message_supplier_assigned');?>");
					$('#error_modal').modal('show');
				}else{
					$('#error_message').html("0 <?php echo lang('message_supplier_assigned');?>");
					$('#error_modal').modal('show');
	    		}
    		}
    	});
    }
  //easy assign part end

  //send email event
  function send_email(){

	  <?php if(!empty($user_email) && $isgeneraldwg == false){ 
		    if(strstr($user_email,config_item('to'))){
		?>
			window.location.href = "mailto:<?php echo $user_email;?>?cc=<?php echo config_item('cc');?>&subject=[도면조회프로그램] 현장 도면 누락 건&body=안녕하십니까, <?php echo $this->session->user_display_name;?>입니다.%0A아래 도면이 PDM에 업로드 되어있지 않습니다.%0A담당자는 누락된 각 현장에 대한 도면 확인 부탁드립니다.%0A%0A<?php echo $email_dwg_email;?>%0A%0A감사합니다.";
		<?php } else { ?>
				window.location.href = "mailto:<?php echo $user_email;?>?cc=<?php echo config_item('cc2');?>&subject=[도면조회프로그램] 현장 도면 누락 건&body=안녕하십니까, <?php echo $this->session->user_display_name;?>입니다.%0A아래 도면이 PDM에 업로드 되어있지 않습니다.%0A담당자는 누락된 각 현장에 대한 도면 확인 부탁드립니다.%0A%0A<?php echo $email_dwg_email;?>%0A%0A감사합니다.";
		<?php }
		}
		else if(!empty($user_email) && $isgeneraldwg){ ?>
			 window.location.href = "mailto:<?php echo $user_email;?>?cc=<?php echo config_item('cc');?>&subject=[Web DDM] 도면 누락 건 (Missing Drawings)&body=요청자 ID(Requester ID) : <?php echo $this->session->user_login;?>%0A요청자 이름(Requester Name) : <?php echo $this->session->user_display_name;?>%0A%0A아래 도번이 누락되었습니다. (Drawing Number below is missing.)%0A도면번호%0A%0A<?php echo $email_dwg_email;?>";
		<?php }
		else{ ?>
			window.location.href = "mailto:<?php echo config_item('to');?>?cc=<?php echo config_item('cc');?>&subject=[Web DDM] 도면 누락 건 (Missing Drawings)&body=요청자 ID(Requester ID) : <?php echo $this->session->user_login;?>%0A요청자 이름(Requester Name) : <?php echo $this->session->user_display_name;?>%0A%0A아래 도번이 누락되었습니다. (Drawing Number below is missing.)%0A도면번호%0A%0A<?php echo $email_dwg_email;?>";
		<?php }?>
		$('#email_modal').modal('hide');
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