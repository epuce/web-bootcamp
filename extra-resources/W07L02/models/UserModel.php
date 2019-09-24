<?php
class UserModel
{
	protected $db;

	public function __construct(DatabaseWrapper $db)
	{
		$this->db = $db;
	}

	public function getAllUsers() {
		return $this->db->execute('SELECT * FROM Users');
	}

	public function createUser(User $user)
	{
		return $this->db->execute("INSERT INTO Users (name, profession) VALUES ('" . $user->name. "', '" . $user->profession . "')");
	}
}
