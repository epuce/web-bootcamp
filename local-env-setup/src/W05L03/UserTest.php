<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    public function testGetAllUsers(): void
    {
        $result = UserModel::getAllUsers();
        $users = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }

        $this->assertThat(5, $this->lessThan(count($users))); // Test if we have more than 5 users in the database
    }
    
    public function testAddAndGetUser(): void
    {
        $data = [
            "name" => "Test name",
            "password" => "Test password"
        ];

        $userId = UserModel::addUser($data);
        $result = UserModel::getUserById($userId);
        
        var_dump($userId);

        $this->assertEquals(1, $result->num_rows);
        try {
            while ($row = mysqli_fetch_assoc($result)) {
                $this->assertNotNull($row["password"]);
                $this->assertNotNull($row["password"]);
                $this->assertEquals($data["name"], $row["name"]);
                $this->assertEquals($data["password"], $row["password"]);
            }
        } finally {
            UserModel::deleteUserById($userId);
        }
    }
}
