<?php session_start();
$group=$_SESSION['group'];
if (($group=='1')|($group=='2')){
	include '../../config.php';
	$content=$_GET['content'];
	$logout='<a href="../../logout.php">Выход</a> ['.$_SESSION['login'].']';
	$title=$site['lang1']['name'].' - ';
	$footer='<hr><p>© 2010-'.date('Y').' Sobko Andrey E-mail: <a href="mailto:kranon@tut.by">kranon@tut.by</a><br />
		ver. '.$site['version'].'</p>';
		
	if ($group=='1'){
	$menu='<ul class="nav">
		<li><a href="pages.php?content=pages">Страницы</a></li>
		<li><a href="pages.php?content=news">Новости</a></li>
		<li><a href="pages.php?content=menu">Меню</a></li>
        <li><a href="pages.php?content=users">Пользователи</a></li>
        <li><a href="pages.php?content=gallery">Галерея</a></li>
		<li><a href="pages.php?content=settings">Настройки</a></li>
		</ul>';
	$menu2=array(
		
	);
	}
	else{
		$menu='<ul class="nav">
		<li><a href="pages.php?content=pages">Страницы</a></li>
		<li><a href="pages.php?content=news">Новости</a></li>
		</ul>';
	}
	switch ($content){
		case 'pages':
			$title.='Настройка страниц';
			$header='Страницы';
			break;
		case 'news':
			$title.='Настройка новостей';
			$header='Новости';
			break;
		case 'menu':
			$title.='Настройка меню';
			$header='Меню';
			break;
		case 'users':
			$title.='Настройка пользователей';
			$header='Пользователи';
			break;
		case 'gallery':
			$title.='Настройка галереи';
			$header='Галерея';
			break;
		case 'album':
			$title.='Редактирование альбома';
			$header='Редактирование альбома';
			break;
		case 'settings':
			$title.='Настройки сайта';
			$header='Настройки';
			break;
		case 'page_edit':
			$title.='Редактирование страниц';
			$header='Редактирование страницы:';
			$edit_link='<a href="<?php echo $link;?> ">Посмотреть страницу</a>';
			break;
		case 'news_edit':
			$title.='Редактирование новостей';
			$header='Редактирование новости:';
			break;
		case '':
			$title.='Главная';
			$header='Главная';
			break;
	}
	include '../templates/template3.php';
}
else {
	header('Location: ../../../index.php');
	exit;
}
?>