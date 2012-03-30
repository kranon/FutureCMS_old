<?php
# Добавление новой страницы и меню для перехода на неё #
include '../../config.php';
$name=$_POST['name'];
$publ=$_POST['publ'];
$in_menu=$_POST['add_in_menu'];
$result = $db->query("SELECT `lang2` FROM `page` WHERE `lang2`= '".$name."'");
// Если страницы с таким именем не существует, то создаём новую
if (mysql_num_rows($result)==0){
	// если "опубликовать", то переменной присваивается значение 1 иначе 0
	if ($in_menu=='on'){$in_menu=1;}
	else {$in_menu=0;}
	if ($publ=='on'){$publ=1;}
	else {$publ=0;}
	$sql="SELECT `lang1`, `text_lang1` FROM `page` WHERE `lang1`= '".$name."'";
	$result = $db->query($sql);
	while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
		$text = $row['text_lang1'];
		$name = $row['lang1'];
	}
	mysql_free_result($result);
	//функция транслита (русское имя страницы -> английское имя файла)
	//имя нового файла (имя.php)
	$link = $db->translitIt($name).'.php';
	//добавление меню
	$menu=array(
		'name'=>$name,
		'link'=>$link,
		'publ'=>$in_menu,
		'in'=>'0'
	);
	if ($in_menu==1){$db->MenuAdd($menu);}
	//добавление страницы
	if (!$result = $db->query("INSERT INTO `page` (`lang1`,`lang2`,`link`,`in_menu`)VALUES ('".$name."','".$name."', '".$link."', '".$in_menu."')")){
		echo 'Ошибка запроса создания страницы (page_add.php)';
	}
	
/*$body='<?php session_start();
include "core/config.php";
if ($_SESSION[\'lang\']==\'lang2\'){ $lang=\'lang2\'; }
else { $lang=\'lang1\'; }

$link=\''.$link.'\';

$title=$site[$lang][\'title\'];
$header=$site[$lang][\'header\'];
$name=$db->ReadPageName($link,$lang);
$footer=$site[$lang][\'footer\'];

$word=$db->WordsTranslate($lang);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=<?php echo $meta[\'charset\'];?>" />
    <title><?php echo $title;?></title>
    <meta name="title" content="<?php echo $meta[\'title\'];?>" />
    <meta name="keywords" content="<?php echo $meta[\'keywords\'].\', \'.$name;?>" />
    <meta name="description" content="<?php echo $meta[\'description\'];?>" />
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
	<script type="text/javascript">$(function(){$(\'#nav\').droppy();});</script>
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
                    if ($_SESSION[\'login\']==NULL){
                        echo \'<a href="/Avtorizatsiya.php" id="ln">\'.$word[1].\'</a>
                        <a href="/Registratsiya.php">\'.$word[2].\'</a>\';
                    }
                    else{
                        echo \'<a href="core/logout.php"> \'.$word[4].\' [\'.$_SESSION[\'login\'].\']</a>\';
                    }
                    if (($_SESSION[\'group\']==\'1\')|($_SESSION[\'group\']==\'2\')){
                        echo \'<a href="core/admin_p/">\'.$word[3].\'</a>\';
                    }
					include \'core/auth.php\';
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
                    $db->TextRead($link,$lang);?>
                </div><!-- #content-->
            </div><!-- #container-->
            <?php include \'core/sideRight.php\';?>
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
</html>';*/
	$body='<?php session_start();
include "core/config.php";
include "core/classes/auth.class.php";
if ($_SESSION[\'lang\']==\'lang2\'){ $lang=\'lang2\'; }
else { $lang=\'lang1\'; }

$link=\''.$link.'\';

$title=$site[$lang][\'name\'].\' - \';
$header=$site[$lang][\'header\'];
$name=$db->ReadPageName($link,$lang);
$footer=$site[$lang][\'footer\'];

$word=$db->WordsTranslate($lang);


include \'core/html_template.php\';
?>';
	//создание файла и запись в него содержимого переменной $body
	$handle = fopen("../../../".$link, "a");
	fwrite($handle, $body);
	fclose($handle);
	if ($in_menu!=1){
		echo '1';
	}
}
else{
	echo 'Страница с таким именем уже существует!!!';
}?>