<div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Ajouter un rôle</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        </div>
	        <div class="modal-body">
		        <form id="Role_form" method="post" action="/roles">
		        	{{csrf_field()}}
		        	@include('errors.errors')
		        	<div class="form-group">
		        		<label class="font-weight-bold"> Designation:</label>
		        		<input type="text" name="designation" class="form-control" required>
		        	</div>	        	
		        </form>
	        </div>
	        <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="mdi mdi-close"></span> Annuler</button>
		        <button type="button" onclick="$('#Role_form').submit()" class="btn btn-success"><span class="mdi mdi-plus"></span> Ajouter</button>
	        </div>
	    </div>
    </div>
</div>
