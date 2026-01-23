<?php

namespace App\Models;

class Tag
{
    private ?int $id = null;
    private string $name;

    public function __construct(?int $id = null, string $name = '')
    {
        if ($id !== null) {
            $this->id = $id;
        }

        if ($name !== '') {
            $this->setName($name);
        }
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        if ($id <= 0) {
            throw new \InvalidArgumentException('Invalid tag id');
        }
        $this->id = $id;
        return $this;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $name = trim($name);

        if ($name === '') {
            throw new \InvalidArgumentException('Tag name cannot be empty');
        }

        if (mb_strlen($name) > 255) {
            throw new \InvalidArgumentException('Tag name is too long');
        }

        $this->name = $name;

        return $this;
    }
}
