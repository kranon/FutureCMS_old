<?php session_start();
# Генерирование случайного пароля и отправка по на email пользователя
if($_SESSION['group']==1){ 
	include '../../config.php';
	if (isset($_GET['login'])){
		$lgn=$_GET['login'];
		if (!((preg_match('/^[a-zA-Z0-9_]+$/', $lgn))&((strlen($lgn)>=3)&(strlen($lgn)<16)))){
			$lgn=NULL;
			echo 'Не корректный логин!';
			return;
		}
		else{
			$arr = array('a','b','c','d','e','f','g','h','i','j','k','l',
						'm','n','o','p','r','s','t','u','v','x','y','z',
						'A','B','C','D','E','F','G','H','I','J','K','L',
						'M','N','O','P','R','S','T','U','V','X','Y','Z',
						'1','2','3','4','5','6','7','8','9','0','?','@');
			$pass = "";
			for($i = 0; $i < 10; $i++){
				// Вычисляем случайный индекс массива
				$index = rand(0, count($arr) - 1);
				$pass .= $arr[$index];
			}
			$result = $db->query("SELECT `email` FROM `users` WHERE `login`='".$lgn."';");
			while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
				$email=$row['email'];
			}
			$mess="Новый пароль для входа на сайт http://gigienabar.by 
			Новый пароль: ".$pass."
			Если вы не запрашивали новый пароль, просто удалите это сообщение.";
			mail($email, "Новый пароль",$mess);
			$hash_pass=sha1(sha1($pass).$lgn);
			$db->query("UPDATE `users` SET `pass`='".$hash_pass."' WHERE `email`='".$email."';");
			echo '1';
		}
	}
	else{
		echo 'Логин не задан!';
	}
}
else{
	header('Location: ../../../index.php');
	exit;
}
?>