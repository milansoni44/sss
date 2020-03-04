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
                                        <th>Nominee1</th>
                                        <th>Nominee2</th>
                                        <th>Inactivity Date</th>
                                        <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($user_info)) {
                                                foreach ($user_info as $user) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $user['name']; ?></td>
                                                        <td><?php echo $user['mobile']; ?></td>
                                                        <td><?php echo $user['user_type']; ?></td>
                                                        <td><?php echo $user['address']; ?></td>
                                                        <td><?php echo $user['nominee1']; ?></td>
                                                        <td><?php echo $user['nominee2']; ?></td>
                                                        <td><?php echo $user['inactivity_date']; ?></td>
                                                        <td>
                                                            <a class="btn btn-primary btn-xs  no-padding-top no-padding-bottom" href="<?php echo $admin_add_user_link . '/' . $user['user_id']; ?>">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a href="" class="btn btn-primary btn-xs  no-padding-top no-padding-bottom">
                                                                Change Nominee
                                                            </a>
                                                            &nbsp;
                                                        <!--<a title="Delete"
                                                               class="btn btn-primary sts-btn btn-xs no-padding-top no-padding-bottom user_delete_btn"
                                                               href="<?php /*echo base_url()*/?>user/delete_user/<?php /*echo $user['user_id']; */?>">
                                                                <i class="fa fa-trash"></i>
                                                            </a>-->
                                                        </td>
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
    var current_page = "list_user_page";
</script>
<?php echo $jquery_view; ?>

<script>
    $("#list_user_li").addClass("active")
        .parent()
        .parent().addClass("active open");

    var $dynamic_table = $('#dynamic_table');
    $dynamic_table.dataTable({
        "pageLength": 25
    });
</script>


<script>
    $('.user_delete_btn').click(function () {
        // escape here if the confirm is false;
        if (!confirm('All the data of this user will be deleted. Are you sure you want to Delete?')) return false;

    });
</script>

