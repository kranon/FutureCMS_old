<?php 
/*session_start(); 
if (($_SESSION['group']=='1')|($_SESSION['group']=='2')){
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Панель администратора</title>
    <meta name="title" content="" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link rel="stylesheet" href="view/style.css" type="text/css" media="screen, projection" />
    <!--[if lte IE 6]><link rel="stylesheet" href="view/style_ie.css" type="text/css" media="screen, projection" /><![endif]-->
</head>
<body>
<div id="wrapper">
    <div id="header">
       <a href="../../index.php">Посмотреть сайт</a>
    </div><!-- #header-->
    <div id="middle">
        <div id="container">
            <div id="content">
                Панель администратора позволяет добавлять, удалять и редактировать страницы, меню и информация о пользователях.
            </div><!-- #content-->
        </div><!-- #container-->
        <div class="sidebar" id="sideLeft">
            <div id="menu">
                <a href="view/pages.php?content=pages">Страницы</a><br />
                <a href="view/pages.php?content=news">Новости</a><br />';
				if ($_SESSION['group']=='1'){
					echo '<a href="view/pages.php?content=menu">Меню</a><br />
					<a href="view/pages.php?content=users">Пользователи</a><br />
					<a href="view/pages.php?content=gallery">Галерея</a><br />
					<a href="view/pages.php?content=settings">Настройки</a><br />';
				}
            echo '</div>
        </div><!-- .sidebar#sideLeft -->
    </div><!-- #middle-->
</div><!-- #wrapper -->
<div id="footer">
</div><!-- #footer -->
</body>
</html>';
}
else{
	header('Location: ../../../index.php');
	exit;
}*/
header('Location: view/pages.php');
exit;
?>