<?php

namespace App\Models;

class JobOffer
{
    public ?int $id = null;
    public string $title;
    public string $description;
    public ?string $requirements = null;
    public ?float $salaryMin = null;
    public ?float $salaryMax = null;
    public ?string $location = null;
    public string $workType = 'onsite';
    public string $experienceLevel = 'mid';
    public ?int $categoryId = null;
    public int $recruiterId;
    public string $status = 'draft';
    public ?\DateTime $createdAt = null;
    public ?\DateTime $updatedAt = null;
    public ?\DateTime $archivedAt = null;

    // Composition: JobOffer has tags (cannot exist without the job offer)
    private array $tags = [];

    // Aggregation: JobOffer belongs to a category (can exist without the job offer)
    private ?Category $category = null;

    // Aggregation: JobOffer belongs to a recruiter (can exist without the job offer)
    private ?UserEntity $recruiter = null;

    // Composition: JobOffer has applications (applications cannot exist without job offer)
    private array $applications = [];

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

    // Composition methods for tags
    public function addTag(Tag $tag): void
    {
        if (!in_array($tag, $this->tags)) {
            $this->tags[] = $tag;
        }
    }

    public function removeTag(Tag $tag): void
    {
        $key = array_search($tag, $this->tags, true);
        if ($key !== false) {
            unset($this->tags[$key]);
            $this->tags = array_values($this->tags);
        }
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    // Aggregation methods for category
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): void
    {
        $this->category = $category;
        $this->categoryId = $category?->id;
    }

    // Aggregation methods for recruiter
    public function getRecruiter(): ?UserEntity
    {
        return $this->recruiter;
    }

    public function setRecruiter(?UserEntity $recruiter): void
    {
        $this->recruiter = $recruiter;
        $this->recruiterId = $recruiter?->id;
    }

    // Composition methods for applications
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
            $this->applications = array_values($this->applications);
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

    // Business logic methods
    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isArchived(): bool
    {
        return $this->status === 'archived' || $this->archivedAt !== null;
    }

    public function publish(): void
    {
        $this->status = 'published';
    }

    public function archive(): void
    {
        $this->status = 'archived';
        $this->archivedAt = new \DateTime();
    }

    public function getSalaryRange(): string
    {
        if ($this->salaryMin && $this->salaryMax) {
            return "$" . number_format($this->salaryMin) . " - $" . number_format($this->salaryMax);
        }
        if ($this->salaryMin) {
            return "From $" . number_format($this->salaryMin);
        }
        if ($this->salaryMax) {
            return "Up to $" . number_format($this->salaryMax);
        }
        return 'Not specified';
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'requirements' => $this->requirements,
            'salary_min' => $this->salaryMin,
            'salary_max' => $this->salaryMax,
            'location' => $this->location,
            'work_type' => $this->workType,
            'experience_level' => $this->experienceLevel,
            'category_id' => $this->categoryId,
            'recruiter_id' => $this->recruiterId,
            'status' => $this->status,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),
            'archived_at' => $this->archivedAt?->format('Y-m-d H:i:s'),
            'category' => $this->category?->toArray(),
            'recruiter' => $this->recruiter?->toArray(),
            'tags' => array_map(fn($tag) => $tag->toArray(), $this->tags),
            'applications' => array_map(fn($app) => $app->toArray(), $this->applications)
        ];
    }
}
