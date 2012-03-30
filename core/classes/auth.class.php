<?php
# класс авторизации, регистрации пользователей
class Auth {
public $a='var a =  class Auth';
	public function getAFromDataBase(){
		DataBase::getA();
	}
	protected function hex($str,$salt=null){
		$hex_pass= sha1(sha1($str).$salt);
		return $hex_pass;
	}
	public function validLogin($logn){
		$logn=DataBase::clearData($logn);
		if (isset($logn)){
			if (!((preg_match('~^[a-z0-9_\-]*$~i', $logn))&((strlen($logn)>=3)&(strlen($logn)<16)))){
				$logn = null;
				return false;
			}
			else{
				return true;
			}
		}
		else{
			return false;
		}
	}
	// Проверка валидности и повторности пароля 
	public function validPass($pass,$ret_pass){
		$pass=DataBase::clearData($pass);
		$ret_pass=DataBase::clearData($ret_pass);
		
		if (isset($pass) & (strlen($pass)>5)&(strlen($pass)<12)){
			if ($pass==$ret_pass){
				return true;
			}
			else{
				$pass=null;
				$ret_pass=null;
				return false;
			}
		}
		else{
			$pass=null;
			$ret_pass=null;
			return false;
		}
	}
	public function validEmail($email){
		$email=DataBase::clearData($email);
		
		$valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);  
		if ($valid_email == false){
			//echo $error->getError(5);
			$email=null;
			return false;
		}
		else{
			return true;
		}
	}
	// Проверка повторности логина и email
	public function uniqueLoginEmail($logn,$email){
		$sql="SELECT `login`, `email` FROM `users` WHERE `login`='".$logn."' OR email='".$email."'";
		$result = mysql_query($sql);//DataBase::query($sql);
		if (mysql_num_rows($result)>0){
			return false;
		}
		else{
			return true;
		}
	}
	
	public function register($user){
		$logn	= $user['logn'];
		$pass	= $user['pass'];
		$email	= $user['email'];
		$sex	= $user['sex'];
		$group	= $user['group'];
		$ava	= $user['ava'];
		
		$hex_pass= $this->hex($pass,$logn);
		
		// Если аватар выбран
		if ($ava['userfile']['name']){
			// Загрузка аватарки
			$uploaddir = '../avatars/';
			$uploadfile = $uploaddir.$f_name.strrchr(basename($ava['userfile']['name']), '.');
			if (!move_uploaded_file($ava['userfile']['tmp_name'], $uploadfile)){
				//echo 'файл не загружен';
				$uploadfile='../avatars/default.png';
			}
			else{
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
		}
		// Если аватар не выбран, то загрузить стандартный
		else{
			$uploadfile='../avatars/default.png';
		}
		if (!isset($group)|($group=='')){
			$group=3;
		}
		DataBase::userAdd($logn,$hex_pass,$email,$uploadfile,$sex,$group);
		//$db->userAdd($logn,$hex_pass,$email,$uploadfile,$sex,$grup);
	}
	public function authorisation($logn, $pass){
		$logn=DataBase::clearData($logn);
		$pass=DataBase::clearData($pass);
		
		if (isset($logn) & isset($pass)){
			$pass=sha1(sha1($pass).$logn);
				
			$sql="SELECT `login`,`pass` FROM `users` WHERE `login`='".$logn."' AND `pass`='".$pass."'";
			$result = DataBase::query($sql);
			if(mysql_num_rows($result)==0){
				return false;
			}
			else{
				return true;
			}
		}
	}
	public static function ShowAuthForm($word){
		$form='<div id="autorise">
		<form action="core/autorise.php" method="post" name="autoris" id="autori">
		'.$word[6].'<br />
		<input type="text" name="login" id="login"><br />
		'.$word[7].'<br />
		<input type="password" name="pass" id="pass"><br /><br />
		<input type="submit" id="aut_sub" value=" '.$word[1].' ">
		</form></div><br />';
		return $form;
	}
	public static function ShowRegForm($word,$action){
		$form='<br /><div id="register">
			<div class="container">
				<form class="well form-inline" enctype="multipart/form-data" action="'.$action.'" method="post" name="reg_form" id="reg_form">
				'.$word[6].'<br />
				<input type="text" name="login" id="login"><br />
				'.$word[7].'<br />
				<input type="password" name="pass" id="pass"><br />
				'.$word[25].'<br />
				<input type="password" name="retype_pass" id="retype_pass"><br />
				'.$word[8].'<br />
				<input type="text" name="email" id="email"><br />
				'.$word[9].'<br />
				<input type="file" name="userfile" id="userfile"/><br />
				'.$word[10].'<br />
				<input type="radio" name="sex" checked="checked" value="men"/> '.$word[11].'<br />
				<input type="radio" name="sex" value="women"/> '.$word[12].'<br />
				<input type="hidden" name="group" value="3" /><br /> 
				<input type="submit" class="btn-success" id="AddUser" value=" '.$word[2].' "/><br />
				</form></div></div>';
		return $form;
	}
}
?>
