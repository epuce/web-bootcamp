<form id="form" action="<?php $_ENV["HOSTNAME"] . 'users/add' ?>" method="post">
	<div class="form-group">
		<lable>
			User

			<input class="form-control" name="name"/>
		</lable>
	</div>

	<div class="form-group">
		<label>
			Profession

			<input class="form-control" name="profession">
		</label>
	</div>

	<input type="hidden" name="id" value="<?php echo $id ?>">

	<div class="form-group d-flex justify-content-center">
		<button class="btn btn-primary" type="submit" name="create">Create</button>
	</div>
</form>