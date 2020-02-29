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
                                                      action="<?php echo $admin_add_user_link; ?>">

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
                                                               for="email">Address:</label>

                                                        <div class="col-xs-12 col-sm-4">
                                                            <div class="clearfix">
                                                                <input type="text" id="address" name="address" placeholder="Address"
                                                                       class="col-xs-12 col-sm-12"
                                                                       value="<?php echo set_value('address', html_entity_decode($user_info['address'], ENT_QUOTES)); ?>"/>
                                                            </div>
                                                            <?php echo form_error('address', '<div class="help-block">', '</div>'); ?>
                                                        </div>

                                                        <label class="control-label col-xs-12 col-sm-2 no-padding-right"
                                                               for="user_type">Member Type:</label>

                                                        <div class="col-xs-12 col-sm-4">
                                                            <div class="clearfix">
                                                                <select class="col-xs-12 col-sm-5" id="user_type"
                                                                        name="user_type">

                                                                    <option
                                                                        value="Advance deposite" <?php if ($user_info['user_type'] == 'Advance deposite' || $user_info['user_type'] == '' ) {
                                                                        echo "selected";
                                                                    } ?>>Advance deposite
                                                                    </option>
                                                                    <option
                                                                        value="Cheque" <?php if ($user_info['user_type'] == 'Cheque') {
                                                                        echo "selected";
                                                                    } ?>>Cheque
                                                                    </option>
                                                                    <option
                                                                        value="ECS" <?php if ($user_info['user_type'] == 'ECS') {
                                                                        echo "selected";
                                                                    } ?>>ECS
                                                                    </option>


                                                                </select>
                                                            </div>
                                                            <?php echo form_error('user_type', '<div class="help-block">', '</div>'); ?>

                                                        </div>




                                                    </div>

                                                    <div class="form-group">



                                                        <label class="control-label col-xs-12 col-sm-2 no-padding-right"
                                                               for="nominee1">Nominee1:<span
                                                                style="color:red;">*</span></label>

                                                        <div class="col-xs-12 col-sm-4">
                                                            <div class="clearfix">
                                                                <input type="text" id="nominee1" name="nominee1" placeholder="Nominee1"
                                                                       class="col-xs-12 col-sm-12" required
                                                                       value="<?php echo set_value('nominee1', html_entity_decode($user_info['nominee1'], ENT_QUOTES)); ?>"/>
                                                            </div>
                                                            <?php echo form_error('nominee1', '<div class="help-block">', '</div>'); ?>
                                                        </div>

                                                        <label class="control-label col-xs-12 col-sm-2 no-padding-right"
                                                               for="nominee1_reimbursement">Nominee1 Reimbursement:<span
                                                                style="color:red;">*</span></label>

                                                        <div class="col-xs-12 col-sm-4">
                                                            <div class="clearfix">
                                                                <input type="text" id="nominee1_reimbursement" name="nominee1_reimbursement" placeholder="Nominee1 Reimbursement"
                                                                       class="col-xs-12 col-sm-12" required
                                                                       value="<?php echo set_value('nominee1_reimbursement', html_entity_decode($user_info['nominee1_reimbursement'], ENT_QUOTES)); ?>"/>
                                                            </div>
                                                            <?php echo form_error('nominee1_reimbursement', '<div class="help-block">', '</div>'); ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">



                                                        <label class="control-label col-xs-12 col-sm-2 no-padding-right"
                                                               for="nominee2">Nominee2:<span
                                                                style="color:red;">*</span></label>

                                                        <div class="col-xs-12 col-sm-4">
                                                            <div class="clearfix">
                                                                <input type="text" id="nominee2" name="nominee2" placeholder="Nominee2"
                                                                       class="col-xs-12 col-sm-12" required
                                                                       value="<?php echo set_value('nominee2', html_entity_decode($user_info['nominee2'], ENT_QUOTES)); ?>"/>
                                                            </div>
                                                            <?php echo form_error('nominee2', '<div class="help-block">', '</div>'); ?>
                                                        </div>

                                                        <label class="control-label col-xs-12 col-sm-2 no-padding-right"
                                                               for="nominee2_reimbursement">Nominee2 Reimbursement:<span
                                                                style="color:red;">*</span></label>

                                                        <div class="col-xs-12 col-sm-4">
                                                            <div class="clearfix">
                                                                <input type="text" id="nominee2_reimbursement" name="nominee2_reimbursement" placeholder="Nominee2 Reimbursement"
                                                                       class="col-xs-12 col-sm-12" required
                                                                       value="<?php echo set_value('nominee2_reimbursement', html_entity_decode($user_info['nominee2_reimbursement'], ENT_QUOTES)); ?>"/>
                                                            </div>
                                                            <?php echo form_error('nominee2_reimbursement', '<div class="help-block">', '</div>'); ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">

                                                        <label class="control-label col-xs-12 col-sm-2 no-padding-right"
                                                               for="inactivity_date">Inactivity date:<span
                                                                style="color:red;">*</span></label>

                                                        <div class="col-xs-12 col-sm-4">
                                                            <div class="clearfix">
                                                                <input type="text" id="inactivity_date" name="inactivity_date" placeholder="Inactivity date"
                                                                       class="col-xs-12 col-sm-12" required
                                                                       value="<?php echo set_value('inactivity_date', html_entity_decode($user_info['inactivity_date'], ENT_QUOTES)); ?>"/>
                                                            </div>
                                                            <?php echo form_error('inactivity_date', '<div class="help-block">', '</div>'); ?>
                                                        </div>



                                                    </div>


                                                    <div class="space-2"></div>



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
