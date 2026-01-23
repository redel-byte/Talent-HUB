<?php

namespace App\Models;

class Application
{
    public ?int $id = null;
    public int $jobOfferId;
    public int $candidateId;
    public ?string $coverLetter = null;
    public ?string $cvPath = null;
    public string $status = 'pending';
    public ?\DateTime $appliedAt = null;
    public ?\DateTime $updatedAt = null;

    // Aggregation: Application belongs to a job offer (can exist without the application)
    private ?JobOffer $jobOffer = null;

    // Aggregation: Application belongs to a candidate (can exist without the application)
    private ?UserEntity $candidate = null;

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
        
        if (isset($data['applied_at'])) {
            $this->appliedAt = new \DateTime($data['applied_at']);
        }
        if (isset($data['updated_at'])) {
            $this->updatedAt = new \DateTime($data['updated_at']);
        }
    }

    public function getJobOffer(): ?JobOffer
    {
        return $this->jobOffer;
    }

    public function setJobOffer(?JobOffer $jobOffer): void
    {
        $this->jobOffer = $jobOffer;
        $this->jobOfferId = $jobOffer?->id;
    }

    public function getCandidate(): ?UserEntity
    {
        return $this->candidate;
    }

    public function setCandidate(?UserEntity $candidate): void
    {
        $this->candidate = $candidate;
        $this->candidateId = $candidate?->id;
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isReviewed(): bool
    {
        return $this->status === 'reviewed';
    }

    public function isAccepted(): bool
    {
        return $this->status === 'accepted';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function accept(): void
    {
        $this->status = 'accepted';
        $this->updatedAt = new \DateTime();
    }

    public function reject(): void
    {
        $this->status = 'rejected';
        $this->updatedAt = new \DateTime();
    }

    public function markAsReviewed(): void
    {
        $this->status = 'reviewed';
        $this->updatedAt = new \DateTime();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'job_offer_id' => $this->jobOfferId,
            'candidate_id' => $this->candidateId,
            'cover_letter' => $this->coverLetter,
            'cv_path' => $this->cvPath,
            'status' => $this->status,
            'applied_at' => $this->appliedAt?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),
            'job_offer' => $this->jobOffer?->toArray(),
            'candidate' => $this->candidate?->toArray()
        ];
    }
}
