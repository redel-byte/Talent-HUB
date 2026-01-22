<?php

namespace App\Repositories;
use PDO;

class CategorieRepository extends BaseRepository
{
    protected string $table = 'categories';
    
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function getCategories(): array
    {
        return $this->pdo
            ->query("SELECT * FROM categories")
            ->fetchAll(PDO::FETCH_ASSOC);
    }
    public function setCategories($categories){
        $stm = $this->pdo->prepare("insert into categories (name) VALUES (:categories);");
        return $stm->execute(['name'=>$categories]);
    }
    public function findCategories($categories){
        $stm = $this->pdo->prepare('select * from categories where name = :categories;');
        return $stm->execute(['categories' => $categories]) ?: null;
    }
    public function rmCategories($id):bool{
        $stm = $this->pdo->prepare('delete from categories where id = :id;');
        return $stm->execute(['id'=>$id]);
    }
}