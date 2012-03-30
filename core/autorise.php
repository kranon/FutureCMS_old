<?php session_start();
# Авторизация пользователей #
include 'config.php';
include 'classes/error.class.php';
include 'classes/auth.class.php';

$error = new error();
$auth = new Auth();

$logn=$_POST['login'];
$pass=$_POST['pass'];

if ($auth->authorisation($logn, $pass)==true){
	$_SESSION['login']=$logn;
	$sql="SELECT `ava`, `group` FROM `users` WHERE `login`='".$logn."'";
	$res=$db->query($sql);
	while ($row = mysql_fetch_array($res, MYSQL_BOTH)){
		$_SESSION['ava']=$row['ava'];
		$_SESSION['group']=$row['group'];
	}
}
else{
	$_SESSION['auth_error']=$error->getError(7);
}   

$db->CloseDBConnection();
header('Location: ../Avtorizatsiya.php');
exit;
?>