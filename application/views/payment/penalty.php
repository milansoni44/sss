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
                                                      action="<?php echo base_url(); ?>">
                                                      <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <td style="text-align:center;"><input type="checkbox" id="all_checkbox" /></td>
                                                                <th>#</th>
                                                                <th>Member Name</th>
                                                                <th>Month</th>
                                                                <th>Year</th>
                                                                <th>Penalty</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if(!empty($penalty_members)) : 
                                                                $index = 1;
                                                                foreach($penalty_members as $member) :
                                                                    echo "<tr class='text-center'>
                                                                            <td><input type='checkbox' name='user_id[]' value=".$member['user_id']." class='member_checkbox'/></td>
                                                                            <td>{$index}</td>
                                                                            <td>{$member['name']}</td>
                                                                            <td>{$member['month_name']}</td>
                                                                            <td>{$member['penalty_year']}</td>
                                                                            <td>10</td>
                                                                        </tr>";
                                                                    
                                                                        $index++;

                                                                endforeach;
                                                            endif;
                                                            ?>
                                                        </tbody>

                                                      </table>

                                                    <div class="form-group">
                                                        <div class="col-xs-12 col-sm-12 center">
                                                            <input type="submit"
                                                                   value="Apply Penalty"
                                                                   class="btn btn-sm btn-success" id="add_user_button">
                                                        </div>
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
        var $memberCheckBox = $('.member_checkbox');
        $("#all_checkbox").on('change', function(e){
            var $this = $(this);
            if($this.is(":checked") == true) {
                $memberCheckBox.prop('checked', true);
            } else {
                $memberCheckBox.prop('checked', false);
            }
        })
    });
</script>
