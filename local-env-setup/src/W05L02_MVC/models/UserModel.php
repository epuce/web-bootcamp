<?php

namespace CRUD\models;

use CRUD\entity\User;
use DB\DB;

require_once __DIR__ . "/../../database-wrapper.php";
class UserModel
{	

	public static function getAllUsers() {
		return DB::run('SELECT * FROM users');
	}

	public static function createUser(User $user)
	{
		return DB::run("INSERT INTO users (name, profession) VALUES ('" . $user->name. "', '" . $user->profession . "')");
	}

	public static function getUser($user) {
		return DB::run("SELECT * FROM users WHERE name='". $user['name'] ."'");
	}

	public static function addUser() {
		
	}

	public static function deleteUserById() {

	}

	public static function getUserById() {

	}
}
