<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Modifier un utilisateur</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        </div>
	        <div class="modal-body">
		        <form id="User_edit" method="post" action="/users/modifier">
		        	{{csrf_field()}}
		        	<input type="" name="id" id="user_id" hidden>
		        	@include('errors.errors')
		        	<div class="form-group">
		        		<label class="font-weight-bold"> Nom:</label>
		        		<input type="text" id="user_name" name="name" class="form-control" required>
		        	</div>
		        	<div class="form-group">
		        		<label class="font-weight-bold"> Email:</label>
		        		<input type="email" id="user_email" name="email" class="form-control" required>
		        	</div>
		        	
		        	<div class="form-group">
		        		<label class="font-weight-bold"> Mot de passe:</label>
		        		<input type="password" id="user_password" name="password" class="form-control" required>
		        	</div>
		        	<div class="form-group">
		        		<label class="font-weight-bold"> Role:</label>
		        		<select name="role" class="form-control" required>
		        			@foreach ($roles as $role)
		        			<option value="{{$role->id}}"> {{$role->designation}}</option>
		        			@endforeach
		        		</select>
		        	</div>
		        </form>
	        </div>
	        <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="mdi mdi-close"></span> Annuler</button>
		        <button type="button" onclick="$('#User_edit').submit()" class="btn btn-success"><span class="mdi mdi-content-save"></span> Sauvgarder</button>
	        </div>
	    </div>
    </div>
</div>
