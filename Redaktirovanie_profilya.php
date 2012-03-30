<?php session_start();
include "core/config.php";
if ($_SESSION['lang']=='lang2'){ $lang='lang2'; }
else { $lang='lang1'; }

$link='Redaktirovanie_profilya.php';

$title=$site[$lang]['title'];
$header=$site[$lang]['header'];
$name=$db->ReadPageName($link,$lang);
$footer=$site[$lang]['footer'];

$word=$db->WordsTranslate($lang);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=<?php echo $meta['charset'];?>" />
    <title><?php echo $title;?></title>
    <meta name="title" content="Катэхетычны каледж імя Зыгмунта Лазінскага" />
    <meta name="keywords" content="Катэхетычны каледж імя Зыгмунта Лазінскага, католик, кастёл, религия, христианство, сайт, религиозный колледж, теология, Редактирование профиля" />
    <meta name="description" content="Сайт Катэхетычнага каледжа імя Зыгмунта Лазінскага" />
    <link rel="stylesheet" href="design/style_main.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="design/droppy.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" href="design/form_err.css" type="text/css" media="screen, projection" />
    <!--[if IE]>
    <link rel="stylesheet" type="text/css" href="design/style_ie6.css" />
	<style>IMG.iePNG { filter:expression(fixPNG(this)); position: relative; }</style>
    <![endif]-->
	<script type="text/javascript" src="core/js/jquery.js"></script>
	<script type="text/javascript" src="core/js/jquery.validate.js"></script>
	<script type="text/javascript" src="core/js/jquery.droppy.js"></script>
	<script type="text/javascript">$(function(){$('#nav').droppy();});</script>
	<script type="text/javascript" src="core/js/auth_validate.js"></script>
	<script type="text/javascript" src="core/js/hs_authForm.js"></script>
</head>
<body>
    <div id="wrapper">
        <div id="header" align="left" class="head_grad">
            <div id="symbol">
                <a href="index.php"><img src="design/symbol.png" class="iePNG"></a>
            </div>
			<div id="lang">
				<a href="core/lang1.php"> BY </a>|<a href="core/lang2.php"> RU </a>
			</div>
            <br /><h1><?php echo $header;?></h1><br />
            <div id="user">
                <?php
                    if ($_SESSION['login']==NULL){
                        echo '<a href="/Avtorizatsiya.php" id="ln">'.$word[1].'</a>
                        <a href="/Registratsiya.php">'.$word[2].'</a>';
                    }
                    else{
                        echo '<a href="core/logout.php"> '.$word[4].' ['.$_SESSION['login'].']</a>';
                    }
                    if (($_SESSION['group']=='1')|($_SESSION['group']=='2')){
                        echo '<a href="core/admin_p/">'.$word[3].'</a>';
                    }
					include 'core/auth.php';
                ?>
            </div>
        </div><!-- #header-->
        <div id="middle">
            <div id="menu"class="menu_grad">
                <ul id="nav">
                    <?php $db->MenuRead($lang);?>
                </ul>
            </div>
            <div id="container">
                <div id="content">
                    <?php echo "<h3>".$name."</h3>";
                    $db->TextRead("Redaktirovanie_profilya.php",$lang);?>
					<p>
						<form action="#" method="post">
							Старый пароль:<br />
							<input type="text" name="old_pass" /><br />
							Новый пароль:<br />
							<input type="text" name="new_pass" /><br />
							Повторить пароль:<br />
							<input type="text" name="new_pass_repeat" />
							<input type="hidden" name="type" value="pass" /><br />
							<input type="submit" name="save_new_pass" value=" Изменить пароль " /><br />
						</form>
					</p>
					<p>
						<?php echo '<img src="avatars/'.$_SESSION['login'].'.jpg" />'?>
						<form action="core/editProfile.php" method="post" enctype="multipart/form-data"> 
							Изменить аватар:<br />
							<input type="file" name="avatar" />
							<input type="hidden" name="type" value="ava" /><br />
							<input type="submit" name="save_new_ava" value=" Сохранить " />
						</form>
					</p>
                </div><!-- #content-->
            </div><!-- #container-->
            <?php include 'core/sideRight.php';?>
            </div><!-- #middle-->
            </div><!-- #wrapper -->
            <div id="footer" align="center">
            <?php
                include "footer.php";
                echo $footer;
                $db->CloseDBConnection();
            ?>
        </div><!-- #footer -->
    </body>
</html>