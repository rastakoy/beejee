<script>
function login(){
	var data = 'ajax=login';
	data += '&login=' + $('#sigin-login').val();
	data += '&password=' + $('#sigin-password').val();
	$.ajax({
		type    : 'POST',
		dataType: 'json',
		url     : "/ajax",
		data    : data,
		success : function (data) {
			console.log(data);
			if(data.status=='1'){
				//$('#myModal').modal('hide');
				location.href=location.href;
			}else if(data.errs=1){
				switch(data.errnum){
					case '1':
						$('#sigin-password').attr('title', data.err);
						$('#sigin-password').tooltip('toggle');
					break;
					case '2':
						$('#sigin-password').attr('title', data.err);
						$('#sigin-password').tooltip('toggle');
					break;
					case '3':
						$('#sigin-password').attr('title', data.err);
						$('#sigin-password').tooltip('show');
					break;
					case '4':
						$('#sigin-login').attr('title', data.err);
						$('#sigin-login').tooltip('toggle');
					break;
				}
			}
		}
	});
}
//***********
function logout(){
	console.log('logout');
	var data = 'ajax=logout';
	$.ajax({
		type    : 'POST',
		dataType: 'json',
		url     : "/ajax",
		data    : data,
		success : function (data) {
			console.log(data);
			location.href=location.href;
		}
	});
}
//***********
function showModal(){
	$('#myModal').modal();
}
//***********
function toggleNewTask(){
	if(document.getElementById('toggle-new-task').style.display=='none'){
		document.getElementById('toggle-new-task').style.display='';
		$('.glyphicon-plus').attr('class', 'glyphicon glyphicon-minus');
		console.log($('.glyphicon-plus').attr('style'));
	}else{
		document.getElementById('toggle-new-task').style.display='none';
		$('.glyphicon-minus').attr('class', 'glyphicon glyphicon-plus');
		console.log($('.glyphicon-plus'));
	}
}
//***********
function validEmail(email){
	
}
//***********
function validName(name){
	if(name.match(/[A-Za-z0-9А-Яа-яёЁ_ ]{2,40}/) && name.length<=40){
		console.log('Имя валидно');
		return true;
	}
	return false
}
//***********
function validEmail(email){
	//if(email.match(/.+?\@.+/g) || []){
	if(email.match(/^[A-Za-z0-9_\.-]+@[a-z0-9-]+\.([a-z]{1,15}\.)?[a-z]{2,6}$/i)){
		console.log('E-mail валидный');
		return true;
	}
	return false
}
//***********
function addNewTask(){
	var name = $('#task-name').val();
	name = $.trim(name);
	if(!validName(name)){
		$('#task-name').attr('title', '<b>Неправильное имя</b><br/>Любые буквы, длина 2-40, пробел, подчеркивание «_».');
		$('#task-name').tooltip('toggle');
		return false;
	}
	//****
	var email = $('#task-email').val();
	email = $.trim(email);
	if(!validEmail(email)){
		$('#task-email').attr('title', '<b>Неправильный e-mail</b><br/>Введите валидный e-mail.');
		$('#task-email').tooltip('toggle');
		return false;
	}
	//****
	var content = $('#task-content').val();
	content = $.trim(content);
	if(content==''){
		$('#task-content').attr('title', '<b>Заполните поле описания «Задача»</b>.');
		$('#task-content').tooltip('toggle');
		return false;
	}
	//****
	var data = 'ajax=newTask';
	data += '&name='+encodeURIComponent(name);
	data += '&email='+encodeURIComponent(email);
	data += '&content='+encodeURIComponent(content);
	console.log('data=', data);
	$.ajax({
		type    : 'POST',
		//dataType: 'json',
		url     : "/ajax",
		data    : data,
		success : function (data) {
			console.log(data);
			$('#comfirmAdded').modal('show');
		}
	});
}
//***********
$(document).ready(function(){
	$('#task-email').on('blur', function(e){
		//console.log('E-mail blur');
		var email = $('#task-email').val();
		email = $.trim(email);
		if(!validEmail(email)){
			$('#task-email').attr('title', '<b>Неправильный e-mail</b><br/>Введите валидный e-mail.');
			$('#task-email').tooltip('toggle');
		}
	})
})
//***********
</script>

<!-- Modal -->
<div class="modal fade" id="myModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Вход в систему</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form>
          <div class="form-group">
            <label for="sigin-login" class="col-form-label">Логин:</label>
            <input type="text" class="form-control" id="sigin-login" value="admin" onmouseout="$(this).tooltip('dispose');">
          </div>
          <div class="form-group">
            <label for="sigin-password" class="col-form-label">Пароль:</label>
            <input type="text" class="form-control" id="sigin-password" value="123" onmouseout="$(this).tooltip('dispose');">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <button type="button" class="btn btn-primary" onclick="login()">Войти</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Вход в систему</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form>
          <div class="form-group">
          </div>
		  <div class="form-group">
            <label for="task-content" class="col-form-label">Описание:</label>
			<textarea class="form-control" id="edit-task-content" data-html="true" onmouseout="$(this).tooltip('dispose');"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <button type="button" class="btn btn-primary" onclick="editTaskContent()">Сохранить изменения</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="comfirmAdded" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Сообщение</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		Запись добавлена
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="resetFilters()">Закрыть</button>
      </div>
    </div>
  </div>
</div>
</body></html>