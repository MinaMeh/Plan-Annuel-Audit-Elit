<div class="modal fade" id="editTech" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Modifier une technologie</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        </div>
	        <div class="modal-body">
		        <form id="tech_edit" method="post" action="/technologies/modifier">
		        	{{csrf_field()}}
		        	<input id="tech_id"  hidden type="text" name="id" class="form-control" value="">
		        	<div class="form-group">
		        		<label class="font-weight-bold"> Designation:</label>
		        		<input type="text" name="designation" id="tech_designation" class="form-control" required>
		        	</div>
		        	<div class="form-group">
		        		<label class="font-weight-bold"> Description:</label>
		        		<input type="text" name="description"id=tech_description class="form-control">
		        	</div>
		        </form>
	        </div>
	        <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="mdi mdi-close"></span> Annuler</button>
		        <button type="button" onclick="$('#tech_edit').submit()" class="btn btn-success"><span class="mdi mdi-content-save"></span> Sauvgarder</button>
	        </div>
	    </div>
	</div>
</div>