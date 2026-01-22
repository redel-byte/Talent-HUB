<?php

namespace App\Models;

class Company
{
    public ?int $id = null;
    public string $name;
    public ?string $description = null;
    public ?string $website = null;
    public ?string $industry = null;
    public string $size = 'small';
    public ?string $logoPath = null;
    public ?int $foundedYear = null;
    public ?string $location = null;
    public ?\DateTime $createdAt = null;
    public ?\DateTime $updatedAt = null;
    public ?\DateTime $archivedAt = null;

    // Aggregation: Company has many users (can exist without users)
    private array $users = [];

    // Aggregation: Company has many job offers (can exist without job offers)
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
        if (isset($data['updated_at'])) {
            $this->updatedAt = new \DateTime($data['updated_at']);
        }
        if (isset($data['archived_at'])) {
            $this->archivedAt = new \DateTime($data['archived_at']);
        }
    }

    public function addUser(UserEntity $user, string $role = 'recruiter'): void
    {
        if (!in_array($user, $this->users)) {
            $this->users[] = $user;
            $user->addCompany($this);
        }
    }

    public function removeUser(UserEntity $user): void
    {
        $key = array_search($user, $this->users, true);
        if ($key !== false) {
            unset($this->users[$key]);
            $this->users = array_values($this->users);
            $user->removeCompany($this);
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
            $user->addCompany($this);
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

    public function isArchived(): bool
    {
        return $this->archivedAt !== null;
    }

    public function archive(): void
    {
        $this->archivedAt = new \DateTime();
    }

    public function getSizeLabel(): string
    {
        return match($this->size) {
            'startup' => 'Startup (1-10)',
            'small' => 'Small (11-50)',
            'medium' => 'Medium (51-200)',
            'large' => 'Large (201-500)',
            'enterprise' => 'Enterprise (500+)',
            default => $this->size
        };
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'website' => $this->website,
            'industry' => $this->industry,
            'size' => $this->size,
            'logo_path' => $this->logoPath,
            'founded_year' => $this->foundedYear,
            'location' => $this->location,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),
            'archived_at' => $this->archivedAt?->format('Y-m-d H:i:s'),
            'users' => array_map(fn($user) => $user->toArray(), $this->users),
            'job_offers' => array_map(fn($job) => $job->toArray(), $this->jobOffers)
        ];
    }
}
