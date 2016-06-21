<?php
namespace PubBundle\Domain\ReadRepository;

use PubBundle\Domain\Entity\Place;
use PubBundle\Domain\ValueObject\Latitude;
use PubBundle\Domain\ValueObject\Location;
use PubBundle\Domain\ValueObject\Longitude;
use PubBundle\Domain\ValueObject\PlaceId;
use PubBundle\Domain\ValueObject\Rating;
use PubBundle\TypeValidationTrait\ArrayCollectionCastTrait;

class TestPlaceReadRepository implements PlaceReadRepository
{
    use ArrayCollectionCastTrait;

    /**
     * {@inheritdoc}
     */
    public function getForIds($ids)
    {
        $ids = $this->makeCollectionOfValid($ids, PlaceId::class);
        if (empty($ids)) {
            return [];
        }

        $places = [];
        foreach ($ids as $id) {
            $places[] = $this->getPlaceForId($id);
        }

        return $places;
    }

    /**
     * @param PlaceId $id
     * @return Place
     */
    private function getPlaceForId(PlaceId $id)
    {
        return new Place(
            $id,
            'Name '. $id->getValue(),
            'Address ' . $id->getValue(),
            new Location(
                new Latitude(50.060),
                new Longitude(19.959)
            ),
            new Rating(5)
        );
    }
}
