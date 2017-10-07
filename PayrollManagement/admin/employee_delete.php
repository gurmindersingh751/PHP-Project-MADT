<?php
require_once"database/db.php";
$obj = new db();
if($_GET['id'] != ''){
	$obj->deleteEmployee_entry($_GET['id']);
}
header('Location:tables.php');
?>