@include('popups.procedures.procedureError')
@include('popups.users.UserError')
@include('popups.types.TypeError')
@include('popups.technologies.TechError')
@include ('popups.demandes.demandeError')
@include('emails.mailSuccess')
@include('emails.mailFailed')

@if (!empty(Session::get('procedureError')))
	<script type="text/javascript">
		$('#procedureError').modal('show');
	</script>
@endif
@if (!empty(Session::get('UserError')))
	<script type="text/javascript">
		$('#UserError').modal('show');
	</script>
@endif
@if (!empty(Session::get('TypeError')))
	<script type="text/javascript">
		$('#TypeError').modal('show');
	</script>
@endif
@if (!empty(Session::get('TechError')))
	<script type="text/javascript">
		$('#TechError').modal('show');
	</script>
@endif
@if (!empty(Session::get('demandeError')))
	<script type="text/javascript">
		$('#demandeError').modal('show');
	</script>
@endif
@if (!empty(Session::get('success')))
	<script type="text/javascript">
		$('#mailSuccess').modal('show');
	</script>
@endif
@if (!empty(Session::get('error')))
	<script type="text/javascript">
		$('#mailFailed').modal('show');
	</script>
@endif