<?php if($this->session->userdata("login_admin_id") == 1){
    ?>
    <style>
        .li_visibility{
            display: block !important;
        }
        .li_visibility_user{
            display: none !important;
        }

    </style>
    <?php
}else{
    ?>
    <style>
        .li_visibility{
            display: none !important;;
        }
        .li_visibility_user{
            display: block !important;;
        }
    </style>
    <?php
}?>
<div id="sidebar" class="sidebar responsive ace-save-state">
    <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar')
        } catch (e) {
        }
    </script>

    <div class="sidebar-shortcuts li_visibility" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large " id="sidebar-shortcuts-large">
            <a href="<?php echo $admin_dashboard_link; ?>" title="Dashboard" class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </a>
            <a href="<?php echo $admin_dashboard_link; ?>" title="Dashboard" class="btn btn-warning">
                <i class="ace-icon fa fa-user-plus"></i>
            </a>
            <a href="<?php echo $admin_dashboard_link; ?>" title="Dashboard" class="btn btn-info">
                <i class="ace-icon fa fa-book"></i>
            </a>
            <a href="" title="Dashboard" class="btn btn-danger">
                <i class="ace-icon fa fa-list"></i>
            </a>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->


    <ul class="nav nav-list">
        <li class="" id="dashboard_li">
            <a href="<?php echo $admin_dashboard_link; ?>">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
        </li>


        <li class="li_visibility">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-user-plus"></i>
                <span class="menu-text"> Member MGMT </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li id="add_user_li">
                    <a href="<?php echo $admin_add_user_link; ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Add Member
                    </a>
                    <b class="arrow"></b>
                </li>
                <li id="list_user_li">
                    <a href="<?php echo $admin_user_list_link; ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Member List
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="li_visibility">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-user-plus"></i>
                <span class="menu-text">Payments</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li id="add_payments_li">
                    <a href="<?php echo $admin_add_membership_fee_link; ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Add Payment
                    </a>
                    <b class="arrow"></b>
                </li>
                <li id="payments_li">
                    <a href="<?php echo $admin_transaction_link; ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Transactions
                    </a>
                    <b class="arrow"></b>
                </li>
                <li id="individual_payments_li">
                    <a href="<?php echo $admin_post_payment_individually; ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Recieve Payment
                    </a>
                    <b class="arrow"></b>
                </li>
                <li id="import_payments_li">
                    <a href="<?php echo $admin_import_payment; ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Import Payment
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>


    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>