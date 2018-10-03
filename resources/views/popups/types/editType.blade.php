<div class="modal fade" id="editType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Modifier un type d'application</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        </div>
	        <div class="modal-body">
		        <form id="type_edit" method="post" action="/types/modifier">
		        	{{csrf_field()}}
		        	<input type="" name="id" hidden id="type_id">
		        	<div class="form-group">
		        		<label> Designation:</label>
		        		<input type="text" name="designation" id="type_designation" class="form-control" required>
		        	</div>
		        	<div class="form-group">
		        		<label> Description:</label>
		        		<input type="text" name="description" id="type_description" class="form-control">
		        	</div>
		        </form>
	        </div>
	        <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="mdi mdi-close"></span> Annuler</button>
		        <button type="button" onclick="$('#type_edit').submit()" class="btn btn-success"><span class="mdi mdi-content-save"></span> Sauvgarder</button>
	        </div>
	    </div>
    </div>
</div>