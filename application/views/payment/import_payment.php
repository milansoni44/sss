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
                                                                <input type="file" name="csv_file" class="form-control col-xs-12 col-sm-12" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-4">
                                                            <div class="clearfix">
                                                                <input type="submit" name="Import" class="btn btn-sm btn-success" value="Import" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php
                                                        $success = $this->session->flashdata("success");
                                                        $success = ($success) ? $success : [];
                                                        $failure = $this->session->flashdata("failure");
                                                        $failure = ($failure) ? $failure : [];

                                                        if($success || $failure):?>
                                                        <div class="form-group">
                                                            <label class="control-label col-xs-12 col-sm-2 no-padding-right"
                                                                    for="name">Import Status:</label>

                                                            <label class="control-label col-xs-12 col-sm-10" style="text-align:left;">
                                                                <ol>
                                                                    <?php 
                                                                        foreach($success as $suc){
                                                                            echo "<li class='text-success'>{$suc}</li>";
                                                                        }
                                                                        foreach($failure as $fail){
                                                                            echo "<li class='text-danger'>{$fail}</li>";
                                                                        }
                                                                    ?>                                                                    
                                                                </ol>
                                                            </label>                                                        
                                                        </div>
                                                    <?php endif;?>
                                                                                                        
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