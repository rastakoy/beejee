<?php
//echo '<pre>'; print_r($this->url); echo '</pre>';
//echo '<pre>'; print_r($this->params); echo '</pre>';
//echo '<pre>'; print_r($data); echo '</pre>';
//echo "page=$page<br/>onPage=$onPage<br/>total=$total<br/>direct=$direct<br/>";
?>
<style>
.sorter{
	float:right;
	color:#BBBBBB;
	cursor:pointer;
}
.sorter-asc, .sorter-desc{
	color:#333;
}
</style>
<div class="container pt-2">
	<div class="row mb-4">
		<div class="col-md-12">
			<? if($this->user['reg']=='1'){ ?><span onclick="logout()" style="cursor:pointer;"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Выход</span><? }else{ ?><span onclick="showModal()" style="cursor:pointer;"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Вход</span><? } ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<a href="javascript:toggleNewTask()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Добавить запись</a>
		</div>
	</div>
	<div id="toggle-new-task" class="row" style="display:none;">
		<div class="col-md-12">
			<form>
			  <div class="form-group">
				<label for="task-name" class="col-form-label">Имя:</label>
				<input type="text" class="form-control" id="task-name" data-html="true" value="<?=($this->user['reg']=='1')?$this->user['name']:'Ян'?>" onmouseout="$(this).tooltip('dispose');">
			  </div>
			  <div class="form-group">
				<label for="task-email" class="col-form-label">E-mail:</label>
				<input type="email" class="form-control" id="task-email" data-html="true" value="<?=($this->user['reg']=='1')?$this->user['email']:'user-yournumber@test.com'?>" onmouseout="$(this).tooltip('dispose');">
			  </div>
			  <div class="form-group">
				<label for="task-content" class="col-form-label">Задача:</label>
				<textarea class="form-control" id="task-content" data-html="true" value="123" onmouseout="$(this).tooltip('dispose');">dsa</textarea>
			  </div>
			</form>
			<button type="button" class="btn btn-primary" onclick="addNewTask()">Сохранить</button>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-md-12"><label for="on-page">Показывать на странице:</label></div>
		<div class="form-group col-md-6">
			
			<select class="form-control" id="on-page" name="sellist1" onchange="changeQtty()">
				<option>3</option>
				<option <?=($onPage=='10')?'selected':''?>>10</option>
				<option <?=($onPage=='20')?'selected':''?>>20</option>
				<option <?=($onPage=='50')?'selected':''?>>50</option>
			</select>
		</div>
		<div class="form-group col-md-6">
			<button type="button" class="btn btn-secondary" onclick="resetFilters()">Сбросить</button>
		</div>
		<div class="table-responsive text-nowrap" id="tableTasks">
			<? //require_once('__tasks.php'); ?>
			<table id="my-table" class="table table-striped table-bordered">
				<thead class="<? //thead-dark ?>">
					<tr>
						<th>Имя<span class="glyphicon glyphicon-chevron-<?=($this->params['direct']['name']=='desc')?'down':'up'?> sorter<?=($this->params['direct']['name'])?' sorter-'.$this->params['direct']['name']:''?>" aria-hidden="true" data-sorter="name"></span></th>
						<th>E-mail<span class="glyphicon glyphicon-chevron-<?=($this->params['direct']['email']=='desc')?'down':'up'?> sorter<?=($this->params['direct']['email'])?' sorter-'.$this->params['direct']['email']:''?>" aria-hidden="true" data-sorter="email"></th>
						<th>Описание</th>
						<th>Статус<span class="glyphicon glyphicon-chevron-<?=($this->params['direct']['status']=='desc')?'down':'up'?> sorter<?=($this->params['direct']['status'])?' sorter-'.$this->params['direct']['status']:''?>" aria-hidden="true" data-sorter="status"></th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody id="tableTasks">
					<?php
					//echo '<pre>'; print_r($this->url); echo '</pre>';
					//echo '<pre>'; print_r($this->params); echo '</pre>';
					//echo '<pre>Data'; print_r($data); echo '</pre>';
					if(is_array($data['tasks'])){ foreach($data['tasks'] as $task){ ?>
						<tr>
							<td><?=$task['name']?></td>
							<td><?=$task['email']?></td>
							<td><?=htmlspecialchars($task['content'])?></td>
							<td align="center"><? if($this->user['reg'] && $this->user['login']=='admin'){ ?><input id="ets-<?=$task['id']?>" type="checkbox" class="form-check-input" <?=($task['status']=='1')?'checked':''?>><? }else{ ?><?=($task['status']=='1')?'Выполнено':'Ожидание'?><? } ?></td>
							<td><? if($this->user['reg']=='1' && $this->user['login']=='admin'){
							?><a href="javascript:"<?
							echo ($task['adedited']=='1')?' style="color:green;"':'';
							?>><? } ?><span class="glyphicon glyphicon-pencil" aria-hidden="true" id='et-<?=$task['id']?>' <?=($task['adedited']=='1')?' style="color:green;"':''?>></span><?
							if($this->user['reg']=='1' && $this->user['login']=='admin'){ ?></a><? } ?></td>
						</tr>
					<? }} ?>
					</tbody>
			</table>
			<script>//window.history.pushState({url:'page=<?=$page.'&onPage='.$onPage.'&'.$direct?>'}, '' ,'page=<?=$page.'&onPage='.$onPage.'&'.$direct?>')</script>
			<!-- Пагинация -->
			<? if(ceil($total/$onPage)>1){ ?>
			<nav aria-label="Page navigation example">
			  <ul class="pagination">
				<li class="page-item">
				  <a class="page-link" href="?page=<?=($page-1<1)?'1':($page-1).'&onPage='.$onPage.'&'.$direct?>" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
					<span class="sr-only">Previous</span>
				  </a>
				</li>
				<? for($j=1; $j<ceil($total/$onPage)+1; $j++){ ?>
				<li class="page-item<?=($page==$j)?' active':''?>"><a class="page-link" href="?page=<?=$j.'&onPage='.$onPage.'&'.$direct?>"><?=$j?></a></li>
				<? } ?>
				<li class="page-item">
				  <a class="page-link" href="page=<?=($page+1>ceil($total/$onPage))?(ceil($total/$onPage)):($page+1).'&onPage='.$onPage.'&'.$direct?>" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
					<span class="sr-only">Next</span>
				  </a>
				</li>
			  </ul>
			</nav>
			<? } ?>
			<!-- /Пагинация -->
		</div>
	</div>
