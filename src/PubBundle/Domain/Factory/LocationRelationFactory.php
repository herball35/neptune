<?php
namespace PubBundle\Domain\Factory;

use PubBundle\Domain\Entity\Place;
use PubBundle\Domain\ValueObject\Location;
use PubBundle\Domain\ValueObject\LocationRelation;

interface LocationRelationFactory
{
    /**
     * @param Location $location
     * @param Place $relatedPlace
     * @return LocationRelation
     */
    public function createLocationRelation(Location $location, Place $relatedPlace);
}
