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
            <?php
            if ($user_id) {
                $admin_add_user_link .= '/' . $user_id;
            }
            ?>
            <div class="page-content">

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->

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



                        <div class="widget-box" style="margin-top: 20px;">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="widget-title lighter"><?php echo $page_name; ?></h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div id="fuelux-wizard-container">

                                        <div class="step-content pos-rel">
                                            <div class="step-pane active" data-step="1">

                                                <form class="form-horizontal" id="add_user_form" method="post"
                                                      action="<?php echo $admin_profile_link; ?>">

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-12 col-sm-2 no-padding-right"
                                                               for="name">Name: <span
                                                                style="color:red;">*</span></label>

                                                        <div class="col-xs-12 col-sm-4">
                                                            <div class="clearfix">
                                                                <input type="text" id="name" name="name"
                                                                       class="col-xs-12 col-sm-12" required placeholder="Name"
                                                                       value="<?php echo set_value('name', html_entity_decode($user_info['name'], ENT_QUOTES)); ?>"/>
                                                            </div>
                                                            <?php echo form_error('name', '<div class="help-block">', '</div>'); ?>
                                                        </div>

                                                        <label class="control-label col-xs-12 col-sm-2 no-padding-right"
                                                               for="mobile">Mobile:</label>

                                                        <div class="col-xs-12 col-sm-4">
                                                            <div class="clearfix">
                                                                <input type="text" id="mobile" name="mobile" placeholder="Mobile"
                                                                       class="col-xs-12 col-sm-12"
                                                                       value="<?php echo set_value('mobile', html_entity_decode($user_info['mobile'], ENT_QUOTES)); ?>"/>
                                                            </div>
                                                            <?php echo form_error('mobile', '<div class="help-block">', '</div>'); ?>
                                                        </div>


                                                    </div>








                                                    <div class="form-group">
                                                        <label class="control-label col-xs-12 col-sm-2 no-padding-right"
                                                               for="email">Email:</label>

                                                        <div class="col-xs-12 col-sm-4">
                                                            <div class="clearfix">
                                                                <input type="email" id="email" name="email" placeholder="Email ID"
                                                                       class="col-xs-12 col-sm-12"
                                                                       value="<?php echo set_value('email', html_entity_decode($user_info['email'], ENT_QUOTES)); ?>"/>
                                                            </div>
                                                            <?php echo form_error('email', '<div class="help-block">', '</div>'); ?>
                                                        </div>

                                                        <label class="control-label col-xs-12 col-sm-2 no-padding-right"
                                                               for="user_name">User Name:<span
                                                                style="color:red;">*</span></label>

                                                        <div class="col-xs-12 col-sm-4">
                                                            <div class="clearfix">
                                                                <input type="text" id="user_name" name="user_name" placeholder="User Name"
                                                                       class="col-xs-12 col-sm-12" required
                                                                       value="<?php echo set_value('user_name', html_entity_decode($user_info['user_name'], ENT_QUOTES)); ?>"/>
                                                            </div>
                                                            <?php echo form_error('user_name', '<div class="help-block">', '</div>'); ?>
                                                        </div>

                                                    </div>

                                                    <div class="form-group">





                                                        <label class="control-label col-xs-12 col-sm-2 no-padding-right"
                                                               for="password">Password:</label>

                                                        <div class="col-xs-12 col-sm-4">
                                                            <div class="clearfix">
                                                                <input type="password" id="password" name="password" placeholder="Password"
                                                                       class="col-xs-12 col-sm-12" <?php echo ($task_type == "add") ? "required" : ""; ?> />
                                                            </div>
                                                            <?php echo form_error('password', '<div class="help-block">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                    <h4 class="header smaller lighter blue">
                                                       &nbsp;
                                                    </h4>
                                                    <div class="space-6"></div>
                                                    <div class="form-group">
                                                        <div class="col-xs-12 col-sm-12 center">
                                                            <input type="submit"
                                                                   value="<?php echo ($task_type == "add") ? "Add" : "Update"; ?>"
                                                                   class="btn btn-sm btn-success" id="add_user_button">
                                                            <a href="<?php echo $admin_user_list_link ?>"
                                                               class="btn btn-sm">
                                                                Cancel
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="task_type"
                                                           value="<?php echo $task_type; ?>">

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
    $("#add_user_li").addClass("active")
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
