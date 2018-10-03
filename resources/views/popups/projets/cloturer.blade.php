<div class="modal fade" id="cloturer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Cloturer le projet</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        </div>
	        <div class="modal-body">
		        <form id="end" method="post" action="/projets/cloturer/{{$projet->id}}">
		        	{{csrf_field()}}
		        	<div class="form-group">
		        		<label class="font-weight-bold"> Date VISA DSSD:</label>
		        		<input type="date" name="date_visa_dssd" class="form-control">
		        	</div>
		        	<div class="form-group">
		        		<label class="font-weight-bold"> Date passage en production:</label>
		        		<input type="date" name="date_passage_prod" class="form-control">
		        	</div>
		        </form>
	        </div>
	        <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="mdi mdi-close"></span> Annuler</button>
	      	    <button type="button" onclick="$('#end').submit()" class="btn btn-danger"><span class="mdi mdi-minus"></span>Cloturer</button>
	        </div>
	    </div>
    </div>
</div>