<?php
namespace PubBundle\Component\GooglePlaceSearcher;

use PubBundle\Domain\ValueObject\Location;

interface NearbySearchParametersProvider
{
    /**
     * @param Location $location
     * @return NearbySearchParameters
     */
    public function getParametersForLocation(Location $location);
}
