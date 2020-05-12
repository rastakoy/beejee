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
		<td><?=$task['content']?></td>
		<td><?=($task['status']=='1')?'Выполнено':'Ожидание'?></td>
		<td><? if($this->user['reg']=='1' && $this->user['login']=='admin'){
		?><a href="javascript:"<?
		echo ($task['adedited']=='1')?' style="color:green;"':'';
		?>><? } ?><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span><?
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
<script>
//***********

//***********
</script>