<div class="main-container ace-save-state" id="main-container">

    <?php echo $sidebar; ?>

    <div class="main-content">
        <div class="main-content-inner">
            <?php echo $breadcrumb; ?>

            <div class="page-content">

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->


                        <div class="row">
                            <div class="col-xs-12">

                                <!--<a href="<?php /*echo $admin_add_user_link; */?>" class="btn btn-sm btn-primary">
                                    Add User</a>-->

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

                                <!--<h3 class="header smaller lighter blue">
                                    <?php /*echo $page_name; */?>
                                </h3>-->


                                <!-- div.table-responsive -->

                                <!-- div.dataTables_borderWrap -->
                                <div>

                                    <table id='dynamic_table' class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Member Type</th>
                                        <th>Address</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Account</th>
                                        <th>Status</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($transactions)) {
                                                foreach ($transactions as $transaction) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $transaction['name']; ?></td>
                                                        <td><?php echo $transaction['mobile']; ?></td>
                                                        <td><?php echo $transaction['user_type']; ?></td>
                                                        <td><?php echo $transaction['address']; ?></td>
                                                        <td><?php echo $transaction['amount']; ?></td>
                                                        <td><?php echo $transaction['date_created']; ?></td>
                                                        <td><?php echo $transaction['ledger_account']; ?></td>
                                                        <td><?php echo $transaction['status']; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
    //var current_page = "list_user_page";
</script>
<?php echo $jquery_view; ?>

<script>
    $("#payments_li").addClass("active")
        .parent()
        .parent().addClass("active open");

    var $dynamic_table = $('#dynamic_table');
    $dynamic_table.dataTable({
        "pageLength": 25
    });
</script>

