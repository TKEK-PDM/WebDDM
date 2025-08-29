<?php include_once 'header.php' ?>

<div class="modal fade" id="error_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo lang('label_message'); ?></h4>
            </div>
            <div class="modal-body" id="error_message"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo lang('button_close'); ?></button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="file_not_exist_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo lang('label_message'); ?></h4>
            </div>
            <div class="modal-body" id="not_exist_msg"><?php echo lang('message_file_not_exist'); ?></div>
            <div class="modal-body" id="tdm_id_msg"></div>
            <div class="modal-body" id="revision_msg"></div>
            <div class="modal-body" id="file_name_msg"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo lang('button_close'); ?></button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="container">
    <div class="modal fade" id="profile_card">
        <div class="modal-header">
            <h4 id="profile_card_header"><?php echo lang('label_profile_card'); ?></h4>
        </div>
        <div class="modal-body" id="modalBody"><?php echo lang('label_please_wait') ?>...</div>
        <div class="modal-footer" id="modalfooter">
            <button class="btn btn-outline btn-blue buttonSpace" type="button"
                    onclick="flushProfileCardCss();"><?php echo lang('button_close'); ?></button>
        </div>
    </div>
</div>

<div id="wrapper">
    <div class="container top-container">
        <?php include_once 'top_nav.php' ?>
    </div>
    <div class="container body-container">
        <?php include_once 'side_nav.php' ?>
        <div class="container force-desktop">
            <?php echo $content; ?>
        </div>
    </div>
</div>
<!-- /#wrapper -->

<?php include_once 'footer.php' ?>

</html>
