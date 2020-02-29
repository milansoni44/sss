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
                        
                        <!-- LOGIC OF THE MONTHLY PAYMENT OF MEMBERSHIP END -->
                    </div> <!-- /.col-xs-12 -->

                </div> <!-- /.row -->

            </div> <!-- /.page-content -->

        </div> <!-- /.main-content-inner -->

    </div> <!-- / .main-content -->

</div><!-- /.main-container -->