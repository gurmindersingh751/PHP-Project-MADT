<?php
require_once"database/db.php";
$obj = new db();
$obj->sessionDestroy();
header('Location:../index.php');
?>