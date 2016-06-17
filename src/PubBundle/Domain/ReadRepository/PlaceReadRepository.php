<?php
namespace PubBundle\Domain\ReadRepository;

use PubBundle\Domain\Entity\Place;
use PubBundle\Domain\ValueObject\PlaceId;

interface PlaceReadRepository
{
    /**
     * @param PlaceId[]|array $ids
     * @return Place[]|array
     */
    public function getForIds($ids);
}
