<?php if (!empty($message)): ?>
	<p><?= htmlspecialchars($message) ?></p>
<?php endif ?>

<form id="form" method="post">
	<div class="form-group">
		<label>
			User

			<input class="form-control" name="name"/>
		</label>
	</div>

	<div class="form-group">
		<label>
			Password

			<input class="form-control" type="password" name="password">
		</label>
	</div>

	<div class="form-group d-flex justify-content-center">
		<button class="btn btn-primary" type="submit" name="login">Login</button>
	</div>
</form>
