<?php session_start();
include 'core/config.php';
if ($_SESSION['lang']=='lang2'){ $lang='lang2'; }
else { $lang='lang1'; }
$link='album.php';
$title=$site[$lang]['name'].' - ';
$header=$site[$lang]['header'];
$name=$db->ReadPageName($link,$lang);
$footer=$site[$lang]['footer'];

$word=$db->WordsTranslate($lang);
// проверить входные данные!!!!!
$id=$_GET['id']*1;
if (isset($id)){
	$result = mysql_query("SELECT `name_".$lang."`,`link` FROM `gallery` WHERE `id`=".$id);
	while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
		$album=array(
			'name'=>$row['name_'.$lang],
			'link'=>$row['link']
		);
	}
}
$name=$album['name'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=<?php echo $meta['charset'];?>" />
    <title><?php echo $title.$name;?></title>
    <meta name="title" content="<?php echo $meta['title'];?>" />
    <meta name="keywords" content="<?php echo $meta['keywords'];?>" />
    <meta name="description" content="<?php echo $meta['description'];?>" />
	<link rel="stylesheet" href="design/style_main.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="design/droppy.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" href="design/form_err.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="design/galleria.css" type="text/css" media="screen">
    <link rel="stylesheet" type="text/css" href="core/lightBox/css/jquery.lightbox-0.5.css" media="screen" />
	<script type="text/javascript" src="core/js/jquery.js"></script>
	<script type="text/javascript" src="core/js/jquery.validate.js"></script>
	<script type="text/javascript" src="core/js/jquery.droppy.js"></script>
	<script type='text/javascript'>$(function(){$('#nav').droppy();});</script>
	<script type="text/javascript" src="core/js/auth_validate.js"></script>
	<script type='text/javascript' src="core/js/hs_authForm.js"></script>
	<script type="text/javascript" src="core/lightBox/js/jquery.lightbox-0.5.min.js"></script>
	<script type="text/javascript">
    $(document).ready(function(){
        $('#gallery a').lightBox();
    });
    </script>
	<style type="text/css">
	/* jQuery lightBox plugin - Gallery style */
	#gallery {
		background-color: #FFFFF0;
		padding: 10px;
		width: 100%;
	}
	#gallery ul{ list-style: none; }
	#gallery ul li { display: inline; }
	#gallery ul img {
		border: 5px solid #0956fe;/*Цвет рамки вокру фото*/
		border-width: 5px 5px 5px;
		margin: 2px;
	}
	#gallery ul a:hover img {
		border: 5px solid #09cafe;/*Цвет рамки вокру фото при наведении*/
		border-width: 5px 5px 5px;
		color: #fff;
	}
	#gallery ul a:hover { color: #fff; }
	#content a{ padding:0px 0px;}
	</style>
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
					<h3><?php echo $name;?></h3>
					<!--Galleria-->
                    <?php
						$mas=$db->OpenAlbum($id,'./');
                        if(isset($mas)){
							echo '<a href="Galereya.php">Назад</a><br />
							<div id="gallery"><ul>';
							foreach($mas as $fileName){
								echo '<li><a href="gallery/'.$album['link'].'/'.$fileName.'"><img src="gallery/'.$album['link'].'/thumbs/'.$fileName.'"></a></li>';
							}   
							echo '</ul></div>';
						}
                    $db->TextRead($link, $lang);?>
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