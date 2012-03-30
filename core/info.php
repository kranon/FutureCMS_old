<?php session_start();
# Информация о пользователе #
include 'config.php';
if ($_SESSION['lang']=='en'){ $lang='en'; }
else { $lang='ru'; }
$result = mysql_query("SELECT * FROM `page` WHERE `link`='index.php'");
while ($row = mysql_fetch_array($result, MYSQL_BOTH))
{
    if ($lang=='en')
    {
        $title = $row['title_e'];
        $header = $row['header_e'];
        $name = $row['name_e'];
        $footer = $row['footer'];
    }
    else
    {
        $title = $row['title'];
        $header = $row['header'];
        $name = $row['name'];
        $footer = $row['footer'];
    }
}
$num=1;
$result = mysql_query("SELECT * FROM `language`");
while ($row = mysql_fetch_array($result, MYSQL_BOTH))
{
    $word[$num]=$row[$lang];
    $num++;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>О пользователе</title>
    <meta name="title" content="" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link rel="stylesheet" href="../style_new.css" type="text/css" media="screen, projection" />
    <!--[if IE]>
            <link rel="stylesheet" type="text/css" href="../style_ie6.css" />
      <![endif]-->
</head>
<body>
<div id="wrapper">
    <div id="header" align="left">
        <div id="symbol">
            <a href="../index.php"><img src="../design/symbol.png"></a>
        </div>
        <div id="lang">
            <a href="rus.php"> RU </a>|<a href="eng.php"> EN </a>
        </div>
        <br /><h1>О пользователе</h1>
        <div id="user">
                <?php
                    if ($_SESSION['login']==NULL)
                    {
                        echo '<a href="/Avtorizatsiya.php">'.$word[1].'</a> <a href="/Registratsiya.php">'.$word[2].'</a>';
                    }
                    else
                    {
                        echo '<a href="logout.php"> '.$word[4].' ['.$_SESSION['login'].']</a>';
                    }
                    if ($_SESSION['group']==1)
                    {
                        echo '<a href="admin_p/">'.$word[3].'</a>';
                    }
                ?>
         </div>
    </div><!-- #header-->
    <div id="middle">
        <div id="menu">
            <ul>
                <?php $db->MenuRead('../',$lang);?>
            </ul>
        </div>
        <div id="container">
            <div id="content">
                <!--Добавление текста-->
                <?php
					$result = mysql_query("SELECT `id`, `ru`, `en` FROM `role`");
					while ($row = mysql_fetch_array($result, MYSQL_BOTH))
					{
						$rol[$row['id']]=$row['ru'];
					}
                    $result = mysql_query("SELECT * FROM `users` WHERE `login`='".$_SESSION['login']."'");
                    while ($row = mysql_fetch_array($result, MYSQL_BOTH))
                    {
                        echo '<img src="'.$row['ava'].'" alt="avatar" /> <br />
                        <strong>Имя пользователя: </strong>'.$row["login"].'<br />
                        <strong>E-mail: </strong>'.$row["email"].'<br />';
                        if ($row['sex']=='men') { $sex='Мужской'; }
                            else { $sex='Женский'; }
                        echo '<strong>Пол: </strong>'.$sex.'<br />
                        <strong>Группа: </strong>'.$rol[$row['group']].'<br />
                        <strong>Дата регистрации: </strong>'.$row["datreg"].'<br />';
                    }
                ?>
            </div><!-- #content-->
        </div><!-- #container-->
        <div id="sideLeft">
        </div><!-- .sidebar#sideLeft -->
    </div><!-- #middle-->
</div><!-- #wrapper -->
<div id="footer" align="center">
     <?php
        include '../footer.php';
        echo '<br />'.$footer;
        $db->CloseDBConnection();
    ?>
</div><!-- #footer -->
</body>
</html>