<?php

namespace App\Models;

class JobOffer
{
    public int $id;
    public string $title;
    public string $description;
    public float $salary;
    public int $company_id;
    public int $category_id;
    public ?string $archived_at;
}
