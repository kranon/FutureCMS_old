<?php session_start();
include "core/config.php";
include "core/classes/auth.class.php";
if ($_SESSION['lang']=='lang2'){ $lang='lang2'; }
else { $lang='lang1'; }

$link='hello.php';

//hello

$title=$site[$lang]['name'].' - ';
$header=$site[$lang]['header'];
$name=$db->ReadPageName($link,$lang);
$footer=$site[$lang]['footer'];

$word=$db->WordsTranslate($lang);


include 'core/html_template.php';
?>