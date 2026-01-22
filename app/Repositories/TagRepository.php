<?php

namespace App\Repositories;

use PDO;

class TagRepository extends BaseRepository
{
    protected string $table = 'tags';
    
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }
}
