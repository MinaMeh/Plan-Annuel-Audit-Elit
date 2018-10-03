<div class="modal fade" id="editProcedure" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Modifier une procédure</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        </div>
	        <div class="modal-body">
		        <form id="procedure_edit" method="post" action="/procedures/modifier" enctype="multipart/form-data">
		        	{{csrf_field()}}
		        	<input type="" name="id" id="procedure_id" hidden>
		        	<div class="form-group">
		        		<label class="font-weight-bold"> Code:</label>
		        		<input id="procedure_code" type="text" name="code" class="form-control" required>
		        	</div>
		        	<div class="form-group">
		        		<label class="font-weight-bold"> Procédure:</label>
		        		<input id="procedure_designation" type="text" name="designation" class="form-control" required>
		        	</div>	
		        	<div class="form-group">
		            	<label class="font-weight-bold"> Fiche technique</label> <br>
		            	<input type="file" accept=".pdf,.doc,.docx," name="file"  id="FileUpload2" class="file-upload-default">
			            <div class="input-group col-xs-12 custom">
			                <input type="text" class="form-control" disabled placeholder="Fiche technique" name="documentation_np" id="fileup2" accept="application/pdf" required>
			                <span class="input-group-append" id="spnFilePath2" >
			                	<button class="file-upload-browse btn btn-upload" name="documentation_np" type="button" id="btnFileUpload2"><i class="mdi mdi-upload"></i>Upload</button>
			                </span>
			            </div>	   
			          </div>             	
		        </form>
	        </div>
	        <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="mdi mdi-close"></span> Annuler</button>
		        <button type="button" onclick="$('#procedure_edit').submit()" class="btn btn-success"><span class="mdi mdi-content-save"></span> Sauvgarder</button>
	        </div>
	    </div>
    </div>
</div>