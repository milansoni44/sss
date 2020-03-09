<?php
$end_date = date('Y-m-d');
$start_date = date('Y-m-d',strtotime(date('Y-m-d'). ' -1 months'));
?>
<style>
    #summery_row span:not(:first-child) {
        margin-left:5px;
    }
</style>
<div class="main-container ace-save-state" id="main-container">

    <?php echo $sidebar; ?>

    <div class="main-content">
        <div class="main-content-inner">
            <?php echo $breadcrumb; ?>

            <div class="page-content">

            <div class="row">
                    <div class="col-xs-12">
                        <form class="form-horizontal well well-sm">
                            <div class="form-group" style="margin-bottom: 0px;">
                                <label 
                                    class="control-label col-xs-12 col-sm-2 col-sm-offset-4 text-muted" 
                                    style="font-weight: 600;letter-spacing: 1px;padding-top: 3px;">Filters</label>
                                <div class="col-xs-12 col-sm-3">
                                    <div class="clearfix">
                                        <select id="member" class="col-xs-12 col-sm-12">`
                                            <option value=''>All Members</option>
                                            <?php foreach($members as $member){
                                                echo "<option value='{$member['user_id']}'>{$member['name']}</option>";
                                            }?>                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <div class="clearfix">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar bigger-110"></i>
                                            </span>

                                            <input type="text" id="date_range" class="col-xs-12 col-sm-12" 
                                                value="<?php echo $start_date . ' - ' . $end_date;?>"/>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 0px;">
                                <div class="col-xs-12">
                                    <div class="clearfix" id="summery_row"></div>
                                </div>
                            </div
                        </form>                        
                    </div>
                </div>
                
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
                                        <th>Demise/Ledger Account</th>
                                        <th>Status</th>
                                        </thead>
                                        <tbody>
                                            
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

        $('#date_range').daterangepicker({
        'applyClass' : 'btn-sm btn-success',
        'cancelClass' : 'btn-sm btn-default',
        'showDropdowns': true,
        locale: {
            applyLabel: 'Apply',
            cancelLabel: 'Cancel',
            format: 'YYYY-MM-DD'
        }
    })
    .on('apply.daterangepicker', function(ev, picker) {
        // $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
        console.log(picker.startDate, picker.endDate);
    })
    .on('cancel.daterangepicker', function(ev, picker) {
        //do something, like clearing an input
        $('#date_range').val("<?php echo $start_date . ' - ' . $end_date;?>");
    })
    .prev().on(ace.click_event, function(){
        $(this).next().focus();
    });
    
    var $dynamic_table = $('#dynamic_table');
    var oTable = $dynamic_table
		.DataTable({
			"processing": true,
			"serverSide": true,
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "pageLength": 50,
			"ajax":{
                "url": "<?php echo base_url(); ?>payments/index",
                "dataType": "json",
                "type": "POST",
                "data": function(d) {
                    return $.extend({},d,{
                        "member":$("#member").val(),
                        "date_range":$("#date_range").val(),
                    });
                }
            },
            "drawCallback": function( settings ) {
                
                var $summery_row = $("#summery_row");
                var str = "";

                if(settings.jqXHR.responseJSON.badge_data) {
                    $.each(settings.jqXHR.responseJSON.badge_data,function(i,v){                        
                        str += "<span class='badge badge-success'>"+v.name+" : "+v.balance+"</span>";
                    });
                }
                $summery_row.empty().append(str);
            },
            "columns": [
                { "data": "name" },
                { "data": "mobile" },
                { "data": "user_type" },
                { "data": "address" },
                { "data": "amount" },
                { "data": "date_created" },
                { "data": "ledger_account" },
                { "data": "status" }
            ],
		});

    $("#date_range, #member").change(function(e){
        oTable.draw();
    });

    
</script>

