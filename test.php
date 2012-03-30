<?php session_start();
include "core/config.php";
include "core/classes/auth.class.php";
if ($_SESSION['lang']=='lang2'){ $lang='lang2'; }
else { $lang='lang1'; }

$link='Avtorizatsiya.php';

$title=$site[$lang]['name'].' - ';
$header=$site[$lang]['header'];
$name=$db->ReadPageName($link,$lang);
$footer=$site[$lang]['footer'];

$word=$db->WordsTranslate($lang);

if ($_SESSION['login']!=null){
	$form.='<br /><div id="ava" align="center">
		<a href="O_polzovatele.php?login='.$_SESSION['login'].'">
		<img src="'.$_SESSION['ava'].'" alt="avatar"/>
		</a><br />'.$_SESSION['login'].'<br />
		<a href="core/logout.php">'.$word[4].'</a><br /><br />';
	if (($_SESSION['group']=='1')|($_SESSION['group']=='2')){
		$form.='<a href="core/admin_p/">'.$word[3].'</a>';
	}
		$form.='</div>';
	}
	else{
		$form.='<span id="error_message">'.$_SESSION['auth_error'].'</span><br />';
		$form.=Auth::ShowAuthForm($word);
		unset($_SESSION['auth_error']);
	}
include 'core/html_template.php';
?>
