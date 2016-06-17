<?php
namespace PubBundle\Component\Location;

use PubBundle\Domain\ValueObject\Location;

interface LocationToPlaceIdsReadRepository
{
    /**
     * @param Location $location
     * @return LocationToPlaceIds
     */
    public function getByLocation(Location $location);
}
