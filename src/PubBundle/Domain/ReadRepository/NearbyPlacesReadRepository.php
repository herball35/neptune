<?php
namespace PubBundle\Domain\ReadRepository;

use PubBundle\Domain\Entity\NearbyPlaces;
use PubBundle\Domain\ValueObject\Location;

interface NearbyPlacesReadRepository
{
    /**
     * @param Location $location
     * @return NearbyPlaces
     */
    public function getByLocation(Location $location);
}
