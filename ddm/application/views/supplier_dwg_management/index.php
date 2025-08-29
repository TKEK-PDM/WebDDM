<div id="page-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="page-header"><?php echo lang('label_supplier_dwg_management'); ?>
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
    <form class="form-horizontal ng-pristine ng-valid keep searchForm" role="form"
          id="search_form" role="form" action="<?php echo current_url(); ?>"
          method="post">
        <input type="hidden" id="keep" name="keep" value="<?php echo $keep; ?>"/>
		<div id="collapsingDiv" class="form-inline">
            <div class="form-group searchDiv5">
                <div class="col-xs-12">
                    <label class="tableLabel smallLabel"><?php echo lang('label_supplier_code'); ?></label>
                    <input class="form-control normalInput" type="text" id="sup_code"
                    name="sup_code" value="<?php echo $sup_code; ?>"
                    title="<?php echo lang('message_field_required'); ?>"
                    required="required"> <input type="hidden" name="search_message"
                    id="search_message" value="<?php echo $search_message; ?>"/>
                </div>
            </div>
            <div class="form-group searchDiv5">
                <div class="col-xs-12">
                    <label class="tableLabel smallLabel"><?php echo lang('label_supplier_name'); ?></label>
                    <input class="form-control normalInput" type="text" id="sup_name"
                            name="sup_name" value="<?php echo $sup_name; ?>" disabled="disabled">
                </div>
            </div>
            <div class="form-group btb-group searchDiv5">
                <div class="col-xs-12">
                    <button class="btn btn-outline btn-blue buttonSpace"
                            onclick="exportexcel('search');" type="button"><?php echo lang('button_search'); ?></button>
                </div>
            </div>
        </div>
        <input type="hidden" id="query" name="query" value=""/>
    </form>
    <!-- search field  end-->

    <!-- list start -->
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading panel_blue">
                    <b><?php echo lang('label_list'); ?>(<?php echo count($data); ?>)</b>
                    <span class="pull-right">
                    <?php if ($this->session->user_role != '4'): ?>
                        <button class="btn btn-outline btn-blue buttonSpace" type="button"
                                onclick="delete_check()"><?php echo lang('button_delete'); ?></button>
                        <button class="btn btn-outline btn-blue buttonSpace" type="button"
                                onclick="showCopyModal()"><?php echo lang('button_copy_to_supplier_b'); ?></button>
                    <?php endif; ?>
                    <button class="btn btn-outline btn-blue buttonSpace" type="button"
                            onclick="exportexcel('export');"><?php echo lang('button_excel_export'); ?></button>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table
                            class="table table-striped table-bordered table-hover dataTables_single"
                            id="demoTable">
                            <thead>
                            <tr>
                                <?php if ($this->session->user_role != '4'): ?>
                                    <th><input type="checkBox" id="checkAll" value="" class=""></th>
                                <?php endif; ?>
                                <th><?php echo lang('label_no'); ?></th>
                                <th><?php echo lang('label_dwg_no'); ?></th>
                                <th><?php echo lang('label_revision'); ?></th>
                                <th><?php echo lang('label_dwg_name'); ?>(EN)</th>
                                <!-- <th><?php echo lang('label_dwg_name'); ?>(KO)</th> -->
                                <th><?php echo lang('label_assign_user'); ?></th>
                                <th><?php echo lang('label_assign_date'); ?></th>
                                <th><?php echo lang('label_assign_time'); ?></th>
                                <th><?php echo lang('label_down_date'); ?></th>
                                <th><?php echo lang('label_down_time'); ?></th>
                                <th><?php echo lang('label_down_count'); ?></th>
                                <th><?php echo lang('label_file_type');?></th>
                                <th style="width: 56px;"><?php echo lang('label_dwg_file'); ?></th>
                                <th style="width: 56px;"><?php echo lang('label_pdf'); ?></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $key => $val): ?>
                                <tr>
                                    <?php if ($this->session->user_role != '4'): ?>
                                        <td><input type="checkBox" id=""
                                                   value="<?php echo $val->DWG_NO; ?>" class="dwg_sup_info"></td>
                                    <?php endif; ?>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $val->DWG_NO; ?></td>
                                    <td><?php echo $val->REVISION; ?></td>
                                    <td><?php echo $val->TDM_DESCRIPTION; ?></td>
                                    <!-- <td><?php echo $val->CN_LOCAL_DESCRIPTION; ?></td> -->

                                    <td><?php echo $val->CRT_USER; ?></td>
                                    <td><?php echo $val->CRT_DATE; ?></td>
                                    <td><?php echo $val->CRT_TIME; ?></td>
                                    <td><?php echo $val->DOWN_D; ?></td>
                                    <td><?php echo $val->DOWN_T; ?></td>
                                    <td><?php echo $val->DOWN_COUNT; ?></td>
                                    <td><?php echo $val->FILE_TYPE_NAME; ?></td>
                                    <td class="align_middle"><a href="javascript:void(0);" target="_blank"
															onclick="check_file_exist(<?php echo "'" . $val->FILE_NAME . "','" . $val->SITE_NAME . "','" . $val->REVISION . "','" . $val->OBJECT_ID . "','" . $val->CLASS_ID . "','" . $val->DWG_NO . "')"; ?>">
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
										</td>
                                        <?php if ($val->PDF_YN != 'N'):?>
    										<td class="align_middle"><a href="javascript:void(0);"
											onclick="check_file_exist(<?php echo "'" . $val->PDF_FILE_NAME . "','" . $val->SITE_NAME . "','" . $val->REVISION . "','" . $val->OBJECT_ID . "','" . $val->CLASS_ID . "','" . $val->DWG_NO . "')"; ?>">
											<img src="<?php echo base_url();?>public/images/pdf.png" style="max-width:50%"/>
										</a></td>
										<?php else:?>
											<td class="align_middle"><?php echo $val->PDF_YN; ?></td>
										<?php endif;?>


                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- list end -->
