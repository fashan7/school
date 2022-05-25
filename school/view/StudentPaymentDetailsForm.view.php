<?php
$mat = new materialController;
$students = $_POST['students'];
$grade = '';
$studentResult = $mat->SelectStudentbyid($students);
if (isset($_POST['grade'])) {
    $grade = $_POST['grade'];
} else {
    $grade = $studentResult['grade'];
}
//$result = $mat->feeAllocationList($grade);
$result = $mat->StudentFeePay($students);
?>

<div class="col-lg-12">
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="loadpaidDetails" width="100%">
            <thead>
                <tr>
                    <th scope="col">Individual Receipt No</th>
                    <th scope="col">Fee Sub Category</th>
                    <th scope="col">Fee Type</th>
                    <th scope="col">Actual Amount</th>     
                    <th scope="col">Amount due to paid</th>     
                    <th scope="col">Fine</th>     
                    <th scope="col">Discount</th> 
                    <th scope="col">Total</th> 
                    <th scope="col">Select</th>     
                </tr>
            </thead>
            <tbody>
<?php
$i = 1;
$y = 1;
foreach ($result as $row) {
    $feeSubCatResult = $mat->getSubcategoryFee($row['subcategory']);
    $rowFeemainCategory = $mat->SelectFeeCategory($feeSubCatResult['fee_category']);
    $prefix = $rowFeemainCategory['prefix'];
    $rowmaxreciptId = $mat->getMaxInvoiceofFeepay($row['subcategory']);
    if ($rowmaxreciptId == '0') {
        $reciptId = $prefix . '0001';
    } else {
        $incrementorder = intval($rowmaxreciptId) + 1;
        $reciptId = $prefix . str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
    }
    ?>
                    <tr>
                        <td><?= $reciptId ?></td>
                        <td><?= $feeSubCatResult['sub_category_name'] ?></td>
                        <td>
                            <select name="installment<?= $i ?>" id="installment<?= $i ?>" class="form-control select2" style="width: 100%;" onchange="gettotal()">
                                <option value="">Installment List</option>
    <?php
    $resultFee = $mat->feeStype($row['subcategory']);
    foreach ($resultFee as $rowFee) {
        $resultcheck = $mat->StudentCheckFees($students, $row['subcategory'], $rowFee['id']);
        if ($resultcheck['feetype_id'] == $rowFee['id']) {
            
        } else {
            ?>
                                        <option value="<?= $rowFee['id'] ?>"><?= $feeSubCatResult['feetype'] . " (" . $rowFee['start_date'] . " / " . $rowFee['end_date'] . ")" ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                        <td><?= $row['actual_amount'] ?></td>
                        <td>
                                <?php
                                $payamount = 0;
                                $res = $mat->StudentFeePayP1($students, $row['subcategory']);
                                foreach ($res as $re) {
                                    $payamount += $re['balance_amount'];
                                    ?>
                                <input type="hidden" name="feepayid<?= $y ?>" name="feepayid<?= $y ?>"  value="<?= $re['id'] ?>">
                                <?php
                                $y++;
                            }
                            ?>
                            <input type="hidden" name="countInsidefeestype<?= $i ?>" name="countInsidefeestype<?= $i ?>" value="<?= $y ?>">
                            <input type="hidden" class="form-control" id="subcatid<?= $i ?>" name="subcatid<?= $i ?>"  autocomplete="off" value="<?= $row['subcategory'] ?>">
                            <input type="hidden" class="form-control" id="amount<?= $i ?>" name="amount<?= $i ?>"  autocomplete="off" value="<?= $row['actual_amount'] ?>">
                            <input type="text" class="form-control" id="payamount<?= $i ?>" name="payamount<?= $i ?>"  autocomplete="off" value="<?= $payamount ?>" onkeypress="return numOnly(event);" onchange="calculation()">
                        </td>
                        <td>                        
                            <input type="text" class="form-control" id="fine<?= $i ?>" name="fine<?= $i ?>"  autocomplete="off" value="0" onkeypress="return numOnly(event);" onchange="calculation()">                            
                        </td>
                        <td>                        
                            <input type="text" class="form-control" id="discount<?= $i ?>" name="discount<?= $i ?>"  autocomplete="off" value="0" onkeypress="return numOnly(event);" onchange="calculation()">                            
                        </td>
                        <td>                        
                            <input type="text" class="form-control" id="totalcal<?= $i ?>" name="totalcal<?= $i ?>"  autocomplete="off" value="<?= $payamount ?>" readonly onkeypress="return numOnly(event);">                            
                        </td>
                        <td>                        
                            <input type="checkbox" id="checkboxSelect<?= $i ?>" name="checkboxSelect<?= $i ?>" value="yes" onchange="gettotal()">         
                        </td>
                    </tr>
    <?php $i++;
}
?>
            </tbody>            
        </table>
        <input type="hidden" name="countList" id="countList" value="<?= $i ?>">
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
    function numOnly(e)
    {
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 47 && k < 58 || k == 46));
    }
    function calculation()
    {
        var countList = $('#countList').val();
        for (var i = 1; i < countList; i++)
        {
            var amount = parseFloat($('#amount' + i).val());

            if ($('#payamount' + i).val() == '')
            {
                parseFloat($('#payamount' + i).val(amount));
            }

            if ($('#fine' + i).val() == '')
            {
                parseFloat($('#fine' + i).val(0));
            }

            if ($('#discount' + i).val() == '')
            {
                parseFloat($('#discount' + i).val(0));
            }
            var payamount = parseFloat($('#payamount' + i).val());
            var fine = parseFloat($('#fine' + i).val());
            var discount = parseFloat($('#discount' + i).val());
            var total = payamount + fine - discount;
            $('#totalcal' + i).val(total);
            gettotal();
        }
    }

</script>