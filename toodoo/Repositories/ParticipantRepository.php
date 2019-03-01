<?php

namespace Toodoo\Repositories;

use Toodoo\Models\Participant;

class ParticipantRepository
{
    /**
     * @var Participant
     */
    private $model;

    /**
     * ParticipantRepository constructor.
     * @param Participant $participant
     */
    public function __construct(Participant $participant)
    {
        $this->model = $participant;
    }
}
