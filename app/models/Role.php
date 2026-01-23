<?php

namespace App\Models;

class Role
{
    public ?int $id = null;
    public string $name;
    public ?\DateTime $createdAt = null;

    // Aggregation: Role has many users (can exist without users)
    private array $users = [];

    public function __construct(array $data = [])
    {
        $this->fill($data);
    }

    public function fill(array $data): void
    {
        foreach ($data as $key => $value) {
            $property = lcfirst(str_replace('_', '', ucwords($key, '_')));
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
        
        if (isset($data['created_at'])) {
            $this->createdAt = new \DateTime($data['created_at']);
        }
    }

    public function addUser(UserEntity $user): void
    {
        if (!in_array($user, $this->users)) {
            $this->users[] = $user;
            $user->setRole($this);
        }
    }

    public function removeUser(UserEntity $user): void
    {
        $key = array_search($user, $this->users, true);
        if ($key !== false) {
            unset($this->users[$key]);
            $this->users = array_values($this->users);
        }
    }

    public function getUsers(): array
    {
        return $this->users;
    }

    public function setUsers(array $users): void
    {
        $this->users = $users;
        foreach ($users as $user) {
            $user->setRole($this);
        }
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'users' => array_map(fn($user) => $user->toArray(), $this->users)
        ];
    }
}
