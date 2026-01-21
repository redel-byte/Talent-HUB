<?php
class CategoryRepository
{
    public function __construct(private PDO $pdo) {}

    public function all(): array
    {
        return $this->pdo
            ->query("SELECT * FROM categories")
            ->fetchAll(PDO::FETCH_ASSOC);
    }
}
