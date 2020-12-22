<?php echo json_encode($_ENV) ?>

<form id="form" method="post">
<div class="form-group">
	<lable>
		User

		<input class="form-control" name="name"/>
	</lable>
</div>

<div class="form-group">
	<label>
		Password

		<input class="form-control" name="password">
	</label>
</div>

<div class="form-group d-flex justify-content-center">
	<button class="btn btn-primary" type="submit" name="login">Login</button>
</div>
</form>