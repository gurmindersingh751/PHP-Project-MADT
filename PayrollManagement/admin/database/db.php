<?php
class db{
	private $db;
	function __construct(){
		session_start();
		$this->db = new PDO('mysql:host=localhost;dbname=canada','root','');
	}
	function dashboardLogin($username,$password){
		$Query = $this->db->prepare('select * from admin where username = ? && password = ?');
		$Query->execute(array($username,md5($password)));
		if($Query->rowCount() == 1){
			return true;
		}else{
			return false;
		}
	}
	function sessionDestroy(){
		$_SESSION['username'] == '';
		session_destroy();
	}
	function checkUserSession(){
		if($_SESSION['username'] == ''){
			header('Location:../index.php');
		}
	}
	function getCurrentUser(){
		$Query = $this->db->prepare('select username, email,date,status from admin where username = ?');
		$Query->execute(array($_SESSION['username']));
		return $Query->fetchAll(PDO::FETCH_ASSOC);
	}
	function insertEmployeeInfo_entry($data, $annual_pay, $tax_calculate, $monthly_pay){
		$Query = $this->db->prepare('insert into employees (name,gender,province,dob,address,city,postal_code,email,website_link,	joining_date,annual_basic_pay,tax,monthly_salery,status)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
		$Query->execute(array(
								$data['name'],
								$data['gender'],
								$data['province'],
								$data['dob'],
								$data['address'],
								$data['city'],
								$data['postal_code'],
								$data['email'],
								$data['website'],
								$data['joining-date'],
								$annual_pay,
								$tax_calculate,
								$monthly_pay,
								1
							));
		if($Query){
			return true;
		}else{
			return false;
		}
	}
	function getEmployeeData(){
		$Query = $this->db->prepare('select * from employees ORDER BY employee_id DESC');
		$Query->execute();
		return $result = $Query->fetchAll(PDO::FETCH_ASSOC);
	}
	function deleteEmployee_entry($id){
		$Query = $this->db->prepare('delete from employees where employee_id = ?');
		$Query->execute(array($id));
		if($Query){
			return true;
		}else{
			return false;
		}
	}
	function getEmplyeeDataFromEmplyeeId($id){
		$Query = $this->db->prepare('select * from employees where employee_id = ?');
		$Query->execute(array($id));
		return $Query->fetchAll(PDO::FETCH_ASSOC);
	}
	function updateEmployeeData($data, $annual_pay, $tax_calculate, $monthly_pay){
		$Query = $this->db->prepare('update employees set name = ?, gender =? ,province =? ,dob =? ,address =? ,city =? ,postal_code =? ,email =? ,website_link =? ,	joining_date = ?,annual_basic_pay = ?,tax =? ,monthly_salery =? ,status = ? where employee_id = ?');
		$Query->execute(array(
								$data['name'],
								$data['gender'],
								$data['province'],
								$data['dob'],
								$data['address'],
								$data['city'],
								$data['postal_code'],
								$data['email'],
								$data['website'],
								$data['joining-date'],
								$annual_pay,
								$tax_calculate,
								$monthly_pay,
								1,
								base64_decode($_POST['editid'])
							));
		if($Query){
			return true;
		}else{
			return false;
		}
	}
	function getEmployeeByEmployeeId($id){
		$Query = $this->db->prepare('select * from employees where employee_id = ?');
		$Query->execute(array($id));
		return $Query->fetchAll(PDO::FETCH_ASSOC);

	}
}
?>