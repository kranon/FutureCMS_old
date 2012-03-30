<?php session_start();
include 'core/config.php';
if ($_SESSION['lang']=='lang2'){ $lang='lang2'; }
else { $lang='lang1'; }

$link='index.php';

$title=$site[$lang]['name'];
$header=$site[$lang]['header'];
if ($lang=='lang1') $name='Навiны';
else $name='Новости';
$footer=$site[$lang]['footer'];

$word=$db->WordsTranslate($lang);

$news_id=$_GET['id'];
// Если id - число и больше нуля
if ((settype($news_id,int))|($news_id>=0)){
	if ($news_id==0){
	}
	else{
		$result = $db->query("SELECT `id` FROM `news` WHERE `id`='".$news_id."';");
		if (mysql_num_rows($result)==0){
			$error = 'Новости с таким ID не существует!';
		}
		else{
			$error='';
			// Чтение данных новостей
			$sql="SELECT `caption_".$lang."`, `text_".$lang."` FROM `news` WHERE `id`=".$news_id;
			$result = $db->query($sql);
			while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
				$name=$row['caption_'.$lang];
			}
			$title .=' - '.$name;
		}
	}
}
else{
	header('Location: index.php');
	exit;
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=<?php echo $meta['charset'];?>" />
    <title><?php echo $title;?></title>
    <meta name="title" content="Катэхетычны каледж імя Зыгмунта Лазінскага" />
    <meta name="keywords" content="Катэхетычны каледж імя Зыгмунта Лазінскага, католик, кастёл, религия, христианство, сайт, религиозный колледж, теология" />
    <meta name="description" content="Сайт Катэхетычнага каледжа імя Зыгмунта Лазінскага" />
    <link rel="stylesheet" href="design/style_main.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="design/droppy.css" type="text/css" media="screen, projection" />
    <!--[if IE]>
    <link rel="stylesheet" type="text/css" href="design/style_ie6.css" />
	<style>IMG.iePNG { filter:expression(fixPNG(this)); position: relative; }</style>
    <![endif]-->
	<script type="text/javascript" src="core/js/jquery.js"></script>
	<script type="text/javascript" src="core/js/jquery.validate.js"></script>
	<script type="text/javascript" src="core/js/jquery.droppy.js"></script>
	<script type='text/javascript'>$(function(){$('#nav').droppy();});</script>
	<script type="text/javascript" src="core/js/auth_validate.js"></script>
	<script type='text/javascript' src="core/js/hs_authForm.js"></script>
</head>
<body>
    <div id="wrapper">
        <div id="header" align="left" class="head_grad">
            <div id="symbol">
                <a href="index.php"><img src="design/symbol.png" class="iePNG"/></a>
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
            <div id="menu" class="menu_grad">
                <ul id="nav">
                    <?php $db->MenuRead($lang);?>  
                </ul>
            </div>
            <div id="container">
                <div id="content">
                    <?php echo '<h3>'.$name.'</h3>';
                    if ($news_id==0){
						$db->ReadNews('all',$lang);
					}
					else{
						$db->ReadNewsText($news_id,$lang);
						echo $error;
						$mas=$db->commentRead($news_id);
						if (isset($mas)){
							echo '<p id="comm_title">Комментарии:</p>';
							foreach ($mas as $val){
								echo '<div class="comment">
								<div class="com_ava"><a href="O_polzovatele.php?login='.$val['users_login'].'"><img src="'.$val['users_ava'].'" /></a></div>
								<div class="com_name_date">
										<a href="O_polzovatele.php?login='.$val['users_login'].'">
											<span class="com_username">'.$val['users_login'].'</span>
										</a> | 
										<span class="com_date">'.$val['datetime'].'</span>
								</div>
								<span class="com_text">'.$val['text'].'</span>
								</div>';
							}
						}
						if ($_SESSION['login']==NULL){
							echo $word[20].' <a href="Avtorizatsiya.php">'.$word[1].'</a> '.$word[21].' <a href="Registratsiya.php">'.$word[2].'</a>';
						}
						else{
							$sql="SELECT `id` FROM `users` WHERE `login`='".$_SESSION['login']."';";
							$res=$db->query($sql);
							while ($row = mysql_fetch_array($res, MYSQL_BOTH)){
								$curr_user_id=$row['id'];
							}
							echo '<div>
							'.$word[19].'<br />
								<form method="post" action="core/commentAdd.php">
								<textarea rows="6" cols="100" name="comment_text" ></textarea><br />
								<input type="hidden" name="curr_user_id" value="'.$curr_user_id.'">
								<input type="hidden" name="news_id" value="'.$news_id.'">
								<input type="submit" value="'.$word[18].'">
								</form>
							</div>';
						}
					}
                    ?>
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