<?php
namespace PubBundle\Domain\Entity;

use PubBundle\Domain\ValueObject\Location;
use PubBundle\Domain\ValueObject\LocationRelation;
use PubBundle\TypeValidationTrait\ArrayCollectionCastTrait;

class NearbyPlaces
{
    use ArrayCollectionCastTrait;

    /**
     * @var Location
     */
    private $location;

    /**
     * @var LocationRelation[]|array
     */
    private $relations;

    /**
     * @param Location $location
     * @param LocationRelation[]|array $relations
     */
    public function __construct(Location $location, $relations)
    {

        $this->location = $location;
        $this->relations = $this->makeCollectionOfValid($relations, LocationRelation::class);
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return array|LocationRelation[]
     */
    public function getRelations()
    {
        return $this->relations;
    }
}
