<?php
namespace PubBundle\Component\Location;

use PubBundle\Domain\ValueObject\KilometerDistance;
use PubBundle\Domain\ValueObject\Location;

/**
 * source: https://www.geodatasource.com/developers/php
 * Class SimpleKilometerDistanceCalculator
 * @package PubBundle\Component\Location
 */
class SimpleKilometerDistanceCalculator implements KilometerDistanceCalculator
{
    /**
     * {@inheritdoc}
     */
    public function calculateDistance(Location $from, Location $to)
    {
        $theta = $from->getLongitude()->getValue() - $to->getLongitude()->getValue();
        $dist = sin(deg2rad($from->getLatitude()->getValue()))
            * sin(deg2rad($to->getLatitude()->getValue())) +  cos(deg2rad($from->getLatitude()->getValue()))
            * cos(deg2rad($to->getLatitude()->getValue()))
            * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        return new KilometerDistance($dist * 60 * 1.1515 * 1.609344);
    }
}
