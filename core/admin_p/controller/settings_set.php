<?php
# Редактирование настроек сайта.
include '../../config.php';
$lang=$_POST['lang'];

if ($lang=='lang1'){
	$id=1;
	$site_name=$_POST['site_name_lang1'];
	$site_header=$_POST['site_header_lang1'];
	$site_footer=$_POST['site_footer_lang1'];

	$meta_title=$_POST['meta_title_lang1'];
	$meta_keywords=$_POST['meta_keywords_lang1'];
	$meta_description=$_POST['meta_description_lang1'];
	$meta_charset=$_POST['meta_charset_lang1'];
}
else{
	$id=2;
	$site_name=$_POST['site_name_lang2'];
	$site_header=$_POST['site_header_lang2'];
	$site_footer=$_POST['site_footer_lang2'];

	$meta_title=$_POST['meta_title_lang2'];
	$meta_keywords=$_POST['meta_keywords_lang2'];
	$meta_description=$_POST['meta_description_lang2'];
	$meta_charset=$_POST['meta_charset_lang2'];
}

$sql="UPDATE `settings` SET 
					`siteName`='".$site_name."',
					`siteHeader`='".$site_header."',
					`siteFooter`='".$site_footer."',
					`metaTitle`='".$meta_title."',
					`metaKeywords`='".$meta_keywords."',
					`metaDescription`='".$meta_description."',
					`metaCharset`='".$meta_charset."'
	WHERE `id`='".$id."'";
$db->query($sql);

echo '1';
?> 