// Показать/скрыть форму авторизации 
$(document).ready(function(){
	$('#ln,#autoris').mouseover(function(){
		$('#autoris').addClass('show_auth');
		$('#autoris').removeClass('hide_auth');
	});
	$('#ln,#autoris').mouseout(function(){
		if ($('#log,#ppp').val()==''){
			$('#autoris').addClass('hide_auth');//прячем
			$('#autoris').removeClass('show_auth');
		}
	});
});	
