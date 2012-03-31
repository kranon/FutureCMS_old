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


include \'core/html_templates/other_page_html.php\';
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