<div class="modal fade" id="confirmacaoExclusaoModal" tabindex="-1">
	<div class="modal-dialog">
		<form th:attr="data-url-base=@{/}" method="POST">
			<input type="hidden" name="_method" value="DELETE" />
			<input type="hidden" name="id" value="DELETE" />

			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Você tem certeza?</h4>
				</div>

				<div class="modal-body">
					<span>Tem certeza que deseja apagar?</span>
				</div>

				<div class="modal-footer">
					<input type="hidden" th:name="${_csrf.parameterName}" th:value="${_csrf.token}" />
					<button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Excluir</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
$('#confirmacaoExclusaoModal').on('show.bs.modal', function(event) {
	var button = $(event.relatedTarget);
	
	var model = button.data('model');
	var codigo = button.data('codigo');
	var descricao = button.data('descricao');
 
	var modal = $(this);
	var form = modal.find('form');
	var action = form.data('url-base');
	if (!action.endsWith('/')) {
		action += '/';
	}
	form.attr('action', action + model+'s/'+codigo);
	
	modal.find('.modal-body span').html('Tem certeza que deseja excluir o '+model+' <strong>' + descricao + '</strong>?');
});
</script>