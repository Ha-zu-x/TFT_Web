<?php
session_start();
//echo '<pre>'; print_r($_SESSION); echo '</pre>';
if(!isset($_SESSION['username'])){
	header('location:/registeration/login.php');
	exit();
}

$username = $_SESSION['username'];
$password = $_SESSION['password'];
$username = str_replace("'",'', $username);$password = str_replace("'",'', $password);

include_once '../admin/classDatatbase/classData-02.php';
$arr = $data->getTable('users'," username='". $username . "' AND password='". $password . "'");

if(empty($arr)) {
	header('location:/registeration/login.php');
	exit();
}
?>