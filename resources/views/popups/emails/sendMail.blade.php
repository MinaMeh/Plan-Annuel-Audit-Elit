<div class="modal fade" id="sendMail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Envoyer un E-mail</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        </div>
	        <div class="modal-body">
		      <form id="send" method="post" action="/plans/sendMail" enctype="multipart/form-data">
		      {{csrf_field()}}	
		      <div class="form-group">
		      		<label for="to"> Destinataires</label>
		      		

		      		<input type="text" name="to" id="to" class="form-control" required>
		      		<div class="text-muted"> Veuillez saisir les emails des destinataires séparés par une virgule</div>
		      </div>
		       <div class="form-group">
		      		<label for="title"> Objet</label>
		      		<input type="text" name="title" id="title" class="form-control">
		      </div>
		      <div class="form-group">
		      		<label for="body" class="text-center"> Corps</label>
		      		<textarea name="body" id="body" class="form-control" rows="6"></textarea> 
		      </div>
		      <div class="form-group">
              <label class="font-weight-bold"> Pièce jointe</label>
              <input type="file"  name="note" id="FileUpload1" class="file-upload-default">
              <div class="input-group col-xs-6 custom">
                <input type="text" class="form-control" disabled placeholder="Upload a file" name="note" id="note" required>
                <span class="input-group-append" id="spnFilePath" >
                  <button class="file-upload-browse btn btn-upload" type="button" id="btnFileUpload"><i class="mdi mdi-upload"></i>Upload</button>
                </span>
              </div>
		      </form>
	        </div>
	        <div class="modal-footer">
		        <button type="button" onclick="$('#send').submit()" class="btn btn-dark" ><span class="mdi mdi-send"></span> Envoyer</button>
		        <button type="button" data-dismiss="modal"  class="btn btn-secondary"><span class="mdi mdi-close"></span> Annuler</button>
	        </div>
	    </div>
    </div>
</div>
