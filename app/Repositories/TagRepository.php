<?php

namespace App\Repositories;

use App\Middleware\Database;
use App\Models\Tag;
use App\Models\JobOffer;
use PDO;

class TagRepository extends BaseRepository
{
    public function __construct()
    {
        $pdo = Database::connection();
        parent::__construct($pdo);
        $this->table = 'tags';
    }

    /**
     * @return Tag[]
     */
    public function all(): array
    {
        $rows = $this->findAll();
        $tags = [];
        
        foreach ($rows as $row) {
            $tags[] = new Tag($row);
        }

        return $tags;
    }

    public function find(int $id): ?Tag
    {
        $row = $this->findById($id);
        
        if (!$row) {
            return null;
        }

        return new Tag($row);
    }

    public function createTag(Tag $tag): bool
    {
        $data = [
            'name' => $tag->name
        ];

        return parent::create($data);
    }

    public function updateTag(Tag $tag): bool
    {
        if ($tag->id === null) {
            throw new \InvalidArgumentException('Tag id is required for update');
        }

        $data = [
            'name' => $tag->name
        ];

        return parent::update($tag->id, $data);
    }

    public function findByName(string $name): ?Tag
    {
        $row = $this->findBy('name', $name);
        
        if (!$row) {
            return null;
        }

        return new Tag($row);
    }

    public function findByIdWithJobOffers(int $id): ?Tag
    {
        $tag = $this->find($id);
        
        if ($tag) {
            $jobOfferTagRepo = new JobOfferTagRepository($this->pdo);
            $jobOfferRepo = new JobOfferRepository($this->pdo);
            
            $jobOfferTags = $jobOfferTagRepo->findByMultiple('tag_id', [$id]);
            
            foreach ($jobOfferTags as $jobOfferTag) {
                $jobOfferData = $jobOfferRepo->findById($jobOfferTag['job_offer_id']);
                if ($jobOfferData) {
                    $jobOffer = new JobOffer($jobOfferData);
                    $tag->addJobOffer($jobOffer);
                }
            }
        }
        
        return $tag;
    }
}
