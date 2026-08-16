<form id="form" action="/users/add" method="post">
	<div class="form-group">
		<label>
			User

			<input class="form-control" name="name"/>
		</label>
	</div>

	<div class="form-group">
		<label>
			Profession

			<input class="form-control" name="profession">
		</label>
	</div>

	<div class="form-group">
		<label>
			Password

			<input class="form-control" type="password" name="password">
		</label>
	</div>

	<div class="form-group d-flex justify-content-center">
		<button class="btn btn-primary" type="submit" name="create">Create</button>
	</div>
</form>
