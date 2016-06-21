<?php

namespace PubBundle\Component\BarSearch;

use PubBundle\Component\GooglePlaceSearcher\NearbySearchParameters;
use PubBundle\Component\GooglePlaceSearcher\NearbySearchParametersProvider;
use PubBundle\Component\GooglePlaceSearcher\SearchParameter\LocationSearchParameter;
use PubBundle\Component\GooglePlaceSearcher\SearchParameter\LocationTypeSearchParameter;
use PubBundle\Component\GooglePlaceSearcher\SearchParameter\RadiusSearchParameter;
use PubBundle\Domain\ValueObject\Location;

class BarNearbySearchParametersProvider implements NearbySearchParametersProvider
{
    /**
     * @var RadiusSearchParameter
     */
    private $searchRadius;
    /**
     * @var LocationTypeSearchParameter
     */
    private $locationType;

    /**
     * @param RadiusSearchParameter $searchRadius
     * @param LocationTypeSearchParameter $locationType
     */
    public function __construct(RadiusSearchParameter $searchRadius, LocationTypeSearchParameter $locationType)
    {
        $this->searchRadius = $searchRadius;
        $this->locationType = $locationType;
    }

    /**
     * {@inheritdoc}
     */
    public function getParametersForLocation(Location $location)
    {
        return new NearbySearchParameters(
            new LocationSearchParameter($location),
            $this->searchRadius,
            [$this->locationType]
        );
    }
}
