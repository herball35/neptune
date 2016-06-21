<?php
namespace PubBundle\Component\Location;

use PubBundle\Domain\ValueObject\Location;
use PubBundle\Domain\ValueObject\PlaceId;
use PubBundle\TypeValidationTrait\ArrayCollectionCastTrait;

class LocationToPlaceIds
{
    use ArrayCollectionCastTrait;

    /**
     * @var Location
     */
    private $location;

    /**
     * @var PlaceId[]|array
     */
    private $placeIds;

    /**
     * @param Location $location
     * @param PlaceId[]|array $placeIds
     */
    public function __construct(Location $location, $placeIds)
    {

        $this->location = $location;
        $this->placeIds = $this->makeCollectionOfValid($placeIds, PlaceId::class);
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return array|PlaceId[]
     */
    public function getPlaceIds()
    {
        return $this->placeIds;
    }
}
