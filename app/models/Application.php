<?php

namespace App\Models;

class Application
{
    private int $id;
    private int $candidate_id;
    private int $offer_id;
    private int $cv_upload;

    
    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setCandidateId(int $candidate_id)
    {
        $this->candidate_id = $candidate_id;
    }
    public function setOffer(int $offer_id)
    {
        $this->offer_id = $offer_id;
    }
    public function setCvupload($cv_upload)
    {
        $this->cv_upload = $cv_upload;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getCondidatId(): int
    {
        return $this->candidate_id;
    }
    public function getOfferid(): int
    {
        return $this->offer_id;
    }
    public function getCV(): mixed
    {
        return $this->cv_upload;
    }
}