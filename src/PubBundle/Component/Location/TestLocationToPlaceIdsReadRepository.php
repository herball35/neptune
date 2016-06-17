<?php
namespace PubBundle\Component\Location;

use PubBundle\Domain\ValueObject\Location;
use PubBundle\Domain\ValueObject\PlaceId;

class TestLocationToPlaceIdsReadRepository implements LocationToPlaceIdsReadRepository
{
    /**
     * {@inheritdoc}
     */
    public function getByLocation(Location $location)
    {
        return new LocationToPlaceIds(
            $location,
            [
                new PlaceId('Place 1 ID'),
                new PlaceId('Place 2 ID'),
                new PlaceId('Place 3 ID'),
                new PlaceId('Place 4 ID'),
            ]
        );
    }
}
