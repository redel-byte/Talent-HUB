<?php

namespace App\Models;

class Tag
{
    public ?int $id = null;
    public string $name;
    public string $color = '#007bff';
    public ?\DateTime $createdAt = null;

    // Aggregation: Tag has many job offers (can exist without job offers)
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
    }

    public function addJobOffer(JobOffer $jobOffer): void
    {
        if (!in_array($jobOffer, $this->jobOffers)) {
            $this->jobOffers[] = $jobOffer;
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
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'color' => $this->color,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'job_offers' => array_map(fn($job) => $job->toArray(), $this->jobOffers)
        ];
    }
}
