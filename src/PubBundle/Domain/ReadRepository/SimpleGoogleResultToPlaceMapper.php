<?php
namespace PubBundle\Domain\ReadRepository;

use PubBundle\Domain\Entity\Place;
use PubBundle\Domain\ValueObject\Latitude;
use PubBundle\Domain\ValueObject\Location;
use PubBundle\Domain\ValueObject\Longitude;
use PubBundle\Domain\ValueObject\PlaceId;
use PubBundle\Domain\ValueObject\Rating;

class SimpleGoogleResultToPlaceMapper implements GoogleResultToPlaceMapper
{
    /**
     * {@inheritdoc}
     */
    public function map($googleResult)
    {
        $rating = null;
        if ($googleResult->rating) {
            $rating = new Rating($googleResult->rating);
        }

        return new Place(
            new PlaceId($googleResult->place_id),
            $googleResult->name,
            $googleResult->vicinity,
            new Location(
                new Latitude($googleResult->geometry->location->lat),
                new Longitude($googleResult->geometry->location->lng)
            ),
            $rating
        );
    }
}
