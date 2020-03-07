<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.loadState('main-container')
        } catch (e) {
        }
    </script>

    <?php echo $sidebar; ?>

    <div class="main-content">
        <div class="main-content-inner">
            <?php echo $breadcrumb; ?>
            
            <div class="page-content">

            

                <div class="row">
                    <div class="col-xs-12">
                    <?php if ($success = $this->session->flashdata("success")) { ?>
                                    <div class="alert alert-block alert-success" id="alert_success" style="margin-top: 10px;">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button>
                                        <p>
                                            <strong>
                                                <i class="ace-icon fa fa-check"></i>
                                                Success!
                                            </strong>
                                            <?php echo $success; ?>.
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($failure = $this->session->flashdata("failure")) { ?>
                                    <div class="alert alert-danger" id="alert_failure" style="margin-top: 10px;">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button>

                                        <strong>
                                            <i class="ace-icon fa fa-times"></i>
                                            Failure!
                                        </strong>
                                        <?php echo $failure; ?>.
                                        <br>
                                    </div>
                                <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->

                        <div class="widget-box" style="margin-top: 20px;">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="widget-title lighter"><?php echo $page_name; ?></h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div id="fuelux-wizard-container">

                                        <div class="step-content pos-rel">
                                            <div class="step-pane active" data-step="1">
                                                <form class="form-horizontal" id="recieve_payment_form" method="post"
                                                      action="<?php echo $admin_post_payment_individually; ?>">
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-12 col-sm-2 no-padding-right"
                                                                for="name">Member: <span
                                                                style="color:red;">*</span></label>

                                                        <div class="col-xs-12 col-sm-4">
                                                            <div class="clearfix">
                                                                <select class="col-xs-12 col-sm-12" id="member_id" name="member_id" required>
                                                                    <option value=''>Select Member</option> 
                                                                    <?php foreach($members as $member) {
                                                                        $selected = ($member['user_id'] == $user_id) ? 'selected' : '';
                                                                        echo "<option value='{$member['user_id']}'>{$member['name']}</option>";
                                                                    }?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-xs-12 col-sm-3 col-sm-offset-9 text-right">
                                                            <div class="clearfix">
                                                                <input type="button" value="Search Pending Payments" class="btn btn-sm btn-success " name="action" style="height: 30px;padding-top: 3px;" id="search_member_btn"/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="container_div"></div>
                                                    
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div><!-- /.widget-main -->
                            </div><!-- /.widget-body -->
                        </div>

                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->

    <?php echo $footer_panel; ?>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->

<!-- basic scripts -->
<script>
    var current_page = "add_user_page";
</script>
<?php echo $jquery_view; ?>

<script>
    $("#individual_payments_li").addClass("active")
        .parent()
        .parent().addClass("active open");

    $(document).ready(function ()
    {
        $("#search_member_btn").click(function(e){

            if($("#member_id").val()) {
                $.ajax({
                    type: "POST", 
                    cache: false,
                    dataType: 'html',
                    url: '<?php echo $admin_post_payment_individually;?>',
                    data: { user_id : $("#member_id").val() },
                    success : function(data) {
                        $("#container_div").append(data);
                        $("#search_member_btn").closest(".form-group").hide(); 
                    },
                });
            } else {
                $("#container_div").empty();
            }
        });
        
        $("#member_id").change(function(e){
            $("#container_div").empty();
            $("#search_member_btn").closest(".form-group").show(); 
        }).trigger('change');

        $(document).on("change","#all_checkbox", function(e){
            $("#container_div .user_checkbox").prop("checked",$(this).is(':checked')).trigger('change');
            /* var $that = $(this);
            $("#container_div .user_checkbox").each(function(i,e){
                $(e).prop("checked",$that.is(':checked')).trigger('change');
            }); */
        });

        $(document).on("change",".user_checkbox", function(e){
            $payable_amount = 0;
            $("#container_div .user_checkbox").each(function(i,e){
                if($(e).is(':checked')) {
                    $payable_amount += parseInt($(e).data('amount'));
                }
            });

            $("#total_td").text($payable_amount);
        }).on("click","#pay_button", function(e){

            if($("#container_div .user_checkbox:checked").length == 0) {
                alert("Please select atleast one transection.");
            } else {
                $("#recieve_payment_form").trigger('submit');
            }
            
        });
    });
</script>
