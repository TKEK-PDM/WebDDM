<footer id="footer" style="margin-bottom: 0px; margin-left: 250px; width: calc(100% - 250px); transition: all 0.2s ease; position: fixed; background: #FAFAFA; bottom: 0">
    <div class="copyright">TK Elevator &#169; 2021</div>
</footer>
</body>
<script type="text/javascript">
    $(document).ready(function () {

        console.log('START LOAD');

        // IE일 경우 상태 저장 안함
        // Chrome 등 Local Storage 사용 가능한 경우에만 상태 Load
        var menuState = true;

        if(localStorage === undefined){
            console.log('LOCAL STORAGE IS NOT SUPPORTED');
        }
        else{
            var storageState = localStorage.getItem('SIDE_OPEN');
            if(storageState !== null){
                menuState = storageState === '1' ? true : false;
            }
            else{
                localStorage.setItem('SIDE_OPEN' , '1');
            }
        }



        if(menuState === false){
            $(".sidebar").addClass("remove-transition")
            $("#showMenuBtn").addClass("remove-transition")
            $("#showHideDiv").addClass("remove-transition")
            $("#resizeDiv").addClass("remove-transition")
            $("#page-wrapper").addClass("remove-transition")
            $("#navbar-static-top").addClass("remove-transition")
            $("#footer").addClass("remove-transition")


            $(".sidebar").hide();
            $(".sidebar").css("width", "0px");
            $("#showMenuBtn").show();
            $("#showMenuBtn").css("top", "105px");
            $("#showHideDiv").css("margin-left", "20px");
            $("#resizeDiv").css("left", "20px");
            $("#page-wrapper").css({"margin-left": "0px", "width": "100%"});
            $("#navbar-static-top").css({"margin-left": "0px", "width": "100%"});
            $("#footer").css({"margin-left": "0px", "width": "100%"});

            setTimeout(() => {
                $(".sidebar").removeClass("remove-transition")
                $("#showMenuBtn").removeClass("remove-transition")
                $("#showHideDiv").removeClass("remove-transition")
                $("#resizeDiv").removeClass("remove-transition")
                $("#page-wrapper").removeClass("remove-transition")
                $("#navbar-static-top").removeClass("remove-transition")
                $("#footer").removeClass("remove-transition")
            }, 1000);

           
        }



        $(".showHideMenus").on("click", function () {
            if ($(".sidebar").is(":visible")) {
                $(".sidebar").hide();
                $(".sidebar").css("width", "0px");
                $("#showMenuBtn").show();
                $("#showMenuBtn").css("top", "105px");
                $("#showHideDiv").css("margin-left", "20px");
                $("#resizeDiv").css("left", "20px");
                $("#page-wrapper").css({"margin-left": "0px", "width": "100%"});
                $("#navbar-static-top").css({"margin-left": "0px", "width": "100%"});
                $("#footer").css({"margin-left": "0px", "width": "100%"});

                localStorage.setItem('SIDE_OPEN' , '0');
                menuState = false;
            } else {
                $(".sidebar").show();
                $("#showMenuBtn").hide();
                $(".sidebar").css("width", "250px");
                $("#showHideDiv").css("margin-left", "250px");
                $("#resizeDiv").css("left", "250px");
                $("#page-wrapper").css({"margin-left": "250px", "width": "calc(100% - 250px)"});
                $("#navbar-static-top").css({"margin-left": "250px", "width": "calc(100% - 250px)"});
                $("#footer").css({"margin-left": "250px", "width": "calc(100% - 250px)"});

                

                localStorage.setItem('SIDE_OPEN' , '1');
                menuState = true;
            }

            /*use jquery to resize the table head*/
            var scrollTableBodyWidth = $(".dataTables_scrollBody table").width();
            var scrollTableHeaderWidth = scrollTableBodyWidth;
            $(".dataTables_scrollHeadInner table").width(scrollTableHeaderWidth);

        });

        $('#side-menu').metisMenu();
        var url = '<?php echo $this->session->userdata('menu_url'); ?>';
        var element = $('ul.nav a').filter(function () {
            return this.href == url /*|| url.href.indexOf(this.href) == 0 */;
        }).addClass('active').parent().parent().addClass('in').parent();
        if (element.is('li')) {
            element.addClass('active');
        }

        /*var h=$(window).height()-150;
         $("#resizeDiv").css("height",h);
         $("#resizeDiv").mousedown(function(e){
         $(".sidebar").show();
         var disX = (e || event).clientX;
         document.onmousemove = function(e) {
         if((e || event).clientX<=250){
         $(".sidebar").css("width",(e || event).clientX);
         $(".sidebar").css("overflow","hidden");
         $("#resizeDiv").css("left",(e || event).clientX);
         $("#page-wrapper").css("margin-left",(e || event).clientX);
         }

         var h=$("#page-wrapper").height();
         $("#resizeDiv").css("height",h);
         return false ;
         };
         document.onmouseup = function() {
         document.onmousemove = null;
         document.onmouseup = null;
         $("#page-wrapper").releaseCapture && $("#page-wrapper").releaseCapture() ;

         };
         $("#page-wrapper").setCapture && $("#page-wrapper").setCapture();
         return false ;
         });*/

        $("#multi_download").on('click', function () {
            if ($("input[name='file_name[]']:checked").length < 1) {
                $("#error_message").html("<?php echo lang('message_multi_download_no_row_select');?>");
                $("#error_modal").modal();
            } else {
                var check_result = "Y";

                $("input[name='file_name[]']:checked").each(function (i) {
                    var filename = $(this).attr("file");
                    var site = $(this).attr("site");
                    var revision = $(this).attr("revision");
                    var tdm_id = $(this).attr("tdm_id");
                    $.ajax({
                        type: "POST",
                        async: false,
                        cache: false,
                        url: "<?php echo site_url('latest_draw/check_single_file_exist'); ?>",
                        data: {
                            'file_name': filename,
                            'site': site,
                            'org_down': 'Y'
                        },
                        success: function (msg) {
                            console.log(msg);

                            if (msg == "N") {
                                check_result = "N"
                                $('#tdm_id_msg').html("TDM ID:" + tdm_id);
                                $('#revision_msg').html("<?php echo lang('label_revision');?>:" + revision);
                                $('#file_name_msg').html("<?php echo lang('label_file_name');?>:" + filename);
                                $('#file_not_exist_modal').modal();
                                return false;
                            }
                        }
                    });
                });
                console.log(check_result)
                if (check_result == "Y") {
                    $("#multi_download_form").submit()
                }
            }
        });

    });

    function check_file_exist(filename, site, revision, object_id, class_id, tdm_id, org_down) {
        if(org_down === 'Y') $('#org_down').val('Y');
        else $('#org_down').val('');
        $.ajax({
            type: "POST",
            async: false,
            cache: false,
            url: "<?php echo site_url('download/check_single_file_exist'); ?>",
            data: {
                'file_name': filename,
                'site': site,
                'org_down': $('#org_down').val()
            },
            success: function (msg) {
                //console.log(msg);return false;
                if (msg == "N") {
                    $('#tdm_id_msg').html("TDM ID:" + tdm_id);
                    $('#revision_msg').html("<?php echo lang('label_revision');?>:" + revision);
                    $('#file_name_msg').html("<?php echo lang('label_file_name');?>:" + filename);
                    $('#file_not_exist_modal').modal();
                    return false;
                } else {
                    window.location.href = "<?php echo site_url("download/download_file/")?>/" + filename + "/" + site + "/" + revision + "/" + object_id + "/" + class_id + "/" + tdm_id;
                }
            }
        });
    }

    function showProfileCard(TDM_ID, REVISION) {
        $('#modalBody').html("<?php echo lang('label_please_wait');?>...");
        $('#profile_card_header').html("<?php echo lang('label_profile_card');?>");
        $('#modalfooter').hide();
        $("#profile_card").draggable({
            cursor: "move",
            handle: '#profile_card_header'
        });
        $('#profile_card').modal({backdrop: 'static', keyboard: false});
        $.ajax({
            type: "POST",
            async: false,
            cache: false,
            url: "<?php echo site_url('profile_card/index'); ?>",
            data: {
                'TDM_ID': TDM_ID,
                'REVISION': REVISION,
            },
            success: function (msg) {
                $('#modalBody').html(msg);

                $('#modalfooter').show();
            }
        });
        return false;
    }

    function change_language(language) {
        var form = $('form.keep');
        if (form.length > 0) {
            var keep = $('#keep').val();
            if (keep == true) {
                var action = form.attr('action');
                form.attr('action', action + "?language=" + language);
                form.submit();
            } else {
                window.location.href = "<?php echo current_url();?>?language=" + language
            }
        } else {
            window.location.href = "<?php echo current_url();?>?language=" + language
        }
    }

    function flushProfileCardCss() {
        $('#profile_card').modal('hide');
        setTimeout(function () {
            $('#profile_card').css("margin-left", "-350px");
            $('#profile_card').css("top", "75px");
            $('#profile_card').css("left", "50%");
            $('#profile_card').css("bottom", "75px");
        }, 1000);
    }


    if(screen.height > 900){
		var collapsingHeight="300px";
		var openHeight="480px";
	}else{
		var collapsingHeight="120px";
		var openHeight="280px";
	}
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
</script>
