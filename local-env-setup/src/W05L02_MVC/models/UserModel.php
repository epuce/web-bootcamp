<?php

class UserModel
{
    public function __construct(private PDO $pdo) {}

    public function getAllUsers(): array
    {
        return $this->pdo->query('SELECT id, name, profession FROM users')->fetchAll();
    }

    public function getUserByName(string $name): ?array
    {
        // Placeholder keeps the input out of the SQL string (no injection)
        $stmt = $this->pdo->prepare('SELECT id, name, password FROM users WHERE name = ?');
        $stmt->execute([$name]);

        return $stmt->fetch() ?: null;
    }

    public function createUser(User $user, string $passwordHash): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (name, profession, password) VALUES (?, ?, ?)');
        $stmt->execute([$user->name, $user->profession, $passwordHash]);
    }
}
