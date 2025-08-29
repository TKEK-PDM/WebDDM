<style>
    .input-group{
        min-width: max-content;
    word-break: keep-all;
    }
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="page-header"><?php echo lang('label_download_log'); ?>
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
        <input type="hidden" id="keep" name="keep" value="<?php echo $keep; ?>"/>
		<div id="collapsingDiv" class="form-inline">
			<div class="form-group searchDiv5" style="max-width:300px">
                <div class="col-xs-12 radio-group">
                    <label class="tableLabel w-max"><?php echo lang('label_user_type'); ?></label>
                    <div class="input-group">
                        <label for="user_type_all"> <input name="user_type" type="radio" id="user_type_all"
                                                            value="A" checked="checked"> ALL
                        </label> 
                        <label for="$info['DWG_NO']"> <input name="user_type"
                                                                    id="$info['DWG_NO']" type="radio" value="S"
                                <?php if ($info['USER_TYPE'] == 'S'): ?> checked="checked"
                                <?php endif; ?>><?php echo lang('label_supplier_user'); ?>
                        </label> 
                        <label for="user_type"> <input name="user_type"
                                                                    id="user_type" type="radio" value="I"
                                <?php if ($info['USER_TYPE'] == 'I'): ?> checked="checked"
                                <?php endif; ?>><?php echo lang('label_internal_user'); ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group searchDiv5" >
                <div class="col-xs-12">
                    <label class="tableLabel "><?php echo lang('label_drawing_no'); ?></label>
                    <input class="form-control normalInput" type="text" name="DRAWING_NO"
                        id="DRAWING_NO" value="<?php echo $info['DWG_NO']; ?>">
                </div>
            </div>
            <div class="form-group searchDiv5" >
                <div class="col-xs-12">
                    <label class="tableLabel tableLabel "><?php echo lang('label_user_id'); ?></label>
                    <input class="form-control  normalInput" type="text" name="USER_ID"
                        id="USER_ID" value="<?php echo $info['USER_ID']; ?>">
                </div>
            </div>
            <div class="form-group searchDiv5" >
                <div class="col-xs-12">
                    <label class="tableLabel tableLabel "><?php echo lang('label_user_name'); ?></label>
                    <input class="form-control  normalInput" type="text" name="USER_NAME"
                        id="USER_NAME" value="<?php echo $info['USER_NAME']; ?>">
                </div>

            </div>
            <div class="form-group searchDiv5" style="max-width:300px">
                <div class="col-xs-12 radio-group">
                    <label class="tableLabel w-max"><?php echo lang('label_date'); ?></label>
                    <div class="input-group">
                        <label for="date_day"> <input name="date" type="radio"
                                                            value="1" checked="checked" id="date_day"
                                                            class="datenow"> <?php echo lang('label_today'); ?>
                        </label>
                        <label for="date_week"> <input name="date" id="date_week"
                                                                    type="radio" value="2" class="datenow"
                                <?php if ($info['DATE'] == 2): ?> checked="checked" <?php endif; ?>><?php echo lang('label_1week'); ?>
                        </label> 
                        <label for="date_custom"> <input name="date" id="date_custom"
                                                                    type="radio" value="3" class="datenow"
                                <?php if ($info['DATE'] == 3): ?> checked="checked" <?php endif; ?>><?php echo lang('label_manually'); ?>

                        </label> 
                    </div>
                </div>
            </div>
            <div class="form-group searchDiv5 calendar_wrap" style="display: none;">
                <div class="col-xs-6">
                        <label class=" calendar" style="display: none;">
                            <?php echo lang('label_from'); ?>
                            <div class="input-append date form_datetime" id="fromdate">
                                <input name="fromdate" id="fromda" size="16" type="text"
                                    value="<?php echo $info['FROM']; ?>" readonly> <span class="add-on"><i
                                        class="icon-calendar"></i></span>
                                        </div>
                    </label> 
                </div>
                <div class="col-xs-6">
                        <label class=" calendar" style="display: none;">
                            <?php echo lang('label_to'); ?>
                            <div class="input-append date form_datetime" id="todate">
                                <input name="todate" id="toda" size="16" type="text"
                                    value="<?php echo $info['TO']; ?>" readonly> <span class="add-on"><i
                                        class="icon-calendar" id="iconto"></i></span>
                            </div>
                        </label> <input type="hidden" id="fromcal" name="fromcal"
                                        value="<?php echo $info['FROM']; ?>"> <input type="hidden" id="tocal"
                                                                                    name="tocal"
                                                                                    value="<?php echo $info['TO']; ?>">
                    
                </div>
            </div>
            
            <div class="form-group searchDiv5" style="max-width: 80px;">
                <div class="col-xs-12">
                <input type="hidden" name="query" id="query">
                <button class="btn btn-outline btn-blue buttonSpace" type="button"
                        onclick="searchDwgLog();"><?php echo lang('button_search'); ?></button>
                </div>
            </div>
        </div>

        <!-- <div class="form-group " style="padding-left: 15px;">
            <input type="hidden" name="query" id="query">
            <button class="btn btn-outline btn-blue buttonSpace" type="button"
                    onclick="searchDwgLog();"><?php echo lang('button_search'); ?></button>
            <form class="form-horizontal searchForm" method="post" id="file_form"
                  enctype="multipart/form-data">
                <button class="btn btn-outline btn-blue buttonSpace" type="button"
                        onclick="exportexcel();"><?php echo lang('button_excel_export'); ?></button>
            </form>
        </div> -->
    </form>
    <!-- list end -->
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading panel_blue">
                    <b>Download Log List(<?php echo count($data); ?>)</b>
                    <span class="pull-right">
                        <form class="form-horizontal searchForm" method="post" id="file_form"
                            enctype="multipart/form-data">
                            <button class="btn btn-outline btn-blue buttonSpace" type="button"
                                    onclick="exportexcel();"><?php echo lang('button_excel_export'); ?></button>
                        </form>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table
                            class="table table-striped table-bordered table-hover dataTables_paging"
                            id="downloadlog">
                            <thead>
                            <tr>
                                <th><?php echo lang('label_no'); ?></th>
                                <th><?php echo lang('label_object_id'); ?></th>
                                <th><?php echo lang('label_class'); ?></th>
                                <th><?php echo lang('label_dwg_no'); ?></th>
                                <th><?php echo lang('label_dwg_name'); ?>(EN)</th>
                                <th><?php echo lang('label_dwg_name'); ?>(KO)</th>
                                <th><?php echo lang('label_revision'); ?></th>
                                <th><?php echo lang('label_user_type'); ?></th>
                                <th><?php echo lang('label_user_id'); ?></th>
                                <th><?php echo lang('button_sup_code'); ?></th>
                                <th><?php echo lang('label_user_name'); ?></th>
                                <th><?php echo lang('label_down_date'); ?></th>
                                <th><?php echo lang('label_down_time'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $key => $value): ?>
                                <tr class="odd gradeX">
                                    <td class="align_middle"><?php echo $key + 1; ?></td>
                                    <td><?php echo $value->OBJECT_ID; ?></td>
                                    <td><?php echo $value->CLASS_ID; ?></td>
                                    <td><?php echo $value->TDM_ID; ?></td>

                                    <td><?php echo $value->TDM_DESCRIPTION; ?></td>
                                    <td><?php echo $value->CN_LOCAL_DESCRIPTION; ?></td>

                                    <td><?php echo $value->REVISION; ?></td>
                                    <td><?php echo $value->USER_TYPE; ?></td>
                                    <td><?php echo $value->USER_ID; ?></td>
                                    <td><?php echo $value->SUP_CODE; ?></td>
                                    <td><?php echo $value->USER_NAME; ?></td>
                                    <td><?php echo $value->DOWN_D; ?></td>
                                    <td><?php echo $value->DOWN_T; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $.unblockUI();
        $('.dataTables_paging').DataTable({
            responsive: true,
            ordering: true,
            "bSort": true,
            "bFilter": false,
            "language": {
                url: "/public/js/<?php echo $this->session->lan_package;?>"
            }
        });

        $(".datenow").click(function () {
            if ($(this).val() == 3) {
                $(".calendar").removeAttr("style");
                $(".calendar_wrap").attr("style", "display:block");
                $(".day").removeClass("active");
                $(".today").addClass("active");
                $("#toda").val("<?php echo $todayval;?>");
            } else {
                $("#fromda").val("");
                $("#toda").val("");
                $(".calendar").attr("style", "display:none");
                $(".calendar_wrap").attr("style", "display:none");
                $("#toda").datepicker('option', 'minDate', null);
                $("#fromda").datepicker('option', 'maxDate', null);
            }
        });
        if ($("input[name='date']:checked").val() == 3) {
            $(".calendar").removeAttr("style");
        }
        $('#fromda').datepicker($.datepicker.regional["<?php if ($this->session->lan_package == 'english.json'):?>en<?php elseif ($this->session->lan_package == 'korean.json'):?>ko<?php endif;?>"]
        );
        $("#fromda").datepicker("option", "dateFormat", "yymmdd");
        $('#toda').datepicker($.datepicker.regional["<?php if ($this->session->lan_package == 'english.json'):?>en<?php elseif ($this->session->lan_package == 'korean.json'):?>ko<?php endif;?>"]
        );
        $("#toda").datepicker("option", "dateFormat", "yymmdd");
        // Lock the min date cant less than start date
        $("#fromda").bind("change", function () {
            $("#toda").datepicker('option', 'minDate', $(this).datepicker('getDate'));
        });
        $("#toda").bind("change", function () {
            $("#fromda").datepicker('option', 'maxDate', $(this).datepicker('getDate'));
        });
        $("#fromda").val("<?php echo $info['FROM'];?>");
        $("#toda").val("<?php echo $info['TO'];?>");

    });
    function searchDwgLog() {
        $("#query").val('');
        var from = $("#fromda").val();
        $("#fromcal").val(from);
        var to = $("#toda").val();
        $("#tocal").val(to);
        $.blockUI({message: '<h3><?php echo lang('label_please_wait');?>...</h3>'});
        $("#frm").attr("action", "<?php echo site_url("Download_log/search")?>");
        $("#frm").submit();
    }

    function exportexcel() {
        $("#query").val('export');
        $("#frm").attr("action", "<?php echo site_url("Download_log/search")?>");
        $("#frm").submit();
    }

</script>