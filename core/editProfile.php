<?php
# Редактирование профиля пользователя #
session_start();
include 'config.php';
$old_pass=$_POST['old_pass'];
$new_pass=$_POST['new_pass'];
$new_pass_repeat=$_POST['new_pass_repeat'];
$login=$_SESSION['login'];

$type=$_POST['type'];

switch($type){
	case 'pass':
		$sql="SELECT `pass` FROM `users` WHERE `login`='".$login."';";
		$res=$db->query($sql);
		while($row = mysql_fetch_array($res)){
			$db_pass=$row['pass'];
		}
		$old_pass=sha1(sha1($old_pass).$login);
		if ($db_pass==$old_pass){
			if ($new_pass==$new_pass_repeat){
				$db->EditPassword($login,$new_pass);
			}
		}
	break;
	case 'ava':
		if ($_FILES['avatar']['name']){
		// Загрузка аватарки
		$uploaddir = '../avatars/';
		$uploadfile = $uploaddir.$login.strrchr(basename($_FILES['avatar']['name']), '.');
		if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile)){
			//echo $error->getError(6);
			$_SESSION['reg_error']=$error->getError(6);
			header('Location: ../Redaktirovanie_profilya.php');
			exit;
		}

		$info = getimagesize($uploadfile);
		if ($info[2]==1 or $info[2]==2 or $info[2]==3){
			if ($info[0]>100 || $info[1]>100){
				// изменение размера изображения
				include 'img_biper.class.php';
				$new_img=new img_biper($uploadfile);
				if ($info[0]>$info[1]){
					$new_img->img_resized(100, 'w');
				}
				else{
					$new_img->img_resized(100, 'h');
				}
				$new_img->img_save($uploadfile);
			}
		}
		else{
			// если загружено не изображение, то удаляем файл и загрузить стандартный аватар
			unlink($uploadfile);
			$uploadfile='../avatars/default.png';
		}
	}
		$db->EditAvatar($login,$uploadfile);
	break;
}
header('Location: ../Redaktirovanie_profilya.php');
exit;
?>