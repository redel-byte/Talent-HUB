<?php

namespace App\Models;

class JobOffer
{
    private int $id;
    private string $title;
    private string $description;
    private float $salary;
    private int $company_id;
    private int $category_id;
    private ?string $archived_at;

    public function getId():int{
        return $this->id;
    }
    public function getTitle():string{
        return $this->title;
    }
    public function getDescription():string{
        return $this->description;
    }
    public function getSalary():float{
        return $this->salary;
    }
    public function getCompanyId():int{
        return $this->company_id;
    }
    public function getCategoryId():int{
        return $this->category_id;
    }
    public function getArchived():?string{
        return $this->archived_at;
    }
}
