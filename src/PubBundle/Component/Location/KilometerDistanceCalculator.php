<?php
namespace PubBundle\Component\Location;

use PubBundle\Domain\ValueObject\KilometerDistance;
use PubBundle\Domain\ValueObject\Location;

interface KilometerDistanceCalculator
{
    /**
     * @param Location $from
     * @param Location $to
     * @return KilometerDistance
     */
    public function calculateDistance(Location $from, Location $to);
}
