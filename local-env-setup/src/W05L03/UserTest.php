<?php

use PHPUnit\Framework\TestCase;
use CRUD\entity\User;

final class UserTest extends TestCase
{
    public function testGetAllUsers()
    {
        $result = UserModel::getAllUsers(3);

        $this->assertEquals(3, $result->num_rows);
    }

    public function testAddAndGetUser() {
        $data = [
            "name" => "Test name",
            "password" => "Test pass"
        ];
        $user = new User($data);
        $userId = UserModel::addUser($user);
        try {
            $response = UserModel::getUserById($userId);

            $this->assertEquals(1, $response->num_rows);
    
            while ($row = mysqli_fetch_assoc($response)) {
                $this->assertNotNull($row["name"]);
                $this->assertNotNull($row["password"]);
                $this->assertEquals($user->getName(), $row["name"]);
                $this->assertEquals($data["password"], $row["password"]);
            }
        } finally {
            UserModel::deleteUserById($userId);
        }
    }
}
