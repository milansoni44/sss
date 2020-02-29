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
            <!-- <h1> Dashboard</h1>-->

            <div class="page-content">

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->

                        <div class="widget-box" style="margin-top: 20px;">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="widget-title lighter">User Progress</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div id="fuelux-wizard-container">

                                        <div class="step-content pos-rel">
                                            <div class="step-pane active" data-step="1">

                                                <div class="box-body text-center">
                                                    User:
                                                    <select id="progress_user_select">
                                                        <!--<option value="">--- Select Year ---</option>-->
                                                        <?php
                                                        foreach( $user_list as $user )
                                                        {
                                                            ?>
                                                            <option value="<?php echo $user['user_id'];?>" <?php if($selected_user == $user['user_id'] ){ echo "selected";}?>>
                                                                <?php echo $user['name'];?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div><!-- /.box-body -->
                                                <div class="box-body text-center">
                                                    <div id="project_progress"></div>
                                                </div><!-- /.box-body -->
                                            </div>

                                        </div>
                                    </div>
                                </div><!-- /.widget-main -->
                            </div><!-- /.widget-body -->
                        </div>

                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->

                        <div class="widget-box" style="margin-top: 20px;">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="widget-title lighter">Chapter wise Result</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div id="fuelux-wizard-container">

                                        <div class="step-content pos-rel">
                                            <div class="step-pane active" data-step="1">

                                                <div class="box-body text-center">
                                                    User:
                                                    <select id="result_user_select">
                                                        <!--<option value="">--- Select Year ---</option>-->
                                                        <?php
                                                        foreach( $user_list as $user )
                                                        {
                                                            ?>
                                                            <option value="<?php echo $user['user_id'];?>" <?php if($selected_user == $user['user_id'] ){ echo "selected";}?>>
                                                                <?php echo $user['name'];?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div><!-- /.box-body -->
                                                <div class="box-body text-center">
                                                    <div id="user_result"></div>
                                                </div><!-- /.box-body -->
                                            </div>

                                        </div>
                                    </div>
                                </div><!-- /.widget-main -->
                            </div><!-- /.widget-body -->
                        </div>

                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->



                <!-- PAGE CONTENT ENDS -->



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
    var current_page = "dashboard";


</script>
<?php echo $jquery_view; ?>

<script>
    $("#dashboard_li").addClass("active");




    $('#project_progress').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'User Progress'
        },
        xAxis: {
            categories: <?php echo $course_name; ?>,
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Progress'
            },
            labels: {
                formatter: function() {
                    return this.value;
                }
            },
        },
        tooltip: {
            enabled: true,
            formatter:function(){
                return '<span style="color:'+this.series.color+'">'+this.series.name+'</span>: <b>'+this.y+'%</b>';
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal'
            }
        },
        series: <?php echo $pp; ?>
    });


    //Creditors ajax start
    $("#progress_user_select").change(function(e)
    {
        e.preventDefault();
        $.ajax(
            {
                type: "POST", cache: false,
                url: '<?php echo base_url();?>index.php/dashboard/progress_by_user',
                data: { user_id : $(this).val() },
                success : function(data)
                {

                    //alert(data);
                    // var rm_proportion = $.parseJSON(data);
                    var obj = JSON.parse(data);

                    var course_name = JSON.parse(obj.course_name);
                    var pp = JSON.parse(obj.pp);
                    console.log(course_name);
                    console.log(pp);
//                       /alert (debt_out_year1);
                    //exit;


                    // Creditors for RM PM
                    $('#project_progress').highcharts({
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: 'Project Progress'
                        },
                        xAxis: {
                            categories: course_name,
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Progress'
                            },
                            labels: {
                                formatter: function() {
                                    return this.value;
                                }
                            },
                        },
                        tooltip: {
                            enabled: true,
                            formatter:function(){
                                return '<span style="color:'+this.series.color+'">'+this.series.name+'</span>: <b>'+this.y+'%</b>';
                            }
                        },
                        legend: {
                            reversed: true
                        },
                        plotOptions: {
                            series: {
                                stacking: 'normal'
                            }
                        },
                        series: pp
                    });
                    $('.highcharts-credits').remove();
                    //alert(speed);
                    //exit;




                }
            });
    });
    //Creditors ajax end



    //store repair
    $('#user_result').highcharts({
        title: {
            text: 'Chapter wise Result'
        },
        xAxis: {
            categories: <?php echo $chapter_name; ?>
        },
        labels: {
            items: [{
                html: '',
                style: {
                    left: '50px',
                    top: '18px',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                }
            }]
        },
        series: [{
            type: 'column',
            name: 'Percentage',
            data: <?php echo $chapter_result; ?>
        }]
    });

    //Creditors ajax start
    $("#result_user_select").change(function(e)
    {
        e.preventDefault();
        $.ajax(
            {
                type: "POST", cache: false,
                url: '<?php echo base_url();?>index.php/dashboard/result_by_user',
                data: { user_id:$("#result_user_select").val() },
                success : function(data)
                {

                    //alert(data);
                    // var rm_proportion = $.parseJSON(data);
                    var obj = JSON.parse(data);

                    var chapter_result = JSON.parse(obj.chapter_result);
                    var chapter_name = JSON.parse(obj.chapter_name);
                    
//                       /alert (debt_out_year1);
                    //exit;


                    // Creditors for RM PM
                    $('#user_result').highcharts({
                        title: {
                            text: 'Chapter wise Result'
                        },
                        xAxis: {
                            categories: chapter_name
                        },
                        labels: {
                            items: [{
                                html: '',
                                style: {
                                    left: '50px',
                                    top: '18px',
                                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                                }
                            }]
                        },
                        series: [{
                            type: 'column',
                            name: 'Percentage',
                            data: chapter_result
                        }]
                    });
                    $('.highcharts-credits').remove();
                    //alert(speed);
                    //exit;




                }
            });
    });

    $('.highcharts-credits').remove();
</script>
