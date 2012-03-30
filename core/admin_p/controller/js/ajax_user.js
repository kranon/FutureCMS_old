$(document).ready(function(){
	// Обновление контента
	function getCon(){
		// Получение JSON от сервера
		$.getJSON('../controller/users_get.php',getContent);
		function getContent(data){
			var text='';
			var sex='';
			var users_count=0;
			$.each(data, function(adata){
				if (this.sex=='men'){ sex='мужской'; }
				else{ sex='женский'; }
				text+='<tr><td class="al_center">&nbsp;'+this.id+'&nbsp;</td><td class="al_center">&nbsp;'+this.login+'&nbsp;</td><td class="al_center"><a href="../controller/genNewPass.php?login='+this.login+'" class="gen">Выслать новый пароль</a></td><td class="al_center">&nbsp;'+this.email+'&nbsp;</td><td class="al_center">&nbsp;'+sex+'&nbsp;</td><td class="al_center">&nbsp;'+this.group+'&nbsp;</td><td class="al_center">&nbsp;'+this.datreg+'&nbsp;</td><td class="al_center"><img src="../../../'+this.ava+'" alt="аватар"></td><td class="al_center"><a href="../controller/user_del.php?id='+this.id+'" class="del"><img src="../view/del.png" /></td></tr>';
				users_count++;	
				});
			$('#tbody').html(text);
			$('#users_count').html('Всего пользователей: '+users_count);
		}
	}
	getCon();
	// вывод результата действий при сохранений
	function report(answer,message){
		if (answer=='1'){
				getCon();
				$('#mess').html('<b>&nbsp;'+message+'&nbsp;</b>').show().fadeOut(1500);
			}
			else{
				$('#mess').html('<b>&nbsp;'+answer+'&nbsp;</b>').show().fadeOut(5000);
			}
	}
	// Сохранение группы пользователя при выборе из списка
	$('select').live('change',function(){
		var data2=$('#user_inf').serialize();
		$.post('../controller/users_set.php',data2);
	});
	
	// Сгенерировать новый пароль
	$('.gen').live('click',function(evt){
		var link=$(this).attr('href');
		var querystr=link.slice(link.indexOf('?')+1);
		$.get('../controller/genNewPass.php',querystr,rep);
		function rep (mess){
			report(mess,'Пароль сгенерирован и отправлен!');
		}
		evt.preventDefault();	// Отмена стандартного события
	});

	// Удаление пользователя
	$('.del').live('click',function(evt){
		var link=$(this).attr('href');
		var querystr=link.slice(link.indexOf('?')+1);
		$.get('../controller/users_del.php',querystr,rep);
		function rep (mess){
			report(mess,'Пользователь удалён!');
		}
		evt.preventDefault();	// Отмена стандартного события
	});
	// Добавление нового пользователя
	$('#AddUser').click(function(evt){
		var newUser=$('#reg_form').serialize();
		$.post('../controller/users_add.php',newUser,rep);
		function rep(mess){
			report(mess,'Пользователь добавлен!');
		}
		evt.preventDefault();
	});
});