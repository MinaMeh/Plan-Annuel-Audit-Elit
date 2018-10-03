<div class="modal fade" id="deleteProcedure" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Supprimer une procédure</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        </div>
	        <div class="modal-body">
		      	Voulez-vous vraiment supprimer cette procédure?
		        <form id="procedure_delete" method="post" action="/procedures/supprimer">
		        	{{csrf_field()}}
		        	<input type="" name="id" id="procedure_id" hidden>			        	
		        </form>
	        </div>
	        <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="mdi mdi-close"></span> Annuler</button>
		        <button type="button" onclick="$('#procedure_delete').submit()" class="btn btn-danger"><span class="mdi mdi-delete"></span> Supprimer</button>
	        </div>
	    </div>
    </div>
</div>
