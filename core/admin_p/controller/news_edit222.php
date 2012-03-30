<?php session_start(); 
# Редактирование новостей#
# From pages.php?content=news (template1.php)
if (($_SESSION['group']=='1')|($_SESSION['group']=='2')){
include '../../config.php';

$id=$_GET['id'];

$title= $site['lang1']['name'];

if ($_SESSION['group']=='1'){
	$menu='<a href="../view/pages.php?content=pages">Страницы</a><br />
	<a href="../view/pages.php?content=news">Новости</a><br />
    <a href="../view/pages.php?content=menu">Меню</a><br />
    <a href="../view/pages.php?content=users">Пользователи</a><br />
    <a href="../view/pages.php?content=gallery">Галерея</a><br />
	<a href="../view/pages.php?content=settings">Настройки</a><br />';
}
else{
	$menu='<a href="../view/pages.php?content=pages">Страницы</a><br />
	<a href="../view/pages.php?content=news">Новости</a><br />';
}
$sql="SELECT `caption_lang1`,`text_lang1`,`caption_lang2`,`text_lang2` FROM `news` WHERE `id` = ".$id.";";
$result = $db->query($sql);
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
	$text = array(
		'lang1'=>$row['text_lang1'],
		'lang2'=>$row['text_lang2']
	);
	
	$caption = array(
		'lang1'=>$row['caption_lang1'],
		'lang2'=>$row['caption_lang2']
	);
}

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>'.$title.' - Редактирование новостей</title>
		<meta name="title" content="" />
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<link rel="stylesheet" href="../view/style.css" type="text/css" media="screen, projection" />
		<link href="../view/tabs.css" rel="stylesheet" type="text/css">
		<!--[if lte IE 6]><link rel="stylesheet" href="../view/style_ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<script type="text/javascript" src="../../js/jquery.js"></script>
		<script type="text/javascript" src="js/ui.core.js"></script>
		<script type="text/javascript" src="js/ui.tabs.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
			  $(\'#tabSet\').tabs();
			});
		</script>
	</head>
	<body>
	<div id="wrapper">
<div id="header">
	Редактирование новостей <a href="../../../read_news.php?id='.$id.'" target="_blank">Посмотреть страницу</a>
	<div id="user"><a href="../../logout.php">Выход</a> ['.$_SESSION['login'].']</div>
</div><!-- #header-->
<div id="middle">
	<div id="container">
<div id="content">
	<ul id="tabSet">
		<li><a href="#lang1">Язык 1</a></li>
		<li><a href="#lang2">Язык 2</a></li>
	</ul>';

include '../../../fckeditor/fckeditor_php5.php'; 
echo '<form method="post" name="about" id="about" action="news_edit_data.php">
<div id="lang1">
Заголовок<br /><textarea name="caption_lang1" rows="3" cols="100">'.$caption['lang1'].'</textarea><br /><br />';

$dd = new FCKeditor("editor_lang1");
$dd->Config['SkinPath'] = '../../../fckeditor/editor/skins/office2003/';
$dd->Value = $text['lang1'];    
$dd->Create();
echo '<input type="hidden" name="id" value="'.$id.'"></div>
	<div id="lang2">
Заголовок <br /><textarea name="caption_lang2" rows="3" cols="100">'.$caption['lang2'].'</textarea><br /><br />';

$dd2 = new FCKeditor("editor_lang2");
$dd2->Config['SkinPath'] = '../../../fckeditor/editor/skins/office2003/';
$dd2->Value = $text['lang2'];
$dd2->Create();

echo '<input type="hidden" name="id" value="'.$id.'"></div>    
<input type="submit" id="addText" value="Сохранить">
</form><br />
<p>Комментарии:</p>';
$mas=$db->commentRead($id);
if (isset($mas)){
	foreach ($mas as $val){
		echo '<div class="comment">
		<div class="com_ava"><a href="O_polzovatele.php?login='.$val['users_login'].'"><img src="../../../'.$val['users_ava'].'" /></a></div>
		<div class="com_name_date">
			<a href="O_polzovatele.php?login='.$val['users_login'].'">
			<span class="com_username">'.$val['users_login'].'</span>
			</a> | 
			<span class="com_date">'.$val['datetime'].'</span>
		</div>
		<span class="com_del"><a href="news_comment_del.php?id='.$val['id'].'" class="news_comment_del"><img src="../view/del.png"></a></span>
		<span class="com_text"><textarea rows="5" cols="87">'.$val['text'].'</textarea></span>
		</div>';
	}
}
echo '</div><!-- #content-->
</div><!-- #container-->
<div class="sidebar" id="sideLeft">
<div id="menu">'.$menu.'</div><br />
<div id="pages"><p>Список новостей:<br />';

// Создания списка новостей
$sql="SELECT `id`,`caption_lang1` FROM `news`";
$result = $db->query($sql);
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
	echo '<a href="../controller/news_edit.php?id='.$row['id'].'">'.$row['id'].' - '.$row['caption_lang1'].'</a><br />';
}
echo '</p></div>
</div><!-- .sidebar#sideLeft -->
</div><!-- #middle-->
</div><!-- #wrapper -->
<div id="footer">
	© 2010-'.date('Y').' Sobko Andrey E-mail: <a href="mailto:kranon@tut.by">kranon@tut.by</a>
</div><!-- #footer -->
</body>
</html>';
}
else{
	header('Location: ../../../../index.php');
	exit;
}
?>