</div>


<div class="container">
    <div class="modal fade" id="copy_modal">
        <div class="modal-header" id="copy_modal_header">
            <h4 id=""><?php echo lang('label_copy_to_b'); ?></h4>
        </div>
        <div class="modal-body" id="copy_modal_body"><?php echo lang('label_please_wait') ?>...</div>
        <div class="modal-footer" id="copy_modal_footer">
            <button class="btn btn-outline btn-blue buttonSpace" type="button"
                    onclick="flushPage();"><?php echo lang('button_close'); ?></button>
        </div>
    </div>
</div>


<!-- delete modal begin-->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo lang('label_message'); ?></h4>
            </div>
            <div class="modal-body" id="delete_message"><?php echo lang('message_delete_supplier_confirm') ?>(<b
                    id="delete_count"></b>)
            </div>
            <div class="modal-footer" id="delete_modal_footer">
                <button class="btn btn-outline btn-blue buttonSpace" type="button"
                        onclick="delete_supplier();"><?php echo lang('button_delete'); ?></button>
                <button class="btn btn-outline btn-blue buttonSpace" type="button"
                        onclick="$('#delete_modal').modal('hide');"><?php echo lang('button_close'); ?></button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- delete modal end-->


<script type="text/javascript">
    $(document).ready(function () {
        var table = $('.dataTables_single').DataTable({
            "bPaginate": true,
            "bFilter": true,
            "bInfo": false,
            ordering: true,
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0]}],
            "language": {
                url: "/public/js/<?php echo $this->session->lan_package;?>"
            },
            "aaSorting": [],
        });

        $("#checkAll").click(function () {
            if (this.checked) {
                $(".dwg_sup_info").each(function () {
                    this.checked = true;
                });
            } else {
                $(".dwg_sup_info").each(function () {
                    this.checked = false;
                });
            }
        });


        $("#search_form").validate({
            tooltip_options: {
                sup_code: {placement: 'bottom'}

            },
            submitHandler: function (form) {
                if ($("#query").val() != "export") {
                    $.blockUI({message: '<h3><?php echo lang('label_please_wait');?>...</h3>'});
                }
                form.submit();
            },
        });

        //check search 0 result
        if ($("#search_message").val() == 0 && $("#sup_code").val() != "") {
            if ($("#sup_name").val() == "") {
                $("#error_message").html("<?php echo lang('message_sup_code_not_exist');?>");
            } else {
                $("#error_message").html("<?php echo lang('message_no_match_record');?>");
            }
            $("#error_modal").modal();
            $('#error_modal').modal().css({
                'margin-top': function () {
                    return ($(this).height() / 3);
                }
            });
        }
    });

    //delete dwg supplier begin
    function delete_check() {
        var sup_code = $("#sup_code").val();
        var dwg_no_str = "";
        var item_count = 0;
        $(".dwg_sup_info").each(function () {
            if ($(this).is(":checked")) {
                if (dwg_no_str == "") {
                    dwg_no_str = $(this).val();
                } else {
                    dwg_no_str = dwg_no_str + "," + $(this).val();
                }
                item_count++;
            }
        });
        if (dwg_no_str == "") {
            $('#error_message').html('<?php echo lang('message_multi_download_no_row_select');?>');
            $('#error_modal').modal('show');
            return false;
        }
        $("#delete_count").html(item_count);
        $('#delete_modal').modal({backdrop: 'static', keyboard: false});
    }

    function delete_supplier() {
        var sup_code = $("#sup_code").val();
        var dwg_no_str = "";
        $(".dwg_sup_info").each(function () {
            if ($(this).is(":checked")) {
                if (dwg_no_str == "") {
                    dwg_no_str = $(this).val();
                } else {
                    dwg_no_str = dwg_no_str + "," + $(this).val();
                }
            }
        });
        $.ajax({
            type: "POST",
            async: false,
            cache: false,
            url: "<?php echo site_url('supplier_dwg_management/delete_dwg_supplier'); ?>",
            data: {
                'sup_code': sup_code,
                'dwg_no_str': dwg_no_str
            },
            success: function (msg) {
                $('#delete_modal').modal('hide');
                if (msg != 0) {
                    $('#error_message').html(msg + " <?php echo lang('message_assigned_drawing_delete');?>");
                    $('#error_modal').modal('show');
                    $(".dwg_sup_info").each(function () {
                        if ($(this).is(":checked")) {
                            $(this).parent().parent().remove();
                        }
                    });
                    $("#checkAll").attr("checked", false);
                } else {
                    $('#error_message').html("0 <?php echo lang('message_assigned_drawing_delete');?>");
                    $('#error_modal').modal('show');
                }
            }
        });
    }
    //delete dwg supplier end

    //copy modal
    function showCopyModal() {
        //$('#modalBody').html("<?php echo lang('label_please_wait');?>...");
        //$('#modalfooter').hide();
        $("#copy_modal").draggable({
            cursor: "move",
            handle: '#copy_modal_header'
        });
        var sup_code = $("#sup_code").val();
        var sup_name = $("#sup_name").val();
        $.ajax({
            type: "POST",
            async: false,
            cache: false,
            url: "<?php echo site_url('supplier_dwg_management/copy_display'); ?>",
            data: {
                'sup_code_from': sup_code,
                'sup_name_from': sup_name,
            },
            success: function (msg) {
                $('#copy_modal_body').html(msg);
                $('#copy_modal').modal({backdrop: 'static', keyboard: false});
            }
        });
        return false;
    }

    function flushPage() {
        $('#copy_modal').modal('hide');
        $('#selectSupplierModal').modal('hide');
        setTimeout(function () {
            $('#copy_modal').css("position", "fixed");
            $('#copy_modal').css("top", "300px");
            $('#copy_modal').css("left", "50%");
            $('#copy_modal').css("margin-left", "-300px");
        }, 1000);
    }

    function exportexcel(obj) {
        $("#query").val(obj);
        $("#search_form").submit();
    }

</script>