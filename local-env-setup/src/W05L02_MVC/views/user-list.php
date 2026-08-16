<a href="/users/add">Add User</a>
<table>
	<?php foreach ($users as $row): ?>
		<tr>
			<td><?= (int) $row['id'] ?></td>
			<td><?= htmlspecialchars($row['name']) ?></td>
			<td><?= htmlspecialchars($row['profession']) ?></td>
		</tr>
	<?php endforeach ?>
</table>
