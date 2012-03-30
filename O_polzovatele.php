<?php session_start();
include 'core/config.php';
if ($_SESSION['lang']=='lang2'){ $lang='lang2'; }
else { $lang='lang1'; }

$link='O_polzovatele.php';

$title=$site[$lang]['title'];
$header=$site[$lang]['header'];
$name=$db->ReadPageName($link,$lang);
$footer=$site[$lang]['footer'];

$word=$db->WordsTranslate($lang);

if($_SESSION['login']!=NULL){
	$sql="SELECT `id`, `".$lang."` FROM `role`";
	$result = $db->query($sql);
	while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
		$rol[$row['id']]=$row[$lang];
	}
	if (isset($_GET['login'])){
		$user_login=$db->ClearData($_GET['login']);
	}
	$sql="SELECT `login`,`ava`,`sex`,`group`,`email`,`datreg` FROM `users` WHERE `login`='".$user_login."'";
	$result = $db->query($sql);
	while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
		$form.='<img src="'.$row['ava'].'" alt="avatar" /> <br />
		<b>'.$word[22].' </b>'.$row['login'].'<br />
		<b>E-mail: </b>'.$row['email'].'<br />';
		if ($row['sex']=='men'){
			$sex=$word[11];
		}
		else{
			$sex=$word[12];
		}
		$form.='<b>Пол: </b>'.$sex.'<br />
			<b>'.$word[23].' </b>'.$rol[$row['group']].'<br />
			<b>'.$word[24].' </b>'.$row['datreg'].'<br />';
		}
}
else{
	header('Location: index.php');
	exit;
}

include 'core/html_templates/other_page_html.php';
?>