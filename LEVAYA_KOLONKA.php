<?php session_start();
include 'core/config.php';
if ($_SESSION['lang']=='lang2'){ $lang='lang2'; }
else { $lang='lang1'; }

$link='LEVAYA_KOLONKA.php';

$title=$site[$lang]['title'];
$header=$site[$lang]['header'];
$name=$db->ReadPageName($link,$lang);
$footer=$site[$lang]['footer'];

$word=$db->WordsTranslate($lang);
include 'core/html_templates/html_template.php';
?>