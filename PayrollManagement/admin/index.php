<?php
require_once"database/db.php";
$obj = new db();
$data = $obj->getEmployeeData();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Dashboard</title>
  <?php
  require_once"assets/head.php";
  ?>
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
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
      <!-- Icon Cards-->
     
      
     
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Employees
      	</div>
        <div class="card-body">
          <!-- <a class="btn btn-danger pull-right" href="javascript::" onclick="$('#employees').tableExport({type:'pdf', pdfFontSize:7, tableName:'Employees', pdfmake:{enabled:true}});">Export PDF</a> -->
          <div class="table-responsive">
             <table class="table table-bordered" id="employees" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Employee ID</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>DOB</th>
                  <th>Email / Website</th>
                  <th>Joining Date</th>
                  <th width="200">Address</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>

              </tfoot>
              <tbody>
                <?php
                  if(count($data) != 0){
                    foreach ($data as $key => $datalist) {
                      ?>
                      <tr>
                        <td>EMP#<?=$datalist['employee_id']?></td>
                        <td><?=ucwords($datalist['name'])?></td>
                        <td><?=ucfirst($datalist['gender'])?></td>
                        <td><?=$datalist['dob']?></td>
                        <td>
                          <b>Email - </b><?=$datalist['email']?><br>
                          <b>Website - </b><?=$datalist['website_link']?>
                        </td>
                        <td><?=$datalist['joining_date']?></td>
                        <td>
                          <b>Province -</b> <?=$datalist['province']?> <br>
                          <b>City -</b> <?=$datalist['city']?><br>
                          <b>Postal Code -</b> <?=$datalist['postal_code']?><br>
                          <b>Address -</b> <?=$datalist['address']?><br>
                        </td>
                        <td>
                          <div class="btn-group">
                              <a href="edit_employees_data.php?id=<?=base64_encode($datalist['employee_id'])?>" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                              <a href="employee_delete.php?id=<?=$datalist['employee_id']?>" class="btn btn-primary"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                          </div>
                          <hr>
                          <a href="invoice.php?token=<?=base64_encode($datalist['employee_id'])?>&employee=<?=strtolower(str_replace(' ', '_', $datalist['name']))?>" class="btn btn-success" title="View / Export">Invoice</a>
                        </td>
                       </tr>
                      <?php
                    }
                  }else{
                    ?>
                    <tr>
                      <td colspan="10">Record not found</td>
                    </tr>
                    <?php
                  }
                  ?>
                
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted"></div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <?php
    require_once"assets/footer.php";
    ?>
  </div>
</body>

</html>
