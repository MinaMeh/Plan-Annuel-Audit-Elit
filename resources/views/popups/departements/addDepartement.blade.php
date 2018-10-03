<div class="modal fade" id="addDepartement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Ajouter un département</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        </div>
	        <div class="modal-body">
		        <form id="departement" method="post" action="/departements">
		        	{{csrf_field()}}
		        	<div class="form-group">
		        		<label class="font-weight-bold"> Département:</label>
		        		<input type="text" name="designation" class="form-control" required>
		        	</div>
		        	<div class="form-group">
		        		<label class="font-weight-bold"> Nature:</label>
		        		<select name="nature" class="form-control">
		        			<option value="Interne"> Interne</option>
		        			<option value="Externe"> Externe</option>
		        		</select>
		        	</div>
		        </form>
	        </div>
	        <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="mdi mdi-close"></span> Annuler</button>
		        <button type="button" onclick="$('#departement').submit()" class="btn btn-success"><span class="mdi mdi-plus"></span> Ajouter</button>
	        </div>
	    </div>
    </div>
</div>
