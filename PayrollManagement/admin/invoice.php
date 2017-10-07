<?php
require_once"database/db.php";
$obj = new db();
if(!empty($_GET['token'])){
  $employee = $obj->getEmployeeByEmployeeId(base64_decode($_GET['token']));
}else{
 header('Location:tables.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Invoice</title>
  <?php
    require_once"assets/head.php";
  ?>
  <style type="text/css">
    table  {
      border-collapse: collapse;
    }
  </style>

</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php
    require_once"assets/header.php";
  ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Employees</a>
        </li>
        <li class="breadcrumb-item">
          <a href="tables.php"><?=ucwords($employee[0]['name'])?></a>
        </li>
        <li class="breadcrumb-item active">Invoice</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Pay Slip</div>
        <div class="card-body">
          <a class="btn btn-danger pull-right" href="javascript::" onclick="$('#employees').tableExport({type:'pdf', pdfFontSize:7, tableName:'Employees', pdfmake:{enabled:true}});">Download PDF</a>
          <div class="table-responsive">
            <?php
              $employeeMonthlyWithTax = $employee[0]['annual_basic_pay']/12;
              $employeeTax = $employee[0]['tax']/12;
            ?>
            <table class="table table-bordered" id="employees" width="100%" cellspacing="0" >
              <thead>
                <tr>
                  <th colspan="2" class="text-center"><h3>Invoice <?='10021' + $employee[0]['employee_id']?></h3></th>
                </tr>
                <tr>
                  <td colspan="2">
                      <address><b>
                        To <br>
                        <?=ucwords($employee[0]['name'])?>
                       </b> <br>
                        <b>Address -</b> <?=$employee[0]['address']?><br>
                        <b>Province -</b> <?=$employee[0]['province']?> <br>
                        <b>City -</b> <?=$employee[0]['city']?><br>
                        <b>Postal Code -</b> <?=$employee[0]['postal_code']?><br>
                      </address>
                  </td>
                </tr>
                <tr>
                  <th colspan="2">Date - <?=date('Y-M-d')?></th>

                </tr>
                <tr>
                  <th>Employee ID</th>
                  <td>EMP#<?=$employee[0]['employee_id']?></td>
                </tr>
                <tr>
                  <th>Employee Name</th>
                  <td><?=ucwords($employee[0]['name'])?></td>
                </tr> 
                <tr>
                  <th>Gender</th>
                  <td><?=ucwords($employee[0]['gender'])?></td>
                </tr> 
                <tr>
                  <th>Monthly Pay</th>
                  <td>$<?=number_format($employeeMonthlyWithTax , 2)?>
                  </td>
                </tr>
                <tr>
                  <th>Tax</th>
                  <td>- $<?=number_format($employeeTax , 2)?></td>
                </tr>
                <tr>
                  <th>Total</th>
                  <td>$<?=number_format($employeeMonthlyWithTax - $employeeTax , 2)?></td>
                </tr> 
              </thead>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <?php

      require_once"assets/footer.php";
    ?> 
    <!-- export -->
    


  </div>
</body>

</html>
