<?php
require_once"database/db.php";
$obj = new db();
if(isset($_POST['submit'])){
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $gender = $_POST['gender'];
  $bob = $_POST['dob'];
  $annual_pay = $_POST['annual_pay'];
  if(!empty($name) && !empty($email) && !empty($gender) && !empty($bob) && !empty($annual_pay)){
  	if($annual_pay < 45916){
  		$tax = 15;
  	}else if($annual_pay > 45916 && $annual_pay < 91831 ){
  		$tax = 20.5;
  	}else if($annual_pay > 91831 && $annual_pay < 142353){
  		$tax = 26;
  	}else if($annual_pay > 142353 && $annual_pay < 202800){
  		$tax = 29;
  	}else if($annual_pay > 202800){
  		$tax = 33;
  	}
  	$tax_calculate = ($annual_pay * $tax) / 100;
    $monthly_pay = ($annual_pay - $tax_calculate) / 12;
    $result = $obj->insertEmployeeInfo_entry($_POST,$annual_pay, $tax_calculate, $monthly_pay);
    if($result == true){
      $_SESSION['message'] = 'One record added successfully';
    }else{
      $_SESSION['message'] = 'Request faile, please try again';
    }
  }else{
  	$_SESSION['message'] = "Please fill all required field";
  }
header('Location:emp_form.php');
}
//update
if(isset($_POST['update'])){
 $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $gender = $_POST['gender'];
  $bob = $_POST['dob'];
  $annual_pay = $_POST['annual_pay'];
  if(!empty($name) && !empty($email) && !empty($gender) && !empty($bob) && !empty($annual_pay)){
    if($annual_pay < 45916){
      $tax = 15;
    }else if($annual_pay > 45916 && $annual_pay < 91831 ){
      $tax = 20.5;
    }else if($annual_pay > 91831 && $annual_pay < 142353){
      $tax = 26;
    }else if($annual_pay > 142353 && $annual_pay < 202800){
      $tax = 29;
    }else if($annual_pay > 202800){
      $tax = 33;
    }
    $tax_calculate = ($annual_pay * $tax) / 100;
    $monthly_pay = ($annual_pay - $tax_calculate) / 12;
    $result = $obj->updateEmployeeData($_POST,$annual_pay, $tax_calculate, $monthly_pay);
    if($result == true){
      $_SESSION['message'] = 'Updated successfully';
    }else{
      $_SESSION['message'] = 'Request faile, please try again';
    }
  }else{
    $_SESSION['message'] = "Please fill all required field";
  }
header('Location:edit_employees_data.php?id='.$_POST['editid']);
}
//update
?>