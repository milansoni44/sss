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
                                                      action="<?php echo $admin_import_payment; ?>" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-12 col-sm-2 no-padding-right"
                                                                for="name">Import: <span
                                                                style="color:red;">*</span></label>

                                                        <div class="col-xs-12 col-sm-4">
                                                            <div class="clearfix">
                                                                <!--<select class="col-xs-12 col-sm-12" id="member_id" name="member_id" required>
                                                                    <option value=''>Select Member</option> 
                                                                    <?php foreach($members as $member) {
                                                                        $selected = ($member['user_id'] == $user_id) ? 'selected' : '';
                                                                        echo "<option value='{$member['user_id']}'>{$member['name']}</option>";
                                                                    }?>
                                                                </select>-->
                                                                <input type="file" name="csv_file" class="form-control" required />
                                                            </div>
                                                        </div>
                                                        <input type="submit" name="Import" class="btn btn-sm btn-success " />
                                                        
                                                    </div>
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
<?php echo $jquery_view; ?>

<script>
    $("#import_payments_li").addClass("active")
        .parent()
        .parent().addClass("active open");

    $(document).ready(function ()
    {
        $("#mobile").on('keydown', function (e)
        {
            -1 !== $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) || /65|67|86|88/.test(e.keyCode) && (!0 === e.ctrlKey || !0 === e.metaKey) || 35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey || 48 > e.keyCode || 57 < e.keyCode) && (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
        });
    });
</script>