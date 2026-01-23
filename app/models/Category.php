<?php

namespace App\Models;

class Category
{
    public ?int $id = null;
    public string $name;
    public ?string $description = null;
    public ?\DateTime $createdAt = null;
    public ?\DateTime $archivedAt = null;

    // Aggregation: Category has many job offers (can exist without job offers)
    private array $jobOffers = [];

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
        if (isset($data['archived_at'])) {
            $this->archivedAt = new \DateTime($data['archived_at']);
        }
    }

    public function addJobOffer(JobOffer $jobOffer): void
    {
        if (!in_array($jobOffer, $this->jobOffers)) {
            $this->jobOffers[] = $jobOffer;
            $jobOffer->setCategory($this);
        }
    }

    public function removeJobOffer(JobOffer $jobOffer): void
    {
        $key = array_search($jobOffer, $this->jobOffers, true);
        if ($key !== false) {
            unset($this->jobOffers[$key]);
            $this->jobOffers = array_values($this->jobOffers);
        }
    }

    public function getJobOffers(): array
    {
        return $this->jobOffers;
    }

    public function setJobOffers(array $jobOffers): void
    {
        $this->jobOffers = $jobOffers;
        foreach ($jobOffers as $jobOffer) {
            $jobOffer->setCategory($this);
        }
    }

    public function isArchived(): bool
    {
        return $this->archivedAt !== null;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'archived_at' => $this->archivedAt?->format('Y-m-d H:i:s'),
            'job_offers' => array_map(fn($job) => $job->toArray(), $this->jobOffers)
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        if ($id <= 0) {
            throw new \InvalidArgumentException('Invalid category id');
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
            throw new \InvalidArgumentException('Category name cannot be empty');
        }

        if (mb_strlen($name) > 255) {
            throw new \InvalidArgumentException('Category name is too long');
        }

        $this->name = $name;

        return $this;
    }

}
