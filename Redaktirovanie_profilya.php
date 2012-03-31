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

$ava=substr_replace($_SESSION['ava'], '', 0, 3); 
$form.='<p>
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
	<img src="'.$ava.'" />
		<form action="core/editProfile.php" method="post" enctype="multipart/form-data"> 
		Изменить аватар:<br />
		<input type="file" name="avatar" />
		<input type="hidden" name="type" value="ava" /><br />
		<input type="submit" name="save_new_ava" value=" Сохранить " />
		</form>
</p>';

include 'core/html_templates/other_page_html.php';
?>