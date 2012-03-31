<?php session_start();
include 'core/config.php';
if ($_SESSION['lang']=='lang2'){ $lang='lang2'; }
else { $lang='lang1'; }
$link='album.php';
$title=$site[$lang]['name'].' - ';
$header=$site[$lang]['header'];
$name=$db->ReadPageName($link,$lang);
$footer=$site[$lang]['footer'];


$script='<script type="text/javascript" src="core/lightBox/js/jquery.lightbox-0.5.min.js"></script>
	<script type="text/javascript">
    $(document).ready(function(){
        $(\'#gallery a\').lightBox();
    });
    </script>';
$style='<link rel="stylesheet" type="text/css" href="core/lightBox/css/jquery.lightbox-0.5.css" media="screen" />
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
	</style>';

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
$mas=$db->OpenAlbum($id,'./');
if(isset($mas)){
	$form.='<a href="Galereya.php">Назад</a><br />
		<div id="gallery"><ul>';
	foreach($mas as $fileName){
		$form.='<li><a href="gallery/'.$album['link'].'/'.$fileName.'"><img src="gallery/'.$album['link'].'/thumbs/'.$fileName.'"></a></li>';
	}   
	$form.='</ul></div>';
}

include 'core/html_templates/other_page_html.php';
?>