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
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <form class="form-horizontal" action="<?php echo $admin_actions_page;?>" method="post">
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2" >Financial Year</label>
                                <div class="col-xs-12 col-sm-3">
                                    <div class="clearfix">
                                        <select id="fn_year" name="fn_year" class="col-xs-12 col-sm-12" required>
                                            <option value=''>Select Financial Year</option>
                                            <?php
                                                defined('START_YEAR')  OR define('START_YEAR', 2015); 
                                                defined('CURRENT_YEAR')  OR define('CURRENT_YEAR', date('Y')); 

                                                $year = START_YEAR;
                                                while($year <= CURRENT_YEAR){
                                                    $fn_year = $year . '-' . substr($year+1,-2);
                                                    echo "<option value='{$year}'>{$fn_year}</option>";
                                                    $year++;
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <label class="control-label col-xs-12 col-sm-2">Duration</label>
                                <div class="col-xs-12 col-sm-3">
                                    <div class="clearfix">
                                        <select id="duration" name="duration" class="col-xs-12 col-sm-12" required>
                                            <option value=''>Select Duration</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12" style="text-align: center;margin-top: 30px;">
                                    <div class="clearfix">
                                        <button type="submit" class="btn btn-primary btn-sm" name="action_type" value="pay_interest" style="margin-right: 30px;">Pay Interest</button>
                                        <button type="submit" class="btn btn-primary btn-sm" name="action_type" value="generate_invoice" style="margin-right: 30px;">Generate Invoice</button>
                                        <button type="submit" class="btn btn-primary btn-sm" name="action_type" value="send_invoice_email">Send Invoice Emails</button>
                                    </div>
                                </div>
                            </div>
                        </form>                        
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
<?php echo $jquery_view; ?>
<script>
    
    var current_page = "trigger_actions_list";
    
    $(document).ready(function(){

        $("#trigger_actions_list").addClass("active")
        .parent()
        .parent().addClass("active open");

        var $duration = $("#duration");

        $("#fn_year").change(function(e){
            var $this = $(this);
            var fn_year = $this.val();

            $duration.children().not(":first").remove();

            if(fn_year) {
                // Generate 1st half, 2nd half and annual date range
                // Financial Year 1 April to 31 March
                
                var fn_start = moment(fn_year + "-04-01");

                var h2_start = fn_start.clone();
                h2_start.add(6, 'months');

                var h1_end = h2_start.clone();
                h1_end.subtract(1, 'days');

                var fn_end = h2_start.clone();
                fn_end.add(6,'months').subtract(1, 'days');
                
                console.log("fn_start: ",fn_start.format('YYYY-MM-DD'));
                console.log("h1_end: ", h1_end.format('YYYY-MM-DD'));
                console.log("h2_start: ", h2_start.format('YYYY-MM-DD'));
                console.log("fn_end: ", fn_end.format('YYYY-MM-DD'));

                var str = "";
                str += "<option value='"+unix(fn_start, h1_end)+"'>"+f(fn_start,h1_end)+"</option>";
                str += "<option value='"+unix(h2_start, fn_end)+"'>"+f(h2_start,fn_end)+"</option>";
                str += "<option value='"+unix(fn_start, fn_end)+"'>"+f(fn_start,fn_end)+"</option>";

                $duration.append(str);
            }

            function f(moment1, moment2) {
                return moment1.format('MMM,YYYY') + " to " + moment2.format('MMM,YYYY');
            }
            function unix(moment1, moment2) {
                return moment1.unix() + "-" + moment2.unix();
            }
        });
    });
</script>
