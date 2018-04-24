<!Doctype>
<html>
    <head>
        <style>
            table, th, td {
                border: 1px solid black;
                text-align: center;
            }
            .center {
                margin: auto;
                text-align: center;
                width: 45%;
            }
            .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
            opacity: 1;
            transition: opacity 0.6s;
            margin-bottom: 15px;
        }

        .alert.success {background-color: #4CAF50;}
        .alert.info {background-color: #2196F3;}
        .alert.warning {background-color: #ff9800;}

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
        .active {
            border: none;
            outline: none;
            padding: 10px 16px;
            background-color: #A00000;
            cursor: pointer;
            font-size: 18px;
            color: white;
            width: 20%
        }
        </style>
    </head>
    <body>
    <div class="center">
    <?php
        if (isset($GLOBALS['error'])) {
        ?>
        <div class="alert">
            <span class="closebtn">&times;</span>  
            <?php echo $GLOBALS['error']?>
        </div>
        <?php } else if (isset($GLOBALS['success'])) { ?>
        <div class="alert success">
            <span class="closebtn">&times;</span>  
            <?php echo $GLOBALS['success']?>
        </div>
        <?php } ?>
    </div>
    <p class="center">
            Fees paid upto: <?php echo (isset($GLOBALS['LastFeesPaid']) ? $GLOBALS['LastFeesPaid']->getToDate() : "NA");?>
    </p>

<?php

if (isset($GLOBALS['FeeStructureList']) && sizeof($GLOBALS['FeeStructureList']) > 0) {
?>
        <p class="center" style="font-weight: bold; color: red; font-size: 20px;">Fees Structure</p>
        <br />
        <div class="container">
        <div class="row">
    <div class="col-sm">
        <table class="table table-bordered">
            <tr>
                <th>Duration</th>
                <th>Amount</th>
            </tr>
			
<?php
    $feeStructureList = $GLOBALS['FeeStructureList'];
    $durations = array(1 => "Monthly", 3 => "Quarterly", 6 => "Half Yearly", 12 => "Yearly");
    for ($i = 0, $l = sizeof($feeStructureList); $i < $l; $i++) {
        $feeStructure = $feeStructureList[$i];
        echo '<tr>'
        . '<td>' . $durations[$feeStructure->getDuration()] . '</td>'
        . '<td>' . $feeStructure->getAmount() . '</td>';
    }
?>
        </table>
		</div>
			</div>
			</div>
        <br />
        <p class="center" style="font-weight: bold; color: red; font-size: 20px;">Fees Payment</p>
        <br />
        <form method="post" onsubmit="return validateFields()" action="<?php echo URL;?>FeesController/payFees">
            <div class="container">
        <div class="row">
    <div class="col-sm">
        <table class="table table-bordered">
                <tr>
                    <td>
                        <label>Duration</label>
                    </td>
                    <td>
                        <select name="duration" id="duration" onchange="selectDuration()">
                        <option value="">--select--</option>
<?php
    for ($i = 0, $l = sizeof($feeStructureList); $i < $l; $i++) {
        $feeStructure = $feeStructureList[$i];
        echo '<option value=' . $feeStructure->getDuration() . '>' . $durations[$feeStructure->getDuration()] . '</option>';
    }
?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Amount</label>
                    </td>
                    <td>
                        <input type="text" id="amount" name="amount" value="" readonly="true" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Valid Till</label>
                    </td>
                    <td>
                        <input type="text" id="validTill" name="validTill" value="" readonly="true" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Pay" />
                    </td>
                </tr>
            </table>
			</div>
			</div>
			</div>
            <input type="hidden" name="key" value="<?php echo MERCHANT_KEY; ?>" />
            <input type="hidden" name="firstname" value="<?php echo $_SESSION['USER_OBJ']->getName();?>" />
            <input type="hidden" name="email" value="<?php echo $_SESSION['USER_OBJ']->getEmail();?>" />
            <input type="hidden" name="phone" value="<?php echo $_SESSION['USER_OBJ']->getPhone();?>" />
            <input type="hidden" name="productinfo" id="productinfo" value="" />
            <input type="hidden" name="surl" value="<?php echo URL;?>FeesController/success" />
            <input type="hidden" name="furl" value="<?php echo URL;?>FeesController/failure" />
            <input type="hidden" name="service_provider" value="payu_paisa" />
        </form>

        <script>

            var durations = [];
            var amounts = [];

<?php
    for ($i = 0, $l = sizeof($feeStructureList); $i < $l; $i++) {
        $feeStructure = $feeStructureList[$i];
?>
            durations.push('<?php echo $feeStructure->getDuration(); ?>');
            amounts.push('<?php echo $feeStructure->getAmount(); ?>');
<?php    }
?>            

            var currDate = new Date('<?php echo (isset($GLOBALS['LastFeesPaid']) ? $GLOBALS['LastFeesPaid']->getToDate() : date('Y/m/d'));?>');
            currDate = (currDate.getTime() < (new Date()).getTime() ? new Date() : currDate);

            function selectDuration() {
                var sel = document.getElementById('duration').value;
                if (sel != "") {
                    document.getElementById('amount').value = amounts[durations.indexOf(sel)];
                    var tDate = new Date(currDate.getTime());
                    document.getElementById('validTill').value = new Date(tDate.setMonth(currDate.getMonth() + Number(sel))).toDateString();
                    document.getElementById('productinfo').value = sel + ',' + currDate.toDateString() + ',' + tDate.toDateString();
                }
            }

            function validateFields() {
                if (document.getElementById('duration').value == "") return false;
                return true;
            }

            var close = document.getElementsByClassName("closebtn");
            var i;

            for (i = 0; i < close.length; i++) {
                close[i].onclick = function(){
                    var div = this.parentElement;
                    div.style.opacity = "0";
                    setTimeout(function(){ div.style.visible = "none"; }, 600);
                }
            }
            
        </script>

<?php
} else {
    echo 'No fee structure found';
}
?>
    </body>
</html>