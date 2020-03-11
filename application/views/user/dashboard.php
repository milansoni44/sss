<div class="main-container ace-save-state" id="main-container">

    <?php echo $sidebar; ?>

    <div class="main-content">
        <div class="main-content-inner">
            <?php echo $breadcrumb; ?>

            <div class="page-content">
                <div class="row">
                    <div class="col-sm-5 infobox-container">
                        <div class="infobox infobox-green">
                            <div class="infobox-icon">
                                <i class="ace-icon fa fa-user"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number"><?php echo $total_active_members;?></span>
                                <div class="infobox-content">Active Members</div>
                            </div>
                        </div>

                        <div class="infobox infobox-blue">
                            <div class="infobox-icon">
                                <i class="ace-icon fa fa-ambulance"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number"><?php echo $total_demises;?></span>
                                <div class="infobox-content">Demices (6 months)</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 col-sm-offset-2">
                        <div class="widget-box">
                            <div class="widget-header widget-header-flat">
                                <h4 class="widget-title lighter">
                                    Ledger Balance
                                </h4>
                            </div>
                            <div class="widget-body" style="display: block;">
                                <div class="widget-main no-padding">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thin-border-bottom">
                                            <tr>
                                                <th>
                                                    Account
                                                </th>

                                                <th>
                                                    Balance
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach($badge_data as $b_data){
                                                echo "<tr>
                                                        <td>{$b_data['name']}</td>
                                                        <td>{$b_data['balance']}</td>
                                                    </tr>";
                                            }?>
                                        </tbody>
                                    </table>
                                </div><!-- /.widget-main -->
                            </div><!-- /.widget-body -->
                        </div><!-- /.widget-box -->
                    </div>
                </div>
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
</script>


<script>
    $('.user_delete_btn').click(function () {
        // escape here if the confirm is false;
        if (!confirm('All the data of this user will be deleted. Are you sure you want to Delete?')) return false;
    });
</script>

