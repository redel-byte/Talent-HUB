<?php

namespace App\Models;

class UserEntity
{
    public ?int $id = null;
    public string $fullname;
    public string $email;
    public string $password;
    public ?string $phoneNumber = null;
    public int $roleId;
    public ?\DateTime $createdAt = null;
    public ?\DateTime $archivedAt = null;

    // Aggregation: User belongs to a role (can exist without the user)
    private ?Role $role = null;

    // Aggregation: User can have many applications (can exist without applications)
    private array $applications = [];

    // Aggregation: User can have many job offers (if recruiter) (can exist without job offers)
    private array $jobOffers = [];

    // Aggregation: User can belong to many companies (if recruiter) (can exist without companies)
    private array $companies = [];

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

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): void
    {
        $this->role = $role;
        $this->roleId = $role?->id;
    }

    public function addApplication(Application $application): void
    {
        if (!in_array($application, $this->applications)) {
            $this->applications[] = $application;
        }
    }

    public function removeApplication(Application $application): void
    {
        $key = array_search($application, $this->applications, true);
        if ($key !== false) {
            unset($this->applications[$key]);
        }
    }

    public function getApplications(): array
    {
        return $this->applications;
    }

    public function setApplications(array $applications): void
    {
        $this->applications = $applications;
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

    public function addCompany(Company $company): void
    {
        if (!in_array($company, $this->companies)) {
            $this->companies[] = $company;
        }
    }

    public function removeCompany(Company $company): void
    {
        $key = array_search($company, $this->companies, true);
        if ($key !== false) {
            unset($this->companies[$key]);
            $this->companies = array_values($this->companies);
        }
    }

    public function getCompanies(): array
    {
        return $this->companies;
    }

    public function setCompanies(array $companies): void
    {
        $this->companies = $companies;
    }

    public function isArchived(): bool
    {
        return $this->archivedAt !== null;
    }

    public function isAdmin(): bool
    {
        return $this->role?->name === 'admin';
    }

    public function isRecruiter(): bool
    {
        return $this->role?->name === 'recruiter';
    }

    public function isCandidate(): bool
    {
        return $this->role?->name === 'candidate';
    }

    public function archive(): void
    {
        $this->archivedAt = new \DateTime();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone_number' => $this->phoneNumber,
            'role_id' => $this->roleId,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'archived_at' => $this->archivedAt?->format('Y-m-d H:i:s'),
            'role' => $this->role?->toArray(),
            'applications' => array_map(fn($app) => $app->toArray(), $this->applications),
            'job_offers' => array_map(fn($job) => $job->toArray(), $this->jobOffers),
            'companies' => array_map(fn($company) => $company->toArray(), $this->companies)
        ];
    }
}
