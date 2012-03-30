<?php session_start();
include 'core/config.php';
include 'core/classes/auth.class.php';
if ($_SESSION['lang']=='lang2'){ $lang='lang2'; }
else { $lang='lang1'; }
$link='Registratsiya.php';
$title=$site[$lang]['title'];
$header=$site[$lang]['header'];
$name=$db->ReadPageName($link,$lang);
$footer=$site[$lang]['footer'];
$style='<link rel="stylesheet" href="design/form_err.css" type="text/css">';
$script='<script type="text/javascript">
		$(document).ready(function(){
			$(\'#reg_form\').validate({
				rules:{
					login:{
						required: true,
						rangelength:[3,9]
					},
					pass:{
						required: true,
						rangelength:[5,16]
					},
					email:{
						required: true,
						email: true
					}
				},
				messages: {
					login:{
						required: "Не введён логин",
						rangelength: "Логин должен быть не менее 3 и не более 9 символов"
					},
					pass:{
						required: "Не введён пароль",
						rangelength: "Пароль должен быть не менее 5 и не более 16 символов"
					},
					email:{
						required: "Не введён E-mail",
						email: "Введите корректный E-mail"
					}
				}
			});
		});
	</script>';

$word=$db->WordsTranslate($lang);

$form.='<span id="error_message">'.$_SESSION['reg_error'].'</span>';
unset($_SESSION['reg_error']);
if ($_SESSION['login']==null){
	$form.=Auth::ShowRegForm($word,'core/register.php');
}
else {
	$form.='<br /><p>Вы уже авторизованы!</p>';
}
include 'core/html_templates/other_page_html.php';
?>
