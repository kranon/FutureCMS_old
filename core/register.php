<?php session_start();
# Регистрация пользователей #
include 'config.php';
include 'classes/auth.class.php';
include 'classes/error.class.php';

$logn		= $_POST['login'];
$pass		= $_POST['pass'];
$ret_pass   = $_POST['retype_pass'];
$email		= $_POST['email'];
$sex		= $_POST['sex'];
$ava		= $_FILES;

$user=array(
	'logn'=>$logn,
	'pass'=>$pass,
	'ret_pass'=>$ret_pass,
	'email'=>$email,
	'sex'=>$sex,
	'ava'=>$ava
);

$auth = new auth();

if ($auth->validLogin($user['logn']) & $auth->validPass($user['pass'],$user['ret_pass']) & $auth->validEmail($user['email'])){
	
	if ($auth->uniqueLoginEmail($user['logn'], $user['email'])){
		$auth->register($user);
		header('Location: ../Avtorizatsiya.php');
		exit;
	}
	else{
		$_SESSION['reg_error']='Такой логин или E-mail уже используются!';
	}
}
else{
	$_SESSION['reg_error']='Введите корректные данные!';
}

header('Location: ../Registratsiya.php');
exit;
?>