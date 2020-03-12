<a href="users/add">Add User</a>
<table>
	<?php foreach ($users as $row): ?>
		<tr>
			<td>
				<?= $row['id']?>
			</td>
			<td>
				<?= $row['name'] ?>
			</td>
			<td>
				<?= $row['profession'] ?>
			</td>
		</tr>
	<?php endforeach ?>
</table>


