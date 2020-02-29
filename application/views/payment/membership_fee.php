<div class="main-container ace-save-state" id="main-container">
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

                        <!-- LOGIC OF THE MONTHLY PAYMENT OF MEMBERSHIP START -->
                        <form method="post" action="" >
                        <div>
                            
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td style="text-align:center;"><input type="checkbox" id="all_checkbox" /></td>
                                        <th>#</th>
                                        <th>Member Name</th>
                                        <th>Month</th>
                                        <th>Membership Fee</th>
                                    </tr>
                                    <tbody>
                                        <?php if(!empty($members)) :
                                            $index = 1;
                                            foreach($members as $member) :
                                                echo "<tr style='text-align: center'>
                                                    <td><input type='checkbox' name='user_id[]' value='{$member['user_id']}' class='user_checkbox' /></td>
                                                    <td>{$index}</td>
                                                    <td>{$member['name']}</td>
                                                    <td>".date('M')."</td>
                                                    <td>{$member['membership_fee']}</td>
                                                </tr>";
                                                $index++;
                                            endforeach;
                                        endif;
                                        ?>
                                    </tbody>
                                </thead>
                            </table>

                        </div>

                        <input type="submit" />
                        </form>
                        <!-- LOGIC OF THE MONTHLY PAYMENT OF MEMBERSHIP END -->
                    </div> <!-- /.col-xs-12 -->

                </div> <!-- /.row -->

            </div> <!-- /.page-content -->

        </div> <!-- /.main-content-inner -->

    </div> <!-- / .main-content -->
    <?php echo $footer_panel; ?>

</div><!-- /.main-container -->
<?php echo $jquery_view; ?>
<script>
    $('#all_checkbox').on('change', function(){
        if($(this).is(":checked") == true) {
            
            $('.user_checkbox').prop('checked', true);
        } else {
            $('.user_checkbox').prop('checked', false);
        }
    })
</script>