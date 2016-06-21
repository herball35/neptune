<?php
namespace PubBundle\Domain\Factory;

use PubBundle\Component\Location\KilometerDistanceCalculator;
use PubBundle\Domain\Entity\Place;
use PubBundle\Domain\ValueObject\Location;
use PubBundle\Domain\ValueObject\LocationRelation;

class CalculatorBasedLocationRelationFactory implements LocationRelationFactory
{
    /**
     * @var KilometerDistanceCalculator
     */
    private $calculator;

    /**
     * @param KilometerDistanceCalculator $calculator
     */
    public function __construct(KilometerDistanceCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * {@inheritdoc}
     */
    public function createLocationRelation(Location $location, Place $relatedPlace)
    {
        return new LocationRelation(
            $this->calculator->calculateDistance($location, $relatedPlace->getLocation()),
            $relatedPlace
        );
    }
}
