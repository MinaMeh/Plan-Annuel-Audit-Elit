<div class="modal fade" id="addType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Ajouter un type d'application</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        </div>
	        <div class="modal-body">
		        <form id="type" method="post" action="/types">
		        	{{csrf_field()}}
		        	<div class="form-group">
		        		<label> Designation:</label>
		        		<input type="text" name="designation" class="form-control" required>
		        	</div>
		        	<div class="form-group">
		        		<label> Description:</label>
		        		<input type="text" name="description" class="form-control">
		        	</div>
		        </form>
	        </div>
	        <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="mdi mdi-close"></span> Annuler</button>
		        <button type="button" onclick="$('#type').submit()" class="btn btn-success"><span class="mdi mdi-plus"></span> Ajouter</button>
	        </div>
	    </div>
    </div>
</div>