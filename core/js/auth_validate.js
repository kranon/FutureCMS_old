// Валидация формы авторизации
$(document).ready(function(){
	$(':text')[0].focus(); // поставить курсор в первое на стр. поле ввода
	$('#autoris').validate({
		rules:{
				login:{
					required: true
				},
				pass:{
					required: true
				}
		},
		messages:{
			login:{
				required: "Не введён логин<br />"
			},
			pass:{
				required: "Не введён пароль<br />"
			}
		}
	});
});
