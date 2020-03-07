<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .logo{
            width:70px;
        }
        table{
            width:100%;
        }
        .seprator{
            font-size:5px;
        }
        .mini-seprator{
            font-size:4px;
        }

        .company-name{
            font-size:19px;
        }
        .primary{
            font-size:13px;
        }
        .secondary{
            font-size: 12px;
        }
        .muted{
            color:gray;
        }
        .vt{
            vertical-align: top;
        }

        .particulars thead tr th{
            font-size:13px;
        }

        .bb{
            border-bottom: 1px solid rgb(233, 236, 239);
        }
        .particulars tbody tr td{
            font-size:12px;
        }
        .particulars thead tr th {
            font-weight: bolder;
            padding: 5px;
            border-bottom: 1px solid #ccc;
            background-color: rgb(233, 236, 239);
        }

        .amount_td{
            color:#01a9ac;
            /*font-size:13px!important;*/
            font-weight: bold;
        }

        .tc{
            text-align: center;
            padding:5px 0px;
        }
        .tr{
            text-align: right;
            padding:5px 0px;
        }

    </style>
</head>
<body>
    <table>
        <tr>
        <td style="width:12%;"><img src="<?php echo $admin_design_path; ?>assets/images/logo.png" class="logo"></td>
            <td>
                <span class="company-name">XYZ Company</span><br/>
                <span class="secondary">
                    <span>123 6th St. Melbourne, FL 32904 West Chicago, IL 60185</span><br/>
                    <span>test@test.com</span><br/>
                    <span>+91 9166650505</span><br/>
                </span>
            </td>
            <td class="vt tc muted primary">
                PAYMENT INVOICE
            </td>
        </tr>
    </table>
    <hr/>
    <table>
        <tr>
            <td class="vt" style="width:40%;">
                <div class="primary muted">MEMBER INFORMATION :</div>
                <div class="seprator">&nbsp;</div>
                <div class="secondary">
                <?php echo "{$member['name']} <div class='mini-seprator'>&nbsp;</div>";?>
                    <?php echo ($member['address']) ? "{$member['address']} <div class='mini-seprator'>&nbsp;</div>" : '';?>
                    <?php echo ($member['mobile']) ? "{$member['mobile']} <div class='mini-seprator'>&nbsp;</div>" : '';?>
                    <?php echo ($member['email']) ? "{$member['email']} <div class='mini-seprator'>&nbsp;</div>" : '';?>
                </div>
            </td>
            <td class="vt" style="width:30%;">
            </td>
            <td class="vt" style="width:30%;">
                <div class="primary muted amount_td">Total Due Amount :<?php echo $payable_amount;?></div>
            </td>
        </tr>
    </table>

    <div class="seprator">&nbsp;</div>
    <div class="seprator">&nbsp;</div>
    <div class="seprator">&nbsp;</div>

    <table class="particulars">
        <thead>
            <tr>
                <th style="width:10%;">#</th>
                <th style="width:50%;">Account</th>
                <th style="width:20%;">Date</th>
                <th style="width:20%;" class='tr'>Amount</th>
            </tr>
        </thead>
        <tbody>
        <?php if(isset($details)){            
            foreach($details as $k=>$product){
                $sr = ++$k;
                $name = ($product['ledger_name']) ? $product['ledger_name'] : $product['user_name'];
                $date = date('Y-m-d',strtotime($product['date_created']));
                echo "<tr>
                            <td class=''>{$sr}</td>                                                    
                            <td class=''>{$name}</td>            
                            <td class='bb'>{$date}</td>
                            <td class='tr bb'>{$product['amount']}</td>
                        </tr>";
            }
            
            echo "<tr><td colspan='2'>&nbsp;</td><td class='tr bb amount_td'>Total</td><td class='tr bb amount_td'>{$payable_amount}</td></tr>";
        }?>
        </tbody>
    </table>
    <div style="position: absolute;text-align: justify;left:50px;right:50px;bottom: 20px;background-color: #e2e2e2;padding: 6px;border-radius: 5px;">
        <p class="secondary muted" style="margin:0px;">Terms And Condition :</p>
        <p class="muted" style="font-size: 10px;margin:0px;padding-left:10px;">lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor</p>
    </div>
</body>
</html>