<?php
namespace PubBundle\Domain\ReadRepository;

use PubBundle\Domain\Entity\Place;

interface GoogleResultToPlaceMapper
{
    /**
     * @param \stdClass $googleResult
     * @return Place
     */
    public function map($googleResult);
}