</div>
<script>
var direct = <?=(is_array($this->params['direct']))?json_encode($this->params['direct']):'{}'?>;
var myPage = <?=$page?>;
var editId = -1;
//***********
<? if($this->user['reg']=='1' && $this->user['login']=='admin'){ ?>
function editTaskContent(){
	var data = 'ajax=editTaskContent&taskId='+editId;
	data += '&content='+encodeURIComponent($('#edit-task-content').val());
	console.log(data);
	$.ajax({
		type    : 'POST',
		//dataType: 'json',
		url     : "/ajax",
		data    : data,
		success : function (data) {
			//console.log(data);
			$('#editModal').modal('hide');
			location.href=location.href;
		}
	});
}
<? } ?>
//***********
$(document).ready(function(){
	$('.sorter').on('click', function(){
		var data = 'page=<?=$page?>';
		data += '&onPage='+$('#on-page').val();
		var curField = $(this).attr('data-sorter');
		var curClass = $(this).attr('class').replace(/^.* /gi, '');
		if(curClass=='sorter'){
			direct[curField] = 'asc';
		}else if(curClass=='sorter-asc'){
			direct[curField] = 'desc';
		}else{
			delete(direct[curField]);
		}
		data += getDirect();
		var foo = location.href.split('?');
		location.href = foo[0]+'?'+data;
	});
	<? if($this->user['reg']=='1'){ ?>
		$('.glyphicon-pencil').on('click', function(){
			var id = $(this).attr('id').replace(/^et-/, '');
			var data = 'ajax=getEditItem';
			data += '&taskId='+id;
			editId = id;
			$.ajax({
				type    : 'POST',
				dataType: 'json',
				url     : "/ajax",
				data    : data,
				success : function (data) {
					console.log(data);
					$('#editModal').modal('show');
					$('#edit-task-content').val(data.content);
					if(data.status=='1'){
						$('#edit-task-status').prop('checked', true);
					}else{
						$('#edit-task-status').prop('checked', false); 
					}
					//var foo = location.href.split('?');
					//location.href = foo[0]+'?'+data.link;
				}
			});
		});
		//******
		$('.form-check-input').on('click', function(){
			var data = 'ajax=editStatus';
			data += '&taskId='+this.id.replace(/^ets-/, '');
			data += '&value='+this.checked;
			console.log(data);
			$.ajax({
				type    : 'POST',
				//dataType: 'json',
				url     : "/ajax",
				data    : data,
				success : function (data) {
					console.log(data);
				}
			});
		});
	<? } ?>
});
//***********
/*function getTasks(obj){
	var data = 'ajax=getTasks';
	data += '&page='+((obj)?+'<?=$page?>':'1');
	data += '&onPage='+$('#on-page').val();
	//****
	if(obj){
		var curField = $(obj).attr('data-sorter');
		var curClass = $(obj).attr('class').replace(/^.* /gi, '');
		$(obj).attr('class', $(obj).attr('class').replace(/( sorter-asc| sorter-desc)/gi, ''));
		if(curClass=='sorter'){
			$(obj).attr('class', $(obj).attr('class')+' sorter-asc');
			direct[curField] = 'asc';
		}else if(curClass=='sorter-asc'){
			$(obj).attr('class', $(obj).attr('class')+' sorter-desc');
			$(obj).attr('class', $(obj).attr('class').replace(/chevron-up/gi, 'chevron-down'));
			direct[curField] = 'desc';
		}else{
			$(obj).attr('class', $(obj).attr('class').replace(/chevron-down/gi, 'chevron-up'));
			delete(direct[curField]);
		}
	}
	//****
	data += getDirect();
	//console.log(data);
	//return false;
	$.ajax({
		type    : 'POST',
		dataType: 'json',
		url     : "/ajax",
		data    : data,
		success : function (data) {
			console.log(data);
			var foo = location.href.split('?');
			location.href = foo[0]+'?'+data.link;
			//Для ajax
			//$('#tableTasks').empty();
			//$('#tableTasks').append(data);
			//$('.sorter').on('click', function(){
			//	getTasks(this);
			//});
		}
	});
}*/
//***********
</script>