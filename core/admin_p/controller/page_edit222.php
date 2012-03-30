<?php
session_start();
# Редактирование содержимого страницы #
# From pages.php?content=pages (template1.php)
if (($_SESSION['group'] == '1') | ($_SESSION['group'] == '2')) {
	include '../../config.php';
	$id = $_GET['id'];
	$title=$site['lang1']['name'];
	if ($_SESSION['group'] == '1') {
		$menu = '<a href="../view/pages.php?content=pages">Страницы</a><br />
			<a href="../view/pages.php?content=news">Новости</a><br />
            <a href="../view/pages.php?content=menu">Меню</a><br />
            <a href="../view/pages.php?content=users">Пользователи</a><br />
            <a href="../view/pages.php?content=gallery">Галерея</a><br />
			<a href="../view/pages.php?content=settings">Настройки</a><br />';
	} else {
		$menu = '<a href="../view/pages.php?content=pages">Страницы</a><br />';
	}
	
	$sql="SELECT `lang1`,`lang2`,`text_lang1`,`text_lang2`,`link` FROM `page` WHERE `id` = '" . $id . "'";
	$result = $db->query($sql);
	while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
		$text = array(
			'lang1'=>$row['text_lang1'],
			'lang2'=>$row['text_lang2']
		);
		$name=array(
			'lang1'=>$row['lang1'],
			'lang2'=>$row['lang2']
		);
		
		$link = $row['link'];
		
	}

	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>'.$title.' - Редактирование страниц</title>
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
			$(document).ready(function() {
			  $(\'#tabSet\').tabs();
			});
		</script>
    </head>
    <body>
    <div id="wrapper">
        <div id="header">
            Редактирование страницы: <a href="../../../' . $link . '" target="_blank">' . $name['lang1'] . '</a>
            <div id="user"><a href="../../logout.php">Выход</a> [' . $_SESSION['login'] . ']</div>
        </div><!-- #header-->
        <div id="middle">
            <div id="container">
                <div id="content">
				<ul id="tabSet">
					<li><a href="#lang1">Язык 1</a></li>
					<li><a href="#lang2">Язык 2</a></li>
				</ul>
				<div id="lang1">';

	include '../../../fckeditor/fckeditor_php5.php';
	echo '<form method="post" name="about" id="about" action="page_data_edit.php">
    Имя страницы <br />
	<textarea name="name_lang1" rows="2" cols="89">'.$name['lang1'].'</textarea><br /><br />
	Текст страницы<br />';

	$dd = new FCKeditor("editor_lang1");
	$dd->Config['SkinPath'] = '../../../fckeditor/editor/skins/office2003/';
	$dd->Value = $text['lang1'];
	$dd->Create();

	echo '<input type="hidden" name="id" value="'.$id.'"></div>
	<div id="lang2">
	Имя страницы <br />
	<textarea name="name_lang2" rows="2" cols="89">'.$name['lang2'].'</textarea><br /><br />
	Текст страницы<br />';

	$dd_ru = new FCKeditor("editor_lang2");
	$dd_ru->Config['SkinPath'] = '../../../fckeditor/editor/skins/office2003/';
	$dd_ru->Value = $text['lang2'];
	$dd_ru->Create();
	echo '<input type="hidden" name="id" value="' . $id . '">
	</div>
	<input type="submit" id="addText" value="Сохранить">
	</form>
	</div><!-- #content-->
            </div><!-- #container-->
            <div class="sidebar" id="sideLeft">
                <div id="menu">
                    '.$menu.'
                </div><br /><div id="pages"><p>Список страниц:<br />';
	// Создания списка страниц
	$sql="SELECT `id`,`lang1` FROM `page` ORDER BY `lang1` ASC;";
	$result = $db->query($sql);
	while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
		echo '<a href="../controller/page_edit.php?id=' . $row['id'] . '">' . $row['lang1'] . '</a><br />';
	}
	echo'</p></div>
        </div><!-- .sidebar#sideLeft -->
        </div><!-- #middle-->
    </div><!-- #wrapper -->
    <div id="footer">
     © 2010-' . date('Y') . ' Sobko Andrey E-mail: <a href="mailto:kranon@tut.by">kranon@tut.by</a>
    </div><!-- #footer -->
    </body>
    </html>';
}
else {
	header('Location: ../../../index.php');
	exit;
}
?>