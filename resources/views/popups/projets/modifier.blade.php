<div class="modal fade" id="editProjet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Modifier le projet</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        </div>
	        <div class="modal-body">
		        <form id="projet_edit" method="post" action="/projets/modifier">
		        	{{csrf_field()}}
		        	<input type="" name="id" hidden value="{{$projet->id}}">
		        	<div class="form-group">
		        		<label class="font-weight-bold">Procédure:</label>
		        		<select class="form-control" name="procedure" id="procedure">
		        			@foreach ($procedures as $procedure)
		        				<option value="{{$procedure->id}}" <?php  if ($projet->procedure_id==$procedure->id) echo "selected";?>> {{$procedure->designation}}</option>
		        			@endforeach
		        		</select>
		        	</div>
		        	<div class="form-group">
		        		<label class="font-weight-bold"> Date Début d'audit:</label>
		        		<input type="date"  id="date_debut_audit" name="date_debut_audit" class="form-control" value="{{$projet->date_debut_audit}}">
		        	</div>
		        	<div class="form-group">
		        		<label class="font-weight-bold">Etat:</label>
		        		<select class="form-control" name="etat" id="etat">
		        			<option value="reçu"  <?php  if ($projet->etat=="reçu") echo "selected";?> >reçu</option>
		        			<option value="en audit"  <?php  if ($projet->etat=="en audit") echo "selected";?>>en audit</option>
		        			<option value="en réaudit"  <?php  if ($projet->etat=="en réaudit") echo "selected";?>>en réaudit</option>
		        			<option value="audit cloturé"  <?php  if ($projet->etat=="reçu") echo "selected";?>>audit cloturé</option>
		        			<option value="cloturé"  <?php  if ($projet->etat=="cloturé") echo "selected";?> >cloturé</option>
		        			<option value="attendre la bonne version"  <?php  if ($projet->etat=="attendre la bonne version") echo "selected";?> >attendre la bonne version</option>
		        			<option value="annulé"  <?php  if ($projet->etat=="annulé") echo "selected";?>>annulé</option>
		        		</select>
		        	</div>
		        	<div class="form-group">
		        		<label class="font-weight-bold">trimestre:</label>
		        		<select class="form-control" name="trimestre" id="trimestre">
		        			<option value="1" <?php  if ($projet->trimestre==1) echo "selected";?>>1</option>
		        			<option value="2"  <?php  if ($projet->trimestre==2) echo "selected";?>>2</option>
		        			<option value="3"  <?php  if ($projet->trimestre==3) echo "selected";?>>3</option>
		        			<option value="4"  <?php  if ($projet->trimestre==4) echo "selected";?>>4</option>
		        		</select>
		        	</div>
		        	<div class="form-group">
		        		<label class="font-weight-bold"> Date fin d'audit:</label>
		        		<input type="date" name="date_fin_audit" id="date_fin_audit" class="form-control" value="{{$projet->date_fin_audit}}">
		        	</div>
		        	<div class="form-group">
		        		<label class="font-weight-bold"> Date VISA DSSD:</label>
		        		<input type="date" name="date_visa_dssd" id="date_visa_dssd" class="form-control" value="{{$projet->date_visa_dssd}}">
		        	</div>
		        	<div class="form-group">
		        		<label class="font-weight-bold"> Date passage en production:</label>
		        		<input type="date" name="date_passage_prod" id="date_passage_prod" class="form-control" value="{{$projet->date_passage_prod}}">
		        	</div>
		        </form>
	        </div>
	        <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="mdi mdi-close"></span> Annuler</button>
		        <button type="button" onclick="$('#projet_edit').submit()" class="btn btn-success"><span class="mdi mdi-content-save"></span> Sauvgarder</button>
	        </div>
	    </div>
    </div>
</div>
