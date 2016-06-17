<?php
namespace PubBundle\Domain\ValueObject;

use PubBundle\Domain\Entity\Place;

class LocationRelation
{
    /**
     * @var KilometerDistance
     */
    private $distance;
    /**
     * @var Place
     */
    private $relatedPlace;

    public function __construct(KilometerDistance $distance, Place $relatedPlace)
    {
        $this->distance = $distance;
        $this->relatedPlace = $relatedPlace;
    }

    /**
     * @return KilometerDistance
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @return Place
     */
    public function getRelatedPlace()
    {
        return $this->relatedPlace;
    }
}
