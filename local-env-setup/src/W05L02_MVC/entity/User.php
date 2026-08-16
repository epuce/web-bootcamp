<?php

class User {
    public ?int $id = null;
    public string $name = '';
    public string $profession = '';

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setProfession(string $profession): void {
        $this->profession = $profession;
    }
}
