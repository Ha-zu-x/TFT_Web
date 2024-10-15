<?php
session_start();

if(isset($_POST['username'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$username = stripslashes($username);
	$password = stripslashes($password);
	
	include '../admin/classDatatbase/classData-02.php';
	$arr = $data->getTable('users'," username='". $username . "' AND password='". $password . "'");
	if($username) {
		$IsInvalidUser = empty($arr);
	}
	if(!empty($arr)) {
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		// $IsvalidUser = 1;
		header('location:/admin/');
		
		exit();
	}
} 

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<meta name="robots" content="noindex"/>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">  
</head>
<body>
<div class="login-container">
  <div class="login">	
    <img src="https://tifatech.vn/user-upload/imgs/TFT_logo_NoBg.png" alt="">
    <span class='header'>ADMIN PANEL</span>
	<form action="" method="post" name="login">
		<div class="user-input">
			<i class="fa-solid fa-user user-icon"></i>
			<input type="text" name="username" placeholder="Username" required />
		</div>
		<div class="user-input">
			<i class="fa-solid fa-lock user-icon"></i>
			<input type="password" name="password" placeholder="Password" required />
		</div>
		<?php if ($IsInvalidUser) echo "<span class='user-alert'>Incorrect password. Try again</span>" ;?>
		<input type="submit" value="Login" />
   </form>
  </div>
</div>
</body>
</html>
