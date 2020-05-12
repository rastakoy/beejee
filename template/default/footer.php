<script>

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