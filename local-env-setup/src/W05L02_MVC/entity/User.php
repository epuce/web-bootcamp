<?php
class User {
	public $name;
	public $profession;
	public $id;

	public function __construct() {
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param mixed $profession
	 */
	public function setProfession($profession) {
		$this->profession = $profession;
	}
}

