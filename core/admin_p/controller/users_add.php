<?php session_start();
# Регистрация пользователей из панели администрирования#
# Регистрация пользователей #
include '../../config.php';
include '../../classes/auth.class.php';
include '../../classes/error.class.php';

$logn		= $_POST['login'];
$pass		= $_POST['pass'];
$ret_pass   = $_POST['retype_pass'];
$email		= $_POST['email'];
$sex		= $_POST['sex'];
$grup		= $_POST['group'];
$ava		= $_FILES;

$user=array(
	'logn'=>$logn,
	'pass'=>$pass,
	'ret_pass'=>$ret_pass,
	'email'=>$email,
	'sex'=>$sex,
	'group'=>$grup,
	'ava'=>$ava
);

$auth = new auth();

if ($auth->validLogin($user['logn']) & $auth->validPass($user['pass'],$user['ret_pass']) & $auth->validEmail($user['email'])){
	
	if ($auth->uniqueLoginEmail($user['logn'], $user['email'])){
		$auth->register($user);
	}
	else{
		echo 'Такой логин или E-mail уже используются!';
		exit;
	}
}
else{
	 echo 'Введите корректные данные!';
	 exit;
}
echo '1';
?>